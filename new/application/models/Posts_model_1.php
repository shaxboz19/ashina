<?php

Class Posts_model extends CI_Model
{
	public function get($id, $status = false) {
		$this->db->select('posts.*, media.url, categories.alias AS category')
		         ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
		         ->join('categories', 'posts.category_id = categories.category_id', 'left')
		         ->where('posts.id', $id);
        if($status)
            $this->db->where('posts.status', $status);

		return $this->db->get('posts')->row();
	}
   public function save_option_1($data_option_1, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('posts', $data_option_1);
		
	
	}
   public function save_category_title($data_category_title, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('posts', $data_category_title);
		
	
	}
  public function get_second($id)
	{
		$this->db->select('posts.*, media.url, categories.alias AS category')
		         ->join('media', 'posts.id = media.post_id AND media.is_main = \'0\'', 'left')
		         ->join('categories', 'posts.category_id = categories.category_id', 'left')
		         ->where('posts.id', $id);

		return $this->db->get('posts')->row();
	}
  public function get_id_by_category($group=false,$category)
    {
        $this->db->select('id, title');
        if($group)
        {
            $this->db->where('group',$group);
        }
        $this->db->where('category_id',$category);
        $post =$this->db->get('posts')->result();
        if ($post)
            return $post;
        else
            return false;
    }
	public function get_id($alias)
	{
		$post = $this->db->get_where('posts', array('alias'=>$alias))->row();

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
		$this->db->select('posts.*, media.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts.group', $group)
				 //->where('status', 'active')
				 ->order_by('id DESC')
				 ->group_by('posts.id');

		if ($category)
			$this->db->where('posts.category_id', $category);

		return $this->db->get('posts', $limit, $offset)->result();
	}
    
    	public function get_posts_city_1($group, $category=FALSE, $limit=200, $offset=0)
	{
		$this->db->select('posts.*, media.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts.group', $group)
				 ->where('status', 'active')
				 ->order_by('id ASC')
				 ->group_by('posts.id');

		if ($category)
			$this->db->where('posts.category_id', $category);

		return $this->db->get('posts', $limit, $offset)->result();
	}

    public function get_posts_byID_portfolio($id)
    {
        $this->db->select('posts.*')
                 ->where('posts.id', $id);
        return $this->db->get('posts')->row_array();
    } 
    
    public function get_posts_date($group, $date1, $date2, $category = FALSE, $limit=500, $offset=0)
    {
       $this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts.group', $group)
            ->where('status', 'active')
            ->where('posts.created_on >', $date1)
            ->where('posts.created_on <', $date2)
           ->group_by('posts.id');
        
        return $this->db->get('posts', $limit, $offset)->result();
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
         ->where('posts.option', $q['option'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
      ///else
         //   $this->db->where('posts.status !=', 'draft');

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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
			'orderby' => 'id',
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

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
         ->where('posts.'.$q['status_popular'].'', $q['option'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
      ///else
         //   $this->db->where('posts.status !=', 'draft');

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
      if ( !empty($q['not_like']) )
			$this->db->not_like('posts.id', $q['not_like']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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
              'user_id' => '',
             'sort_order' => '',           
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
         ->join('users_meta', 'users_meta.post_id = posts.id AND users_meta.user_id = "'.$q['user_id'].'"', 'left')
				 ->where('posts.group', $q['group'])
        // ->where('posts.category_id', $q['category_id'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group']);
         //->like('posts.title')
        // ->where('posts.category_id', $q['category_id'])
				// ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])             
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}
  
  public function get_posts_public($group, $category=FALSE, $limit=20, $offset=0)
	{
		$this->db->select('posts.*, media.url, media.media_type, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'0\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts.group', $group)
				 ->order_by('id DESC')
				 ->group_by('posts.id');
		if ($category)
			$this->db->where('posts.category_id', $category);

		return $this->db->get('posts', $limit, $offset)->result();
	}

	public function get_posts($args = null)
	{
		$defaults = array(
			'group' => 'video',
			'category_ids' => array(),     
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
            'sort_order' => '',   
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
        if(!empty($q['spec']))
            $this->db->where_in('posts.spec', $q['spec']);
       /* else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}
  
  
  public function get_posts_rec($args = null)
	{
		$defaults = array(
			'group' => 'video',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
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

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])     
         ->where('posts.rec_tour', $q['rec_tour'])  
         ->where('posts.rec_hotel', $q['rec_hotel'])   
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
       /* else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}


    	public function get_category_direction($args = null)
	{
		$defaults = array(
			'group' => 'video',
			'category_ids' => array(),
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
                 ->where('posts.category_direction', $q['category_direction'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
       // else
            //$this->db->where('posts.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}



    	public function get_posts_spec($args = null)
	{
		$defaults = array(
			'group' => '',
			'category_ids' => array(),
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
            'category_direction' => ''
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
                 ->where('posts.spec', $q['spec'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
      //  else
//            $this->db->where('posts.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}

	    	public function get_posts_direction($args = null)
	{
		$defaults = array(
			'group' => '',
			'category_ids' => array(),
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
            'category_direction' => ''
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
                 ->where('posts.direction', $q['direction'])
         		 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
       // else
          //  $this->db->where('posts.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}

    public function get_posts_byid($args = null)
    {
        $defaults = array(
            'group' => 'video',
            'category_ids' => array(),
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
            'category_direction' => ''
        );

        $q = array_merge($defaults, $args);

        $this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
            ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts.group', $q['group'])
            ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
       // else
        //    $this->db->where('posts.status !=', 'draft');

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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
            'orderby' => 'id',
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

        $this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
            ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts.group', $q['group'])
            ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
     //   else
//            $this->db->where('posts.status !=', 'draft');

        $this->db->where('posts.carousel', "0");

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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

        $this->db->select('posts.*, media.url, media.id media_id, media.created_on create_date')
            ->select('categories.title as category')
            ->join('media', 'posts.id = media.post_id')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts.group', $q['group']);

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
      //  else
       //     $this->db->where('posts.status !=', 'draft');

        $this->db->where('posts.carousel', "1");

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts', $q['limit'], $q['offset'])->result();
    }

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('posts', $data);
		}
		else
		{
			$this->db->insert('posts', $data);

			return $this->db->insert_id();
		}
	}
  
  public function save_import($data)
	{
		$this->db->insert('posts', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('posts');    	

	
			$this->db->delete('media', array('post_id'=>$id));
		
	}

	public function has_alias($alias, $post_id)
	{
		$this->db->where('alias', $alias)
		         ->where('id !=', $post_id);

		return $this->db->get('posts')->row();
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
		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->order_by('id DESC')
				 ->group_by('posts.id')
				 ->where('categories.parent_id', $category);

        if($order)
        	$this->db->order_by('time','DESC');
        else
        	$this->db->order_by('id','DESC');

		return $this->db->get('posts',$limit)->result();
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

		$this->db->select('posts.*, media.url, media.id media_id, media.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media', 'posts.id = media.post_id')
                 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
     //   else
//            $this->db->where('posts.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts.*, media.url, media.id media_id, media.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media', 'posts.id = media.post_id')
                 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
                 ->where('posts.alias', $q['alias']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
    //    else
//            $this->db->where('posts.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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

        $this->db->from('posts')
                 ->join('media', 'posts.id = media.post_id')
                 ->where('posts.group', $q['group']);
             

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
             if(!empty($q['alias']))
            $this->db->where('posts.alias', $q['alias']);
     //   else
//            $this->db->where('posts.status !=', 'draft');

        return $this->db->count_all_results();
   }

    public function get_media_file($media_id)
    {
        return $this->db->select('url')->get_where('media', array('id' => $media_id))->row();
    }

     public function update_views($post_id ,$counter_data) {
            /* $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('posts');*/
             $this->db->query("UPDATE posts SET views = $counter_data+1 WHERE id = $post_id");
             
             
     }

    public function update_rating($post_id){

        $page = $this->db->get('posts', array('id' => $post_id))->row();
        $video_views = $page->rating;
        //var_dump($page);
        $this->db->set('rating', $video_views+1, FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts');
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
$this->db->from('posts');
return $this->db->count_all_results();
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

	public function get_posts_by_search($search)
	{
		$search = urldecode($search);
        $query = $this->db->query('SELECT * FROM posts WHERE posts.content LIKE "%'.$search.'%" OR posts.title LIKE "%'.$search.'%"')->result();
		/*$this->db->select('posts.*')
				 ->where('group','news')
				 //->where('group','menu')
				 //->where('group','projects')
				 ->where('content LIKE "%'.$search.'%"')
				 ->order_by('id DESC');

		$result = $this->db->get('posts')->result();*/
  /*  $search = urldecode($search);
		$this->db->select('posts.*, posts.group as pgroup, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('group','news')
				 ->where('group','menu')
				 //->where('group','projects')
				 ->where('posts.content LIKE "%'.$search.'%" OR posts.title LIKE "%'.$search.'%"')
				 ->order_by('posts.id DESC');
		
		$result = $this->db->get('posts')->result();
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
      'title' => '',
      'content' => '',
      'group1' => '',
      'group2' => '',
			'category_ids' => array(),     
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
            'sort_order' => '',   
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
         ->like('posts.title', $q['title'])
         //->or_like('posts.content', $q['content'])
				 ->group_by('posts.id');
         
         if ( !empty($q['group1']) ){
          $this->where_in('posts.group', $q['group1']);
          }
            if ( !empty($q['group2']) ){
          $this->where_in('posts.group', $q['group2']);
          }

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
        if(!empty($q['spec']))
            $this->db->where_in('posts.spec', $q['spec']);
       /* else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();

   }
  
  
  public function get_article($alias)
	{
		$this->db->select('posts.*, media.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts.alias', $alias)
				 ->order_by('id DESC')
				 ->group_by('posts.id');
				 
		$result = $this->db->get('posts')->row();
		
		if (count($result) > 0)
			return $result;
		else
			return show_404();
	}
  
  public function get_count($id)
    {
        $this->db->select('posts.views')
            ->where('posts.id', $id);

        return $this->db->get('posts')->row();
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
      
      $this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
      ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
      ->join('categories', 'categories.category_id = posts.category_id', 'left')
      ->where('posts.group', $q['group'])
      ->group_by('posts.id');
      
      if(!empty($q['status']))
      $this->db->where('posts.status', $q['status']);
      
      if ( !empty($q['category_ids']) )
      $this->db->where_in('posts.category_id', $q['category_ids']);
      
      if ( !empty($q['orderby']) )
      $this->db->order_by($q['orderby'], $q['order']);
      
      if ($date = $this->input->get('date')) {
        $this->db->where('time >=', $date.' 00:00:00')
         ->where('time <=', $date.' 23:59:59');
      }
      
      return $this->db->get('posts', $q['limit'], $q['offset'])->result();
}
	public function delete_img_url($img, $group)
	{
			@unlink( "./uploads/$group/{$img}" );
		}
        
         public function save_sort_order($data, $id)
	{
	
			$this->db->where('id', $id)
					 ->update('posts', $data);
		
		
	}
}