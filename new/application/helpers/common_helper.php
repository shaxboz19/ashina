<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function uploadAppFiles(&$data)
{
    if($_FILES){
	$ci = &get_instance();
	$ci->load->library('upload');
	$errors = array();
	$uploads = array();
	foreach ($_FILES as $Key => $item) {
		$config['encrypt_name']  = TRUE;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|mp3|mp4|pdf|djvu|doc|docx|xlsx|xl|word|pptx|ppt|csv|xls|zip';
		$config['max_size']    = '5000';
		$structure = './uploads/files/' . $Key;
		if (!file_exists($structure)) {

			if (!mkdir($structure, 0777)) {

				die('Не удалось создать директории...');
			}
		}
		$ci->upload->initialize($config);
		$ci->upload->set_upload_path('./uploads/files/' . $Key . '/');
		if ($ci->upload->do_upload($Key)) {
			$uploadData = $ci->upload->data();
			$data[$Key] = $uploadData['file_name'];
		} else {
			array_push($errors, $ci->upload->display_errors());
		}
	}
	if (count($errors) > 0) {
		return $errors;
	}
    }
}

function fileTypes($file_type){
    switch ($file_type) {
        case ($file_type == 'application/pdf' || $file_type == 'x-download'):
            return 'file-pdf-o';
            break;
        case ($file_type == 'application/msword' || $file_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'):
            return "file-word-o";
            break;
        case ($file_type == 'application/excel' || $file_type == 'application/vnd.ms-excel' || $file_type == 'application/msexcel' || $file_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'):
            return "file-excel-o";
            break;
        case ($file_type == 'image/jpeg' || $file_type == 'image/png'):
            return 'file-image-o';
            break;
        default:
            return 'file-o';
    }
}

function changeType($size, $from, $to){
        $arr = ['B', 'KB', 'MB', 'GB', 'TB'];
        $tSayi = array_search($to, $arr);
        $eSayi = array_search($from, $arr);
        $pow = $eSayi - $tSayi;
        return round($size * pow(1024, $pow), 3) . ' ' . $to;
}

function getYear($group, $type)
{
	$CI =& get_instance();
 // $sql = "SELECT * FROM `media` WHERE `media_type` LIKE '".$id."'";
  $sql = "SELECT  year($type(created_on)) FROM `posts` WHERE `group` = '".$group."' GROUP BY `created_on` LIMIT 1";
  //$sql = "SELECT created_on, max(`created_on`) FROM `posts` GROUP BY `id`";
 // $CI->db->select('created_on');
  //$CI->db->select_min('created_on');
  //$CI->db->where('group', $group);
 /* $CI->db->select_max('created_on');
  $CI->db->where('group', $group);
$query = $CI->db->get('posts')->result();
return $query;*/
  //return $CI->db->get('posts')->result();
  $post = $CI->db->query($sql)->row();
  foreach($post as $key => $value){
    return $value;
  }
 // return $CI->db->query($sql)->row();
}


 function getPostsAll($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts', array('id'=>$id))->row();   	


		if ($post) {
			return $post;
      } 
	}

function get_mediafile_url($media_file_url) {
    $array = array();
    $array = explode( base_url(), $media_file_url);
    return $array[1];
}

function get_resource_url() {

    return base_url().'assets/public/';
}
function authorize($user)
{
	$ci =& get_instance();
	$ci->session->set_userdata('user_id', $user->user_id);
	/*$ci->session->set_userdata('user_type', $user->user_type);
	$ci->session->set_userdata('username', $user->first_name.' '.$user->last_name);
  $ci->session->set_userdata('login', $user->username);
	$ci->session->set_userdata('email', $user->email);
	$ci->session->set_userdata('created',$user->created);
	$ci->session->set_userdata('picture',$user->picture);
	$ci->session->set_userdata('email_verified',$user->email_verified);
	$ci->session->set_userdata('phone_verified',$user->phone_verified);
	$ci->session->set_userdata('phone',$user->phone);
	$ci->session->set_userdata('photo_approved',$user->photo_approved);
  $ci->session->set_userdata('first_name', $user->first_name);
  $ci->session->set_userdata('last_name', $user->last_name);*/
}

  function wishAdd($id, $options, $is_main) {
	            
    	$CI =& get_instance();
		$post = $CI->db->get_where('posts_u', array('product_id'=>$id, 'user_id' => $is_main))->row();   	


		if ($post) {
			return $post->$options;
      } 
	

	}
    
    function getPostsUid($id, $options, $is_main) {
	            
    	$CI =& get_instance();
		$post = $CI->db->get_where('posts_u', array('id'=>$id, 'user_id' => $is_main))->row();   	


		if ($post) {
			return $post->$options;
      } 
	

	}


function authorize_bcrypt($user)
{
	$ci =& get_instance();
	$ci->session->set_userdata('user_id', $user['user_id']);
}

function get_shows()
{
	$show_list = false;
	$ci =& get_instance();

	$ci->db->where('group', 'tv_guide')
	       ->where('time >', date('Y-m-d'))
	       ->order_by('time');

	$shows = $ci->db->get('posts')->result();

	$n=1;
	$show_list = array();
	for ($i=0; $i<count($shows); $i++)
	{
		if ($n==5)
			break;

		if (isset($shows[$i+1]))
		{
			if ( strtotime($shows[$i+1]->time) >= time() )
			{
				$show_list[] = $shows[$i];
				$n++;
			}
		}
		else
			$show_list[] = $shows[$i];

	}

	return $show_list;
}

function to_date($format, $date)
{
	return date($format, strtotime($date));
}

function _t($text, $lang='ru')
{
	$new_text = @unserialize($text);
	//return htmlspecialchars_decode(@$new_text[$lang]);
    return htmlspecialchars_decode(@$new_text[$lang]);
}

function get_settings()
{
	$ci =& get_instance();

	$settings = $ci->db->get_where('settings')->result();

	$i=0;
	foreach ($settings as $setting) {
		$settings[$setting->name] = $settings[$i];

		$data = @unserialize($setting->value);

		if ($setting->value === 'b:0;' || $data !== false)
			$setting->value = $data;

		unset($settings[$i]);
		$i++;
	}

	return $settings;
}

function send_email($name, $data, $to)
{
	$ci =& get_instance();

	$email_data = $ci->db->join('post_meta', 'post_meta.post_id=posts.id','left')
					->get_where('posts', array('alias'=>$name))->result();
	$email = meta_post_1($email_data);
	$message = '';
	foreach($data as $key => $val) {
		$email['content'] = str_replace('{'.$key.'}', $val, $email['content']);
	}
	$ci->load->library('email');

	$ci->email->clear();
	$ci->email->from($email['from']);
	$ci->email->to($to);  
	$ci->email->subject($email['subject']);
	$ci->email->message($email['content']); 

	$ci->email->send();
}

function email($from, $to, $reply, $subject, $message)
{
	$ci =& get_instance();
	
	$config['mailtype'] = 'html';
	$ci->load->library('email', $config);

	$ci->email->clear();
	$ci->email->from($from);
	$ci->email->to($to);  
  $ci->email->reply_to($reply);
	$ci->email->subject($subject);
	$ci->email->message($message); 
	$ci->email->send();
}

function email_respondent($from, $to, $subject, $message)
{
	$ci =& get_instance();
	
	$config['mailtype'] = 'html';
	$ci->load->library('email', $config);

	$ci->email->clear();
	$ci->email->from($from);
	$ci->email->to($to);  
	$ci->email->subject($subject);
	$ci->email->message($message); 
	$ci->email->send();
}

/*function send_email($name, $to, $data=FALSE)
{
	$ci =& get_instance();

	$email = $ci->db->get_where('emails', array('name'=>$name))->row();

	if($data) {
		$message = '';
		foreach($data as $key => $val) {
			$message .= str_replace('{'.$key.'}', $val, $email->content);
		}
	}
	else {
		$message = $email->content;
	}

	email($email->from, $to, $email->subject, $message);
}

function email($from, $from_name, $to, $subject, $message)
{
	$ci =& get_instance();

	$config['mailtype'] = 'html';
	$ci->load->library('email', $config);

	$ci->email->clear();
	$ci->email->from($from, $from_name);
	$ci->email->to($to);
	$ci->email->subject($subject);
	$ci->email->message($message);
	$ci->email->send();
}*/

/*function getMetaContent($name,$type='')
{
	$CI =& get_instance();

	$row = $CI->db->where('status', 'active')
					->where('alias', $name)->get('posts')->row_array();

	if(empty($row))
	{
		$CI->db->set('alias', $name);
		$CI->db->set('group', 'pages');
		$CI->db->set('content', serialize(array(LANG=>"<p>Content ::".$name.". Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at erat et metus dapibus tincidunt at sit amet tortor. Donec hendrerit elit at arcu facilisis egestas. Maecenas tempus, libero eu interdum cursus, est turpis tristique sapien, ut porta mi magna vel velit. Duis in nulla at mauris sodales condimentum in id dui. Sed faucibus tellus id metus consequat tincidunt. Sed fringilla adipiscing nisi, ut scelerisque enim gravida eget. Curabitur quis ligula magna. Nunc risus lacus, fringilla eget dictum vitae, viverra in odio. Integer viverra lectus id odio malesuada porttitor. Praesent eu cursus lorem. Duis facilisis elit pellentesque erat ornare id rhoncus diam venenatis. Cras mattis augue ac dui sodales sodales.</p>")));
		$CI->db->set('title', serialize(array(LANG=>"Сайт::".$name)));
		$CI->db->insert('posts');

		$row = $CI->db->where('alias', $name)->get('posts')->row_array();
	}

    return $row;
}*/

function getMetaContent($name,$type='')
{
	$CI =& get_instance();

	$row = $CI->db->where('status', 'active')
					->where('alias', $name)->get('posts')->row_array();

	if(empty($row))
	{
		$CI->db->set('alias', $name);
		$CI->db->set('group', 'noresult');
		$CI->db->set('content');
		$CI->db->set('title');
		$CI->db->insert('posts');

		$row = $CI->db->where('alias', $name)->get('posts')->row_array();
	}

    return $row;
    
}

function getMetaContent2($name,$type='')
{
	$CI =& get_instance();

	$row = $CI->db->where('status', 'active')
					->where('alias', $name)->get('posts_u')->row_array();

	if(empty($row))
	{
		$CI->db->set('alias', $name);
		$CI->db->set('group', 'noresult');
		$CI->db->set('content');
		$CI->db->set('title');
		$CI->db->insert('posts');

		$row = $CI->db->where('alias', $name)->get('posts_u')->row_array();
	}

    return $row;
}

function getMetaContentId($name,$type='')
{
	$CI =& get_instance();

	$row = $CI->db->where('id', $name)->get('posts')->row_array();

	/*if(empty($row))
	{
		$CI->db->set('id', $name);
		$CI->db->set('group', 'noresult');
		$CI->db->set('content');
		$CI->db->set('title');
		$CI->db->insert('posts');

		$row = $CI->db->where('id', $name)->get('posts')->row_array();
	}*/
    if($row){
      return $row;  
    }

    
}

function getUserInfoId($name,$type='')
{
	$CI =& get_instance();

	$row = $CI->db->where('user_id', $name)->get('users')->row_array();

	/*if(empty($row))
	{
		$CI->db->set('id', $name);
		$CI->db->set('group', 'noresult');
		$CI->db->set('content');
		$CI->db->set('title');
		$CI->db->insert('posts');

		$row = $CI->db->where('id', $name)->get('posts')->row_array();
	}*/

    return $row;
}


function price($o_price, $percent){
  //$proc = sprintf('%01.2F',(float) $percent);
  $p1 = 100 + $percent;
  $p2 = $o_price * $p1;    
 $sum = $p2 * 0.01;
  
    //$sum = $o_price  * ($percent/100);
  return $sum;
}

function getUserNameComments($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users', array('user_id'=>$id))->row();

		if ($post)
			return $post->first_name;
		else
			return show_404();
	}
  
  function getUserOption($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users', array('user_id'=>$id))->row();

		if ($post){
			return $post->$options;
            }
	
	}
    
    function getUserOptionAll($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users', array('user_id'=>$id))->row();

		if ($post){
			return $post;
            }
	
	}
  
  
  function getUserEmailComments($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users', array('user_id'=>$id))->row();

		if ($post)
			return $post->email;
		else
			return show_404();
	}
  
  function getAliasBlog($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts_u', array('id'=>$id))->row();
    	$post_1 = $CI->db->get_where('posts', array('id'=>$id))->row();


		if ($post) {
			return $post->alias;
      } else {
        return $post_1->alias;
      }
	
	}
  
  function getPosts($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts', array('id'=>$id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
    
    function getSiteSettings($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('site', array('id'=>$id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
    
    function getIdOptions($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts', array('options'=>$id))->row(); 
		if ($post) {
			return $post->$options;
      } 
	}
  
  function getPostsCategoryId($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts', array('category_id'=>$id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
  
  function getPostsMedia($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('media', array('post_id'=>$id))->row();   	


		if ($post) {
			return $post->$options;
      } 
	}
  
    function getUsersProfileComments($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('comments', array('post_id'=>$id))->row();
    	


		if ($post) {
			return $post->$options;
      } 
	
	}
  
  function getComments($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('comments', array('comment_id'=>$id))->row();
    	


		if ($post) {
			return $post->$options;
      } 
	
	}
  
  function getTitleBlog($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts_u', array('id'=>$id))->row();

		if ($post)
			return $post->title;
		else
			return show_404();
	}
   function count_category($id)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM posts AS p 
  WHERE p.category_id = '".$id."'
  AND p.status = 'active'";
  return $CI->db->query($sql)->row('count');
}
  function count_comments_active($id)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM comments AS p 
  WHERE p.post_id = '".$id."'
  AND p.status = 'active'";
  return $CI->db->query($sql)->row('count');
}

 function count_button_active($id, $type)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM users_meta AS p 
  WHERE p.post_id = '".$id."'
  AND p.type_u = '".$type."'
  AND p.status_u = '1'";
  return $CI->db->query($sql)->row('count');
}

 function count_user_info_button_active($id, $type)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM users_meta AS p 
  WHERE p.user_id = '".$id."'
  AND p.type_u = '".$type."'
  AND p.status_u = '1'";
  return $CI->db->query($sql)->row('count');
}

// Количество пользователей в друзьях
function count_user_friends($id, $type)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM users_meta AS p 
  WHERE p.user_id_add = '".$id."' 
  AND p.type_u = '".$type."'
  AND p.status_f = 'yes'";
  return $CI->db->query($sql)->row('count');
}
// Количество пользователей в не друзьях
function count_user_no_friends($id, $type)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM users_meta AS p 
  WHERE p.user_id_add = '".$id."' 
  AND p.type_u = '".$type."'
  AND p.status_f = 'no'";
  return $CI->db->query($sql)->row('count');
}

 function getButton($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users_meta', array('user_id'=>$id))->row();
   
    if ($post) {
			return $post->$options;
      } 
	
	}
  
  function getButtonPostId($id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users_meta', array('post_id'=>$id))->row();
    	


		if ($post) {
			return $post->$options;
      } 
	
	}
  
  function getButtonTypeId($id, $options, $type)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users_meta', array('post_id'=>$id, 'type_u' => $type))->row();
    	


		if ($post) {
			return $post->$options;
      } 
	
	}
  
   function getButtonTypeId1($id, $options, $type, $user_id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users_meta', array('post_id'=>$id, 'type_u' => $type, 'user_id' => $user_id))->row();
    	


		if ($post) {
			return $post->$options;
      } 
	
	}  
  
  // Пользователи Добавление в друзья ->
  
  function getUserFriends($id, $options, $type, $user_id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users_meta', array('user_id'=>$id, 'type_u' => $type, 'user_id_add' => $user_id))->row();
    if ($post) {
			return $post->$options;
      } 
	
	}  
  
  
  
  function getUserFriends1($id, $options, $user_id = FALSE)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users_meta', array('user_id'=>$id, 'type_u' => 'friends', 'user_id_add' => $user_id))->row();
    if ($post) {
			return $post->$options;
      } 
	
	}  
  ///////////
  
  function getButtonUsersActiveId($id, $options, $user_id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('users_meta', array('post_id'=>$id, 'user_id' => $user_id))->row();
    	


		if ($post) {
			return $post->$options;
      } 
	
	}
    

  function count_comments_inactive($id)
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM comments AS p 
  WHERE p.post_id = '".$id."'
  AND p.status = 'inactive'";
  return $CI->db->query($sql)->row('count');
}

