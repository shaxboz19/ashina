<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Public_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('posts_model', 'posts');
    $this->load->model('category_model', 'category');
    $this->load->library('pagination');
   $this->load->library('form_validation');
  }

  public function index($title = FALSE, $offset = 0)
  {
    $post_id = 291;
    $this->data['sel'] = 'search';
    $word = $this->input->get('word');
    $word1 = removeTags(addslashes($word));
    $this->data['word_2'] = removeTags($word);


    //$counts = $this->posts->search_param( array('group'=>'product', 'title' => $word1, 'status' => 'active'));   

    $base_url = base_url() . LANG . '/search?';
    $group = array('news','menu','manage');
    $total = $this->posts->count_search_param_all($group, $word1);
    $per_page = 50;
    pagination_pages($base_url, $total, $per_page);
    //echo $total;
    if ($word1) {
      $this->data['results'] = $this->posts->search_param(array('group_array' => $group,  'title' => $word1, 'status' => 'active', 'limit' => $per_page, 'offset' => (int) $this->input->get('page')));
    }

    $this->data['pagination'] = $this->pagination->create_links();

    $this->data['body'] = 'public/pages/search';
    $this->load->view('public/container', $this->data);
  }
}
?>