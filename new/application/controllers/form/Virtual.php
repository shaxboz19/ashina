<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Virtual extends Public_Controller
{
  public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('email','input');
       	$this->load->model('virtual_model', 'virtual');  
    }  
    
    public function index(){
           if(@$_SERVER["HTTP_REFERER"]){
             $this->form_validation->set_rules('captcha', 'lang:captcha', "callback__captcha_check",'trim|required|xss_clean');
              $this->form_validation->set_rules('first_name', 'lang:vir_first_name', 'trim|required');
              $this->form_validation->set_rules('last_name', 'lang:vir_last_name', 'trim|required');
              $this->form_validation->set_rules('middle_name', 'lang:vir_middle_name', 'trim|required');
              $this->form_validation->set_rules('address', 'lang:vir_address', 'trim|required');
              $this->form_validation->set_rules('passport', 'lang:vir_passport', 'trim|required');
              
              $this->form_validation->set_rules('phone', 'lang:vir_phone', 'trim|required');
              
              
             if($this->form_validation->run()){
                $rand = $this->virtual->randomNumber(5);
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'middle_name' => $this->input->post('middle_name'),
                    'region_id' => $this->input->post('region_id'),
                    'city_id' => $this->input->post('city_id'),
                    'postcode' => $this->input->post('postcode'),
                    'address' => $this->input->post('address'),
                    'passport' => $this->input->post('passport'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'face_type' => $this->input->post('face_type'),
                    'gender' => $this->input->post('gender'),
                    'birthday' => to_date('Y-m-d', $this->input->post('birthday')),
                    'appeal_type' => $this->input->post('appeal_type'),
                    'message' => $this->input->post('message'),
                    
                    'code' => $rand,
                    'access_code' => md5($rand),
                    'created_on' => date('Y-m-d H:i:s'),
                );
                $upload_data = array();
                if ($_FILES['userfile']['size'] > 0) {
                    $result = do_upload('virtual');
                    if (!empty($result['error'])) {
                        $error = true;
                        $this->data['error'] = $result['error'];
                    } else {
                        $error = false;
                        $upload_data = $this->upload->data();
                        $data['file'] = $upload_data['file_name'];
                    }
                }
                $id = $this->virtual->save($data);
                 $this->session->set_flashdata('success', lang('success_send'). '<br/><br/>'. lang('vir_number_request'). '<br/><strong>'.@$id.'</strong><br/>'.lang('vir_password').'<br/><strong>'.@$rand.'</strong>'); 
             }else{
                $this->session->set_flashdata('error_success', lang('success_email_error1'). validation_errors() );
                
             }
             go_to();
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
         $this->form_validation->set_message('_captcha_check', 'Invalid %s');
         return false;
        }
      }
      
      
    public function status() {
        $id = $this->input->post('id');
        $cid = $this->input->post('cid');
        $a = $this->virtual->check_cid_id($id, $cid);

        if($a == 1) {
            $res = $this->virtual->get($id);
            $this->output->set_header("Content-Type: application/json; charset=utf-8");
            $status = lang('vir_status').': <br/>'.lang('vs_'.$res->status);
            
            $this->output->set_output(json_encode(array('data' => $status)));
        } else {
            print 'false';
//            json_encode(array('stat' => false));
        }
    }
    
    public function captcha_check_ajax()
    {
        $expiration = time()-7200; // Two hour limit
        $cap=$this->input->post('captcha');        
        $this->output->set_header("Content-Type: application/json; charset=utf-8");
        if($this->session->userdata('word')== $cap AND $this->session->userdata('ip_address')== $this->input->ip_address() AND $this->session->userdata('captcha_time')> $expiration)
        {
            $this->output->set_output(json_encode(true));
        }else{
            $this->output->set_output(json_encode(false));
        }
    }
    
}
?>