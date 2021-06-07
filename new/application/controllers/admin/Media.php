<?php

Class Media extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('MediaLib');
	}

	public function index()
	{
		$this->load->view('admin/media/index');
	}

	public function set_main($id)
	{
		$this->medialib->set_main($id);

		echo 'set_main';
	}

	public function sort()
	{
		$data = json_decode($this->input->post('media_files'), true);

		$this->db->update_batch('media', $data, 'id');
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

		$result = $this->medialib->save($data);

		echo json_encode($result);
	}

	public function delete($id)
	{
		$this->medialib->delete($id);

		echo 'deleted';
	}
}