<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Public_Controller extends MY_Controller
{
  public function __construct($offset = 0)
  {
    parent::__construct();
    //$this->load->model('weather');
    $this->load->language('public');
    $this->load->language('public2');
    $this->load->language('v');
    // $this->data['weather_meteo'] = $this->weather->get_weather();
    //$this->load->model('category_model', 'categories');
    $this->load->model('posts_model', 'posts');
    $this->load->model('menu_model', 'menu');
    //$this->load->model('site_model', 'site');   
    //$this->load->model('review_model', 'review');
    //$this->load->model('polls_model', 'polls');  
    $this->load->library('user_agent');

    // $this->data['user_id_main'] = $this->session->userdata('user_id');
    // $this->data['address'] = _t(getPosts(0,'title'), LANG);
    // $this->data['phone'] = _t(getPosts(0,'title'), 'ru');
    // $this->data['emails'] = _t(getPosts(0,'content_html'), 'ru');
    // $this->data['social'] = $this->posts->get_posts_p( array('group'=>'social', 'limit' => '3', 'media' => 'inactive', 'status' => 'active'));
    /*  $this->data['fb'] = getPosts(30,'option_1');
        $this->data['tg'] = getPosts(132,'option_1');
        $this->data['inst'] = getPosts(31,'option_1');
        $this->data['linkedin'] = getPosts(32,'option_1');*/



    $this->data['sel_menu'] = '';
    //  $this->data['site_users']= $this->posts->get_visitors();
    // Главное меню
    $this->data['menu'] = $this->posts->get_posts_p(array('group' => 'menu', 'order' => 'ASC', 'orderby' => 'sort_order', 'status_lang_' . LANG => 'active', 'status' => 'active', 'media' => 'inactive'));
    //$this->data['footer_menu'] = $this->posts->get_posts_p( array('group'=>'footer_menu', 'order'=>'ASC', 'orderby'=>'sort_order', 'status_lang_'.LANG => 'active', 'status' => 'active', 'media' => 'inactive'));

    //  $this->data['menu_2'] = $this->posts->get_posts( array('group'=>'menu_b', 'order'=>'ASC', 'orderby'=>'order', /*'limit' => '4',*/ 'status' => 'active') );

    // $this->data['menu_left'] = $this->posts->get_posts( array('group'=>'menu', 'order'=>'ASC', 'position_menu' => 'left', 'orderby'=>'sort_order', 'status' => 'active') );
    //  $this->data['menu_right'] = $this->posts->get_posts( array('group'=>'menu', 'order'=>'ASC', 'position_menu' => 'right', 'orderby'=>'sort_order', 'status' => 'active') );
    // $this->data['links'] = $this->posts->get_posts_p( array('group'=>'sidebar', 'order' => 'DESC', 'limit' => '40', 'status' => 'active'));


    // $this->data['menu_3'] = $this->posts->get_posts( array('group'=>'menu_b', 'order'=>'ASC', 'orderby'=>'sort_order', 'status' => 'active') );

    // $this->data['weather'] = $this->posts->get_posts_p( array('group'=>'weather', 'status' => 'active', 'limit' => '1') );
    //  $this->data['counter'] = $this->posts->get_posts_p( array('group'=>'counter', 'status' => 'active', 'limit' => '1') );
    //   $this->data['marquee'] = $this->posts->get_posts_p( array('group'=>'marquee', 'status' => 'active', 'limit' => '1') );
    // $this->data['services'] = $this->posts->get_posts( array('group'=>'services', 'order'=>'ASC', 'orderby'=>'order', 'status' => 'active') );
    //  $this->data['mainMenu'] = $this->menu->getMenuTrees();
    //$this->data['menu'] = $this->menu->getMenuTreesMain();
    // Меню
    // $this->data['main_menu'] = $this->menu->getMenuTreesMain();
    //$this->data['main_menu2'] = $this->menu->getMenuTreesMain_2();
    $this->data['main_menu_mobile'] = $this->menu->getMenuTreesMainMobile();
    // $this->data['main_menu_full'] = $this->menu->getMenuTreesMainFull();

    //$this->data['main_menu'] = $this->posts->get_posts( array('group'=>'menu', 'sort_order'=>'ASC', 'orderby'=>'order', 'status' => 'active') );

    // $this->data['advert'] = $this->posts->get_posts_p( array('group'=>'advert', 'status' => 'active', 'limit' => '5') );

    // Баннер 1
    // $this->data['banner'] =$this->posts->get_posts_and_media_files(array('group'=>'banner', 'limit' => '1', 'order' => 'ASC', 'status' => 'active'));
    // Баннер 2
    // $this->data['banner_1'] =$this->posts->get_posts_and_media_files(array('group'=>'banner_1', 'limit' => '1', 'order' => 'ASC',  'status' => 'active'));
    //  $this->data['banner_1'] =$this->posts->get_posts_p(array('group'=>'banner_1', 'limit' => '6', 'order' => 'ASC',  'status' => 'active'));
    // Баннер 3
    //  $this->data['banner_3'] =$this->posts->get_posts(array('group'=>'banner_3', 'limit' => '2', 'order' => 'ASC',  'status' => 'active'));

    //$this->data['review_home'] = $this->review->get_active(3, 0);

    //$this->data['news_slider'] = $this->posts->get_posts(array('group' => 'news', 'status' => 'active', 'spec' => 'active', 'limit' => '3'));
    // $this->data['update_site'] = $this->posts->get_posts_p(array('group' => 'news', 'status' => 'active', 'limit' => '1'));




    //$this->data['sidebar'] =$this->posts->get_posts(array('group'=>'sidebar', 'limit' => '15'));
    //$this->data['docs'] =$this->posts->get_posts_public('docs', false, 2);
    // $this->data['polls'] = $this->polls->get_all_polls_admin(array('status' => 'active', 'limit' => '1','order' => 'DESC'));


    /*  $this->data['meta'] = siteSettings('meta_tags_home', 'title+description+keywords');
    $this->data['price'] = $this->data['meta']['price'];*/

    $this->data['meta_global'] = siteSettings('meta_tags_home', 'title+description+keywords');
    $this->data['keywords_glob'] = $this->data['meta_global']['keywords'];
    $this->data['description_glob'] = $this->data['meta_global']['description'];
    $this->data['meta_title_glob'] = $this->data['meta_global']['meta_title'];
  }
}
