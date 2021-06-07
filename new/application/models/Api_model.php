<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Api_model extends CI_Model
{
       public function getMenuApi() {
      $this->db->select('posts.*')    
          ->where('group','menu')
          ->where('status','active')
        // ->limit(4, 0)
         // ->like('option','yes')
          ->order_by('sort_order', 'ASC');
      $items = $this->db->get('posts')->result();
      $cats = array();
      if (count($items) > 0) {
          foreach ($items as $cat) {
              $cats[$cat->category_id][] = $cat;
          }
      }
      return $trees = $this->buildTreeApi($cats,0);
    }
     public function buildTreeApi($cats, $parent_id, &$k = 0) {
         $data = array();
         $$submenu = array();
        if (is_array($cats) && isset($cats[$parent_id])) {
            $k++;
            if ($k > 3) { $k = 3; }           
            if ($k == 1){ $tree = '';}                                     
            else {$tree = '';}
             foreach($cats[$parent_id] as $cat) {
                $title = unserialize($cat->title);             

                
                if ($cat->category_id == 0) {
                     $data[] = array(
                    'id' => $cat->id,
                    'title' => @$title[LANG],      
                    //'submenu' => $data_sub[$item->id][0],         
                );
                     //   if($cat->status1 == 'yes'){
                   
                    
                   // }
                   $link = @$title[LANG];
                }  else {                
                      $submenu[] = array(
                    'id' => $cat->id,
                    'title' => @$title[LANG],      
                    //'submenu' => $data_sub[$item->id][0],         
                );
                    $link = @$title[LANG];
                }
               $this->buildTreeApi($cats, $cat->id, $k);              
           
            } 
        }
        else {
            return null;
        }
        $data1 = array(
            $data,
            $submenu
        );
        return $data1;
    }
}
?>