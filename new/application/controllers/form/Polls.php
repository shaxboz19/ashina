<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('polls2_model', 'polls');
             $this->load->library('form_validation');
    $this->load->language('public');
    $this->load->language('public2');
	}
	
	public function index()
	{
	   if(@$_SERVER["HTTP_REFERER"]){
            $type = $this->input->post('type');
            $savol_id = $this->input->post('id');
            $this->form_validation->set_rules('type', 'lang:javob', 'trim|required');
           
            
            if ($this->form_validation->run()) {
            if($this->session->userdata('polls_id_'.$savol_id) != $savol_id)
            {
                $savol = $this->polls->get($savol_id);
                if($savol){
                    switch($type){
                        case 'yes':
                            $data['count_1'] = $savol->count_1 + 1;
                            $this->polls->save($data, $savol_id);
                            break;
                        case 'no':
                            $data['count_2'] = $savol->count_2 + 1;
                            $this->polls->save($data, $savol_id);
                            break;
                        }
                   
                
                 $this->session->set_userdata(array('polls_id_'.$savol_id => $savol->id));
                $this->data['item'] = $this->polls->get($savol_id);
                $status = $this->load->view('public/adliya/polls/ajax', $this->data);
                return $status;
                }
            }
            else
            {
                $status = '<div class="alert alert-danger">'.lang('siz_javob_bergansiz').'</div>';
                echo $status; 
            }
    
            
            } else {
                $status = '<div class="alert alert-danger">'.lang('variant_otveta').'</div>';
                echo $status; 
            }
        }else{
            go_to(site_url());
        }
	}
  
  
  
}
?>