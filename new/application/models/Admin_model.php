<?php
Class Admin_model extends CI_Model
{
  public function MenuAdmin() {
        $this->db->select('posts.*, media.url')
            ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->where('group','menu')
            //->where('status','active')
            ->order_by('sort_order', 'ASC');
        $items = $this->db->get('posts')->result();
        $cats = array();
        if (count($items) > 0) {
            foreach ($items as $cat) {
                $cats[$cat->category_id][] = $cat;
            }
        }
        return $trees = $this->buildMenuAdmin($cats,0);
    }
     public function buildMenuAdmin($cats, $parent_id, &$k = 0) {
        $this->db->select('posts.*, media.url')
            ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->where('group','directions')           
            //->where('status','active')
            ->order_by('sort_order', 'ASC');                      
          $col = array();
          $col = $this->db->get('posts', '7', '0')->result();
          //var_dump($col);
        if (is_array($cats) && isset($cats[$parent_id])) {
            $k++;
            if ($k > 3) { $k = 3; }
            //<li class="border-none"><a href="'.base_url().'">'.lang('home').'</a></li><li class="border"></li>
            if ($k == 1) $tree = ' <ul class="dd-list list_move list_move" id="mainNav">';
            // if ($k == 1) $tree = '<ul id="menu">';
            else { $tree = '<ul class="dd-list list list_move" style="display: none">'; 
            }
            $count = 1; foreach($cats[$parent_id] as $cat) {
                $title = unserialize($cat->title);
                  $move = 'Перемещать';
                $action_button = '<div class="action-menu"> 
                <button class="btn btn-mini move" data-toggle="tooltip" data-placement="right" title="'.$move.' ('._t($cat->title).')"><i class="fa fa-arrows"></i></button>
              <div class="sort-order_form">
                    <form action="'.site_url("admin/posts/sort_order_posts").'" method="post" style="margin-bottom: -10px;">
                    <input type="text" name="sort_order" class="sort-order_input"  data-order_enter="'.$cat->id.'" value="'.set_value('sort_order', $cat->sort_order).'" /> 
                    <input type="hidden" name="id" value="'.$cat->id.'" />  
                      <!--<div class="sort-order_enter" id="sort-order_enter-'.$cat->id.'" style="display:none">Для сохранения нажмите Enter.</div> -->             
                    </form>
                </div>                
                </div>';
                $checked = ($cat->status == 'active') ? 'checked="checked"' : '';
                $action = '<div class="action">
                <div class="action-buttons">
                 <div class="btn-group">
        <div class="onoffswitch">
    <input type="checkbox" name="status" class="onoffswitch-checkbox" id="myonoffswitch-'.$cat->id.'" '.$checked.' data-postid="'.$cat->id.'">
    <label class="onoffswitch-label" for="myonoffswitch-'.$cat->id.'">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
             <a href="'.site_url("admin/menu/save/$cat->id").'" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Редактировать</a>
        
        
              </div>
              
                </div>
                
                </div>';
                
                /*
                
				<a href="'.site_url("admin/menu/delete/$cat->id").'" class="btn btn-small btn-danger delete" title="Удалить"><i class="icon-trash icon-white"></i> '.lang('delete').'</a>
				
                <div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch-'.$cat->id.'" checked="'.$checked.'">
    <label class="onoffswitch-label" for="myonoffswitch-'.$cat->id.'">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
                */
                
                // '.site_url("admin/menu/delete/$cat->id").'
                
                if ($cat->category_id == 0) {
                    $sub = getOptionsData(array('group' => 'menu', 'category_id' => $cat->id, 'order' => 'ASC'));
                      if ($sub) {
                    $link = '<li class="dd-item item has-sub" id="item-'.$cat->id.'" data-id="'.$cat->id.'" parent_id="'.$cat->category_id.'" sort_id="'.$cat->sort_order.'">'.$action_button.'<a class="dropdown-toggle" href="#">'.@_t($cat->title).' </a>'.$action;
                    }else {
                       $link = '<li class="dd-item item none-sub" id="item-'.$cat->id.'" data-id="'.$cat->id.'" parent_id="'.$cat->category_id.'" sort_id="'.$cat->sort_order.'">'.$action_button.'<a class="dropdown-toggle" href="">'.@_t($cat->title).'</a>'.$action; 
                    }
                }  else {              
                    $sub = getOptionsData(array('group' => 'menu', 'category_id' => $cat->id, 'order' => 'ASC'));
               if ($sub) {
                      $link = '<li class="dd-item item has-sub" id="item-'.$cat->id.'" data-id="'.$cat->id.'" parent_id="'.$cat->category_id.'" sort_id="'.$cat->sort_order.'">'.$action_button.'<a href="#">'.@_t($cat->title).'</a>'.$action;
                      } else{
                         $link = '<li class="dd-item item none-sub" id="item-'.$cat->id.'" data-id="'.$cat->id.'" parent_id="'.$cat->category_id.'" sort_id="'.$cat->sort_order.'">'.$action_button.'<a class="dropdown-toggle" href="">'.@_t($cat->title).'</a>'.$action; 
                      }                  
                }
                $tree .= $link;
                $tree .= $this->buildMenuAdmin($cats, $cat->id, $k);
                $tree .= '';
            $count++; } 
            $tree .= '</ul>';
            if($parent_id !== 0) $tree .= '';
        }
        else {
            return null;
        }
        return $tree;
    }
}