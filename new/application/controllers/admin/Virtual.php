<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Virtual extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->data['sel'] = 'virtual';	
        $this->data['filter'] = '';	
		$this->load->model('virtual_model', 'virtual');  
    
        if($this->data['user_type'] != 'admin'){
           go_to(site_url('admin/main'));
        }
    }
    
       public function index($offset = 0)
	{
        $this->load->library('pagination');
        $config = array();
        $this->data['sub_sel'] = 'all';
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url().'/admin/virtual?';
       // $config['total_rows'] = $this->posts->count_category($group, $param);
       $config['total_rows'] = $this->virtual->count_all_v();
        $config['per_page'] = 50;
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
        $this->data['posts'] = $this->virtual->get_posts_p(array('limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['body'] = "admin/virtual/index";
        $this->load->view('admin/index', $this->data);
	}
    
     public function save($id){
        if($this->input->post()){
             $data = array(
                'status' => $this->input->post('status')
             );
        }
         $this->form_validation->set_rules('status', 'Статус', 'trim|required');
          if($this->form_validation->run())
          {
             $this->virtual->save($data, $id); 
             go_to(site_url('admin/virtual'));
          }
          if($id){
            $post = $this->virtual->get($id);
            if($post){
                  
                  $this->data['post'] =  $post; 
                 $this->data['body'] = "admin/virtual/save";
                 $this->load->view('admin/index', $this->data);
            }else{
                go_to(site_url('admin/virtual'));
            }
         }else{
            go_to(site_url('admin/virtual'));
         }
     }
    
    public function delete($id){
        if($id){
            $post = $this->virtual->get($id);
            @unlink('./uploads/virtual/'.$post->file);
            $this->virtual->delete($id);
        }
        go_to();
    }
} 
?>