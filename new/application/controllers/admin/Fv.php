<?php


class Fv extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = '';		
$this->load->model('model_city');
 $this->load->model('model_regions');
  $this->load->model('fuqaro_murojaat_model');
  $this->load->library('pagination');
  $this->lang->load('sozlar', 'russian');
  
		 
	} 
    function fuqaro_murojaat($id=2)
    {
        $this->data['sel'] = 'fuqaro_murojaat';	
        $config = array();
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url().'/admin/fv/fuqaro_murojaat/'.$id.'/?';
        if($id){
        $config['total_rows'] = $this->fuqaro_murojaat_model->count_fm_kimga_id($id);
        }else{
                  $config['total_rows'] = $this->fuqaro_murojaat_model->all_count_fm();  
        }
        $config['per_page'] = 100;
        
        $config['full_tag_open'] = '<div class="pagination"><ul>';
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
        $this->pagination->initialize($config);
        if($id){
            $this->data['cfuqaro_murojaat_list'] = $this->fuqaro_murojaat_model->get_all(array('limit' => $config['per_page'], 'offset' => (int)$this->input->get('page'), 'fm_kimga_id' => $id, 'order' => 'DESC'));   
        }else{
        $this->data['cfuqaro_murojaat_list'] = $this->fuqaro_murojaat_model->get_all(array('limit' => $config['per_page'], 'offset' => (int)$this->input->get('page'), 'order' => 'DESC'));
        }
        $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['cfm_statistics'] = $this->fuqaro_murojaat_model->get_statistics();

  
            
        $this->data['body'] = 'admin/fv/fuqaro_murojaat/index';
	    $this->load->view('admin/index', $this->data);
    }
     function fuqaro_murojaat_action($action = 'none', $id = -1)
    {
$this->data['cregions_list'] = $this->model_regions->regions_get();
       
        $this->data['ccity_list'] = $this->model_city->city_get();
           switch ($action) {
            case 'edit' :
                $this->data['fuqaro_murojaat_edit'] = $this->fuqaro_murojaat_model->fuqaro_murojaat_get($id);
                $this->data['id_cfuqaro_murojaat'] = $id;

                break;

            case 'save' :
                $post_data = $this->_getPostData('cfuqaro_murojaat');
                $rand_dec = md5($post_data['code']);
                /*if ($id == -1) {
                    $this->fuqaro_murojaat_model->fuqaro_murojaat_save($post_data['ism'], $post_data['fam'], $post_data['email'], $post_data['telefon'], $post_data['mtext'], $post_data['kimga_id'], $post_data['murojaat_status'], $post_data['natija_text'], $post_data['zapas'], $post_data['region'], $post_data['city'], $post_data['pol'], $post_data['ustatus'], $post_data['allow'], $post_data['file'], $post_data['byear'], $post_data['aptype'], $rand_dec);
                } else {*/
                    $this->fuqaro_murojaat_model->update_some2($id, $post_data['murojaat_status']);
                    // , $post_data['natija_text'], $post_data['zapas'], $this->user_profile['user_id']

                    $stat = '';
                    if($post_data['murojaat_status'] == 'A') {
                        $stat = 'Принято';
                    } else  if($post_data['murojaat_status'] == 'W') {
                        $stat = 'Поступило';
                    } else  if($post_data['murojaat_status'] == 'C') {
                        $stat = 'Отказано';
                    } else  if($post_data['murojaat_status'] == 'S') {
                        $stat = 'Выполнено';
                    }

                    $to = $post_data['email'];
                    $subject = 'Изменение статуса. Виртуальная приёмная МЧС';

                    $message = 'Статус Вашего обращения № ' . $id . ' изменился на ' . $stat . '.';

                    $headers = "From: no-reply@mchs.uz \r\n";
                    $headers .= "Reply-To: no-reply@mchs.uz \r\n";
                    $headers .= "CC: no-reply@mchs.uz\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                   // mail($to, $subject, $message, $headers);
               // }

                //redirect($this->controller . '/fuqaro_murojaat/add');
                go_to("admin/fv/fuqaro_murojaat/".$post_data['kimga_id']);
                break;
        }

       
        
        $this->data['body'] = 'admin/fv/fuqaro_murojaat/save';
	    $this->load->view('admin/index', $this->data);
    }

 function regions_action($action = 'none', $id = -1)
    {
     

        switch ($action) {
            case 'add' :
               $this->data['body'] = 'admin/fv/regions/view_regions_add';
                break;

            case 'edit' :
                $this->data['regions_edit'] = $this->model_regions->regions_get($id);
                $this->data['id_cregions'] = $id;

                $this->data['body'] = 'admin/fv/regions/view_regions_add';
                break;

            case 'save' :
                $post_data = $this->_getPostData('cregions');
                if ($id == -1)
                    $this->model_regions->regions_save($post_data['name'], $post_data['title'], $post_data['visible'], $post_data['child']);
                else
                    $this->model_regions->regions_update($id, $post_data['name'], $post_data['title'], $post_data['visible'], $post_data['child']);

                go_to("admin/fv/regions");
                break;

            case 'delete' :
                if ($id != -1)
                    $this->model_regions->regions_delete($id);
                go_to("admin/fv/regions");
                break;

            default :
                $this->data['body'] = 'admin/fv/regions/view_regions_add';
                break;
        }

    
	    $this->load->view('admin/index', $this->data);
    }

    function city_action($action = 'none', $id = -1)
    {
              $this->data['sel'] = 'city';
              $this->data['cregions_list'] = $this->model_regions->regions_get();
        switch ($action) {
            case 'add' :
                 $this->data['body'] = 'admin/fv/city/view_city_add';
                break;

            case 'edit' :
                $this->data['city_edit'] = $this->model_city->city_get($id);
                $this->data['id_ccity'] = $id;

                 $this->data['body'] = 'admin/fv/city/view_city_add';
                break;

            case 'save' :
                $post_data = $this->_getPostData('ccity');
                if ($id == -1)
                    $this->model_city->city_save($post_data['name'], $post_data['title'], $post_data['visible'], $post_data['parent'], $post_data['region_id']);
                else
                    $this->model_city->city_update($id, $post_data['name'], $post_data['title'], $post_data['visible'], $post_data['parent'], $post_data['region_id']);

                
                 go_to("admin/fv/city");
                break;

            case 'delete' :
                if ($id != -1)
                    $this->model_city->city_delete($id);
                go_to("admin/fv/city");
                break;

            default :
                $this->data['body'] = 'admin/fv/city/view_city_add';
                break;
        }

      
	    $this->load->view('admin/index', $this->data);
    }
    
    function city()
    {
        $this->data['sel'] = 'city';
        
        $this->data['ccity_list'] = $this->model_city->city_get();
        $this->data['ccity_view'] = 1;
    

       $this->data['body'] = 'admin/fv/city/view_city_list';
	    $this->load->view('admin/index', $this->data);
    }
    
     function regions(){
          $this->data['sel'] = 'regions1';
        $this->data['cregions_list'] = $this->model_regions->regions_get();
        $this->data['cregions_view'] = 1;
        
         $this->data['body'] = 'admin/fv/regions/view_regions_list';
	    $this->load->view('admin/index', $this->data);
    }
    
        function _getPostData($type)
    {
        $result = array();
        switch ($type) {

            case 'php_script_1' :
                $result['table_name'] = $this->input->post('ptable_name');
                break;

            case 'save_psw' :
                $result['joriy'] = $this->input->post('ppsw_jor');
                $result['new'] = $this->input->post('ppsw_new');
                $result['new2'] = $this->input->post('ppsw_new2');
                break;

            case 'cmenu' :
                $result['name'] = $this->input->post('pname');
                $result['link'] = $this->input->post('plink');
                $result['parent'] = $this->input->post('pparent');
                $result['priority'] = $this->input->post('ppriority');
                $result['visible'] = $this->input->post('pvisible');
                $result['group'] = $this->input->post('pgroup');
                $result['class'] = $this->input->post('pclass');
                $result['photo'] = $this->input->post('pphoto');
                break;

            case 'cmenu_group' :
                $result['name'] = $this->input->post('pname');
                $result['comment'] = $this->input->post('pcomment');
                break;

            case 'cslider' :
                $result['background'] = $this->input->post('pbackground');
                $result['content'] = $this->input->post('pcontent');
                $result['lang'] = $this->input->post('plang');
                $result['priority'] = $this->input->post('ppriority');
                $result['lang'] = $this->input->post('plang');
                break;

            case 'cpage' :
                $result['sarlavha'] = $this->input->post('psarlavha');
                $result['text'] = $this->input->post('ptext');
                $result['text_short'] = $this->input->post('ptext_short');

                //	$result['text'] = html_entity_decode($result['text']);
                // ortiqcha enter va tugmalarni olib tashlimiz...
                //		$result['text'] = $this -> _clear_empties($result['text']);

                $result['author'] = $this->input->post('pauthor');
                $result['tag'] = $this->input->post('ptag');
                $result['photo'] = $this->input->post('pphoto');
                $result['sana'] = $this->input->post('psana');
                $result['sana'] = date("Y-m-d", strtotime($result['sana']));

                $result['slider'] = $this->input->post('pslider');
                $result['post_middle'] = $this->input->post('ppost_middle');
                $result['css'] = $this->input->post('pcss');
                $result['link'] = $this->input->post('plink');
                $result['type'] = $this->input->post('ptype');
                break;

            case 'cboxes' :
                $result['caption'] = $this->input->post('pcaption');
                $result['content'] = $this->input->post('pcontent');

                $result['name'] = $this->input->post('pname');
                $result['photo'] = $this->input->post('pphoto');
                $result['css_class'] = $this->input->post('pcss_class');
                break;

            case 'cmiddle_data' :
                $result['caption'] = $this->input->post('pcaption');
                $result['text'] = $this->input->post('ptext');
                $result['link'] = $this->input->post('plink');
                $result['image'] = $this->input->post('pimage');
                $result['visible'] = $this->input->post('pvisible');
                break;

            case 'folder' :
                $result['folder'] = $this->input->post('pfolder');
                break;

            case 'cpage_type' :
                $result['name'] = $this->input->post('pname');
                $result['visible'] = $this->input->post('pvisible');
                break;

            case 'ccategory' :
                $result['name'] = $this->input->post('pname');
                $result['visible'] = $this->input->post('pvisible');
                break;

            case 'cregions' :
                $result['name'] = $this->input->post('pname');
                $result['title'] = serialize($this->input->post('title'));
                $result['visible'] = $this->input->post('pvisible');
                $result['child'] = $this->input->post('pchild');
                break;

            case 'ccity' :
                $result['name'] = $this->input->post('pname');
                $result['title'] = serialize($this->input->post('title'));
                $result['visible'] = $this->input->post('pvisible');
                $result['parent'] = $this->input->post('pparent');
                 $result['region_id'] = $this->input->post('region_id');
                
                break;

            case 'cnews' :
                $result['sarlavha'] = $this->input->post('psarlavha');
                $result['sarlavha_ru'] = $this->input->post('psarlavha_ru');
                $result['text_short'] = $this->input->post('ptext_short');
                $result['text'] = $this->input->post('ptext');
                $result['text_ru'] = $this->input->post('ptext_ru');
                $result['author'] = $this->input->post('pauthor');
                $result['tag'] = $this->input->post('ptag');
                $result['photo'] = $this->input->post('pphoto');
                $result['sana'] = $this->input->post('psana');
                // $result['sana'] = date("d.m.Y", strtotime($result['sana']));
                $result['sana'] = date("Y-m-d H:i:s", strtotime($result['sana']));

                $result['css'] = $this->input->post('pcss');
                $result['link'] = $this->input->post('plink');
                $result['link_ru'] = $this->input->post('plink_ru');
                $result['ptype'] = $this->input->post('pptype');
                $result['ptype_ru'] = $this->input->post('pptype_ru');
                $result['category'] = $this->input->post('pcategory');
                $result['visible'] = $this->input->post('pvisible');
                break;

            case 'cnews_uzb' :
                $result['sarlavha'] = $this->input->post('psarlavha');
                $result['text'] = $this->input->post('ptext');
                $result['author'] = $this->input->post('pauthor');
                $result['sana'] = $this->input->post('psana');
                $result['link'] = $this->input->post('plink');
                $result['ptype'] = $this->input->post('pptype');
                $result['visible'] = $this->input->post('pvisible');
                break;

            case 'cinfo' :
                $result['sarlavha'] = $this->input->post('psarlavha');
                $result['sarlavha_ru'] = $this->input->post('psarlavha_ru');
                $result['text_short'] = $this->input->post('ptext_short');
                $result['text'] = $this->input->post('ptext');
                $result['text_ru'] = $this->input->post('ptext_ru');
                $result['author'] = $this->input->post('pauthor');
                $result['tag'] = $this->input->post('ptag');
                $result['photo'] = $this->input->post('pphoto');
                $result['sana'] = $this->input->post('psana');
                $result['map'] = $this->input->post('pmap');
                $result['map2'] = $this->input->post('pmap2');
                $result['map3'] = $this->input->post('pmap3');
                $result['show_line'] = $this->input->post('pshow_line');
                // $result['sana'] = date("d.m.Y", strtotime($result['sana']));
                $result['sana'] = date("Y-m-d", strtotime($result['sana']));

                $result['css'] = $this->input->post('pcss');
                $result['link'] = $this->input->post('plink');
                $result['link_ru'] = $this->input->post('plink_ru');
                $result['ptype'] = $this->input->post('pptype');
                $result['ptype_ru'] = $this->input->post('pptype_ru');
                $result['category'] = $this->input->post('pcategory');
                $result['visible'] = $this->input->post('pvisible');
                $result['onfront'] = $this->input->post('pon_front');
                break;

            case 'cvacancy' :
                $result['sarlavha'] = $this->input->post('psarlavha');
//                $result['text_short'] = $this->input->post('ptext_short');
                $result['text'] = $this->input->post('ptext');

                $result['division'] = $this->input->post('pdivision');
                $result['salary'] = $this->input->post('psalary');
                $result['special'] = $this->input->post('pspecial');
                $result['experience'] = $this->input->post('pexperience');
                $result['busyness'] = $this->input->post('pbusyness');
                $result['education'] = $this->input->post('peducation');
                $result['sex'] = $this->input->post('psex');
                $result['responsibility'] = $this->input->post('presponsibility');
                $result['requirement'] = $this->input->post('prequirement');

                $result['author'] = $this->input->post('pauthor');
                $result['sana'] = $this->input->post('psana');
                $result['sana'] = date("Y-m-d", strtotime($result['sana']));
                $result['link'] = $this->input->post('plink');
                $result['ptype'] = $this->input->post('pptype');
                break;

            case 'cqabul' :
                $result['reja_uzb'] = $this->input->post('preja_uzb');
                $result['reja_ru'] = $this->input->post('preja_ru');
                $result['ariza_uzb'] = $this->input->post('pariza_uzb');
                $result['ariza_rus'] = $this->input->post('pariza_rus');
                $result['xarbiy_uzb'] = $this->input->post('pxarbiy_uzb');
                $result['xarbiy_rus'] = $this->input->post('pxarbiy_rus');
                $result['name'] = $this->input->post('pname');
                break;

            case 'cpool' :
                $result['question'] = $this->input->post('pquestion');
                $result['answer1'] = $this->input->post('panswer1');
                $result['answer2'] = $this->input->post('panswer2');
                $result['answer3'] = $this->input->post('panswer3');
                $result['answer4'] = $this->input->post('panswer4');
                $result['answer5'] = $this->input->post('panswer5');
                $result['answer6'] = $this->input->post('panswer6');
                $result['answer7'] = $this->input->post('panswer7');
                $result['active'] = $this->input->post('pactive');
                $result['ball1'] = $this->input->post('pball1');
                $result['ball2'] = $this->input->post('pball2');
                $result['ball3'] = $this->input->post('pball3');
                $result['ball4'] = $this->input->post('pball4');
                $result['ball5'] = $this->input->post('pball5');
                $result['ball6'] = $this->input->post('pball6');
                $result['ball7'] = $this->input->post('pball7');
                $result['lang'] = $this->input->post('plang');
                break;



            case 'cfuqaro_murojaat' :
                $result['ism'] = $this->input->post('pism');
                $result['fam'] = $this->input->post('pfam');
                $result['email'] = $this->input->post('pemail');
                $result['telefon'] = $this->input->post('ptelefon');
                $result['mtext'] = $this->input->post('pmtext');
                $result['kimga_id'] = $this->input->post('pkimga_id');
                $result['murojaat_status'] = $this->input->post('pmurojaat_status');
                $result['natija_text'] = $this->input->post('pnatija_text');
                $result['zapas'] = $this->input->post('pzapas');

                $result['regions'] = $this->input->post('papregion');
                $result['city'] = $this->input->post('papcity');
                $result['pol'] = $this->input->post('ppol');
                $result['ustatus'] = $this->input->post('pustatus');
                $result['allow'] = $this->input->post('ap_allow');
                $result['file'] = $this->input->post('ap_file');
                $result['byear'] = $this->input->post('pbyear');
                $result['aptype'] = $this->input->post('paptype');
                $result['code'] = $this->input->post('ac_code');
                break;

            case 'csubscribe' :
                $result['email'] = $this->input->post('pemail');
                break;

            case 'csimple_citizen' :
                $result['name'] = $this->input->post('pism');
                $result['lastname'] = $this->input->post('pfam');
                $result['email'] = $this->input->post('pemail');
                $result['phone'] = $this->input->post('ptelefon');
                $result['text'] = $this->input->post('pmtext');
                $result['kimga_id'] = $this->input->post('pkimga_id');
                $result['ap_status'] = $this->input->post('pmurojaat_status');
                $result['natija_text'] = $this->input->post('pnatija_text');
                $result['zapas'] = $this->input->post('pzapas');
                break;

            case 'cresume' :
                $result['name'] = $this->input->post('res_fio');
                $result['email'] = $this->input->post('res_email');
                $result['phone'] = $this->input->post('res_phone');
                $result['vacancy'] = $this->input->post('res_vac');
                $result['file'] = $this->input->post('res_file');
                break;

            case 'cusername' :
                $result['username'] = $this->input->post('pusername');
                $result['user_fio'] = $this->input->post('pfio');
                $result['password'] = $this->input->post('ppassword');
                break;

            case 'cgallery_category' :
                $result['caption'] = $this->input->post('pcaption');
                $result['active'] = $this->input->post('pactive');
                $result['url'] = $this->input->post('gc_url');
                break;

            case 'cgallery' :
                $result['caption'] = $this->input->post('pcaption');
                $result['description'] = $this->input->post('pdescription');
                $result['filename'] = $this->input->post('pfilename');
                $result['category'] = $this->input->post('pcategory');
                break;

            case 'cvideo_category' :
                $result['name'] = $this->input->post('pname');
                $result['lang'] = $this->input->post('plang');
                break;
            case 'cvideo' :
                $result['category_id'] = $this->input->post('pcategory_id');
                $result['name'] = $this->input->post('pname');
                $result['about'] = $this->input->post('pabout');
                $result['duration'] = $this->input->post('pduration');
                $result['path'] = $this->input->post('ppath');
                $result['lang'] = $this->input->post('plang');
                $result['time'] = $this->input->post('ptime');
                $result['viewed'] = $this->input->post('pviewed');
                break;


            default :
                break;
        }
        return $result;
    }
}