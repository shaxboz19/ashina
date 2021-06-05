<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lang_model extends CI_Model
{
    public function get_list($args = null)
    {
      $defaults = array(
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',            
		);
    	@$q = array_merge($defaults, $args);
       	if ( !empty($q['orderby']) ){
			$this->db->order_by($q['orderby'], $q['order']);
        }
      return $this->db->get('lang', $q['limit'], $q['offset'])->result();
    }
     public function get_category($args = null)
    {
      $defaults = array(
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'category_id' => '', 
            'like' => '',
            'table' => '', 
            'field' => '',          
		);
    	@$q = array_merge($defaults, $args);
       	if ( !empty($q['orderby']) ){
			$this->db->order_by($q['orderby'], $q['order']);
        }
        if ( !empty($q['category_id']) ){
			$this->db->where_in($q['table'].'.category_id', $q['category_id']);
            }
            if ( !empty($q['like']) ){
			$this->db->where($q['table'].''.$q['field'], $q['like']);
            }
      return $this->db->get($q['table'], $q['limit'], $q['offset'])->result();
    }
    public function save($data, $id = false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('lang', $data);
		}
		else
		{
			$this->db->insert('lang', $data);
			return $this->db->insert_id();
		}
	}
    public function save_lang_token($data, $id = false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('lang_token', $data);
		}
		else
		{
			$this->db->insert('lang_token', $data);
			return $this->db->insert_id();
		}
	}
    public function save_category($data, $id = false)
	{
		if ($id)
		{
			$this->db->where('id', $id)
					 ->update('lang_category', $data);
		}
		else
		{
			$this->db->insert('lang_category', $data);
			return $this->db->insert_id();
		}
	}
    public function save_c($data, $id = false)
	{
		if ($id)
		{
			$this->db->where('category_id', $id)
					 ->update('lang_category', $data);
		}
		else
		{
			$this->db->insert('lang_category', $data);
			return $this->db->insert_id();
		}
	}
    public function lang_count() {
		$sql = "SELECT
            COUNT(*) AS `count`
            FROM lang AS p
            WHERE p.id";
            return $this->db->query($sql)->row('count');
	}
    public function get($id)
    {
        return $this->db->get_where('lang', array('id'=>$id))->row();
    }
    public function get_lang_token($id)
    {
        return $this->db->get_where('lang_token', array('id'=>$id))->row();
    }
   	public function delete($id)
	{
		$this->db->where('id', $id)
		         ->delete('lang');
	}
    public function delete_token_lang($id)
	{
		$this->db->where('id', $id)
		         ->delete('lang_token');
	}
    public function delete_category($id)
	{
		$this->db->where('category_id', $id)
		         ->delete('lang_category');
	}
    public function has_alias($alias, $post_id)
	{
		$this->db->where('alias', $alias)
		         ->where('id !=', $post_id);
		return $this->db->get('lang')->row();
	}
     public function has_token($alias, $post_id)
	{
		$this->db->where('description', $alias)
		         ->where('id !=', $post_id);
		return $this->db->get('lang_token')->row();
	}
}