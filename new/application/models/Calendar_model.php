<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {


/*Read the data from DB */
	Public function getEvents()
	{
		
	/*$sql = "SELECT * FROM events WHERE events.date BETWEEN ? AND ? ORDER BY events.date ASC";
	return $this->db->query($sql, array($_GET['start'], $_GET['end']))->result();*/
    $sql = "SELECT id,title,color,content,created_on,date_creation,alias FROM posts  WHERE posts.created_on BETWEEN ? AND ? AND posts.group = 'calendar' ORDER BY posts.created_on ASC";
	return $this->db->query($sql, array($_GET['start'], $_GET['end']))->result();
/*$this->db->select('posts.id,posts.title,posts.created_on,posts.content,posts.color,posts.date_creation')
				 //->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 //->join('categories', 'categories.category_id = posts.category_id', 'left')
            ->where('posts.group', 'calendar')
            ->where('status', 'active')
            ->where('posts.created_on >', $_GET['start'])
            ->where('posts.created_on <', $_GET['end'])
           ->order_by('posts.id');
        
        return $this->db->get('posts')->result();*/

	}

/*Create new events */

	Public function addEvent()
	{
    $title = serialize($this->input->post('title'));
    $description = serialize($this->input->post('content'));
	$sql = "INSERT INTO events (title,events.date, description, color) VALUES (?,?,?,?)";
	$this->db->query($sql, array($title, $_POST['date'],  $description, $_POST['color']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

	/*Update  event */

	Public function updateEvent()
	{
    $title = serialize($this->input->post('title'));
    $description = serialize($this->input->post('description'));
	$sql = "UPDATE events SET title = ?, events.date = ?, description = ?, color = ? WHERE id = ?";
	$this->db->query($sql, array($title, $_POST['date'],  $description, $_POST['color'], $_POST['id']));
		return ($this->db->affected_rows()!=1)?false:true;
	}


	/*Delete event */

	Public function deleteEvent()
	{

	$sql = "DELETE FROM events WHERE id = ?";
	$this->db->query($sql, array($_GET['id']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

	/*Update  event */

	Public function dragUpdateEvent()
	{
			$date=date('Y-m-d h:i:s',strtotime($_POST['date']));

			$sql = "UPDATE posts SET  posts.created_on = ? WHERE id = ?";
			$this->db->query($sql, array($date, $_POST['id']));
		return ($this->db->affected_rows()!=1)?false:true;


	}
    
    	public function get_calendar_date($args = null)
	{
		$defaults = array(
			'group' => 'video',
		//	'category_id' => array(),
       'category_id' => '',
       'id' => '',
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
            'spec' => '',
            'direction' => '',
            'spec_type' => '',
            'keywords' => '',
            'description' => '',
            'meta_title' => '',
            'category' => '',     
             'option' => '',
             'views' => '',
             'sort_order' => '',  
              'not_like_id' => '',  
              'date' => '',
                 'not_like_cat_id' => '',         
            'category_direction' => ''
            
		);

		$q = array_merge($defaults, $args);

		$this->db->select('posts.*, media.url, categories.title as category, categories.alias as category_alias')
				 ->join('media', 'posts.id = media.post_id AND media.is_main = \'1\'', 'left')
				 ->join('categories', 'categories.category_id = posts.category_id', 'left')
				 ->where('posts.group', $q['group'])
                                  
        // ->where('posts.category_id', $q['category_id'])
				 ->group_by('posts.id');
                 
                
                 
                 if ( !empty($q['date']) ){
			$this->db->like('posts.created_on', $q['date']);
            }

        if(!empty($q['status']))
            $this->db->where('posts.status', $q['status']);
        /*else
            $this->db->where('posts.status !=', 'draft');*/

		if ( !empty($q['category_id']) )
			$this->db->where_in('posts.category_id', $q['category_id']);
      
      if ( !empty($q['not_like_id']) )
			$this->db->not_like('posts.id', $q['not_like_id']);
      
       if ( !empty($q['not_like_cat_id']) )
			$this->db->not_like('posts.id', $q['not_like_cat_id']);
      
       if ( !empty($q['id']) )
			$this->db->where_in('posts.id', $q['id']);


		if ( !empty($q['orderby']) )
			$this->db->order_by($q['orderby'], $q['order']);
      
        if ( !empty($q['sort_order']) )
			$this->db->order_by('sort_order', $q['sort_order']);

		if ($date = $this->input->get('date')) {
			$this->db->where('time >=', $date.' 00:00:00')
		             ->where('time <=', $date.' 23:59:59');
        }

		return $this->db->get('posts', $q['limit'], $q['offset'])->result();
	}






}