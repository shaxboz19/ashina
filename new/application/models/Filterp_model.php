<?php

Class Filterp_model extends CI_Model
{


  	public function get_posts_p($args = null)
	{
		$defaults = array(
      'group' => 'video',
      //	'category_id' => array(),
      'category_id' => '',
      'id' => '',
      'limit' => 10000,
      'offset' => 0,
      'order' => 'DESC',
      'orderby' => 'id',
      'status' => '',
      'spec' => '',
      'direction' => '',
      'spec_type' => '',
      'keywords' => '',
      'description' => '',
      'meta_title' => '',
      'category' => '',     
      'option' => '',
      'views' => '',
      'sort_order' => '',  
      'mincost' => '',
      'maxcost' => '',   
      'cat_id' => '', 
      'season' => '',
      'style' => '',
      'suite' => '',
      'size_ft' => '',
      'season_ft' => '',
      'suite_ft' => '',
      'not_like' => '',     
      'media' => '', 
      'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
        // ->where('posts.category_id', $q['category_id'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
      
      if ( !empty($q['not_like']) )
			$this->db->not_like('posts.id', $q['not_like']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
            
            if (!empty($q['mincost']) and !empty($q['maxcost'])) {
			$this->db->where('posts.option_2 >=',(int)$q['mincost'])
		             ->where('posts.option_2 <=',(int)$q['maxcost']);
        }
         if (!empty($q['size_ru'])) {
			$this->db->where('find_in_set("'.(int)$q['size_ru'].'", posts.size_ru)');
		            
        }
        
         if (!empty($q['cat_id'])) {
			$this->db->where('find_in_set("'.(int)$q['cat_id'].'", posts.cat_id)');
		            
        }
          if (!empty($q['style'])) {
			$this->db->where('find_in_set("'.(int)$q['style'].'", posts.style)');
		            
        }
         if (!empty($q['suite'])) {
			$this->db->where('find_in_set("'.(int)$q['suite'].'", posts.suite)');
		            
        }
         if (!empty($q['size_ft'])) {
			$this->db->where('find_in_set("'.(int)$q['size_ft'].'", posts.size_ft)');
		            
        }
          if (!empty($q['season_ft'])) {
			$this->db->where('find_in_set("'.(int)$q['season_ft'].'", posts.season_ft)');
		            
        }
         if (!empty($q['suite_ft'])) {
			$this->db->where('find_in_set("'.(int)$q['suite_ft'].'", posts.suite_ft)');
		            
        }
         if (!empty($q['media'])) {
			$this->db->where('posts.media_status', $q['media']);
		            
        }
        
        
        
        

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}    
    
   
    



    public function get_posts_count_not($group, $id) {
	            
            	$this->db->not_like('category_id', $id);
              $this->db->where('group', $group);
                $this->db->where_in('status', 'active');
$this->db->from('posts');
return $this->db->count_all_results();
	}
  
  public function get_posts_count($group = 'pages') {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group = '".$group."'             
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');
	}
  
  public function get_posts_count_admin($group = 'pages') {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM posts AS p
                WHERE p.group = '".$group."'
				AND p.id";
            return $this->db->query($sql)->row('count');
	}

	    public function count_category($group = false, $id = false) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM posts AS p
                WHERE p.group = '".$group."'
				AND p.status = 'active'
				AND p.category_id = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
    
    	    public function gallery_menu() {
		 $this->db->select('posts.*')                	
                    ->where('posts.category_id', 182)
                    ->where('posts.status', 'active')
                    ->where('posts.group', 'menu');
                      
           return $this->db->get('posts')->result();
	}
  
    public function search_count($title, $group) {
	            
    //$this->db->where('group', $group);
    
    
    $this->db->like('title', $title);
    $this->db->where('status', 'active');
     $this->db->where_in('group', $group);
    $this->db->from('posts');
  
    return $this->db->count_all_results();

	/*$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.title = '".$title."'                  
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');*/

	}

}