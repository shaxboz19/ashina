<?php

Class Requestaction extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        $this->load->model('request_model');
        $this->load->library('email', 'input');
        $this->data['sel'] = 'request';

    }


    public function index()
    {
        $type = $this->input->post('type');
        if (@$_SERVER["HTTP_REFERER"]) {
            $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
            $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
            $this->form_validation->set_rules('full_name', 'lang:full_name', 'trim|required');
//            $this->form_validation->set_rules('last_name', 'lang:last_name', 'trim|required');
            $this->form_validation->set_rules('position_title', 'lang:position_title', 'trim|required');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required');
            $this->form_validation->set_rules('phone', 'lang:phone', 'trim|required');
//            $this->form_validation->set_rules('region', 'lang:region', 'trim|required');
            $this->form_validation->set_rules('organization', 'lang:organization', 'trim|required');

            $data['cid'] = $this->input->post('cid');
            $data['type'] = $this->input->post('type');
            $data['full_name'] = $this->input->post('full_name');
//            $data['last_name'] = $this->input->post('last_name');
            $data['position_title'] = $this->input->post('position_title');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
//            $data['region'] = $this->input->post('region');
            $data['organization'] = $this->input->post('organization');
            $data['created_on'] = date('Y-m-d H:i:s');
            $data['file_status'] = 'active';

            $email = trim(getSiteSettings(1, 'link'));

            $id = $this->session->userdata('requests_id');


            if ($this->form_validation->run()) {
                $media_req_file = $this->request_model->get_media_files($id);
                // Validation file upload
                if ($media_req_file) {
                    $post_data = $data;

                    if ((strlen($post_data['full_name']) > 1)) {


                        $upl_file = '';
                        if ($media_req_file) {
                            foreach ($media_req_file as $item) {
                                $upl_file .= '<a href="' . base_url('uploads/requests/' . $item->url) . '">' . $item->url . '</a><br />';
                                $data_img = array(
                                    'status_m' => 'active',
                                );
                                $this->request_model->save_media($data_img, $item->id_image);
                            }
                        }

                        $subject = 'Государственная инспекция Узгосжелдорнадзор';

                        $body =
                            '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                            <html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>
                            <style type="text/css">
                            body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
                            font-size: 16px;
                            }
                            </style>
                            </head>
                            <body>
                            Имя: ' . $data['full_name'] . '<br />
                            E-mail: ' . $data['email'] . '<br />                    
                            Телефон для контакта: ' . $data['phone'] . '<br />
                            Организация: ' . $data['organization'] . '<br />
                            Характеристика: ' . $data['position_title'] . '<br />
                            Файлы: <br />' . $upl_file . '
                            </body>
                            </html>';

                        $body2 =
                            '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                            <html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>
                            <style type="text/css">
                            body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
                            font-size: 16px;
                            }
                            </style>
                            </head>
                            <body>
                            Номер обращения: <br />' . $id . '<br />
                            Код доступа: <br />' . $data['cid']. '
                            </body>
                            </html>';

                        // Фамилия: '.$data['last_name'].'<br />
                        //  Регион: '.getRegions($data['region'], 'r_name').'<br />
                        // email_respondent('no-reply@muic.uz', 'uzmuic@gmail.com', $subject, $body);
                        email_respondent('info@rwnadzor.uz', $email, $subject, $body);

                        $this->session->set_flashdata('success', lang('succes_request'));
                        $this->request_model->save($data, $id);

                        email_respondent('info@rwnadzor.uz', $data['email'], $subject, $body2, lang('email_send_text'));


                        $requests_id_session = array('requests_id' => 'requests_id');
                        $this->session->unset_userdata($requests_id_session);
                        go_to(site_url("$type?id=" . $id . '&cid=' . $data['cid']));
//                        redirect(site_url($type));

                    }
                } else {
                    $this->session->set_flashdata('full_name', $this->input->post('full_name'));
//                $this->session->set_flashdata('last_name', $this->input->post('last_name'));
                    $this->session->set_flashdata('position_title', $this->input->post('position_title'));
                    $this->session->set_flashdata('email', $this->input->post('email'));
                    $this->session->set_flashdata('phone', $this->input->post('phone'));
//                $this->session->set_flashdata('region',$this->input->post('region'));
                    $this->session->set_flashdata('organization', $this->input->post('organization'));
                    $this->session->set_flashdata('error_success', lang('error_uploads_file'));
                    redirect(site_url($type));
                }
            } else {

                $this->session->set_flashdata('full_name', $this->input->post('full_name'));
//            $this->session->set_flashdata('last_name', $this->input->post('last_name'));
                $this->session->set_flashdata('position_title', $this->input->post('position_title'));
                $this->session->set_flashdata('email', $this->input->post('email'));
                $this->session->set_flashdata('phone', $this->input->post('phone'));
//            $this->session->set_flashdata('region',$this->input->post('region'));
                $this->session->set_flashdata('organization', $this->input->post('organization'));


                $media_file = $this->request_model->get_media_files($id);
                if ($media_file) {
                    foreach ($media_file as $item) {
                        @unlink("./uploads/requests/" . $item->url);
                        $this->db->delete('media_request', array('id_image' => $item->id_image));
                    }
                }

                $this->session->set_flashdata('error_success', "<p>" . lang('success_email_error') . "</p>" . validation_errors());
                redirect(site_url($type));
            }

        } else {
            redirect(site_url($type));
        }
    }

    public function get_appeal_status() {
        $id = $this->input->get('id');
        $cid = $this->input->get('cid');
        $a = $this->request_model->check_cid_id($id, $cid);

        if($a) {
            $this->output->set_header("Content-Type: application/json; charset=utf-8");
            $this->output->set_output(
                json_encode(array('stat' => 'true', 'treatment' => $a))
            );
        } else {
            print 'false';
        }
    }

    function validate_captcha()
    {
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfsW2YUAAAAAN3MyPVrzU_0Uqft84ScLwieciB-&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function _captcha_check()
    {
        $expiration = time() - 7200; // Two hour limit
        $cap = $this->input->post('captcha');
        if ($this->session->userdata('word') == $cap
            AND $this->session->userdata('ip_address') == $this->input->ip_address()
            AND $this->session->userdata('captcha_time') > $expiration
        ) {
            return true;
        } else {
            $this->form_validation->set_message('_captcha_check', '%s');
            return false;
        }
    }

    public function delete_upload($id)
    {
        $this->db->delete('media_request', array('id' => $id));
    }

    public function upload()
    {
        $group = 'requests';
        $id = $this->session->userdata('requests_id');
        if (isset($_FILES['userfile']))
            if ($_FILES['userfile']['size'] > 0 and $_FILES['userfile']['size'] < 50 * 1024 * 1024) {
                $result = getRequests_uploads($group);
                if (!empty($result['error'])) {
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
                        'file_name' => $upload_data['file_name'],
                        'file_type' => $upload_data['file_type'],
                        'file_path' => $upload_data['file_path'],
                        'full_path' => $upload_data['full_path'],
                        'raw_name' => $upload_data['raw_name'],
                        'orig_name' => $_FILES['userfile']['name'],
                        'client_name' => $upload_data['client_name'],
                        'file_ext' => $upload_data['file_ext'],
                        'file_size' => round($upload_data['file_size']),
                        'is_image' => $upload_data['is_image'],
                        'image_width' => $upload_data['image_width'],
                        'image_height' => $upload_data['image_height'],
                        'image_type' => $upload_data['image_type'],
                        'image_size_str' => $upload_data['image_size_str'],
                        'is_main' => '1',
                        'created_on' => date('Y-m-d'),
                    );


                    $reqid = $this->request_model->save_media($data1);
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

    public function delete_document()
    {
        $data['orig_name'] = $this->input->post('name');
        $data['file_size'] = $this->input->post('size');
        $result = $this->request_model->remove_doc($data);
        if ($result)
            $this->output->set_content_type('application/json')->set_output(json_encode(Array('success' => true)));
        else
            $this->output->set_content_type('application/json')->set_output(json_encode(Array('success' => false)));

    }

    public function clear_inactive_requests()
    {
        $this->request_model->clear_inactive_requests();
        //go_to(site_url());
    }

}
