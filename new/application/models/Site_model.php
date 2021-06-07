<?php

Class Site_model extends CI_Model
{
	public function get($id, $status = false) {
		$this->db->select('site.*, media.url, categories.alias AS category')
		         ->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
		         ->join('categories', 'site.category_id = categories.category_id', 'left')
		         ->where('site.id', $id);
        if($status)
            $this->db->where('site.status', $status);

		return $this->db->get('site')->row();
	}

	public function get_id($alias)
	{
		$post = $this->db->get_where('site', array('alias'=>$alias))->row();

		if ($post)
			return $post->id;
		else
			return show_404();
	}

	public function get_site($args = null)
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
      'alias' => '',
      'site_off' => '',
      'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('site.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->where('site.group', $q['group'])
				 ->group_by('site.id');

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
       // else
          //  $this->db->where('site.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('site.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('site', $q['limit'], $q['offset'])->result();
	}
    
    
    	public function get_site_off($args = null)
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
      'site_off' => '',
      'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('site.*')
				 //->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
				 //->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->where('site.group', $q['group'])
                 ->where('site.site_off', $q['site_off'])
				 ->group_by('site.id');

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
       // else
        //    $this->db->where('site.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('site.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('site', $q['limit'], $q['offset'])->result();
	}



    	public function get_site_spec($args = null)
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
            'category_direction' => ''
		);

		$q = array_merge($defaults, $args);

		$this->db->select('site.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->where('site.group', $q['group'])
                 ->where('site.spec', $q['spec'])
				 ->group_by('site.id');

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
       // else
        //    $this->db->where('site.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('site.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('site', $q['limit'], $q['offset'])->result();
	}

	    	public function get_site_direction($args = null)
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
            'category_direction' => ''
		);

		$q = array_merge($defaults, $args);

		$this->db->select('site.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->where('site.group', $q['group'])
                 ->where('site.direction', $q['direction'])
         		 ->group_by('site.id');

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
       // else
        //    $this->db->where('site.status !=', 'draft');

		if ( !empty($q['category_ids']) )
			$this->db->where_in('site.category_id', $q['category_ids']);

		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('site', $q['limit'], $q['offset'])->result();
	}

    public function get_site_byid($args = null)
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
            'category_direction' => ''
        );

        $q = array_merge($defaults, $args);

        $this->db->select('site.*, media.url, categories.title as category, categories.alias as category_alias')
            ->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = site.category_id', 'left')
            ->where('site.group', $q['group'])
            ->group_by('site.id');

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
       // else
        //    $this->db->where('site.status !=', 'draft');

        if ( !empty($q['category_ids']) )
            $this->db->where_in('site.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('site', $q['limit'], $q['offset'])->result();
    }

	public function get_media_files($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
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

    public function get_site_main($args = null)
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
            'category_direction' => ''            
        );

        $q = array_merge($defaults, $args);

        $this->db->select('site.*, media.url, categories.title as category, categories.alias as category_alias')
            ->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
            ->join('categories', 'categories.category_id = site.category_id', 'left')
            ->where('site.group', $q['group'])
            ->group_by('site.id');

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
      //  else
       //     $this->db->where('site.status !=', 'draft');

        $this->db->where('site.carousel', "0");

        if ( !empty($q['category_ids']) )
            $this->db->where_in('site.category_id', $q['category_ids']);

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        if ($date = $this->input->get('date')) {
            $this->db->where('time >=', $date.' 00:00:00')
                ->where('time <=', $date.' 23:59:59');
        }

        return $this->db->get('site', $q['limit'], $q['offset'])->result();
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

        $this->db->select('site.*, media.url, media.id media_id, media.created_on create_date')
            ->select('categories.title as category')
            ->join('media', 'site.id = media.post_id')
            ->join('categories', 'categories.category_id = site.category_id', 'left')
            ->where('site.group', $q['group']);

        if ( !empty($q['category_ids']) )
            $this->db->where_in('site.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
      //  else
       //     $this->db->where('site.status !=', 'draft');

        $this->db->where('site.carousel', "1");

        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('site', $q['limit'], $q['offset'])->result();
    }

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('site', $data);
		}
		else
		{
			$this->db->insert('site', $data);

			return $this->db->insert_id();
		}
	}

	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('site');
	}

	public function has_alias($alias, $post_id)
	{
		$this->db->where('alias', $alias)
		         ->where('id !=', $post_id);

		return $this->db->get('site')->row();
	}

	public function get_site_by_parent($category, $order=false, $limit=20000)
	{
		$this->db->select('site.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'site.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->order_by('id DESC')
				 ->group_by('site.id')
				 ->where('categories.parent_id', $category);

        if($order)
        	$this->db->order_by('time','DESC');
        else
        	$this->db->order_by('id','DESC');

		return $this->db->get('site',$limit)->result();
	}

    //// gallery
    public function get_site_and_media_files($args)
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

		$this->db->select('site.*, media.url, media.id media_id, media.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media', 'site.id = media.post_id')
                 ->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->where('site.group', $q['group']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('site.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
       // else
         //   $this->db->where('site.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('site', $q['limit'], $q['offset'])->result();
   }
   
   public function get_site_and_media_files_alias($args)
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

		$this->db->select('site.*, media.url, media.id media_id, media.created_on create_date')
                 ->select('categories.title as category')
				 ->join('media', 'site.id = media.post_id')
                 ->join('categories', 'categories.category_id = site.category_id', 'left')
				 ->where('site.group', $q['group'])
                 ->where('site.alias', $q['alias']);

   		if ( !empty($q['category_ids']) )
			$this->db->where_in('site.category_id', $q['category_ids']);

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
       // else
        //    $this->db->where('site.status !=', 'draft');

        if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);

        return $this->db->get('site', $q['limit'], $q['offset'])->result();
   }

   public function total_site_and_media_files($args)
   {
        $defaults = array(
			'group' => '',
			'category_ids' => array(),
            'status' => '',
            'spec' => '',
            'alias' => ''
		);

        $q = array_merge($defaults, $args);

        $this->db->from('site')
                 ->join('media', 'site.id = media.post_id')
                 ->where('site.group', $q['group'])
                 ->where('site.alias', $q['alias']);

        if(!empty($q['status']))
            $this->db->where('site.status', $q['status']);
        //else
        //    $this->db->where('site.status !=', 'draft');

        return $this->db->count_all_results();
   }

    public function get_media_file($media_id)
    {
        return $this->db->select('url')->get_where('media', array('id' => $media_id))->row();
    }

     public function update_views($post_id ,$counter_data) {
             $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('site');
     }

    public function update_rating($post_id){

        $page = $this->db->get('site', array('id' => $post_id))->row();
        $video_views = $page->rating;
        //var_dump($page);
        $this->db->set('rating', $video_views+1, FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('site');
    }

    public function get_media_files_by_cat($category) {
        return $this->db->select('id, url')
                        ->where('category', $category)
                        ->order_by('id', 'desc')
                        ->get('media')
                        ->result();
    }




    public function get_site_count($group = 'pages') {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM site AS p
                WHERE p.group = '".$group."'
				AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');
	}

	    public function get_site_count_spec($group = 'specialists', $spec = false) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM site AS p
                WHERE p.group = '".$group."'
				AND p.status = 'active'
				AND p.spec = '".$spec."'";
            return $this->db->query($sql)->row('count');
	}
    
    	    public function gallery_menu() {
		 $this->db->select('site.*')                	
                    ->where('site.category_id', 182)
                    ->where('site.status', 'active')
                    ->where('site.group', 'menu');
                      
           return $this->db->get('site')->result();
	}

	public function get_site_by_search($search)
	{
		$search = urldecode($search);
        $query = $this->db->query('SELECT * FROM site WHERE site.content LIKE "%'.$search.'%"')->result();
		/*$this->db->select('site.*')
				 ->where('group','news')
				 //->where('group','menu')
				 //->where('group','projects')
				 ->where('content LIKE "%'.$search.'%"')
				 ->order_by('id DESC');

		$result = $this->db->get('site')->result();*/
		return $query;
	}

}