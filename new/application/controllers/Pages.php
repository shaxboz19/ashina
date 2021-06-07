<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('posts_model', 'posts');
        $this->load->library('pagination');
    }



    public function getpage($option)
    {
        $this->data['sel']    = $option;
        $post_id              = $this->posts->get_id_option($option);
        if ($post_id) {
            $lookbook             = $this->posts->get($post_id);
            $this->data['images'] = $this->posts->get_media_files($post_id);
            $this->data['post']   = $lookbook;
            $this->data['sel_id'] = $post_id;

            @$this->data['meta'] = getMetaContentId($post_id, 'title+description+keywords');
            $this->data['body'] = 'public/pages/' . $option;
        } else {
            $post_id              = $this->posts->get_id($option);
            $lookbook             = $this->posts->get($post_id);
            $this->data['images'] = $this->posts->get_media_files($post_id);
            $this->data['post']   = $lookbook;
            $this->data['sel_id'] = $post_id;
            @$this->data['meta'] = getMetaContentId($post_id, 'title+description+keywords');
            $this->data['body'] = 'public/pages/static';
        }

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => $lookbook->category_id, 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));
        $this->data['docs'] = $this->posts->get_posts_p(array('group' => 'docs', 'category_id' => $post_id, 'status' => 'active', 'limit' => '500'));

        $this->data['category_id_title'] = $lookbook->category_id;

        $this->data['title']       = $this->data['meta']['title'];
        $this->data['content']     = $this->data['meta']['content'];
        $this->data['keywords']    = $this->data['meta']['keywords'];
        $this->data['description'] = $this->data['meta']['description'];
        $this->load->view('public/container', $this->data);
    }



    public function contacts()
    {
        $this->data['sel'] = 'contacts';
        $this->data['category_id_title'] = 0;

        //  $this->data['helpline'] = $this->posts->get_posts_p(array('group' => 'helpline', 'status' => 'active', 'media' => 'inactive', 'order' => 'ASC', 'limit' => 100, 'order' => 'sort_order'));
        //  $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'category_id' => 4, 'status_lang_'.LANG => 'active', 'media' => 'inactive', 'status' => 'active', 'limit' => 100, 'order' => 'sort_order'));

        @$this->data['meta'] = getMetaContentId(5, 'title+description+keywords');
        @$this->data['title'] = $this->data['meta']['title'];
        @$this->data['category_title'] = $this->data['meta']['category_title'];
        @$this->data['content'] = $this->data['meta']['content'];
        @$this->data['short_content'] = $this->data['meta']['short_content'];
        @$this->data['keywords'] = $this->data['meta']['keywords'];
        @$this->data['description'] = $this->data['meta']['description'];
        // $this->data['google'] = $this->posts->get_posts_p( array('group'=>'google', 'status' => 'active', 'limit' => '1'));
        $this->data['body'] = 'public/pages/contacts';
        $this->load->view('public/container', $this->data);
    }


    public function view_pages($alias = FALSE, $offset = 0)
    {
        $post = $this->posts->get_id_all($alias);
        $post_id              = $post->id;
        $lookbook             = $post;

        /*if ($post->id == 3) {
            $this->data['sel']    = 'publications';
        } else {*/
        $this->data['sel']    = $alias;
        //}

        $base_url = base_url() . LANG . '/menu/' . $post->alias . '/?';

        $total = $this->posts->count_categoryLang('docs', LANG, $post_id);
        $per_page = 50;
        pagination_pages($base_url, $total, $per_page);
        $this->data['docs'] = $this->posts->get_posts_p(array('group' => 'docs', 'status_lang_' . LANG => 'active', 'order' => 'DESC', 'category_id' => $post_id, 'status' => 'active', 'limit' => $per_page, 'offset' => (int)$this->input->get('page')));


        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['body'] = "public/pages/static";


        $this->data['images'] = $this->posts->get_media_files($post_id);
        $this->data['post']   = $lookbook;
        $this->data['sel_id'] = $post_id;

        $this->data['list'] = $this->posts->get_posts_p(array('group' => 'menu', 'status_lang_' . LANG => 'active', 'category_id' => $lookbook->category_id, 'status' => 'active', 'media' => 'inactive', 'limit' => 100, 'order' => 'sort_order'));

        // $m = getPostsAll(getPosts($lookbook->category_id,'id'));
        // $this->data['main_id_title'] = ($m) ? _t($m->title,LANG) : '';
        
        $this->data['category_id_title'] = ($lookbook->category_id > 0) ? $lookbook->category_id : 0;

        //$this->data['meta']        = getMetaContentId($post_id, 'title+description+keywords');
        $this->data['title']       = $post->title;
        $this->data['content']     = $post->content;
        $this->data['keywords']    = $post->keywords;
        $this->data['description'] = $post->description;





        $this->load->view("public/container", $this->data);
    }



    public function sitemap()
    {
        $this->data['sel'] = 'sitemap';
        $this->data['sitemap_menu'] = $this->menu->getMenuSiteMap();

        $this->data['news_search']  = $this->posts->get_posts(array(
            'group' => 'news',
            'status' => 'active'
        ));
        // $this->data['meta'] = getMetaContentId(27, 'title+description+keywords');
        // $this->data['article_title'] = $this->data['meta']['title'];
        // $this->data['menu_sitemap'] = $this->posts->getMenuTrees();
        $this->data['menu_sitemap'] = $this->posts->get_posts(array(
            'group' => 'menu',
            'status' => 'active'
        ));
        $this->data['body']         = "public/pages/sitemap";
        $this->load->view('public/container', $this->data);
    }
}
