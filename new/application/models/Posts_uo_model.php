<?php

Class Posts_uo_model extends CI_Model
{
	public function get($id, $status = false) {
		$this->db->select('posts_u.*, media_u.url, categories.alias AS category')
		         ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
		         ->join('categories', 'posts_u.category_id = categories.category_id', 'left')
		         ->where('posts_u.id', $id);
        if($status)
            $this->db->where('posts_u.status', $status);

		return $this->db->get('posts_u')->row();
	}
   public function save_option_1($data_option_1, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('posts_u', $data_option_1);
		
	
	}
  
  	public function delete_albums_img($img)
	{
	
			@unlink( "./uploads/albums/{$img}" );

			
		}
   public function save_category_title($data_category_title, $id)
	{
		$this->db->where('category_id', $id)
					   ->update('posts_u', $data_category_title);
		
	
	}
  public function get_second($id)
	{
		$this->db->select('posts_u.*, media_u.url, categories.alias AS category')
		         ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'0\'', 'left')
		         ->join('categories', 'posts_u.category_id = categories.category_id', 'left')
		         ->where('posts_u.id', $id);

		return $this->db->get('posts_u')->row();
	}
  public function get_id_by_category($group=false,$category)
    {
        $this->db->select('id, title');
        if($group)
        {
            $this->db->where('group',$group);
        }
        $this->db->where('category_id',$category);
        $post =$this->db->get('posts_u')->result();
        if ($post)
            return $post;
        else
            return false;
    }
	public function get_id($alias)
	{
		$post = $this->db->get_where('posts_u', array('alias'=>$alias))->row();

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
		$this->db->select('posts_u.*, media_u.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts_u.group', $group)
				 //->where('status', 'active')
				 ->order_by('id DESC')
				 ->group_by('posts_u.id');

		if ($category)
			$this->db->where('posts_u.category_id', $category);

		return $this->db->get('posts_u', $limit, $offset)->result();
	}
    
    	public function get_posts_city_1($group, $category=FALSE, $limit=200, $offset=0)
	{
		$this->db->select('posts_u.*, media_u.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts_u.group', $group)
				 ->where('status', 'active')
				 ->order_by('id ASC')
				 ->group_by('posts_u.id');

		if ($category)
			$this->db->where('posts_u.category_id', $category);

		return $this->db->get('posts_u', $limit, $offset)->result();
	}

    public function get_posts_byID_portfolio($id)
    {
        $this->db->select('posts_u.*')
                 ->where('posts_u.id', $id);
        return $this->db->get('posts_u')->row_array();
    } 
    
    public function get_posts_date($group, $date1, $date2, $category = FALSE, $limit=500, $offset=0)
    {
       $this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
            ->where('posts_u.group', $group)
            ->where('status', 'active')
            ->where('posts_u.created_on >', $date1)
            ->where('posts_u.created_on <', $date2)
           ->group_by('posts_u.id');
        
        return $this->db->get('posts_u', $limit, $offset)->result();
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

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
         ->where('posts_u.option', $q['option'])
				 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
      ///else
         //   $this->db->where('posts_u.status !=', 'draft');

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts_u.category_id', $q['category_id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
        // ->where('posts_u.category_id', $q['category_id'])
				 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
        /*else
            $this->db->where('posts_u.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts_u.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts_u.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
         ->not_like('posts_u.category_id', 405)         
				 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
        /*else
            $this->db->where('posts_u.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts_u.category_id', $q['category_id']);
      
      if ( !empty($q['id']) )
			$this->db->where_in('posts_u.id', $q['id']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
	}
  
  public function get_posts_public($group, $category=FALSE, $limit=20, $offset=0)
	{
		$this->db->select('posts_u.*, media_u.url, media_u.media_type, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'0\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts_u.group', $group)
				 ->order_by('id DESC')
				 ->group_by('posts_u.id');
		if ($category)
			$this->db->where('posts_u.category_id', $category);

		return $this->db->get('posts_u', $limit, $offset)->result();
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
            'spec' => '',           
            'sort_order' => '',   
             //'user_id' => $this->session->userdata('user_id') ,   
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
          //->where('posts_u.user_id', $q['user_id'])
				 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
        /*if(!empty($q['spec']))
            $this->db->where('posts_u.spec', $q['spec']);*/
       /* else
            $this->db->where('posts_u.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts_u.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])     
         ->where('posts_u.rec_tour', $q['rec_tour'])  
         ->where('posts_u.rec_hotel', $q['rec_hotel'])   
				 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
       /* else
            $this->db->where('posts_u.status !=', 'draft');*/

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts_u.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
                 ->where('posts_u.category_direction', $q['category_direction'])
				 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
       // else
            //$this->db->where('posts_u.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts_u.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
                 ->where('posts_u.spec', $q['spec'])
				 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
      //  else
//            $this->db->where('posts_u.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts_u.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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

		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
                 ->where('posts_u.direction', $q['direction'])
         		 ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
       // else
          //  $this->db->where('posts_u.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts_u.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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

        $this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
            ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
            ->where('posts_u.group', $q['group'])
            ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
       // else
        //    $this->db->where('posts_u.status !=', 'draft');

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts_u.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
    }

	public function get_media_files($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
				 ->order_by('sort_order');

		return $this->db->get('media_u', $limit, $offset)->result();
	
}

public function get_media_files_img($id, $limit = 10000, $offset = 0)
	{

  return $this->db->get_where('media_u',array('id'=> $id))->result();
}




  	public function get_media_category($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
        ->where('is_main', 1)
				 ->order_by('sort_order');

		return $this->db->get('media_u', $limit, $offset)->result();
	}
  
   public function get_media_category_in($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
        ->like('is_main', 0)
				 ->order_by('sort_order');

		return $this->db->get('media_u', $limit, $offset)->result();
	}

  
    public function get_media_files_total($id, $limit = 10000, $offset = 0)
    {
        $this->db->from('media_u')
        ->where('post_id', $id);

        return $this->db->count_all_results();
    }

    public function get_media_bypost($post_id)
    {
        return $this->db->select('url')->get_where('media_u', array('post_id' => $post_id))->row();
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

        $this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
            ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
            ->where('posts_u.group', $q['group'])
            ->group_by('posts_u.id');

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
     //   else
//            $this->db->where('posts_u.status !=', 'draft');

        $this->db->where('posts_u.carousel', "0");

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts_u.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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
            'orderby' => 'media_u.id',
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

        $this->db->select('posts_u.*, media_u.url, media_u.id media_u_id, media_u.created_on create_date')
            ->select('categories.title as category')
            ->join('media_u', 'posts_u.id = media_u.post_id')
            ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
            ->where('posts_u.group', $q['group']);

        if ( !empty($q['category_ids']) )
            $this->db->where_in('posts_u.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
      //  else
       //     $this->db->where('posts_u.status !=', 'draft');

        $this->db->where('posts_u.carousel', "1");

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
    }

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('posts_u', $data);
		}
		else
		{
			$this->db->insert('posts_u', $data);

			return $this->db->insert_id();
		}
	}

	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('posts_u');    	

	
			$this->db->delete('media_u', array('post_id'=>$id));
		
	}

	public function has_alias($alias, $post_id)
	{
		$this->db->where('alias', $alias)
		         ->where('id !=', $post_id);

		return $this->db->get('posts_u')->row();
	}
  public function has_alias_1($title, $alias)
	{
		$this->db->where($title, $alias);		         

		return $this->db->get('users')->row();
	}

	public function get_posts_by_parent($category, $order=false, $limit=20000)
	{
		$this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->order_by('id DESC')
				 ->group_by('posts_u.id')
				 ->where('categories.parent_id', $category);

        if($order)
        	$this->db->order_by('time','DESC');
        else
        	$this->db->order_by('id','DESC');

		return $this->db->get('posts_u',$limit)->result();
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
			'orderby' => 'media_u.id',
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

		$this->db->select('posts_u.*, media_u.url, media_u.id media_u_id, media_u.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media_u', 'posts_u.id = media_u.post_id')
                 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts_u.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
     //   else
//            $this->db->where('posts_u.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
   }
   
   public function get_posts_and_media_files_alias($args)
    {
        $defaults = array(
			'group' => '',
			'category_ids' => array(),
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'media_u.id',
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

		$this->db->select('posts_u.*, media_u.url, media_u.id media_u_id, media_u.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media_u', 'posts_u.id = media_u.post_id')
                 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->where('posts_u.group', $q['group'])
                 ->where('posts_u.alias', $q['alias']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('posts_u.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
    //    else
//            $this->db->where('posts_u.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
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

        $this->db->from('posts_u')
                 ->join('media_u', 'posts_u.id = media_u.post_id')
                 ->where('posts_u.group', $q['group']);
             

        if(!empty($q['status']))
            $this->db->where('posts_u.status', $q['status']);
             if(!empty($q['alias']))
            $this->db->where('posts_u.alias', $q['alias']);
     //   else
//            $this->db->where('posts_u.status !=', 'draft');

        return $this->db->count_all_results();
   }

    public function get_media_file($media_u_id)
    {
        return $this->db->select('url')->get_where('media_u', array('id' => $media_u_id))->row();
    }

     public function update_views($post_id ,$counter_data) {
            /* $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('posts_u');*/
             $this->db->query("UPDATE posts_u SET views = $counter_data+1 WHERE id = $post_id");
             
             
     }

    public function update_rating($post_id){

        $page = $this->db->get('posts_u', array('id' => $post_id))->row();
        $video_views = $page->rating;
        //var_dump($page);
        $this->db->set('rating', $video_views+1, FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts_u');
    }

    public function get_media_files_by_cat($category) {
        return $this->db->select('id, url')
                        ->where('category', $category)
                        ->order_by('id', 'desc')
                        ->get('media_u')
                        ->result();
    }

    
    



    public function get_posts_count_not($group, $id) {
	            
            	$this->db->not_like('category_id', $id);
              $this->db->where('group', $group);
                $this->db->where_in('status', 'active');
$this->db->from('posts_u');
return $this->db->count_all_results();
	}
  
  public function get_posts_count($group = 'pages') {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts_u AS p
            WHERE p.group = '".$group."'             
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');
	}
  
   public function get_new_message($group = 'yes') {	
            
            	$this->db->not_like('status', 'draft');
              $this->db->where('new_add', $group);
                $this->db->where_in('approved', 'inactive');
$this->db->from('posts_u');
return $this->db->count_all_results();
	}
  
  public function get_posts_count_admin($group = 'pages') {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM posts_u AS p
                WHERE p.group = '".$group."'
                AND p.id";
            return $this->db->query($sql)->row('count');
	}

	    public function count_category($group = false, $id = false) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM posts_u AS p
                WHERE p.group = '".$group."'
				AND p.status = 'active'
				AND p.category_id = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
    
    	    public function gallery_menu() {
		 $this->db->select('posts_u.*')                	
                    ->where('posts_u.category_id', 182)
                    ->where('posts_u.status', 'active')
                    ->where('posts_u.group', 'menu');
                      
           return $this->db->get('posts_u')->result();
	}

	public function get_posts_by_search($search)
	{
		$search = urldecode($search);
        $query = $this->db->query('SELECT * FROM posts_u WHERE posts_u.content LIKE "%'.$search.'%" OR posts_u.title LIKE "%'.$search.'%"')->result();
		/*$this->db->select('posts_u.*')
				 ->where('group','news')
				 //->where('group','menu')
				 //->where('group','projects')
				 ->where('content LIKE "%'.$search.'%"')
				 ->order_by('id DESC');

		$result = $this->db->get('posts_u')->result();*/
  /*  $search = urldecode($search);
		$this->db->select('posts_u.*, posts_u.group as pgroup, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('group','news')
				 ->where('group','menu')
				 //->where('group','projects')
				 ->where('posts_u.content LIKE "%'.$search.'%" OR posts_u.title LIKE "%'.$search.'%"')
				 ->order_by('posts_u.id DESC');
		
		$result = $this->db->get('posts_u')->result();
		return $result;
    */
    
		return $query;
	}
  public function get_article($alias)
	{
		$this->db->select('posts_u.*, media_u.url, categories.title as category,  t2.alias as parent_alias, categories.alias as category_alias')
				 ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
				 ->join('categories as t2','categories.parent_id = t2.category_id', 'left')
				 ->where('posts_u.alias', $alias)
				 ->order_by('id DESC')
				 ->group_by('posts_u.id');
				 
		$result = $this->db->get('posts_u')->row();
		
		if (count($result) > 0)
			return $result;
		else
			return show_404();
	}
  
  public function get_count($id)
    {
        $this->db->select('posts_u.views')
            ->where('posts_u.id', $id);

        return $this->db->get('posts_u')->row();
    }
    public function get_media_by_type($id, $type) {
        return $this->db->select('*')
            ->where('post_id', $id)
            ->where('media_type', $type)
            ->get('media_u')->row();
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
      
      $this->db->select('posts_u.*, media_u.url, categories.title as category, categories.alias as category_alias')
      ->join('media_u', 'posts_u.id = media_u.post_id AND media_u.is_main = \'1\'', 'left')
      ->join('categories', 'categories.category_id = posts_u.category_id', 'left')
      ->where('posts_u.group', $q['group'])
      ->group_by('posts_u.id');
      
      if(!empty($q['status']))
      $this->db->where('posts_u.status', $q['status']);
      
      if ( !empty($q['category_ids']) )
      $this->db->where_in('posts_u.category_id', $q['category_ids']);
      
      if ( !empty($q['orderby']) )
      $this->db->order_by($q['orderby'], $q['order']);
      
      if ($date = $this->input->get('date')) {
        $this->db->where('time >=', $date.' 00:00:00')
         ->where('time <=', $date.' 23:59:59');
      }
      
      return $this->db->get('posts_u', $q['limit'], $q['offset'])->result();
}

public function is_unique_username($str, $field)
    {
        if (substr_count($field, '.') == 2)
        {
            list($table, $field, $true) = explode('.', $field);
            $query = $this->CI->db->limit(1)
                                  ->where($field, $str)
                                  ->where($field.' != ', $str)
                                  ->get($table);
        } 
        else {
            list($table, $field)=explode('.', $field);
            $query = $this->CI->db->limit(1)
                                  ->get_where($table, array($field => $str));
        }

        return $query->num_rows() === 0;
    }


}