function count_question_inactive()
{
	$CI =& get_instance();
  $sql = "SELECT
  COUNT(*) AS `count`
  FROM posts_u AS p 
  WHERE p.status = 'inactive'";
  return $CI->db->query($sql)->row('count');
}

function search_count($title, $group) {
	            
    //$this->db->where('group', $group);
    	$CI =& get_instance();
    
    $CI->db->like('title', $title);
    $CI->db->where('status', 'active');
    $CI->db->where_in('group', $group);
    $CI->db->from('posts');
  
    return $CI->db->count_all_results();
	

	}



function getMetaOption($name,$type='')
{
	$CI =& get_instance();

	$row = $CI->db->where('status', 'active')
					->where('option_1', $name)->get('posts')->row_array();

	if(empty($row))
	{
		$CI->db->set('option_1', $name);
		$CI->db->set('group', 'noresult');
		$CI->db->set('content');
		$CI->db->set('title');
    		$CI->db->set('alias');

		$CI->db->insert('posts');

		$row = $CI->db->where('alias', $name)->get('posts')->row_array();
	}

    return $row;
}
function siteSettings($name,$type='')
{
	$CI =& get_instance();

	$row = $CI->db->where('status', 'active')
					->where('alias', $name)->get('site')->row_array();

	/*if(empty($row))
	{
		$CI->db->set('alias', $name);
		$CI->db->set('group', 'pages');
		$CI->db->set('content');
		$CI->db->set('title');
		$CI->db->insert('site');

		$row = $CI->db->where('alias', $name)->get('site')->row_array();
	}*/

    return $row;
}
// -----------------------------------------------------------------------------

