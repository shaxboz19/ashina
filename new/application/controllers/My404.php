<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My404 extends Public_Controller 
{
 public function __construct() 
 {
    parent::__construct(); 
 } 

 public function index() 
 { 
    $this->data['sel'] = '404';
    $this->data['title'] = '404 '.lang('404_error_text');
    $this->output->set_status_header('404'); 
   // $this->load->view('public/system/404');//loading in custom error view
     $this->data['body'] = 'public/system/404';
    $this->load->view('public/container', $this->data);
 } 
} 