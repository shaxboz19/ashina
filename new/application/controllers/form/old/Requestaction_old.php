<?php

Class Requestaction extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        $this->load->model('request_model');
        $this->load->library('email');
        $this->data['sel'] = 'request';

    }


    public function index()
    {
        if(@$_SERVER["HTTP_REFERER"]){
            $this->form_validation->set_rules('captcha', 'код', "callback__captcha_check",'trim|required|xss_clean');
            $this->form_validation->set_rules('first_name', 'lang:first_name', 'required');
            $this->form_validation->set_rules('last_name', 'lang:last_name', 'required');
            $this->form_validation->set_rules('position_title', 'lang:position_title', 'required');
            $this->form_validation->set_rules('email', 'lang:email', 'required');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required');
            $this->form_validation->set_rules('region', 'lang:region', 'required');
            $this->form_validation->set_rules('organization', 'lang:organization', 'required');


            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['position_title'] = $this->input->post('position_title');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['region'] = $this->input->post('region');
            $data['organization'] = $this->input->post('organization');
            $data['created_on'] = date('Y-m-d H:i:s');

            $data['attach_1'] ='';
            $data['attach_2'] ='';
            $data['attach_3'] ='';
            $data['attach_4'] ='';
            $data['attach_5'] ='';
            $email = trim(getSiteSettings(1, 'link'));
            if ($this->form_validation->run()) {
                $post_data = $data;

                if ((strlen($post_data['first_name']) > 1)) {
            	    
                    if(isset($_FILES['myfile1']['name']) && !empty($_FILES['myfile1']['name']) && $_FILES['myfile1']['size'] > 0) {
                        $file = $_FILES['myfile1'];
                        $this->load->library('upload');
                        $config['upload_path'] = FCPATH . 'uploads/requests/';
                        $config['allowed_types'] = 'pdf';
                        $config['max_size'] = 60000;
                        $config['encrypt_name']  = TRUE;
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('myfile1')) {
                            $file1 = $this->upload->data();
                            $data['attach_1'] = $file1['file_name'];
                        } else {
                            $this->session->set_flashdata('error_success', lang('upload_error'));
                            go_to(site_url());
                        }
                    }
                    if(isset($_FILES['myfile2']['name']) && !empty($_FILES['myfile2']['name']) && $_FILES['myfile2']['size'] > 0) {
                        $file = $_FILES['myfile2'];
                        $this->load->library('upload');
                        $config['upload_path'] = FCPATH . 'uploads/requests/';
                        $config['allowed_types'] = 'pdf';
                        $config['encrypt_name']  = TRUE;
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('myfile2')) {
                            $file2 = $this->upload->data();
                            $data['attach_2'] = $file2['file_name'];
                        } else {
                            $this->session->set_flashdata('error_success', lang('upload_error'));
                            go_to(site_url());
                        }
                    }
                    if(isset($_FILES['myfile3']['name']) && !empty($_FILES['myfile3']['name']) && $_FILES['myfile3']['size'] > 0) {
                        $file = $_FILES['myfile3'];
                        $this->load->library('upload');
                        $config['upload_path'] = FCPATH . 'uploads/requests/';
                        $config['allowed_types'] = 'pdf';
                        $config['encrypt_name']  = TRUE;
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('myfile3')) {
                            $file3 = $this->upload->data();
                            $data['attach_3'] = $file3['file_name'];
                        } else {
                            $this->session->set_flashdata('error_success', lang('upload_error'));
                            go_to(site_url());
                        }
                    }
                    if(isset($_FILES['myfile4']['name']) && !empty($_FILES['myfile4']['name']) && $_FILES['myfile4']['size'] > 0) {
                        $file = $_FILES['myfile4'];
                        $this->load->library('upload');
                        $config['upload_path'] = FCPATH . 'uploads/requests/';
                        $config['allowed_types'] = 'pdf';
                        $config['encrypt_name']  = TRUE;
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('myfile4')) {
                            $file4 = $this->upload->data();
                            $data['attach_4'] = $file4['file_name'];
                        } else {
                            //return FALSE;
                            $this->session->set_flashdata('error_success', lang('upload_error'));
                            go_to(site_url());
                        }
                    }
                    if(isset($_FILES['myfile5']['name']) && !empty($_FILES['myfile5']['name']) && $_FILES['myfile5']['size'] > 0) {
                        $file = $_FILES['myfile5'];
                        $this->load->library('upload');
                        $config['upload_path'] = FCPATH . 'uploads/requests/';
                        $config['allowed_types'] = 'pdf';
                        $config['encrypt_name']  = TRUE;
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('myfile5')) {
                            $file5 = $this->upload->data();
                            $data['attach_5'] = $file5['file_name'];
                        } else {
                            //    return FALSE;
                            $this->session->set_flashdata('error_success', lang('upload_error'));
                            go_to(site_url());
                        }
                    }

                    /*$subject = 'Mirzo Ulugbek Inovation Center';

                    $message = 'Имя: '.$data['first_name'];
                    $message = 'Фамилия: '.$data['last_name'];
                    $message = 'Название должности: '.$data['position_title'];
                    $message = 'Э-почта: '.$data['email'];
                    $message = 'Организация: '.$data['organization'];
                    $message = 'Регион: '.$data['region'];

                    $headers = "From: no-reply@mchs.uz \r\n";
                    $headers .= "Reply-To: no-reply@mchs.uz \r\n";
                    $headers .= "CC: no-reply@mchs.uz\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    mail($email, $subject, $message, $headers);
                    */
                    $subject = 'Mirzo Ulugbek Inovation Center';
                    $upl_file ='';
                    if($data['attach_1']!='')
                        $upl_file .= '<a href="'.base_url('uploads/requests/'.$data['attach_1']).'>'. $file1['file_name'].'</a><br />';
                    if($data['attach_2']!='')
                        $upl_file .= '<a href="'.base_url('uploads/requests/'.$data['attach_2']).'>'. $file2['file_name'].'</a><br />';
                    if($data['attach_3']!='')
                        $upl_file .= '<a href="'.base_url('uploads/requests/'.$data['attach_3']).'>'. $file3['file_name'].'</a><br />';
                    if($data['attach_4']!='')
                        $upl_file .= '<a href="'.base_url('uploads/requests/'.$data['attach_4']).'>'. $file4['file_name'].'</a><br />';
                    if($data['attach_5']!='')
                        $upl_file .= '<a href="'.base_url('uploads/requests/'.$data['attach_5']).'>'. $file5['file_name'].'</a><br />';
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
                    Имя: '.$data['first_name'].'<br />
                    Фамилия: '.$data['last_name'].'<br />
                    E-mail: '.$data['email'].'<br />                    
                        Телефон для контакта: '.$data['phone'].'<br />
                        Файлы: <br />'.$upl_file.'
                        </body>
                        </html>';



                    //$this->email->from('info@'.$_SERVER['HTTP_HOST'], $subject);
                    //$this->email->from('no-reply@muic.uz', $subject);
                    //$this->email->to('resident@muic.uz');
                    //$this->email->reply_to($this->input->post('email'));
                    //$this->email->subject($subject);
                    //$this->email->message($body);
                    //if($data['attach_1']!='')
                    //   $this->email->attach('uploads/requests/'.$data['attach_1']);
                    //if($data['attach_2']!='')
                    //    $this->email->attach('uploads/requests/'.$data['attach_2']);
                    //if($data['attach_3']!='')
                    //    $this->email->attach('uploads/requests/'.$data['attach_3']);
                    //if($data['attach_4']!='')
                    //    $this->email->attach('uploads/requests/'.$data['attach_4']);
                    //if($data['attach_5']!='')
                    //    $this->email->attach('uploads/requests/'.$data['attach_5']);*/
                    email_respondent('no-reply@muic.uz', 'uzmuic@gmail.com', $subject, $body);
                    //    if($this->email->send()){
                    $this->session->set_flashdata('success', lang('succes_request'));
                    $id = $this->request_model->save($data);
                    email_respondent('no-reply@muic.uz', $data['email'], $subject, lang('email_send_text'));
                    go_to(site_url());
                    //    }
                    //    else{
                    //        $this->session->set_flashdata('error_success', lang('success_email_error'));
                    //    }
                }
            }else{
                $this->session->set_flashdata('error_success', "<p>".lang('success_email_error')."</p>".validation_errors());
                go_to(site_url());
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
            $this->form_validation->set_message('_captcha_check', 'Неправильный %s');
            return false;
        }
    }




}