function cat_sort($categories,  $selected=false, $childs=true, $level='') {
	foreach ($categories as $category) {
		echo ($selected==$category->category_id)
		?'<option value="'.$category->category_id.'"parent='.$category->parent_id.' selected="selected"> '.$level.' '._t($category->title)
		:'<option value="'.$category->category_id.'"parent='.$category->parent_id.'> '.$level.' '._t($category->title);

		if(isset($category->childs) and $childs==true)
			cat_sort($category->childs, $selected, true, $level.'-');

		echo '</option>';
	}
}

function parent_sort($categories)
{
	if($categories)	{
		foreach($categories as $item)
			$childs[$item->parent_id][] = $item;

		foreach($categories as $item)
			if (isset($childs[$item->category_id]))
				$item->childs = $childs[$item->category_id];

		return $childs[0];
	}
}

//-------------------------------------------------------------------------------

if( ! function_exists('select')) {
	function select($list, $post=FALSE, $multiple=FALSE, $class='') {
		if($multiple)
			echo '<select name="category" id="category" multiple="" class="'.$class.'">';
		else
			echo '<select name="category" id="category" class="'.$class.'">';

		echo '<option value=""> - '.lang('select').' -</option>';
		foreach($list as $ls) {?>
			<option value='<?=$ls->transId?>' <?=($ls->transId==$post)?'selected':''?> ><?=$ls->title?></option>
			<? if(isset($ls->thread)) {
				foreach($ls->thread as $child) { ?>
					<option value='<?=$child->transId?>' <?=($child->transId==$post)?'selected':''?> > -- <?=$child->title?></option>
				<?}
			}
		}
		echo '</select>';
	}
}

