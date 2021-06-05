<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'rss';
         $this->load->helper('xml');
        $this->load->helper('text');
		$this->load->model('posts_model', 'posts');
	}

	public function index()
	{
$this->output->set_header("Content-Type: application/rss+xml;charset=utf8");
      $this->data['feed_name'] = 'Новости'; // your website
    $this->data['encoding'] = 'utf-8'; // the encoding
    $this->data['feed_url'] = base_url(); // the url to your feed
    $this->data['page_description'] = 'Новости'; // some description
    $this->data['page_language'] = 'ru'; // the language
    $this->data['creator_email'] = '<span class="skimlinks-unlinked">'.site_url().'</span>'; // your email
    

	   $this->data['news'] = $this->posts->get_posts_p(array('group' => 'news', 'status' => 'active', 'limit' => '50'));

       $this->load->view('public/pages/rss', $this->data);
	}
    
    public function rss2()
	{
$this->output->set_header("Content-Type: application/rss+xml;charset=utf8");
      $this->data['feed_name'] = 'Новости'; // your website
    $this->data['encoding'] = 'utf-8'; // the encoding
    $this->data['feed_url'] = base_url(); // the url to your feed
    $this->data['page_description'] = 'Новости'; // some description
    $this->data['page_language'] = 'ru'; // the language
    $this->data['creator_email'] = '<span class="skimlinks-unlinked">'.site_url().'</span>'; // your email
    

	   $this->data['news'] = $this->posts->get_posts_p(array('group' => 'news', 'status' => 'active', 'limit' => '50'));

       $this->load->view('public/pages/rss2', $this->data);
	}
    
    
}