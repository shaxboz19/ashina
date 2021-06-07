<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends Public_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->data['sel'] = 'gallery';
    $this->data['group'] = 'gallery';
    $this->data['sel_main'] = 'gallery';
    $this->load->library('pagination');

  }


 /* public function all_gallery($offset = 0)
  {
    $this->data['sel_all_gallery'] = 'gallery';


    $config = array();
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url() . LANG . '/gallery/?';
    $config['total_rows'] = $this->posts->total_posts_and_media_files(array('group' => 'gallery', 'status' => 'active'));
    $config['per_page'] = 20;

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

    // $category_menu = array();
    //$category_menu = $this->posts->get_posts_p(array('group' => 'p_option', 'category_id' => 193, 'status' => 'active', 'order' => 'ASC', 'limit' => '20'));

    $args = array('group' => 'gallery', 'status' => 'active',  'order' => 'DESC', 'limit' => $config['per_page'], 'offset' => (int) $this->input->get('page'));

    $this->data['gallery_all'] = $this->posts->get_posts_and_media_files($args);
    // 'category_id' => $category_menu[0]->id,


    $this->data['pagination'] = $this->pagination->create_links();

    $this->data['meta'] = getMetaContentId(26, 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];

    $this->data['body'] = "public/gallery/gallery";
    $this->load->view('public/container', $this->data);
  }*/

  public function gallery_one($offset = 0)
  {
    $this->data['sel_all_gallery'] = 'photo';

    $base_url = base_url() . LANG . '/gallery/?';
    $total = $this->posts->get_posts_countLang('gallery', LANG); //$this->posts->get_posts_count('gallery'); //
    $per_page = 12;
    pagination_pages($base_url, $total, $per_page);


    $args = array('group' => 'gallery', 'status' => 'active', 'order' => 'DESC', 'limit' => $per_page, 'status_lang_'.LANG => 'active', 'offset' => (int) $this->input->get('page'));

    $this->data['gallery_all'] = $this->posts->get_posts_p($args);

    $this->data['category_id_title'] = 17;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status_lang_' . LANG => 'active', 'media' => 'inactive', 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));


    $this->data['pagination'] = $this->pagination->create_links();

    $post_id = 45;

    $this->data['meta'] = getMetaContentId($post_id, 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];

    $this->data['body'] = "public/gallery/gallery";
    $this->load->view('public/container', $this->data);
  }



  public function view($alias = FALSE, $offset = 0)
  {
    $this->data['sel_all_gallery'] = 'gallery';
    $this->data['sel'] = $alias;

    $this->load->library('pagination');

    $id = $this->posts->get_id($alias);
    // $this->data['view'] = $this->posts->get($id);

    $config = array();
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url() . LANG . '/gallery/' . $alias . '/?';
    $config['total_rows'] = ''; //$this->posts->total_posts_and_media_files(array('group' => 'gallery', 'alias' => $alias, 'status' => 'active'));
    $config['per_page'] = 200;

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
    /* $post_id = $this->posts->get_id($alias);
    $lookbook = $this->posts->get($post_id);
    $this->data['images'] = $this->posts->get_media_files($post_id, 12);
    $this->data['all_images'] = $this->posts->get_media_category_in($post_id);
    $this->data['post'] = $lookbook;*/
    //$this->data['alias'] = $this->data['sel'] = $alias;
    //$this->data['countries'] = json_decode($this->load->file('application/files/countries.json',true));
    //$this->data['direction'] = $this->posts->get_posts_direction(array('direction'=> $alias, 'order' => 'ASC', 'group'=>'direction', 'status' => 'active', 'limit' => $config['per_page'], 'offset' => (int)$this->input->get('page')));
    $args = array('group' => 'gallery', 'order' => 'ASC', 'status' => 'active', 'alias' => $alias, 'limit' => $config['per_page'], 'offset' => (int) $this->input->get('page'));
    //$args['alias'] = $alias;

    $this->data['category_id_title'] = 17;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status_lang_' . LANG => 'active', 'media' => 'inactive', 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

    $this->data['gallery_all'] = $this->posts->get_posts_and_media_files_alias($args);

    /*$this->data['meta_news'] = getMetaContentId(65, 'title+description+keywords');
    $this->data['title_news'] = $this->data['meta_news']['title'];*/

    $this->data['meta'] = getMetaContentId($id, 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];


    //$this->data['category_id_title'] = 146;
    //$this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => 146, 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

    //$this->data['meta'] = getMetaContentId(472, 'title+description+keywords');
    //  $this->data['title_main'] = $this->data['meta']['title'];
    if (!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $id) {
      //$this->session->set_userdata(array('ip_view' => $id));
      //$this->posts->update_views($id, $this->data['view']->views);
    } else {
    }



    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['body'] = "public/gallery/view";

    $this->load->view("public/container", $this->data);
  }
}