//-------------------------------------------------------------------------------

if( ! function_exists('get_img')) {
	function get_img($images, $options=FALSE)
	{
		$images = unserialize($images);

		if($options == 'all') {
			return $images;
		}
		elseif($options == 'rest') {
			unset($images[0]);
			$all_images = array();

			foreach($images as $image) {
				if(!empty($image)) {
					$all_images[] = $image;
				}
			}
			return $all_images;
		}
		else
			return array_shift($images);
	}
}

//-------------------------------------------------------------------------------

if( ! function_exists('get_content_image')) {
	function get_content_image($content)
	{
		preg_match('@src="([^"]+)"@', $content, $match);

		if(isset($match[1])) {
			$arr = explode('/', $match[1]);
			return end($arr);
		}
		else {
			return 'default.png';
		}
	}
}

//-------------------------------------------------------------------------------

function msg() {
	$ci =& get_instance();

	$errors = '';
	if(validation_errors())
		$errors .= validation_errors();

	if($ci->session->flashdata('error'))
		$errors .= $ci->session->flashdata('error');

	if($errors != '') {
		return '<div class="alert alert-error">' . $errors . '</div>';
	}
	else {
		return $errors;
	}
}

//-------------------------------------------------------------------------------

function set_lang_by_title($value, $lang)
{
	$new_value = mb_substr($value, strpos($value, $lang.':') + 3);

	return substr($new_value, 0, strpos($new_value, '/'));
}

