<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();		

		$this->data['sel'] = 'users';		

		$this->load->model('users_model', 'users');
       // $this->load->model('user_events_model', 'user_events');
     $this->load->model("faq_model", "faq");
		$this->config->set_item('language', 'russian'); 
    
   $this->load->library('pagination');
   if($this->data['user_type'] != 'admin'){
    go_to(site_url('admin/main'));
   }
	} 

	public function index($type='user')
	{
	 

  $config = array();
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  if($type == 'user'){
    $config['base_url'] = base_url().'/admin/users/?';
  
  } else {
      $config['base_url'] = base_url().'/admin/users/index/'.$type.'/?';
  }
  $config['total_rows'] = $this->users->get_users_count_admin($type);
  $config['per_page'] = 50;
  
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
   
		$this->data['users'] = $this->users->get_list(array('user_type'=>$type, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
    
    $this->data['pagination'] = $this->pagination->create_links();

		$this->data['sub_sel'] = $type;
		$this->data['body'] = 'admin/users/index';
	    $this->load->view('admin/index',$this->data);
	}
  
  public function social($type='user')
	{
	 

  $config = array();
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  if($type == 'user'){
    $config['base_url'] = base_url().'/admin/users/?';
  
  } else {
      $config['base_url'] = base_url().'/admin/users/social/'.$type.'/?';
  }
  $config['total_rows'] = $this->users->get_users_count_admin_social($type);
  $config['per_page'] = 50;
  
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
   
		$this->data['users'] = $this->users->get_list_social(array('user_type_social'=>$type, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
    
    $this->data['pagination'] = $this->pagination->create_links();

		$this->data['sub_sel'] = $type;
		$this->data['body'] = 'admin/users/index';
	    $this->load->view('admin/index',$this->data);
	}
    
    
      public function resident($type='resident')
	{
	 

  $config = array();
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  if($type == 'user'){
    $config['base_url'] = base_url().'/admin/users/?';
  
  } else {
      $config['base_url'] = base_url().'/admin/users/social/'.$type.'/?';
  }
  $config['total_rows'] = $this->users->get_users_count_admin_social($type);
  $config['per_page'] = 50;
  
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
   
		$this->data['users'] = $this->users->get_list_s(array('user_type_social_1'=>$type, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
    
    $this->data['pagination'] = $this->pagination->create_links();

		$this->data['sub_sel'] = $type;
		$this->data['body'] = 'admin/users/resident';
	    $this->load->view('admin/index',$this->data);
	}

	public function save($user_id=FALSE)
	{
		$edit = '';

		if($user_id) {
			$this->data['user'] = $this->users->get($user_id);
			$edit = '.true';
		}

	//	$this->form_validation->set_rules('first_name', 'lang:first_name', 'trim|required');
	//	$this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required');
		$this->form_validation->set_rules('username', 'lang:username', 'trim|is_unique[users.username'.$edit.']');
		//$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|is_unique[users.email'.$edit.']');
	//	$this->form_validation->set_rules('password', 'lang:password', 'trim|required');
	//	$this->form_validation->set_rules('c_password', 'lang:confirm_password', 'trim|required|matches[password]');
	//	$this->form_validation->set_rules('user_type', 'lang:user_type', 'trim|required');
		$this->form_validation->set_rules('active', 'lang:active', 'trim');

		if($this->form_validation->run()) {
		 // $dob =  $this->input->post('dob');
      //$str = rtrim(preg_replace('/(\D)/', '', $dob), '0');
      
     // $str1 = $str;
/*@$news_date = date_parse(getUserOption($user_id, 'dob'));

     @ $b_day = $news_date['day']; 
      @$b_month = $news_date['month'];
      @$b_year = $news_date['year'];  */    
      
      
      
    
			$data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'fio' => $this->input->post('fio'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),	
                'phone' => $this->input->post('phone'),
                'description' => $this->input->post('description'),						               'user_type' => $this->input->post('user_type'),
                'region_id' => $this->input->post('region_id'),
                'active' => $this->input->post('active'),
               // 'dob' => $this->input->post('dob'),
        
        //'b_day' =>	to_date("j", $this->input->post('dob')),
	//	'b_month'	=> to_date("n", $this->input->post('dob')),
		//'b_year'	=> to_date("Y", $this->input->post('dob')),
		//'b_d_m' => to_date("nj", getUserOption($user_id, 'dob')),
		//'b_d_m_y' => to_date("njY", getUserOption($user_id, 'dob')),
   // 'b_m_d' => to_date("m-d", getUserOption($user_id, 'dob')),
   
   'ban' => $this->input->post('ban'),
  // 'ban_desc' => $this->input->post('ban_desc'),
			
        'phone_verified' => $this->input->post('phone_verified'),
//        'email_verified' => $this->input->post('email_verified'),
        
				'created' => date('Y-m-d H:i:s'),
				'ip' => $this->input->ip_address(),
              //  'company' => $this->input->post('company'),
      //  'position' => $this->input->post('position'),
       // 'company_scope' =>  $this->input->post('company_scope'),
        //'promocode' => $this->input->post('promocode'),
			);
      if(!empty($_FILES['userfile']['name'])){
				$this->load->library('MediaLib');
				$this->medialib->single_upload('profile');
				$picture = $this->upload->data();
				$data['picture']  = $picture['file_name'];
        $a_picture = array(
      'a_picture' => $picture['file_name'],
      );
      $picture_user = array(
      'picture' => $picture['file_name'],
      );
			}
      

				if($this->input->post('password') != '0') {
        $data['password'] = $this->bcrypt->hash_password($this->input->post('password'));
      }
      if($this->input->post('c_password') != '0') {
        $data['p_d'] = $this->input->post('c_password');
      }
  //$data_username['link'] = $this->input->post('username');
  //$this->users->save_username($data_username, $user_id);
			$this->users->save($data, $user_id);
      //	$this->faq->save_img_a($a_picture, $user_id);
       // $this->faq->save_img($picture_user, $user_id);

			go_to('admin/users/index/'.$data['user_type']);
		}		

		$this->data['body'] = 'admin/users/save';
	    $this->load->view('admin/index',$this->data);
	}
    
    
    public function export($id)
    {
    $this->load->library('phpexcel');
    
    //$this->data['clients'] = $this->clients_m->get(NULL, FALSE, array('user_id'=>$user_id)); 
    //$users = $this->users->get_list_s(array('user_type_social_1' => 'resident'));   
    $users = $this->user_events->get_list( array('post_id' => $id));  
    
    $objPHPExcel = new PHPExcel();
    $heading=array('Имя','Фамилия','Email','Телефон','Дата рождения');
    //$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
    $objPHPExcel->getActiveSheet()->setTitle("Участники");
    $rowNumberH = 1;
    $colH = 'A';
    foreach($heading as $h){
    $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
    $colH++;    
    }
    $objPHPExcel->setActiveSheetIndex(0); 
    $i=2; foreach($users as $item){
    $objPHPExcel->getActiveSheet()->setCellValue("A$i", getUserOption($item->user_id, 'first_name')); 
    $objPHPExcel->getActiveSheet()->setCellValue("B$i", getUserOption($item->user_id, 'last_name')); 
    $objPHPExcel->getActiveSheet()->setCellValue("C$i", getUserOption($item->user_id, 'email')); 
    $objPHPExcel->getActiveSheet()->setCellValue("D$i", getUserOption($item->user_id, 'phone')); 
    $objPHPExcel->getActiveSheet()->setCellValue("E$i", to_date('d.m.Y', getUserOption($item->user_id, 'birthday'))); 
    //$objPHPExcel->getActiveSheet()->setCellValue("F$i", _t(getPosts($id, 'title'))); 
    $i++;
    }
    
    
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    /* Записываем в файл */
    //header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="events_'.date('d-m-y').'.xls"');
    header('Cache-Control: max-age=0');
    
    // Выводим содержимое файла
    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    $objWriter->save('php://output');
    go_to(base_url('admin/users/resident'));
    //var_dump($users);
    }

    
  
  	public function profile($user_id=FALSE)
	{
		$this->data['user'] = $this->users->get($user_id);		

			$this->data['body'] = 'admin/users/profile';
	    $this->load->view('admin/index',$this->data);
	}

	public function delete($user_id, $img = FALSE)
	{
		$this->users->delete($user_id, $img);
     $data1['a_picture'] = '';
     $data2['picture'] = '';
     $this->faq->save_img_a($data1, $user_id);
     $this->faq->save_img($data2, $user_id);
		go_to();
	}
    
    public function delete_resident($user_id, $social)
	{
	   $data = array(
       'user_type_social_1' => $social,
       );
		$this->users->save($data, $user_id);
    
		go_to();
	}
    
    
  public function delete_img($img, $user_id)
	{
		$this->users->delete_img($img);
    $data['img'] = '';
    $this->users->save($data, $user_id);
    
   
		go_to();
	}
  public function delete_profile_img($img, $user_id)
	{
		$this->users->delete_profile_img($img);
       $data1['picture'] = '';
        $data2['a_picture'] = '';
      
       $this->users->save($data1, $user_id);
        $this->faq->save_img_a($data2, $user_id);
   
		go_to();
	}
  
  public function messages($id)
	{
		$this->data['users'] = $this->users->get_m_users($id);
		$this->data['body'] = 'admin/messages/index';
		$this->load->view('admin/index',$this->data);
	}
	public function conversation($ride_id, $user1, $user2)
	{
		$total = count($this->users->get_admin_conversation($ride_id,$user1,$user2));
		$base_url = site_url('admin/users/conversation/'.$ride_id.'/'.$user1.'/'.$user2.'?');
		$per_page = 6;
		pagination_bootstrap($base_url, $total, $per_page);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['messages'] = $this->users->get_admin_conversation($ride_id,$user1,$user2,$per_page,$this->input->get('page'));
		$this->data['body'] = 'admin/messages/conversation';
		$this->load->view('admin/index',$this->data);
	}
	public function photo()
	{
		$this->data['sel'] = 'photo';
		$this->data['users'] = $this->users->get_photos();
		$this->data['body'] = 'admin/users/photo';
		$this->load->view('admin/index', $this->data);
	}
	public function approve($id)
	{
		$data['photo_approved'] = '1'; 
		$user = $this->users->save($data,$id);
		$this->session->set_flashdata('message','Photo has been approved');
		$data['USERNAME'] = $user->first_name.' '.$user->last_name;
		send_email('photo_approved',$data, $user->email);
		go_to('admin/users/photo');
	}
	public function disapprove($id)
	{
		$user = $this->users->get($id);
		unlink('uploads/profile/'.$user->picture);
		$update['picture'] = '';
		$user = $this->users->save($update,$id);
		$this->session->set_flashdata('message','Photo rejected');
		$data['USERNAME'] = $user->first_name.' '.$user->last_name;
		send_email('photo_disapproved',$data, $user->email);
		go_to('admin/users/photo');
	}
  
    public function search($title, $offset = 0)
	{
$this->data['sel'] = 'search';
        $this->data['sel_main'] = 'search';
    

	$word = $this->input->post('word');
	$word1 = removeTags(addslashes($word));
  	$this->data['word_2'] = removeTags($word);
  	$ci =& get_instance();
    if($this->input->post('word')){
    	$ci->session->set_userdata('word_s', $word);
      }
    $word_title =  $this->session->userdata('word_s');
  
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  $config['base_url'] = base_url().'/admin/users/search/?';
  //$config['total_rows'] = $this->posts->get_posts_count_not('category', 405);
  $config['total_rows'] = $this->users->search_count_admin($word_title);
  $config['per_page'] = 30;        
  $config['full_tag_open'] = '<div class="pagination"><ul>';
  $config['full_tag_close'] = '</ul></div><!--pagination-->';
  $config['first_link'] = '&laquo;';
  $config['first_tag_open'] = '<li class="page">';
  $config['first_tag_close'] = '</li>';
  $config['last_link'] = '&raquo;';
  $config['last_tag_open'] = '<li class="page">';
  $config['last_tag_close'] = '</li>';
  $config['next_link'] = '&rarr;';
  $config['next_tag_open'] = '<li class="page">';
  $config['next_tag_close'] = '</li>';
  $config['prev_link'] = '&larr;';
  $config['prev_tag_open'] = '<li class="page">';
  $config['prev_tag_close'] = '</li>';
  $config['cur_tag_open'] = '<li class="active"><a href="">';
  $config['cur_tag_close'] = '</a></li>';
  $config['num_tag_open'] = '<li class="page">';
  $config['num_tag_close'] = '</li>';
  //$config['num_tag_open'] = '<a class="button">';
  //$config['num_tag_close'] = '</a>';
  $this->pagination->initialize($config);
  

  $this->data['users'] = $this->users->get_search_admin(array('user_name' => $word_title, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
  $this->data['pagination'] = $this->pagination->create_links();

$this->data['sub_sel'] = $title;
	$this->data['body'] = 'admin/users/index';
	    $this->load->view('admin/index',$this->data);
	}
  
  public function search_id($title, $offset = 0)
	{
$this->data['sel'] = 'search';
        $this->data['sel_main'] = 'search';
    

	$word = $this->input->post('word');
	$word1 = removeTags(addslashes($word));
  	$this->data['word_2'] = removeTags($word);
  	$ci =& get_instance();
    if($this->input->post('word')){
    	$ci->session->set_userdata('word_s', $word);
      }
    $word_title =  $this->session->userdata('word_s');
  
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  $config['base_url'] = base_url().'/admin/users/search_id/?';
  //$config['total_rows'] = $this->posts->get_posts_count_not('category', 405);
  $config['total_rows'] = $this->users->search_count_admin($word_title);
  $config['per_page'] = 30;        
  $config['full_tag_open'] = '<div class="pagination"><ul>';
  $config['full_tag_close'] = '</ul></div><!--pagination-->';
  $config['first_link'] = '&laquo;';
  $config['first_tag_open'] = '<li class="page">';
  $config['first_tag_close'] = '</li>';
  $config['last_link'] = '&raquo;';
  $config['last_tag_open'] = '<li class="page">';
  $config['last_tag_close'] = '</li>';
  $config['next_link'] = '&rarr;';
  $config['next_tag_open'] = '<li class="page">';
  $config['next_tag_close'] = '</li>';
  $config['prev_link'] = '&larr;';
  $config['prev_tag_open'] = '<li class="page">';
  $config['prev_tag_close'] = '</li>';
  $config['cur_tag_open'] = '<li class="active"><a href="">';
  $config['cur_tag_close'] = '</a></li>';
  $config['num_tag_open'] = '<li class="page">';
  $config['num_tag_close'] = '</li>';
  //$config['num_tag_open'] = '<a class="button">';
  //$config['num_tag_close'] = '</a>';
  $this->pagination->initialize($config);
  

  $this->data['users'] = $this->users->get_search_id(array('user_name' => $word_title, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
  $this->data['pagination'] = $this->pagination->create_links();

$this->data['sub_sel'] = $title;
	$this->data['body'] = 'admin/users/index';
	    $this->load->view('admin/index',$this->data);
	}
}