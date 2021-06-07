<?php
Class File extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('posts_model', 'posts');
        $this->load->model('contacts_model');
        $this->load->model('order_model');
        $this->load->library('email');
        $this->data['sel'] = 'feedback';
	}
    public function cert()
    {  
        redirect('http://www.cert.uz');
    }
    public function login()
    {
        $this->load->view('public/paxta/url/form');
    }
    public function bank()
    {
        redirect('http://bank.uz/currency/cb.html');
    }
    public function www()
    {
        redirect('http://');
    }
    public function links($link)
    {
        redirect('http://'.$link);
    }
     public function linkPogoda($link)
    {
        $id = $this->posts->get_id( $link );
        if(getPosts($id, 'group') == 'pogoda'){
            go_to('http://'.getPosts($id, 'option_1'));
        }else{
            go_to(base_url());
        }
        
    }
     public function linkSite($group, $link)
    {
        $id = $this->posts->get_id( $link );
        if(getPosts($id, 'group') == $group){
            go_to('http://'.getPosts($id, 'option_2'));
        }else{
            go_to(base_url());
        }
        
    }
     public function wwwuz($id)
    {
        redirect('http://www.uz/ru/res/visitor/index?id='.$id);
    }
    public function calc_service()
    {
        if(@$_SERVER["HTTP_REFERER"]){
            $g = http_build_query($_GET);
            $url = 'http://213.230.68.49/calc/service.jsp?'.$g;
            $_h = curl_init();
            //curl_setopt($_h, CURLOPT_HEADER, 1);
            curl_setopt($_h, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($_h, CURLOPT_HTTPGET, 1);
            curl_setopt($_h, CURLOPT_URL, $url );
            curl_setopt($_h, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
            curl_setopt($_h, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
            curl_setopt($_h, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($_h, CURLOPT_SSL_VERIFYHOST, FALSE); 
            curl_setopt($_h, CURLOPT_FTP_SSL, CURLFTPSSL_TRY); 
            
            $response = curl_exec($_h);
            echo $response;
            curl_close($_h);
        } else {
            go_to(site_url());
        }
    //var_dump(curl_exec($_h));
    //var_dump(curl_getinfo($_h));
    //var_dump(curl_error($_h));
    //$this->load->view('public/paxta/url/calc_service');

    }
    public function kurs()
    {
        if(@$_SERVER["HTTP_REFERER"]){
            $image = file_get_contents('http://bank.uz/scripts/informercb?small=1&fg=04ab57&bg=FFFFFF');
            echo $image;
        } else {
            go_to(site_url());
        }
    }
	
	public function weatherImage($id)
    {
       if(@$_SERVER["HTTP_REFERER"]){
        if($id == 1){
            $image = file_get_contents(getWeatherImage($id, 'weather_image'));
            echo $image;
            } else{
                go_to(site_url());
            }
        } else {
            go_to(site_url());
       }
    }
}