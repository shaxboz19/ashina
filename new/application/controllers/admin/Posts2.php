<?php

Class Posts2 extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('posts2_model', 'posts2');
		$this->load->model('category_model','category');
    $this->data['sel_users'] = 'posts2';
	}
    
    public function regions($group){
         $this->load->model('model_regions');
        $this->data['sel'] = $group;
        $this->data['posts'] = $this->model_regions->regions_get2();       
        $this->data['sel_group'] = $group;
         $this->data['body'] = 'admin/posts2/'.$group.'/region';
	    $this->load->view('admin/index', $this->data);
    }

	public function index($group, $category=FALSE, $cat_id = false, $offset = 0)
  {
    $this->load->library('pagination');

  $config = array();
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  $config['base_url'] = base_url().'/admin/posts2/index/'.$group.'/?';
  $config['total_rows'] = $this->posts2->get_posts_count_admin($group);
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

// $config['display_pages'] = FALSE;


  $this->pagination->initialize($config);

    
        if($group == 'gallery')
            $this->data['posts'] = $this->posts2->get_posts(array('group'=> 'gallery'));
        else if($cat_id)
           $this->data['posts'] = $this->posts2->get_posts(array('group'=>$group, 'category_ids' => array($cat_id) ));
           
        else
             if($this->input->get('sort')){
        $this->data['posts'] = $this->posts2->get_posts(array('group'=>$group, 'orderby' => 'sort_order', 'order' => $this->input->get('sort'), 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
        } else {
            $this->data['posts'] = $this->posts2->get_posts(array('group'=>$group, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
        }

        $this->data['categories'] = parent_sort($this->category->get_cats($group));

        $this->data['pagination'] = $this->pagination->create_links();

		$this->data['cat_id'] = $cat_id;
		$this->data['sel'] = $group;
		$this->data['body'] = "admin/posts2/{$group}/index";
	    $this->load->view('admin/index', $this->data);
	}
  
  
  
  	public function index_ajax($group, $category=FALSE, $cat_id = false, $offset = 0)
  {
    $this->load->library('pagination');

  $config = array();
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  $config['base_url'] = base_url().'/admin/posts2/index/'.$group.'/?';
  $config['total_rows'] = $this->posts2->get_posts_count_admin($group);
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

    
       /* if($group == 'gallery')
            $this->data['posts'] = meta_posts($this->posts2->get_posts(array('group'=> 'gallery')));
        else if($cat_id)
           $this->data['posts'] = $this->posts2->get_posts(array('group'=>$group, 'category_ids' => array($cat_id) ));
           
        else*/
        if($this->input->get('sort')){
        $this->data['posts'] = $this->posts2->get_posts(array('group'=>$group, 'orderby' => 'sort_order', 'order' => $this->input->get('sort'), 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
        } else {
            $this->data['posts'] = $this->posts2->get_posts(array('group'=>$group, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
        }

        /*$this->data['categories'] = parent_sort($this->category->get_cats($group));

        if($group == 'menu'){
            $this->data['menu_categories'] = $this->posts2->get_posts(array('group'=>$group));
        }
         if($group == 'menu_b'){
            $this->data['menu_categories'] = $this->posts2->get_posts(array('group'=>$group));
        }
        if($group == 'about'){
            $this->data['menu_categories'] = $this->posts2->get_posts(array('group'=>$group));
        }*/
$this->data['pagination'] = $this->pagination->create_links();

		$this->data['cat_id'] = $cat_id;
		$this->data['sel'] = $group;
		//$this->data['body'] = "admin/posts2/{$group}/index";
        	$view_template = "admin/posts2/{$group}/index_ajax";
	    $this->load->view($view_template, $this->data);
	}
  
  
/*  public function import_new($group, $status)
    {
        $this->load->library('phpexcel');

        if(@$_FILES['userfile']['size'] > 0 )
        {
            $uploaddir = 'uploads/excel/';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                $data['file'] = basename($_FILES['userfile']['name']);

                $objPHPExcel = PHPExcel_IOFactory::load($uploadfile);
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                $arr_data = array();
                $header = array();

                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                    //header will/should be in row 1 only. of course this can be modified to suit your need.
                    if ($row == 0) {
                        $header[$row][$column] = $data_value;
                    } else {
                        $arr_data[$row][$column] = $data_value;
                    }
                }
                //send the data in an array format
                $this->data['header'] = $header;
                $this->data['values'] = $arr_data;

                foreach($this->data['values'] as $value)
                {
                    if(array_key_exists("A",$value)){
                    $title = serialize($value["A"]);                
                    
                    //$title = 'a:4:{s:2:"ru";"'.$value["A"]."ru".'"s:2:"uz";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';
                        $product['title'] = 'a:4:{s:2:"ru";'.$title.'s:2:"uz";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';
                         $product['alias'] = url_title($value["A"], '_', TRUE);
                        }
                    //else @$service['title'] = '';
                    if(array_key_exists("B",$value)){
                        $content = serialize($value["B"]);
                      $product['content'] = 'a:4:{s:2:"ru";'.$content.'s:2:"uz";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';;
                    }
                        
                    //else @$service['content'] = '';
                    if(array_key_exists("C",$value)){
                        $product['price'] = $value["C"];
                        }
                    //else $service['price'] = '';
                    /*if(array_key_exists("D",$value))
                        $service['skidka'] = $value["D"];
                    else $service['skidka'] = '';*/
                      
                 /*   $product['group'] = $group;
                    $product['status'] = $status;
                   
                    $product['category_id'] = $this->input->post('category_id');
                    //$client = $this->session->userdata('id');
                    $this->posts2->save_import($product);
                }

                /*$this->data['clients'] = $this->clients_m->get();
                $this->data['subview'] = 'admin/clients/index';
                $this->load->view('admin/_layout_main', $this->data);*/
              /*   $count = count($this->data['values']);
                $this->session->set_flashdata('success', 'Добавлено '.$count.''); 
                redirect('admin/posts2/index/'.$group);
                 
            } else {
                $data['pic'] = "";
                $this->session->set_flashdata('error', 'Ошибка');  
                go_to();
            }
        }
        else {
          echo "Что то пошло не так";
        }

    }*/
    
     public function import_new2()
    {
        $this->load->library('phpexcel');
        ini_set('max_execution_time', 0);
		 ini_set('max_input_time', 0);
         ini_set('memory_limit', '-1');

        if(@$_FILES['userfile']['size'] > 0 )
        {
            $uploaddir = 'uploads/excel/';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                $data['file'] = basename($_FILES['userfile']['name']);

                $objPHPExcel = PHPExcel_IOFactory::load($uploadfile);
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                $objPHPExcel->getActiveSheet()
    ->getStyle('C')
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
                $arr_data = array();
                $header = array();

                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                    //header will/should be in row 1 only. of course this can be modified to suit your need.
                    if ($row == 4) {
                        $header[$row][$column] = $data_value;
                   // }  elseif ($row == 2) {
                       // $header[$row][$column] = $data_value;
                    }else {
                        $arr_data[$row][$column] = $data_value;
                    }
                }
                //send the data in an array format
                $this->data['header'] = $header;
                $this->data['values'] = $arr_data;
                
                 $count = count($this->data['values']);
                 
                // var_dump($this->data['values']);
                
              $i = 1;  foreach($this->data['values'] as $value)
                {
                    if($i < $count){
                    
                    // Ф.И.О.
                     $title = serialize($value["B"]);    
                    if(array_key_exists("B",$value)){ 
                      if($value["B"]){
                          $product['title'] = 'a:4:{s:2:"uz";'.$title.'s:2:"ru";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';
                      }else{
                          $product['title'] = "";
                      }
                    
                    } 
                    
                    // Наименование организации
                     $category_title = serialize($value["C"]); 
                    if(array_key_exists("C",$value)){ 
                      if($value["C"]){
                          $product['category_title'] = 'a:4:{s:2:"uz";'.$category_title.'s:2:"ru";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';
                      }else{
                          $product['category_title'] = "";
                      }
                    
                    } 
                     
                     // Должность
                    $spec_type = serialize($value["D"]);
                     if(array_key_exists("D",$value)){
                      if($value["D"]){
                        //date_default_timezone_set('Asia/Bangkok');
                          $product['spec_type'] = 'a:4:{s:2:"uz";'.$spec_type.'s:2:"ru";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';
                          // $product['date'] = PHPExcel_Shared_Date::PHPToExcel($value["C"]);
                      }else{
                          $product['spec_type'] = '';
                      }
                    }   
                    
                    // Контактные данные
                    $content_html = serialize($value["E"]);
                    if(array_key_exists("E",$value)){ 
                      if($value["E"]){
                          $product['content_html'] = 'a:4:{s:2:"uz";'.$content_html.'s:2:"ru";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';
                      }else{
                          $product['content_html'] = "";
                      }
                    
                    } 
                    
                    // Название проекта
                    $content = serialize($value["F"]);
                     if(array_key_exists("F",$value)){ 
                      if($value["F"]){
                        $product['content'] = 'a:4:{s:2:"uz";'.$content.'s:2:"ru";s:0:"";s:2:"oz";s:0:"";s:2:"en";s:0:"";}';;
                      } else{
                        $product['content'] = "";
                      }
                      
                    } 
                    
                    
                    // Финансовый объем  проекта (млн.сум)
                     if(array_key_exists("G",$value)){  
                      if($value["G"]){
                        $product['option_1'] = $value["G"];
                      } else{
                        $product['option_1'] = "";
                      }
                      
                    } 
                    
                    
                    // Финансовый объем  проекта (тысч. долл)
                     if(array_key_exists("H",$value)){
                      if($value["H"]){
                        $product['option_2'] = $value["H"];
                      } else {
                       $product['option_2'] = ""; 
                      }                      
                    }                     
                    
                    $product['group'] = "idea"; 
                    $product['status'] = "active";
                     $product['created_on'] = date('Y-m-d H:i:s'); 
                    $product['date_creation'] = date('Y-m-d H:i:s');
              
                    //var_dump($product);
                  
                    $this->posts2->save_import($product);
                  }
                $i++; }

               // @unlink( "./uploads/excel/".basename($_FILES['userfile']['name']) );
               // $this->session->set_flashdata('success', 'Добавлено '.$count.''); 
                    $this->session->set_flashdata('success', 'Добавлено');
                redirect('admin/posts2/index/idea');
                 
            } else {
                $data['pic'] = "";
                $this->session->set_flashdata('error', 'Ошибка');  
               redirect('admin/posts2/index/'.$group);
            }
        }
        else {
          echo "Что то пошло не так";
           $this->session->set_flashdata('error', 'Ошибка');  
           redirect('admin/posts2/index/'.$group);
        }

    }
  
  
  

	public function save($group, $id=false, $page=false)	{
        if($group === 'video'){
            $this->data['albums'] = $this->category->get_cats('albums');
           // $this->data['singers'] = $this->singers->get_by();
        }
 $this->data['idea'] = $this->posts2->get_posts_p(array('group' => 'idea_category', 'order' => 'DESC', 'status' => 'active'));
		if ($id)
		{
			foreach($this->lang->languages as $key => $lang)
                {
                    $this->form_validation->set_rules('title['.$key.']', 'Title '.$key, 'trim');
                   // $this->form_validation->set_rules('content['.$key.']', 'Content '.$key, 'trim');

                }


			if ($this->form_validation->run())
			{
				$posts = $this->input->post();
        
        @$ru = mb_substr($_POST['title']['ru'], 0,1,'utf-8');
        @$uz = mb_substr($_POST['title']['uz'], 0,1,'utf-8');
        @$en = mb_substr($_POST['title']['en'], 0,1,'utf-8');
        
        
        $status_uz = (@$_POST['title']['uz']) ? 'active': 'inactive';
       $status_ru = (@$_POST['title']['ru']) ? 'active': 'inactive';
       $status_en = (@$_POST['title']['en']) ? 'active': 'inactive';
       $status_oz = (@$_POST['title']['oz']) ? 'active': 'inactive';
       // @$oz - mb_substr($_POST['title']['oz'], 0,1,'utf-8');
        $property_1 = 'false'; $property_2 = 'false'; $property_3 = 'false';
            if ($this->input->post('my-switcher-1')=='on'){
                $property_1 = 'true';
            }
            if ($this->input->post('my-switcher-2')=='on'){
                $property_2 = 'true';
            }    
            if ($this->input->post('my-switcher-3')=='on'){
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
                    'category_id' => $this->input->post('category_id'),
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
                    //'alias_sub' =>  @$this->input->post('alias_sub'), 
                    'tags' => @implode(',', $this->input->post('tags')),   
                    'status_lang_uz' => $status_uz,
					'status_lang_ru' => $status_ru,
					'status_lang_en' => $status_en,      
                    'status_lang_oz' => $status_oz,                                 
				);
    
        $data_option_1['option_1'] = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('alias'));
        //$data ['price']= @$this->input->post('price');
       // $data_category_title['category_title']  = serialize($this->input->post('category_title'));
         $this->posts2->save_option_1($data_option_1, $id);
         //$this->posts2->save_category_title($data_category_title, $id);
         
         
        
        
        if($group == 'menu' || $group == 'menu_b' ){
            $data['day_menu'] = $this->input->post('day_menu');
            $data['as_menu'] = $this->input->post('as_menu');
            $data['half_price'] = $this->input->post('half_price');
            $data['price'] = $this->input->post('price');
        }        
        
        if($this->input->post('created_on')){
          	
        $data['created_on'] = to_date("Y-m-d H:i", $this->input->post('created_on'));
        $data['date1'] = to_date("Y-m-d H:i", $this->input->post('date1'));        
        }
      
        
         
     if($this->input->post('date_creation')){
          $data['date_creation'] = to_date("Y-m-d H:i", $this->input->post('date_creation'));
          }
        if($this->input->post('short_content')){
            $data['short_content'] = serialize($this->input->post('short_content'));
        }
				if ($this->input->post('alias'))
					$data['alias'] = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('alias'));
				if ($this->input->post('video')){
					$data['video_code']  = $this->input->post('video');
                    $data['category_id']  = $this->input->post('sub_select_name');
                }
                if($group == 'directions')
            {
                
                    $upload_data = array();
                    if($_FILES['userfile']['size'] > 0 ) {
                        $result = do_upload($group);

                        if(!empty($result['error'])) {
                            $error = true;
                            $this->data['error'] = $result['error'];
                        } else {
                            $error = false;
                            $upload_data = $this->upload->data();
                            $data['img_url'] = $upload_data['file_name'];

                            if(!empty($id)) {
                                $post = $this->posts2->get($id);
                                @unlink('./uploads/'.$group.'/'.$post->img_url);
                            }

                        }
                    }
                    }
                
				if (isset($posts['data']))
				{
					foreach ($posts['data'] as $key=>$val)
	                    $data[$key] = $val;
	            }

                $error = false;
                if($this->input->post('video_type'))
                {
                      if($this->input->post('video_type') == 1)
                    {
                        $data['video_link'] = 'https://www.youtube.com/embed/'.$this->input->post('video');
                        $data['video_type_l'] = 'link';
                         $data['video_type'] = $this->input->post('video_type');
                        
                    }
                    if($this->input->post('video_type') == 2)
                    {
                        $data['video_link']  = 'https://mover.uz/video/embed/'.$this->input->post('video').'/';
                        $data['video_type_l'] = 'link';
                         $data['video_type'] = $this->input->post('video_type');
                        
                    }
                    if($this->input->post('video_type') == 3)
                    {
                        $video = $this->posts2->get_media_bypost($id);
                        if($video){
                            $data['video_link']  = base_url().'uploads/video/'.$video->url;
                          // $data['video_link']  = base_url().'uploads/video/'.$this->input->post('video');
                            
                            $data['video_type_l'] = 'local';
                            
                       
                            $data['video_type'] = $this->input->post('video_type');
                        }
                    }

                    $upload_data = array();
                    if($_FILES['userfile']['size'] > 0 ) {
                        $result = do_upload($group);

                        if(!empty($result['error'])) {
                            $error = true;
                            $this->data['error'] = $result['error'];
                        } else {
                            $error = false;
                            $upload_data = $this->upload->data();
                            $data['video_img'] = $upload_data['file_name'];

                            if(!empty($id)) {
                                $post = $this->posts2->get($id);
                                @unlink('./uploads/'.$group.'/'.$post->video_img);
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
                    $this->posts2->save($data, $id);

                    if($page){           
				        go_to("admin/posts2/index/{$group}/?&page=$page");
                    } else{
                        go_to("admin/posts2/index/{$group}");
                    }
                }
			}

			$this->data['post'] = $this->posts2->get($id);
      $this->data['post1'] = $this->posts2->get($id);
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

			go_to("admin/posts2/save/{$group}/$new_post_id");
		}

    $this->data['categories'] = parent_sort($this->category->get_cats( $group ));


		$this->data['sel'] = $group;
		$this->data['body'] = "admin/posts2/{$group}/save";
	    $this->load->view('admin/index', $this->data);
	
  
  }

	public function delete($id)
	{
	 $media = $this->posts2->get_media_files ($id);
		$this->posts2->delete($id);    
  foreach($media as $item){
			@unlink( "./uploads/{$item->category}/{$item->url}" );
}
foreach($media as $item){
			@unlink( "./uploads/{$item->category}/{$item->audio_img}" );
}
foreach($media as $item){
			@unlink( "./uploads/{$item->category}/{$item->video_img}" );
}
			$this->db->delete('media', array('post_id'=>$id));
		
		go_to();
	}
  
  public function delete_image($id)
	{
	 $media = $this->posts2->get_media_files ($id);	   
  foreach($media as $item){
			@unlink( "./uploads/{$item->category}/{$item->url}" );
}
			$this->db->delete('media', array('post_id'=>$id));
		  
      $return['result'] = '<li style="color: #fff;text-align: center;font-size: 22px;" id="image">Удалено</li>';
      $this->output->set_content_type('application/json')
      ->set_output(json_encode($return));
	}
  
    public function delete_image_select()
	{
	 $image_id = $_POST['img'];
    $post_id = $this->input->post('post_id');
	 //$id = explode(" ", $image_id);
 	//$media = $this->posts2u->delete_image_select($image_id);	   
  /*foreach($media as $item){
			@unlink( "./uploads/{$item->category}/{$item->url}" );}*/
$i = 0;  foreach($image_id as $item) {
  $media[$i] = array();  
  $media[$i] = $this->db->get_where('media_u',array('id'=> $item))->result();
  foreach($media[$i] as $item1) {
  @unlink( "./uploads/{$item1->category}/{$item1->url}" );  
  }
			$this->db->delete('media', array('id'=>$item));
      
       $i++; }

      
		  
      $return['result'] = '<li style="color: #fff;text-align: center;font-size: 22px;" id="image">Удалено</li>';
      $this->output->set_content_type('application/json')
      ->set_output(json_encode($return));
      
     
  
	}

 public function delete_image1($id)
	{
	 $media = $this->posts2->get_media_files ($id);	   
  foreach($media as $item){
			@unlink( "./uploads/poster/{$item->url}" );
}
			$this->db->delete('media_poster', array('post_id'=>$id));
		  
      $return['result'] = '<li style="color: #000;text-align: center;font-size: 22px;float: none;" id="image">Удалено</li>';
      $this->output->set_content_type('application/json')
      ->set_output(json_encode($return));
	}
  
    public function delete_image_select1()
	{
	 $image_id = $_POST['img'];
    $post_id = $this->input->post('post_id');
	 //$id = explode(" ", $image_id);
 	//$media = $this->posts2u->delete_image_select($image_id);	   
  /*foreach($media as $item){
			@unlink( "./uploads/{$item->category}/{$item->url}" );}*/
$i = 0;  foreach($image_id as $item) {
  $media[$i] = array();  
  $media[$i] = $this->db->get_where('media_poster',array('id'=> $item))->result();
  foreach($media[$i] as $item1) {
  @unlink( "./uploads/poster/{$item1->url}" );  
  }
			$this->db->delete('media_poster', array('id'=>$item));
      
       $i++; }

      
		  
      $return['result'] = '<li style="color: #000;text-align: center;font-size: 22px;float: none;" id="image">Удалено</li>';
      $this->output->set_content_type('application/json')
      ->set_output(json_encode($return));
      
     
  
	}


    public function delete_media($media_id)
    {
        $this->load->library('MediaLib');
        $this->medialib->delete($media_id);
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
  
  	public function check_vopros()
	{
		$has_alias = $this->posts2->check_vopros( $this->input->get('fieldValue'), $this->input->get('post_id') );

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
  
  	public function check_username()
	{
		$has_alias = $this->posts2->has_alias_1($this->input->get('fieldId'), $this->input->get('fieldValue') );

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
  
  	public function sort_order_posts()
	{
	 $id = @$this->input->post('id');
	$data = array(
      'sort_order'  	  => @$this->input->post('sort_order'),                                                      
				);
    $this->posts2->save($data, $id);
		
		go_to();
	}
    
    public function status1()
	{
	 $id = @$this->input->post('id');
	$data = array(
      'status1'  	  => @$this->input->post('status1'),                                                      
				);
    $this->posts2->save($data, $id);
		
		go_to();
	}

    public function _check_media($value, $post_id)
    {
        $media_files = $this->posts2->get_media_files($post_id);
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
    
    public function delete_img_url($group, $id, $img)
	{
		$this->posts2->delete_img_url($img, $group);
    $data['img_url'] = '';
    $this->posts2->save($data, $id);
    
   
		go_to();
	}
    
      public function sort_order()
	{
	 
   //$item = $_POST['item'];

    $items = $this->input->post('item');


  foreach($items as $order => $item_id)
  {
     $data = array(                
               'sort_order' => $order + 1
            );
  $this->posts2->save_sort_order($data, $item_id);
  
  }
 // var_dump($items);
	}
    
    public function getTable(){
        $query = $this->db->get('posts2')->result();
            //var_dump($query);
            
            foreach($query as $item){
             $data = array(                
               'sort_order' => $item->id
            );
            
            $this->posts2->save($data, $item->id);
            }
            go_to(base_url('admin'));
    }
    public function getCityAdmin(){
        $country_id = $this->input->post('country_id');
        $city_id = $this->input->post('city_id');
        $this->data['result'] = getOptionsData(array('group' => 'city', 'status' => 'active', 'category_id' => $country_id));
         $this->data['city_id'] = $city_id;
        $this->load->view('admin/tours_c/city', $this->data);
      
    }

}