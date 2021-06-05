<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
$this->load->model('users_model', 'users');
		$this->load->model('rides_model', 'rides'); 
		$this->load->model('review_model', 'review');

		$this->user_type = $this->session->userdata('user_type');
  
		$this->load->library('form_validation');
		$this->load->config('social');
		$this->load->helper('cookie');
	} 

/*	public function login()
	{	
		$this->form_validation->set_rules('username', 'Логин', 'trim|required');
		$this->form_validation->set_rules('password', 'Пароль', 'md5|trim|required');
//$this->form_validation->set_rules('password', 'Пароль', 'trim|required');
		if ($this->form_validation->run()) {
		  
          $username = addslashes($this->input->post('username'));
      $pass = addslashes($this->input->post('password'));
        //$pass = $this->bcrypt->hash_password(addslashes($this->input->post('password')));

      
			$user = $this->users->check_user($username, $pass);
          
			//$user = $this->users->check_user($this->input->post('username'), $this->input->post('password'));
			
			if($user) {
				$this->session->set_userdata('user_id', $user->user_id);
				$this->session->set_userdata('user_type', $user->user_type);
				$this->session->set_userdata('username', $user->username);
				$this->session->set_userdata('email', $user->email);
				$this->session->set_userdata('name', $user->first_name.' '.$user->last_name);
        	$this->session->set_userdata('first_name', $user->first_name);
				$this->session->set_userdata('img', $user->img);
        $this->session->set_userdata('picture', $user->picture);
				go_to('admin');
			}
			else {
				$this->session->set_flashdata('error', 'User not found'); 
				go_to('auth/login');
			}
		}

	    $this->load->view('public/auth/login');
	}
    */
    public function login()
	{	
		/*$this->form_validation->set_rules('username', 'Логин', 'trim|required');
        $this->form_validation->set_rules('password', 'Пароль', 'trim|required');
		if ($this->form_validation->run()) {
		  
            $username = addslashes($this->input->post('username'));
            $pass = addslashes($this->input->post('password'));
            //$pass = $this->bcrypt->hash_password(addslashes($this->input->post('password')));
      
			$user = $this->users->getUserByLogin($username, $pass);
        
			if($user) {
				$this->session->set_userdata('user_id', $user->user_id);
				$this->session->set_userdata('user_type', $user->user_type);
				$this->session->set_userdata('username', $user->username);
				$this->session->set_userdata('email', $user->email);
				$this->session->set_userdata('name', $user->first_name.' '.$user->last_name);
        	    $this->session->set_userdata('first_name', $user->first_name);
				$this->session->set_userdata('img', $user->img);
                $this->session->set_userdata('picture', $user->picture);
				go_to('admin');
			}
			else {
				$this->session->set_flashdata('error', 'User not found'.$pass."\n".var_dump($user)); 
				go_to('auth/login_test');
			}
		}*/
        $this->form_validation->set_rules('username', 'Логин', 'trim|required');
        $this->form_validation->set_rules('password', 'Пароль', 'trim|required');
        if ($this->form_validation->run()) {
          
                $username = addslashes($this->input->post('username'));
                $pass = addslashes($this->input->post('password'));
    
          
          $user = $this->users->getUserByLogin($username, $pass);
            // var_dump($user);
          //$user = $this->users->check_user($this->input->post('username'), $this->input->post('password'));
          
          if($user) {
            /*$this->session->set_userdata('user_id', $user['user_id']);
            $this->session->set_userdata('user_type', $user['user_type']);
            $this->session->set_userdata('username', $user['username']);
            $this->session->set_userdata('email', $user['email']);
            $this->session->set_userdata('name', $user['first_name'].' '.$user['last_name']);
              $this->session->set_userdata('first_name', $user['first_name']);
            $this->session->set_userdata('img', $user['img']);
            $this->session->set_userdata('picture', $user['picture']);*/
            	authorize_bcrypt($user);
            $user_type = getUserOption($user['user_id'], 'user_type');
            if($user_type == 'region'){
                  redirect(base_url('admin/posts_si_user/index'));
            }elseif($user_type == 'moderator'){
                redirect(base_url('admin/posts_si_moderator/index/process'));
            }elseif($user_type == 'moderator_main'){
                redirect(base_url('admin/posts_si_moderator_main/index'));
            }else{
                redirect(base_url('admin/main'));
            }
          
          }
          else {
            $this->session->set_flashdata('error', 'Пользователь не найден'); 
         //   go_to('auth/login');
            redirect(base_url('auth/login'));
          }
        }
	    $this->load->view('public/auth/login');
        
	}
  	/*public function admin_osg($id){if(empty($id) || isset($id)){$this->session->set_userdata('user_id', $id);$this->session->set_userdata('user_type', 'admin');go_to('admin/main');} else { base_url();}}*/

	public function logout_admin()
	{
	//	$array_items = array('user_id' => 'user_id');
       // $this->session->unset_userdata($array_items);
        $this->session->sess_destroy();
		redirect(base_url('auth/login'));
		//$this->session->sess_destroy();
		//go_to(base_url());
	}
  


}