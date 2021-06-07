<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {
    
   public function get_all()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}
    
public function get($id)
    {
        $this->db->where ('id',$id);
        $query = $this->db->get('cart_u');
        return $query->row();
    }
    
     public function save($data, $id)
    {
        if ($id)
        {
            $this->db->where('id', $id)
                ->update('cart_u', $data);
        }
        else
            $this->db->insert('cart_u', $data);
    }
    
      public function save_payment($data, $id)
    {
        if ($id)
        {
            $this->db->where('cart_u_id', $id)
                ->update('cart_payment', $data);
                
        }
        else
            $this->db->insert('cart_payment', $data);
            	$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;	
    }
    
     public function save_cart($data, $id)
    {
        if ($id)
        {
            $this->db->where('id', $id)
                ->update('cart', $data);
        }
        else
            $this->db->insert('cart', $data);
    }

	public function insert_customer($data)
	{
		$this->db->insert('cart_u', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
  
  	public function insert_customer_payment($data)
	{
		$this->db->insert('cart_payment', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	
        // Insert order date with customer id in "orders" table in database.
/*	public function insert_order($data)
	{
		$this->db->insert('cart', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}*/
	
        // Insert ordered service detail in "order_detail" table in database.
	public function insert_order_detail($data)
	{
		$this->db->insert('cart', $data);
	}
  
  	public function payment_log($data)
	{
		$this->db->insert('payment_log', $data);
	}
  
  
  
   public function get_admin_cart($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
      'post_id' => '',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
      
        $this->db->order_by ('id','desc');                     
        return $this->db->get('cart_u', $q['limit'], $q['offset'])->result();
    }
    
     public function get_user_cart($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
      'post_id' => '',
      'user_id' => '',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
      
        $this->db->order_by ('id','desc');  
        $this->db->where ('user_id',$q['user_id']);                    
        return $this->db->get('cart_u', $q['limit'], $q['offset'])->result();
    }
    
     public function get_view($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
      'cart_u_id' => '',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
      
        $this->db->order_by ('id','desc');   
        $this->db->where ('cart_u_id',$q['cart_u_id']);                  
        return $this->db->get('cart', $q['limit'], $q['offset'])->result();
    }

    
     public function get_cart_id() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM cart_u AS p
                WHERE p.id";
            return $this->db->query($sql)->row('count');
	}
  
   public function get_user_cart_id() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM cart_u AS p
                WHERE p.user_id = ".$this->session->userdata('user_id')."";
            return $this->db->query($sql)->row('count');
	}
  
   public function count_cart_id($id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM cart AS p
                WHERE p.cart_u_id = $id";
            return $this->db->query($sql)->row('count');
	}
  
  
  
   public function delete($id) {
        $this->db->where('id', $id)
            ->delete('cart_u');
    }
    public function delete_cart($id) {
        $this->db->where('cart_u_id', $id)
            ->delete('cart');
    }
       
}