<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Question extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        $this->load->model('contacts_model');  
        $this->load->model('order_model'); 
        $this->load->model('feed_model'); 
        $this->load->library('email');
        $this->data['sel'] = 'feedback';
	} 
   
    
      public function index()
  {  
     if(@$_SERVER["HTTP_REFERER"]){
    $this->form_validation->set_rules('pochta', 'lang:email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('message', 'lang:message', 'trim|required');
        $this->form_validation->set_rules('captcha', 'lang:captcha_error', "callback__captcha_check",'trim|required|xss_clean');
        


        if ($this->form_validation->run()) {
            $email_question = trim(getPosts($this->input->post('question'), 'options'));
            if($email_question){
            //	$subject = $this->input->post('subject');
            $subject = 'Савол ва жавоб';
            $name = $this->input->post('name');
            $message = $this->input->post('message');
//            $phone = $this->input->post('phone');
            //$subject1 = $this->input->post('subject');
            $email =    $this->input->post('pochta');

            $body =
            '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          	<html xmlns="http://www.w3.org/1999/xhtml">
          	<head>
          	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          	<title>'.htmlspecialchars($subject, ENT_QUOTES, $this->email->charset).'</title>
          	<style type="text/css">
          	body {
          	font-family: Arial, Verdana, Helvetica, sans-serif;
          	font-size: 16px;
          	}
          	</style>
          	</head>
          	<body>
            
            Имя: '.$name.'<br />   
            E-mail: '.$email.'<br />  
            Сообщение: '.$message.'<br />
            
          	
          	</body>
          	</html>';
            //Телефон для контакта: '.$phone.'
            // Фамилия: '.$lastname.'<br />


            $this->email->from('info@' . $_SERVER['HTTP_HOST'], 'Савол ва жавоб');
            $this->email->to($email_question);
            $this->email->reply_to($email);
            $this->email->subject($subject);
            $this->email->message($body);

            $data = array();
            $data['name']   = $this->input->post('name');
            $data['email']  = $this->input->post('pochta');
            $data['message'] = $this->input->post('message');
//            $data['phone'] = $this->input->post('phone');
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip']     = $this->input->ip_address();


            if($this->email->send()){
                $this->session->set_flashdata('success', lang('success_send'));
               

                
                //echo "yes";
               
            }
            } 
            go_to();
        }
        else
        {
            $this->session->set_flashdata('error_success', '<p>'.lang('success_email_error1').'</p>'.validation_errors());
            go_to();
            //echo "yes";
        }
        }else{
             go_to(site_url());
        }
  }
  
  public function _captcha_check()
  {
    $expiration = time()-7200; // Two hour limit
    $cap=$this->input->post('captcha');
    if($this->session->userdata('word')== $cap
     AND $this->session->userdata('ip_address')== $this->input->ip_address()
     AND $this->session->userdata('captcha_time')> $expiration)
  {
   return true;
  }
  else{
     $this->form_validation->set_message('_captcha_check', '%s');
     return false;
    }
  }

}