<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->load->model('posts_model', 'posts');
    	$this->load->library('pagination');
	}

	public function index()
	{

      //  $this->data['menu'] = $this->posts->get_posts_p( array('group'=>'menu', 'status' => 'active'));   
       // $this->data['news'] = $this->posts->get_posts_p( array('group'=>'news', 'status' => 'active', 'limit' => '10' ));   
 
        $this->load->view('public/pages/sitemap_xml', $this->data);
	}

   
}