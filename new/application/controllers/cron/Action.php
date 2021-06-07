<?php

Class Action extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        //$this->load->model('contacts_model');
       // $this->load->model('ratings_model');
       // $this->load->model('order_model');
        $this->load->library('email');
        $this->data['sel'] = 'feedback';

	}
    
    public function index($group)
    {     
       
       $res = $this->posts->get_posts_p(array('group' => $group, 'status_check_lang' => 'inactive', 'status' => 'active', 'limit' => '100'));
       
       //var_dump($res);
       
       foreach($res as $item):
       
       
       $status_uz = (_t($item->title, 'uz') || _t($item->short_content, 'uz') || _t($item->content, 'uz')) ? 'active': 'inactive';
       $status_oz = (_t($item->title, 'oz') || _t($item->short_content, 'oz') || _t($item->content, 'oz')) ? 'active': 'inactive';
       $status_ru = (_t($item->title, 'ru') || _t($item->short_content, 'ru') || _t($item->content, 'ru')) ? 'active': 'inactive';
       $status_en = (_t($item->title, 'en') || _t($item->short_content, 'en') || _t($item->content, 'en')) ? 'active': 'inactive';
       
            $data = array(
                'status_lang_uz' => $status_uz,
                'status_lang_oz' => $status_oz,
                'status_lang_ru' => $status_ru,
                'status_lang_en' => $status_en,
                'status_check_lang' => 'active',          
            );
           $this->posts->save($data, $item->id);
       endforeach;
        
    }
    
     public function all()
    {     
       
       $res = $this->posts->get_posts_p(array('status_check_lang' => 'inactive', 'status' => 'active', 'media' => 'inactive', 'limit' => '100'));
       
       //var_dump($res);
       
       foreach($res as $item):
       
       
       $status_uz = (_t($item->title, 'uz') || _t($item->short_content, 'uz') || _t($item->content, 'uz')) ? 'active': 'inactive';
       $status_oz = (_t($item->title, 'oz') || _t($item->short_content, 'oz') || _t($item->content, 'oz')) ? 'active': 'inactive';
       $status_ru = (_t($item->title, 'ru') || _t($item->short_content, 'ru') || _t($item->content, 'ru')) ? 'active': 'inactive';
       $status_en = (_t($item->title, 'en') || _t($item->short_content, 'en') || _t($item->content, 'en')) ? 'active': 'inactive';
       
            $data = array(
                'status_lang_uz' => $status_uz,
                'status_lang_oz' => $status_oz,
                'status_lang_ru' => $status_ru,
                'status_lang_en' => $status_en,
                'status_check_lang' => 'active',          
            );
           $this->posts->save($data, $item->id);
       endforeach;
       
       var_dump($res);
        
    }
        
}
?>