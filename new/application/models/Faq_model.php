<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_model extends CI_Model
{
    public function get($alias)
    {
        return $this->db->get_where('categories', array('alias'=>$alias))->row();
    }

	public function get_all_faq($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
	   
        $this->db->order_by('id DESC');
        $this->db->where('status', 'active');
		return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}
  
  
  /*public function blog_view($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
            'user_id_question' => '',
      
            
		);

		$q = array_merge($defaults, $args);
	   
        $this->db->order_by('id DESC');
        $this->db->where('status', 'active');
        $this->db->where('user_id_question', $q['user_id_question']);
		return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}*/
  
    public function blog_view($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
            'user_id' => '',
      
            
		);

		$q = array_merge($defaults, $args);
	   
        $this->db->order_by('id DESC');
        $this->db->where('status', 'active');
        $this->db->where('user_id', $q['user_id']);
		return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}
  
  	public function get_all_faq_admin($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
  
       $this->db->order_by('id', $q['order']);
        //$this->db->where('status', 'active');
		return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}
  
  	public function get_no_read($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
	   
        $this->db->order_by('id DESC');
      //  $this->db->where('status', 'inactive');
        $this->db->where('is_read', '0');
		return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}
  
  
  
  	public function get_no_read_a($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
	   
        $this->db->order_by('id DESC');
      //  $this->db->where('status', 'inactive');
        $this->db->where('is_read_a', '0');
        $this->db->where('user_id', $this->session->userdata('user_id'));
		return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}
  
  	public function get_messages($args = null)
	{	
	 $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);
		   	$q = array_merge($defaults, $args);
    $this->db->order_by('id DESC');
    //$this->db->where('status', 'active');   
    $this->db->where('user_id_question', $this->session->userdata('user_id'));
   	return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}
  
  	public function get_messages_respondent($args = null)
	{		
	  $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
      
            
		);
    	$q = array_merge($defaults, $args);
		   
    $this->db->order_by('id DESC');
    //$this->db->where('status', 'inactive');
    $this->db->where('user_id', $this->session->userdata('user_id'));   
    	return $this->db->get('faq', $q['limit'], $q['offset'])->result();
	}
   
    
    	public function get_all_faq_1()
	{
        $this->db->order_by('id DESC');        
		return $this->db->get('faq')->result();
	}

	public function get_by_id($id)
	{
		$faq = $this->db->get_where('faq', array('id'=>$id))->row();

		return $faq;
	}
	
	public function get_view($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('faq')->result();
	}
    
    public function get_media_files($id)
	{
		$this->db->where('cat_id', $id)
				 ->order_by('sort_order');

		return $this->db->get('media')->result();
	}


    public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('faq', $data);
		}
		else
			$this->db->insert('faq', $data);
	}
  
   public function save_img($data, $id)
	{
		$this->db->where('user_id_question', $id)
					   ->update('faq', $data);
		
	
	}
  
   public function save_img_a($data, $id)
	{
		$this->db->where('user_id', $id)
					   ->update('faq', $data);
		
	
	}
	function delete($id)
	{
		$this->db->delete('faq', array('id'=>$id));
	}
    
        public function get_faq_count($group) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM faq AS p
                WHERE p.status = '".$group."'";
            return $this->db->query($sql)->row('count');
	}
  
      public function get_blog($status, $id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM faq AS p
                WHERE p.status = '".$status."'
                AND p.user_id_question = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
  
    public function get_faq_id() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM faq AS p
                WHERE p.id";
            return $this->db->query($sql)->row('count');
	}
  
  
   public function get_new_message($group = '0') {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM faq AS p
                WHERE p.is_read = '".$group."'";
            return $this->db->query($sql)->row('count');
	}
  // Количество вопросов ответчика
   public function get_new_message_q($user_id, $group = '0') {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM faq AS p
                WHERE p.is_read = '".$group."'
                AND p.user_id = '".$user_id."'";
            return $this->db->query($sql)->row('count');
	}
  
  public function get_message() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM faq AS p
                 WHERE p.user_id_question = '".$this->session->userdata('user_id')."'
                ";
            return $this->db->query($sql)->row('count');
	}
  
  public function get_new_message_a() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM faq AS p
                WHERE p.user_id = '".$this->session->userdata('user_id')."'
                AND p.is_read_a = '0'";
            return $this->db->query($sql)->row('count');
	}

}