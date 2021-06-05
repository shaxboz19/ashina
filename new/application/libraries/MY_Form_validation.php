<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Furqat U.
 * @copyright 2011
 */
 
class MY_Form_validation extends CI_Form_validation
{
    function run($module = '', $group = '') {
        (is_object($module)) AND $this->CI =& $module;
        return parent::run($group);
    }
    
    function valid_domain($str=FALSE)
    {
        list($mailbox, $domain) = explode('@', $str);
        if (!(checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A'))) {
            $this->CI->form_validation->set_message(__FUNCTION__, "Email &quot;{$str}&quot; is not valid.");
            return FALSE;
        }
        return TRUE;
    }

    function is_unique($str, $field)
    {
        if (substr_count($field, '.') == 2)
        {
            list($table, $field, $true) = explode('.', $field);
            $query = $this->CI->db->limit(1)
                                  ->where($field, $str)
                                  ->where($field.' != ', $str)
                                  ->get($table);
        } 
        else {
            list($table, $field)=explode('.', $field);
            $query = $this->CI->db->limit(1)
                                  ->get_where($table, array($field => $str));
        }

        return $query->num_rows() === 0;
    }
  
}



// END MY Form Validation Class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */