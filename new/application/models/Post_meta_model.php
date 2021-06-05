<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Post_meta_model extends CI_Model {
    public function get($id)
    {
        $this->db->where('meta_id',$id);
        $query = $this->db->get('post_meta');
        return $query->row();
    }
    public function get_post($id)
    {
        $this->db->where('post_id',$id);
        $query = $this->db->get('post_meta');
        return $query->row();
    }
    public function save($data, $id =FALSE)
    {
        if ($id)
        {
            $this->db->where('meta_id', $id)
                ->update('post_meta', $data);
        }
        else
            $this->db->insert('post_meta', $data);
            $id = $this->db->insert_id();
            return (isset($id)) ? $id : FALSE;	
    }	
    
    public function save_post($data, $id)
    {
        if ($id)
        {
            $this->db->where('post_id', $id)
                ->update('post_meta', $data);
        }
        else
            $this->db->insert('post_meta', $data);
            $id = $this->db->insert_id();
            return (isset($id)) ? $id : FALSE;	
    }	
   public function get_post_meta($args = null)
    {
      $defaults = array(	
			'limit' => 10000,
            'category_ids' => array(),
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'post_id' => '',
            'status' => '',            
		);
		$q = array_merge($defaults, $args);
        $this->db->order_by('meta_id','desc');   
       	if ( !empty($q['post_id']) )
		$this->db->where('post_meta.post_id', $q['post_id']);
        if ( !empty($q['category_ids']) )
			$this->db->where_in('post_meta.post_id', $q['category_ids']);
        return $this->db->get('post_meta', $q['limit'], $q['offset'])->result();
    } 
   public function delete($id) {
        $this->db->where('meta_id', $id)
                 ->delete('post_meta');
    }
}