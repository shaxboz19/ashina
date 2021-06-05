<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Adliya extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('posts_model', 'posts');
        $this->load->model('posts2_model', 'posts2');
        $this->load->model('model_regions');
        $this->load->model('model_city');
       // $this->load->model('model_regions');
       // $this->load->model('resume_model', 'resume1');
        $this->load->library('pagination');
        $this->lang->load('sozlar', 'russian');
        $this->load->library('user_agent');
    }
    
    
    
    public function leadership($offset = 0)
    {
        $this->data['sel']     = 'leadership';

        $base_url = base_url() . LANG . '/leadership/?';
        $total = '';//$this->posts->get_posts_countLang('manage', LANG);
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);

        $this->data['leadership'] = $this->posts->get_posts_p(array(
            'group' => 'leadership',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'order' => 'ASC', 
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 1;
         $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/leadership/index';

        @$this->data['meta'] = getMetaContentId(30, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
     public function apparat($offset = 0)
    {
        $this->data['sel']     = 'apparat';

        $base_url = base_url() . LANG . '/apparat/?';
        $total = '';//$this->posts->get_posts_countLang('manage', LANG);
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);

        $this->data['leadership'] = $this->posts->get_posts_p(array(
            'group' => 'apparat',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'order' => 'ASC', 
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 1;
         $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/apparat/index';

        @$this->data['meta'] = getMetaContentId(31, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
     public function territorial($offset = 0)
    {
        $this->data['sel']     = 'territorial';

        $base_url = base_url() . LANG . '/territorial/?';
        $total = '';//$this->posts->get_posts_countLang('manage', LANG);
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);

       $this->data['inspections'] = $this->posts->get_posts_p(array('group' => 'regions', 'order' => 'ASC', 'media' => 'inactive', 'status' => 'active', 'limit' => '14'));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 1;
        // $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/territorial/index';

        @$this->data['meta'] = getMetaContentId(32, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
    
   
    public function announcement(){
        $this->data['sel']     = 'announcement';

        $base_url = base_url() . LANG . '/announcement/?';
        $total = $this->posts->get_posts_countLang('announcement', LANG);
        $per_page = 8;
        pagination_pages($base_url, $total, $per_page);

        $this->data['news'] = $this->posts->get_posts_p(array(
            'group' => 'announcement',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'orderby' => 'created_on', 
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 4;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/announcement/index';

        @$this->data['meta'] = getMetaContentId(59, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
     public function announcement_view($alias){
      $this->data['sel'] = $alias;
      $this->data['sel_all_gallery'] = 'news';
      $this->data['group'] = 'announcement';
      $this->data['sel_news'] = 'news';   
       $this->data['sel_news_lang'] = 'news';    
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        $this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;       
        $this->data['title_id'] =59;
        $this->data['links'] ='announcement';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }
             if($post->group == 'announcement'){                
                 $this->data['category_id_title'] = 4;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/announcement/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
      
    }
    
    public function articles(){
        $this->data['sel']     = 'articles';

        $base_url = base_url() . LANG . '/articles/?';
        $total = $this->posts->get_posts_countLang('articles', LANG);
        $per_page = 8;
        pagination_pages($base_url, $total, $per_page);

        $this->data['news'] = $this->posts->get_posts_p(array(
            'group' => 'articles',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'orderby' => 'created_on', 
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 4;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/articles/index';

        @$this->data['meta'] = getMetaContentId(58, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
      public function articles_view($alias){
      $this->data['sel'] = $alias;
      $this->data['sel_all_gallery'] = 'news';
      $this->data['group'] = 'articles';
      $this->data['sel_news'] = 'news';   
       $this->data['sel_news_lang'] = 'news';    
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        $this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;       
        $this->data['title_id'] =58;
        $this->data['links'] ='articles';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }
             if($post->group == 'articles'){                
                 $this->data['category_id_title'] = 4;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'status_lang_'.LANG => 'active', 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/articles/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
      
    }
    
     public function publications(){
        $this->data['sel']     = 'publications';

        $base_url = base_url() . LANG . '/publications/?';
        $total = $this->posts->get_posts_countLang('publications', LANG);
        $per_page = 8;
        pagination_pages($base_url, $total, $per_page);

        $this->data['news'] = $this->posts->get_posts_p(array(
            'group' => 'publications',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'orderby' => 'created_on', 
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 4;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/publications/index';

        @$this->data['meta'] = getMetaContentId(61, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
     public function publications_view($alias){
      $this->data['sel'] = $alias;
      $this->data['sel_all_gallery'] = 'news';
      $this->data['group'] = 'publications';
      $this->data['sel_news'] = 'news';   
       $this->data['sel_news_lang'] = 'news';    
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        $this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;       
        $this->data['title_id'] =61;
        $this->data['links'] ='publications';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }
             if($post->group == 'publications'){                
                 $this->data['category_id_title'] = 4;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'status_lang_'.LANG => 'active', 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/publications/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
      
    }
    
    public function polls(){
        $this->data['sel']     = 'polls';
         $this->data['sel_user'] = 'user_info';
         $this->load->model('polls2_model', 'polls'); 

        $base_url = base_url() . LANG . '/polls/?';
        $total = $this->polls->get_polls_count('active');
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);

        $this->data['polls'] = $this->polls->get_all_polls_admin(array(
            'status' => 'active',
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        /*$this->data['category_id_title'] = 117;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'interactive',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));*/
        $this->data['body'] = 'public/adliya/polls/index';

        @$this->data['title'] = lang('polls_title');
        $this->load->view('public/container', $this->data);
    }
    
    public function notarius(){
          $this->data['sel']     = 'notarius';
        $this->data['sel_menu']     = 'services';
        $base_url = base_url() . LANG . '/notarius/?';
        $per_page = 20;
        
        if($this->input->get()){
            $total = $this->posts2->search_count_filter($this->input->get());
            
            pagination_pages($base_url, $total, $per_page);
    
            $this->data['notarius'] = $this->posts2->get_posts_p(array(
                'group' => 'notarius',
                'status' => 'active',
                'media' => 'inactive',
                'status_lang_'.LANG => 'active',
                'order' => 'ASC',
               // 'orderby' => 'created_on',
                'filter' =>  $this->input->get(),
                'limit' => $per_page,
                'offset' => (int) $this->input->get('page')
            ));
        }else{
            $total = $this->posts2->get_posts_countLang('notarius', LANG);
            
            pagination_pages($base_url, $total, $per_page);
    
            $this->data['notarius'] = $this->posts2->get_posts_p(array(
                'group' => 'notarius',
                'status' => 'active',
                'media' => 'inactive',
                'status_lang_'.LANG => 'active',
                'order' => 'ASC',
               // 'orderby' => 'created_on', 
                'limit' => $per_page,
                'offset' => (int) $this->input->get('page')
            ));
        }
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 117;
        
         $this->data['notarius_list'] = $this->posts2->get_posts_p(array(
            'group' => 'notarius_list',
            'status' => 'active',
            'media' => 'inactive',
        ));
        
        $this->data['region'] = $this->model_regions->regions_get3();  
        $this->data['city'] = $this->model_city->city_get2();  

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/notarius/index';

        @$this->data['meta'] = getMetaContentId(76, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
    public function services_view($alias){
      $this->data['sel'] = $alias;
      $this->data['group'] = 'services';
      $this->data['sel_menu']     = 'services';   
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        //$this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;    
        $this->data['links'] ='services';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 /*if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }*/
             if($post->group == 'services'){                
                 $this->data['category_id_title'] = 117;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/services/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
    }
    
    public function infographics(){
         $this->data['sel']     = 'infographics';
         $this->data['sel_menu']     = 'services';
        $this->data['links'] = 'infographics';  
        $base_url = base_url() . LANG . '/infographics/?';
        $total = $this->posts->get_posts_countLang('infographics', LANG);
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);

        $this->data['news'] = $this->posts->get_posts_p(array(
            'group' => 'infographics',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 117;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/infographics/index';

        @$this->data['meta'] = getMetaContentId(77, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
    public function infographics_view($alias){
      $this->data['sel'] = $alias;
      $this->data['group'] = 'infographics';
      $this->data['sel_menu']     = 'services';   
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        //$this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;    
        $this->data['links'] ='services';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 /*if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }*/
             if($post->group == 'infographics'){                
                 $this->data['category_id_title'] = 117;
                 $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/infographics/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
    }

    
    public function firms(){
                  $this->data['sel']     = 'firms';
        $this->data['sel_menu']     = 'firms';
        $base_url = base_url() . LANG . '/firms/?';
        $per_page = 20;
        
        if($this->input->get()){
            $total = $this->posts2->search_count_filter($this->input->get());
            
            pagination_pages($base_url, $total, $per_page);
    
            $this->data['firms'] = $this->posts2->get_posts_p(array(
                'group' => 'firms',
                'status' => 'active',
                'media' => 'inactive',
                'status_lang_'.LANG => 'active',
                'order' => 'ASC',
               // 'orderby' => 'created_on',
                'filter' =>  $this->input->get(),
                'limit' => $per_page,
                'offset' => (int) $this->input->get('page')
            ));
        }else{
            $total = $this->posts2->get_posts_countLang('firms', LANG);
            
            pagination_pages($base_url, $total, $per_page);
    
            $this->data['firms'] = $this->posts2->get_posts_p(array(
                'group' => 'firms',
                'status' => 'active',
                'media' => 'inactive',
                'status_lang_'.LANG => 'active',
                'order' => 'ASC',
               // 'orderby' => 'created_on', 
                'limit' => $per_page,
                'offset' => (int) $this->input->get('page')
            ));
        }
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 117;
        
         $this->data['firms_list'] = $this->posts2->get_posts_p(array(
            'group' => 'firms_list',
            'status' => 'active',
            'media' => 'inactive',
        ));
        
        $this->data['region'] = $this->model_regions->regions_get3();  
        $this->data['city'] = $this->model_city->city_get2();  

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/firms/index';

        @$this->data['meta'] = getMetaContentId(131, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
        
    public function interactive(){
         $this->data['sel']     = 'interactive';
         $this->data['sel_menu']     = 'services';
        $this->data['links'] = 'interactive';  
        $base_url = base_url() . LANG . '/interactive/?';
        $total = $this->posts->get_posts_countLang('interactive', LANG);
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);

        $this->data['news'] = $this->posts->get_posts_p(array(
            'group' => 'interactive',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 117;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/interactive/index';

        @$this->data['meta'] = getMetaContentId(79, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
      public function interactive_view($alias){
      $this->data['sel'] = $alias;
      $this->data['group'] = 'interactive';
      $this->data['sel_menu']     = 'services';   
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        //$this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;    
        $this->data['links'] ='services';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 /*if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }*/
             if($post->group == 'interactive'){  
                 $post_id = $post->id;
                  $base_url = base_url() . LANG . '/interactive/' . $post->alias . '/?';     
                    $total = $this->posts->count_categoryLang('docs', LANG, $post_id);          
                    $per_page = 50;
                    pagination_pages($base_url, $total, $per_page);
                    $this->data['docs'] = $this->posts->get_posts_p(array('group' => 'docs', 'status_lang_'.LANG => 'active', 'order' => 'DESC', 'category_id' => $post_id, 'status' => 'active', 'limit' => $per_page, 'offset' => (int)$this->input->get('page')));

        
        $this->data['pagination'] = $this->pagination->create_links();
                 $this->data['category_id_title'] = 117;
                 $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/interactive/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
    }
    
        
    public function state(){
         $this->data['sel']     = 'state';
         $this->data['sel_menu']     = 'services';
        $this->data['links'] = 'state';  
        $base_url = base_url() . LANG . '/state/?';
        $total = $this->posts->get_posts_countLang('state', LANG);
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);

        $this->data['news'] = $this->posts->get_posts_p(array(
            'group' => 'state',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 117;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/state/index';

        @$this->data['meta'] = getMetaContentId(81, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
     public function state_view($alias){
      $this->data['sel'] = $alias;
      $this->data['group'] = 'state';
      $this->data['sel_menu']     = 'services';   
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        //$this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;    
        $this->data['links'] ='services';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 /*if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }*/
             if($post->group == 'state'){  
                 $post_id = $post->id;
                  $base_url = base_url() . LANG . '/state/' . $post->alias . '/?';     
                    $total = $this->posts->count_categoryLang('docs', LANG, $post_id);          
                    $per_page = 50;
                    pagination_pages($base_url, $total, $per_page);
                    $this->data['docs'] = $this->posts->get_posts_p(array('group' => 'docs', 'status_lang_'.LANG => 'active', 'order' => 'DESC', 'category_id' => $post_id, 'status' => 'active', 'limit' => $per_page, 'offset' => (int)$this->input->get('page')));

        
        $this->data['pagination'] = $this->pagination->create_links();
                 $this->data['category_id_title'] = 117;
                 $this->data['list'] = $this->posts->get_posts_p(array('group' => 'services',  'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/state/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
    }
    
      public function legislation(){
        $this->data['sel']     = 'legislation';

        $base_url = base_url() . LANG . '/legislation/?';
        $total = $this->posts->get_posts_countLang('legislation', LANG);
        $per_page = 8;
        pagination_pages($base_url, $total, $per_page);

        $this->data['news'] = $this->posts->get_posts_p(array(
            'group' => 'legislation',
            'status' => 'active',
            'status_lang_'.LANG => 'active',
            'orderby' => 'created_on', 
            'limit' => $per_page,
            'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 4;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

        $this->data['body'] = 'public/adliya/legislation/index';

        @$this->data['meta'] = getMetaContentId(135, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }
    
     public function legislation_view($alias){
      $this->data['sel'] = $alias;
      $this->data['sel_all_gallery'] = 'news';
      $this->data['group'] = 'legislation';
      $this->data['sel_news'] = 'news';   
       $this->data['sel_news_lang'] = 'news';    
      
      $post = $this->posts->get_id_all( $alias );
      if($post->status == 'active'){        
        $this->data['all_images'] = $this->posts->get_media_files( $post->id );
        $this->data['post'] = $post;       
        $this->data['title_id'] =135;
        $this->data['links'] ='legislation';
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        if(LANG == 'uz'){$status_lang = $post->status_lang_uz;}
        if(LANG == 'oz'){$status_lang = $post->status_lang_oz;}
        if(LANG == 'en'){$status_lang = $post->status_lang_en;}
        if(LANG == 'ru'){$status_lang = $post->status_lang_ru;}
        if($status_lang == 'active'){
			 if(!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id){
                 $this->session->set_userdata(array('ip_view' => $post->id));
                 $this->posts->update_views($post->id, $post->views);
             }else{
    
             }
             if($post->group == 'legislation'){                
                 $this->data['category_id_title'] = 4;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));
                
                $this->data['body'] = 'public/adliya/legislation/view';
              } else{
                show_404();
              }
      
            $this->load->view('public/container', $this->data);
		 }else{
			 go_to(site_url());
		 }      
      }else{
        show_404();
      }
      
    }
    
}
?>