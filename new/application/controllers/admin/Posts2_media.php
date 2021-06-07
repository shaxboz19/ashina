<?php

Class Posts2_media extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('Posts2MediaLib');
	}

	public function index()
	{
		$this->load->view('admin/posts2_media/index');
	}

	public function set_main($id)
	{
		$this->posts2medialib->set_main($id);

		echo 'set_main';
	}

	public function sort()
	{
		$data = json_decode($this->input->post('media_files'), true);

		$this->db->update_batch('media2', $data, 'id');
	}
  
  public function menu_sort()
	{
		$data = json_decode($this->input->post('menu_files'), true);

		$this->db->update_batch('posts2', $data, 'id');
	}

	public function save()
	{
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'category' => $this->input->post('category'),
			'post_id' => $this->input->post('post_id'),
		);

		$result = $this->posts2medialib->save($data);

		echo json_encode($result);
	}

	public function delete($id)
	{
		$this->posts2medialib->delete($id);

		echo 'deleted';
	}
}