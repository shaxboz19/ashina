<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_model extends CI_Model
{
	public function get_list()
	{
		$this->db->select('*');
        $this->db->where_in('file_status','active')                
				 ->order_by('id DESC');

		return $this->db->get('requests')->result();
	}

    function randomNumber($length) {
        $min = 1 . str_repeat(0, $length-1);
        $max = str_repeat(9, $length);
        return mt_rand($min, $max);
    }
    
    public function get_list_v2($args = null)
	{
	   
       $defaults = array(
			'limit' => 100000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',   
            'file_status' => '',  
            'date' => ''       
		);
        @$q = array_merge($defaults, $args);
	
        $this->db->where_in('file_status', $q['file_status']) 
                       
				 ->order_by('id DESC');
                 
                  if ( !empty($q['date']) ){
        $this->db->where('YEAR(requests.created_on)',  $q['date']);
        }
        if ( !empty($q['show']) ){
        $this->db->where('DATE(requests.created_on)',  $q['show']);
        }

	return $this->db->get('requests', $q['limit'], $q['offset'])->result();
	}
     public function get_list_admin($args = null)
    {
      $defaults = array(
			'limit' => 100000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',   
            'file_status' => '',         
		);
    	@$q = array_merge($defaults, $args);
        
        
        if ( !empty($q['status']) ){
			$this->db->where('status', $q['status']);
            $this->db->not_like('file_status', $q['file_status']);
        }
       	if ( !empty($q['orderby']) ){
			$this->db->order_by($q['orderby'], $q['order']);
        }
      return $this->db->get('requests', $q['limit'], $q['offset'])->result();
    }
     public function request_count_status($field, $options) {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM requests AS p
            WHERE p.$field = '".$options."'
            AND  p.file_status ='active'
            AND p.id";
            return $this->db->query($sql)->row('count');
	}
    
    	public function status_request()
	{
		$this->db->select('*');
        $this->db->where_in('file_status','active')                
				 ->order_by('id DESC');

		return $this->db->get('requests')->result();
	}

	public function get($id)
	{
		return $this->db->get_where('requests', array('id'=>$id, 'file_status' => 'active'))->row();
	}

	public function get_history_requests($id, $request)
	{
		$this->db->where('id !=', $id)
		         ->where('email', $request->email);

        return $this->db->get('requests')->result(); 
	}

    public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('requests', $data);
		}
		else
		{
			$this->db->insert('requests', $data);

			return $this->db->insert_id();
		}
	}
    
      public function save_2($data)
	{
		
			$this->db->insert('requests', $data);

			return $this->db->insert_id();
		
	}

    function check_cid_id($id, $cid) {
        $this->db->where(array(
            'id' => $id,
            'cid' => $cid
        ));
        $data = $this->db->get('requests')->result();
        return $data;
    }
 
 
     public function save_media($data, $id = FALSE)
	{
		if ($id)
		{
			$this->db->where('id_image', $id)
					 ->update('media_request', $data);
		}
		else
		{
			$this->db->insert('media_request', $data);

			return $this->db->insert_id();
		}
	}
    public function get_media_files($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
				 ->order_by('sort_order');

		return $this->db->get('media_request', $limit, $offset)->result();
	
    }
    public function get_inactive_img($id, $limit = 10000, $offset = 0)
	{
		$this->db->where('post_id', $id)
                ->where('status_m', 'inactive');
        
		return $this->db->get('media_request', $limit, $offset)->result();
	
    }
    
    public function get_inactive_docs($id)
	{
		$this->db->where('post_id', $id)
                ->where('status_m', 'inactive');
        
		return $this->db->get('media_request')->result();
	
    }
    
	public function delete($id)
	{
        $data = $this->get($id);              
		$this->db->delete('requests', array('id'=>$id));
	}
    
    public function get_doc($data){
        $post_request = $this->session->userdata('requests_id');
        $data = array_merge($data, array('status_m'=>'inactive', 'post_id' => $post_request));
        
        $result = $this->db->get_where('media_request', $data)->row();
        return $result;
    }
    
    public function remove_doc($data)
	{    
          $doc = $this->get_doc($data);
     	  @unlink( "./uploads/requests/".$doc->url );
          return $this->db->delete('media_request', array('id_image' => $doc->id_image));

	}
    
    public function clear_inactive_requests(){
        $all_inactive_req = $this->db->get_where('requests', array('file_status' => 'inactive'))->result();
        //echo '<pre>'.var_dump($all_inactive_req).'</pre>';
        foreach($all_inactive_req as $item){
            $req_docs = $this->get_inactive_docs($item->id);
            foreach($req_docs as $doc){
                @unlink( "./uploads/requests/".$doc->url );
                $this->db->delete('media_request', array('id_image' => $doc->id_image, 'status_m' => 'inactive'));
            }
            $this->db->delete('requests', array('id' => $item->id, 'file_status' => 'inactive'));
            
        }
    }

	
}