<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model
{    
    
public $table = 'comments'; //Имя таблицы	
public $idkey = 'comment_id'; //Имя ID

//правила для добавления комментариев
public $add_rules = array
(                   
    array
    (
      'field' => 'author',
      'label' => 'Имя',
      'rules' => 'trim|required|xss_clean|max_length[70]'
    ),        
    array
    (
      'field' => 'comment_text',
      'label' => 'Текст комментария',
      'rules' => 'required|xss_clean|max_length[5000]'
    )
);


//правила для обновления комментариев
public $update_rules = array
(
    array
    (
      'field' => 'author',
      'label' => 'Имя',
      'rules' => 'trim|required|max_length[70]'
    ),
    array
    (
      'field' => 'comment_text',
      'label' => 'Текст комментария',
      'rules' => 'required|max_length[5000]'
    )
);
    public function get($comment_id)
    {
        $this->db->where ('comment_id',$comment_id);
        $query = $this->db->get('comments');
        return $query->row();
    }

    public function get_by($material_id)
    {
        $this->db->order_by ('comment_id','desc');
        $this->db->where ('post_id',$material_id);
        $query = $this->db->get('comments');
        return $query->result();
    }

 public function get_main_comments($args = null)
    {
      
      $defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'comment_id',
      'post_id' => '',
            'status' => '',
      
            
		);

		$q = array_merge($defaults, $args);
      
        $this->db->order_by ($q['orderby'],$q['order']);
         if(!empty($q['post_id'])){
        $this->db->where ('post_id',$q['post_id']);
        }
         $this->db->where ('status', $q['status']);        
        return $this->db->get('comments', $q['limit'], $q['offset'])->result();
    }
    
    public function get_active_comments($args = null)
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
      
        $this->db->order_by ('comment_id','desc');    
         $this->db->where ('status', 'active');        
        return $this->db->get('comments', $q['limit'], $q['offset'])->result();
    }
    
     public function get_active_comments_not_like($args = null)
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
      
        $this->db->order_by ('comment_id','desc');    
         $this->db->where ('status', 'active');     
         $this->db->like ('config_id', 0);    
        return $this->db->get('comments', $q['limit'], $q['offset'])->result();
    }
    
    public function get_admin_comments($args = null)
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
      
        $this->db->order_by ('comment_id','desc');                     
        return $this->db->get('comments', $q['limit'], $q['offset'])->result();
    }
    
    public function get_view_comments($args = null)
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
      
        $this->db->order_by ('comment_id','desc');   
        $this->db->where ('post_id',$q['post_id']);                  
        return $this->db->get('comments', $q['limit'], $q['offset'])->result();
    }


    public function save($data, $id)
    {
        if ($id)
        {
            $this->db->where('comment_id', $id)
                ->update('comments', $data);
        }
        else
            $this->db->insert('comments', $data);
    }


    public function add_new($comment_data) {
        $id = $this->db->insert('comments',$comment_data);
        return $id;
    }


    public function get_all($limit,$start_from) {
        $this->db->order_by('comment_id','desc');

        //ограничиваем запрос к базе двумя параметрами
        $this->db->limit($limit,$start_from);
        $query = $this->db->get('comments');

        return $query->result();
    }

    public function delete($id) {
        $this->db->where('comment_id', $id)
            ->delete('comments');
    }
    
     public function get_comments_count($group) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM comments AS p
                WHERE p.status = '".$group."'";
            return $this->db->query($sql)->row('count');
	}
  
   public function get_comments_count_option($group, $id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM comments AS p
                WHERE p.status = '".$group."'
                AND p.config_id = '".$id."'";
            return $this->db->query($sql)->row('count');
	}
  
  public function get_comments_id() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM comments AS p
                WHERE p.comment_id";
            return $this->db->query($sql)->row('count');
	}
  
  public function get_comments_id_view($id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM comments AS p
                WHERE p.comment_id
                 AND p.post_id = $id";
            return $this->db->query($sql)->row('count');
	}
    
    public function getComments_view($id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM comments AS p
                WHERE p.status = 'active'
                 AND p.post_id = $id";
            return $this->db->query($sql)->row('count');
	}

}
?>