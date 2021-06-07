<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calendar extends Public_Controller {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Calendar_model');
        //$this->load->model('posts_model');
    }
	/* Вывод календаря в админке, можно менять дату перетаскиванием */
	Public function index()
	{
        $this->data['sel'] = 'calendar';
        $this->data['body'] = 'admin/calendar/index_2';
        $this->load->view('admin/index', $this->data);
	}
    // Вывод всех данных по дате
    Public function getDate()
	{
        $this->data['sel'] = 'calendar';
        $date = to_date("Y-m-d", $this->input->post('date'));;	
     	$this->data['calendar'] = $this->Calendar_model->get_calendar_date( array('group'=>'calendar', 'date' => $date, 'status' => 'active') );  
        
        if($this->input->post('day')){
            $this->data['day'] = 'day';
        }
       
        $this->load->view('public/pages/calendar_ajax', $this->data);
	}
    
    public function event_view($id)
    {
      
      	if(getPosts($id, 'group') == 'calendar'){
      	$lookbook = $this->posts->get( $id );      	
      	$this->data['post'] = $lookbook;         
              
        $this->load->view("public/pages/calendar_view_ajax",$this->data);
        }
    }
	/*Get all Events */
	Public function getEvents()
	{
		$result=$this->Calendar_model->getEvents();
        //$data[] = array();
        $i = 0; foreach($result as $item){
            $data[$i] = array(
                'id' => $item->id,
                'title' => _t($item->title, LANG),
                'description' => _t($item->content, LANG),
                //'color' => $item->color,            
                'start' => $item->created_on,
                'end' => $item->date_creation,
                'date' => $item->created_on, 
               // 'url' => site_url('calendar/'.$item->alias),           
            );
            $i++; 
        }
        if(isset($data)){
          echo json_encode($data);  
        }else{
            $no = '';
            echo json_encode($no);  
        } 
	}
	/*Add new event */
/*	Public function addEvent()
	{
		$result=$this->Calendar_model->addEvent();
		echo $result;
	}
	//Update Event 
	Public function updateEvent()
	{
		$result=$this->Calendar_model->updateEvent();
		echo $result;
	}
	//Delete Event
	Public function deleteEvent()
	{
		$result=$this->Calendar_model->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{	
		$result=$this->Calendar_model->dragUpdateEvent();
		echo $result;
	}*/
}