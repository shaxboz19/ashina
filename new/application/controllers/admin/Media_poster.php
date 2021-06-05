<?php

Class Media_poster extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('MediaLibPoster');
	}

	public function index()
	{
		$this->load->view('admin/media/media_poster');
	}

	public function set_main($id)
	{
		$this->medialibposter->set_main($id);

		echo 'set_main';
	}
  
  	public function lang_ru($id)
	{
		$this->medialibposter->lang_ru($id);

		echo 'lang_ru';
	}
  
  	public function lang_oz($id)
	{
		$this->medialibposter->lang_oz($id);

		echo 'lang_oz';
	}
  
  

	public function sort()
	{
		$data = json_decode($this->input->post('media_files_poster'), true);

		$this->db->update_batch('media_poster', $data, 'id');
	}
  
  public function menu_sort()
	{
		$data = json_decode($this->input->post('menu_files'), true);

		$this->db->update_batch('posts', $data, 'id');
	}

	public function save()
	{
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'category' => $this->input->post('category'),
			'post_id' => $this->input->post('post_id'),
		);

		$result = $this->medialibposter->save($data);

		echo json_encode($result);
	}

	public function delete($id)
	{
		$this->medialibposter->delete($id);

		echo 'deleted';
	}
}