function do_upload($folder, $multiple = false)
{
	$config['upload_path'] = './uploads/'.$folder;
        $structure = './uploads/'.$folder;
         if(!file_exists($structure)){ 

                if (!mkdir($structure, 0777)) {

                    die('Не удалось создать директории...');

                }
        }
    
	$config['allowed_types'] = 'gif|jpg|jpeg|png|mp3|doc|docx|pdf';
		$config['max_size']	     = '700000';
		$config['max_width']     = '30000';
		$config['max_height']    = '30000';
	$config['encrypt_name']  = TRUE;

	$ci =& get_instance();
	$ci->load->library('upload', $config);

	if ($multiple)
	{
		if ( ! $files = $ci->upload->do_multi_upload())
			 return array('error' => $ci->upload->display_errors());
		else
			return $files;
	}
	else
	{
		if ( !$ci->upload->do_upload() )
			 return array('error' => $ci->upload->display_errors());
		else
			return $ci->upload->data();
	}
}

function watermark($filename)
{
    $image_cfg = array();
    $image_cfg['image_library'] = 'GD2';
    $image_cfg['source_image'] = './uploads/gallery/'.$filename;
    $image_cfg['wm_overlay_path'] = './assets/public/watermark.png';
    #$image_cfg['new_image'] = './uploads/gallery/mark_'.$filename;
    $image_cfg['wm_type'] = 'overlay';
    $image_cfg['wm_opacity'] = '10';
    $image_cfg['wm_vrt_alignment'] = 'bottom';
    $image_cfg['wm_hor_alignment'] = 'right';
    #$image_cfg['create_thumb'] = TRUE;

    $ci =& get_instance();
    $ci->load->library('image_lib');
    $ci->image_lib->initialize($image_cfg);

    $ci->image_lib->watermark();
    #echo $ci->image_lib->display_errors(); die;
}


