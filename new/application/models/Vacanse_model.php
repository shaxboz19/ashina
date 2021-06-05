<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vacanse_model extends CI_Model
{
    public function get_list()
    {
        $this->db->select('*');
        $this->db->order_by('id DESC');
        return $this->db->get('vacanse')->result();
    }

    public function get_list_v2($args = null)
    {

        $defaults = array(
            'limit' => 100000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'id',
            'date' => ''
        );
        @$q = array_merge($defaults, $args);


        if ( !empty($q['date']) ){
            $this->db->where('YEAR(vacanse.created_on)',  $q['date']);
        }
        if ( !empty($q['show']) ){
            $this->db->where('DATE(vacanse.created_on)',  $q['show']);
        }

        return $this->db->get('vacanse', $q['limit'], $q['offset'])->result();
    }
    public function get_list_admin($args = null)
    {
        $defaults = array(
            'limit' => 100000,
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'id'
        );
        @$q = array_merge($defaults, $args);

        if ( !empty($q['orderby']) ){
            $this->db->order_by($q['orderby'], $q['order']);
        }
        return $this->db->get('vacanse', $q['limit'], $q['offset'])->result();
    }
    public function request_count_status($field, $options) {
        $sql = "SELECT
            COUNT(*) AS `count`
            FROM vacanse AS p
            WHERE p.$field = '".$options."'
            AND p.id";
        return $this->db->query($sql)->row('count');
    }


    public function get($id)
    {
        return $this->db->get_where('vacanse', array('id'=>$id))->row();
    }

    public function save($data, $id=null)
    {
        if ($id)
        {
            $this->db->where('id', $id)
                ->update('vacanse', $data);
        }
        else
        {
            $this->db->insert('vacanse', $data);

            return $this->db->insert_id();
        }
    }


    public function delete($id)
    {
        $data = $this->get($id);
        $this->db->delete('vacanse', array('id'=>$id));
    }


}