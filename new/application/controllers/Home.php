<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['sel'] = 'home';

        // $this->load->library('form_validation');
        // $this->load->model('posts_model', 'posts');
        //  $this->load->model("faq_model", "faq");
        //$this->load->model('users_meta_model', 'users_meta');
        // $this->load->model('comments_model', 'comments');
        //  $this->load->model('fuqaro_murojaat_model');
        //$this->load->model('guestbook_model');
        $this->load->library('pagination');
    }
    public function weather()
    {
        /* $output = $this->data['output'] = json_decode(file_get_contents("http://meteo.uz/api/v2/current-weather_ru.json"), true);
        $this->load->model('weather');
        foreach ($output as $item => $key) {
            $id_city = $key['city']['id'];
            $datetime = $key['datetime'];
            $day_time = $key['time_of_day'];
            $weather_image = "http://meteo.uz/img/weather-icons/wi_" . $key['weather_code'] . "_" . $day_time . ".png";
            $temperature = $key['air_t'];
            $this->weather->update_weather_data($id_city, $weather_image, $datetime, $temperature, $day_time);
        }*/
    }



    public function index()
    {
        // $this->data['news_slider'] = $this->posts->get_posts_p(array('group' => 'news', 'status_lang_' . LANG => 'active', 'option' => 'yes',  'orderby' => 'created_on', 'status' => 'active', 'limit' => '4'));
        // $this->data['news_slider_category'] = $this->posts->get_posts_p(array('group' => 'news_category', 'media' => 'inactive'));
        // $this->data['counsel_category'] = $this->posts->get_posts_p(array('group' => 'counsel_category', 'media' => 'inactive'));

        // $this->data['news'] = $this->posts->get_posts_p(array('group' => 'news', 'status_lang_' . LANG => 'active', 'option' => 'no',  'orderby' => 'created_on', 'status' => 'active', 'limit' => '3'));

        $this->data['services'] = $this->posts->get_posts_p(array('group' => 'services', 'status_lang_' . LANG => 'active', 'status' => 'active', 'limit' => '10'));

        // $this->data['services1'] = $this->posts->get_posts_p(array('group' => 'services1', 'status_lang_' . LANG => 'active', 'order' => 'ASC', 'media' => 'inactive', 'status' => 'active', 'limit' => '6'));



        // $this->data['news_category'] = $this->posts->get_posts_p(array('group' => 'news_category', 'option' => 'yes', 'limit' => '6', 'order' => 'ASC', 'status' => 'active', 'media' => 'inactive'));


        $this->data['usefuls'] = $this->posts->get_posts_p(array('group' => 'usefuls', 'status_lang_' . LANG => 'active', 'order' => 'ASC', 'status' => 'active', 'limit' => '50'));
        $this->data['specialization'] = $this->posts->get_posts_p(array('group' => 'specialization', 'status_lang_' . LANG => 'active', 'order' => 'ASC', 'status' => 'active', 'limit' => '50'));

        $this->data['statistics'] = $this->posts->get_posts_p(array('group' => 'statistics', 'status_lang_' . LANG => 'active',  'order' => 'ASC', 'media' => 'inactive', 'status' => 'active', 'limit' => '4'));
        $this->data['stages_work'] = $this->posts->get_posts_p(array('group' => 'stages_work', 'status_lang_' . LANG => 'active',  'order' => 'ASC', 'media' => 'inactive', 'status' => 'active', 'limit' => '5'));


        //  $this->data['inspections'] = $this->posts->get_posts_p(array('group' => 'regions', 'order' => 'ASC', 'status' => 'active', 'limit' => '14'));

        $this->data['body'] = 'public/pages/home';
        $this->load->view('public/container', $this->data);
    }


    /*  public function _captcha_check($str)
    {
        if ($str !== $this->session->userdata('cap')) {
            $this->form_validation->set_message('_captcha_check', 'Invalid %s');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function _message_check($value)
    {
        if (mb_strtolower(lang('message')) == mb_strtolower($value)) {
            $this->form_validation->set_message('_message_check', lang('required'));
            return FALSE;
        } else
            return TRUE;
    }*/


    public function generate_captcha_1()
    {
        $this->load->helper('captcha');
        /*$vals= array(
            'word'       => random_string('numeric', 5),
            'img_path'   => './uploads/captcha/',
            'img_url'    => base_url().'uploads/captcha/',
            'img_width'  => '210',
            'font_path'  => './system/fonts/arial.ttf',
            'font_size'  => '25px',
            'img_height' => '35',
            'expiration' => 7200
        );
        $this->data['cap'] = create_captcha($vals);*/

        $vals = array(
            'word'       => random_string('numeric', 5),
            'img_path'   => './uploads/captcha/',
            'img_url'    => base_url() . 'uploads/captcha/',
            'img_width'  => '175',
            'font_path'  => './system/fonts/arial.ttf',
            'font_size'  => '25px',
            'img_height' => '35',
            'expiration' => 7200
        );
        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']
        );
        $this->session->set_userdata($data);



        $this->session->set_userdata($data);
        $return['status'] = 'OK';
        $return['captcha'] = $cap;

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($return));
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
