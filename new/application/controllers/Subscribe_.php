<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('subscribe_model', 'users');
        $this->load->model('posts_model', 'posts');
        $this->data['sel'] = 'subscribe';
        $this->load->library('session');
    }

// Подписаться на рассылку
   

    public function sub()  {
         if(@$_SERVER["HTTP_REFERER"]){
            $this->form_validation->set_rules('subscribe', 'lang:email', 'trim|required');
        if($this->form_validation->run())
        {

            $email = $this->input->post('subscribe');
            if($this->session->userdata('time')){
                if((600-(time()-$this->session->userdata('time')))>0){
                    //$return['result'] = '<span style="color: #ff0000">Пожалуйста, попробуйте еще раз через несколько минут!</span>';
                    $this->session->set_flashdata('erro_subtime', ' '.lang('sub_title_1').' '.(600-(time()-$this->session->userdata('time'))).' '.lang('sub_title_2').'');
                    go_to(site_url());

                } else {
                    $this->session->unset_userdata('time');
                    $this->session->set_userdata('time',time());
                    if(getUserEmail($email, 'email')){
                        $this->session->set_flashdata('error_success', ''.lang('sub_title_3').'');
                        $this->session->set_userdata('time',time());
                        go_to(site_url());
                    }
                    $data = array(
                        'user_sub' => 'insubscriber',
                        'user_type' => 'insubscriber',
                        'first_name' => 'Подписчик',
                        'active' => '0',
                        'email' => $this->input->post('subscribe'),
                    );
                    $data['activation_code']= $code = md5($this->input->post('subscribe').time());

                    $user = $this->users->save($data);

                    $data['activation_link'] = site_url('subscribe/activate/'.$user->user_id.'/'.$code);
                    $data['inactivation_link'] = site_url('subscribe/inactivate/'.$user->user_id.'/'.$code);

                    $ci =& get_instance();

                    $link1= site_url('subscribe/activate/'.$user->user_id.'/'.$code);
                    $link2 = site_url('subscribe/inactivate/'.$user->user_id.'/'.$code);
                    $subject = "Подписка на рассылку";
                    $message = "Для активации нажмите эту ссылку:<br><a href={$link1}>".$data['activation_link'].'<a/><br>
                    <br>  Для деактивации нажмите эту ссылку:<br><a href="'.$link2.'">'.$data['inactivation_link'].'</a>';

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
                    '.$message.'
                    </body>
                    </html>';

                    email_respondent('info', $data['email'], 'Подписка на рассылку', $body);

                    $this->session->set_flashdata('success', lang('success_email'));

                    go_to(site_url());

                }
            }
            else {

                if(getUserEmail($email, 'email')){
                    $this->session->set_flashdata('error_success', ''.lang('sub_title_3').'');
                    $this->session->set_userdata('time',time());
                    go_to(site_url());
                }
                $data = array(
                    'user_sub' => 'insubscriber',
                    'user_type' => 'insubscriber',
                    'first_name' => 'Подписчик',
                    'active' => '0',
                    'email' => $this->input->post('subscribe'),
                );
                $data['activation_code']= $code = md5($this->input->post('subscribe').time());

                $user = $this->users->save($data);

                $data['activation_link'] = site_url('subscribe/activate/'.$user->user_id.'/'.$code);
                $data['inactivation_link'] = site_url('subscribe/inactivate/'.$user->user_id.'/'.$code);

                $ci =& get_instance();

                $link1= site_url('subscribe/activate/'.$user->user_id.'/'.$code);
                $link2 = site_url('subscribe/inactivate/'.$user->user_id.'/'.$code);
                $subject = "Подписка на рассылку";
                $message = "Для активации нажмите эту ссылку:<br><a href={$link1}>".$data['activation_link'].'<a/><br>
                <br>  Для деактивации нажмите эту ссылку:<br><a href="'.$link2.'">'.$data['inactivation_link'].'</a>';

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
                '.$message.'
                </body>
                </html>';

                email_respondent('info', $data['email'], 'Подписка на рассылку', $body);

                $this->session->set_flashdata('success', lang('success_email'));

                go_to(site_url());
            }





        }
        else
        {

            $this->session->set_flashdata('error_success', lang('success_email_error1'). validation_errors() );
            go_to(site_url());
        }
        }else{
             go_to(site_url());
        }
    }


    public function activate($id = '', $code = '')
    {
        if(!empty($id) && !empty($code))
        {

            $user = $this->users->get($id, $code);
            if($user){
                $data = array('active' => '1', 'user_sub' => 'subscriber',  'user_type' => 'subscriber', 'first_name' => 'Подписчик',);
                $this->users->save($data, $id);
                $this->session->set_flashdata('success', lang('newsletter_sub_active'));
                go_to(site_url());
            }
            else{
                $this->session->set_flashdata('error_success', lang('success_email_error1'));
                go_to(site_url());
            }
        }
        else{
            go_to(site_url());
        }
    }

    public function inactivate($id = '', $code = '')
    {
        if(!empty($id) && !empty($code))
        {

            $user = $this->users->get($id, $code);
            if($user){
                $data = array('active' => '0', 'user_sub' => 'insubscriber',  'user_type' => 'insubscriber', 'first_name' => 'Не подписчик',);
                $this->users->save($data, $id);
                $this->users->delete($id);
                $this->session->set_flashdata('error_success', lang('newsletter_sub_inactive'));
                go_to(site_url());
            }
            else{
                $this->session->set_flashdata('error_success', lang('success_email_error1'));
                go_to(site_url());
            }
        }else{
            go_to(site_url());
        }
    }
}