<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_model extends CI_Model
{
	public function get_list()
	{
		$this->db->select('*')
                
				 ->order_by('date DESC');

		return $this->db->get('contacts')->result();
	}

	public function get($contact_id)
	{
		return $this->db->get_where('contacts', array('contact_id'=>$contact_id))->row();
	}

	public function get_history_contacts($contact_id, $contact)
	{
		$this->db->where('contact_id !=', $contact_id)
		         ->where('email', $contact->email);

        return $this->db->get('contacts')->result(); 
	}

	public function save($data)
	{
		$this->db->insert('contacts', $data);
	}

	public function delete($contact_id)
	{
		$this->db->delete('contacts', array('contact_id'=>$contact_id));
	}

	
}