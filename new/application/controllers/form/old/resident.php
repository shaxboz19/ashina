<?php

Class Resident extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        $this->load->model('contacts_model');   
        $this->load->library('email');
        $this->data['sel'] = 'feedback';

	}  
    
    
    public function index()
  {  
     if(@$_SERVER["HTTP_REFERER"]){
    $this->form_validation->set_rules('name', 'Фамилия Имя', 'trim|required');
    $this->form_validation->set_rules('bdate', 'Дату рождения', 'trim|required');
    $this->form_validation->set_rules('pochta', 'lang:email', 'trim|required|valid_email');    
    $this->form_validation->set_rules('phone', 'Контактный телефон', 'trim|required');
  
  
   if ($this->form_validation->run()) {    
  //	$subject = $this->input->post('subject');
  	$subject = 'Регистрация резидента';
    $name = $this->input->post('name');
    $bdate = $this->input->post('bdate');    
    $email = $this->input->post('pochta');
  	$phone = $this->input->post('phone');    
    $company = $this->input->post('company');
    $position = $this->input->post('position');
    $company_scope = $this->input->post('company_scope');
    $promo_code = $this->input->post('promocode');
    

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
    Фамилия Имя: '.$name.'<br />
    Дата рождения: '.$bdate.'<br />
    E-mail: '.$email.'<br />
  	Контактный телефон: '.$phone.'<br />
    Компания: '.$company.'<br />
    Должность: '.$position.'<br />
    Сфера деятельности компании: '.$company_scope.'<br />
    Промокод: '.$promo_code.'<br />
  	</body>
  	</html>';
    
    $body1 =
      	'
       Фамилия Имя: '.$name.'<br />
    Дата рождения: '.$bdate.'<br />
    E-mail: '.$email.'<br />
  	Контактный телефон: '.$phone.'<br />
    Компания: '.$company.'<br />
    Должность: '.$position.'<br />
    Сфера деятельности компании: '.$company_scope.'<br />
    Промокод: '.$promo_code.'<br />
        ';
  
    $this->email->from('Уведомление');
    //$this->email->to('online_service_group@mail.ru');
    $this->email->to('info@groundzero.uz');
    $this->email->reply_to($this->input->post('pochta'));
    $this->email->subject($subject);
    $this->email->message($body);

    
    $data = array();
    $data['name']   = $this->input->post('name');
    $data['email']  = $this->input->post('pochta');
    $data['message'] = $body1;
     $data['phone'] = $this->input->post('phone');
    $data['date'] = date('Y-m-d H:i:s');
    $data['ip']     = $this->input->ip_address();
    
      if($email){ 
    if($this->email->send()){
                 
       $this->contacts_model->save($data,'');
        $return['result'] = '<span style="color: #000"><h4>Ваша заявка принята</h4></span>';
      $this->output->set_content_type('application/json')
      ->set_output(json_encode($return));   
      
      
        } 
       } else {
        $this->contacts_model->save($data,'');
        $return['result'] = '<span style="color: #000"><h4>Bot detected! =P</h4></span>';
      $this->output->set_content_type('application/json')
      ->set_output(json_encode($return));   
       }
    }
    else
    {
      $return['result'] = '<span style="color: #e61400"><h4>Ошибка!</h4>'. validation_errors(). '</span>';
      $this->output->set_content_type('application/json')
      ->set_output(json_encode($return));
    }
    }else{
        go_to(site_url());
    }
  }
}