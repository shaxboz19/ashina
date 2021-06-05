<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This helper can be used to load a view directly into a view file
 * @param string $viewName
 * @param array $data
 * @author Saidolim\
 * @update OSG
 */
 function load_view($viewName, $data = array()) {

		$CI = &get_instance();
		
		$content = $CI -> load -> view($viewName, $data, true);

		return $content;
	}
function get_menu($menu_id, $class_name = '', $filename = '') {

    $CI = &get_instance();

    // load menu from DB
    $data = array();
    $data['menu_list'] = $CI->model_menu->menu_get_by_group_named($menu_id);
    $data['menu_class'] = $CI->config->item('menu_class');
    if (strlen($class_name) > 0) {
        $data['menu_class'] = $class_name;
    }
    $data['menu_active_class'] = $CI->config->item('menu_active');
    $data['menu_active_sub_class'] = $CI->config->item('menu_active_sub');
    $data['menu_active'] = isset($CI->data['menu_active']) ? $CI->data['menu_active'] : 0;
    $data['menu_active_sub'] = isset($CI->data['menu_active_sub']) ? $CI->data['menu_active_sub'] : 0;

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/menu_' . $filename, $data, true);

    echo $content;
    return $content;
}

function get_menu_linked($link, $class_name = '', $filename = '') {

    $CI = &get_instance();

    //
    $menu_id = $CI->model_menu_group->menu_group_get_by_link($link);

    // load menu from DB
    $data = array();
    $data['menu_list'] = $CI->model_menu->menu_get_by_group_named($menu_id);
    $data['menu_class'] = $CI->config->item('menu_class');
    if (strlen($class_name) > 0) {
        $data['menu_class'] = $class_name;
    }
    $data['menu_active_class'] = $CI->config->item('menu_active');
    $data['menu_active_sub_class'] = $CI->config->item('menu_active_sub');
    $data['menu_active'] = isset($CI->data['menu_active']) ? $CI->data['menu_active'] : 0;
    $data['menu_active_sub'] = isset($CI->data['menu_active_sub']) ? $CI->data['menu_active_sub'] : 0;

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/menu_' . $filename, $data, true);

    echo $content;
    return $content;
}

function get_submenu($menu_url = '', $class_name = '', $filename = '') {

    $CI = &get_instance();

    // Get url
    if (strlen($menu_url) < 1)
        if (isset($CI->data['site_url'])) {
            $menu_url = $CI->data['site_url'];
        }

    // load menu from DB
    $data = array();
    $data['menu_list'] = $CI->model_menu->menu_get_by_group_named($menu_id);
    $data['menu_class'] = $CI->config->item('menu_class');
    if (strlen($class_name) > 0)
        $data['menu_class'] = $class_name;
    $data['menu_active_class'] = $CI->config->item('menu_active');
    $data['menu_active_sub_class'] = $CI->config->item('menu_active_sub');
    $data['menu_active'] = isset($CI->data['menu_active']) ? $CI->data['menu_active'] : 0;
    $data['menu_active_sub'] = isset($CI->data['menu_active_sub']) ? $CI->data['menu_active_sub'] : 0;

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/menu_main' . $filename, $data, true);

    echo $content;
    return $content;
}


function get_submenu_by_id($menu_id, $menu_url = '', $class_name = '', $filename = '') {

    $CI = &get_instance();

    // Get url
    if (strlen($menu_url) < 1)
        if (isset($CI->data['site_url'])) {
            $menu_url = $CI->data['site_url'];
        }

    // load menu from DB
    $data = array();
    $data['menu_list'] = $CI->model_menu->menu_get_by_group_named($menu_id);
    $data['menu_class'] = $CI->config->item('menu_class');
    if (strlen($class_name) > 0)
        $data['menu_class'] = $class_name;
    $data['menu_active_class'] = $CI->config->item('menu_active');
    $data['menu_active_sub_class'] = $CI->config->item('menu_active_sub');
    $data['menu_active'] = isset($CI->data['menu_active']) ? $CI->data['menu_active'] : 0;
    $data['menu_active_sub'] = isset($CI->data['menu_active_sub']) ? $CI->data['menu_active_sub'] : 0;


        require_once APPPATH . 'libraries/Mobile_Detect.php';
        $detect = new Mobile_Detect();
        if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
            $content = $CI->load->view('/mobile/menu_mobile' , $data, true);
        } else {
            $content = $CI->load->view($CI->config->item('default_design') . '/cms/menu_footer', $data, true);
        }

    echo $content;
    return $content;
}

