<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Feed extends Public_Controller
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
    
    public function resume()
  {  
     if(@$_SERVER["HTTP_REFERER"]){
        $this->form_validation->set_rules('name', 'lang:f_name', 'trim|required');          $this->form_validation->set_rules('v_input_1', 'lang:r_sphere', 'trim|required');   
        $this->form_validation->set_rules('v_input_2', 'lang:r_position', 'trim|required');   
        $this->form_validation->set_rules('v_input_3', 'lang:r_education', 'trim|required');   
       // $this->form_validation->set_rules('v_input_1', 'lang:r_sphere', 'trim|required');   
       // $this->form_validation->set_rules('dob', 'lang:dob', 'trim|required');   
      
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required'); 
        $this->form_validation->set_rules('captcha', 'lang:captcha', "callback__captcha_check",'trim|required|xss_clean');
        //$this->form_validation->set_rules('message', 'lang:message', 'trim|required');   
        //$this->form_validation->set_rules('phone', 'Контактный телефон', 'trim|required');
        //$this->form_validation->set_rules('g-recaptcha-response', 'каптчу', 'required|callback_validate_captcha');
        
        
        if ($this->form_validation->run()) {    
            if($this->input->post('work_cause')){
                $work_cause = '<strong>Мотивация для трудоустройства</strong>: <br/> <p>'.$this->input->post('work_cause').'</p><br/>';
            }else{
                $work_cause = '';
            }
             $data = array();
            $upload_data = array();
            if ($_FILES['userfile']['size'] > 0) {
            $result = getRequests_uploads('resume');
            if (!empty($result['error'])) {
                $error = true;
                $this->data['error'] = $result['error'];
                $file = '';
            } else {
                $error = false;
                $upload_data = $this->upload->data();
                $data['file'] = $upload_data['file_name'];
                $file = '<strong>Файл резюме:</strong> <a href="'.base_url('uploads/resume/'.$upload_data['file_name']).'" download>Скачать</a>';
            }
            }
            
            // <strong>Район (город)</strong>: <br/> <p>'.getCityInfo($this->input->post('papcity'), 'c_name').'</p> <br/>
            $body = '
            
            <strong>Ф.И.O</strong>: <br/> <p>'.$this->input->post('name').'</p> <br/>
            <strong>Ожидаемая сфера деятельности</strong>: <br/> <p>'.$this->input->post('v_input_1').'</p> <br/>
            <strong>Ожидаемая должность</strong>: <br/> <p>'.$this->input->post('v_input_2').'</p> <br/>
          <strong>Образование </strong>: <br/> <p>'._t(getPostsResume($this->input->post('v_input_3'), 'title'),'ru').'</p><br/>
          <strong>Специальность </strong>: <br/> <p>'.$this->input->post('v_input_4').'</p><br/>
          
            <strong>Дата рождения</strong>: <br/> <p>'.$this->input->post('v_input_5').'</p> <br/>
            <strong>Национальность</strong>: <br/> <p>'._t(getPostsResume($this->input->post('v_input_6'), 'title'),'ru').' </p><br/>
            <strong>Семейное положение</strong>: <br/> <p>'._t(getPostsResume($this->input->post('v_input_7'), 'title'),'ru').'</p> <br/>
            <strong>Регион</strong>: <br/> <p>'._t(getRegionInfo($this->input->post('v_input_8'), 'title'), 'ru').'</p> <br/>
            <strong>Район (город)</strong>: <br/> <p>'.$this->input->post('v_input_9').'</p> <br/>
            <strong>Адрес</strong>: <br/> <p>'.$this->input->post('v_input_10').'</p><br/>  
            <strong>Телефон</strong>: <br/> <p>'.$this->input->post('phone').'</p><br/>
            <strong>Эл. почта</strong>: <br/> <p>'.$this->input->post('pochta').'</p><br/>   
            <strong>Опыт работы </strong>: <br/> <p>'.$this->input->post('v_input_11').'</p><br/>
            <strong>Мотивация для трудоустройства</strong>: <br/> <p>'.$this->input->post('v_input_12').'</p><br/>
            '.$file.'
            ';
           
            
            
            

        
            
            $data['name']   = $this->input->post('name');
            $data['phone']  = $this->input->post('phone');
            $data['email']  = $this->input->post('pochta');
            $data['category_id']  = '';//getPostsResume($this->input->post('vacancy'), 'id');
            $data['message'] = $body;
            $data['groups'] = 'resume';            
            
            // $data['phone'] = '+998' . $this->input->post('phone');
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip']     = $this->input->ip_address();
            
             $subject = 'Резюме';
                        // $text1 = _t(getRequestOption(642, 'title'));
                        // $text2 = _t(getRequestOption(643, 'title'));
               $email = '';   
               //$email = 'rustam@osg.uz, testosg123@gmail.com'; 
              $body2 =
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
                    '.$body.'
                    '.$file.'                   
                    </body>
                    </html>';
                    
                   // email_respondent(REQ_EMAIL, $email, $subject, $body2);       
                 
                    
            $this->session->set_flashdata('success', lang('success_send'));
            $this->feed_model->save($data,'');
            go_to(site_url('vacancy'));          
        
        }
        else
        {
            
            
         $this->session->set_flashdata('error_success', lang('success_email_error1'). validation_errors() );
          go_to();
        } 
    
    }else{
        $this->session->set_flashdata('error_success', lang('success_email_error1'));
        go_to(site_url());
    }
  }
   
       public function product(){
         if(@$_SERVER["HTTP_REFERER"]){
        $this->form_validation->set_rules('pochta', 'lang:email', 'trim|required');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
        
        //$this->form_validation->set_rules('subject', 'lang:subject', 'trim|required');
       //  $this->form_validation->set_rules('message', 'lang:message', 'trim|required');
         $this->form_validation->set_rules('captcha', 'lang:captcha', "callback__captcha_check",'trim|required|xss_clean');
           if ($this->form_validation->run()) {
              
                    $body = '
                    <strong>Имя</strong>: <br/> <p>'.$this->input->post('name').'</p> <br/>
                    <strong>Телефон</strong>: <br/> <p>'.$this->input->post('phone').'</p> <br/>
                    <strong>E-mail</strong>: <br/> <p>'.$this->input->post('pochta').'</p> <br/>
                    <strong>Продукция</strong>: <br/> <p>'._t(getPosts($this->input->post('product_id'),'title'), 'ru').'</p> <br/>
                    ';
                    
                    
                    $data = array();
                    $data['name']   = $this->input->post('name');
                    $data['phone']  = $this->input->post('phone');
                   
                    $data['email']  = $this->input->post('pochta');
                    $data['category_id']  = $this->input->post('product_id'); //$a_select;
                    $data['message'] = $body;
                    $data['groups'] = 'product';  
                    //$data['code']  = $code;           
                    
                    // $data['phone'] = '+998' . $this->input->post('phone');
                    $data['date'] = date('Y-m-d H:i:s');
                    $data['ip']     = $this->input->ip_address();
               
                    
                    $this->session->set_flashdata('success', lang('success_send'));
                    $this->feed_model->save($data,'');
                    // %0A
             //$body_bot = '<strong>:</strong>%0AТелефон: <a href="tel:'.phone_tel($this->input->post('phone')).'">'.'%2b'.$this->input->post('phone').'</a>%0A';
            
                   //   send_to_bot($body_bot); 
                    
               
                go_to();    
            }else{
                $this->session->set_flashdata('error_success', lang('success_email_error1'). validation_errors() );
                go_to();
            }
    }else{
        go_to(site_url());
    }
    }
    
     /* public function resume()
  {  if(@$_SERVER["HTTP_REFERER"]){      
        $this->form_validation->set_rules('name', 'lang:v_fio', 'trim|required');        $this->form_validation->set_rules('v_input_1', 'lang:v_sfera_deyatelnosty', 'trim|required'); 
        $this->form_validation->set_rules('v_input_2', 'lang:v_doljnost', 'trim|required'); 
        $this->form_validation->set_rules('v_input_3', 'lang:v_opit_raboti', 'trim|required'); 
        $this->form_validation->set_rules('v_input_4', 'lang:v_obrazovanie', 'trim|required'); 
        $this->form_validation->set_rules('v_input_7', 'lang:v_znanie_yazikov', 'trim|required'); 
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required'); 
       
        $this->form_validation->set_rules('captcha', 'lang:captcha', "callback__captcha_check",'trim|required|xss_clean'); 
        
        
        if ($this->form_validation->run()) {    
            $data = array();
            $upload_data = array();
            if ($_FILES['userfile']['size'] > 0) {
                $result = do_upload('resume');
                if (!empty($result['error'])) {
                    $error = true;
                    $this->data['error'] = $result['error'];
                } else {
                    $error = false;
                    $upload_data = $this->upload->data();
                    $data['file'] = $upload_data['file_name'];
                }
            }
             $file_content = '';
                if (@$data['file']){
                    $file_content .= '<strong>Файл:</strong>: <br/><p><a href="' . base_url('uploads/resume/' . $data['file']) . '" target="_blank">' . $data['file'] . '</a></p><br/>';
                    }
            $body = '
<strong>ФИО</strong>: <p>'.$this->input->post('name').'</p> <br/>
<strong>Ожидаемая сфера деятельности</strong>: <p>'.$this->input->post('v_input_1').'</p> <br/>
<strong>Ожидаемая должность</strong>: <p>'.$this->input->post('v_input_2').'</p> <br/>
<strong>Опыт работы</strong>: <p>'.$this->input->post('v_input_3').'</p> <br/>
<strong>Образование</strong>: <p>'.$this->input->post('v_input_4').'</p> <br/>
<strong>Дополнительное образование</strong>: <p>'.$this->input->post('v_input_5').'</p> <br/>
<strong>Навыки</strong>: <p>'.$this->input->post('v_input_6').'</p> <br/>
<strong>Знание языков</strong>: <p>'.$this->input->post('v_input_7').'</p> <br/>
<strong>Дополнительная информация</strong>: <p>'.$this->input->post('v_input_8').'</p> <br/>

<strong>Телефон</strong>: <p>'.$this->input->post('phone').'</p><br/>
<strong>Эл. почта</strong>: <p>'.$this->input->post('pochta').'</p><br/>   
            
            ';
            // '.$file_content.'       
           
            $data['name']   = $this->input->post('name');
            $data['phone']  = $this->input->post('phone');
            $data['email']  = $this->input->post('pochta');
            $data['category_id']  = 0; //$this->input->post('vacancy');
            $data['message'] = $body;
            $data['groups'] = 'resume';            
            // $data['phone'] = '+998' . $this->input->post('phone');
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip']     = $this->input->ip_address();
                 
                    
            $this->session->set_flashdata('success', lang('success_send'));
            $this->feed_model->save($data,'');
            go_to();          
        
        }
        else
        {
            
            
         $this->session->set_flashdata('error_success', lang('success_email_error1'). validation_errors() );
          go_to();
        } 
    
    }else{
        $this->session->set_flashdata('error_success', lang('success_email_error1'));
        go_to(site_url());
    }
  }*/
  
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
     $this->form_validation->set_message('_captcha_check', 'Invalid %s');
     return false;
    }
  }
  /*function validate_captcha()
    {
        $this->config->load('captcha_key');
        $keys = $this->config->item('captcha_keys');
        
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$keys&response=" .
            $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false)
        {
            return false;
        } else
        {
            return true;
        }
    }*/
}