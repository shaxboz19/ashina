<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Comments extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
          $this->load->model('comments_model', 'comments'); 
        $this->load->model('feed_model'); 
        $this->load->library('email');
        $this->data['sel'] = 'feedback';
	}  
    public function index()
  {  
     if(@$_SERVER["HTTP_REFERER"]){
        if($this->session->userdata('user_id')){
            //$this->form_validation->set_rules('name', 'Имя', 'trim|required');   
            //$this->form_validation->set_rules('pochta', 'lang:email', 'trim|required|valid_email'); 
            $this->form_validation->set_rules('comment_text', 'lang:vash_otziv', 'trim|required');   
            //$this->form_validation->set_rules('phone', 'Контактный телефон', 'trim|required');
            //$this->form_validation->set_rules('g-recaptcha-response', 'каптчу', 'required|callback_validate_captcha');
            //$this->form_validation->set_rules('captcha', 'lang:captcha_error',  "callback__captcha_check", 'trim|required|xss_clean');
            if ($this->form_validation->run()) {         
                $data = array();
                $data['post_id']   = $this->input->post('id');
                $data['user_id']  = $this->session->userdata('user_id');
                //$data['rating']  =$this->input->post('rating');
                $data['comment_text'] = removeTags($this->input->post('comment_text'));
                // $data['name'] = $this->input->post('name');
              // $data['groups'] = 'product';
               $data['alias'] = 'blog';
                // $data['phone'] = '+998' . $this->input->post('phone');
                $data['date'] = date('Y-m-d H:i:s');
               // $data['ip']     = $this->input->ip_address();
                $this->session->set_flashdata('success', lang('success_send'));
                $this->comments->save($data,'');
                go_to();          
            }
            else
            {
             $this->session->set_flashdata('error_success', lang('success_email_error1'). validation_errors() );
              go_to();
            } 
        }else{
             $this->session->set_flashdata('error_success', lang('reg_site_or_login'));
          go_to();
        }
    }else{
        $this->session->set_flashdata('error_success', lang('success_email_error1'));
        go_to(site_url());
    }
  }
  
  public function _captcha_check()
    {
        $expiration = time() - 7200; // Two hour limit
        $cap = $this->input->post('captcha');
        if ($this->session->userdata('word') == $cap and $this->session->userdata('ip_address') ==
            $this->input->ip_address() and $this->session->userdata('captcha_time') > $expiration)
        {
            return true;
        } else
        {
            $this->form_validation->set_message('_captcha_check', '%s');
            return false;
        }
    }
}