/**
 * This helper can be used to load a view directly into a view file
 * @param string $viewName
 * @author Saidolim
 */
function get_slider($id = 0, $filename = '', $lang = "") {

    $CI = &get_instance();

    // load menu from DB
    $data = array();
    $data['list'] = $CI->model_slider->get_by_lang($lang);
    $data['div_class'] = $CI->config->item('slider_class');
    $data['div_id'] = $CI->config->item('slider_id');

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/slider' . $filename, $data, true);

    echo $content;
    return $content;
}

function show_slider() {

    $CI = &get_instance();
    if ($CI->data['show_slider'])
        echo $CI->load->view($CI->config->item('default_design') . '/slider', '', true);
    return 0;
}

/** show box
 * @author Saidolim
 */
function show_box($name = 'none', $field = '~ empty ~', $defaultClass = '') {

    $CI = &get_instance();

    // load from DB
    $data = $CI->model_boxes->get_by_name($name);
    $data['defaultClass'] = $defaultClass;

    switch ($field) {
//        case 'full' :
//            $content = $CI->load->view($CI->config->item('default_design') . '/cms/boxes_full', $data, true);
//            break;
//
//        case 'full2' :
//            $content = $CI->load->view($CI->config->item('default_design') . '/cms/boxes_full2', $data, true);
//            break;
//
//        case 'caption' :
//            $content = $CI->load->view($CI->config->item('default_design') . '/cms/boxes_caption', $data, true);
//            break;
//
//        case 'content' :
//            $content = $CI->load->view($CI->config->item('default_design') . '/cms/boxes_content', $data, true);
//            break;

        default :
            $content = $CI->load->view($CI->config->item('default_design') . '/cms/boxes_' . $field, $data, true);
            break;
    }

    echo $content;
    return $content;
}

/**
 * @author Saidolim
 */
function index_top() {
    $CI = &get_instance();
    echo $CI->data['index_top'];
    return '';
}

/**
 * @author Saidolim
 */
function index_middle() {
    $CI = &get_instance();
    echo $CI->data['index_middle'];
    return '';
}

function index_middle_mobile() {
    $CI = &get_instance();
    echo $CI->data['index_middle_mobile'];
    return '';
}

/**
 * @author Saidolim
 */
function index_bottom() {
    $CI = &get_instance();
    echo $CI->data['index_bottom'];
    return '';
}

function post_middle() {
    $CI = &get_instance();
    if ($CI->data['post_middle']) {
        $data['data'] = $CI->model_middle_data->get();

        // link larni yasab olishimiz kerak...
        foreach ($data['data'] as $key => $value) {
            $data['data'][$key]['link'] = site_url($value['link']);
        }

        echo $CI->load->view($CI->config->item('default_design') . '/post_middle', $data, true);
    }
    return 0;
}

function set_css_class($css_class = '~ empty ~') {
    $CI = &get_instance();
    if (isset($CI->data[$css_class]))
        echo $CI->data[$css_class];
    return 0;
}

/* show parts of blog page info */

function show_page($field = 'caption', $toScreen = TRUE) {
    $CI = &get_instance();
    if (isset($CI->data['page'][$field]))
        if ($toScreen)
            echo $CI->data['page'][$field];
        else
            return $CI->data['page'][$field];
    return 0;
}

function news($news_id, $count = 10, $filename = 'main', $category = 0, $page = 0) {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['news_list'] = $CI->model_news->news($news_id, $count, $category, $page);
    $data['button_news_more'] = $CI->lang->line('button_news_more');

    $data['news_count'] = $CI->model_news->newsCount($news_id, $category);

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/news_' . $filename, $data, true);

    echo $content;
    return $data['news_count'];
}

