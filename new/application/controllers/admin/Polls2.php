<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls2 extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'polls2';		

		$this->load->model('polls2_model', 'polls'); 
	} 

	public function index()
	{
	 $this->load->library('pagination');

  $config = array();
  $config['query_string_segment'] = 'page';
  $config['page_query_string'] = TRUE;
  $config['base_url'] = base_url().'/admin/polls2/?';
  $config['total_rows'] = $this->polls->count_polls2();
  $config['per_page'] = 25;
  
  $config['full_tag_open'] = '<div class="pagination"><ul>';
$config['full_tag_close'] = '</ul></div><!--pagination-->';

$config['first_link'] = '&laquo;';
$config['first_tag_open'] = '<li class="prev page">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = '&raquo;';
$config['last_tag_open'] = '<li class="next page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '&rarr;';
$config['next_tag_open'] = '<li class="next page">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&larr;';
$config['prev_tag_open'] = '<li class="prev page">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page">';
$config['num_tag_close'] = '</li>';  

    
     $this->pagination->initialize($config);
   
   
		$this->data['posts'] = $this->polls->get_all_polls_admin(array('status' => 'active', 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
    
    
    $this->data['pagination'] = $this->pagination->create_links();

		$this->data['body'] = 'admin/polls2/index';
	    $this->load->view('admin/index', $this->data);
	}
    
    public function edit($id=FALSE)
    {
        $this->form_validation->set_rules('title[]', 'Вопрос', 'trim|required');        
         
        if(!$this->form_validation->run())
        {
            
            $this->data['post'] =  $this->polls->get($id);
             
    		$this->data['body'] = 'admin/polls2/edit';
    	    $this->load->view('admin/index', $this->data);    
        }
        else
        {
            $data = array();
            $data['title'] = serialize($this->input->post('title'));
            $data['status'] = $this->input->post('status');
            
			//$data['alias'] = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('alias'));
            
            $this->polls->save($data, $id);
            
            go_to("admin/polls2");
        }        
    }

    
   	public function delete($id)
	{
		$this->polls->delete($id);
		go_to();
	}

}
?>