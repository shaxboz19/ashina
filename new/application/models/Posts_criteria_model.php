<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Posts_criteria_model extends CI_Model
{
    public function get($id, $status = false) {
		$this->db->select('posts_criteria.*')		       
		         ->where('posts_criteria.id', $id);
        if($status)
            $this->db->where('posts_criteria.status', $status);

		return $this->db->get('posts_criteria')->row();
	}
     
    public function get_posts_p($args = null)
	{
		$defaults = array(            
            'id' => '',
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'category_id' => '',
            'orderby' => 'id',
            'status' => '',             
		);

		$q = array_merge($defaults, $args);
        $this->db->select('posts_criteria.*')->group_by('posts_criteria.id');
        
        if(!empty($q['status']))
            $this->db->where('posts_criteria.status', $q['status']);            
                      
            
         
		if ( !empty($q['category_id']) )
			$this->db->where_in('posts_criteria.category_id', $q['category_id']);
            
              
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
      /*if ( !empty($q['not_like']) )
			$this->db->not_like('posts_si.id', $q['not_like']);*/
            
             /*   if ( !empty($q['year']) )
			$this->db->where('YEAR(posts.created_on)', $q['year']);
            
            if ( !empty($q['month']) )
			$this->db->where('MONTH(posts.created_on)', $q['month']);
            
            if(!empty($q['months']))
             $this->db->where('posts.created_on >= now() + interval '.$q['months'].' month');
             if(!empty($q['interval']))
             $this->db->where('date(posts.created_on) >= CURDATE() - interval '.$q['interval'].' day');*/
             // $this->db->where('date(posts.created_on) BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL '.$q['interval'].' DAY))');
             // ADDDATE(date_out, INTERVAL 7 DAYS)
            
            /* if(!empty($q['date1']) && !empty($q['date2'])){
             $this->db->where('posts.created_on >=', $q['date1'].' 00:00:00');
            $this->db->where('posts.created_on <=', $q['date2'].' 23:59:59');
            }*/


		return $this->db->get('posts_criteria', $q['limit'], $q['offset'])->result();
	}
    
    public function save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('posts_criteria', $data);
		}
		else
		{
			$this->db->insert('posts_criteria', $data);

			return $this->db->insert_id();
		}
	}
 
    
    public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('posts_criteria');    	

	
			//$this->db->delete('media', array('post_id'=>$id));
		
	} 
    
    public function count_posts_c(){
        $this->db->count_all('posts_criteria');
    }
   
     // Si Chart
     
      public function get_criteria_m($id, $status = false) {
		$this->db->select('posts_criteria_m.*')		       
		         ->where('posts_criteria_m.id', $id);
        if($status)
            $this->db->where('posts_criteria_m.status', $status);

		return $this->db->get('posts_criteria_m')->row();
	}
     
         public function get_posts_criteria_m($args = null)
	{
		$defaults = array(            
            'id' => '',
            'limit' => 10000,
            'offset' => 0,
            'order' => 'DESC',
            'category_id' => '',
            'post_id' => '',
            'orderby' => 'id',
            'status' => '',  
            'year' => '',
             'month' => '',          
		);

		$q = array_merge($defaults, $args);
        $this->db->select('posts_criteria_m.*')->group_by('posts_criteria_m.id');
        
        if(!empty($q['status']))
            $this->db->where('posts_criteria_m.status', $q['status']);            
                      
            
         
		if ( !empty($q['post_id']) )
			$this->db->where_in('posts_criteria_m.post_id', $q['post_id']);
         
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
            
            if ( !empty($q['year']) )
			$this->db->where('YEAR(posts_criteria_m.created_on)', $q['year']);
            
            if ( !empty($q['month']) )
			$this->db->where('MONTH(posts_criteria_m.created_on)', $q['month']);
 
		return $this->db->get('posts_criteria_m', $q['limit'], $q['offset'])->result();
	}
     
        public function save_criteria_m($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('posts_criteria_m', $data);
		}
		else
		{
			$this->db->insert('posts_criteria_m', $data);

			return $this->db->insert_id();
		}
	}
     
    public function delete_criteria_m($id)
	{
		$this->db->where('id', $id)
		         ->delete('posts_criteria_m');    	

	
			//$this->db->delete('media', array('post_id'=>$id));
		
	}
    
    public function count_criteria_m($category_id)
    {
        return $this->db->where('post_id', $category_id)->count_all_results('posts_criteria_m');
    }
}
?>