function info_get_on_front_page($info_id, $count = 10, $filename = 'main', $category = 0, $page = 0) {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['info_list'] = $CI->model_info->info_get_on_front($info_id, $count, $page);
    $data['button_info_more'] = $CI->lang->line('button_info_more');

    $data['info_count'] = $CI->model_info->infoCount($info_id);

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/info_' . $filename, $data, false);

    echo $content;
    return $data['info_count'];
}

function news_uzb($news_id, $count = 10, $filename = 'main', $page = 0) {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['news_uzb_list'] = $CI->model_news_uzb->news_uzb($news_id, $count, $page);
    $data['button_news_uzb_more'] = $CI->lang->line('button_news_more');

    $data['news_uzb_count'] = $CI->model_news_uzb->news_uzb_Count($news_id);

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/news_' . $filename, $data, true);

    echo $content;
    return $data['news_uzb_count'];
}

function opendata($opendata_id, $count = 10, $filename = 'main', $page = 0) {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['opendata_list'] = $CI->model_opendata->opendata($opendata_id, $count, $page);
    $data['button_opendata_more'] = $CI->lang->line('button_opendata_more');

    $data['opendata_count'] = $CI->model_opendata->opendataCount($opendata_id);

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/opendata_' . $filename, $data, true);

    echo $content;
    return $data['opendata_count'];
}

function vacancy($vacancy_id, $count = 10, $filename = 'main', $page = 0) {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['vacancy_list'] = $CI->model_vacancy->vacancy($vacancy_id, $count, $page);
    $data['button_vacancy_more'] = $CI->lang->line('button_vacancy_more');

    $data['vacancy_count'] = $CI->model_vacancy->vacancyCount($vacancy_id);

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/vacancy_' . $filename, $data, true);

    echo $content;
    return $data['vacancy_count'];
}

function info($info_id, $count = 10, $filename = 'main', $page = 0) {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['info_list'] = $CI->model_info->info($info_id, $count, $page);
    $data['button_info_more'] = $CI->lang->line('button_info_more');

    $data['info_count'] = $CI->model_info->infoCount($info_id);

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/info_' . $filename, $data, true);

    echo $content;
    return $data['info_count'];
}

function info_check_on_front($info_id, $count = 1, $filename = 'main', $page = 0) {

    $CI = &get_instance();
    // load menu from DB
    $data = array();

    $data['info_count'] = $CI->model_info->infoCountFront();

//    $content = $CI->load->view($CI->config->item('default_design') . '/cms/info_' . $filename, $data, true);

    return $data['info_count'];

}

function newsArchive($news_id, $count = 10, $filename = 'main', $category = 0, $page = 0, $dateStart = '2010-01-01', $dateEnd = '2016-01-01') {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['news_list'] = $CI->model_news->newsArchive($news_id, $count, $category, $page, $dateStart, $dateEnd);
    $data['button_news_more'] = $CI->lang->line('button_news_more');

    $data['news_count'] = $CI->model_news->newsArchiveCount($news_id, $category, $dateStart, $dateEnd);

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/news_' . $filename, $data, true);

    echo $content;
    return $data['news_count'];
}

function search($searchText = '/', $page = 0, $count = 10, $filename = 'main') {

    $CI = &get_instance();
    // load menu from DB
    $data = array();
    $data['search_list'] = $CI->model_page->searchText($searchText, $page, $count);
    $data['searchText'] = $searchText;

    $content = $CI->load->view($CI->config->item('default_design') . '/cms/search_' . $filename, $data, true);

    echo $content;
    return $content;
}

