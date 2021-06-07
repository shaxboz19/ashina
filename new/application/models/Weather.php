<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Weather extends CI_Model 
{  
	public function update_weather_data($id_city, $weather_image, $datetime, $temperature, $day_time)
	{
        $this->db->set('weather_image', $weather_image);
        $this->db->set('datetime', $datetime);
        $this->db->set('temperature', $temperature);
        $this->db->set('day_time', $day_time);
        $this->db->where('id_city', $id_city);
        $this->db->update('weather');
	}
    public function get_weather($city_code = 1){
        $this->db->select("weather_image, temperature, datetime, city_name_ru, city_name_uz, city_name_ru");
        $this->db->where('id_city', $city_code);
        return $this->db->get('weather')->result();
    }
 }