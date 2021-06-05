<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['([a-z]{2})/leadership']           = 'mf/leadership';
$route['([a-z]{2})/vacancy']           = 'mf/vacancy';
$route['([a-z]{2})/services/(:any)']           = 'mf/services_view/$2';
/*$route['([a-z]{2})/apparat']           = 'mf/apparat';
$route['([a-z]{2})/regions/(:any)']           = 'mf/regions_view/$2';
$route['([a-z]{2})/regions']           = 'mf/regions';
$route['([a-z]{2})/question']           = 'mf/question';

$route['([a-z]{2})/laws']           = 'mf/documentation/83/laws';
$route['([a-z]{2})/decrees']           = 'mf/documentation/84/decrees';
$route['([a-z]{2})/resolutions']           = 'mf/documentation/85/resolutions';

$route['([a-z]{2})/announcement/(:any)']           = 'mf/announcement_view/$2';
$route['([a-z]{2})/announcement']  = 'mf/announcement';

$route['([a-z]{2})/munosabat/(:any)']           = 'mf/munosabat_view/$2';
$route['([a-z]{2})/munosabat']  = 'mf/munosabat';

$route['([a-z]{2})/speeches/(:any)']           = 'mf/speeches_view/$2';
$route['([a-z]{2})/speeches']  = 'mf/speeches';

$route['([a-z]{2})/zulfiya']  = 'mf/zulfiya';
$route['([a-z]{2})/laureat/(:any)']           = 'mf/laureat_view/$2';
$route['([a-z]{2})/laureat']  = 'mf/laureat';*/
$route['([a-z]{2})/virtual']  = 'mf/virtual';


$route['([a-z]{2})/gallery/(:any)'] = "gallery/view/$2";
$route['([a-z]{2})/gallery'] = "gallery/gallery_one";

$route['([a-z]{2})/video']   = "video/index";



/***/

$route['([a-z]{2})/action']      = 'u/action/feedback_new';
//$route['([a-z]{2})/guestbook']      = 'guestbook/index';
//$route['([a-z]{2})/question']      = 'question/index_new';


//$route['([a-z]{2})/question/(:any)']      = 'question/view/$2';
//$route['([a-z]{2})/about']           = 'about/index';
$route['([a-z]{2})/contacts']           = 'pages/contacts';



$route['([a-z]{2})/menu/(:any)']           = 'pages/view_pages/$2';
//$route['([a-z]{2})/menu/category/(:any)']           = 'menu/index/$2';

//$route['([a-z]{2})/pages/(:any)']           = 'pages/view_pages2/$2';


//$route['([a-z]{2})/forgot_password'] = "reg/forgot_password";
//$route['([a-z]{2})/change_pass/(:any)'] = "reg/change_pass/$2";
//$route['([a-z]{2})/verify'] = "profile/verify_template";
//$route['([a-z]{2})/logout'] = "reg/logout";


// Новости
$route['([a-z]{2})/news/category/(:any)']           = 'news/news_category/$2';
$route['([a-z]{2})/news']           = 'news/news_all';
//$route['([a-z]{2})/news']           = 'news/news_new';
//$route['([a-z]{2})/news']           = 'news/index';
//$route['([a-z]{2})/news/archive']           = 'news/archive';
/*$route['([a-z]{2})/news/category/(:any)']           = 'news/index/$2';
$route['([a-z]{2})/news/archive/(:num)/(:num)'] = "news/news_archive/$2/$3";
$route['([a-z]{2})/news/archive'] = "news/archive";
$route['([a-z]{2})/news/year/(:num)'] = "news/news_year/$2";*/
$route['([a-z]{2})/news/(:any)']           = 'news/view/$2';


$route['([a-z]{2})/sitemap'] = "pages/sitemap";



//$route['([a-z]{2})/faq'] = "faq/blog";
$route['([a-z]{2})/search'] = "search/index";
//$route['([a-z]{2})/search/product'] = "search/product";
//$route['([a-z]{2})/sitemap'] = "pages/sitemap";

$route['([a-z]{2})/get_captcha'] = "home/generate_captcha_1";
//$route['([a-z]{2})/feedback'] = "feedback/index";
$route['([a-z]{2})/rss'] = "rss/index";
//$route['([a-z]{2})/subscribe']       = "subscribe/sub";
//$route['([a-z]{2})/subscribe/activate/(:num)/(:any)']       = "subscribe/activate/$2/$3";
//$route['([a-z]{2})/subscribe/inactivate/(:num)/(:any)']       = "subscribe/inactivate/$2/$3";



$route['^ru/(.+)$'] = "$1";
$route['^en/(.+)$'] = "$1";
$route['^uz/(.+)$'] = "$1";
$route['^oz/(.+)$'] = "$1";

$route['default_controller'] = "home/index";
$route['([a-z]{2})$'] = $route['default_controller'];



$route['admin'] = "admin/main";

//$route['admin'] = "admin/main_lang";

$route['sitemap\.xml'] = "sitemap/index";
$route['404_override'] = 'my404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
