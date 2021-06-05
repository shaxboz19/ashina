<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fuqaro_murojaat_model extends CI_Model {

    private $table_fuqaro_murojaat = 'site_fuqaro_murojaat';
    private $table_users = 'auth_users';
    private $table_appeals = 'site_citizens_appeals_gov';

    function __construct() {
        parent::__construct();
    }

    /**
     * Select data table from fuqaro_murojaat	 
     * 
     * @param type $id
     * @return type
     */

    function randomNumber($length) {
        $min = 1 . str_repeat(0, $length-1);
        $max = str_repeat(9, $length);
        return mt_rand($min, $max);
    }
  	public function get_all($args = null)
	{	$defaults = array(
		
			'limit' => 10000,
			'offset' => 0,
			'order' => 'DESC',
			'orderby' => 'id',
            'status' => '',
            'fm_kimga_id' => '',
      
            
		);

		$q = array_merge($defaults, $args);
        
         if(!empty($q['fm_kimga_id'])){
            $this->db->where('fm_kimga_id', $q['fm_kimga_id']);  
        }
   //$this->db->join('site_regions', 'id_regions = fm_region', 'left');
       // $this->db->join('site_city', 'id_city = fm_city', 'left');
       $this->db->order_by('id_fuqaro_murojaat', $q['order']);
        //$this->db->where('status', 'active');
		return $this->db->get($this->table_fuqaro_murojaat, $q['limit'], $q['offset'])->result_array();
	}
    function fuqaro_murojaat_get($id = 0) {
        if ($id > 0) {
            $this->db->where('id_fuqaro_murojaat', $id);
        }
        $this->db->where('fm_status', 'A');        
        //$this->db->join($this->table_users, 'fm_operator = id', 'left');
        $this->db->join('site_regions', 'id_regions = fm_region', 'left');
        $this->db->join('site_city', 'id_city = fm_city', 'left');

        $this->db->order_by('id_fuqaro_murojaat', 'desc');
        $data = $this->db->get($this->table_fuqaro_murojaat);
        return $data->result_array();
    }

    function check_cid_id($id, $cid) {
        $this->db->select('fm_access_code');
        $this->db->where('id_fuqaro_murojaat', $id);
        $this->db->from($this->table_fuqaro_murojaat);
        $data = $this->db->get();
        $cid_db = $data->result_array();
        if($cid_db){
            if(md5($cid) == $cid_db[0]['fm_access_code']) {
                return 1;
            } else {
                return 0;
            }
        } else {
             return 0;
        }
    }

    function get_count() {
        $this->db->select('count(id_fuqaro_murojaat) cou', FALSE);
        $this->db->where('fm_status', 'A');
        $data = $this->db->get($this->table_fuqaro_murojaat);
        $result = $data->result_array();
        if (isset($result[0])) {
            if (isset($result[0]['cou'])) {
                return $result[0]['cou'];
            }
        }
        return 0;
    }

    function get_count_s() {
        $this->db->select('count(id_fuqaro_murojaat) cou', FALSE);
        $this->db->where('fm_status', 'A');
        $this->db->where('fm_murojaat_status', 'S');
        $data = $this->db->get($this->table_fuqaro_murojaat);
        $result = $data->result_array();
        if (isset($result[0])) {
            if (isset($result[0]['cou'])) {
                return $result[0]['cou'];
            }
        }
        return 0;
    }

    function get_count_a() {
        $this->db->select('count(id_fuqaro_murojaat) cou', FALSE);
        $this->db->where('fm_status', 'A');
        $this->db->where('fm_murojaat_status', 'A');
        $data = $this->db->get($this->table_fuqaro_murojaat);
        $result = $data->result_array();
        if (isset($result[0])) {
            if (isset($result[0]['cou'])) {
                return $result[0]['cou'];
            }
        }
        return 0;
    }

    function get_appeals_mygov()
    {
        $this->db->select('all_appeals, processed, inProgress, juridicalUsers, individualUsers');
        $this->db->from($this->table_appeals);
        $data = $this->db->get();
        $result = $data->result_array();

        return $data->result_array[0];
    }

    function get_statistics() {
        $this->db->select('fm_murojaat_status fstatus, count(fm_murojaat_status) cou', FALSE);
        $this->db->where('fm_status', 'A');
        $this->db->group_by('fm_murojaat_status');
        $data = $this->db->get($this->table_fuqaro_murojaat);
        $result = $data->result_array();
//        if (isset($result[0])) {
//            $result = $result[0];
//        }
        return $result;
    }
function update_some2($id, $murojaat_status) {

        $sql_data = array('fm_murojaat_status' => $murojaat_status, //
            );

        $this->db->where('id_fuqaro_murojaat', $id);
        $this->db->update($this->table_fuqaro_murojaat, $sql_data);

        return 0;
    }
    /**
     * Update data table fuqaro_murojaat	
     * 
     * @param type $id
     * @param type $ism
     * @param type $fam
     * @param type $email
     * @param type $telefon
     * @param type $mtext
     * @param type $kimga_id
     * @param type $murojaat_status
     * @param type $natija_text
     * @param type $zapas
     * @return int
     */
    function fuqaro_murojaat_update($id, $ism, $fam, $email, $telefon, $mtext, $kimga_id, $murojaat_status, $natija_text, $zapas,
                    $adres = "", $operatorId = 0, $region, $city, $sex, $ustatus, $bdate, $ap_type, $ap_allow, $nomer_passporta, $middle_name, $file) {

        $sql_data = array('fm_ism' => $ism, //
            'fm_fam' => $fam, //
            'fm_email' => $email, //
            'fm_telefon' => $telefon, //
            'fm_mtext' => $mtext, //
            'fm_kimga_id' => $kimga_id, //
            'fm_murojaat_status' => $murojaat_status, //
            'fm_natija_text' => $natija_text, //
            'fm_zapas' => $zapas, //
            'fm_adres' => $adres, //
            'fm_region' => $region,
            'fm_city' => $city,
            'fm_sex' => $sex,
            'fm_ustatus' => $ustatus,
            'fm_bdate' => $bdate,
            'fm_ap_type' => $ap_type,
            'fm_status' => 'A', //
            'fm_allow_publ' => $ap_allow,
            'nomer_passporta' => $nomer_passporta,
            'middle_name' => $middle_name,
            'fm_file' => $file,
            'fm_mod_date' => date("Y-m-d H:i:s"));

        if ($operatorId > 0)
            $sql_data['fm_operator'] = $operatorId;

        $this->db->where('id_fuqaro_murojaat', $id);
        $this->db->update($this->table_fuqaro_murojaat, $sql_data);

        return 0;
    }

    function update_some($id, $murojaat_status, $natija_text, $zapas, $operatorId = 0) {

        $sql_data = array('fm_murojaat_status' => $murojaat_status, //
            'fm_natija_text' => $natija_text, //
            'fm_zapas' => $zapas, //
            'fm_operator' => $operatorId, //
            'fm_status' => 'A', //
            'fm_mod_date' => date("Y-m-d H:i:s"));

        $this->db->where('id_fuqaro_murojaat', $id);
        $this->db->update($this->table_fuqaro_murojaat, $sql_data);

        return 0;
    }

    /**
     * Insert data to table fuqaro_murojaat	
     * 
     * @param type $ism
     * @param type $fam
     * @param type $email
     * @param type $telefon
     * @param type $mtext
     * @param type $kimga_id
     * @param type $murojaat_status
     * @param type $natija_text
     * @param type $zapas
     * @return type
     */
       function fuqaro_murojaat_save($ism, $fam, $email, $telefon, $mtext, $kimga_id, $murojaat_status, $natija_text, $zapas,
                                  $adres = "", $region, $city, $sex, $ustatus, $bdate, $ap_type, $ap_allow, $file, $code, $psharifi, $post_id, $ptype, $ptypes) {

        $sql_data = array('fm_ism' => $ism, //
            'fm_fam' => $fam, //
            'fm_email' => $email, //
            'fm_telefon' => $telefon, //
            'fm_sh' => $psharifi,
            'fm_mtext' => $mtext, //
            'fm_kimga_id' => $kimga_id, //
            'fm_murojaat_status' => $murojaat_status, //
            'fm_natija_text' => $natija_text, //
            'fm_zapas' => $zapas, //
            'fm_adres' => $adres, //
            'fm_region' => $region,
            'fm_city' => $city,
            'fm_sex' => $sex,
            //'pol' => $sex,
            'fm_ustatus' => $ustatus,
            'fm_bdate' => $bdate,
            'fm_ap_type' => $ap_type,
            'fm_status' => 'A', //
            'fm_allow_publ' => $ap_allow,
            'fm_file' => $file,
            'fm_access_code' => $code,
            'ptype' => $ptype,
            'post_id' => $post_id,
            'ptypes' => $ptypes,
            'fm_mod_date' => date("Y-m-d H:i:s"));
        $this->db->insert($this->table_fuqaro_murojaat, $sql_data);
        $insertID = $this->db->insert_id();
        return $insertID;
    }

    /**
     * Delete
     * @param type $id
     * @return int
     */
    function fuqaro_murojaat_delete($id) {

        $sql_data = array('fm_status' => 'D', //
            'fm_exp_date' => date("Y-m-d H:i:s"));

        $this->db->where('id_fuqaro_murojaat', $id);
        $this->db->update($this->table_fuqaro_murojaat, $sql_data);

        return 0;
    }
    
    public function all_count_fm() {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM $this->table_fuqaro_murojaat AS p
                WHERE p.id_fuqaro_murojaat";
            return $this->db->query($sql)->row('count');
	}
    
    public function count_fm_kimga_id($id) {
		$sql = "SELECT
                  COUNT(*) AS `count`
                FROM $this->table_fuqaro_murojaat AS p
                WHERE p.id_fuqaro_murojaat 
                AND p.fm_kimga_id = $id
                ";
            return $this->db->query($sql)->row('count');
	}

}

//* End of file modul_fuqaro_murojaat.php */

    