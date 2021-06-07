<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class News extends Public_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->data['sel'] = 'news';
    $this->data['sel_main'] = 'news';
    $this->data['group'] = 'news';
    $this->load->model('posts_model', 'posts');
    $this->load->library('pagination');
  }


  public function tags($alias)
  {
    $this->data['sel'] = $alias;
    $post_id = $this->posts->get_id($alias);
    $this->data['post'] = $this->posts->get($post_id);

    $base_url = base_url() . LANG . '/news/tags/' . $alias . '/?';



    $total = count_tags($post_id, 'tags', 'news');
    $per_page = 12;
    pagination_pages($base_url, $total, $per_page);

    $this->data['news'] = $this->posts->get_posts_p(array(
      'group' => 'news',
      'status' => 'active',
      'tags' => $post_id,
      'limit' => $per_page,
      'offset' => (int) $this->input->get('page')
    ));


    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['meta'] = getMetaContentId($post_id, 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];

    $this->data['body'] = 'public/pages/news_tags';
    $this->load->view('public/container', $this->data);
  }
  // News all //  Category group
  public function news_all($offset = 0)
  {
    $this->data['sel'] = 'news';
    $this->data['pages_sel'] = 'news';
    $base_url = base_url() . LANG . '/news/?';
    $total = $this->posts->get_posts_countLang('news', LANG);
    $per_page = 10;
    pagination_pages($base_url, $total, $per_page);

    $this->data['news'] = $this->posts->get_posts_p(array('group' => 'news', 'status_lang_' . LANG => 'active', 'status' => 'active', 'orderby' => 'created_on', 'limit' => $per_page, 'offset' => (int) $this->input->get('page')));

    $this->data['pagination'] = $this->pagination->create_links();

    $post_id = 26;
    $this->data['category_id_title'] = 19;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status_lang_' . LANG => 'active',  'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));
    @$this->data['meta'] = getMetaContentId($post_id, 'title+description+keywords');
    @$this->data['title'] = $this->data['meta']['title'];
    $this->data['title_news'] = $this->data['meta']['title'];
    @$this->data['content'] = $this->data['meta']['content'];
    @$this->data['keywords'] = $this->data['meta']['keywords'];
    @$this->data['description'] = $this->data['meta']['description'];

    $this->data['body'] = 'public/pages/news';
    $this->load->view('public/container', $this->data);
  }

  public function news_category($alias)
  {
    $this->data['sel']     = 'news_category';

    $post = $this->posts->get_id_all($alias);
    $this->data['sel_menu'] = $post->alias;
    $post_id = $post->id;
    if ($post->status == 'active') {
      if ($post->group == 'news_category') {
        $base_url = base_url() . LANG . '/news/category/' . $post->alias . '/?';
        $total = $this->posts->count_categoryLang('news', LANG, $post_id);
        $per_page = 15;
        pagination_pages($base_url, $total, $per_page);
        $this->data['news'] = $this->posts->get_posts_p(array(
          'group' => 'news',
          'status' => 'active',
          'category_id' => $post_id,
          'status_lang_' . LANG => 'active',
          'limit' => $per_page,
          'offset' => (int) $this->input->get('page')
        ));
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['category_id_title'] = 17;
        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status_lang_' . LANG => 'active',  'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));
        $this->data['title'] = $post->title;
        $this->data['content'] = $post->content;
        $this->data['keywords'] = $post->keywords;
        $this->data['description'] = $post->description;
        $this->data['body'] = 'public/pages/news';
        $this->load->view('public/container', $this->data);
      } else {
        go_to(site_url());
      }
    } else {
      go_to(site_url());
    }
  }

  /* public function news_archive($year = FALSE, $month = FALSE)
  {
    $date1 = $year . '-' . $month . '-01';
    $date2 = $year . '-' . ($month) . '-31';
    $this->data['news_count'] = $this->posts->get_posts_date('category', $date1, $date2);
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url() . LANG . '/news/archive/' . $year . '/' . $month . '/?';
    $config['total_rows'] = count($this->data['news_count']);
    $config['per_page'] = 6;
    $config['anchor_class'] = 'class = "button"';
    $config['first_link'] = FALSE;
    $config['first_tag_open'] = '<li class="button">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = FALSE;
    $config['last_tag_open'] = '<li class="button">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '<i class="icons icon-right-dir"></i>';
    $config['next_tag_open'] = '';
    $config['next_tag_close'] = '';
    $config['prev_link'] = '<i class="icons icon-left-dir"></i>';
    $config['prev_tag_open'] = '';
    $config['prev_tag_close'] = '';
    $config['cur_tag_open'] = '<a class="button active-button">';
    $config['cur_tag_close'] = '</a>';
    $this->pagination->initialize($config);
    $this->data['active_month'] = $year . '_' . $month;
    //$this->output->enable_profiler(TRUE);
    $this->data['news'] = $this->posts->get_posts_date('category', $date1, $date2, false, $config['per_page'], (int) $this->input->get('page'));
    $this->data['meta'] = getMetaContent('templatenews', 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['group'] = 'news';
    $this->data['body'] = 'public/archive/news';
    $this->load->view('public/container', $this->data);
  }*/

  /* public function news_year($year = FALSE)
  {
    $date1 = $year;
    //$date2 = $year.'-'.($month).'-31';
    $this->data['news_count'] = $this->posts->get_posts_year('news', $date1);
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url() . LANG . '/news/year/' . $year . '/?';
    $config['total_rows'] = count($this->data['news_count']);
    $config['per_page'] = 10;

    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div><!--pagination-->';
    $config['first_link'] = '&laquo;';
    $config['first_tag_open'] = '<li class="page">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = '&raquo;';
    $config['last_tag_open'] = '<li class="page">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '&rarr;';
    $config['next_tag_open'] = '<li class="page">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&larr;';
    $config['prev_tag_open'] = '<li class="page">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);
    $this->data['active_year'] = $year;
    //$this->output->enable_profiler(TRUE);
    $this->data['news'] = $this->posts->get_posts_year('news', $date1, false, $config['per_page'], (int) $this->input->get('page'));
    $this->data['meta'] = getMetaContentId(131, 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['group'] = 'news';
    $this->data['body'] = 'public/pages/news_archive';
    $this->load->view('public/container', $this->data);
  }*/

  /* public function archive()
  {
    $date1 = date('Y');
    //$date2 = $year.'-'.($month).'-31';
    $this->data['news_count'] = $this->posts->get_posts_year('news', $date1);
    $config['query_string_segment'] = 'page';
    $config['page_query_string'] = TRUE;
    $config['base_url'] = base_url() . LANG . '/news/archive/?';
    $config['total_rows'] = count($this->data['news_count']);
    $config['per_page'] = 10;

    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div><!--pagination-->';
    $config['first_link'] = '&laquo;';
    $config['first_tag_open'] = '<li class="page">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = '&raquo;';
    $config['last_tag_open'] = '<li class="page">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '&rarr;';
    $config['next_tag_open'] = '<li class="page">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&larr;';
    $config['prev_tag_open'] = '<li class="page">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);
    $this->data['active_year'] = $date1;
    //$this->output->enable_profiler(TRUE);
    $this->data['news'] = $this->posts->get_posts_year('news', $date1, false, $config['per_page'], (int) $this->input->get('page'));
    $this->data['meta'] = getMetaContentId(131, 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];
    $this->data['pagination'] = $this->pagination->create_links();
    $this->data['group'] = 'news';
    $this->data['body'] = 'public/pages/news_archive';
    $this->load->view('public/container', $this->data);
  }*/

  public function view($alias)
  {
    $this->data['sel'] = $alias;
    $this->data['sel_all_gallery'] = 'news';
    //$this->data['sel'] = $alias;
    $this->data['sel_news'] = 'news';
    $this->data['sel_news_lang'] = 'news';
    //$this->data['sel'] = $alias;

    $post = $this->posts->get_id_all($alias);
    if ($post->status == 'active') {
      //$lookbook = $this->posts->get( $post_id ); 
      //$this->data['view'] = $this->posts->get( $post_id );  

      // $this->data['images'] = $this->posts->get_media_category_in( $post->id );

      $this->data['post'] = $post;
      //  $this->data['meta'] = getMetaContentId($post_id, 'title+description+keywords');
      $this->data['title_id'] = 26;
      $this->data['links'] = 'news';
      $this->data['title'] = $post->title;
      $this->data['content'] = $post->content;
      $this->data['keywords'] = $post->keywords;
      $this->data['description'] = $post->description;
      //$this->data['docs'] = $this->posts->get_posts_p( array('group'=>'docs', 'category_id' => $post_id, 'status' => 'active', 'limit' => '50') );

      // $this->data['meta_news'] = getMetaContentId(7, 'title+description+keywords');
      //$this->data['category_id_title'] = $lookbook->category_id;
      // $this->data['list'] = $this->posts->get_posts_p( array('group'=>'menu', 'category_id' => 7, 'status' => 'active', 'limit' => 100, 'order' => 'sort_order') );
      // 
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


      if (@$alias_lang) {
        //go_to(site_url($post->group.'/'.$alias_lang));
      }


      if ($status_lang == 'active') {

        if ($post->group == 'news' || $post->group == 'publications' || $post->group == 'anons' || $post->group == 'announcement' || $post->group == 'oav' || $post->group == 'competitions') {
          if (!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $post->id) {
            $this->session->set_userdata(array('ip_view' => $post->id));
            $this->posts->update_views($post->id, $post->views);
          } else {
          }
          $this->data['lastnews'] = $this->posts->get_posts_p(array('group' => 'news', 'not_like' => $post->id, 'status_lang_' . LANG => 'active', 'status' => 'active', 'orderby' => 'created_on', 'limit' => 3));
          $this->data['all_images'] = $this->posts->get_media_files($post->id);

          $this->data['category_id_title'] = 19;
          $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'status_lang_' . LANG => 'active', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

          $this->data['body'] = 'public/pages/news_view';
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
