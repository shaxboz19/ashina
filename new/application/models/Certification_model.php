<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Certification_model extends CI_Model
{
    public function get($id, $status = false) {
		$this->db->select('certification.*')		       
		         ->where('certification.id', $id);
        if($status)
            $this->db->where('certification.status', $status);

		return $this->db->get('certification')->row();
	}
      public function get_id_all($alias)
	{
	   	$this->db->select('certification.*')
		         ->where('certification.id', $alias);
      
		$post = $this->db->get('certification')->row();
        
        if ($post)
			return $post;
		else
			return show_404();
	
	}
    public function get_posts_p($args = null)
	{
		$defaults = array(            
            'id' => '',
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC', 
            'status' => '',
            'orderby' => 'id',      
		);

		$q = array_merge($defaults, $args);
        $this->db->select('certification.*')->group_by('certification.id');
        
        if(!empty($q['status']))
            $this->db->where('certification.status', $q['status']);           
             
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);


		return $this->db->get('certification', $q['limit'], $q['offset'])->result();
	}
    
      public function search_count($title) {
        
             foreach($title as $key => $val){
        if($key == 'org_name' || $key == 'location_address' || $key == 'inn' || $key == 'lic_num' || $key == 'phones' || $key == 'region_id'){
               
    	$this->db->like('certification.'.$key, $val);
        }
                }
        
        $this->db->where('status', 'active');
        $this->db->from('certification');
      
        return $this->db->count_all_results();

	}
    
    public function save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('certification', $data);
		}
		else
		{
			$this->db->insert('certification', $data);

			return $this->db->insert_id();
		}
	}
    public function save_import($data)
	{
			$this->db->insert('certification', $data);

			return $this->db->insert_id();
		
	}
 
    
    public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('certification');    			
	} 
    
    public function count_certification(){
      return $this->db->count_all('certification');
    }
    
     public function certification_count() {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM certification AS p
            WHERE p.status = 'active'";
            return $this->db->query($sql)->row('count');
	}
   
 
    
}
?>