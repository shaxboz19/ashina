<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Posts2_model extends CI_Model
{
	public function get($id, $status = false) {
		$this->db->select('posts2.*, media2.url')
		         ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
		        // ->join('categories', 'posts2.category_id = categories.category_id', 'left')
		         ->where('posts2.id', $id);
        if($status)
            $this->db->where('posts2.status', $status);

		return $this->db->get('posts2')->row();
	}
   public function save_option_1($data_option_1, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('posts2', $data_option_1);
		
	
	}
   public function save_category_title($data_category_title, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('posts2', $data_category_title);
		
	
	}
      public function get_posts_year($group,  $date1, $category = FALSE, $limit=500, $offset=0)
    {
       $this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts2.group', $group)
           // ->like('posts2.category_id', 17)
            ->where('status', 'active')
            ->where('YEAR(posts.created_on)', $date1)
            
            
            ->order_by('posts2.sort_order DESC')

           
           ->group_by('posts2.id');
        
        return $this->db->get('posts2', $limit, $offset)->result();
    }
  public function get_second($id)
	{
		$this->db->select('posts2.*, media2.url, categories.alias AS category')
		         ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'0\'', 'left')
		         ->join('categories', 'posts2.category_id = categories.category_id', 'left')
		         ->where('posts2.id', $id);

		return $this->db->get('posts2')->row();
	}
  public function get_id_by_category($group=false,$category)
    {
        $this->db->select('id, title');
        if($group)
        {
            $this->db->where('group',$group);
        }
        $this->db->where('category_id',$category);
        $post =$this->db->get('posts2')->result();
        if ($post)
            return $post;
        else
            return false;
    }
	public function get_id($alias)
	{
		$post = $this->db->get_where('posts2', array('alias'=>$alias))->row();

		if ($post)
			return $post->id;
		else
			return show_404();
	}
    public function get_id_option($option)
	{
		$category = $this->db->get_where('posts2', array('options'=>$option))->row();

		if ($category)
			return $category->id;
		else
			return null;
	}
    
    public function get_id_options($alias)
	{
		$post = $this->db->get_where('posts2', array('options'=>$alias))->row();

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
		$this->db->select('posts2.*, media2.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts2.group', $group)
				 //->where('status', 'active')
				 ->order_by('id DESC')
				 ->group_by('posts2.id');

		if ($category)
			$this->db->where('posts2.category_id', $category);

		return $this->db->get('posts2', $limit, $offset)->result();
	}
    
    	public function get_posts_city_1($group, $category=FALSE, $limit=200, $offset=0)
	{
		$this->db->select('posts2.*, media2.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts2.group', $group)
				 ->where('status', 'active')
				 ->order_by('id ASC')
				 ->group_by('posts2.id');

		if ($category)
			$this->db->where('posts2.category_id', $category);

		return $this->db->get('posts2', $limit, $offset)->result();
	}

    public function get_posts_byID_portfolio($id)
    {
        $this->db->select('posts2.*')
                 ->where('posts2.id', $id);
        return $this->db->get('posts2')->row_array();
    } 
    
    public function get_posts_date($group, $date1, $date2, $category = FALSE, $limit=500, $offset=0)
    {
       $this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts2.group', $group)
            ->where('status', 'active')
            ->where('posts2.created_on >', $date1)
            ->where('posts2.created_on <', $date2)
           ->group_by('posts2.id');
        
        return $this->db->get('posts2', $limit, $offset)->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
         ->where('posts2.option', $q['option'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
      ///else
         //   $this->db->where('posts2.status !=', 'draft');

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
         ->where('posts2.'.$q['status_popular'].'', $q['option'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
      ///else
         //   $this->db->where('posts2.status !=', 'draft');

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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
            'tags' => '',           
            'category_direction' => '',
            'category_status' => '',
            'status_lang_'.@LANG => '',
            'status_check_lang' => '', 
            'media' => 'active',  
            'filter' => '',         
		);

		$q = array_merge($defaults, $args);
        	if ($q['media'] == 'active' ){
		$this->db->select('posts2.*, media2.url')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->where('posts2.group', $q['group'])
        // ->where('posts2.category_id', $q['category_id'])
				 ->group_by('posts2.id');
        }else{
            	$this->db->select('posts2.*')
				 ->where('posts2.group', $q['group'])
        // ->where('posts2.category_id', $q['category_id'])
				 ->group_by('posts2.id');
        }

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
            
            if(!empty($q['option']))
            $this->db->where('posts2.option', $q['option']);
            
             if ( !empty($q['lang_status']) )
			$this->db->where_in('posts2.lang_status', $q['lang_status']);
            
             if ( !empty($q['category_status']) )
			$this->db->where('posts2.category_status', $q['category_status']);
            
            if ( !empty($q['status1']) )
			$this->db->where_in('posts2.status1', $q['status1']);
            
             if ( !empty($q['filter']) ){
                foreach($q['filter'] as $key => $val){
                if($key == 'city_id' || $key == 'region_id' || $key == 'title' || $key == 'category_id'){                
    			     $this->db->like('posts2.'.$key, $val);
                }
              }
            }
            /* LANG */
             if(!empty($q['status_lang_'.@LANG]))
            $this->db->where('posts2.status_lang_'.@LANG, $q['status_lang_'.@LANG]);
        
            /**/
            
        /*else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts2.id', $q['id']);
        if (!empty($q['tags'])) {
			$this->db->where('find_in_set("'.(int)$q['tags'].'", posts.tags)');
		            
        }
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
      if ( !empty($q['not_like']) )
			$this->db->not_like('posts2.id', $q['not_like']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
	}
    
    public function get_posts_by_date($numb, $args = null)
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
        $date_arr = date_parse(date('Y-m-d'));
        if( $date_arr['month']>2 )
            $month = $date_arr['month']-$numb;
        elseif($date_arr['month']==2)
            $month = 2;
        elseif($date_arr['month']==1)    
            $month = 1;
            
		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
         ->where('MONTH(posts.created_on)',$month)
				 ->group_by('posts2.id');
//select MONTH(NOW())-1
        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
            
        if ( !empty($q['lang_status']) )
			$this->db->where_in('posts2.lang_status', $q['lang_status']);
            
        if ( !empty($q['status1']) )
			$this->db->where_in('posts2.status1', $q['status1']);

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);
      
        if ( !empty($q['id']) )
    		$this->db->where_in('posts2.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
        if ( !empty($q['not_like']) )
			$this->db->not_like('posts2.id', $q['not_like']);

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
        // ->where('posts2.category_id', $q['category_id'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
        /*else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts2.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
         ->join('users_meta', 'users_meta.post_id = posts.id AND users_meta.user_id = "'.$q['user_id'].'"', 'left')
				 ->where('posts2.group', $q['group'])
        // ->where('posts2.category_id', $q['category_id'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
        /*else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts2.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group']);
         //->like('posts2.title')
        // ->where('posts2.category_id', $q['category_id'])
				// ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
        /*else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts2.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
        // ->where('posts2.category_id', $q['category_id'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
        /*else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts2.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])             
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
        /*else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts2.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts2.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
	}
  
  public function get_posts_public($group, $category=FALSE, $limit=20, $offset=0)
	{
		$this->db->select('posts2.*, media2.url, media2.media_type, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'0\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts2.group', $group)
				 ->order_by('id DESC')
				 ->group_by('posts2.id');
		if ($category)
			$this->db->where('posts2.category_id', $category);

		return $this->db->get('posts2', $limit, $offset)->result();
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

		$this->db->select('posts2.*, media2.url')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				// ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
              if(!empty($q['position_menu']))
            $this->db->where('posts2.position_menu', $q['position_menu']);
        if(!empty($q['spec']))
            $this->db->where_in('posts2.spec', $q['spec']);
       /* else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])     
         ->where('posts2.rec_tour', $q['rec_tour'])  
         ->where('posts2.rec_hotel', $q['rec_hotel'])   
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
       /* else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
                 ->where('posts2.category_direction', $q['category_direction'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
       // else
            //$this->db->where('posts2.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
                 ->where('posts2.spec', $q['spec'])
				 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
      //  else
//            $this->db->where('posts2.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
                 ->where('posts2.direction', $q['direction'])
         		 ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
       // else
          //  $this->db->where('posts2.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

        $this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
            ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts2.group', $q['group'])
            ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
       // else
        //    $this->db->where('posts2.status !=', 'draft');

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts2.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
    }

	public function get_media_files($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
				 ->order_by('sort_order');

		return $this->db->get('media2', $limit, $offset)->result();
	
}
  	public function get_media_category($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
        ->where('is_main', 1)
				 ->order_by('sort_order');

		return $this->db->get('media2', $limit, $offset)->result();
	}
  
   public function get_media_category_in($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
        ->like('is_main', 0)
				 ->order_by('sort_order');

		return $this->db->get('media2', $limit, $offset)->result();
	}

  
    public function get_media_files_total($id, $limit = 10000, $offset = 0)
    {
        $this->db->from('media2')
        ->where('post_id', $id);

        return $this->db->count_all_results();
    }

    public function get_media_bypost($post_id)
    {
        return $this->db->select('url')->get_where('media2', array('post_id' => $post_id))->row();
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

        $this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
            ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts2.group', $q['group'])
            ->group_by('posts2.id');

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
     //   else
//            $this->db->where('posts2.status !=', 'draft');

        $this->db->where('posts2.carousel', "0");

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts2.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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
            'orderby' => 'media2.id',
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

        $this->db->select('posts2.*, media2.url, media2.id media_id, media2.created_on create_date')
            ->select('categories.title as category')
            ->join('media2', 'posts2.id = media2.post_id')
            ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts2.group', $q['group']);

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts2.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
      //  else
       //     $this->db->where('posts2.status !=', 'draft');

        $this->db->where('posts2.carousel', "1");

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
    }

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('posts2', $data);
		}
		else
		{
			$this->db->insert('posts2', $data);

			return $this->db->insert_id();
		}
	}
  
  public function save_import($data)
	{
		$this->db->insert('posts2', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('posts2');    	

	
			$this->db->delete('media2', array('post_id'=>$id));
		
	}

	public function has_alias($alias, $post_id)
	{
		$this->db->where('alias', $alias)
		         ->where('id !=', $post_id);

		return $this->db->get('posts2')->row();
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
		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias')
				 ->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->order_by('id DESC')
				 ->group_by('posts2.id')
				 ->where('categories.parent_id', $category);

        if($order)
        	$this->db->order_by('time','DESC');
        else
        	$this->db->order_by('id','DESC');

		return $this->db->get('posts2',$limit)->result();
	}

    //// gallery
    public function get_posts_and_media_files($args)
    {
        $defaults = array(
			'group' => 'gallery',
			'category_ids' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => '',
			'orderby' => 'media2.id',
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

		$this->db->select('posts2.*, media2.url, media2.id media_id, media2.created_on create_date')
                // ->select('categories.title as category')
				 ->join('media2', 'posts2.id = media2.post_id')
                 //->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
     //   else
//            $this->db->where('posts2.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
   }
   
   public function get_posts_and_media_files_alias($args)
    {
        $defaults = array(
			'group' => '',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'media2.id',
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

		$this->db->select('posts2.*, media2.url, media2.id media_id, media2.created_on create_date')
                 //->select('categories.title as category')
				 ->join('media2', 'posts2.id = media2.post_id')
                 //->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts2.group', $q['group'])
                 ->where('posts2.alias', $q['alias']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
    //    else
//            $this->db->where('posts2.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts2', $q['limit'], $q['offset'])->result();
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

        $this->db->from('posts2')
                 ->join('media2', 'posts2.id = media2.post_id')
                 ->where('posts2.group', $q['group']);
             

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
             if(!empty($q['alias']))
            $this->db->where('posts2.alias', $q['alias']);
     //   else
//            $this->db->where('posts2.status !=', 'draft');

        return $this->db->count_all_results();
   }

    public function get_media_file($media_id)
    {
        return $this->db->select('url')->get_where('media2', array('id' => $media_id))->row();
    }

     public function update_views($post_id ,$counter_data) {
            /* $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('posts2');*/
             $this->db->query("UPDATE posts SET views = $counter_data+1 WHERE id = $post_id");
             
             
     }

    public function update_rating($post_id){

        $page = $this->db->get('posts2', array('id' => $post_id))->row();
        $video_views = $page->rating;
        //var_dump($page);
        $this->db->set('rating', $video_views+1, FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts2');
    }

    public function get_media_files_by_cat($category) {
        return $this->db->select('id, url')
                        ->where('category', $category)
                        ->order_by('id', 'desc')
                        ->get('media2')
                        ->result();
    }

    
    



    public function get_posts_count_not($group, $id) {
	            
            	$this->db->not_like('category_id', $id);
              $this->db->where('group', $group);
                $this->db->where_in('status', 'active');
$this->db->from('posts2');
return $this->db->count_all_results();
	}
  
  public function search_count($title, $group) {
	            
    //$this->db->where('group', $group);
    
    
    $this->db->like('title', $title);
    $this->db->where('status', 'active');
     $this->db->where_in('group', $group);
    $this->db->from('posts2');
  
    return $this->db->count_all_results();

	/*$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.title = '".$title."'                  
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');*/

	}
    
public function search_count_filter($title) {
        
         foreach($title as $key => $val){
    if($key == 'region_id' || $key == 'title' || $key == 'city_id' || $key == 'region_id'){
           
	$this->db->like('posts2.'.$key, $val);
    }
            }
    
    $this->db->where('status', 'active');
    $this->db->where('status_lang_'.@LANG, 'active');
    $this->db->from('posts2');
  
    return $this->db->count_all_results();

	}
  
  public function get_posts_count($group = 'pages') {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts2 AS p
            WHERE p.group = '".$group."'             
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');
	}
  
  public function get_posts_count_admin($group = 'pages') {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts2 AS p
            WHERE p.group = '".$group."'
            AND p.id";
            return $this->db->query($sql)->row('count');
	}

	    public function count_category($group = false, $id = false) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts2 AS p
            WHERE p.group = '".$group."'
            AND p.status = 'active'
            AND p.category_id = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
    
    	    public function gallery_menu() {
		 $this->db->select('posts2.*')                	
                    ->where('posts2.category_id', 182)
                    ->where('posts2.status', 'active')
                    ->where('posts2.group', 'menu');
                      
           return $this->db->get('posts2')->result();
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

		$this->db->select('posts2.*, media2.url, categories.title as category, categories.alias as category_alias');
				 $this->db->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left');
				 $this->db->join('categories', 'categories.category_id = posts.category_id', 'left');
              foreach($q['group_array'] as $value){
           $this->db->where_not_in('posts2.group', $value);
               // print_r($value);
                 }
		   //foreach($q['group_array'] as $value){
          //  $this->db->where('posts2.group', $value); 
           
                // }
               // $this->db->where('posts2.group', 'menu');
                       // $this->db->where('posts2.group', 'news');
                  $this->db->like('posts2.title', $q['title']);
                  $this->db->or_like('posts2.content', $q['content']);
                  foreach($q['group_array'] as $value){
           $this->db->not_like('posts2.group', $value); 
               // print_r($value);
                 }
                  
                  
                  
                  //$this->db->or_like('posts2.group', 'menu'); 
                  //$this->db->or_like('posts2.group', 'news');
                  //$this->db->where_not_in('posts2.group', 'pages');
                  //$this->db->where_not_in('posts2.group', 'slides');
                      
                 $this->db->group_by('posts2.id');
         
         if ( !empty($q['group1']) ){
          $this->where_in('posts2.group', $q['group1']);
          }
            if ( !empty($q['group2']) ){
          $this->where_in('posts2.group', $q['group2']);
          }

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
        if(!empty($q['spec']))
            $this->db->where_in('posts2.spec', $q['spec']);
       /* else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();

   }
   
  
  
  public function get_count($id)
    {
        $this->db->select('posts2.views')
            ->where('posts2.id', $id);

        return $this->db->get('posts2')->row();
    }
    public function get_media_by_type($id, $type) {
        return $this->db->select('*')
            ->where('post_id', $id)
            ->where('media2_type', $type)
            ->get('media2')->row();
    }
    
	public function delete_img_url($img, $group)
	{
			@unlink( "./uploads/$group/{$img}" );
		}
        
         public function save_sort_order($data, $id)
	{
	
			$this->db->where('id', $id)
					 ->update('posts2', $data);
		
		
	}
  
       
    public function search_param($args)
    {
      
      		$defaults = array(
			'group' => '',
            'group_array' => '',
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
            'country_id' => '',
            'city_id' => '',
            'category_direction' => '', 
            'date_creation' => '',
            'option_2' => '',
            'status_shop' => '',
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts2.*, media2.url');
				 $this->db->join('media2', 'posts2.id = media2.post_id AND media2.is_main = \'1\'', 'left');
                 //$this->db->where('posts2.group', $q['group']);
                  //$this->db->like('posts2.title', $q['title']);
                  //$this->db->or_like('posts2.content', $q['content']);
                 /* foreach($q['group_array'] as $value){
           $this->db->not_like('posts2.group', $value); 
               // print_r($value);
                 }*/
              
                      
                 $this->db->group_by('posts2.id');
                 
                  if ( !empty($q['group_array']) ){
                    //foreach($q['group_array'] as $value){
                       $this->db->or_where_in('posts2.group', $q['group_array']); 
                            //print_r($value);
                     //}
                  }
         
         if ( !empty($q['group']) ){
          $this->db->where('posts2.group', $q['group']);
          }
         
         if ( !empty($q['group1']) ){
          $this->db->where_in('posts2.group', $q['group1']);
          }
            if ( !empty($q['group2']) ){
          $this->db->where_in('posts2.group', $q['group2']);
          }

        if(!empty($q['status']))
            $this->db->where('posts2.status', $q['status']);
            
             if ( !empty($q['status_shop']) )
			$this->db->where_in('posts2.status_shop', $q['status_shop']);
        if(!empty($q['spec']))
            $this->db->where_in('posts2.spec', $q['spec']);
       /* else
            $this->db->where('posts2.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts2.category_id', $q['category_ids']);
            
            	if ( !empty($q['country_id']) )
			$this->db->where('posts2.country_id', $q['country_id']);
            
            	if ( !empty($q['city_id']) )
			$this->db->like('posts2.city_id', $q['city_id']);
            
            	if ( !empty($q['date_creation']) )
			$this->db->like('posts2.date_creation', $q['date_creation']);
            
            if ( !empty($q['option_2']) )
			$this->db->like('posts2.option_2', $q['option_2']);
            
            if ( !empty($q['title']) )
			$this->db->like('posts2.title', $q['title']);
            
            
            

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts2', $q['limit'], $q['offset'])->result();

   }
   
    public function count_search_param_all($group, $title) {
       // $group = implode(", ", $group);
        foreach($group as $value){
            $group1[] = "'$value'";
        }
        $group = implode(", ", $group1);;
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts2 AS p
            WHERE p.group  IN (".$group.")    
            AND p.status = 'active'                    
            AND p.title  LIKE '%$title%'";
           // echo $sql;
            return $this->db->query($sql)->row('count');
            // SELECT * FROM `posts` WHERE `group` LIKE 'product' AND `title` LIKE '%Темн%'   
            // SELECT * FROM `posts` WHERE `group` BETWEEN 'author' AND 'product' AND `title` LIKE '%Кинг%'
            
	}
    
    	public function count_categoryLang($group = false, $lang, $id = false) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts2 AS p
            WHERE p.group = '".$group."'
            AND p.status = 'active'
			AND p.status_lang_".$lang." = 'active'
            AND p.category_id = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
	
	public function get_posts_countLang($group = 'pages', $lang) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts2 AS p
            WHERE p.group = '".$group."' 
			AND p.status_lang_".$lang." = 'active'            
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');
	}
    
     public function count_posts_category_admin($category_id, $group)
    {
        	$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts2 AS p
            WHERE p.group = '".$group."'       
            AND p.category_id = '$category_id' ";
            return $this->db->query($sql)->row('count');
    }
}