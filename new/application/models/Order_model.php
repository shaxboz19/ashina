<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{
    
    public function get_list()
	{
		return $this->db->order_by('date', 'DESC')->get('order')->result();
	}
    
    public function get_active($limit, $offset)
    {
        return $this->db->select('name, message, date')
                        ->where('status', 'active')
                        ->limit($limit, $offset)
                        ->order_by('id', 'desc')
                        ->get('order')
                        ->result();    
    }
    
    public function total_active()
    {
        return $this->db->where('status', 'active')->count_all_results('order');
    }
    
    public function get($id)
    {
        return $this->db->get_where('order', array('id' => $id))->row();    
    }
    
    public function save($data, $id = false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('order', $data);
		}
		else
		{
			$this->db->insert('order', $data);

			return $this->db->insert_id();
		}
	}
    
   	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('order');
	}

}