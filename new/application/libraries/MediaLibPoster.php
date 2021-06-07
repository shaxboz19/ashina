<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class MediaLibPoster
{
	public function __construct()
	{
		$this->ci =& get_instance();		
	}

	private function _upload($folder)
	{		
		$config['upload_path']   = './uploads/'.$folder;
         $structure = './uploads/'.$folder;
         if(!file_exists($structure)){ 

                if (!mkdir($structure, 0777)) {

                    die('Не удалось создать директории...');

                }
        }
		$config['allowed_types'] = 'gif|jpg|jpeg|png|mp3|mp4|pdf|djvu|doc|docx';
		$config['max_size']	     = '700000';
		$config['max_width']     = '30000';
		$config['max_height']    = '30000';
        
        if($folder != 'music')
		  $config['encrypt_name']  = TRUE;

		$this->ci->load->library('upload', $config);

		if ( !empty($_FILES['userfile']['name'][0]) )
		{
			if ( ! $files = $this->ci->upload->do_multi_upload())
				$result = array('error' => $this->ci->upload->display_errors());
			else
				$result = $files;
		}
		else
			$result = array('error' => 'empty');

		return $result;
	}	

	public function save($data)
	{
		$media_files = $this->_upload('poster');

		if ( !isset($media_files['error']) )
		{
			$i=0;
			foreach ($media_files as $media)
			{
				$data['media_type']  = $media['file_type'];
				$data['title']       = @$data['title'];
				$data['description'] = @$data['description'];
				$data['category']    = 'poster';
				$data['post_id']     = @$data['post_id'];
				$data['url']         = $media['file_name'];
        
        $data['file_name']   = $media['file_name'];
        $data['file_type']   = $media['file_type'];
        $data['file_path']   = $media['file_path'];
        $data['full_path']   = $media['full_path'];
        $data['raw_name']    = $media['raw_name'];
        $data['orig_name']   = $media['orig_name'];
        $data['client_name'] = $media['client_name'];
        $data['file_ext']    = $media['file_ext'];
        $data['file_size']   = $media['file_size'];
        $data['is_image']    = $media['is_image'];
        $data['image_width'] = $media['image_width'];
        $data['image_height']= $media['image_height'];        
        $data['image_type']  = $media['image_type'];
        $data['image_size_str'] = $media['image_size_str'];        
        
				$data['created_on']  = date('Y-m-d');

				$new_data[] = $data;
				$i++;
			}

			foreach ($new_data as $nd)
			{
				$this->ci->db->insert('media_poster', $nd);

				$files['id']    = $this->ci->db->insert_id();
				$files['group'] = $nd['category'];
				$files['file']  = $nd['url'];
        $files['orig_name']  = $nd['orig_name'];

				$all_files[] = $files;
			}			

			return $all_files;
		}
		else
        {
            return array(array('error' => strip_tags($media_files['error'])));
        }
			
	}
	
	public function single_upload($folder)
	{
		$config['upload_path']   = './uploads/'.$folder;
         $structure = './uploads/'.$folder;
         if(!file_exists($structure)){ 

                if (!mkdir($structure, 0777)) {

                    die('Не удалось создать директории...');

                }
        }
		$config['allowed_types'] = 'gif|jpg|jpeg|png|mp3|mp4|pdf|djvu|doc|docx';
		$config['max_size']	     = '200000';
		$config['max_width']     = '30000';
		$config['max_height']    = '30000';
		$config['encrypt_name']  = TRUE;

		$this->ci->load->library('upload', $config);
		if ( !empty($_FILES['userfile']['name'][0]) )
		{
			if ( ! $files = $this->ci->upload->do_upload())
				$result = array('error' => $this->ci->upload->display_errors());
			else
				$result = $files;
		}
		else
			$result = array('error' => 'empty');

		return $result;
	}
  
  	public function single_upload_profile($folder)
	{
		$config['upload_path']   = './uploads/'.$folder;
         $structure = './uploads/'.$folder;
         if(!file_exists($structure)){ 

                if (!mkdir($structure, 0777)) {

                    die('Не удалось создать директории...');

                }
        }
		$config['allowed_types'] = 'gif|jpg|jpeg|png|mp3|mp4|pdf|djvu|doc|docx';
		$config['max_size']	     = '20000';
		$config['max_width']     = '3000';
		$config['max_height']    = '3000';
		$config['encrypt_name']  = TRUE;

		$this->ci->load->library('upload', $config);
		if ( !empty($_FILES['profile']['name'][0]) )
		{
			if ( ! $files = $this->ci->upload->do_upload())
				$result = array('error' => $this->ci->upload->display_errors());
			else
				$result = $files;
		}
		else
			$result = array('error' => 'empty');

		return $result;
	}
  
  	public function single_upload_poster_ru($folder)
	{
		$config['upload_path']   = './uploads/'.$folder;
         $structure = './uploads/'.$folder;
         if(!file_exists($structure)){ 

                if (!mkdir($structure, 0777)) {

                    die('Не удалось создать директории...');

                }
        }
		$config['allowed_types'] = 'gif|jpg|jpeg|png|mp3|mp4|pdf|djvu|doc|docx';
		$config['max_size']	     = '20000';
		$config['max_width']     = '3000';
		$config['max_height']    = '3000';
		$config['encrypt_name']  = TRUE;

		$this->ci->load->library('upload', $config);
		if ( !empty($_FILES['file']['name'][0]) )
		{
			if ( ! $files = $this->ci->upload->do_upload())
				$result = array('error' => $this->ci->upload->display_errors());
			else
				$result = $files;
		}
		else
			$result = array('error' => 'empty');

		return $result;
	}
  
  public function single_upload_poster_uz($folder)
	{
		$config['upload_path']   = './uploads/'.$folder;
         $structure = './uploads/'.$folder;
         if(!file_exists($structure)){ 

                if (!mkdir($structure, 0777)) {

                    die('Не удалось создать директории...');

                }
        }
		$config['allowed_types'] = 'gif|jpg|jpeg|png|mp3|mp4|pdf|djvu|doc|docx';
		$config['max_size']	     = '20000';
		$config['max_width']     = '3000';
		$config['max_height']    = '3000';
		$config['encrypt_name']  = TRUE;

		$this->ci->load->library('upload', $config);
		if ( !empty($_FILES['file']['name'][1]) )
		{
			if ( ! $files = $this->ci->upload->do_upload())
				$result = array('error' => $this->ci->upload->display_errors());
			else
				$result = $files;
		}
		else
			$result = array('error' => 'empty');

		return $result;
	}

	public function delete($id)
	{
		$media = $this->ci->db->get_where('media_poster', array('id'=>$id))->row();

		if ($media)
		{
			@unlink( "./uploads/{$media->category}/{$media->url}" );

			$this->ci->db->delete('media_poster', array('id'=>$id));
		}
	}

	public function set_main($media_id)
	{
		$media = $this->ci->db->get_where('media_poster', array('id'=>$media_id))->row();

		// Reset all media 
		$this->ci->db->set('is_main', '0')
					 ->where('post_id', $media->post_id)
					 ->update('media_poster');

		// Set main media 
		$this->ci->db->set('is_main', '1')
					 ->where('id', $media_id)
					 ->update('media_poster');
	}
  
  
  	public function lang_ru($media_id)
	{
		$media = $this->ci->db->get_where('media_poster', array('id'=>$media_id))->row();

			// Set main media 
		$this->ci->db->set('lang', 'ru')
					 ->where('id', $media_id)
					 ->update('media_poster');
	}
  
  
  	public function lang_oz($media_id)
	{
		$media = $this->ci->db->get_where('media_poster', array('id'=>$media_id))->row();

			// Set main media 
		$this->ci->db->set('lang', 'oz')
					 ->where('id', $media_id)
					 ->update('media');
	}

	public function watermark($file) {
        //$this->resize($file);

		$this->ci->load->library('image_lib');

		$config['source_image'] 	= './uploads/'.$file;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_hor_offset']    = '0';
		$config['wm_vrt_offset']    = '0';
		$config['quality']   		= '100';
		$config['wm_type'] 			= 'overlay';
    
		$config['dynamic_output']   = true;
		$config['wm_overlay_path']  = './assets/admin/img/watermark.jpg';
		$config['wm_opacity']       = '50';

		$this->ci->image_lib->initialize($config); 

		return $this->ci->image_lib->watermark();
	}

   public function mywatermark($width = 700, $height = 400, $file ) {
        $this->resize_img($file, $width, $height);

        $this->ci->load->library('image_lib');

        $config['source_image'] 	= './uploads/'.$file;
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        $config['wm_hor_offset']    = '0';
        $config['wm_vrt_offset']    = '0';
        $config['quality']   		= '50';
        $config['wm_type'] 			= 'overlay';
        $config['dynamic_output']   = true;
        $config['wm_overlay_path']  = './assets/admin/img/watermark.png';
        $config['wm_opacity']       = '50';

        $this->ci->image_lib->initialize($config);

        return $this->ci->image_lib->watermark();
    }
    
    public function mywatermarkimg($width = 700, $height = 400, $file ) {
        $this->resize_img($file, $width, $height);

        $this->ci->load->library('image_lib');

        $config['source_image'] 	= './uploads/'.$file;
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        $config['wm_hor_offset']    = '0';
        $config['wm_vrt_offset']    = '0';
        $config['quality']   		= '50';
        $config['wm_type'] 			= 'overlay';
        $config['dynamic_output']   = true;
       
        $config['wm_opacity']       = '50';

        $this->ci->image_lib->initialize($config);

        return $this->ci->image_lib->watermark();
    }
    
    public function resize($file) {
        $this->ci->load->library('image_lib');
        $config['source_image'] 	= './uploads/'.$file;
        $config['width'] = 800;
        $config['height'] = 600;
        $config['master_dim'] = 'auto';
        $config['maintain_ratio'] = TRUE;;
        $this->ci->image_lib->initialize($config);
        $this->ci->image_lib->resize();
    }

    public function resize_img($file, $width = 700, $height = 400) {
        $this->ci->load->library('image_lib');
        $config['source_image'] 	= './uploads/'.$file;
        $config['width'] = $width;
        $config['height'] = $height;
        $config['master_dim'] = 'auto';
        $config['maintain_ratio'] = TRUE;
        $this->ci->image_lib->initialize($config);
        $this->ci->image_lib->resize();
    }
}