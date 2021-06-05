<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Medicine_reestr_model extends CI_Model
{
    public function get($id, $status = false) {
		$this->db->select('medicine_reestr.*')		       
		         ->where('medicine_reestr.id', $id);
        if($status)
            $this->db->where('medicine_reestr.status', $status);

		return $this->db->get('medicine_reestr')->row();
	}
      public function get_id_all($alias)
	{
	   	$this->db->select('medicine_reestr.*')
		         ->where('medicine_reestr.id', $alias);
      
		$post = $this->db->get('medicine_reestr')->row();
        
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
            'category_id' => '',
            'order' => 'DESC', 
            'status' => '',
            'orderby' => 'id', 
            'filter' => '',     
		);

		$q = array_merge($defaults, $args);
        $this->db->select('medicine_reestr.*')->group_by('medicine_reestr.id');
        
        if(!empty($q['status']))
            $this->db->where('medicine_reestr.status', $q['status']);  
        if(!empty($q['category_id']))
            $this->db->where('medicine_reestr.category_id', $q['category_id']); 
         if ( !empty($q['filter']) ){
            foreach($q['filter'] as $key => $val){
                if($key == 'value_2'){             
    		      	$this->db->like('medicine_reestr.'.$key, trim(addslashes($val)));
                }
            }
         }          
             
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);


		return $this->db->get('medicine_reestr', $q['limit'], $q['offset'])->result();
	}
    
      public function search_count($title, $category_id) {
        
             foreach($title as $key => $val){
        if($key == 'value_2'){
               
    	$this->db->like('medicine_reestr.'.$key, trim(addslashes($val)));
        }
                }
        
        $this->db->where('status', 'active');
        $this->db->where_in('category_id', $category_id);
        $this->db->from('medicine_reestr');
      
        return $this->db->count_all_results();

	}
    
    public function save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('medicine_reestr', $data);
		}
	}
    
    public function get_date_reestr($id) {
		$this->db->select('medicine_reestr_date.*')		       
		         ->where('medicine_reestr_date.id', $id);
		return $this->db->get('medicine_reestr_date')->row();
	}
    
    public function save_date($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('medicine_reestr_date', $data);
		}
	}
    public function save_import($data)
	{
			$this->db->insert('medicine_reestr', $data);
			return $this->db->insert_id();
		
	}
 
    
    public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('medicine_reestr');    			
	} 
    
    public function truncate_reestr(){
       // $this->db->truncate('medicine_reestr');
    }
    
    public function count_medicine_reestr(){
      return $this->db->count_all('medicine_reestr');
    }
    
     public function medicine_reestr_count() {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM medicine_reestr AS p
            WHERE p.status = 'active'";
            return $this->db->query($sql)->row('count');
	}
    
     public function medicine_reestr_count_category($id) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM medicine_reestr AS p
            WHERE p.status = 'active'
            AND p.category_id = $id";
            return $this->db->query($sql)->row('count');
	}
       
}
?>