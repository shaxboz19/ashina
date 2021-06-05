<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Путь к файлам отображения
function admin_res_url() {
    return base_url().'assets/admin/';
}
function LangDefault()
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where('lang', array('default'=> '1'))->row();
    	


		if ($post) {
			return $post->alias;
      } 
	
	}
// Пагинация
function pagination_admin($base_url, $total, $per_page)
{
	$ci =& get_instance();
	$ci->load->library('pagination');
		$config['query_string_segment'] = 'page';
		$config['page_query_string'] = TRUE;
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
	$config['full_tag_open'] = '<div style="text-align: center; margin-bottom: 30px;"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
 		$ci->pagination->initialize($config);
}
/*
$srcdir         - каталог с исходными файлами
$dstdir         - конечный каталог
$forced         - принудительная синхронизация
                (перезапись файлов в конечном каталоге)
*/
function copy_folder($srcdir, $dstdir, $forced = false)
{
  $sizetotal = 0;
  if(!is_dir($dstdir)) mkdir($dstdir);
  // открываем исходный каталог
  if($curdir = opendir($srcdir)) {
        // последовательно считываем все
    // имена файлов и каталогов
    while($file = readdir($curdir)) {
      // пропускаем указатель на текущий и
      // предыдущий каталоги
      if($file != '.' && $file != '..') {
        $srcfile = $srcdir . '/' . $file;
        $dstfile = $dstdir . '/' . $file;
        // если текущий элемент - файл
        if(is_file($srcfile)) {
          // если конечный файл существует -
          // проверяем, надо ли его обновлять
          if(is_file($dstfile))
            $ow = filemtime($srcfile) -
                  filemtime($dstfile);
          else $ow = 1;
          // если надо обновлять
          if($ow > 0 || $forced) {
          //  echo "Копирую '$srcfile' в '$dstfile'...";
            // пробуем скопироваь файл
            if(copy($srcfile, $dstfile)) {
              // дополнительная обработка
              // ...
              // устанавливаем время создания конечного
              // файла такое же, как у исходного.
               $num = 0;
              touch($dstfile, filemtime($srcfile)); $num++;
              // устанавливаем права на доступ к
              // файлу "можно всё всем"
              chmod($dstfile, 0777);
              // увеличиваем счётчик скопированного
              // объема на объём последнего файла
              $sizetotal =
                ($sizetotal + filesize($dstfile));
             // echo "Готово \n <br />";
            }
            else {
             // echo "Ошибка: Не могу ".
               //     "скопировать файл '$srcfile'! <br />\n";
            }
          }
        }
      }
    }
    // закрываем ранее открытый каталог
    closedir($curdir);
  }
  //echo 'Копирование завершено!';
  return true;
}
function remove_directory($directory, $empty=FALSE)
{
    if(substr($directory,-1) == '/') {
        $directory = substr($directory,0,-1);
    }
    if(!file_exists($directory) || !is_dir($directory)) {
        return FALSE;
    } elseif(!is_readable($directory)) {
    return FALSE;
    } else {
        $handle = opendir($directory);
        while (FALSE !== ($item = readdir($handle)))
        {
            if($item != '.' && $item != '..') {
                $path = $directory.'/'.$item;
                if(is_dir($path)) {
                    remove_directory($path);
                }else{
                    unlink($path);
                }
            }
        }
        closedir($handle);
        if($empty == FALSE)
        {
            if(!rmdir($directory))
            {
                return FALSE;
            }
        }
    return TRUE;
    }
}
function lang_option($table, $field_id, $id, $options)
	{
	 	$CI =& get_instance();
		$post = $CI->db->get_where($table, array($field_id=>$id))->row();
		if ($post){
			return $post->$options;
            }
	}
function lang_option1($table, $field_id, $id, $options, $like_field, $like) {
$CI =& get_instance();
		$post = $CI->db->get_where($table, array($field_id=>$id, $like_field=> $like))->row();
		if ($post){
			return $post->$options;
            }
	}
?>