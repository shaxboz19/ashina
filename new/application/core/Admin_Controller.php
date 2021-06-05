<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ( $this->session->userdata('user_id') )
		{
            $user_type = getUserOption($this->session->userdata('user_id'), 'user_type');
            $this->data['user_type'] = $user_type;
			if ($user_type !== 'admin' and $user_type !== 'region' and $user_type !== 'moderator' and $user_type !== 'moderator_main')
				go_to(site_url('auth/login'));
		}
		else
		{
			go_to('auth/login');
		}
        $this->data['user_id_main'] = $this->session->userdata('user_id');
      //  $this->load->model('faq_model','faq');
        //$this->data['count_msg'] = $this->faq->get_new_message($group = '0');
        // $this->data['get_faq'] = $this->faq->get_no_read(array('limit' => '5'));
        $this->load->helper('admin');
        // Load Language
        $this->load->language('admin');
        // Load Libraries
        $this->load->library('form_validation');
      //  $this->load->model('posts_model', 'admin');
      //  $this->data['user_types'] = array('user','admin','moderator_main','moderator','region');
      // ,'moderator_main','moderator','region'
       $this->data['user_types'] = array('admin');     
        $this->data['sel_users'] = '';
         $this->data['sel_sub'] = '';
        
	}
}
?>