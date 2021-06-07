<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->data['sel'] = 'contacts';		

		$this->load->model('contacts_model', 'contacts'); 
	} 

	public function index()
	{
		$this->data['contacts'] = $this->contacts->get_list();

		$this->data['body'] = 'admin/contacts/index';
	    $this->load->view('admin/index', $this->data);
	}

	public function view($contact_id)
	{
		$this->data['contact'] = $contact = $this->contacts->get($contact_id);
		$this->data['contacts'] = $this->contacts->get_history_contacts($contact_id, $contact);

		$this->data['body'] = 'admin/contacts/view';
	    $this->load->view('admin/index', $this->data);
	}

	public function reply($contact_id)
	{
		$this->form_validation->set_rules('message', 'Message', 'trim|required');

		if($this->form_validation->run()) {
			$to = $this->input->post('email');
			$phone = $this->input->post('phone');
			$message = $this->input->post('message');
			$subject = 'confirmation';
			//mark as replied
			$this->db->update('contacts', array('reply'=>'1'), array('contact_id'=>$contact_id));

            email('info@muxlis.uz','Muxlis', $to, $subject, $message);			

			go_to('admin/contacts');
		}

		$this->data['contact'] = $this->contacts->get($contact_id);

		$this->data['body'] = 'admin/contacts/reply';
	    $this->load->view('admin/index', $this->data);
	}

	public function delete($contact_id)
	{
		$this->contacts->delete($contact_id);
		go_to();
	}
}