function gallery($count, $filename = '1', $imgType = 'gallery') {
    $CI = &get_instance();
    $content = '';
    $content_folder = '';

    $file_list = array();
    $img_path = '/photos/' . $imgType . '/';
    $map = directory_map('.' . $img_path);
//    var_dump($map);

    if (is_array($map)) {
        $cou = 0;
        $data = array();
        //shuffle($map);
//        sort($map);

        foreach ($map as $key => $value) {
            if ($cou < $count) {
                if (is_string($value)) {
                    $data['photo'] = $img_path . $value;
                    $data['images'] = $value;
                    $data['key'] = $value;
                    $content .= $CI->load->view($CI->config->item('default_design') . '/cms/gallery_' . $filename, $data, true);
                    $cou++;
                } elseif (is_array($value)) {
                    if (isset($value[0])) {
                        $data['photo'] = $img_path . $key . '/' . $value[0];
                        $data['key'] = $key;
                        $data['images'] = $value;
                        $data['folder'] = $img_path . $key . '/';
                        $content_folder .= $CI->load->view($CI->config->item('default_design') . '/cms/gallery_2' . $filename, $data, true);
                        $cou++;
                    }
                } else {
//                    var_dump($value);
                }
            }
        }
    }

    return $content_folder . $content;
}

function gallery2($galleryLink = '', $filename = '1', $imgType = 'gallery') {
    $CI = &get_instance();
    $content = '';

    $gallery_list = $CI->model_gallery->getFullByUrl($galleryLink);

    if (is_array($gallery_list)) {
        $cou = 0;
        $data = array();
        $photoList = array();
        $category = 0;
        $content_folder = '';


        foreach ($gallery_list as $key => $value) {
            $data = array();

            if ($category != $value['g_category']) {
                $data['photo'] = $value['g_filename'];
                $data['image'] = $value['g_filename'];
                $data['description'] = $value['g_description'];
                $data['caption'] = $value['gc_caption'];
                $data['categoryId'] = $value['g_category'];
                $content .= $CI->load->view($CI->config->item('default_design') . '/cms/gallery2_' . $filename, $data, true);
                $cou++;
            }

            $category = $value['g_category'];
            $photoList[$category][] = $value;
        }
    }

//    $content .= $CI->load->view($CI->config->item('default_design') . '/cms/gallery2_' . $filename, $data, true);
    $data['photoList'] = $photoList;
    $content_folder .= $CI->load->view($CI->config->item('default_design') . '/cms/gallery22_' . $filename, $data, true);

    return $content . $content_folder;
}

function qabulInfo($name = 'none', $field = '~ empty ~') {

    $CI = &get_instance();

    // load from DB
    $data = $CI->model_qabul->getByName($name);

    if (isset($data['q_' . $field])) {
        return $data['q_' . $field];
    }

    return '';
}

function get_pool($filename = '', $lang = 'ru') {
    $CI = &get_instance();

    // load menu from DB
    $data = array();
    $data['pool_list'] = $CI->model_pool->get_rand($lang);
    $content = $CI->load->view($CI->config->item('default_design') . '/cms/pool_' . $filename, $data, true);

    echo $content;
    return $content;
}

function get_pool_uz($filename = '', $lang = 'uz') {
    $CI = &get_instance();

    // load menu from DB
    $data = array();
    $data['pool_list'] = $CI->model_pool->get_rand($lang);
    $content = $CI->load->view($CI->config->item('default_design') . '/cms/pool_' . $filename, $data, true);

    echo $content;
    return $content;
}

function paging($count = 0, $perpage = 1, $pageActive = 0, $link = '?page=', $neighbors = 3) {
    $CI = &get_instance();
    $paging = $CI->load->view($CI->config->item('default_design') . '/cms/pagination', '', true);
    $pagingActive = $CI->load->view($CI->config->item('default_design') . '/cms/paginationactive', '', true);

    // How many pages will there be
    $pages = ceil($count / $perpage);
    $resultStr = '';

    if ($pages > 1) {

        $pagesArray = array();
        // First page and First page neighboors
        for ($k = 0; $k < $neighbors; $k++) {
            if ($k >= 0 && $k < $pages) {
                $pagesArray[$k] = $k + 1;
            }
        }

        // Last page and neighboors
        for ($k = $pages - 1; $k >= $pages - $neighbors; $k--) {
            if ($k >= 0 && $k < $pages) {
                $pagesArray[$k] = $k + 1;
            }
        }

        // Active page and neighboors
        for ($k = $pageActive - $neighbors; $k <= $pageActive + $neighbors; $k++) {
            if ($k >= 0 && $k < $pages) {
                $pagesArray[$k] = $k + 1;
            }
        }

        asort($pagesArray);

        foreach ($pagesArray as $key => $value) {
            if ($key == $pageActive)
                $resultStr .= sprintf($pagingActive, $link, $key, $value);
            else
                $resultStr .= sprintf($paging, $link, $key, $value);
        }
    }

    return $resultStr;
}

