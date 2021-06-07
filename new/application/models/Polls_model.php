<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls_model extends CI_Model
{
	public function get_all()
	{
        $this->db->order_by('id DESC');
		return $this->db->get('polls')->result();
	}

	public function get_id($alias)
	{
		$category = $this->db->get_where('polls', array('alias'=>$alias))->row();

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
		return $this->db->get('polls', $q['limit'], $q['offset'])->result();
	}
  
  public function get_polls_id() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM polls AS p
                WHERE p.id
                AND p.status = 'active'";
            return $this->db->query($sql)->row('count');
	}
  

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('polls', $data);
		}
		else
			$this->db->insert('polls', $data);
      	return $this->db->insert_id();
	}
  

	function delete($id)
	{
		$this->db->delete('polls', array('id'=>$id));
	}

	public function get($id)
	{
		return $this->db->get_where('polls', array('id'=>$id))->row();
	}
  
    public function get_polls_count($group) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM polls AS p
                WHERE p.status = '".$group."'";
            return $this->db->query($sql)->row('count');
	}

}