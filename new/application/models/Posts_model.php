<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Posts_model extends CI_Model
{
	public function get($id, $status = false) {
		$this->db->select('posts.*, media.url')
		         ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
		        // ->join('categories', 'posts.category_id = categories.category_id', 'left')
		         ->where('posts.id', $id);
        if($status)
            $this->db->where('posts.status', $status);

		return $this->db->get('posts')->row();
	}
    
       public function get_id_all($alias)
	{
	   	$this->db->select('posts.*, media.url')
		         ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
		        // ->join('categories', 'posts.category_id = categories.category_id', 'left')
		         ->where('posts.alias', $alias);
      
		$post = $this->db->get('posts')->row();
        
        if ($post)
			return $post;
		else
			return show_404();
	
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
      public function get_posts_year($group,  $date1, $category = FALSE, $limit=500, $offset=0)
    {
       $this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts.group', $group)
           // ->like('posts.category_id', 17)
            ->where('status', 'active')
            ->where('YEAR(posts.created_on)', $date1)
            
            
            ->order_by('posts.sort_order DESC')

           
           ->group_by('posts.id');
        
        return $this->db->get('posts', $limit, $offset)->result();
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
    public function get_id_option($option)
	{
		$category = $this->db->get_where('posts', array('options'=>$option))->row();

		if ($category)
			return $category->id;
		else
			return null;
	}
    
    public function get_id_options($alias)
	{
		$post = $this->db->get_where('posts', array('options'=>$alias))->row();

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
            'group' => '',
            'group_array' => '',
            //	'category_id' => array(),
            'category_id' => '',
            'category_id2' => '',
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
            'year' => '',       
            'date1' => '',
            'date2' => '',  
            'month' => '',  
            'interval' => '',  
            'media' => 'active',
            'media_all' => 'inactive'       
		);

		$q = array_merge($defaults, $args);

	if ($q['media'] == 'active' ){
		$this->db->select('posts.*, media.url, media.url, media.file_type, media.file_size')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 //->where('posts.group', $q['group'])
        // ->where('posts.category_id', $q['category_id'])
				 ->group_by('posts.id');
        }else{
            $this->db->select('posts.*')->group_by('posts.id');
        }
                 	  if ( !empty($q['group_array']) ){
                    //foreach($q['group_array'] as $value){
                       $this->db->or_where_in('posts.group', $q['group_array']); 
                            //print_r($value);
                     //}
                  }
                  if ( !empty($q['group']) ){
                    //foreach($q['group_array'] as $value){
                       $this->db->or_where_in('posts.group', $q['group']); 
                            //print_r($value);
                     //}
                  }

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
            
            if(!empty($q['option']))
            $this->db->where('posts.option', $q['option']);
            
            if(!empty($q['spec']))
            $this->db->where('posts.spec', $q['spec']);
            
             if ( !empty($q['lang_status']) )
			$this->db->where_in('posts.lang_status', $q['lang_status']);
            
             if ( !empty($q['category_status']) )
			$this->db->where('posts.category_status', $q['category_status']);
            
            if ( !empty($q['status1']) )
			$this->db->where_in('posts.status1', $q['status1']);
            
            
            /* LANG */
             if(!empty($q['status_lang_'.@LANG]))
            $this->db->where('posts.status_lang_'.@LANG, $q['status_lang_'.@LANG]);
         if ( !empty($q['status_check_lang']) )
			$this->db->where_in('posts.status_check_lang', $q['status_check_lang']);
            /**/
            
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
            if ( !empty($q['category_id2']) )
			$this->db->where_in('posts.category_id2', $q['category_id2']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);
        if (!empty($q['tags'])) {
			$this->db->where('find_in_set("'.(int)$q['tags'].'", posts.tags)');
		            
        }
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
      if ( !empty($q['not_like']) )
			$this->db->not_like('posts.id', $q['not_like']);
            
                if ( !empty($q['year']) )
			$this->db->where('YEAR(posts.created_on)', $q['year']);
            
            if ( !empty($q['month']) )
			$this->db->where('MONTH(posts.created_on)', $q['month']);
            
            if(!empty($q['months']))
             $this->db->where('posts.created_on >= now() + interval '.$q['months'].' month');
             if(!empty($q['interval']))
             $this->db->where('date(posts.created_on) >= CURDATE() - interval '.$q['interval'].' day');
             // $this->db->where('date(posts.created_on) BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL '.$q['interval'].' DAY))');
             // ADDDATE(date_out, INTERVAL 7 DAYS)
            
             if(!empty($q['date1']) && !empty($q['date2'])){
             $this->db->where('posts.created_on >=', $q['date1'].' 00:00:00');
            $this->db->where('posts.created_on <=', $q['date2'].' 23:59:59');
            }

		/*if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }*/

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
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
            
		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
         ->where('MONTH(posts.created_on)',$month)
				 ->group_by('posts.id');
//select MONTH(NOW())-1
        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
            
        if ( !empty($q['lang_status']) )
			$this->db->where_in('posts.lang_status', $q['lang_status']);
            
        if ( !empty($q['status1']) )
			$this->db->where_in('posts.status1', $q['status1']);

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

		$this->db->select('posts.*, media.url')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				// ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
				 ->group_by('posts.id');

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
              if(!empty($q['position_menu']))
            $this->db->where('posts.position_menu', $q['position_menu']);
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
			'category_ids' => '',
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
                // ->select('categories.title as category')
				 ->join('media', 'posts.id = media.post_id')
                 //->join('categories', 'categories.category_id = posts.category_id', 'left')
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
                 //->select('categories.title as category')
				 ->join('media', 'posts.id = media.post_id')
                 //->join('categories', 'categories.category_id = posts.category_id', 'left')
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
      public function update_views_order($post_id ,$counter_data) {
            /* $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('posts');*/
             $this->db->query("UPDATE posts SET order = $counter_data+1 WHERE id = $post_id");
             
             
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
    
    public function get_posts_count_spec($group = 'pages', $spec) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group = '".$group."'             
            AND p.spec = '$spec' ";
            return $this->db->query($sql)->row('count');
	}
    
     public function count_posts_category_admin($category_id, $group)
    {
        	$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group = '".$group."'       
            AND p.category_id = '$category_id' ";
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

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias');
				 $this->db->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left');
				 $this->db->join('categories', 'categories.category_id = posts.category_id', 'left');
              foreach($q['group_array'] as $value){
           $this->db->where_not_in('posts.group', $value);
               // print_r($value);
                 }
		   //foreach($q['group_array'] as $value){
          //  $this->db->where('posts.group', $value); 
           
                // }
               // $this->db->where('posts.group', 'menu');
                       // $this->db->where('posts.group', 'news');
                  $this->db->like('posts.title', $q['title']);
                  $this->db->or_like('posts.content', $q['content']);
                  foreach($q['group_array'] as $value){
           $this->db->not_like('posts.group', $value); 
               // print_r($value);
                 }
                  
                  
                  
                  //$this->db->or_like('posts.group', 'menu'); 
                  //$this->db->or_like('posts.group', 'news');
                  //$this->db->where_not_in('posts.group', 'pages');
                  //$this->db->where_not_in('posts.group', 'slides');
                      
                 $this->db->group_by('posts.id');
         
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

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias');
				 $this->db->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left');
				 $this->db->join('categories', 'categories.category_id = posts.category_id', 'left');
              
		   foreach($q['group_array'] as $value){
          //  $this->db->where('posts.group', $value); 
           
                 }
               // $this->db->where('posts.group', 'menu');
                       // $this->db->where('posts.group', 'news');
                  $this->db->like('posts.title', $q['title']);
                  $this->db->or_like('posts.content', $q['content']);
                  $this->db->where_not_in('posts.group', 'pages');
                      
                 $this->db->group_by('posts.id');
         
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

	/*	if ( !empty($q['category_ids']) )
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
  */
  
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

		$this->db->select('posts.*, media.url');
				 $this->db->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left');
                 //$this->db->where('posts.group', $q['group']);
                  //$this->db->like('posts.title', $q['title']);
                  //$this->db->or_like('posts.content', $q['content']);
                 /* foreach($q['group_array'] as $value){
           $this->db->not_like('posts.group', $value); 
               // print_r($value);
                 }*/
              
                      
                 $this->db->group_by('posts.id');
                 
                  if ( !empty($q['group_array']) ){
                    //foreach($q['group_array'] as $value){
                       $this->db->or_where_in('posts.group', $q['group_array']); 
                            //print_r($value);
                     //}
                  }
         
         if ( !empty($q['group']) ){
          $this->db->where('posts.group', $q['group']);
          }
         
         if ( !empty($q['group1']) ){
          $this->db->where_in('posts.group', $q['group1']);
          }
            if ( !empty($q['group2']) ){
          $this->db->where_in('posts.group', $q['group2']);
          }

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
            
             if ( !empty($q['status_shop']) )
			$this->db->where_in('posts.status_shop', $q['status_shop']);
        if(!empty($q['spec']))
            $this->db->where_in('posts.spec', $q['spec']);
       /* else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts.category_id', $q['category_ids']);
            
            	if ( !empty($q['country_id']) )
			$this->db->where('posts.country_id', $q['country_id']);
            
            	if ( !empty($q['city_id']) )
			$this->db->like('posts.city_id', $q['city_id']);
            
            	if ( !empty($q['date_creation']) )
			$this->db->like('posts.date_creation', $q['date_creation']);
            
            if ( !empty($q['option_2']) )
			$this->db->like('posts.option_2', $q['option_2']);
            
            if ( !empty($q['title']) )
			$this->db->like('posts.title', $q['title']);
            if ( !empty($q['content']) )
			$this->db->or_like('posts.content', $q['content']);
            
            

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

	/*	if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }*/

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();

   }
   
   public function get_posts_filter($args = null)
	{
		$defaults = array(
            'group' => 'video',
            'group_array' => '',
            //	'category_id' => array(),
            'category_id' => '',
            'category_id2' => '',
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
            'year' => '',       
            'date1' => '',
            'date2' => '',  
            'month' => '',  
            'interval' => '',  
            'media' => 'active',
            'media_all' => 'inactive',
            'title' => '',
            'content' => '',
            'filter' => '',      
		);

		$q = array_merge($defaults, $args);

	if ($q['media'] == 'active' ){
		$this->db->select('posts.*, media.url')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 //->where('posts.group', $q['group'])
        // ->where('posts.category_id', $q['category_id'])
				 ->group_by('posts.id');
        }else{
            $this->db->select('posts.*')->group_by('posts.id');
        }
                 	  if ( !empty($q['group_array']) ){
                    //foreach($q['group_array'] as $value){
                       $this->db->or_where_in('posts.group', $q['group_array']); 
                            //print_r($value);
                     //}
                  }
                  if ( !empty($q['group']) ){
                    //foreach($q['group_array'] as $value){
                       $this->db->where('posts.group', $q['group']); 
                            //print_r($value);
                     //}
                  }

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
            
            if(!empty($q['option']))
            $this->db->where('posts.option', $q['option']);
            
            if(!empty($q['spec']))
            $this->db->where('posts.spec', $q['spec']);
            
             if ( !empty($q['lang_status']) )
			$this->db->where_in('posts.lang_status', $q['lang_status']);
            
             if ( !empty($q['category_status']) )
			$this->db->where('posts.category_status', $q['category_status']);
            
            if ( !empty($q['status1']) )
			$this->db->where_in('posts.status1', $q['status1']);
            
            
            /* LANG */
             if(!empty($q['status_lang_'.@LANG]))
            $this->db->where('posts.status_lang_'.@LANG, $q['status_lang_'.@LANG]);
             if ( !empty($q['title']) )
            			$this->db->like('posts.title', $q['title']);
                         if ( !empty($q['filter']) ){
                foreach($q['filter'] as $key => $val){
                        if($key == 'address' || $key == 'inn' || $key == 'license' || $key == 'phone'){
                            
                        
            			$this->db->like('posts.content', $val);
                        }
                }
                }
          
        
        
            /**/
            
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
            if ( !empty($q['category_id2']) )
			$this->db->where_in('posts.category_id2', $q['category_id2']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);
        if (!empty($q['tags'])) {
			$this->db->where('find_in_set("'.(int)$q['tags'].'", posts.tags)');
		            
        }
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
      if ( !empty($q['not_like']) )
			$this->db->not_like('posts.id', $q['not_like']);
            
                if ( !empty($q['year']) )
			$this->db->where('YEAR(posts.created_on)', $q['year']);
            
            if ( !empty($q['month']) )
			$this->db->where('MONTH(posts.created_on)', $q['month']);
            
            if(!empty($q['months']))
             $this->db->where('posts.created_on >= now() + interval '.$q['months'].' month');
             if(!empty($q['interval']))
             $this->db->where('date(posts.created_on) >= CURDATE() - interval '.$q['interval'].' day');
             // $this->db->where('date(posts.created_on) BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL '.$q['interval'].' DAY))');
             // ADDDATE(date_out, INTERVAL 7 DAYS)
            
             if(!empty($q['date1']) && !empty($q['date2'])){
             $this->db->where('posts.created_on >=', $q['date1'].' 00:00:00');
            $this->db->where('posts.created_on <=', $q['date2'].' 23:59:59');
            }

		/*if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }*/

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}
   
    public function group_bind($group) {
       // $group = implode(", ", $group);
        foreach($group as $value){
            $group1[] = "'$value'";
        }
        $group = implode(", ", $group1);;
		
			
			$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group  IN (".$group.")    
            AND p.status = 'active'";
            return $this->db->query($sql)->row('count');
            
	}
	
	  public function group_bindReg($group, $lang, $id) {
       // $group = implode(", ", $group);
        foreach($group as $value){
            $group1[] = "'$value'";
        }
        $group = implode(", ", $group1);;
		
			
			$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group  IN (".$group.")    
            AND p.status = 'active'  
			AND p.status_lang_".$lang." = 'active'
            AND p.category_id = ".$id."
			AND p.region_id = ".$this->session->userdata('region_id');
            return $this->db->query($sql)->row('count');
            
	}
   
   
    public function count_search_param_all($group, $title) {
       // $group = implode(", ", $group);
        foreach($group as $value){
            $group1[] = "'$value'";
        }
        $group = implode(", ", $group1);;
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group  IN (".$group.")    
            AND p.status = 'active'                    
            AND p.title  LIKE '%$title%'";
           // echo $sql;
            return $this->db->query($sql)->row('count');
            // SELECT * FROM `posts` WHERE `group` LIKE 'product' AND `title` LIKE '%Темн%'   
            // SELECT * FROM `posts` WHERE `group` BETWEEN 'author' AND 'product' AND `title` LIKE '%Кинг%'
            
	}
    
      public function search_count_posts($title, $lang, $group) {
        
        foreach($title as $key => $val){
         if($key == 'category_id' || $key == 'category_id2' || $key == 'title'){        
            $this->db->like('posts.'.$key, $val);
          }
        }
        
        $this->db->where('status', 'active');
        $this->db->where_in('group', $group);
        $this->db->or_like('status_lang_'.$lang, $lang);
        
        $this->db->from('posts');
        
        return $this->db->count_all_results();

	}
    
    	public function count_categoryLang($group = false, $lang, $id = false) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group = '".$group."'
            AND p.status = 'active'
			AND p.status_lang_".$lang." = 'active'
            AND p.category_id = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
    
    public function count_category2Lang($group = false, $lang, $id = false) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group = '".$group."'
            AND p.status = 'active'
			AND p.status_lang_".$lang." = 'active'
            AND p.category_id2 = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
	
	public function get_posts_countLang($group = 'pages', $lang) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group = '".$group."' 
			AND p.status_lang_".$lang." = 'active'            
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');
	}
    
     public function group_filter_all2($args = null) {
         $defaults = array(
            'group' => 'video',
            'group_array' => '',
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
            'created_on'  => '', 
            'category_plan' => '',   
            'year' => '',       
            'date1' => '',
            'date2' => '',  
            'month' => '',
            'date_array' => '', 
            'title' => '',
            'mincost' => '',
            'maxcost' => '',
            'structure' => '',
            'value_1' => '',
		);

		$q = array_merge($defaults, $args);
       
     
                  if ( !empty($q['group']) ){
                    //foreach($q['group_array'] as $value){
                       $this->db->where('posts.group', $q['group']); 
                            //print_r($value);
                     //}
                  }

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
            
            if(!empty($q['option']))
            $this->db->where('posts.option', $q['option']);
            
             if ( !empty($q['lang_status']) )
			$this->db->where_in('posts.lang_status', $q['lang_status']);
            
             if ( !empty($q['category_status']) )
			$this->db->where('posts.category_status', $q['category_status']);
            
            if ( !empty($q['status1']) )
			$this->db->where_in('posts.status1', $q['status1']);
            
            if(!empty($q['created_on']))
            $this->db->like('posts.created_on', $q['created_on']);
            
              if ( !empty($q['category_plan']) )
			$this->db->where('posts.category_plan', $q['category_plan']);
            
            if ( !empty($q['year']) )
			$this->db->where('YEAR(posts.created_on)', $q['year']);
            
            if ( !empty($q['month']) )
			$this->db->where('MONTH(posts.created_on)', $q['month']);
            
          
            
            if(!empty($q['months']))
             $this->db->where('posts.created_on >= now() + interval '.$q['months'].' month');
             
               if (!empty($q['date_array'])) {
		//	$this->db->where('find_in_set("'.(int)$q['date_array'].'", posts.date_array)');
		     $this->db->like('posts.date_array', $q['date_array']);       
        }
        if ( !empty($q['title']) )
			$this->db->like('posts.title', $q['title']);
            if ( !empty($q['structure']) )
			$this->db->like('posts.structure', $q['structure']);
            /* LANG */
             if(!empty($q['status_lang_'.@LANG]))
            $this->db->where('posts.status_lang_'.@LANG, $q['status_lang_'.@LANG]);
        if(!empty($q['status_check_lang']))
            $this->db->where('posts.status_check_lang', $q['status_check_lang']);
            /**/
            
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);
        if (!empty($q['tags'])) {
			$this->db->where('find_in_set("'.(int)$q['tags'].'", posts.tags)');
		            
        }
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);
      if ( !empty($q['not_like']) )
			$this->db->not_like('posts.id', $q['not_like']);

	/*	if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }*/
        
            if (!empty($q['mincost']) and !empty($q['maxcost'])) {
			$this->db->where('posts.price >=',(int)$q['mincost']);
		    	$this->db->where('posts.price <=',(int)$q['maxcost']);
        }
        
          if(!empty($q['value_1'])){
            $this->db->where_in('posts.value_1', $q['value_1']);
            }
        
          if(!empty($q['date1']) && !empty($q['date2'])){
            $this->db->where('posts.created_on >', $q['date1']);
            $this->db->where('posts.created_on <', $q['date2']);
            }
            
            $this->db->from('posts');
            
            return $this->db->count_all_results();
     }
    
}