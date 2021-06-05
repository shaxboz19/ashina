<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		  $this->load->model('site_model', 'site');
      $this->load->model('posts_model', 'posts');
        $this->load->model('menu_model', 'menu');
        $this->load->model('site_model', 'site');   
        //$this->load->model('polls_model', 'polls'); 
        //$this->load->model('postsu_model', 'postsu'); 
        //Выборка данных пользователя без айди
        //$this->load->model('posts_uo_model', 'posts_uo');
		$settings = get_settings();
		$this->load->vars(array('settings'=>$settings));
    /*if(!$this->session->userdata('currency'))
			$this->session->set_userdata('currency','usd');*/
		$this->load->model('users_model','users');
		$this->data['count_msg'] = array();// $this->users->get_messages($this->session->userdata('user_id'),'unread');
		if($this->session->userdata('user_id')){
		/*	$this->data['user_nots'] = $this->users->get($this->session->userdata('user_id'));
			$time_since = time()- $this->session->userdata('last_activity');
			$data['last_login'] = date('Y-m-d G:i:s');
			if ($time_since > 200){
			//	$this->db->update('users',$data,array('user_id' => $this->session->userdata('user_id')));
			}*/
		}
		header('Content-Type: text/html; charset=utf-8');
    // Выключение сайта
    $this->data['site_off'] = $this->site->get_site_off( array('group'=>'site_settings', 'alias'=>'meta_tags_home', 'status' => 'active', 'site_off' => 'yes') );
  }
}