function pagination_bootstrap($base_url, $total, $per_page)
{
	$ci =& get_instance();
	$ci->load->library('pagination');

		$config['query_string_segment'] = 'page';
		$config['page_query_string'] = TRUE;
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;

		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

 		$ci->pagination->initialize($config);
}

function get_short_content($str, $limit) {
    $s = mb_substr(strip_tags($str),0,$limit);
    return $s;
}



function get_day_name($timestamp) {
	$date = date('d F Y', $timestamp);
	if($date == date('d F Y')) {
		$date = lang('today');
		return $date;
	} else if($date == date('d F Y', strtotime('tomorrow'))) {
		$date = lang('yesterday');
		return $date;
	}
	else{
		return lang_date($date);
	}
}
function fb_post($params,$user=false)
{
	$ci =& get_instance();
	$ci->load->config('social');
	$config = $ci->config->item('facebook');
	$ci->load->library('facebook', $config);
	
	if($user)
		$user_id = $user->social_id;
	else
		$user_id = $ci->facebook->getUser();

	if ($user_id) 
	{
		try 
		{
			$params = array(
				  "access_token" => $ci->facebook->getAccessToken(), // see: https://developers.facebook.com/docs/facebook-login/access-tokens/
				  "message" => $params['message'],
				  "link" => "http://isite.uz/",
				  "name" => 'Muslim',
				  "caption" => $params['caption'],
				  "description" => $params['description'],
				);
			if($user)
				$params['access_token'] = $user->access_token;
			$ret = $ci->facebook->api('/'.$user_id.'/feed', 'POST', $params);
		} 
		catch (FacebookApiException $e) 
		{
			echo $e->getMessage();
		}
	}
	else
	{
		$login_url = $ci->facebook->getLoginUrl(array('scope' =>'email, user_birthday',
			'redirect_uri' => site_url('reg/fb')));
		redirect($login_url);
	}
}
function lang_date($date)
{
	if(LANG=='ru'){
		$date=explode(" ", $date);
		switch ($date[1]){
		case 'January': $m='Января'; break;
		case 'February': $m='Февраля'; break;
		case 'March': $m='Марта'; break;
		case 'April': $m='Апреля'; break;
		case 'May': $m='Мая'; break;
		case 'June': $m='Июня'; break;
		case 'July': $m='Июля'; break;
		case 'August': $m='Августа'; break;
		case 'September': $m='Сентября'; break;
		case 'October': $m='Октября'; break;
		case 'Novermber': $m='Ноября'; break;
		case 'December': $m='Декабря'; break;
		default: $m = $date[1];
		}
		switch ($date[2]){
		case 'January': $y='Января'; break;
		case 'February': $y='Февраля'; break;
		case 'March': $y='Марта'; break;
		case 'April': $y='Апреля'; break;
		case 'May': $y='Мая'; break;
		case 'June': $y='Июня'; break;
		case 'July': $y='Июля'; break;
		case 'August': $y='Августа'; break;
		case 'September': $y='Сентября'; break;
		case 'October': $y='Октября'; break;
		case 'Novermber': $y='Ноября'; break;
		case 'December': $y='Декабря'; break;
		default: $y = $date[2];
		}
		switch ($date[0]){
		case 'Monday': $d='Понедельник'; break;
		case 'Tuesday': $d='Вторник'; break;
		case 'Wednesday': $d='Среда'; break;
		case 'Thursday': $d='Четверг'; break;
		case 'Friday': $d='Пятница'; break;
		case 'Saturday': $d='Суббота'; break;
		case 'Sunday': $d='Воскресенье'; break;
		default: $d = $date[0];
		}
		return $d.'&nbsp;'.$m.'&nbsp;'.$y;
	}
	else{
		return $date;
	}
	
}

