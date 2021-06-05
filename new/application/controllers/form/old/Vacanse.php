<?php

Class Vacanse extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        $this->load->model('vacanse_model');
        $this->load->library('email','input');
        $this->data['sel'] = 'vacanse';

    }


    public function index()
    {
        if(@$_SERVER["HTTP_REFERER"]){
            $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
            $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
            $this->form_validation->set_rules('name', 'lang:first_name', 'trim|required');
            $this->form_validation->set_rules('work_name', 'lang:error', 'trim|required');
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required');
            $this->form_validation->set_rules('type', 'lang:type', 'trim|required');
            $this->form_validation->set_rules('additional', 'lang:error', 'trim');

            $data['name'] = $this->input->post('name');
            $data['work_name'] = $this->input->post('work_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['type'] = $this->input->post('type');
            $data['additional'] = $this->input->post('additional');
            $data['created_on'] = date('Y-m-d H:i:s');
            $data['resume_file'] = '';
            $data['additional_file'] = '';
            $data['more'] = '';
            if ($this->form_validation->run()) {
                $config['upload_path']          = './uploads/vacanse/';
                $config['encrypt_name']         = true;
                $config['allowed_types']        = 'jpg|doc|docx|pdf';
                $this->load->library('upload', $config);

                if ( $this->upload->do_upload('resume'))
                {
                    $up = $this->upload->data();
                    $data['resume_file'] = $up['file_name'];

                } else{
                    //$this->session->set_flashdata('error_success', lang('error_uploads_file'));
                }
                if ( $this->upload->do_upload('additional_file'))
                {
                    $up = $this->upload->data();
                    $data['additional_file'] = $up['file_name'];

                } else{
                    //$this->session->set_flashdata('error_success', lang('error_uploads_file'));
                }

                $this->vacanse_model->save($data);

                $subject = 'rwnadzor.uz Вакансия';
                $file_content = '';
                if($data['resume_file']!='')
                    $file_content .= 'Резюме: <br /><a href="'.base_url('uploads/vacanse/'.$data['resume_file']).'">'.$data['resume_file'].'</a><br/>';
                if($data['additional_file']!='')
                    $file_content .= 'Дополнительный файл: <br /><a href="'.base_url('uploads/vacanse/'.$data['additional_file']).'">'.$data['additional_file'].'</a><br/>';
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
                    Ф.И.О: '.$data['name'].'<br />
                    Желаемая должность: '.$data['work_name'].'<br />                    
                    Телефон для контакта: '.$data['phone'].'<br />
                    Э-почта: '.$data['email'].'<br />
                    '.$file_content.'
                    </body>
                    </html>';

                email_respondent('info@rwnadzor.uz', 'htk@etlgr.com', $subject, $body);
                email_respondent('info@rwnadzor.uz', '162576991@etlgr.com', $subject, $body);

                $this->session->set_flashdata('error_success', lang('success_send'));
                redirect(site_url('application'));
            } else {
                $this->session->set_flashdata('error_success', lang('validation_err'));
                redirect(site_url('application'));
            }

        } else {
            redirect(site_url());
        }
    }

    public function summary()
    {
        if(@$_SERVER["HTTP_REFERER"]){
            $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
            $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
            $this->form_validation->set_rules('name', 'lang:first_name', 'trim|required');
            $this->form_validation->set_rules('work_name', 'lang:error', 'trim|required');
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required');
            $this->form_validation->set_rules('type', 'lang:type', 'trim|required');
            $this->form_validation->set_rules('additional', 'lang:error', 'trim');

            $data['name'] = $this->input->post('name');
            $data['work_name'] = $this->input->post('work_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['type'] = $this->input->post('type');
            $data['additional'] = $this->input->post('additional');
            $data['created_on'] = date('Y-m-d H:i:s');
            $data['resume_file'] = '';
            $data['additional_file'] = '';
            $data['more'] = '';
            if ($this->form_validation->run()) {
                $config['upload_path']          = './uploads/vacanse/';
                $config['encrypt_name']         = true;
                $config['allowed_types']        = 'jpg|doc|docx|pdf';
                $this->load->library('upload', $config);

                if ( $this->upload->do_upload('resume'))
                {
                    $up = $this->upload->data();
                    $data['resume_file'] = $up['file_name'];

                } else{
                    //$this->session->set_flashdata('error_success', lang('error_uploads_file'));
                }
                if ( $this->upload->do_upload('additional_file'))
                {
                    $up = $this->upload->data();
                    $data['additional_file'] = $up['file_name'];

                } else{
                    //$this->session->set_flashdata('error_success', lang('error_uploads_file'));
                }

                $this->vacanse_model->save($data);

                $subject = 'rwnadzor.uz Вакансия';
                $file_content = '';
                if($data['resume_file']!='')
                    $file_content .= 'Резюме: <br /><a href="'.base_url('uploads/vacanse/'.$data['resume_file']).'">'.$data['resume_file'].'</a><br/>';
                if($data['additional_file']!='')
                    $file_content .= 'Дополнительный файл: <br /><a href="'.base_url('uploads/vacanse/'.$data['additional_file']).'">'.$data['additional_file'].'</a><br/>';
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
                    Ф.И.О: '.$data['name'].'<br />
                    Желаемая должность: '.$data['work_name'].'<br />                    
                    Телефон для контакта: '.$data['phone'].'<br />
                    Э-почта: '.$data['email'].'<br />
                    '.$file_content.'
                    </body>
                    </html>';

                email_respondent('info@rwnadzor.uz', 'htk@etlgr.com', $subject, $body);
                email_respondent('info@rwnadzor.uz', '162576991@etlgr.com', $subject, $body);

                $this->session->set_flashdata('error_success', lang('success_send'));
                redirect(site_url('summary'));
            } else {
                $this->session->set_flashdata('error_success', lang('validation_err'));
                redirect(site_url('summary'));
            }

        } else {
            redirect(site_url());
        }
    }

    public function certificate()
    {
        if(@$_SERVER["HTTP_REFERER"]){
            $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
            $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
            $this->form_validation->set_rules('name', 'lang:first_name', 'trim|required');
            $this->form_validation->set_rules('work_name', 'lang:error', 'trim|required');
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required');
            $this->form_validation->set_rules('type', 'lang:type', 'trim|required');
            $this->form_validation->set_rules('additional', 'lang:error', 'trim');

            $data['name'] = $this->input->post('name');
            $data['work_name'] = $this->input->post('work_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['type'] = $this->input->post('type');
            $data['additional'] = $this->input->post('additional');
            $data['created_on'] = date('Y-m-d H:i:s');
            $data['resume_file'] = '';
            $data['additional_file'] = '';
            $data['more'] = '';
            if ($this->form_validation->run()) {
                $config['upload_path']          = './uploads/vacanse/';
                $config['encrypt_name']         = true;
                $config['allowed_types']        = 'jpg|doc|docx|pdf';
                $this->load->library('upload', $config);

                if ( $this->upload->do_upload('resume'))
                {
                    $up = $this->upload->data();
                    $data['resume_file'] = $up['file_name'];

                } else{
                    //$this->session->set_flashdata('error_success', lang('error_uploads_file'));
                }
                if ( $this->upload->do_upload('additional_file'))
                {
                    $up = $this->upload->data();
                    $data['additional_file'] = $up['file_name'];

                } else{
                    //$this->session->set_flashdata('error_success', lang('error_uploads_file'));
                }

                $this->vacanse_model->save($data);

                $subject = 'rwnadzor.uz Вакансия';
                $file_content = '';
                if($data['resume_file']!='')
                    $file_content .= 'Резюме: <br /><a href="'.base_url('uploads/vacanse/'.$data['resume_file']).'">'.$data['resume_file'].'</a><br/>';
                if($data['additional_file']!='')
                    $file_content .= 'Дополнительный файл: <br /><a href="'.base_url('uploads/vacanse/'.$data['additional_file']).'">'.$data['additional_file'].'</a><br/>';
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
                    Ф.И.О: '.$data['name'].'<br />
                    Желаемая должность: '.$data['work_name'].'<br />                    
                    Телефон для контакта: '.$data['phone'].'<br />
                    Э-почта: '.$data['email'].'<br />
                    '.$file_content.'
                    </body>
                    </html>';

                email_respondent('info@rwnadzor.uz', 'htk@etlgr.com', $subject, $body);
                email_respondent('info@rwnadzor.uz', '162576991@etlgr.com', $subject, $body);

                $this->session->set_flashdata('error_success', lang('success_send'));
                redirect(site_url('certificate'));
            } else {
                $this->session->set_flashdata('error_success', lang('validation_err'));
                redirect(site_url('certificate'));
            }

        } else {
            redirect(site_url());
        }
    }


    function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LepsjsUAAAAAFMBPobInR0APtM6CxfT8mZYHr9x&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function _captcha_check()
    {
        $expiration = time()-7200;
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

    public function upload(){
        $group = 'requests';
        $id = $this->session->userdata('requests_id');
        if(isset($_FILES['userfile']))
            if($_FILES['userfile']['size'] > 0 and $_FILES['userfile']['size'] < 50*1024*1024 ) {
                $result = getRequests_uploads($group);
                if(!empty($result['error'])) {
                    $error = true;
                    $this->data['error'] = $result['error'];
                    //$this->session->set_flashdata('message_error_wish', $this->data['error']);
                    $return['image_uploads_error'] = $result['error'];
                    $return['success'] = false;
                    $this->output->set_content_type('application/json')->set_output(json_encode($return));
                    //go_to();
                } else {
                    $error = false;
                    $upload_data = $this->upload->data();


                    $data1 = array(
                        'title' => '',
                        'description' => '',
                        'category' => $group,
                        'post_id' => $id,
                        'url' => $upload_data['file_name'],
                        // 'user_id'  	  => $this->session->userdata('user_id'),
                        'media_type' => $upload_data['file_type'],
                        'file_name'   => $upload_data['file_name'],
                        'file_type'   => $upload_data['file_type'],
                        'file_path'   => $upload_data['file_path'],
                        'full_path'   => $upload_data['full_path'],
                        'raw_name'    => $upload_data['raw_name'],
                        'orig_name'   => $_FILES['userfile']['name'],
                        'client_name' => $upload_data['client_name'],
                        'file_ext'    => $upload_data['file_ext'],
                        'file_size'   => round($upload_data['file_size']),
                        'is_image'    => $upload_data['is_image'],
                        'image_width' => $upload_data['image_width'],
                        'image_height' => $upload_data['image_height'],
                        'image_type'  => $upload_data['image_type'],
                        'image_size_str' => $upload_data['image_size_str'],
                        'is_main' => '1',
                        'created_on'  => date('Y-m-d'),
                    );


                    $reqid = $this->vacanse_model->save_media($data1);
                    $return['success'] = true;
                    $this->output->set_content_type('application/json')->set_output(json_encode($return));
                    // $return['reqid'] = $reqid;
                    // $this->output->set_content_type('application/json')->set_output(json_encode($return));
                    //echo "Загружено";
                }
                // go_to();
            } else {
                $return['error'] = false;
                $return['image_uploads_error'] = lang('upload_error');
                $this->output->set_content_type('application/json')->set_output(json_encode($return));
            }
        else {
            $return['error'] = false;
            $return['image_uploads_error'] = lang('upload_error');
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }



    }

    public function delete_document(){
        $data['orig_name'] = $this->input->post('name');
        $data['file_size'] = $this->input->post('size');
        $result = $this->request_model->remove_doc($data);
        if($result)
            $this->output->set_content_type('application/json')->set_output(json_encode(Array('success' => true)));
        else
            $this->output->set_content_type('application/json')->set_output(json_encode(Array('success' => false)));

    }

}