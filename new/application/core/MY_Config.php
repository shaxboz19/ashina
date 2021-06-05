<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Config extends CI_Config {
     public function __construct()
    {
        parent::__construct();
    }
	function site_url($uri = '', $protocol = NULL)
	{	
		if (is_array($uri))
		{
			$uri = implode('/', $uri);
		}
		if (class_exists('CI_Controller'))
		{
			$CI =& get_instance();
			$uri = $CI->lang->localized($uri);			
		}
		return parent::site_url($uri, $protocol);
	}
}

/* End of file */
