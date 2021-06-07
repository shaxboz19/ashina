<?php

Class Virtual extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
       $this->load->model('fuqaro_murojaat_model');
        $this->load->library('email');
        $this->data['sel'] = 'feedback';

	}  
    
    
    public function index()
    {  
     if(@$_SERVER["HTTP_REFERER"]){
        $this->form_validation->set_rules('captcha', 'lang:captcha', "callback__captcha_check",'trim|required|xss_clean');
        if ($this->form_validation->run()) {
                $post_data = $this->_getPostData('cfuqaro_murojaat');

         
                    if(isset($_FILES['myfile']['name']) && !empty($_FILES['myfile']['name']) && $_FILES['myfile']['size'] > 0) {
                        $file = $_FILES['myfile'];
                        $this->load->library('upload');
                        $config['upload_path'] = FCPATH . 'appeal_files/';
                        $config['allowed_types'] = 'jpg|png|jpeg|gif|pdf|txt|doc|docx|ppt|pptx|xls|xlsx';
                         $config['encrypt_name']  = TRUE;
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('myfile')) {
                            $picture = $this->upload->data();
                        } else {
                            return FALSE;
                        }
                    }
                    $f_name = 'no_file';
                    if(isset($file['name']) && !empty($file['name'])) {
                        $f_name = $picture['file_name'];
                    }

                    $rand_dec = md5($post_data['code']);

                    $id = $this->fuqaro_murojaat_model->fuqaro_murojaat_save(//
                            $post_data['ism'], $post_data['fam'], $post_data['email'], //
                            $post_data['telefon'], $post_data['mtext'], //
                            $post_data['kimga_id'], $post_data['murojaat_status'], //
                            $post_data['natija_text'], $post_data['zapas'], //
                            $post_data['adres'], $post_data['regions'],
                            $post_data['city'], $post_data['pol'],
                            $post_data['ustatus'], $post_data['byear'],
                            $post_data['aptype'], $post_data['allow'], $f_name, $rand_dec, $post_data['psharifi'],  $post_data['post_id'], $post_data['ptype'], $post_data['ptypes']);
                            
                    if($this->input->post('post_id')){
                        $post_id = getPostsAll($this->input->post('post_id'));
                        go_to(site_url('virtual/'.$post_id->alias.'?id=' . $id . '&cid=' . $post_data['code']));
                    }else{        
                    go_to(site_url('virtual?id=' . $id . '&cid=' . $post_data['code']));
                    }
                   // go_to(base_url(uri_string()).'?id='.$id.'&cid='.$post_data['code']);
                   
                    
                    
                   /* $to = $post_data['email'];
                    $subject = 'Обращение';
            $fio = $post_data['ism'].' '.$post_data['fam'].' '.$post_data['psharifi'];
            $phone = '+998 ' . $post_data['telefon'];
            $type = ($post_data['ptype'] == '1') ? 'Физическое лицо' : 'Юридическое лицо';
            $region = ($post_data['regions']) ? _t(getRegionInfo($post_data['regions'],'title'),'ru') : '-';
            $city = ($post_data['city']) ? _t(getCityInfo($post_data['city'],'title'),'ru') : '-';
            $address = $post_data['adres'];
            $pol = ($post_data['pol'] == '1') ? 'Мужской' : 'Женский';
            if($post_data['ptypes'] == '1'){
                $ptypes = 'Трудоустроен(а)';
            }
            if($post_data['ptypes'] == '2'){
                $ptypes = 'Не трудоустроен(а)';
            }
            if($post_data['ptypes'] == '3'){
                $ptypes = 'Пенсионер';
            }
            if($post_data['ptypes'] == '4'){
                $ptypes = 'Студент';
            }
            $message = $post_data['mtext'];*/
            
          /*  $email_senator = getPosts($post_data['post_id'], 'option_2');
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
    
    Ф.И.О: ' . $fio . '<br />   
    Пол: '.$pol.' <br/>
    Электронная почта: ' . $to . ' <br />  
    Телефон для контакта: ' . $phone . '<br /> 
    Тип: ' . $type . '<br /> 
    Занятость: '.$ptypes.' <br/>
    Регион: '.$region.' <br/>
    Район (город): '.$city.' <br/>
    Адрес: '.$address.' <br/>
    Обращение: ' . $message . '<br />
   
  	
  	</body>
  	</html>';
           
           if($email_senator){
                $this->email->from(CONTACT_EMAIL, $subject);
                $this->email->to($email_senator);
                $this->email->reply_to($to);
                $this->email->subject($fio);
                $this->email->message($body);
                if ($this->email->send())
                {
                    $this->session->set_flashdata('success', lang('success_send'));
                }else{
                     $this->session->set_flashdata('error_success', "<p>".lang('success_email_error')."</p>");
                }
           }else{
                $this->session->set_flashdata('success', lang('success_send'));
           }*/
          
               
                    //mail($to, $subject, $message, $headers);
                //go_to();
           
                
        }else{
            $this->session->set_flashdata('error_success', "<p>".lang('success_email_error')."</p>".validation_errors());
            go_to();
        }    
    }else{
        go_to(site_url());
    }
  }
  
   public function get_appeal_status() {
        $id = $this->input->get('id');
        $cid = $this->input->get('cid');
        $a = $this->fuqaro_murojaat_model->check_cid_id($id, $cid);

        if($a == 1) {
            $this->data['fuqaro_murojaat'] = $this->fuqaro_murojaat_model->fuqaro_murojaat_get($id);
            $this->output->set_header("Content-Type: application/json; charset=utf-8");
            $this->output->set_output(
                json_encode(array('stat' => 'true', 'treatment' => $this->data['fuqaro_murojaat']))
            );
        } else {
            print 'false';
//            json_encode(array('stat' => false));
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
  
   function _getPostData($type) {
        $result = array();
        switch ($type) {


            case 'cfuqaro_murojaat' :

                $result['ism'] = $this->input->post('pism');
                $result['fam'] = $this->input->post('pfam');
                $result['email'] = $this->input->post('pemail');
                $result['telefon'] = $this->input->post('ptelefon');
                $result['adres'] = $this->input->post('padres');
                $result['mtext'] = $this->input->post('pmtext');
                $result['kimga_id'] = $this->input->post('pkimga_id');
                $result['regions'] = $this->input->post('papregion');
                $result['city'] = $this->input->post('papcity');
                $result['pol'] = $this->input->post('pol');
                $result['psharifi'] = $this->input->post('psharifi');
                $result['post_id'] = $this->input->post('post_id');
                
                $result['ustatus'] = $this->input->post('pustatus');
                $result['allow'] = $this->input->post('ap_allow');
                $result['file'] = $this->input->post('ap_file');
                $result['murojaat_status'] = 'W'; //$this->input->post('pmurojaat_status');
                $result['natija_text'] = ''; // $this->input->post('pnatija_text');
                $result['zapas'] = 1; //$this->input->post('pzapas');
                $result['link'] = $this->input->post('plink');
                $result['aptype'] = $this->input->post('paptype');
                $result['byear'] = $this->input->post('pbyear');
                $result['code'] = $this->input->post('ac_code');
                  $result['ptype'] = $this->input->post('ptype');
                  $result['ptypes'] = $this->input->post('ptypes');
                
                break;

            case 'csubscribe' :
                $result['email'] = $this->input->post('pemail');
                $result['lang'] = $this->input->post('lang');
                break;

            case 'csimple_citizen' :

                $result['name'] = $this->input->post('pism');
                $result['lastname'] = $this->input->post('pfam');
                $result['email'] = $this->input->post('pemail');
                $result['phone'] = $this->input->post('ptelefon');
                $result['address'] = $this->input->post('padres');
                $result['text'] = $this->input->post('pmtext');
                $result['kimga_id'] = $this->input->post('pkimga_id');
                $result['ap_status'] = 'W';
                $result['natija_text'] = '';
                $result['zapas'] = 1;
                $result['link'] = $this->input->post('plink');
                break;

            case 'cresume' :

                $result['name'] = $this->input->post('res_fio');
                $result['email'] = $this->input->post('res_email');
                $result['phone'] = $this->input->post('res_phone');
                $result['vacancy'] = $this->input->post('res_vac');
                $result['file'] = $this->input->post('res_file');
                $result['link'] = $this->input->post('res_link');
                break;

            default :
                break;
        }
        return $result;
    }
  
  
}