function my_replace_function($match){
    return htmlentities($match[0]);
}

function removeTags($html)
{
	$html = strip_tags($html);
	$html = preg_replace("/&#?[a-z0-9]{2,8};/i","",$html);
	$html = preg_replace_callback("# <(?![/a-z]) | (?<=\s)>(?![a-z]) #xi", 'my_replace_function', $html);
	htmlspecialchars_decode($html);
	return $html;
}

if ( ! function_exists('highlight_phrase'))
{
	function highlight_phrase($str, $phrase, $tag_open = '<strong>', $tag_close = '</strong>')
	{
		if ($str == '')
		{
			return '';
		}

		if ($phrase != '')
		{
			return preg_replace('/('.preg_quote($phrase, '/').')/i', $tag_open."\\1".$tag_close, $str);
		}

		return $str;
	}
}

if ( ! function_exists('word_wrap'))
{
	function word_wrap($str, $charlim = '76')
	{
		// Se the character limit
		if ( ! is_numeric($charlim))
			$charlim = 76;

		// Reduce multiple spaces
		$str = preg_replace("| +|", " ", $str);

		// Standardize newlines
		if (strpos($str, "\r") !== FALSE)
		{
			$str = str_replace(array("\r\n", "\r"), "\n", $str);
		}

		// If the current word is surrounded by {unwrap} tags we'll
		// strip the entire chunk and replace it with a marker.
		$unwrap = array();
		if (preg_match_all("|(\{unwrap\}.+?\{/unwrap\})|s", $str, $matches))
		{
			for ($i = 0; $i < count($matches['0']); $i++)
			{
				$unwrap[] = $matches['1'][$i];
				$str = str_replace($matches['1'][$i], "{{unwrapped".$i."}}", $str);
			}
		}

		// Use PHP's native function to do the initial wordwrap.
		// We set the cut flag to FALSE so that any individual words that are
		// too long get left alone.  In the next step we'll deal with them.
		$str = wordwrap($str, $charlim, "\n", FALSE);

		// Split the string into individual lines of text and cycle through them
		$output = "";
		foreach (explode("\n", $str) as $line)
		{
			// Is the line within the allowed character count?
			// If so we'll join it to the output and continue
			if (strlen($line) <= $charlim)
			{
				$output .= $line."\n";
				continue;
			}

			$temp = '';
			while ((strlen($line)) > $charlim)
			{
				// If the over-length word is a URL we won't wrap it
				if (preg_match("!\[url.+\]|://|wwww.!", $line))
				{
					break;
				}

				// Trim the word down
				$temp .= substr($line, 0, $charlim-1);
				$line = substr($line, $charlim-1);
			}

			// If $temp contains data it means we had to split up an over-length
			// word into smaller chunks so we'll add it back to our current line
			if ($temp != '')
			{
				$output .= $temp."\n".$line;
			}
			else
			{
				$output .= $line;
			}

			$output .= "\n";
		}

		// Put our markers back
		if (count($unwrap) > 0)
		{
			foreach ($unwrap as $key => $val)
			{
				$output = str_replace("{{unwrapped".$key."}}", $val, $output);
			}
		}

		// Remove the unwrap tags
		$output = str_replace(array('{unwrap}', '{/unwrap}'), '', $output);

		return $output;
	}
}