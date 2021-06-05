<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_model extends CI_Model
{
 
    

	   function __construct() {
        parent::__construct();
        $this->db->cache_off();
    }

    public function get_list()
	{
		return $this->db->order_by('date', 'DESC')->get('feed')->result();
	}
    
    public function get_active($limit, $offset)
    {
        return $this->db->select('name, message, date')
                        ->where('status', 'active')
                        ->limit($limit, $offset)
                        ->order_by('id', 'desc')
                        ->get('feed')
                        ->result();    
    }
    
        public function get_feed($args = null)
    {
      
      $defaults = array(
			'post_id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'user_id' => '',
            'groups' => '',
            
		);

	@$q = array_merge($defaults, (array)$args);
      
       // $this->db->where('post_id', $q['post_id']);
                 //->order_by('user_id DESC');
                 if(!empty($q['groups']))
            $this->db->where('feed.groups', $q['groups']);
                 
                 if(!empty($q['user_id']))
            $this->db->where('feed.user_id', $q['user_id']);
            
                 	if ( !empty($q['orderby']) ){
			$this->db->order_by($q['orderby'], $q['order']);
      }
        return $this->db->get('feed', $q['limit'], $q['offset'])->result();
    }
    
   /* public function getOrder_count($group) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM order AS p
            WHERE p.groups = '".$group."';             
            AND p.status = 'active'";
            return $this->db->query($sql)->row('count');
	}*/
    
    public function total_active()
    {
        return $this->db->where('status', 'active')->count_all_results('feed');
    }
    
    public function getfeed_count($group)
    {
        return $this->db->where('groups', $group)->count_all_results('feed');
    }
    
    public function get($id)
    {
        return $this->db->get_where('feed', array('id' => $id))->row();    
    }
    
    public function save($data, $id = false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('feed', $data);
		}
		else
		{
			$this->db->insert('feed', $data);

			return $this->db->insert_id();
		}
	}
    
   	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('feed');
	}

}