if (!function_exists('mysql_russian_date')) {

    function mysql_russian_date($datestr = '', $lang = 'ru') {
        if ($datestr == '')
            return '';

        // получаем значение даты и времени
        list($day) = explode(' ', $datestr);

        switch ($day) {
            // Если дата совпадает с сегодняшней
            case date('Y-m-d') :
                $result = 'Сегодня';
                $CI = &get_instance();
                if (isset($CI)) {
                    if (isset($CI->data)) {
                        if (isset($CI->data['defaultLang'])) {
                            if ($CI->data['defaultLang'] == 'uz') {
                                $result = 'Bugun';
                            }
                        }
                    }
                }
                break;

            //Если дата совпадает со вчерашней
            case date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"))) :
                $result = 'Вчера';
                $CI = &get_instance();
                if (isset($CI)) {
                    if (isset($CI->data)) {
                        if (isset($CI->data['defaultLang'])) {
                            if ($CI->data['defaultLang'] == 'uz') {
                                $result = 'Kecha';
                            }
                        }
                    }
                } break;

            default : {
                    // Разделяем отображение даты на составляющие
                    list($y, $m, $d) = explode('-', $day);

                    $month_str = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
                    $month_int = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

                    // Замена числового обозначения месяца на словесное (склоненное в падеже)
                    $m = str_replace($month_int, $month_str, $m);
                    // Формирование окончательного результата
                    $result = $d . ' ' . $m . ' ' . $y;
                }
        }
        return $result;
    }

}

// ------------------------------------------------------------------------

if (!function_exists('mysql_russian_datetime')) {

    function mysql_russian_datetime($datestr = '') {
        if ($datestr == '')
            return '';

        // Разбиение строки в 3 части - date, time and AM/PM
        $dt_elements = explode(' ', $datestr);

        // Разбиение даты
        $date_elements = explode('-', $dt_elements[0]);

        // Разбиение времени
        $time_elements = explode(':', $dt_elements[1]);

        // вывод результата
        $result1 = mktime($time_elements[0], $time_elements[1], $time_elements[2], $date_elements[1], $date_elements[2], $date_elements[0]);

        $monthes = array(' ', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        $days = array(' ', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');
        $day = date("j", $result1);
        $month = $monthes[date("n", $result1)];
        $year = date("Y", $result1);
        $hour = date("G", $result1);
        $minute = date("i", $result1);
        $dayofweek = $days[date("N", $result1)];
        $result = $day . ' ' . $month . ' ' . $year . ' в ' . $hour . ':' . $minute;

        return $result;
    }

}

// ------------------------------------------------------------------------



function getVideo($videoId = 0) {
    $CI = &get_instance();
    $data['data'] = $CI->model_video->video_get($videoId);
    if (isset($data['data'][0]))
        $data['data'] = $data['data'][0];

    return $data['data'];
}

function getVideoByCategory($categoryId = 0) {
    $CI = &get_instance();
    $data['data'] = $CI->model_video->getByCategory($categoryId);
    return $data['data'];
}

/**
 * 
 * @param type $lang default language
 * @return type
 */
function getVideoCategoryByLang($lang = 'ru') {
    $CI = &get_instance();
    $data['data'] = $CI->model_video_category->getByLang($lang);

    return $data['data'];
}

function videoViewed($videoId = 0) {
    $CI = &get_instance();
    return $CI->model_video->updateViewed($videoId);
}
