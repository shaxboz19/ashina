<?php

/**
 * @author Dmitriy
 * @copyright 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guestbook_model extends CI_Model
{

    public function get_list()
	{
		return $this->db->order_by('date', 'DESC')->get('guestbook')->result();
	}

    public function get_active($limit, $offset)
    {
        return $this->db->where('status', 'active')
                        ->limit($limit, $offset)
                        ->order_by('id', 'desc')
                        ->get('guestbook')
                        ->result();
    }

    public function total_active()
    {
        return $this->db->where('status', 'active')->count_all_results('guestbook');
    }

    public function get($id)
    {
        return $this->db->get_where('guestbook', array('id' => $id))->row();
    }

    public function save($data, $id = false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('guestbook', $data);
		}
		else
		{
			$this->db->insert('guestbook', $data);

			return $this->db->insert_id();
		}
	}

   	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('guestbook');
	}

}