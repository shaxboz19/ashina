<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Posts2_option extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->model('posts2_model', 'posts2');
        $this->load->model('category_model','category');
        $this->load->model('model_regions');
        if($this->data['user_type'] != 'admin'){
            go_to(site_url('admin/main'));
        }
	}

	public function index($group, $param, $type=false, $offset = 0)
	{
	 
    $this->load->library('pagination');
    
    $config = array();
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url().'/admin/posts2_option/index/'.$group.'/'.$param.'/?';
    
   $config['total_rows'] = $this->posts2->count_posts_category_admin($param, $group);
   //$config['total_rows'] = count($category_count) ;
   
    $config['per_page'] = 80;
    
    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div><!--pagination-->';
    
    $config['first_link'] = '&laquo;';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';
    
    $config['last_link'] = '&raquo;';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';
    
    $config['next_link'] = '&rarr;';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';
    
    $config['prev_link'] = '&larr;';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';
    
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    //$this->data['posts'] = $this->posts->get_posts_portfolio($group, $param, $config['per_page'], (int)$this->input->get('page'));
    
     if($this->input->get('sort')){
        
         $this->data['posts'] = $this->posts2->get_posts_p( array('group'=> $group, 'orderby' => 'sort_order', 'order' => $this->input->get('sort'), 'category_id' => $param, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')) );  
          
          
     }else{
          $this->data['posts'] = $this->posts2->get_posts_p( array('group'=> $group, 'category_id' => $param, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')) );  
     }
         $this->data['pagination'] = $this->pagination->create_links();
     if($type){
        
    }else{
    $this->data['category_o'] = $this->posts2->get( $param );

      }
      
    $this->data['category_id'] = $param;
     $this->data['category_group'] = $group;

    $this->data['sel'] = $group;
    $this->data['sel_id'] = $group;
   
    $this->data['body'] = "admin/posts2/posts2_option/$group/index";
    $this->load->view('admin/index', $this->data);
	}
    
    


	public function save($group, $category_id, $id=false, $page=false)
	{
		if($id)
		{
			$this->form_validation->set_rules('alias', 'Alias', 'trim|required');
			// $this->form_validation->set_rules('category', 'Category', 'trim|required');

			if ($this->form_validation->run())
			{
			 @$ru = mb_substr($_POST['title']['ru'], 0,1,'utf-8');
        @$uz = mb_substr($_POST['title']['uz'], 0,1,'utf-8');
        @$en = mb_substr($_POST['title']['en'], 0,1,'utf-8');
        
         $status_uz = (@$_POST['title']['uz']) ? 'active': 'inactive';
       $status_ru = (@$_POST['title']['ru']) ? 'active': 'inactive';
       $status_en = (@$_POST['title']['en']) ? 'active': 'inactive';
       $status_oz = (@$_POST['title']['oz']) ? 'active': 'inactive';
        //@$oz - mb_substr($_POST['title']['oz'], 0,1,'utf-8');
        $property_1 = 'false'; $property_2 = 'false'; $property_3 = 'false';
            if ($this->input->post('my-switcher-1')=='off'){
                $property_1 = 'true';
            }
            if ($this->input->post('my-switcher-2')=='off'){
                $property_2 = 'true';
            }    
            if ($this->input->post('my-switcher-3')=='off'){
                $property_3 = 'true';
            }       
				$data = array(
                       'title'  	  => serialize($this->input->post('title')),
                    //'caption'  	  => serialize($this->input->post('caption')),
                    'content'	  => serialize($this->input->post('content')),
                    'spec_type'	  => serialize($this->input->post('spec_type')),
                    'content_html'	  => serialize($this->input->post('content_html')),
                    
                    'category_title'	  => serialize($this->input->post('category_title')),  
                    'option_4'	  => serialize($this->input->post('option_4')),           
                    
                    'meta_title'  => serialize($this->input->post('meta_title')),
                    'category_id' =>  ($this->input->post('category_change')) ? $this->input->post('category_change') : $category_id,
                    'category_id2' => $this->input->post('category_id2'),
                    'status'	  => $this->input->post('status'),
                    //'category_status' => $this->input->post('category_status'),
                    'status1'	  => $this->input->post('status1'),
                    'status2'	  => $this->input->post('status2'),
                    'status3'	  => $this->input->post('status3'),
                    
                    'option_1'	  => $this->input->post('option_1'),
                    'option_2'  	  => @$this->input->post('option_2'),
                    'option_3'  	  => @$this->input->post('option_3'), 
                    'options'	  => $this->input->post('options'),
                    'option'	  => $this->input->post('option'),
                    'author'	  => $this->input->post('author'),          
                    
                    'direction'  	  => @$this->input->post('direction'),
                    'keywords'  	  => @$this->input->post('keywords'),               
                    'description'  	  => @$this->input->post('description'),
                    'category_direction'  	  => @$this->input->post('category_direction'),  
                    'price'  	  => @$this->input->post('price'),  
                    'spec'  	  => @$this->input->post('spec'),        
                    'specialty'  	  => @$this->input->post('specialty'),
                    //'sort_order'  	  => @$this->input->post('sort_order'),
                    'iframe_youtube'  	  => @$this->input->post('iframe_youtube'),
                    'iframe_mover'  	  => @$this->input->post('iframe_mover'),
                    'cat_id'  	  => @implode(',', $this->input->post('cat_id')),
                    'ru'  	  => @$ru,
                    'uz'	  => @$uz,
                    'en'	  => @$en,
                    //  'oz'	  => @$oz, 
                    'color' => $this->input->post('color'),
                    'price_1' => $this->input->post('price_1'),
                    'checker_1'	  => $property_1,
                    'checker_2'	  => $property_2, 
                    'checker_3'	  => $property_3,
                    'position_menu' =>  @$this->input->post('position_menu'), 
                    'country_id' => @$this->input->post('country_id'),
                    'city_id'   =>  @$this->input->post('city_id'),       
                    'region_id'   =>  @$this->input->post('region_id'),        
                    //'alias_sub' =>  @$this->input->post('alias_sub'), 
                    'tags' => @implode(',', $this->input->post('tags')),   
                    'status_lang_uz' => $status_uz,
					'status_lang_ru' => $status_ru,
					'status_lang_en' => $status_en,      
                    'status_lang_oz' => $status_oz, 
                    'value_1' => $this->input->post('value_1'),
                    'value_2' => $this->input->post('value_2'),
				);
                


				if ($this->input->post('alias')){
					$data['alias'] = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('alias'));
                    }
   if($this->input->post('created_on')){
          	
        $data['created_on'] = to_date("Y-m-d H:i", $this->input->post('created_on'));
        
        }
        
        if($this->input->post('date1')){
          	
        $data['date1'] = to_date("Y-m-d", $this->input->post('date1'));
        
        }
        
        if($this->input->post('date_creation')){
          $data['date_creation'] = to_date("Y-m-d H:i", $this->input->post('date_creation'));
          }
                /*$upload_data = array();
                if($_FILES['userfile']['size'] > 0 )
                {
                    $result = do_upload('city_map');

                    if(!empty($result['error']))
                    {
                        $error = true;
                        $this->data['error'] = $result['error'];
                    }
                    else
                    {
                        $error = false;
                        $upload_data = $this->upload->data();
                        $data['map_img'] = $upload_data['file_name'];

                        if(!empty($id))
                        {
                            $post = $this->posts->get($id);
                            @unlink('./uploads/video_covers/'.$post->map_img);
                        }
                    }
                }*/
				$this->posts2->save($data, $id);

                 if($page){           
                   go_to("admin/posts2_option/index/$group/$category_id/?&page=$page");
                    } else{
                        go_to("admin/posts2_option/index/$group/$category_id");
                    }
			}			
      $this->data['post'] = $this->posts2->get($id);
      //$this->data['category'] = $this->posts2->get($category_id);
      $this->data['category_sub'] = $this->posts2->get($category_id);
      $this->data['media_files'] = $this->posts2->get_media_files($id);
       $this->data['media_files_poster'] = $this->posts2->get_media_files_poster($id);
		}
		else
		{
			$data = array(
				'group' => $group,
			'created_on' => date('Y-m-d H:i:s'),
                'date_creation' => date('Y-m-d H:i:s'),
			);
      
			$new_post_id = $this->posts2->save($data, $id);
            
             $data_sort_order['sort_order'] = $new_post_id;
            $this->posts2->save($data_sort_order, $new_post_id);
			go_to("admin/posts2_option/save/$group/$category_id/$new_post_id");
		}

		$this->data['categories'] = '';//parent_sort($this->category->get_by_alias($group));
      $this->data['city'] = $this->model_regions->regions_get_city($category_id);
        $this->data['category_o'] = $this->posts2->get($category_id);
    		//$this->data['post'] = $this->posts->get($id);
		$this->data['sel'] = $group;
        $this->data['cat_id'] = $category_id;
    //$this->data['category_site'] = $this->posts->get_posts(array('group'=>'portfolio', 'status' => 'active'));
    $this->data['body'] = "admin/posts2/posts2_option/$group/save";

    $this->load->view('admin/index', $this->data);
	}

	public function delete($id)
	{
		$media = $this->posts2->get_media_files ($id);
		$this->posts2->delete($id);    
  foreach($media as $item){
			@unlink( "./uploads/{$item->category}/{$item->url}" );
}
			$this->db->delete('media2', array('post_id'=>$id));
		
		go_to();
	}

	public function check_alias()
	{
		$has_alias = $this->posts2->has_alias( $this->input->get('fieldValue'), $this->input->get('post_id') );

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

}