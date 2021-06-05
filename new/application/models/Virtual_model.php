<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Virtual_model extends CI_Model
{
    public function get($id, $status = false) {
		$this->db->select('virtual.*')		       
		         ->where('virtual.id', $id);
        if($status)
            $this->db->where('virtual.status', $status);

		return $this->db->get('virtual')->row();
	}
    
     public function get_posts_p($args = null)
	{
		$defaults = array(            
            'id' => '',
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'region_id' => '',   
            'orderby' => 'id',  
            'status' => '',   
            'created_on' => '',
            'date1' => '',
            'search_array' => '',
            'search_title' => ''
		);

		$q = array_merge($defaults, $args);
        $this->db->select('virtual.*');
        
        if(!empty($q['status']))
            $this->db->where('virtual.status', $q['status']);  
       
       
        if ( !empty($q['region_id']) )
        $this->db->where_in('virtual.region_id', $q['region_id']);
         if(!empty($q['created_on'])){
            $this->db->like('virtual.created_on', $q['created_on']);
        }
        
        
        if(!empty($q['date1']) && !empty($q['date2'])){
            $this->db->where('virtual.created_on >=', $q['date1'].' 00:00:00');
            $this->db->where('virtual.created_on <=', $q['date2'].' 23:59:59');
            }
        
          if ( !empty($q['search_array']) ){
            //foreach($q['search_array'] as $key){
                                   
        			$this->db->like('virtual.'.$q['search_array'], $q['search_title']);
                    
               // }
            }
    
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);


		return $this->db->get('virtual', $q['limit'], $q['offset'])->result();
	}
    
       public function save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('virtual', $data);
		}
		else
		{
			$this->db->insert('virtual', $data);

			return $this->db->insert_id();
		}
	}
    
     public function delete($id)
	{
		$this->db->where('id', $id)->delete('virtual'); 	
    }
    
     public function count_all_v(){
      return $this->db->count_all('virtual');
    }
    
    public function v_count($status) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM virtual AS p
            WHERE p.status = '$status'";
            return $this->db->query($sql)->row('count');
	}
    
    function check_cid_id($id, $cid) {
        $this->db->select('access_code');
        $this->db->where('id', $id);
        $this->db->from('virtual');
        $data = $this->db->get();
        $cid_db = $data->result_array();
        if($cid_db){
            if(md5($cid) == $cid_db[0]['access_code']) {
                return 1;
            } else {
                return 0;
            }
        } else {
             return 0;
        }
    }
    
    function randomNumber($length) {
        $min = 1 . str_repeat(0, $length-1);
        $max = str_repeat(9, $length);
        return mt_rand($min, $max);
    }
 }   
 ?>