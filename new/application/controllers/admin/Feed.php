<?php

/**
 * @author Rustam OSG
 * @copyright 2018
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'feed';		

		$this->load->model('feed_model', 'feed'); 
	} 

   
    public function index($group, $offset = 0)
	{
	 
    $this->load->library('pagination');
    
    $config = array();
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url().'/admin/feed/index/'.$group.'/?';
    
  
    
   // $config['total_rows'] = $this->posts->count_category($group, $param);
   $config['total_rows'] = $this->feed->getfeed_count($group);
   
    $config['per_page'] = 80;
    
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
    //$this->data['posts'] = $this->posts->get_posts_portfolio($group, $param, $config['per_page'], (int)$this->input->get('page'));
    
    //$this->data['users'] = $this->user_events->get_list( array('post_id' => $param, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')) );
    
    $this->data['feed'] = $this->feed->get_feed(array('groups' => $group, 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
    
      
     $this->data['group'] = $group;
    $this->data['pagination'] = $this->pagination->create_links();
         
  
   
    $this->data['body'] = "admin/feed/index";
    $this->load->view('admin/index', $this->data);
	}
    
    public function edit($group, $id)
    {
        $this->form_validation->set_rules('name', 'Имя', 'trim|required');
        //$this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        //$this->form_validation->set_rules('phone', 'Телефон', 'trim|required');
       // $this->form_validation->set_rules('message', 'Сообщение', 'trim|required');
        //$this->form_validation->set_rules('time', 'Время', 'trim|required');
       // $this->form_validation->set_rules('people', 'Количество человек', 'trim|required');
       // $this->form_validation->set_rules('status', 'Статус', 'trim|required');
         
        if(!$this->form_validation->run())
        {
            
            $this->data['feed'] =  $this->feed->get($id);
             
    		$this->data['body'] = 'admin/feed/edit';
    	    $this->load->view('admin/index', $this->data);    
        }
        else
        {
            $data = array();
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['message'] = $this->input->post('message');
            $data['time'] = $this->input->post('time');
            $data['people'] = $this->input->post('people');
            $data['status'] = $this->input->post('status');
            
            $this->feed->save($data, $id);
            
            go_to("admin/feed/index/".$group);
        }        
    }
    
   	public function delete($id)
	{
	  $post = $this->feed->get($id);
      if($post->file){
       	@unlink( "./uploads/$post->groups/$post->file" );
        }
		$this->feed->delete($id);
		go_to();
	}
}