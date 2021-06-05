<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Video extends Public_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->data['sel'] = 'video';
    $this->data['group'] = 'video';

    $this->load->model('posts_model', 'posts');
    $this->load->library('pagination');
  }
  public function index($offset = 0)
  {
        // $this->data['sel'] = 'category';
        $base_url = base_url() . LANG . '/video/?';
        $total = $this->posts->get_posts_countLang('video', LANG); //$this->posts->get_posts_count('video');
        $per_page = 12;
        pagination_pages($base_url, $total, $per_page);
        
        
        // $this->data['category_id_title'] = 146;
        // $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => 146, 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));
        $this->data['category_id_title'] = 17;
        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'media' => 'inactive', 'category_id' => $this->data['category_id_title'], 'status' => 'active', 'limit' => 100, 'status_lang_'.LANG => 'active', 'order' => 'sort_order'));
    
        $this->data['video_all'] = $this->posts->get_posts_p(array('group' => 'video', 'status' => 'active', 'status_lang_'.LANG => 'active', 'limit' => $per_page, 'offset' => (int) $this->input->get('page')));
        
        $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['meta'] = getMetaContentId(46, 'title+description+keywords');
        $this->data['title'] = $this->data['meta']['title'];
        $this->data['content'] = $this->data['meta']['content'];
        $this->data['keywords'] = $this->data['meta']['keywords'];
        $this->data['description'] = $this->data['meta']['description'];
        
        
        $this->data['body'] = 'public/gallery/video';
        $this->load->view('public/container', $this->data);
  }
  /*public function view($alias)
  {
    $this->data['sel'] = $alias;
    $this->data['sel_all_gallery'] = 'news';
    //$this->data['sel'] = $alias;
    //$this->data['sel_news'] = 'news';      
    //$this->data['sel'] = $alias;
    $id = $this->posts->get_id($alias);
    $this->data['view'] = $this->posts->get($id);
    $post_id = $this->posts->get_id($alias);
    $lookbook = $this->posts->get($post_id);
    $this->data['images'] = $this->posts->get_media_category_in($post_id);
    $this->data['post'] = $lookbook;
    $this->data['meta'] = getMetaContent($alias, 'title+description+keywords');
    $this->data['title'] = $this->data['meta']['title'];
    $this->data['content'] = $this->data['meta']['content'];
    $this->data['keywords'] = $this->data['meta']['keywords'];
    $this->data['description'] = $this->data['meta']['description'];

    /*$this->data['meta'] = getMetaContent('templateblog1', 'title+description+keywords');
      $this->data['title_news'] = $this->data['meta']['title'];      */
  /*  if (!$this->session->userdata('ip_view') || $this->session->userdata('ip_view') != $id) {
      //  $this->session->set_userdata(array('ip_view' => $id));
      // $this->posts->update_views($id, $this->data['view']->views);
    } else { }
    $this->data['meta'] = getMetaContentId($post_id, 'title+description+keywords');
    $this->data['title_news'] = $this->data['meta_news']['title'];

    $this->data['category_id_title'] = 84;
    $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => 84, 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

    if ($lookbook->group == 'video') {
      $this->data['body'] = "public/gallery/video_view";
    } else {
      show_404();
    }
    $this->load->view('public/container', $this->data);
    //$this->load->view('public/pages/news_view', $this->data);
  }
}*/
/*
class Video extends Public_Controller 
{	
	public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'video';
        
		$this->load->model('posts_model', 'posts');
	}
	
	public function index() {
		$this->data['video'] = $this->posts->get_posts(array('group'=> 'video', 'status' => 'active'));
	
		$this->data['body'] = 'public/video/index';
		$this->load->view('public/container', $this->data);
	}

	public function view($post_id)
	{
		// Count up views
		$this->db->set('views', 'views + 1', false)
	             ->where('id', $post_id)
			     ->update('posts');	

		$this->data['video'] = $this->posts->get( $post_id );		
		$this->data['medias'] = $this->posts->get_media_files($post_id);

		/*$this->data['meta'] = getMetaContent('product_view', 'title+description+keywords');
		$this->data['title'] = $this->data['meta']['title'];
		$this->data['content'] = $this->data['meta']['content'];
        $this->data['keywords'] = $this->data['meta']['keywords'];
        $this->data['description'] = $this->data['meta']['description'];*/
        
	/*	$this->data['body'] = 'public/products/view';
		$this->load->view('public/container', $this->data);*/
	/*}
}*/
}
?>
