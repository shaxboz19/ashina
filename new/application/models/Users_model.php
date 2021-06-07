<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model 
{  
	public function check_user($username, $password)
	{
		$this->db->where("(username = '$username' OR email = '$username' OR phone = '$username')")
		         ->where('password', $password)
             ->where('active', '1');
		return $this->db->get('users')->row();
	}
    function getUserByLogin($username, $password) {        
        $this->db->where("(username = '$username' OR email = '$username' OR phone = '$username')")
            ->where('active', '1');
        $result = $this->getUsers($password);
    
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public function get_users_count_admin_social($group) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM users AS p
            WHERE p.user_type_social = '".$group."'
            AND p.user_id";
            return $this->db->query($sql)->row('count');
	}
    public function get_list_social($args = null)
    {
      
      $defaults = array(
			'user_type_social' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'user_id',
            'status' => '',            
            
		);

	@$q = array_merge($defaults, $args);
      
        $this->db->where('user_type_social', $q['user_type_social']);
                 //->order_by('user_id DESC');
                 	if ( !empty($q['orderby']) ){
			$this->db->order_by($q['orderby'], $q['order']);
      }
        return $this->db->get('users', $q['limit'], $q['offset'])->result();
    }
    function getUsers($password) {
        $query = $this->db->get('users');
    
        if ($query->num_rows() > 0) {
    
            $result = $query->row_array();
    
            if ($this->bcrypt->check_password($password, $result['password'])) {
               
                return $result;
            } else {
               
                return array();
            }
    
        } else {
            return array();
        }
}
	/*function getUserByLogin($username, $password) {        
        $result = $this->db->where("(username = '$username' OR email = '$username')")
    				->where('active', '1');
        //$result = $this->getUsers($username, $password);
        $pass = $result->row_array();
        if ($this->bcrypt->check_password($password, $pass['password'])) {               
            return $result->row();
        } else {
            return NULL;
        }
    }*/
   /* function getUsers($username, $password) {
        $query = $this->db->get('users');
        $query->where("(username = '$username' OR email = '$username')");
        if ($query->num_rows() > 0) {
    
            $result = $query->row_array();
    
            if ($this->bcrypt->check_password($password, $result['password'])) {
               
                return $result;
            } else {
               
                return array();
            }
    
        } else {
            return array();
        }
    }*/
	
  public function check_user_active($id)
	{
		$this->db->where('user_id', $id);             
		return $this->db->get('users')->row();
	}
   public function get_list($args = null)
    {
      
      $defaults = array(
      'user_type' => '',
      'limit' => 10000,
      'offset' => 0,
      'order' => 'DESC',
      'orderby' => 'user_id',
            'status' => '',
            'active' => '',            
            
    );

    @$q = array_merge($defaults, $args);
      
        $this->db->where('user_type', $q['user_type']);
                 //->order_by('user_id DESC');
                   if ( !empty($q['orderby']) ){
      $this->db->order_by($q['orderby'], $q['order']);
      }
       if ( !empty($q['active']) ){
        $this->db->where_in('active', $q['active']);
       }
        return $this->db->get('users', $q['limit'], $q['offset'])->result();
    }
    public function get($user_id)
    {
        return $this->db->get_where('users', array('user_id'=>$user_id))->row();
    }
    	public function get_id($alias)
	{
		$post = $this->db->get_where('users', array('username'=>$alias))->row();

		if ($post)
			return $post->user_id;
		else
			return show_404();
	}
   /* public function save($data, $user_id)
    {
        if($user_id)
            $this->db->update('users', $data, array('user_id'=>$user_id));
        else
            $this->db->insert('users', $data);
    }*/
    public function get_users_count_admin($group) {
    $sql = "SELECT
            COUNT(*) AS count
            FROM users AS p
            WHERE p.user_type = '".$group."'
            AND p.user_id";
            return $this->db->query($sql)->row('count');
  }
  public function get_users_count_active($group) {
    $sql = "SELECT
            COUNT(*) AS count
            FROM users AS p
            WHERE p.user_type = '".$group."'
            AND p.active = '1'";
            return $this->db->query($sql)->row('count');
  }
     public function save_username($data_username, $id)
	{
		$this->db->where('user_id', $id)
					   ->update('posts_u', $data_username);
		
	
	}
  public function update_views($post_id ,$counter_data) {
            /* $this->db->set('views', $counter_data+1, FALSE);
             $this->db->where('id', $post_id);
             $this->db->update('posts');*/
             $this->db->query("UPDATE users SET views = $counter_data+1 WHERE user_id = $post_id");
             
             
     }
  	
  
  	public function get_users($id, $status = false) {
		$this->db->select('posts.*, media.url, categories.alias AS category')
		         ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
		         ->join('categories', 'posts.category_id = categories.category_id', 'left')
		         ->where('posts.id', $id);
        if($status)
            $this->db->where('posts.status', $status);

		return $this->db->get('posts')->row();
	}
  
    public function delete($user_id)
    {
        $this->db->delete('users', array('user_id'=>$user_id));
    }
  /*    public function delete_img($img)
    {$this->db->where('img', $img);
  $this->db->delete('users');
    }
     public function delete_img($img)
    {$this->db->where('img', $img);
  $this->db->delete('users');
    }*/   
    	public function delete_img($img)
	{
			@unlink( "./uploads/admin/{$img}" );
		}
  	public function delete_profile_img($img)
	{
			@unlink( "./uploads/profile/{$img}" );
		}
    public function user_email($email)
	{
		return $this->db->get_where('users',array('email' => $email))->row();
	}
  
   public function user_newsletter()
	{
		return $this->db->get_where('users',array('user_sub' => 'subscriber'))->result();
	}
  
	public function save($data, $user_id=false)
	{
		if($user_id){
			$this->db->update('users', $data, array('user_id'=>$user_id));
			return $this->db->get_where('users',array('user_id'=>$user_id))->row();
		}
		else{
			$this->db->insert('users', $data);
			$user = $this->db->get_where('users',array('user_id'=>$this->db->insert_id()))->row();
		//	$this->db->insert('user_settings',array('user_id'=>$this->db->insert_id(),'subscribe' => $this->input->post('subscribe')));
			return $user;
		}
	}
	public function change_pass($code,$data)
	{
		$this->db->update('users', $data, array('activation_code' => $code));
		return $this->db->affected_rows();
	}
	public function delete_user($data)
	{
		$this->db->update('users',$data['update'], array('user_id' => $data['update']['user_id']));
		$this->db->insert('deleted_users', $data['insert']);
	}
	public function activate($activation_code, $phone=false)
	{
		if($phone)
			$this->db->set('phone_verified','1');
		else
			$this->db->set('email_verified','1');
			$this->db->set('active','1')
				 ->set('activation_code','')         
				 ->where('activation_code',$activation_code)        
				 ->update('users');
		$user = $this->db->get_where('users',array('user_id' => $this->session->userdata('user_id') ))->row();
		return $user;
	}
  
  	public function activate_user($activation_code, $id, $phone=false)
	{
		if($phone)
			$this->db->set('phone_verified','1');
		else
			$this->db->set('email_verified','1');
			$this->db->set('active','1')
				 ->set('activation_code','')         
				 ->where('activation_code',$activation_code)        
				 ->update('users');
		$user = $this->db->get_where('users',array('user_id' => $id ))->row();
		return $user;
	}
	/*public function user_exists($data)
	{
		return $this->db->join('user_settings','user_settings.user_id=users.user_id')
						->get_where('users',array('social_id'=> $data['social_id']))->row();
	}*/
  	public function user_exists($data)
	{
		return $this->db->get_where('users',array('social_id'=> $data['social_id']))->row();
	}
	public function save_notifications($data)
	{
		$this->db->update('user_settings', $data, array('user_id'=>$this->session->userdata('user_id')));
	}
	public function save_car($data, $id=false,$car_id=false)
	{
		if($id)
			$this->db->update('cars', $data, array('user_id' => $id,'id'=>$car_id));
		else
			$this->db->insert('cars', $data);
	}
	public function get_cars($user_id)
	{
		return $this->db->get_where('cars',array('user_id' => $user_id))->result();
	}
	public function get_car($id)
	{
		return $this->db->get_where('cars',array('id' => $id))->row();
	}
	public function delete_car($id)
	{
		$this->db->delete('cars',array('id' => $id));
	}
	public function save_alert($data,$id=false)
	{
		/*if($id){
			$this->db->update('email_alerts', $data, array('id'=>$id));
			return $this->db->get_where('email_alerts',array('id'=>$id))->row();
		}
		else{
			$this->db->insert('email_alerts', $data);
			return $this->db->get_where('email_alerts',array('id'=>$this->db->insert_id()))->row();
		}*/
	}
	public function get_alerts($id)
	{
		return $this->db->order_by('id','desc')
						->get_where('email_alerts',array('user_id'=>$id))->result();
	}
	public function delete_alert($id)
	{
		$this->db->delete('email_alerts',array('id'=>$id));
	}
	public function save_messages($data, $where=false)
	{
		if($where){
			$this->db->update('messages', $data, $where);
		}
		else
		{
			$this->db->insert_batch('messages',$data);
		}
	}
	public function get_messages($user_id,$type=false, $response=false)
	{
	/*	$this->db->join('rides', 'rides.id=messages.ride_id');
		if($type=='archive'){
			$this->db->join('users','users.user_id=messages.user_from')
					 ->where('messages.owner_id',$user_id)
					 ->where('messages.archive','1')
					 ->group_by('messages.ride_id')
					 ->select('messages.*,rides.*,users.*, COUNT(messages.id) as count');
		}
		elseif($type=='unread'){
			$this->db->join('users','users.user_id=messages.user_from')
					 ->where('messages.is_read','0')
					 ->where('messages.user_to',$user_id)
					 ->where('messages.owner_id',$user_id);
		}
		elseif($type=='sent'){
			$this->db->join('users','users.user_id=messages.user_to')
					 ->where('messages.owner_id',$user_id)
					 ->where('messages.user_from',$user_id)
					 ->where('messages.archive','0')
					 ->group_by('messages.ride_id')
					 ->group_by('messages.user_to')
					 ->select('messages.*,rides.*,users.*, COUNT(messages.id) as count');
		}
		else{
			$this->db->join('users','users.user_id=messages.user_from')
					 ->where('messages.owner_id', $user_id)
					 ->where('messages.user_to', $user_id)
					 ->where('messages.archive','0')
					 ->group_by('messages.ride_id')
					 ->group_by('messages.user_from')
					 ->select('messages.*,rides.*,users.*, COUNT(messages.id) as count, count(case when messages.is_read="0" then messages.id else null end) as c_isread');
		}
		return $this->db->get('messages')->result();*/
	}
	public function delete_message($where)
	{
		/*$this->db->where('ride_id',$where['ride_id'])
				 ->where('owner_id',$where['owner_id'])
				 ->where('(user_from = '.$where['int_id'].' or user_to = '.$where['int_id'].')')
				 ->delete('messages');*/
	}
	public function archive_message($data,$where)
	{
		/*$this->db->where('ride_id',$where['ride_id'])
				 ->where('owner_id',$where['owner_id'])
				 ->where('(user_from = '.$where['int_id'].' or user_to = '.$where['int_id'].')')
				 ->update('messages',$data);*/
	}
	public function get_conversation($ride_id,$user)
	{
		/*$this->db->join('rides', 'rides.id=messages.ride_id')
				 ->join('users','users.user_id=messages.user_from')
				 ->where('messages.ride_id',$ride_id)
				 ->where('messages.owner_id',$this->session->userdata('user_id'))
				 ->where('(messages.user_from = '.$user.' or messages.user_to = '.$user.')')
				 ->order_by('messages.send_time')
				 ;
		return $this->db->get('messages')->result();*/
	}
	public function save_rating($data)
	{
		$this->db->insert('ratings',$data);
	}
	public function get_left_ratings($from)
	{
		$this->db->where('ratings.rate_from',$from)
				 ->join('users','users.user_id=rate_to');
		return $this->db->get('ratings')->result();
	}
	public function get_received_ratings($to)
	{
		$this->db->where('ratings.rate_to',$to)
				 ->join('users','users.user_id=rate_from');
		return $this->db->get('ratings')->result();
	}
	public function find_member($phone)
	{
		$this->db->where('phone', $phone);
		return $this->db->get('users')->row();
	}
	public function get_m_users($id)
	{
	/*	$this->db->select('users.*, messages.*, u.first_name as f_name, u.last_name as l_name, rides.*')
				 ->join('users','users.user_id=messages.user_from')
				 ->join('users as u','u.user_id=messages.user_to')
				 ->join('rides','rides.id=messages.ride_id')
				 ->where('messages.user_from',$id)
				 ->or_where('messages.user_to',$id)
				 ->group_by('messages.ride_id');
		return $this->db->get('messages')->result();*/
	}
	public function get_admin_conversation($ride_id, $user1, $user2, $limit=100000,$offset=false)
	{
	/*	$this->db->join('rides', 'rides.id=messages.ride_id')
				 ->join('users','users.user_id=messages.user_from')
				 ->where('messages.ride_id',$ride_id)
				 ->where('(messages.user_from = '.$user1.' or messages.user_to = '.$user1.')')
				 ->where('(messages.user_from = '.$user2.' or messages.user_to = '.$user2.')')
				 ->order_by('messages.send_time');
		return $this->db->get('messages',$limit, $offset)->result();*/
	}
	public function get_photos()
	{
		return $this->db->where('user_type !=','admin')
						->where('photo_approved','0')
						->where('picture !=','')
						->get('users')->result();
	}
	public function get_by_search($name)
	{
		$this->db->like('first_name',$name)
				 ->or_like('last_name',$name)
				 ->where('user_type !=','admin');
		return $this->db->get('users')->result();
	}
	public function save_visitor($data)
	{
		$sql = $this->db->insert_string('visitors', $data) . ' ON DUPLICATE KEY UPDATE visits=visits+1,visit_date=CURRENT_TIMESTAMP';
		$this->db->query($sql);
		$id = $this->db->insert_id();
	}
	public function get_visitors($id,$limit=10000)
	{
		$this->db->select('visitors.*,users.*,v.sum')
				 ->join('users','users.user_id=visitors.user_id')
				 ->join('(SELECT SUM(visits) as sum FROM visitors) as v','true')
				 ->where('visitors.ride_id',$id)
				 ->order_by('visitors.visit_date','DESC');
		return $this->db->get('visitors',$limit)->result();
	}
      public function user_phone($phone)
	{
		return $this->db->get_where('users',array('phone' => $phone))->row();
	}
}