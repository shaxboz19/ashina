<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Site extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('site_model', 'site');
		$this->load->model('category_model','category');
         $this->load->helper('admin');
          $this->load->model('lang_model');
             if($this->data['user_type'] != 'admin'){
    go_to(site_url('admin/main'));
   }
	}

	public function index($group, $category=FALSE, $cat_id = false)
	{
        if($group == 'gallery')
            $this->data['posts'] = meta_posts($this->site->get_site(array('group'=> 'gallery')));
        else if($cat_id)
           $this->data['posts'] = $this->site->get_site(array('group'=>$group, 'category_ids' => array($cat_id) ));
        else
            $this->data['posts'] = $this->site->get_site(array('group'=>$group));

        $this->data['categories'] = parent_sort($this->category->get_cats($group));

        if($group == 'menu'){
            $this->data['menu_categories'] = $this->site->get_site(array('group'=>$group));
        }

		$this->data['cat_id'] = $cat_id;
		$this->data['sel'] = $group;
		$this->data['body'] = "admin/{$group}/index";
	    $this->load->view('admin/index', $this->data);
	}

	public function save($group, $id=false)	{
	   
            
        if($group === 'video'){
            $this->data['albums'] = $this->category->get_cats('albums');
            $this->data['singers'] = $this->singers->get_by();
        }

		if ($id)
		{
			 foreach($this->lang->languages as $key => $lang)
                {
                    $this->form_validation->set_rules('title['.$key.']', 'Title '.$key, 'trim');
                   // $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');

                }

            if($group == 'news')
            {
                foreach($this->lang->languages as $key => $lang)
                {
                    $this->form_validation->set_rules('title['.$key.']', 'Title '.$key, 'trim');
                    $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');

                }
            }

            if($group == 'gallery' || $group == 'slides')
            {
                $this->form_validation->set_rules('status', 'status', 'trim|callback__check_media['.$id.']');
            }

			if ($this->form_validation->run())
			{
				$posts = $this->input->post();

				$data = array(
					'title'  	  => serialize($this->input->post('title')),
					'content'	  => serialize($this->input->post('content')),
          'spec_type'	  => serialize($this->input->post('spec_type')),
          'spec'	      => serialize($this->input->post('spec')),
          'meta_title'  => serialize($this->input->post('meta_title')),
          'category_id' => $this->input->post('category_id'),
          'status'	  => $this->input->post('status'),
          //'spec'  	  => @$this->input->post('spec'),
          'direction'  	  => @$this->input->post('direction'),
          'keywords'  	  => @$this->input->post('keywords'),               
          'description'  	  => @$this->input->post('description'),
          'category_direction'  	  => @$this->input->post('category_direction'),  
          'specialty'  	  => @$this->input->post('specialty'),
          'site_off'  	  => @$this->input->post('site_off'),
          'status_click' =>  @$this->input->post('status_click'),
          'link' =>  @$this->input->post('link'),                                                
				);

                if($group == 'menu'){
                    $data['day_menu'] = $this->input->post('day_menu');
                    $data['as_menu'] = $this->input->post('as_menu');
                    $data['half_price'] = $this->input->post('half_price');
                    $data['price'] = $this->input->post('price');
                }
                
         
            
                if($this->input->post('short_content')){
                    $data['short_content'] = serialize($this->input->post('short_content'));
                }
				if ($this->input->post('alias'))
					$data['alias'] = $this->input->post('alias');
				if ($this->input->post('video')){
					$data['video_code']  = $this->input->post('video');
                    $data['category_id']  = $this->input->post('sub_select_name');
                }
				if (isset($posts['data']))
				{
					foreach ($posts['data'] as $key=>$val)
	                    $data[$key] = $val;
	            }

                $error = false;
                if($this->input->post('video_type'))
                {
                    if($this->input->post('video_type')==1)
                    {
                        $data['video_link'] = 'http://www.youtube.com/embed/'.$this->input->post('video');
                    }
                    if($this->input->post('video_type')==2)
                    {
                        $data['video_link']  = 'http://mover.uz/video/embed/'.$this->input->post('video').'/';
                    }
                    if($this->input->post('video_type')==3)
                    {
                        $video = $this->site->get_media_bypost($id);
                        if($video){
                            $data['video_link']  = base_url().'uploads/video/'.$video->url;
                            $data['category_id'] = 999;
                            $data['video_code'] = '';
                        }
                    }

                    $upload_data = array();
                    if($_FILES['userfile']['size'] > 0 ) {
                        $result = do_upload('video_covers');

                        if(!empty($result['error'])) {
                            $error = true;
                            $this->data['error'] = $result['error'];
                        } else {
                            $error = false;
                            $upload_data = $this->upload->data();
                            $data['video_img'] = $upload_data['file_name'];

                            if(!empty($id)) {
                                $post = $this->site->get($id);
                                @unlink('./uploads/video_covers/'.$post->video_img);
                            }

                        }
                    }

                }

                /** Sides */
                if ($group == 'slides') {
                    $data['carousel'] = $this->input->post('carousel');
                    $data['link'] = $this->input->post('link');
                }

                if($error === FALSE)
                {
                    $this->site->save($data, $id);

				    //go_to("admin/site/save/{$group}");
            go_to("admin/main");
                }
                
               
      /*      $id =  $this->input->post('lang_site');
         $data_lang_site = array(
				'default' => '1',			
			);
            
            $this->lang_model->save($data_lang_site, $id);*/
            
			}

			$this->data['post'] = $this->site->get($id);
			$this->data['media_files'] = $this->site->get_media_files($id);
		}
		else
		{
			$data = array(
				'group' => $group,
				'created_on' => date('Y-m-d H:i:s'),
			);

			$new_post_id = $this->site->save($data, $id);

		//	go_to("admin/site/save/{$group}/$new_post_id");
    go_to("admin/main");    
		}

        $this->data['categories'] = parent_sort($this->category->get_cats( $group ));

        if($group == 'menu'){
            $this->data['categories'] = $this->site->get_site(array('group'=>$group));
        }
         if($group == 'direction'){
            $this->data['categories'] = $this->site->get_site(array('group'=>'slides'));
        }
        
           if($group == 'direction'){
            $this->data['category_direction'] = $this->site->get_site(array('group'=>'specialty'));
        }
         if($group == 'specialists'){
            $this->data['category_direction'] = $this->site->get_site(array('group'=>'specialty'));
        }
        
         $this->data['lang_site'] = $this->lang_model->get_list();
         
         
        
            
            

		$this->data['sel'] = $group;
		$this->data['body'] = "admin/{$group}/save";
	    $this->load->view('admin/index', $this->data);
	}
  
  
  public function save_price()
	{
	 //$id = @$this->input->post('id');
	$data = array(
      'price'  	  => @$this->input->post('price'),                                                      
				);
    $this->site->save($data, 1);
		
		go_to();
	}

	public function delete($id)
	{
		$this->site->delete($id);
		go_to();
	}

    public function delete_media($media_id)
    {
        $this->load->library('MediaLib');
        $this->medialib->delete($media_id);
        go_to();
    }

	public function check_alias()
	{
		$has_alias = $this->site->has_alias( $this->input->get('fieldValue'), $this->input->get('post_id') );

		$field_id = $this->input->get('fieldId');

		if ($has_alias)
		{
			echo '["'.$field_id.'",false]';
		}
		else
		{
			echo '["'.$field_id.'",true]';
		}
	}

	public function import()
	{
		move_uploaded_file($_FILES['userfile']['tmp_name'], './uploads/imports/tvshows.csv');

		$file = fopen("./uploads/imports/tvshows.csv","r");

		while( $row = fgetcsv($file) ) {
			$data['title'] = serialize(array('uz'=>$row[1]));
			$data['time'] = basename($_FILES['userfile']['name'], '.csv').' '.$row[0];
			$data['group'] = 'tv_guide';

			$all_data[] = $data;
		}

		$this->db->insert_batch('posts', $all_data, 'IGNORE');

		fclose($file);

		go_to();
	}

    public function _check_media($value, $post_id)
    {
        $media_files = $this->site->get_media_files($post_id);
        if($media_files)
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('_check_media', 'Р’С‹ РґРѕР»Р¶РЅС‹ Р·Р°РіСЂСѓР·РёС‚СЊ С…РѕС‚СЏ Р±С‹ РѕРґРЅРѕ С„РѕС‚Рѕ');
            return FALSE;
        }
    }

}