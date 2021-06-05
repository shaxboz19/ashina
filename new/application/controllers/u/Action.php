<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Action extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        $this->load->model('contacts_model');
        $this->load->model('order_model');
        $this->load->library('email');
        $this->data['sel'] = 'feedback';

    }
    
     public function calendar_plan(){     
       //  if(@$_SERVER["HTTP_REFERER"]){
            ini_set('max_execution_time', 0);
		    ini_set('max_input_time', 0);
            ini_set('memory_limit', '-1');
        // 'year' => date('Y'),
            $result=$this->posts->get_posts_p( array('group' => 'news', 'status_lang_'.LANG => 'active', 'order' => 'DESC', 'orderby' => 'created_on', 'status' => 'active') );
            //$data_title = array();
            $date_array = array();
            $i = 0; foreach($result as $item){
                                
                    $date_array[$i] = explode(',',$item->created_on);
               
                $data[$i] = date('D M d Y', strtotime($item->created_on));  
                $data1[$i] = date('Y-m-d', strtotime($item->created_on));                  
                $arraySpecial = array();                
            
            $i++; }
            
             foreach($date_array as $item){
                $i = 0;foreach($item as $item1){
                    $date4[] = date('D M d Y', strtotime($item1));
                    $data3[] = date('Y-m-d', strtotime($item1));
                     $data_title[] = array(                
                    'date_plan' =>  date('Y-m-d', strtotime($item1)),
                                    
                ); 
               $i++;  }
               
           }
        
          
            $arraySpecial = array();
             foreach($data_title as $item1 => $key){
                   $arraySpecial[$key['date_plan']] = $key['date_plan'];
                                                   
                }
                // Выбор из базы по дате
               // $data_title1 = array();
             $i1 = 0; foreach($arraySpecial as $item1){                  
                     $res = $this->posts->get_posts_p( array('group' => 'news', 'status_lang_'.LANG => 'active', 'order' => 'DESC', 'created_on' => $item1, 'orderby' => 'created_on', 'status' => 'active') );  
                    //  var_dump($res); 
                             foreach($res as $item){
                            $data_title1[] = array(                
                                'date_plan' =>  date('Y-m-d', strtotime($item1)),
                                'title' => _t($item->title, LANG),    
                                'count' => count($key)                
                            );                           
                        }             
                 $i1++;  } 
             
                      // Объединение по дате
                      $r = $this->by_data_plan($data_title1);
                            //var_dump($r);
                            foreach($r as $item=>$key){                              
                               $data_title2[] = array(                
                                'date_plan' =>  $item,
                                'title' => $key,    
                                'count_plan' => count($key).' Событие <br/>'                
                            );                   
                               
                      }             
           
            if(isset($data)){
              return $this->output->set_content_type('application/json')->set_output(json_encode(Array('result_1' => $date4, 'result_2' => $data3, 'res_1' => $date4, /*'title_plan' => $data_title,*/ 'count_title' => @$data_title2)));
            }else{
                $no = '';  
                return $this->output->set_content_type('application/json')->set_output(json_encode(Array('success' => false)));
            }
       /* }else{
            go_to(site_url());
        }*/
    }
    
    function by_data_plan($arr) {
      $result = array();
          foreach ($arr as $l) {
            $result[$l['date_plan']][] = $l['title'];
          }
      return $result;
    }


    public function q()
    {
        $this->form_validation->set_rules('pochta', 'lang:email',
            'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('message', 'lang:message', 'trim|required');
        // $this->form_validation->set_rules('captcha', 'Captcha', "callback__captcha_check",'trim|required|xss_clean');

        if (@$_SERVER["HTTP_REFERER"])
        {
            if ($this->form_validation->run())
            {

                //	$subject = $this->input->post('subject');
                $subject = 'Задать вопрос';
                $name = $this->input->post('name');
                $message = $this->input->post('message');
                $phone = $this->input->post('phone');

                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    	<html xmlns="http://www.w3.org/1999/xhtml">
    	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                    '</title>
    	<style type="text/css">
    	body {
    	font-family: Arial, Verdana, Helvetica, sans-serif;
    	font-size: 16px;
    	}
    	</style>
    	</head>
    	<body>
      Имя: ' . $name . '<br >
      Сообщение: ' . $message . '<br />
      Телефон: ' . $phone . '
    	</body>
    	</html>';

                $body1 = '
      Имя: ' . $name . '<br >
      Сообщение: ' . $message . '<br />
      Телефон: ' . $phone . '
      ';

                $this->email->from('info@allescogroup.com', 'Задать вопрос');
                $this->email->to('testosg123@gmail.com');
                $this->email->reply_to($this->input->post('pochta'));
                $this->email->subject($subject);
                $this->email->message($body);

                $data = array();
                $data['name'] = 'Задать вопрос';
                $data['email'] = $this->input->post('pochta');
                $data['message'] = $body1;
                $data['phone'] = $this->input->post('phone');
                $data['date'] = date('Y-m-d H:i:s');
                $data['ip'] = $this->input->ip_address();


                if ($this->email->send())
                {
                    $this->session->set_flashdata('success', lang('success_send'));
                    $this->contacts_model->save($data, '');
                    go_to();
                }
            } else
            {
                $this->session->set_flashdata('error_success', lang('success_email_error1'));
                go_to();
            }
        } else
        {
            echo "<p style='text-align: center;'>Error! 404<p>";
        }

    }


    public function vacancy()
    {
        $this->form_validation->set_rules('pochta', 'lang:email',
            'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Код', "callback__captcha_check",
            'trim|required|xss_clean');


        if ($this->form_validation->run())
        {

            //	$subject = $this->input->post('subject');
            $subject = 'Вакансия';
            $name = $this->input->post('name');
            $message = $this->input->post('message');
            $phone = $this->input->post('phone');
            $lastname = $this->input->post('lastname');
            $pochta = $this->input->post('pochta');

            $email = trim(getSiteSettings(1, 'link'));

            if (!empty($_FILES['userfile']['name']))
            {
                $this->load->library('MediaLib');
                $this->medialib->single_upload('cv');
                $picture = $this->upload->data();
                // $data['img']  = $picture['file_name'];

                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  	<html xmlns="http://www.w3.org/1999/xhtml">
  	<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                    '</title>
  	<style type="text/css">
  	body {
  	font-family: Arial, Verdana, Helvetica, sans-serif;
  	font-size: 16px;
  	}
  	</style>
  	</head>
  	<body>
    Имя: ' . $name . '<br />
    E-mail: ' . $pochta . '<br />
    Сообщение: ' . $message . '<br />
  	Телефон для контакта: ' . $phone . '
  	</body>
  	</html>';

                $body1 = '
      Вакансия / Резюме: <br />
      Имя: ' . $name . '<br >
      E-mail: ' . $pochta . '<br />
      Сообщение: ' . $message . '<br />
      Прикрепленный файл: <a href="' . base_url('uploads/cv/' . $picture['file_name']) .
                    '">' . base_url('uploads/cv/' . $picture['file_name']) . '</a><br />
      Телефон: ' . $phone . '
      ';


                $this->email->from('info@' . $_SERVER['HTTP_HOST'], $subject);
                $this->email->to($email);
                $this->email->reply_to($this->input->post('pochta'));
                $this->email->subject($subject);
                $this->email->message($body);
                $this->email->attach('uploads/cv/' . $picture['file_name']);


            } else
            {
                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  	<html xmlns="http://www.w3.org/1999/xhtml">
  	<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                    '</title>
  	<style type="text/css">
  	body {
  	font-family: Arial, Verdana, Helvetica, sans-serif;
  	font-size: 16px;
  	}
  	</style>
  	</head>
  	<body>
    Имя: ' . $name . '<br />
    E-mail: ' . $pochta . '<br />
    Сообщение: ' . $message . '<br />
  	Телефон для контакта: ' . $phone . '
  	</body>
  	</html>';

                $body1 = '
        Вакансия / Резюме: <br />
      Имя: ' . $name . '<br >
     E-mail: ' . $pochta . '<br />
      Сообщение: ' . $message . '<br />      
      Телефон: ' . $phone . '
      ';


                $this->email->from('info@' . $_SERVER['HTTP_HOST'], $subject);
                $this->email->to($email);
                $this->email->reply_to($this->input->post('pochta'));
                $this->email->subject($subject);
                $this->email->message($body);
            }


            $data = array();
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('pochta');
            $data['message'] = $body1;
            $data['phone'] = $this->input->post('phone');
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip'] = $this->input->ip_address();


            if ($this->email->send())
            {

                $this->session->set_flashdata('success', lang('success_send'));
                $this->contacts_model->save($data, '');
                go_to();
            }
        } else
        {
            // $this->session->set_flashdata('error_success', lang('success_email_error1'));
            $this->session->set_flashdata('error_success', validation_errors());
            go_to();
        }
    }


    public function order()
    {
        //$this->form_validation->set_rules('pochta', 'lang:email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
        $this->form_validation->set_rules('message', 'lang:message', 'trim|required');
        // $this->form_validation->set_rules('captcha', 'Captcha', "callback__captcha_check",'trim|required|xss_clean');

        $email = trim(getSiteSettings(1, 'link'));
        if ($this->form_validation->run())
        {

            $subject = 'Заказать дизайн';
            $name = $this->input->post('name');
            $lastname = $this->input->post('lastname');
            $message = $this->input->post('message');
            $phone = $this->input->post('phone');
            //$product = $this->input->post('product');
            // $product = _t(getPosts(24, 'title'));
            $product_id = $this->input->post('product_id');

            $count = $this->input->post('count');

            $status = $this->input->post('status');

            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  	<html xmlns="http://www.w3.org/1999/xhtml">
  	<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                '</title>
  	<style type="text/css">
  	body {
  	font-family: Arial, Verdana, Helvetica, sans-serif;
  	font-size: 16px;
  	}
  	</style>
  	</head>
  	<body>
    Имя: ' . $name . '<br />       
    Сообщение: ' . $message . '<br />
  	Телефон для контакта: ' . $phone . '
  	</body>
  	</html>';

            $body1 = '
    <br />
   Имя: ' . $name . '<br />       
    Сообщение: ' . $message . '<br />
  	Телефон для контакта: ' . $phone . '
    ';

            $this->email->from('info');
            $this->email->to($email);
            //$this->email->reply_to($this->input->post('pochta'));
            $this->email->subject($subject);
            $this->email->message($body);

            $data = array();
            $data['name'] = 'Заказ';
            $data['email'] = $this->input->post('pochta');
            $data['message'] = $body1;
            $data['phone'] = $this->input->post('phone');
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip'] = $this->input->ip_address();


            if ($this->email->send())
            {

                $this->session->set_flashdata('success', lang('success_send'));
                $this->order_model->save($data, '');
                go_to();
            } else
            {
                $this->session->set_flashdata('error_success', lang('success_email_error1'));
                go_to();
            }
        } else
        {
            $this->session->set_flashdata('error_success', validation_errors());
            go_to();
        }


    }
    public function order_catalog()
    {
        //$this->form_validation->set_rules('pochta', 'lang:email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone_number', 'trim|required');
        $this->form_validation->set_rules('city', 'lang:enter_city', 'trim|required');
        // $this->form_validation->set_rules('message', 'lang:message', 'trim|required');
        //$this->form_validation->set_rules('captcha', 'lang:captcha_error', "callback__captcha_check",'trim|required|xss_clean');

        $email = trim(getSiteSettings(1, 'link'));
        if ($this->form_validation->run())
        {
            $product_id = $this->input->post('product_id');

            $product = _t(getPosts($product_id, 'title'));

            if (getPosts($product_id, 'id'))
            {

                $subject = 'Заказ: ' . $product;
                $name = $this->input->post('name');
                $lastname = $this->input->post('lastname');
                $message = $this->input->post('message');
                $city = $this->input->post('city');
                $phone = '+998 ' . $this->input->post('phone');
                //$product = $this->input->post('product');
                // $product = _t(getPosts(24, 'title'));
                // $product_id = $this->input->post('product_id');

                $count = $this->input->post('count');

                $status = $this->input->post('status');

                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  	<html xmlns="http://www.w3.org/1999/xhtml">
  	<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                    '</title>
  	<style type="text/css">
  	body {
  	font-family: Arial, Verdana, Helvetica, sans-serif;
  	font-size: 16px;
  	}
  	</style>
  	</head>
  	<body>
    Имя: ' . $name . '<br />   
    Телефон: ' . $phone . '<br />    
    Товар: ' . $product . '<br />
  	Город: ' . $city . '<br />
  	</body>
  	</html>';
                // Сообщение: '.$message.'<br />
                $body1 = '   
    Имя: ' . $name . '<br />       
    Телефон: ' . $phone . '<br />
    Товар: ' . $product . '<br />  	
    	Город: ' . $city . '<br />
    ';
                $phone2 = preg_replace('~\D~', '', $phone);
                $body_bot = '<strong>На сайте поступила заявка:</strong>%0AИмя: ' . $name .
                    '%0AТелефон: <a href="tel:+' . $phone2 . '">' . '%2b' . $phone2 .
                    '</a>%0AТовар: ' . $product . '%0AГород: ' . $city . '%0A';

                send_to_bot($body_bot);
                $this->email->from('info@' . $_SERVER['HTTP_HOST']);
                $this->email->to($email);
                //$this->email->reply_to($this->input->post('pochta'));
                $this->email->subject($subject);
                $this->email->message($body);

                $data = array();
                $data['name'] = $product;
                $data['email'] = $this->input->post('pochta');
                $data['message'] = $body1;
                $data['phone'] = $phone;
                $data['date'] = date('Y-m-d H:i:s');
                $data['ip'] = $this->input->ip_address();
            }

            if ($this->email->send())
            {

                $this->session->set_flashdata('success', /*lang('success_send').'<br/>'.*/ _t(getPosts
                    (84, 'content'), LANG));
                $this->order_model->save($data, '');
                go_to();
            } else
            {
                $this->session->set_flashdata('error_success', lang('success_email_error1'));
                go_to();
            }
        } else
        {
            $this->session->set_flashdata('error_success', validation_errors());
            go_to();
        }


    }


    public function callback()
    {
        //$this->form_validation->set_rules('pochta', 'lang:email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
        //$this->form_validation->set_rules('captcha', 'Captcha', "callback__captcha_check",'trim|required|xss_clean');

        $email = trim(getSiteSettings(1, 'link'));
        if ($this->form_validation->run())
        {

            $subject = 'Обратный звонок';
            $name = $this->input->post('name');
            $lastname = $this->input->post('lastname');
            $message = $this->input->post('message');
            $phone = $this->input->post('phone');
            $member = $this->input->post('member');
            $city = $this->input->post('city');
            $company = $this->input->post('company');

            $count = $this->input->post('count');

            $status = $this->input->post('status');

            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  	<html xmlns="http://www.w3.org/1999/xhtml">
  	<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                '</title>
  	<style type="text/css">
  	body {
  	font-family: Arial, Verdana, Helvetica, sans-serif;
  	font-size: 16px;
  	}
  	</style>
  	</head>
  	<body>
    Имя: ' . $name . '<br >   
    Телефон: ' . $phone . '
  	</body>
  	</html>';

            /*
            Название компании: '.$company.'<br >   
            Сообщение: '.$message.'<br />
            
            */

            $body1 = '
    Имя: ' . $name . '<br >   
    Телефон: ' . $phone . '
    ';

            $this->email->from('Обратный звонок');
            $this->email->to($email);
            $this->email->reply_to($this->input->post('pochta'));
            $this->email->subject($subject);
            $this->email->message($body);

            $data = array();
            $data['name'] = 'Обратный звонок';
            $data['email'] = $this->input->post('pochta');
            $data['message'] = $body1;
            $data['phone'] = $this->input->post('phone');
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip'] = $this->input->ip_address();


            if ($this->email->send())
            {

                $this->session->set_flashdata('success', lang('success_send'));
                $this->contacts_model->save($data, '');
                go_to();
            }
        } else
        {
            $this->session->set_flashdata('error_success', lang('success_email_error1'));
            go_to();
        }


    }

    public function feedback_new()
    {
        $this->form_validation->set_rules('pochta', 'lang:email',
            'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
        $this->form_validation->set_rules('captcha', 'lang:captcha_error',
            "callback__captcha_check", 'trim|required|xss_clean');


        if ($this->form_validation->run())
        {

            //	$subject = $this->input->post('subject');
            $subject = 'Обратная связь';
            $name = removeTags($this->input->post('name'));
            $message = removeTags($this->input->post('message'));
            $phone = removeTags($this->input->post('phone'));
            $lastname = $this->input->post('lastname');
            $subject1 = $this->input->post('subject');
            $email = removeTags($this->input->post('pochta'));

            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  	<html xmlns="http://www.w3.org/1999/xhtml">
  	<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) .
                '</title>
  	<style type="text/css">
  	body {
  	font-family: Arial, Verdana, Helvetica, sans-serif;
  	font-size: 16px;
  	}
  	</style>
  	</head>
  	<body>
    
    ФИО: ' . $name . '<br />  
    Телефон: ' . $phone . '<br />  
    Электронная почта: ' . $email . '<br />  
    Сообщение: ' . $message . '<br />
  	
  	</body>
  	</html>';
            // Тема: '.$subject1.'<br />
            //Телефон для контакта: '.$phone.'
            // Фамилия: '.$lastname.'<br />
           // $this->email->from('info@' . $_SERVER['HTTP_HOST'], 'Обратная связь');
          
           $this->email->from(CONTACT_EMAIL, 'Обратная связь');
            $this->email->to(trim(getSiteSettings(1, 'link')));
            $this->email->reply_to($email);
            $this->email->subject($subject);
            $this->email->message($body);

            $data = array();
            $data['name'] = $name;
            $data['email'] = $email;
            $data['message'] = $message;
            $data['phone'] = $phone;
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip'] = $this->input->ip_address();


            if ($this->email->send())
            {

                $this->session->set_flashdata('success', lang('success_send'));
                $this->contacts_model->save($data, '');
                redirect(site_url('contacts'));
                //echo "yes";
            }else{
                $this->session->set_flashdata('success', lang('success_send'));
                $this->contacts_model->save($data, '');
                redirect(site_url('contacts'));
            }
        } else
        {
            $this->session->set_flashdata('error_success', '<p>' . lang('success_email_error1') .
                '</p>' . validation_errors());
            redirect(site_url('contacts'));
            //echo "yes";
        }
    }

    public function appeal()
    {
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
        $this->form_validation->set_rules('subject', 'lang:subject', 'trim|required');
        $this->form_validation->set_rules('message', 'lang:message', 'trim|required');
        $this->form_validation->set_rules('captcha', 'lang:captcha_error',
            "callback__captcha_check", 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            $theme = 'Обращение';
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

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
    Телефон для контакта: '.$phone.'<br />
    Тема: '.$subject.'<br />
    Сообщение: '.$message.'<br />
    
  	
  	</body>
  	</html>';

            $this->email->from('', $theme);
            $this->email->to('');
            $this->email->subject($theme);
            $this->email->message($body);

            $data = array();
            $data['cid'] = $this->input->post('cid');
            $data['name']   = $this->input->post('name');
            $data['phone'] = $this->input->post('phone');
            $data['subject'] = $this->input->post('subject');
            $data['message'] = $this->input->post('message');
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip']     = $this->input->ip_address();

            $url = $this->input->post('url');

            if($this->email->send()){
                $this->session->set_flashdata('success', lang('success_send'));
                $id = $this->contacts_model->save_to_appeal($data,'');
                $appeal_id_session = array('appeal_id' => 'appeal_id');
                $this->session->unset_userdata($appeal_id_session);
                go_to(site_url("$url?id=" . $id . '&cid=' . $data['cid']));

            }
        }
        else
        {
            $this->session->set_flashdata('error_success', '<p>'.lang('success_email_error1').'</p>'.validation_errors());

            redirect(site_url($url));
        }
    }

    public function get_appeal_status() {
        $id = $this->input->get('id');
        $cid = $this->input->get('cid');
        $a = $this->contacts_model->check_cid_id($id, $cid);

        if($a) {
            $this->output->set_header("Content-Type: application/json; charset=utf-8");
            $this->output->set_output(
                json_encode(array('stat' => 'true', 'treatment' => $a))
            );
        } else {
            print 'false';
        }
    }

    
    public function review()
    {
        $this->form_validation->set_rules('pochta', 'lang:email','trim|required|valid_email');
        $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
        $this->form_validation->set_rules('address', 'lang:address', 'trim|required');
        $this->form_validation->set_rules('g-recaptcha-response', 'каптчу', 'required|callback_validate_captcha');
        $this->load->model('review_model', 'review');
        if ($this->form_validation->run())
        {
            $data = array();
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('pochta');
            $data['content'] = $this->input->post('content');
            $data['address'] = $this->input->post('address');
            $data['active'] = '0';
            $data['date'] = date('Y-m-d H:i:s');
            $this->session->set_flashdata('success', lang('success_send_question'));
            $this->review->add($data);
            redirect(site_url('reviews'));
        } else
        {
            $this->session->set_flashdata('error_success', '<p>' . lang('success_email_error1') .
                '</p>' . validation_errors());
            redirect(site_url('reviews'));
        }
    }
    
    function validate_captcha()
    {
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeHZTIUAAAAAI9-cLQzqmZ0wVavrS0qfAldDAo6&response=" .
            $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false)
        {
            return false;
        } else
        {
            return true;
        }
    }

    public function _name_check($value)
    {
        if (mb_strtolower(lang('name')) == mb_strtolower($value))
        {
            $this->form_validation->set_message('_name_check', lang('required'));
            return false;
        } else
            return true;
    }

    public function _message_check($value)
    {
        if (mb_strtolower(lang('message')) == mb_strtolower($value))
        {
            $this->form_validation->set_message('_message_check', lang('required'));
            return false;
        } else
            return true;
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

    public function generate_captcha()
    {
        $this->load->helper('captcha');
        /*$vals= array(
        'word'       => random_string('numeric', 5),
        'img_path'   => './uploads/captcha/',
        'img_url'    => base_url().'uploads/captcha/',
        'img_width'  => '210',
        'font_path'  => './system/fonts/arial.ttf',
        'font_size'  => '25px',
        'img_height' => '35',
        'expiration' => 7200
        );
        $this->data['cap'] = create_captcha($vals);*/

        $vals = array(
            'word' => random_string('numeric', 5),
            'img_path' => './uploads/captcha/',
            'img_url' => base_url() . 'uploads/captcha/',
            'img_width' => '120',
            'font_path' => './system/fonts/arial.ttf',
            'font_size' => '25px',
            'img_height' => '35',
            'expiration' => 7200);
        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']);
        $this->session->set_userdata($data);


        $this->session->set_userdata($data);
        $return['status'] = 'OK';
        $return['captcha1'] = $cap;
        $this->output->set_content_type('application/json')->set_output(json_encode($return));
    }


    public function generate_captcha1()
    {
        $this->load->helper('captcha');
        /*$vals= array(
        'word'       => random_string('numeric', 5),
        'img_path'   => './uploads/captcha/',
        'img_url'    => base_url().'uploads/captcha/',
        'img_width'  => '210',
        'font_path'  => './system/fonts/arial.ttf',
        'font_size'  => '25px',
        'img_height' => '35',
        'expiration' => 7200
        );
        $this->data['cap'] = create_captcha($vals);*/

        $vals = array(
            'word' => random_string('numeric', 5),
            'img_path' => './uploads/captcha/',
            'img_url' => base_url() . 'uploads/captcha/',
            'img_width' => '175',
            'font_path' => './system/fonts/arial.ttf',
            'font_size' => '25px',
            'img_height' => '35',
            'expiration' => 7200);
        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word_1' => $cap['word']);
        $this->session->set_userdata($data);


        $this->session->set_userdata($data);
        $return['status'] = 'OK';
        $return['captcha'] = $cap;

        $this->output->set_content_type('application/json')->set_output(json_encode($return));
    }

    public function likeFb($link)
    {

        /*$ch = curl_init("https://www.facebook.com/v2.5/plugins/like.php?locale=en_US&href=https://www.facebook.com/".$link);
        // $ch = curl_init("https://www.facebook.com/v2.10/878084525556619/likes");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Safari');
        $html = curl_exec($ch);

        //preg_match("/and ([0-9,.]+?) others/", $html, $match);
        //$likes = floatval(str_replace(array(',','.'), '', $match[0]));

        echo $html;*/


    }

    public function fb_count($value = '')
    {
        if ($value)
        {
            $url = 'http://api.facebook.com/method/fql.query?query=SELECT fan_count FROM page WHERE';
            if (is_numeric($value))
            {
                $qry = ' page_id="' . $value . '"';
            } //If value is a page ID
            else
            {
                $qry = ' username="' . $value . '"';
            } //If value is not a ID.
            $xml = @simplexml_load_file($url . $qry) or die("invalid operation");
            $fb_count = $xml->page->fan_count;
            echo $fb_count;
        } else
        {
            echo '0';
        }
    }
    public function adult(){
        if (@$_SERVER["HTTP_REFERER"])
        {
            $cookie = array(
    'name'   => 'agree',
    'value'  => 'agree',
    'expire' => '14400',

    'secure' => TRUE
);

$this->input->set_cookie($cookie); 

        }else{
            go_to(site_url());
        }
        
    }
}
?>
