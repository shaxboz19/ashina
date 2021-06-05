<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rides_model extends CI_Model
{
	public function save($data,$id=false)
	{
		if($id){
			$this->db->update('rides', $data, array('id'=>$id));
		}
		else{
			
			$this->db->insert_batch('rides', $data);
			return $this->db->insert_id();
		}
	}
	public function get_rides($limit=false,$user_id=false,$date=false,$past=false)
	{
		if($user_id)
			$this->db->where('users.user_id',$user_id);
		if($past)
			$this->db->where('rides.departure <',$date);
		else if($date){
			$this->db->where('rides.departure >',$date);
		}

		$this->db->join('users','users.user_id=rides.user_id','left');

		return $this->db->get('rides',$limit)->result();
	}
	public function get_by_search($search,$limit=1000000, $offset=false)
	{
		$radius = 1;
		$this->db->select('users.*,cars.*,rides.*,rides.id as ride_id,
			ABS(ABS(rides.from_nb) - '.$search["from_nb"].') as from_nb,
			ABS(ABS(rides.to_nb) - '.$search["to_nb"].') as to_nb,
			ABS(ABS(rides.from_ob) - '.$search["from_ob"].') as from_ob,
			ABS(ABS(rides.to_ob) - '.$search["to_ob"].') as to_ob,
			ABS(ABS(rides.stopover1_nb) - '.$search["from_nb"].') as stopover1_nb_from,
			ABS(ABS(rides.stopover2_nb) - '.$search["from_nb"].') as stopover2_nb_from,
			ABS(ABS(rides.stopover3_nb) - '.$search["from_nb"].') as stopover3_nb_from,
			ABS(ABS(rides.stopover4_nb) - '.$search["from_nb"].') as stopover4_nb_from,
			ABS(ABS(rides.stopover5_nb) - '.$search["from_nb"].') as stopover5_nb_from,
			ABS(ABS(rides.stopover1_ob) - '.$search["from_ob"].') as stopover1_ob_from,
			ABS(ABS(rides.stopover2_ob) - '.$search["from_ob"].') as stopover2_ob_from,
			ABS(ABS(rides.stopover3_ob) - '.$search["from_ob"].') as stopover3_ob_from,
			ABS(ABS(rides.stopover4_ob) - '.$search["from_ob"].') as stopover4_ob_from,
			ABS(ABS(rides.stopover5_ob) - '.$search["from_ob"].') as stopover5_ob_from,
			ABS(ABS(rides.stopover1_nb) - '.$search["to_nb"].') as stopover1_nb_to,
			ABS(ABS(rides.stopover2_nb) - '.$search["to_nb"].') as stopover2_nb_to,
			ABS(ABS(rides.stopover3_nb) - '.$search["to_nb"].') as stopover3_nb_to,
			ABS(ABS(rides.stopover4_nb) - '.$search["to_nb"].') as stopover4_nb_to,
			ABS(ABS(rides.stopover5_nb) - '.$search["to_nb"].') as stopover5_nb_to,
			ABS(ABS(rides.stopover1_ob) - '.$search["to_ob"].') as stopover1_ob_to,
			ABS(ABS(rides.stopover2_ob) - '.$search["to_ob"].') as stopover2_ob_to,
			ABS(ABS(rides.stopover3_ob) - '.$search["to_ob"].') as stopover3_ob_to,
			ABS(ABS(rides.stopover4_ob) - '.$search["to_ob"].') as stopover4_ob_to,
			ABS(ABS(rides.stopover5_ob) - '.$search["to_ob"].') as stopover5_ob_to',false)
				 ->join('users','users.user_id=rides.user_id')
				 ->join('cars','cars.id=rides.car_id','left')
				 ->having("(from_nb < {$radius} and from_ob < {$radius} and to_nb < {$radius} and to_ob < {$radius})")
				 ->or_having("(from_nb < {$radius} and from_ob < {$radius} and stopover1_nb_to < {$radius} and stopover1_ob_to < {$radius})")
				 ->or_having("(from_nb < {$radius} and from_ob < {$radius} and stopover2_nb_to < {$radius} and stopover2_ob_to < {$radius})")
				 ->or_having("(from_nb < {$radius} and from_ob < {$radius} and stopover3_nb_to < {$radius} and stopover3_ob_to < {$radius})")
				 ->or_having("(from_nb < {$radius} and from_ob < {$radius} and stopover4_nb_to < {$radius} and stopover4_ob_to < {$radius})")
				 ->or_having("(from_nb < {$radius} and from_ob < {$radius} and stopover5_nb_to < {$radius} and stopover5_ob_to < {$radius})")
				 ->or_having("(stopover1_nb_from < {$radius} and stopover1_nb_from < {$radius} and stopover2_nb_to < {$radius} and stopover2_ob_to < {$radius})")
				 ->or_having("(stopover1_nb_from < {$radius} and stopover1_nb_from < {$radius} and stopover3_nb_to < {$radius} and stopover3_ob_to < {$radius})")
				 ->or_having("(stopover1_nb_from < {$radius} and stopover1_nb_from < {$radius} and stopover4_nb_to < {$radius} and stopover4_ob_to < {$radius})")
				 ->or_having("(stopover1_nb_from < {$radius} and stopover1_nb_from < {$radius} and stopover5_nb_to < {$radius} and stopover5_ob_to < {$radius})")
				 ->or_having("(stopover1_nb_from < {$radius} and stopover1_nb_from < {$radius} and to_nb< {$radius} and to_ob < {$radius})")
				 ->or_having("(stopover2_nb_from < {$radius} and stopover2_nb_from < {$radius} and stopover3_nb_to < {$radius} and stopover3_ob_to < {$radius})")
				 ->or_having("(stopover2_nb_from < {$radius} and stopover2_nb_from < {$radius} and stopover4_nb_to < {$radius} and stopover4_ob_to < {$radius})")
				 ->or_having("(stopover2_nb_from < {$radius} and stopover2_nb_from < {$radius} and stopover5_nb_to < {$radius} and stopover5_ob_to < {$radius})")
				 ->or_having("(stopover2_nb_from < {$radius} and stopover2_nb_from < {$radius} and to_nb< {$radius} and to_ob < {$radius})")
				 ->or_having("(stopover3_nb_from < {$radius} and stopover3_nb_from < {$radius} and stopover4_nb_to < {$radius} and stopover4_ob_to < {$radius})")
				 ->or_having("(stopover3_nb_from < {$radius} and stopover3_nb_from < {$radius} and stopover5_nb_to < {$radius} and stopover5_ob_to < {$radius})")
				 ->or_having("(stopover3_nb_from < {$radius} and stopover3_nb_from < {$radius} and to_nb< {$radius} and to_ob < {$radius})")
				 ->or_having("(stopover4_nb_from < {$radius} and stopover4_nb_from < {$radius} and stopover5_nb_to < {$radius} and stopover5_ob_to < {$radius})")
				 ->or_having("(stopover4_nb_from < {$radius} and stopover4_nb_from < {$radius} and to_nb< {$radius} and to_ob < {$radius})")
				 ->or_having("(stopover5_nb_from < {$radius} and stopover5_nb_from < {$radius} and to_nb< {$radius} and to_ob < {$radius})");
				 
		if($search['sort'])
			$this->db->order_by('price','asc');
		else
			$this->db->order_by('departure','asc');
		if($search['photo'])
			$this->db->where('users.picture !=','');
		if($search['comfort'])
			$this->db->where('cars.comfort >=',$search['comfort']);
		if($search['f_time'] and $search['t_time'])
		{
			$this->db->where('HOUR(departure) >=',$search['f_time']);
			$this->db->where('HOUR(departure) <=',$search['t_time']);
		}
		if($search['date'])
			$this->db->where('DATE(departure) ',$search['date']);
		if(isset($search['price'][2]))
			$this->db->where_in('rides.price_type',$search['price']);

		return $this->db->get('rides',$limit,$offset)->result();
	}
	public function get($id)
	{
		$this->db->select('cars.*, rides.*,users.*,user_settings.*, rides.id as ride_id')
				 ->join('users','users.user_id=rides.user_id')
				 ->join('cars','cars.id=rides.car_id','left')
				 ->join('user_settings','user_settings.user_id=rides.user_id')
				 ->where('rides.id',$id);
		return $this->db->get('rides')->row();
	}
	public function delete_ride($id)
	{
		$this->db->delete('rides',array('id' => $id));
	}
}