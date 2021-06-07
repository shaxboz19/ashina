<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class Mf extends Public_Controller
{
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('posts2_model', 'posts2');
    //  $this->load->model('model_regions');
    //$this->load->model('model_city');
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
    $total = ''; //$this->posts->get_posts_countLang('manage', LANG);
    $per_page = 50;
    pagination_pages($base_url, $total, $per_page);

    $this->data['leadership'] = $this->posts->get_posts_p(array(
      'group' => 'leadership',
      'status' => 'active',
      'status_lang_' . LANG => 'active',
      'order' => 'ASC',
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['category_id_title'] = 1;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_' . LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

    $this->data['body'] = 'public/mf/leadership/index';

    @$this->data['meta'] = getMetaContentId(17, 'title+description+keywords');
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
    $total = ''; //$this->posts->get_posts_countLang('manage', LANG);
    $per_page = 50;
    pagination_pages($base_url, $total, $per_page);

    $this->data['leadership'] = $this->posts->get_posts_p(array(
      'group' => 'apparat',
      'status' => 'active',
      'status_lang_' . LANG => 'active',
      'order' => 'ASC',
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['category_id_title'] = 15;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_' . LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

    $this->data['body'] = 'public/moqqv/apparat/index';

    @$this->data['meta'] = getMetaContentId(25, 'title+description+keywords');
    @$this->data['title'] = $this->data['meta']['title'];
    @$this->data['short_content'] = $this->data['meta']['short_content'];
    @$this->data['category_title'] = $this->data['meta']['category_title'];
    @$this->data['content'] = $this->data['meta']['content'];
    @$this->data['keywords'] = $this->data['meta']['keywords'];
    @$this->data['description'] = $this->data['meta']['description'];
    $this->load->view('public/container', $this->data);
  }

public function vacancy($offset = 0)
  {
    $this->data['sel']     = 'vacancy';

    $base_url = base_url() . LANG . '/vacancy/?';
    $total = $this->posts->get_posts_countLang('vacancy', LANG);
    $per_page = 15;
    pagination_pages($base_url, $total, $per_page);

    $this->data['vacancy'] = $this->posts->get_posts_p(array(
      'group' => 'vacancy',
      'status' => 'active',
      'status_lang_' . LANG => 'active',
      //'order' => 'ASC',
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['category_id_title'] = 0;
   // $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_' . LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

    $this->data['body'] = 'public/mf/vacancy/index';

    @$this->data['meta'] = getMetaContentId(4, 'title+description+keywords');
    @$this->data['title'] = $this->data['meta']['title'];
    @$this->data['short_content'] = $this->data['meta']['short_content'];
    @$this->data['category_title'] = $this->data['meta']['category_title'];
    @$this->data['content'] = $this->data['meta']['content'];
    @$this->data['keywords'] = $this->data['meta']['keywords'];
    @$this->data['description'] = $this->data['meta']['description'];
    $this->load->view('public/container', $this->data);
  }




  public function documentation($title_id, $group)
  {

    $this->data['category_id_title'] = 82;

    $this->data['sel']     = $group;

    $base_url = base_url() . LANG . '/' . $group . '/?';
    $total = $this->posts->count_categoryLang('documentation', LANG, $title_id);
    $per_page = 50;
    pagination_pages($base_url, $total, $per_page);

    $this->data['documentation'] = $this->posts->get_posts_p(array(
      'group' => 'documentation',
      'status' => 'active',
      'status_lang_' . LANG => 'active',
      'category_id' => $title_id,
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));
    $this->data['pagination'] = $this->pagination->create_links();

    $this->data['links'] = $group;

    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

    $this->data['body'] = 'public/moqqv/documentation/index';

    $post = $this->posts->get($title_id);
    $this->data['post'] = $post;

    $this->data['title'] = $post->title;
    $this->data['content'] = $post->content;
    $this->data['short_content'] = $post->short_content;
    $this->data['category_title'] = $post->category_title;
    $this->data['keywords'] = $post->keywords;
    $this->data['description'] = $post->description;
    $this->load->view('public/container', $this->data);
  }

  public function announcement()
  {
    $this->data['sel']     = 'announcement';
    $this->data['links']     = 'announcement';

    $base_url = base_url() . LANG . '/announcement/?';
    $total = $this->posts->get_posts_countLang('announcement', LANG);
    $per_page = 10;
    pagination_pages($base_url, $total, $per_page);

    $this->data['news'] = $this->posts->get_posts_p(array(
      'group' => 'announcement',
      'status' => 'active',
      'status_lang_' . LANG => 'active',
      'orderby' => 'created_on',
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['category_id_title'] = 17;

    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_' . LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

    $this->data['body'] = 'public/moqqv/announcement/index';

    @$this->data['meta'] = getMetaContentId(39, 'title+description+keywords');
    @$this->data['title'] = $this->data['meta']['title'];
    @$this->data['short_content'] = $this->data['meta']['short_content'];
    @$this->data['category_title'] = $this->data['meta']['category_title'];
    @$this->data['content'] = $this->data['meta']['content'];
    @$this->data['keywords'] = $this->data['meta']['keywords'];
    @$this->data['description'] = $this->data['meta']['description'];
    $this->load->view('public/container', $this->data);
  }

  public function announcement_view($alias)
  {
    $this->data['sel'] = $alias;
    $this->data['group'] = 'announcement';
    $this->data['sel_news'] = 'news';

    $post = $this->posts->get_id_all($alias);
    if ($post->status == 'active') {
      $this->data['post'] = $post;
      $this->data['title_id'] = 39;
      $this->data['links'] = 'announcement';
      $this->data['title'] = $post->title;
      $this->data['content'] = $post->content;
      $this->data['keywords'] = $post->keywords;
      $this->data['description'] = $post->description;
      if (LANG == 'uz') {
        $status_lang = $post->status_lang_uz;
      }
      if (LANG == 'oz') {
        $status_lang = $post->status_lang_oz;
      }
      if (LANG == 'en') {
        $status_lang = $post->status_lang_en;
      }
      if (LANG == 'ru') {
        $status_lang = $post->status_lang_ru;
      }
      if ($status_lang == 'active') {

        if ($post->group == 'announcement') {
          if (!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id) {
            $this->session->set_userdata(array('ip_view' => $post->id));
            $this->posts->update_views($post->id, $post->views);
          } else {
          }
          $this->data['all_images'] = $this->posts->get_media_files($post->id);
          $this->data['category_id_title'] = 17;
          $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

          $this->data['body'] = 'public/moqqv/announcement/view';
        } else {
          show_404();
        }

        $this->load->view('public/container', $this->data);
      } else {
        go_to(site_url());
      }
    } else {
      show_404();
    }
  }


  public function question()
  {
    $this->data['sel']     = 'question';
    $this->data['links']     = 'question';

    $base_url = base_url() . LANG . '/question/?';
    $total = $this->posts->get_posts_countLang('question', LANG);
    $per_page = 15;
    pagination_pages($base_url, $total, $per_page);

    $this->data['question'] = $this->posts->get_posts_p(array(
      'group' => 'question',
      'status' => 'active',
      'status_lang_' . LANG => 'active',
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['category_id_title'] = 17;

    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_' . LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

    $this->data['body'] = 'public/moqqv/question/index';

    @$this->data['meta'] = getMetaContentId(41, 'title+description+keywords');
    @$this->data['title'] = $this->data['meta']['title'];
    @$this->data['short_content'] = $this->data['meta']['short_content'];
    @$this->data['category_title'] = $this->data['meta']['category_title'];
    @$this->data['content'] = $this->data['meta']['content'];
    @$this->data['keywords'] = $this->data['meta']['keywords'];
    @$this->data['description'] = $this->data['meta']['description'];
    $this->load->view('public/container', $this->data);
  }

  public function speeches()
  {
    $this->data['sel']     = 'speeches';
    $this->data['links']     = 'speeches';

    $base_url = base_url() . LANG . '/speeches/?';
    $total = $this->posts->get_posts_countLang('speeches', LANG);
    $per_page = 10;
    pagination_pages($base_url, $total, $per_page);

    $this->data['news'] = $this->posts->get_posts_p(array(
      'group' => 'speeches',
      'status' => 'active',
      'status_lang_' . LANG => 'active',
      'orderby' => 'created_on',
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['category_id_title'] = 17;

    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'status_lang_' . LANG => 'active', 'limit' => 100, 'media' => 'inactive', 'order' => 'sort_order'));

    $this->data['body'] = 'public/moqqv/speeches/index';

    @$this->data['meta'] = getMetaContentId(42, 'title+description+keywords');
    @$this->data['title'] = $this->data['meta']['title'];
    @$this->data['short_content'] = $this->data['meta']['short_content'];
    @$this->data['category_title'] = $this->data['meta']['category_title'];
    @$this->data['content'] = $this->data['meta']['content'];
    @$this->data['keywords'] = $this->data['meta']['keywords'];
    @$this->data['description'] = $this->data['meta']['description'];
    $this->load->view('public/container', $this->data);
  }

  public function speeches_view($alias)
  {
    $this->data['sel'] = $alias;
    $this->data['group'] = 'speeches';
    $this->data['sel_news'] = 'news';

    $post = $this->posts->get_id_all($alias);
    if ($post->status == 'active') {
      $this->data['post'] = $post;
      $this->data['title_id'] = 42;
      $this->data['links'] = 'speeches';
      $this->data['title'] = $post->title;
      $this->data['content'] = $post->content;
      $this->data['keywords'] = $post->keywords;
      $this->data['description'] = $post->description;
      if (LANG == 'uz') {
        $status_lang = $post->status_lang_uz;
      }
      if (LANG == 'oz') {
        $status_lang = $post->status_lang_oz;
      }
      if (LANG == 'en') {
        $status_lang = $post->status_lang_en;
      }
      if (LANG == 'ru') {
        $status_lang = $post->status_lang_ru;
      }
      if ($status_lang == 'active') {

        if ($post->group == 'speeches') {
          if (!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id) {
            $this->session->set_userdata(array('ip_view' => $post->id));
            $this->posts->update_views($post->id, $post->views);
          } else {
          }
          $this->data['all_images'] = $this->posts->get_media_files($post->id);
          $this->data['category_id_title'] = 17;
          $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

          $this->data['body'] = 'public/moqqv/speeches/view';
        } else {
          show_404();
        }

        $this->load->view('public/container', $this->data);
      } else {
        go_to(site_url());
      }
    } else {
      show_404();
    }
  }


  public function virtual()
  {
    $this->data['sel']     = 'virtual';
    $this->load->model('model_regions');
    $this->load->model('model_city');
    $this->data['lastnews'] = $this->posts->get_posts_p(array('group' => 'news', 'status_lang_' . LANG => 'active', 'status' => 'active', 'orderby' => 'created_on', 'limit' => 3));
    $this->data['region'] = $this->model_regions->regions_get3();
    $this->data['city'] = $this->model_city->city_get2();

    $this->data['sel_user'] = 'user_info';
    $this->data['body'] = 'public/virtual/index';
    @$this->data['title'] = lang('virtual_rec');
    $this->load->view('public/container', $this->data);
  }
  
  
   public function services_view($alias)
  {
    $this->data['sel'] = $alias;
    //$this->data['group'] = 'services';
    //$this->data['sel_news'] = 'news';

    $post = $this->posts->get_id_all($alias);
    if ($post->status == 'active') {
      $this->data['post'] = $post;    
      $this->data['title'] = $post->title;
      $this->data['content'] = $post->content;
      $this->data['keywords'] = $post->keywords;
      $this->data['description'] = $post->description;
      if (LANG == 'uz') {
        $status_lang = $post->status_lang_uz;
      }
      if (LANG == 'oz') {
        $status_lang = $post->status_lang_oz;
      }
      if (LANG == 'en') {
        $status_lang = $post->status_lang_en;
      }
      if (LANG == 'ru') {
        $status_lang = $post->status_lang_ru;
      }
      if ($status_lang == 'active') {

        if ($post->group == 'services1') {
         
         // $this->data['category_id_title'] = 17;
         // $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

          $this->data['body'] = 'public/mf/services/view';
        } else {
          show_404();
        }

        $this->load->view('public/container', $this->data);
      } else {
        go_to(site_url());
      }
    } else {
      show_404();
    }
  }
  
}
?>