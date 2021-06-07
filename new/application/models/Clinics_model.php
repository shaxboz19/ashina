<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Clinics_model extends CI_Model
{
    public function get($id, $status = false) {
		$this->db->select('clinics.*')		       
		         ->where('clinics.id', $id);
        if($status)
            $this->db->where('clinics.status', $status);

		return $this->db->get('clinics')->row();
	}
      public function get_id_all($alias)
	{
	   	$this->db->select('clinics.*')
		         ->where('clinics.id', $alias);
      
		$post = $this->db->get('clinics')->row();
        
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
            'category_id' => '',
            'region_id' => '',   
            'orderby' => 'id',  
            'status' => '',      
		);

		$q = array_merge($defaults, $args);
        $this->db->select('clinics.*')->group_by('clinics.id');
        
        if(!empty($q['status']))
            $this->db->where('clinics.status', $q['status']);           
         
        if ( !empty($q['category_id']) )
        $this->db->where_in('clinics.category_id', $q['category_id']);
       
        if ( !empty($q['region_id']) )
        $this->db->where_in('clinics.region_id', $q['region_id']);
        
          if ( !empty($q['filter']) ){
            foreach($q['filter'] as $key => $val){
                    if($key == 'org_name' || $key == 'location_address' || $key == 'inn' || $key == 'lic_num' || $key == 'phones'){
                        
                    
        			$this->db->like('clinics.'.$key, $val);
                    }
            }
            }
    
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);


		return $this->db->get('clinics', $q['limit'], $q['offset'])->result();
	}
    
      public function search_count($title) {
        
         foreach($title as $key => $val){
    if($key == 'org_name' || $key == 'location_address' || $key == 'inn' || $key == 'lic_num' || $key == 'phones' || $key == 'region_id'){
           
	$this->db->like('clinics.'.$key, $val);
    }
            }
    
    $this->db->where('status', 'active');
    $this->db->from('clinics');
  
    return $this->db->count_all_results();

	/*$sql = "SELECT
            COUNT(*) AS `count`
            FROM posts AS p
            WHERE p.title = '".$title."'                  
            AND p.status = 'active' ";
            return $this->db->query($sql)->row('count');*/

	}
    
    public function save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('clinics', $data);
		}
		else
		{
			$this->db->insert('clinics', $data);

			return $this->db->insert_id();
		}
	}
 
    
    public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('clinics');    	

	
			//$this->db->delete('media', array('post_id'=>$id));
		
	} 
    
    public function count_clinics(){
      return $this->db->count_all('clinics');
    }
    
     public function clinics_count() {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM clinics AS p
            WHERE p.status = 'active'";
            return $this->db->query($sql)->row('count');
	}
   
 
    
}
?>