<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_city extends CI_Model {
    private $table_city = 'site_city';

    function __construct() {
        parent::__construct();
    }

    /*
     * Select data table from city	 * **/
    function city_get($id = 0) {
        if ($id > 0)
            $this -> db -> where('id_city', $id);
        $this -> db -> where('c_status', 'A');
        $data = $this -> db -> get($this -> table_city);
        return $data -> result_array();
    }
    
    function city_get2($id = 0) {
        if ($id > 0)
            $this -> db -> where('id_city', $id);
        $this -> db -> where('c_status', 'A');
        $data = $this -> db -> get($this -> table_city);
        return $data -> result();
    }

    /*
     * Update data table city	 **/

    function city_update($id, $name, $title, $visible, $parent, $region_id) {

        $sql_data = array('c_name' => $name, //
        'title' => $title, //
            'c_visible' => $visible, //
            'c_status' => 'A', //
            'c_parent' => $parent,
            'region_id' => $region_id,
            'c_mod_date' => date("Y-m-d H:i:s"));

        $this -> db -> where('id_city', $id);
        $this -> db -> update($this -> table_city, $sql_data);

        return 0;
    }

    /*
     * Insert data to table city	 * **/
    function city_save($name, $title, $visible, $parent, $region_id) {

        $sql_data = array('c_name' => $name, //
        'title' => $title,
            'c_visible' => $visible, //
            'c_status' => 'A', //
            'c_parent' => $parent,
            'region_id' => $region_id,
            'c_mod_date' => date("Y-m-d H:i:s"));
        $this -> db -> insert($this -> table_city, $sql_data);
        $insertID = $this -> db -> insert_id();
        return $insertID;
    }

    function city_delete($id) {

        $sql_data = array('c_status' => 'D', //
            'c_mod_date' => date("Y-m-d H:i:s"));

        $this -> db -> where('id_city', $id);
        $this -> db -> update($this -> table_city, $sql_data);

        return 0;
    }

}

//* End of file modul_city.php */
