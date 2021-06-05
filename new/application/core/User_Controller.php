<?php

class User_Controller extends MY_Controller
{
	public function __construct($offset = 0)
	{
		parent::__construct();

		$this->load->language('public');

        $this->load->model('category_model', 'categories');
        $this->load->model('postsu_model', 'postsu');
        $this->load->model('posts_model', 'posts');
        $this->load->model('menu_model', 'menu');
        $this->load->model('site_model', 'site');   
       	$this->load->model('polls_u_model', 'pollsu');
        $this->load->library('form_validation');    
   
       
        // Главное меню
        $this->data['menu_2'] = $this->posts->get_posts( array('group'=>'menu_b', 'order'=>'ASC', 'orderby'=>'order', 'limit' => '4', 'status' => 'active') );
        // $this->data['services'] = $this->posts->get_posts( array('group'=>'services', 'order'=>'ASC', 'orderby'=>'order', 'status' => 'active') );
        //  $this->data['mainMenu'] = $this->menu->getMenuTrees();
        //$this->data['menu'] = $this->menu->getMenuTreesMain();
        // Меню
        // $this->data['main_menu'] = $this->menu->getMenuTreesMain_2();
         $this->data['menu_title'] = array();
         $this->data['menu_title'] = $this->posts->get_posts( array('group'=>'menu', 'order'=>'DESC', 'orderby'=>'order', 'status' => 'active') );
  
        // Баннер 1
        $this->data['banner'] =$this->posts->get_posts_and_media_files(array('group'=>'banner', 'limit' => '2', 'order' => 'ASC', 'status' => 'active'));
        // Баннер 2
        $this->data['banner_1'] =$this->posts->get_posts_and_media_files(array('group'=>'banner_1', 'limit' => '10', 'order' => 'ASC',  'status' => 'active'));
    
      //  $this->data['news_slider'] = $this->postsu->get_posts_region(array('group' => 'news', 'status' => 'active', 'spec' => 'active', 'limit' => '3'));
        
        //$this->data['albums'] = $this->posts->get_posts(array('group' => 'albums', 'status' => 'active', 'limit' => '50'));
        //$this->data['trek'] = $this->posts->get_posts(array('group' => 'music', 'status' => 'active', 'limit' => '1'));
        // $this->data['trek_next'] = $this->posts->get_posts(array('group' => 'music', 'status' => 'active', 'limit' => '3'));
        // Слайдер 
        $this->data['sliders'] =$this->posts->get_posts(array('group' => 'slides', 'status' => 'active', 'limit' => '13'));
        // Парнеры 
      
      
          // Фото
        //$this->data['photo'] = $this->posts->get_posts(array('group' => 'gallery', 'status' => 'active', 'limit' => '1'));
        // Видео
        // $this->data['video'] = $this->posts->get_posts(array('group' => 'video', 'status' => 'active', 'limit' => '50'));
          // Концерты
        // $this->data['concerts'] = $this->posts->get_posts(array('group' => 'concerts', 'status' => 'active', 'limit' => '50'));
         
        
        //$this->data['imgs'] = $this->posts->get_posts_and_media_files(array('group' => 'gallery', 'status' => 'active', 'limit' => '6'));
        
         //$this->data['gallery'] = $this->posts->get_posts_and_media_files(array('group' => 'gallery', 'status' => 'active', 'limit' => '12'));
                       
        if(!$this->session->userdata('currency'))
        $this->session->set_userdata('currency','usd');
        
        $this->load->model('users_model','users');
        $this->data['count_msg'] = $this->users->get_messages($this->session->userdata('user_id'),'unread');
        
        if($this->session->userdata('user_id')){
        $this->data['user_nots'] = $this->users->get($this->session->userdata('user_id'));
        $time_since = time()- $this->session->userdata('last_activity');
        $data['last_login'] = date('Y-m-d G:i:s');
        if ($time_since > 200){
        $this->db->update('users',$data,array('user_id' => $this->session->userdata('user_id')));
        }
        }
        $this->data['users'] = $this->users->get_list('respondent');
        
        
        $this->data['sidebar'] =$this->posts->get_posts(array('group'=>'sidebar', 'limit' => '15'));
        //$this->data['docs'] =$this->posts->get_posts_public('docs', false, 2);
        $this->data['polls_u'] = $this->pollsu->get_all_polls_user(array('status' => 'active', 'user_id' => $this->session->userdata('user_id') , 'limit' => '1','order' => 'DESC'));
    
       $this->data['months_ru'] = array('1' => "Янв",'2' => "Фев",'3' => "Мар",'4' => "Апр",'5' => "Мая",'6' => "Июн", '7' => "Июл", '8' => "Авг",
        '9' => "Сен", '10' => "Окт", '11' => "Ноя",   '12' => "Дек", );
        $this->data['months_uz'] = array('1' => "Yan",'2' => "Fev", '3' => "Mart",'4' => "Apr",'5' => "May",'6' => "Iyun", '7' => "Iyul", '8' => "Avg",
        '9' => "Sen", '10' => "Okt", '11' => "Noy", '12' => "Dek", );
        $this->data['months_en'] = array('1' => "Jan",'2' => "Feb",'3' => "Mar",'4' => "Apr",'5' => "May",'6' => "Jun",'7' => "Jul",'8' => "Aug",'9' => "Sep",
         '10' => "Okt", '11' => "Nov", '12' => "Dec",);

if ( !$this->session->userdata('user_id') ){
	
			   
      go_to(site_url());
    }

	}
}