<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Posts_si_model extends CI_Model
{
    public function get($id, $status = false) {
		$this->db->select('posts_si.*')		       
		         ->where('posts_si.id', $id);
        if($status)
            $this->db->where('posts_si.status', $status);

		return $this->db->get('posts_si')->row();
	}
      public function get_id_all($alias)
	{
	   	$this->db->select('posts_si.*')
		         ->where('posts.alias', $alias);
      
		$post = $this->db->get('posts_si')->row();
        
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
            'status_moderator' => '',
            'status_moderator_edit' => '',
            'status_edit' => '',
            'orderby' => 'id',
            'status' => '',
            'user_id' => '',             
		);

		$q = array_merge($defaults, $args);
        $this->db->select('posts_si.*')->group_by('posts_si.id');
        
        if(!empty($q['status']))
            $this->db->where('posts_si.status', $q['status']);           
         
        if ( !empty($q['category_id']) )
        $this->db->where_in('posts_si.category_id', $q['category_id']);
        
        if ( !empty($q['user_id']) )
        $this->db->where_in('posts_si.user_id', $q['user_id']);
        
        if ( !empty($q['region_id']) )
        $this->db->where_in('posts_si.region_id', $q['region_id']);
        
        if ( !empty($q['status_moderator']) )
        $this->db->where_in('posts_si.status_moderator', $q['status_moderator']);
        
        if ( !empty($q['status_edit']) )
        $this->db->where_in('posts_si.status_edit', $q['status_edit']);
        
        if ( !empty($q['status_moderator_edit']) )
        $this->db->where_in('posts_si.status_moderator_edit', $q['status_moderator_edit']);
         
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


		return $this->db->get('posts_si', $q['limit'], $q['offset'])->result();
	}
    
    public function save($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('posts_si', $data);
		}
		else
		{
			$this->db->insert('posts_si', $data);

			return $this->db->insert_id();
		}
	}
 
    
    public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('posts_si');    	

	
			//$this->db->delete('media', array('post_id'=>$id));
		
	} 
    
    public function count_posts_si(){
        $this->db->count_all('posts_si');
    }
   
     // Si Chart
     
      public function get_si_chart($id, $status = false) {
		$this->db->select('posts_si_chart.*')		       
		         ->where('posts_si_chart.id', $id);
        if($status)
            $this->db->where('posts_si_chart.status', $status);

		return $this->db->get('posts_si_chart')->row();
	}
     
         public function get_posts_chart($args = null)
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
            'year' => '',
             'month' => '', 
             'group_by' => 'id',         
		);

		$q = array_merge($defaults, $args);
        $this->db->select('posts_si_chart.*')->group_by('posts_si_chart.id');
        
        if(!empty($q['status']))
            $this->db->where('posts_si_chart.status', $q['status']);            
                      
            
         
		if ( !empty($q['category_id']) )
			$this->db->where_in('posts_si_chart.category_id', $q['category_id']);
         
		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
            
            if ( !empty($q['year']) )
			$this->db->where('YEAR(posts_si_chart.created_on)', $q['year']);
            
            if ( !empty($q['month']) )
			$this->db->where('MONTH(posts_si_chart.created_on)', $q['month']);
            
          	if ( !empty($q['group_by']) )
			$this->db->group_by($q['group_by']);
 
		return $this->db->get('posts_si_chart', $q['limit'], $q['offset'])->result();
	}
     
        public function save_si_chart($data, $id=false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('posts_si_chart', $data);
		}
		else
		{
			$this->db->insert('posts_si_chart', $data);

			return $this->db->insert_id();
		}
	}
     
    public function delete_si_chart($id)
	{
		$this->db->where('id', $id)
		         ->delete('posts_si_chart');    	

	
			//$this->db->delete('media', array('post_id'=>$id));
		
	}
    
    public function count_si_chart($category_id)
    {
        return $this->db->where('category_id', $category_id)->count_all_results('posts_si_chart');
    }
    
      public function save_si_message($data)
	{
		$this->db->insert('posts_si_message', $data);
        return $this->db->insert_id();		
	}
    
    // Statistics
      public function get_posts_stat($args = null)
	{
		$defaults = array(            
            'id' => '',
            'limit' => 1000000,
            'offset' => 0,
            'order' => 'DESC',
            'post_id' => '',
            'region_id' => '',
            'user_id' => '',
            'moderator_id' => '',
            'moderator_main' => '',
            'status_add' => '',
            'orderby' => 'id',
            'status' => '',  
            'year' => '',
            'month' => '', 
            'group_by' => 'id',         
		);

		$q = array_merge($defaults, $args);
        $this->db->select('posts_si_stat.*')->group_by('posts_si_stat.id');
        
        if(!empty($q['status']))
            $this->db->where('posts_si_stat.status', $q['status']);            
         
        if ( !empty($q['post_id']) )
            $this->db->where_in('posts_si_stat.post_id', $q['post_id']);
        
        if ( !empty($q['user_id']) )
            $this->db->where_in('posts_si_stat.user_id', $q['user_id']);
        
        if ( !empty($q['status_add']) )
            $this->db->where_in('posts_si_stat.status_add', $q['status_add']);
        
        if ( !empty($q['moderator_id']) )
            $this->db->where_in('posts_si_stat.moderator_id', $q['moderator_id']); 
        
        if ( !empty($q['moderator_main']) )
            $this->db->where_in('posts_si_stat.moderator_main', $q['moderator_main']);          
        
        if ( !empty($q['orderby']) )
            $this->db->order_by($q['orderby'], $q['order']);
        
        if ( !empty($q['year']) )
            $this->db->where('YEAR(posts_si_stat.created_stat)', $q['year']);
        
        if ( !empty($q['month']) )
            $this->db->where('MONTH(posts_si_stat.created_stat)', $q['month']);
        
        if ( !empty($q['group_by']) )
            $this->db->group_by($q['group_by']);
 
		return $this->db->get('posts_si_stat', $q['limit'], $q['offset'])->result();
	}
    
    public function save_si_stat($id, $user_type)
	{	     
        $this->db->select('posts_si.*')->where('posts_si.id', $id);
        $query = $this->db->get('posts_si')->row();        
        $this->db->set('post_id', $id);  
        $this->db->set('created_stat', date('Y-m-d H:i:s'));
        $this->db->set('status_add', $user_type);  
            
        foreach($query as $key=>$val){          
            if($key != 'id'){
                $this->db->set($key, $val);
            }            
        }    
        return $this->db->insert('posts_si_stat');		
	}
}
?>