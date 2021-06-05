<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 function getPostsSiAll($id)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('posts_si', array('id'=>$id))->row();   	


		if ($post) {
			return $post;
      } 
	}
 
 function colorSi($num){
    //$roundSi = round($num);
    if (($num >= 0)&&($num <= 4)) return "#38cf71";
    if (($num >= 5)&&($num <= 6)) return "#facf39";
    if (($num >= 7)&&($num <= 13)) return "#f99049";
    if ($num >= 14) return "#e02319";
 }
 
  function colorSiRec($num){
    //$roundSi = round($num);
    if (($num >= 0)&&($num <= 4)) return "content_1";
    if (($num >= 5)&&($num <= 6)) return "content_2";
    if (($num >= 7)&&($num <= 13)) return "content_3";
    if ($num >= 14) return "content_4";
 }
 
  function colorSiCons($num){
    //$roundSi = round($num);
    if (($num >= 0.01)&&($num <= 0.04)) return "#38cf71";
    if (($num >= 0.04)&&($num <= 0.10)) return "#e02319";
   /* if (($num >= 5)&&($num <= 6)) return "#facf39";
    if (($num >= 7)&&($num <= 13)) return "#f99049";*/
    //if ($num >= 14) return "#e02319";
 }
 
 	function getPostsMedia2($id) {
 	  $CI =& get_instance();
		$CI->db->select('posts.*, media.url')
		         ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
		        // ->join('categories', 'posts.category_id = categories.category_id', 'left')
		         ->where('posts.id', $id);

		return $CI->db->get('posts')->row();
	}
    
    function getMonthSi($number, $lang='ru')
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
    
?>