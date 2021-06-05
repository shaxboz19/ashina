<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_category_model extends CI_Model
{
	public function get_cats($group=FALSE, $parent=false)
	{
		if ($group)
			$this->db->where('group', $group);
		if($parent)
			$this->db->where('parent_id', $parent);

		return $this->db->get('categories')->result();
	}

    public function get_albums_with_singer(){
        return $this->db->query('SELECT categories.*, singers.name FROM singers, categories WHERE singers.category_id = categories.singer_id AND  categories.group = "albums" ORDER BY singers.name')->result();

    }

	public function get_id($alias)
	{
		$category = $this->db->get_where('categories', array('alias'=>$alias))->row();

		if ($category)
			return $category->category_id;
		else
			return show_404();
	}

	public function save($data, $id)
	{
		if ($id)
		{
			$this->db->where('category_id', $id)
					 ->update('categories', $data);
		}
		else
			$this->db->insert('categories', $data);
	}

	function delete($id)
	{
		$this->db->delete('categories', array('category_id'=>$id));
	}

	public function get($id) {
		return $this->db->get_where('categories', array('category_id'=>$id))->row();
	}

	public function get_children_by_parent_alias($parent_alias) {
		$category_id = $this->get_id($parent_alias);

		$child_categories = $this->db->get_where('categories', array('parent_id'=>$category_id))->result();

		foreach ($child_categories as $children)
		{
			$cat_list[] = $children->category_id;
		}

		return $cat_list;
	}
  public function get_by_alias($alias)
	{
		$category = $this->db->get_where('categories', array('alias'=>$alias))->row();

		if ($category)
		{
			$this->db->where('parent_id', $category->category_id)
		         ->or_where('category_id', $category->category_id);

        	return $this->db->get('categories')->result();
		}	
	}

}