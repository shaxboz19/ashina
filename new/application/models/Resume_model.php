<?php

Class Resume_model extends CI_Model
{
	public function get($id, $status = false) {
		$this->db->select('resume.*, media.url, categories.alias AS category')
		         ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
		         ->join('categories', 'resume.category_id = categories.category_id', 'left')
		         ->where('resume.id', $id);
        if($status)
            $this->db->where('resume.status', $status);

		return $this->db->get('resume')->row();
	}
   public function save_option_1($data_option_1, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('resume', $data_option_1);
		
	
	}
    public function get_id_option($option, $group)
	{
		$category = $this->db->get_where('resume', array('options'=>$option, 'group' => $group))->row();

		if ($category)
			return $category->id;
		else
			return null;
	}
   public function save_category_title($data_category_title, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('resume', $data_category_title);
		
	
	}
      public function get_posts_year($group,  $date1, $category = FALSE, $limit=100000, $offset=0)
    {
       $this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('resume.group', $group)
           // ->like('resume.category_id', 17)
            ->where('status', 'active')
            ->where('YEAR(posts.created_on)', $date1)
            
            
            ->order_by('resume.sort_order DESC')

           
           ->group_by('resume.id');
        
        return $this->db->get('resume', $limit, $offset)->result();
    }
  public function get_second($id)
	{
		$this->db->select('resume.*, media.url, categories.alias AS category')
		         ->join('media', 'resume.id = media.post_id AND media.is_main = \'0\'', 'left')
		         ->join('categories', 'resume.category_id = categories.category_id', 'left')
		         ->where('resume.id', $id);

		return $this->db->get('resume')->row();
	}
  public function get_id_by_category($group=false,$category)
    {
        $this->db->select('id, title');
        if($group)
        {
            $this->db->where('group',$group);
        }
        $this->db->where('category_id',$category);
        $post =$this->db->get('resume')->result();
        if ($post)
            return $post;
        else
            return false;
    }
	public function get_id($alias)
	{
		$post = $this->db->get_where('resume', array('alias'=>$alias))->row();

		if ($post)
			return $post->id;
		else
			return show_404();
	}
  
  
  
  public function save_meta($data, $id=FALSE)
	{
		if($id)
			$this->db->where('post_id', $id)
					 ->where('meta_key',$data['meta_key'])
					 ->update('post_meta',$data);
		else
			$this->db->insert('post_meta',$data);
	}
	public function get_meta($id)
	{
		return $this->db->get_where('post_meta',array('post_id'=> $id))->result();
	}
  
  public function get_posts_portfolio($group, $category=FALSE, $limit=200, $offset=0)
	{
		$this->db->select('resume.*, media.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('resume.group', $group)
				 //->where('status', 'active')
				 ->order_by('id DESC')
				 ->group_by('resume.id');

		if ($category)
			$this->db->where('resume.category_id', $category);

		return $this->db->get('resume', $limit, $offset)->result();
	}
    
    	public function get_posts_city_1($group, $category=FALSE, $limit=200, $offset=0)
	{
		$this->db->select('resume.*, media.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('resume.group', $group)
				 ->where('status', 'active')
				 ->order_by('id ASC')
				 ->group_by('resume.id');

		if ($category)
			$this->db->where('resume.category_id', $category);

		return $this->db->get('resume', $limit, $offset)->result();
	}

    public function get_posts_byID_portfolio($id)
    {
        $this->db->select('resume.*')
                 ->where('resume.id', $id);
        return $this->db->get('resume')->row_array();
    } 
    
    public function get_posts_date($group, $date1, $date2, $category = FALSE, $limit=100000, $offset=0)
    {
       $this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('resume.group', $group)
            ->where('status', 'active')
            ->where('resume.created_on >', $date1)
            ->where('resume.created_on <', $date2)
           ->group_by('resume.id');
        
        return $this->db->get('resume', $limit, $offset)->result();
    }
    
    
    	public function best_works($args = null)
	{
		$defaults = array(
			'group' => 'video',
		//	'category_id' => array(),
       'category_id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category' => '',     
             'option' => '',           
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
         ->where('resume.option', $q['option'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
      ///else
         //   $this->db->where('resume.status !=', 'draft');

		if ( !empty($q['category_id']) )
			$this->db->where_in('resume.category_id', $q['category_id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  public function best_works_popular($args = null)
	{
		$defaults = array(
			'group' => 'video',
		//	'category_id' => array(),
       'category_id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'status_popular' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category' => '',     
             'option' => '',           
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
         ->where('resume.'.$q['status_popular'].'', $q['option'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
      ///else
         //   $this->db->where('resume.status !=', 'draft');

		if ( !empty($q['category_id']) )
			$this->db->where_in('resume.category_id', $q['category_id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}

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
      	'not_like' => '',
			'orderby' => 'sort_order',
            'status' => '',
            'status1' => '',
            'lang_status' => '',
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);
//        $this->db->cache_on();
       
		$this->db->select('resume.*')
				 //->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				// ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
        // ->where('resume.category_id', $q['category_id'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
            
             if ( !empty($q['lang_status']) )
			$this->db->where_in('resume.lang_status', $q['lang_status']);
            
            if ( !empty($q['status1']) )
			$this->db->where_in('resume.status1', $q['status1']);
            
            
        /*else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('resume.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('resume.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
      if ( !empty($q['not_like']) )
			$this->db->not_like('resume.id', $q['not_like']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  public function get_posts_p1($args = null)
	{
		$defaults = array(
			'group' => 'video',
			'category_ids' => array(),
       //'category_id' => '',
       'id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
        // ->where('resume.category_id', $q['category_id'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
        /*else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('resume.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  
    	public function get_meta_posts_user($args = null)
	{
		$defaults = array(
			'group' => 'video',
		//	'category_id' => array(),
       'category_id' => '',
       'id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
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
              'user_id' => '',
             'sort_order' => '',           
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
         ->join('users_meta', 'users_meta.post_id = posts.id AND users_meta.user_id = "'.$q['user_id'].'"', 'left')
				 ->where('resume.group', $q['group'])
        // ->where('resume.category_id', $q['category_id'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
        /*else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('resume.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('resume.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  	public function get_alphabet($args = null)
	{
		$defaults = array(
			'group' => 'video',
		//	'category_id' => array(),
       'category_id' => '',
       'id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => '',
			'orderby' => '',
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group']);
         //->like('resume.title')
        // ->where('resume.category_id', $q['category_id'])
				// ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
        /*else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('resume.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('resume.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  public function get_posts_sort_order($args = null)
	{
		$defaults = array(
			'group' => 'video',
		//	'category_id' => array(),
       'category_id' => '',
       'id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => '',
			'orderby' => '',
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
        // ->where('resume.category_id', $q['category_id'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
        /*else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('resume.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('resume.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  
  public function get_posts_m_i($args = null)
	{
		$defaults = array(
			'group' => 'video',
		//	'category_id' => array(),
       'category_id' => '',
       'id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category' => '',     
             'option' => '',           
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])             
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
        /*else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('resume.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('resume.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  public function get_posts_public($group, $category=FALSE, $limit=20, $offset=0)
	{
		$this->db->select('resume.*, media.url, media.media_type, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'0\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('resume.group', $group)
				 ->order_by('id DESC')
				 ->group_by('resume.id');
		if ($category)
			$this->db->where('resume.category_id', $category);

		return $this->db->get('resume', $limit, $offset)->result();
	}

	public function get_posts($args = null)
	{
		$defaults = array(
			'group' => 'video',
			'category_ids' => array(),     
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category' => '',             
            'sort_order' => '',   
            'position_menu' => '',
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 //->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
              if(!empty($q['position_menu']))
            $this->db->where('resume.position_menu', $q['position_menu']);
        if(!empty($q['spec']))
            $this->db->where_in('resume.spec', $q['spec']);
       /* else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}
  
  
  public function get_posts_rec($args = null)
	{
		$defaults = array(
			'group' => 'video',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
      'status' => '',
      'price' => '',
      'direction' => '',
      'spec_type' => '',
      'keywords' => '',
      'description' => '',
      'meta_title' => '',
      'day' => '',
      'night' => '',
      'rec_tour' => '',
            'category' => '', 
      'rec_hotel' => ''


		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])     
         ->where('resume.rec_tour', $q['rec_tour'])  
         ->where('resume.rec_hotel', $q['rec_hotel'])   
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
       /* else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}


    	public function get_category_direction($args = null)
	{
		$defaults = array(
			'group' => 'video',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
                  'category' => '', 
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
                 ->where('resume.category_direction', $q['category_direction'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
       // else
            //$this->db->where('resume.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}



    	public function get_posts_spec($args = null)
	{
		$defaults = array(
			'group' => '',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
                  'category' => '', 
            'category_direction' => ''
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
                 ->where('resume.spec', $q['spec'])
				 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
      //  else
//            $this->db->where('resume.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}

	    	public function get_posts_direction($args = null)
	{
		$defaults = array(
			'group' => '',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
                  'category' => '', 
            'category_direction' => ''
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
                 ->where('resume.direction', $q['direction'])
         		 ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
       // else
          //  $this->db->where('resume.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();
	}

    public function get_posts_byid($args = null)
    {
        $defaults = array(
            'group' => 'video',
            'category_ids' => array(),
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
                  'category' => '', 
            'category_direction' => ''
        );

        $q = array_merge($defaults, $args);

        $this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
            ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('resume.group', $q['group'])
            ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
       // else
        //    $this->db->where('resume.status !=', 'draft');

        if ( !empty($q['category_ids']) )
            $this->db->where_in('resume.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('resume', $q['limit'], $q['offset'])->result();
    }

	public function get_media_files($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
				 ->order_by('sort_order');

		return $this->db->get('media', $limit, $offset)->result();
	
}
  	public function get_media_category($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
        ->where('is_main', 1)
				 ->order_by('sort_order');

		return $this->db->get('media', $limit, $offset)->result();
	}
  
   public function get_media_category_in($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
        ->like('is_main', 0)
				 ->order_by('sort_order');

		return $this->db->get('media', $limit, $offset)->result();
	}

  
    public function get_media_files_total($id, $limit = 10000, $offset = 0)
    {
        $this->db->from('media')
        ->where('post_id', $id);

        return $this->db->count_all_results();
    }

    public function get_media_bypost($post_id)
    {
        return $this->db->select('url')->get_where('media', array('post_id' => $post_id))->row();
    }

    public function get_posts_main($args = null)
    {
        $defaults = array(
            'group' => 'video',
            'category_ids' => array(),
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
                  'category' => '', 
            'category_direction' => ''            
        );

        $q = array_merge($defaults, $args);

        $this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
            ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('resume.group', $q['group'])
            ->group_by('resume.id');

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
     //   else
//            $this->db->where('resume.status !=', 'draft');

        $this->db->where('resume.carousel', "0");

        if ( !empty($q['category_ids']) )
            $this->db->where_in('resume.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('resume', $q['limit'], $q['offset'])->result();
    }

    /** Sides */
    public function get_slides($args)
    {
        $defaults = array(
            'group' => 'gallery',
            'category_ids' => array(),
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'media.id',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category_direction' => ''            
        );

        $q = array_merge($defaults, $args);

        $this->db->select('resume.*, media.url, media.id media_id, media.created_on create_date')
            ->select('categories.title as category')
            ->join('media', 'resume.id = media.post_id')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('resume.group', $q['group']);

        if ( !empty($q['category_ids']) )
            $this->db->where_in('resume.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
      //  else
       //     $this->db->where('resume.status !=', 'draft');

        $this->db->where('resume.carousel', "1");

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('resume', $q['limit'], $q['offset'])->result();
    }

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('resume', $data);
//                     $this->db->cache_delete_all();
		}
		else
		{
			$this->db->insert('resume', $data);
//            $this->db->cache_delete_all();
			return $this->db->insert_id();
            
		}
	}
  
  public function save_import($data)
	{
		$this->db->insert('resume', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('resume');    	

	
			$this->db->delete('media', array('post_id'=>$id));
//		$this->db->cache_delete_all();
	}

	public function has_alias($alias, $post_id)
	{
		$this->db->where('alias', $alias)
		         ->where('id !=', $post_id);

		return $this->db->get('resume')->row();
	}
  
  public function has_alias_1($title, $alias)
	{
		$this->db->where($title, $alias);		         

		return $this->db->get('users')->row();
	}

  
  public function check_vopros($alias, $post_id)
	{
		$this->db->where('alias', $alias)
		         ->where('id !=', $post_id);

		return $this->db->get('polis')->row();
	}

	public function get_posts_by_parent($category, $order=false, $limit=20000)
	{
		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->order_by('id DESC')
				 ->group_by('resume.id')
				 ->where('categories.parent_id', $category);

        if($order)
        	$this->db->order_by('time','DESC');
        else
        	$this->db->order_by('id','DESC');

		return $this->db->get('resume',$limit)->result();
	}

    //// gallery
    public function get_posts_and_media_files($args)
    {
        $defaults = array(
			'group' => 'gallery',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => '',
			'orderby' => 'media.id',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category_direction' => ''            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, media.id media_id, media.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media', 'resume.id = media.post_id')
                 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
     //   else
//            $this->db->where('resume.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('resume', $q['limit'], $q['offset'])->result();
   }
   
   public function get_posts_and_media_files_alias($args)
    {
        $defaults = array(
			'group' => '',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'media.id',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'alias' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category_direction' => ''            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, media.id media_id, media.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media', 'resume.id = media.post_id')
                 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('resume.group', $q['group'])
                 ->where('resume.alias', $q['alias']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
    //    else
//            $this->db->where('resume.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('resume', $q['limit'], $q['offset'])->result();
   }

   public function total_posts_and_media_files($args)
   {
        $defaults = array(
			'group' => '',
			'category_ids' => array(),
            'status' => '',
            'spec' => '',
            'alias' => ''
		);

        $q = array_merge($defaults, $args);

        $this->db->from('resume')
                 ->join('media', 'resume.id = media.post_id')
                 ->where('resume.group', $q['group']);
             

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
             if(!empty($q['alias']))
            $this->db->where('resume.alias', $q['alias']);
     //   else
//            $this->db->where('resume.status !=', 'draft');

        return $this->db->count_all_results();
   }

    public function get_media_file($media_id)
    {
        return $this->db->select('url')->get_where('media', array('id' => $media_id))->row();
    }

     public function update_views($post_id ,$counter_data) {
            /* $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('resume');*/
             $this->db->query("UPDATE posts SET views = $counter_data+1 WHERE id = $post_id");
             
             
     }

    public function update_rating($post_id){

        $page = $this->db->get('resume', array('id' => $post_id))->row();
        $video_views = $page->rating;
        //var_dump($page);
        $this->db->set('rating', $video_views+1, FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('resume');
    }

    public function get_media_files_by_cat($category) {
        return $this->db->select('id, url')
                        ->where('category', $category)
                        ->order_by('id', 'desc')
                        ->get('media')
                        ->result();
    }

    
    



    public function get_posts_count_not($group, $id) {
	            
            	$this->db->not_like('category_id', $id);
              $this->db->where('group', $group);
                $this->db->where_in('status', 'active');
$this->db->from('resume');
return $this->db->count_all_results();
	}
    
    public function get_posts_count_not_news($group, $id) {
	            
            	$this->db->not_like('id', $id);
              $this->db->where('group', $group);
                $this->db->where_in('status', 'active');
$this->db->from('resume');
return $this->db->count_all_results();
	}
  
  public function search_count($title, $group) {
	            
    //$this->db->where('group', $group);
    
    
    $this->db->like('title', $title);
    $this->db->where('status', 'active');
     $this->db->where_in('group', $group);
    $this->db->from('resume');
  
    return $this->db->count_all_results();

	/*$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.title = '".$title."'                  
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');*/

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
		 $this->db->select('resume.*')                	
                    ->where('resume.category_id', 182)
                    ->where('resume.status', 'active')
                    ->where('resume.group', 'menu');
                      
           return $this->db->get('resume')->result();
	}

	public function get_posts_by_search($search)
	{
		$search = urldecode($search);
        $query = $this->db->query('SELECT * FROM posts WHERE posts.content LIKE "%'.$search.'%" OR posts.title LIKE "%'.$search.'%"')->result();
		/*$this->db->select('resume.*')
				 ->where('group','news')
				 //->where('group','menu')
				 //->where('group','projects')
				 ->where('content LIKE "%'.$search.'%"')
				 ->order_by('id DESC');

		$result = $this->db->get('resume')->result();*/
  /*  $search = urldecode($search);
		$this->db->select('resume.*, posts.group as pgroup, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('group','news')
				 ->where('group','menu')
				 //->where('group','projects')
				 ->where('resume.content LIKE "%'.$search.'%" OR posts.title LIKE "%'.$search.'%"')
				 ->order_by('resume.id DESC');
		
		$result = $this->db->get('resume')->result();
		return $result;
    */
    
		return $query;
	}
  
  	public function get_posts_u_by_search($search)
	{
		$search = urldecode($search);
        $query = $this->db->query('SELECT * FROM posts_u WHERE posts_u.content LIKE "%'.$search.'%" OR posts_u.title LIKE "%'.$search.'%"')->result();
		
    
		return $query;
	}
  
  public function get_media_files_poster($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
				 ->order_by('sort_order');

		return $this->db->get('media_poster', $limit, $offset)->result();
	
}
          public function search_posts($args)
    {
      
      		$defaults = array(
			'group' => '',
            'group_array' => array(),
      'title' => '',
      'content' => '',
      'group1' => '',
      'group2' => '',
			'category_ids' => array(),     
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category' => '',             
            'sort_order' => '',   
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias');
				 $this->db->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left');
				 $this->db->join('categories', 'categories.category_id = posts.category_id', 'left');
              foreach($q['group_array'] as $value){
           $this->db->where_not_in('resume.group', $value); 
               // print_r($value);
                 }
		   //foreach($q['group_array'] as $value){
          //  $this->db->where('resume.group', $value); 
           
                // }
               // $this->db->where('resume.group', 'menu');
                       // $this->db->where('resume.group', 'news');
                  $this->db->like('resume.title', $q['title']);
                  $this->db->or_like('resume.content', $q['content']);
                  foreach($q['group_array'] as $value){
           $this->db->not_like('resume.group', $value); 
               // print_r($value);
                 }
                  
                  
                  
                  //$this->db->or_like('resume.group', 'menu'); 
                  //$this->db->or_like('resume.group', 'news');
                  //$this->db->where_not_in('resume.group', 'pages');
                  //$this->db->where_not_in('resume.group', 'slides');
                      
                 $this->db->group_by('resume.id');
         
         if ( !empty($q['group1']) ){
          $this->where_in('resume.group', $q['group1']);
          }
            if ( !empty($q['group2']) ){
          $this->where_in('resume.group', $q['group2']);
          }

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
        if(!empty($q['spec']))
            $this->db->where_in('resume.spec', $q['spec']);
       /* else
            $this->db->where('resume.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();

   }
    /*  public function search_posts($args)
    {
      
      		$defaults = array(
			'group' => '',
            'group_array' => array(),
      'title' => '',
      'content' => '',
      'group1' => '',
      'group2' => '',
			'category_ids' => array(),     
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'sort_order',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category' => '',             
            'sort_order' => '',   
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias');
				 $this->db->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left');
				 $this->db->join('categories', 'categories.category_id = posts.category_id', 'left');
              
		   foreach($q['group_array'] as $value){
          //  $this->db->where('resume.group', $value); 
           
                 }
               // $this->db->where('resume.group', 'menu');
                       // $this->db->where('resume.group', 'news');
                  $this->db->like('resume.title', $q['title']);
                  $this->db->or_like('resume.content', $q['content']);
                  $this->db->where_not_in('resume.group', 'pages');
                      
                 $this->db->group_by('resume.id');
         
         if ( !empty($q['group1']) ){
          $this->where_in('resume.group', $q['group1']);
          }
            if ( !empty($q['group2']) ){
          $this->where_in('resume.group', $q['group2']);
          }

        if(!empty($q['status']))
            $this->db->where('resume.status', $q['status']);
        if(!empty($q['spec']))
            $this->db->where_in('resume.spec', $q['spec']);
       /* else
            $this->db->where('resume.status !=', 'draft');*/

	/*	if ( !empty($q['category_ids']) )
			$this->db->where_in('resume.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('resume', $q['limit'], $q['offset'])->result();

   }
  */
  
  public function get_article($alias)
	{
		$this->db->select('resume.*, media.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('resume.alias', $alias)
				 ->order_by('id DESC')
				 ->group_by('resume.id');
				 
		$result = $this->db->get('resume')->row();
		
		if (count($result) > 0)
			return $result;
		else
			return show_404();
	}
  
  public function get_count($id)
    {
        $this->db->select('resume.views')
            ->where('resume.id', $id);

        return $this->db->get('resume')->row();
    }
    public function get_media_by_type($id, $type) {
        return $this->db->select('*')
            ->where('post_id', $id)
            ->where('media_type', $type)
            ->get('media')->row();
    }
    	public function get_posts_popular($args = null)
	{
      $defaults = array(
      'group' => 'video',
      'category_ids' => array(),     
      'limit' => 10000,
      'offset' => 0,
      'order' => 'DESC',
      'orderby' => '',
      'status' => '',
      'spec' => '',
      'direction' => '',
      'spec_type' => '',
      'keywords' => '',
      'description' => '',
      'meta_title' => '',
      'category' => '', 
      'spec' => '',              
      'category_direction' => ''
      
      );
      
      $q = array_merge($defaults, $args);
      
      $this->db->select('resume.*, media.url, categories.title as category, categories.alias as category_alias')
      ->join('media', 'resume.id = media.post_id AND media.is_main = \'1\'', 'left')
      ->join('categories', 'categories.category_id = posts.category_id', 'left')
      ->where('resume.group', $q['group'])
      ->group_by('resume.id');
      
      if(!empty($q['status']))
      $this->db->where('resume.status', $q['status']);
      
      if ( !empty($q['category_ids']) )
      $this->db->where_in('resume.category_id', $q['category_ids']);
      
      if ( !empty($q['orderby']) )
      $this->db->order_by($q['orderby'], $q['order']);
      
      if ($date = $this->input->get('date')) {
        $this->db->where('time >=', $date.' 00:00:00')
         ->where('time <=', $date.' 23:59:59');
      }
      
      return $this->db->get('resume', $q['limit'], $q['offset'])->result();
}
	public function delete_img_url($img, $group)
	{
			@unlink( "./uploads/$group/{$img}" );
		}
        
         public function save_sort_order($data, $id)
	{
	
			$this->db->where('id', $id)
					 ->update('resume', $data);
		
		
	}
     public function get_visitor_mobile()
    {
        return $this->db->select('mobile')
                        ->where('status', 'mobile')
                        ->limit(10000, 0)
                        ->order_by('id', 'desc')
                        ->get('visitors_log')
                        ->result();    
    }
	public function get_visitor_main()
    {
        return $this->db->select('*')                        
                        ->limit(5000, 0)
                        ->order_by('id', 'desc')
                        ->get('visitors_log')
                        ->result();    
    }
    
    public function get_visitors() // 30 minut ichidagi akvit userlar
    {
        $this->db->where('datetime > DATE_SUB(NOW(), INTERVAL 30 MINUTE) AND datetime < NOW()')
             ->group_by('ip');
        return $this->db->get('visitors_log')->result_array();
        //SELECT * FROM (`visitors_log`) WHERE `datetime` > DATE_SUB(NOW() , INTERVAL 30 MINUTE) AND `datetime` < NOW()
    }
}
?>