<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_regions extends CI_Model {
    private $table_regions = 'site_regions';

    function __construct() {
        parent::__construct();
    }

    /*
     * Select data table from regions	 * **/
    function regions_get($id = 0) {
        if ($id > 0)
            $this -> db -> where('id_regions', $id);
        $this -> db -> where('r_status', 'A');
        $data = $this -> db -> get($this -> table_regions);
        return $data -> result_array();
    }
    
    function regions_get2() {
        $data = $this -> db -> get($this -> table_regions);
        return $data -> result();
    }
    
    function regions_get3() {
        $this -> db -> where('r_status', 'A');
        $data = $this -> db -> get($this -> table_regions);
        return $data -> result();
    }
    
    function regions_get_city($id) {
        $this -> db -> where('region_id', $id);
        $this -> db -> where('c_status', 'A');
        $data = $this -> db -> get('site_city');
        return $data -> result();
    }

    /*
     * Update data table regions	 **/

    function regions_update($id, $name, $title, $visible, $child) {

        $sql_data = array('r_name' => $name, //
        'title' => $title,
            'r_visible' => $visible, //
            'r_status' => 'A', //
            'r_child' => $child,
            'r_mod_date' => date("Y-m-d H:i:s"));

        $this -> db -> where('id_regions', $id);
        $this -> db -> update($this -> table_regions, $sql_data);

        return 0;
    }

    /*
     * Insert data to table regions	 * **/
    function regions_save($name, $title, $visible, $child) {

        $sql_data = array('r_name' => $name, //
        'title' => $title,
            'r_visible' => $visible, //
            'r_status' => 'A', //
            'r_child' => $child,
            'r_mod_date' => date("Y-m-d H:i:s"));
        $this -> db -> insert($this -> table_regions, $sql_data);
        $insertID = $this -> db -> insert_id();
        return $insertID;
    }

    function regions_delete($id) {

        $sql_data = array('r_status' => 'D', //
            'r_mod_date' => date("Y-m-d H:i:s"));

        $this -> db -> where('id_regions', $id);
        $this -> db -> update($this -> table_regions, $sql_data);

        return 0;
    }

}

//* End of file modul_regions.php */
