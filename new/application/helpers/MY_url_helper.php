<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Furqat U.
 * @copyright 2012
 **/

function alias($str)
{
    $str = str_replace('а', 'a', $str);
	$str = str_replace('б', 'b', $str);
	$str = str_replace('в', 'v', $str);
	$str = str_replace('г', 'g', $str);
	$str = str_replace('д', 'd', $str);
	$str = str_replace('е', 'e', $str);
	$str = str_replace('ё', 'yo', $str);
	$str = str_replace('ж', 'zh', $str);
	$str = str_replace('з', 'z', $str);
	$str = str_replace('и', 'i', $str);
	$str = str_replace('й', 'i', $str);
	$str = str_replace('к', 'k', $str);
	$str = str_replace('л', 'l', $str);
	$str = str_replace('м', 'm', $str);
	$str = str_replace('н', 'n', $str);
	$str = str_replace('о', 'o', $str);
	$str = str_replace('п', 'p', $str);
	$str = str_replace('р', 'r', $str);
	$str = str_replace('с', 's', $str);
	$str = str_replace('т', 't', $str);
	$str = str_replace('у', 'u', $str);
	$str = str_replace('ф', 'f', $str);
	$str = str_replace('х', 'kh', $str);
	$str = str_replace('ц', 'c', $str);
	$str = str_replace('ч', 'ch', $str);
	$str = str_replace('ш', 'sh', $str);
	$str = str_replace('щ', 'sh', $str);
	$str = str_replace('ъ', "`", $str);
	$str = str_replace('ь', '`', $str);
	$str = str_replace('ы', 'y', $str);
	$str = str_replace('э', 'e', $str);
	$str = str_replace('ю', 'yu', $str);
	$str = str_replace('я', 'ya', $str);
	
	$str = str_replace('А', 'A', $str);
	$str = str_replace('Б', 'B', $str);
	$str = str_replace('В', 'V', $str);
	$str = str_replace('Г', 'G', $str);
	$str = str_replace('Д', 'D', $str);
	$str = str_replace('Е', 'E', $str);
	$str = str_replace('Ё', 'YO', $str);
	$str = str_replace('Ж', 'ZH', $str);
	$str = str_replace('З', 'Z', $str);
	$str = str_replace('И', 'I', $str);
	$str = str_replace('Й', 'I', $str);
	$str = str_replace('К', 'K', $str);
	$str = str_replace('Л', 'L', $str);
	$str = str_replace('М', 'M', $str);
	$str = str_replace('Н', 'N', $str);
	$str = str_replace('О', 'O', $str);
	$str = str_replace('П', 'P', $str);
	$str = str_replace('Р', 'R', $str);
	$str = str_replace('С', 'S', $str);
	$str = str_replace('Т', 'T', $str);
	$str = str_replace('У', 'U', $str);
	$str = str_replace('Ф', 'F', $str);
	$str = str_replace('Х', 'Kh', $str);
	$str = str_replace('Ц', 'C', $str);
	$str = str_replace('Ч', 'Ch', $str);
	$str = str_replace('Ш', 'Sh', $str);
	$str = str_replace('Щ', 'Sh', $str);
	$str = str_replace('Ъ', '`', $str);
	$str = str_replace('Ь', '`', $str);
	$str = str_replace('Ы', 'Y', $str);
	$str = str_replace('Э', 'E', $str);
	$str = str_replace('Ю', 'Yu', $str);
	$str = str_replace('Я', 'Ya', $str);
    
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    return $clean;
}       

function unalias($str)
{
    $str = str_replace('And', '&', ucwords(str_replace('-', ' ', $str)));
    return $str;
}  

function urlget($param, $value)
{
    $ci =& get_instance();
 
    $url = base_url().$ci->uri->uri_string();

    $query_str = parse_str($_SERVER['QUERY_STRING'], $query_arr);    
    $query_arr[$param] = $value;
    
    $new_query_str = http_build_query($query_arr);
    
    if(!strstr($url, '?'))
        $url = $url.'/?'.$new_query_str;
    else
        $url = $url.'&'.$new_query_str;
    
    //remove page from url
    $url = preg_replace('/page=([0-9])&/', '', $url);

    return $url;
}

/**
 * Function return to the given url. Default is back
 *	@param string
 **/
function go_to($url=FALSE)
{
	if($url) 
		$to = $url;
	else
		$to = $_SERVER['HTTP_REFERER'];

	redirect($to);
}

function current_url($language=false)
{
	$ci =& get_instance();

	$segments = $ci->uri->segment_array();

	if ($language)
	{
		$segments[1] = $language;

		return base_url($segments);
	}
}