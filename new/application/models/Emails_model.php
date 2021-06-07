<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Furqat U.
 * @copyright 2012
 **/

class Emails_model extends CI_Model 
{  
    public function get_list()
    {
        return $this->db->get('emails')->result();
    }
    
    public function get($email_id)
    {
        return $this->db->get_where('emails', array('email_id'=>$email_id))->row();
    }

    public function save($data, $email_id)
    {
        $this->db->update('emails', $data, array('email_id'=>$email_id));
    }

}