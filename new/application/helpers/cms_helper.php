<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function count_filesId($id)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM media AS p 
  WHERE p.post_id = '".$id."'";
  return $CI->db->query($sql)->row('count');
}

function countSubMenu($group, $id, $lang){
     $CI =& get_instance();
     	$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.group = '".$group."'
            AND p.status = 'active'
			AND p.status_lang_".$lang." = 'active'
            AND p.category_id = '".$id."'";
            return $CI->db->query($sql)->row('count');
}

function get_mediaLang($id, $lang, $limit = 10000, $offset = 0)
	{
	   $CI =& get_instance();
		$CI->db->where('post_id', $id)
                ->like('lang', $lang)
				 ->order_by('sort_order');

		return $CI->db->get('media', $limit, $offset)->result();
	
}

  function get_polls2($args = null)
	{	
	    $CI =& get_instance();
       $defaults = array(		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
  
       $CI->db->order_by('id', $q['order']);
        $CI->db->where('status', $q['status']);
		return $CI->db->get('polls2', $q['limit'], $q['offset'])->result();
	}

function getAliasSub($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts', array('alias_sub'=>$id))->row();   	


		if ($post) {
			return $post;
      } 
	}

function getPostsResume($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('resume', array('id'=>$id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
function tags_post($tags, $group, $limit){
		if(!$tags==''){
        $CI =& get_instance(); 
        $CI->load->model('posts_model', 'posts');
        $tag = array();
        $tags_id = explode(',',  $tags);
            foreach($tags_id as $id){
                $item = $CI->posts->get_posts_p(array(
                    'group' => $group,
                    'id' => $id,
                    'limit' => $limit,
                    'status' => 'active'));
                array_push($tag, $item);
            }
            
            return $tag;
		}
        
    }
    
       function tags_post_limit($tags, $group, $offset, $limit){
		if(!$tags==''){
        $CI =& get_instance(); 
        $CI->load->model('posts_model', 'posts');
        $tag = array();
        $tags_id = explode(',',  $tags);
            foreach($tags_id as $id){
                $item = $CI->posts->get_posts_p(array(
                    'group' => $group,
                    'id' => $id,
                    //'limit' => $limit,
                    'status' => 'active'));
                array_push($tag, $item);
            }
           
            return  array_slice($tag, $offset, $limit, true);;
		}
        
    }
    
    
    function count_tags($tags, $field, $group) {
	            
    //$this->db->where('group', $group);
    	$CI =& get_instance();
    
    $CI->db->where('find_in_set("'.(int)$tags.'", posts.'.$field.')');
    $CI->db->where('status', 'active');
    $CI->db->where_in('group', $group);
    $CI->db->from('posts');
  
    return $CI->db->count_all_results();
	

	}
    
        function count_tagsLang($tags, $field, $group, $lang) {
	            
    //$this->db->where('group', $group);
    	$CI =& get_instance();
    
    $CI->db->where('find_in_set("'.(int)$tags.'", posts.'.$field.')');
    $CI->db->where('status', 'active');
    $CI->db->where('status_lang_'.$lang, 'active');
    $CI->db->where_in('group', $group);
    $CI->db->from('posts');
  
    return $CI->db->count_all_results();
	

	}
    
    function count_tags_category($tags, $field, $group, $category, $category_field) {
	            
    //$this->db->where('group', $group);
    	$CI =& get_instance();
    
    $CI->db->where('find_in_set("'.(int)$tags.'", posts.'.$field.')');
    $CI->db->where('status', 'active');
    $CI->db->where_in('group', $group);
    $CI->db->where($category_field, $category);
    $CI->db->from('posts');
  
    return $CI->db->count_all_results();
	

	}


function getRegions($id, $options)
{
    $CI =& get_instance();
    $post = $CI->db->get_where('site_regions', array('id_regions' => $id))->row();


    if ($post) {
        return $post->$options;
    }
}

  function phone_tel($number){
    return preg_replace('~\D+~','', $number);
  }

function translit($str)
{
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
}

function count_region_request($title, $row)
{
    $CI =& get_instance();
    $sql = "SELECT
  COUNT(*) AS `count`
  FROM requests AS p 
  WHERE p.$row = '" . $title . "'
  AND  p.file_status ='active'";
    return $CI->db->query($sql)->row('count');
}

function send_to_bot($message)
{
    $CI =& get_instance();
    $a = $CI->config->load('telegram');
    $token = $CI->config->item('telegram_bot_key');
    $chat_id = $CI->config->item('telegram_bot_id');
    $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$message}";
    $_h = curl_init();
    curl_setopt($_h, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($_h, CURLOPT_HTTPGET, 1);
    curl_setopt($_h, CURLOPT_URL, $url);
    curl_setopt($_h, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
    curl_setopt($_h, CURLOPT_DNS_CACHE_TIMEOUT, 2);
    curl_setopt($_h, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($_h, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($_h, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
    $response = curl_exec($_h);
    curl_close($_h);
    if ($response) {
        echo '<p class="success">Спасибо за отправку вашего сообщения!</p>';
        return true;
    } else {
        echo '<p class="fail"><b>Ошибка. Сообщение не отправлено!</b></p>';
    }
}

function getRequests_uploads($folder, $multiple = false)
{
    $config['upload_path'] = './uploads/' . $folder;
    $structure = './uploads/' . $folder;
    if (!file_exists($structure)) {

        if (!mkdir($structure, 0777)) {

            die('Не удалось создать директории...');

        }
    }

    $config['allowed_types'] = 'pdf|jpg|jpeg|zip|doc|docx';
    $config['encrypt_name'] = TRUE;

    $ci =& get_instance();
    $ci->load->library('upload', $config);

    if ($multiple) {
        if (!$files = $ci->upload->do_multi_upload())
            return array('error' => $ci->upload->display_errors());
        else
            return $files;
    } else {
        if (!$ci->upload->do_upload())
            return array('error' => $ci->upload->display_errors());
        else
            return $ci->upload->data();
    }
}

function meta_post($data)
{
    $result = "";
    foreach ($data as $key => $val) {
        if ($val->meta_key)
            $result->{$val->meta_key} = $val->value;
        $result->content = $val->content;
        $result->majburiyatlar = $val->majburiyatlar;
        $result->id = $val->id;
        $result->video_img = $val->video_img;
        $result->title = $val->title;
        $result->alias = $val->alias;
        $result->url = $val->url;
        $result->category = $val->category;
        $result->category_id = $val->category_id;
        $result->status = $val->status;
    }
    return $result;
}

function meta_post_1($data)
{
    $result = "";
    foreach ($data as $key => $val) {
        $result[$val->meta_key] = $val->value;
        //$result['content'] = $val->content;
    }
    return $result;
}

function meta_posts($data)
{
    foreach ($data as $key => $val) {
        $ids[] = $val->id;
    }
    $ci =& get_instance();
    if (isset($ids)) {
        $metas = $ci->db->where_in('post_id', $ids)
            ->get('post_meta')->result();
        foreach ($data as $key => &$val) {
            $i = 0;
            foreach ($metas as $meta) {
                //	if($meta->post_id==$val->id){
                $val->{$meta->meta_key} = $meta->value;
                // $val->title_desc = $metas[$i]->title_desc;
                //$val->{$meta->meta_id} = $meta->meta_id;

                //}
            }
            $i++;
        }
        //var_dump($data);
    }
    return $data;
}

function getMonthName($date, $lang = LANG)
{
    $monthAr = array(
        "uz" => array(
            ('Январь'),
            ('Февраль'),
            ('Март'),
            ('Апрель'),
            ('Май'),
            ('Июнь'),
            ('Июль'),
            ('Август'),
            ('Сентябрь'),
            ('Октябрь'),
            ('Ноябрь'),
            ('Декабрь')
        ),
         "oz" => array(
            ('Yanvar'),
            ('Fevral'),
            ('Mart'),
            ('Aprel'),
            ('May'),
            ('Iyun'),
            ('Iyul'),
            ('Avgust'),
            ('Sentyabr'),
            ('Oktyabr'),
            ('Noyabr'),
            ('Dekabr')
        ),
        "en" => array(
            ('January'),
            ('February'),
            ('March'),
            ('April'),
            ('May'),
            ('June'),
            ('July'),
            ('August'),
            ('September'),
            ('October'),
            ('November'),
            ('December')
        ),
        'ru' => array(
            ('Января'),
            ('Февраля'),
            ('Марта'),
            ('Апреля'),
            ('Мая'),
            ('Июня'),
            ('Июля'),
            ('Августа'),
            ('Сентября'),
            ('Октября'),
            ('Ноября'),
            ('Декабря')
        ),
    );
    $date_arr = date_parse($date);
    $month_number = $date_arr['month'];
    if ($month_number >= 1 && $month_number <= 12)
        return $monthAr[$lang][$month_number - 1];
    else
        return -1;
}

function getMonthNameShort($date, $lang = LANG)
{
    $monthAr = array(
        "uz" => array(
            ('Янв'),
            ('Фев'),
            ('Мар'),
            ('Апр'),
            ('Май'),
            ('Июн'),
            ('Июл'),
            ('Авг'),
            ('Сен'),
            ('Окт'),
            ('Ноя'),
            ('Дек')
        ),
         "oz" => array(
            ('Yan'),
            ('Fev'),
            ('Mar'),
            ('Apr'),
            ('May'),
            ('Iyu'),
            ('Iyu'),
            ('Avg'),
            ('Sen'),
            ('Okt'),
            ('Noy'),
            ('Dek')
        ),
        "en" => array(
            ('Jan'),
            ('Feb'),
            ('Mar'),
            ('Apr'),
            ('May'),
            ('Jun'),
            ('Jul'),
            ('Aug'),
            ('Sept'),
            ('Oct'),
            ('Nov'),
            ('Dec')
        ),
        'ru' => array(
            ('Янв'),
            ('Фев'),
            ('Мар'),
            ('Апр'),
            ('Мая'),
            ('Июн'),
            ('Июл'),
            ('Авг'),
            ('Сен'),
            ('Окт'),
            ('Ноя'),
            ('Дек')
        ),
    );
    $date_arr = date_parse($date);
    $month_number = $date_arr['month'];
    if ($month_number >= 1 && $month_number <= 12)
        return $monthAr[$lang][$month_number - 1];
    else
        return -1;
}

function getMonth($number, $lang = LANG)
{
    $monthAr = array(
        "oz" => array(
            ('Yanvar'),
            ('Fevral'),
            ('Mart'),
            ('Aprel'),
            ('May'),
            ('Iyun'),
            ('Iyul'),
            ('Avgust'),
            ('Sentyabr'),
            ('Oktyabr'),
            ('Noyabr'),
            ('Dekabr')
        ),
          "uz" => array(
            ('Январь'),
            ('Февраль'),
            ('Март'),
            ('Апрель'),
            ('Май'),
            ('Июнь'),
            ('Июль'),
            ('Август'),
            ('Сентябрь'),
            ('Октябрь'),
            ('Ноябрь'),
            ('Декабрь')
        ),
        "en" => array(
            ('January'),
            ('February'),
            ('March'),
            ('April'),
            ('May'),
            ('June'),
            ('July'),
            ('August'),
            ('September'),
            ('October'),
            ('November'),
            ('December')
        ),
        'ru' => array(
            ('Январь'),
            ('Февраль'),
            ('Март'),
            ('Апрель'),
            ('Май'),
            ('Июнь'),
            ('Июль'),
            ('Август'),
            ('Сентябрь'),
            ('Октябрь'),
            ('Ноябрь'),
            ('Декабрь')
        ),
    );
    $month_number = $number;
    if ($month_number >= 1 && $month_number <= 12)
        return $monthAr[$lang][$month_number - 1];
    else
        return -1;
}

/* Post_meta db  */
function getMetaPost($field, $options)
{
    $CI =& get_instance();
    $post = $CI->db->get_where('post_meta', array('meta_id' => $field))->row();


    if ($post) {
        return $post->$options;
    }
}

function mediaNotMain($id, $options, $is_main)
{

    $CI =& get_instance();
    $post = $CI->db->get_where('media', array('post_id' => $id, 'is_main' => $is_main))->row();


    if ($post) {
        return $post->$options;
    }


}


function mediaNotMainPoster($id, $options, $is_main)
{

    $CI =& get_instance();
    $post = $CI->db->get_where('media_poster', array('post_id' => $id, 'is_main' => $is_main))->row();


    if ($post) {
        return $post->$options;
    }


}

function media_poster($id, $limit = 10000, $offset = 0)
{
    $CI =& get_instance();
    $CI->db->where('post_id', $id);
    $CI->db->order_by('sort_order');


    return $this->db->get('media_poster', $limit, $offset)->result();

}

/*function getUserEmail($name,$type='')
{
  $CI =& get_instance();

  $row = $CI->db->where('email', $name)->get('users')->row_array();



  /*if(empty($row))
  {
      $CI->db->set('id', $name);
      $CI->db->set('group', 'noresult');
      $CI->db->set('content');
      $CI->db->set('title');
      $CI->db->insert('posts');

      $row = $CI->db->where('id', $name)->get('posts')->row_array();
  }*/

/*  return $row;
}*/

function getUserEmail($name, $options)
{
    $CI =& get_instance();

    //	$CI->db->where($title, $alias);
    $post = $CI->db->get_where('users', array('email' => $name))->row();


    if ($post) {
        return $post->$options;
    }
}

function count_visitors_log($title, $row)
{
    $CI =& get_instance();
    $sql = "SELECT
  COUNT(*) AS `count`
  FROM visitors_log AS p 
  WHERE p.$row = '" . $title . "'";
    return $CI->db->query($sql)->row('count');
}

// site settings
function getSite_s($id, $options)
{
    $CI =& get_instance();
    $post = $CI->db->get_where('site', array('id' => $id))->row();


    if ($post) {
        return $post->$options;
    }
}

function getCart_u($id, $options)
{
    $CI =& get_instance();
    $post = $CI->db->get_where('cart_u', array('id' => $id))->row();


    if ($post) {
        return $post->$options;
    }
}

function UpdatesignString($id, $data)
{
    $CI =& get_instance();
    $CI->db->where('id', $id);
    $CI->db->update('cart_u', $data);


}

function UpdateStatus($id, $data)
{
    $CI =& get_instance();
    $CI->db->where('id', $id);
    $CI->db->update('cart_u', $data);


}

function getOptionsData($args = null)
{

    $CI =& get_instance();
    $defaults = array(
        'group' => 'video',
        //	'category_id' => array(),
        'category_id' => '',
        'id' => '',
        'limit' => 10000,
        'offset' => 0,
        'order' => 'DESC',
        'not_like' => '',
        'not_like_category' => '',
        'orderby' => 'sort_order',
        'status' => '',
        'status1' => '',
        'lang_status' => '',
        'spec' => '',
        'direction' => '',
        'spec_type' => '',
        'keywords' => '',
        'description' => '',
        'meta_title' => '',
        'category' => '',
        'option' => '',
        'views' => '',
        'sort_order' => '',
        'category_direction' => '',
         'media' => 'active',
         'status_lang_'.@LANG => '',
    );

    $q = array_merge($defaults, $args);

     if($q['media'] == 'active'){
        $CI->db->select('posts.*, media.url')
        ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')   
    
        ->where('posts.group', $q['group'])
        // ->where('posts.category_id', $q['category_id'])
        ->group_by('posts.id');
    }else{
        $CI->db->select('posts.*')        
        
    
        ->where('posts.group', $q['group'])
        // ->where('posts.category_id', $q['category_id'])
        ->group_by('posts.id');
    }

    if (!empty($q['status']))
        $CI->db->where('posts.status', $q['status']);
        if (!empty($q['spec']))
        $CI->db->where('posts.spec', $q['spec']);
    if (!empty($q['lang_status']))
        $CI->db->where_in('posts.lang_status', $q['lang_status']);
    if (!empty($q['status1']))
        $CI->db->where_in('posts.status1', $q['status1']);
        
        if (!empty($q['option']))
        $CI->db->where_in('posts.option', $q['option']);
        
         if(!empty($q['status_lang_'.@LANG]))
            $CI->db->where('posts.status_lang_'.@LANG, $q['status_lang_'.@LANG]);
    /*else
        $this->db->where('posts.status !=', 'draft');*/

    if (!empty($q['category_id']))
        $CI->db->where_in('posts.category_id', $q['category_id']);


    if (!empty($q['not_like_category']))
        $CI->db->not_like('posts.category_id', $q['not_like_category']);

    if (!empty($q['id']))
        $CI->db->where_in('posts.id', $q['id']);

    if (!empty($q['orderby']))
        $CI->db->order_by($q['orderby'], $q['order']);

    if (!empty($q['sort_order']))
        $CI->db->order_by('sort_order', $q['sort_order']);
    if (!empty($q['not_like']))
        $CI->db->not_like('posts.id', $q['not_like']);


    return $CI->db->get('posts', $q['limit'], $q['offset'])->result();
}

function get_media_files_in($id, $limit = 10000, $offset = 0)
{
    $CI =& get_instance();
    $CI->db->where('post_id', $id)
        ->order_by('sort_order');

    return $CI->db->get('media', $limit, $offset)->result();

}

function removeAll($st)
{
    return str_replace(array("'", "\""), "", $st);
}

function calculate_distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

function count_files($id)
{
    $CI =& get_instance();
    $sql = "SELECT * FROM `media` WHERE `media_type` LIKE '" . $id . "'";
    return $CI->db->query($sql)->result();
}

function getWeatherImage($id, $options)
{
    $CI =& get_instance();
    $post = $CI->db->get_where('weather', array('id' => $id))->row();


    if ($post) {
        return $post->$options;
    }
}

// Пагинация
function pagination_pages($base_url, $total, $per_page)
{
    $ci =& get_instance();
    $ci->load->library('pagination');
    $config['query_string_segment'] = 'page';
   $config['page_query_string'] = TRUE;
     $config['reuse_query_string'] = TRUE;
    $config['base_url'] = $base_url;
    $config['total_rows'] = $total;
    $config['per_page'] = $per_page;
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
    $ci->pagination->initialize($config);
}

function ToursDate($datestr = '', $lang = false)
{
    if ($datestr == '')
        return '';

    // получаем значение даты и времени
    list($day) = explode(' ', $datestr);

    switch ($day) {
        // Если дата совпадает с сегодняшней
        // case date('Y-m-d'):
        // $result = 'Сегодня';
        //   break;

        //Если дата совпадает со вчерашней
        // case date( 'Y-m-d', mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")) ):
        //   $result = 'Вчера';
        //  break;

        default: {
            // Разделяем отображение даты на составляющие
            list($y, $m, $d) = explode('-', $day);

            if ($lang == 'ru') {
                $month_str = array(
                    'Января', 'Февраля', 'Марта',
                    'Апреля', 'Мая', 'Июня',
                    'Июля', 'Августа', 'Сентября',
                    'Октября', 'Ноября', 'Декабря'
                );
            } elseif ($lang == 'en') {
                $month_str = array(
                    'Января', 'Февраля', 'Марта',
                    'Апреля', 'Мая', 'Июня',
                    'Июля', 'Августа', 'Сентября',
                    'Октября', 'Ноября', 'Декабря'
                );
            } elseif ($lang == 'uz') {
                $month_str = array(
                    'Января', 'Февраля', 'Марта',
                    'Апреля', 'Мая', 'Июня',
                    'Июля', 'Августа', 'Сентября',
                    'Октября', 'Ноября', 'Декабря'
                );
            } else {
                $month_str = array(
                    'Января', 'Февраля', 'Марта',
                    'Апреля', 'Мая', 'Июня',
                    'Июля', 'Августа', 'Сентября',
                    'Октября', 'Ноября', 'Декабря'
                );
            }

            $month_int = array(
                '01', '02', '03',
                '04', '05', '06',
                '07', '08', '09',
                '10', '11', '12'
            );

            // Замена числового обозначения месяца на словесное (склоненное в падеже)
            $m = str_replace($month_int, $month_str, $m);
            // Формирование окончательного результата
            $result = $d . ' ' . $m . ', ' . $y;
        }
    }
    return $result;


}

function nameTitleId($title, $group)
{
    $CI =& get_instance();
    $sql = "SELECT * FROM `posts` WHERE `group` LIKE '$group' AND `title` LIKE '%$title%' ORDER BY `id` DESC LIMIT 1";
    $post = $CI->db->query($sql)->row();
    foreach ($post as $key => $value) {
        return $value;
    }

}

  function getCityInfo($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('site_city', array('id_city'=>$id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
    
         function getRegionInfo($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('site_regions', array('id_regions'=>$id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
 function getOptionsResume($args = null)
{

    $CI =& get_instance();
    $defaults = array(
        'group' => 'video',
        //	'category_id' => array(),
        'category_id' => '',
        'id' => '',
        'limit' => 10000,
        'offset' => 0,
        'order' => 'DESC',
        'not_like' => '',
        'not_like_category' => '',
        'orderby' => 'sort_order',
        'status' => '',
        'status1' => '',
        'lang_status' => '',
        'spec' => '',
        'direction' => '',
        'spec_type' => '',
        'keywords' => '',
        'description' => '',
        'meta_title' => '',
        'category' => '',
        'option' => '',
        'views' => '',
        'sort_order' => '',
        'category_direction' => '',
         'media' => 'active',
    );

    $q = array_merge($defaults, $args);

    
        $CI->db->select('resume.*')        
        
    
        ->where('resume.group', $q['group'])
        // ->where('posts.category_id', $q['category_id'])
        ->group_by('resume.id');
    

    if (!empty($q['status']))
        $CI->db->where('resume.status', $q['status']);
        if (!empty($q['spec']))
        $CI->db->where('resume.spec', $q['spec']);
  
    if (!empty($q['category_id']))
        $CI->db->where_in('resume.category_id', $q['category_id']);


    if (!empty($q['not_like_category']))
        $CI->db->not_like('resume.category_id', $q['not_like_category']);

    if (!empty($q['id']))
        $CI->db->where_in('resume.id', $q['id']);

    if (!empty($q['orderby']))
        $CI->db->order_by($q['orderby'], $q['order']);

    if (!empty($q['sort_order']))
        $CI->db->order_by('sort_order', $q['sort_order']);
    if (!empty($q['not_like']))
        $CI->db->not_like('resume.id', $q['not_like']);


    return $CI->db->get('resume', $q['limit'], $q['offset'])->result();
}    
?>