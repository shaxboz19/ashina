<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls_u_model extends CI_Model
{
	public function get_all()
	{
        $this->db->order_by('id DESC');
        $this->db->where('user_id', $this->session->userdata('user_id'));
		return $this->db->get('polls_u')->result();
	}

	public function get_id($alias)
	{
		$category = $this->db->get_where('polls_u', array('alias'=>$alias))->row();

		if ($category)
			return $category->id;
		else
			return show_404();
	}
  
  public function get_all_polls_admin($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
  
       $this->db->order_by('id', $q['order']);
        $this->db->where('status', $q['status']);
         $this->db->where('user_id', $this->session->userdata('user_id'));
		return $this->db->get('polls_u', $q['limit'], $q['offset'])->result();
	}
  
  public function get_all_polls_user($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
            'user_id' => '',
      
            
		);

		$q = array_merge($defaults, $args);
  
       $this->db->order_by('id', $q['order']);
        $this->db->where('status', $q['status']);
         $this->db->where('user_id', $q['user_id']);
		return $this->db->get('polls_u', $q['limit'], $q['offset'])->result();
	}
  
  
  public function get_polls_id() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM polls_u AS p
                WHERE p.id
                AND p.status = 'active'";
            return $this->db->query($sql)->row('count');
	}
  

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('polls_u', $data);
		}
		else
			$this->db->insert('polls_u', $data);
      	return $this->db->insert_id();
	}
  

	function delete($id)
	{
		$this->db->delete('polls_u', array('id'=>$id));
	}

	public function get($id)
	{
		return $this->db->get_where('polls_u', array('id'=>$id))->row();
	}
  
    public function get_polls_count($group) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM polls_u AS p
                WHERE p.status = '".$group."'
                AND p.user_id = '".$this->session->userdata('user_id')."'";
                
            return $this->db->query($sql)->row('count');
	}

  public function get_polls_user_count($group, $id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM polls_u AS p
                WHERE p.status = '".$group."'
                AND p.user_id = '".$id."'";
                
            return $this->db->query($sql)->row('count');
	}

}