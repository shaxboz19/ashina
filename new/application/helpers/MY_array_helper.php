<?php
/**
 * UvCMS
 *
 * Vuna Marketing CMS
 *
 * @author		Ulugbek D.
 * @copyright	Copyright (c) 2011, Vuna Marketing, Inc.
 * @link		http://vunamarketing.com
 * @since		Version 0.1
 */
 
/*
function array_value_recursive($key, array $arr)
{
    $val = array();
    array_walk_recursive($arr, function($v, $k) use($key, &$val){
        if($k == $key) array_push($val, $v);
    });
    return count($val) > 1 ? $val : array_pop($val);
}
*/
// ------------------------------------------------------------------------

/**
 * Is it array empty?
 *
 * @param   array   Some array for check
 * @return	bool
 */
if ( ! function_exists('array_empty'))
{
	function array_empty($array)
	{
		foreach ($array as $item)
		{
			if ( ! empty($item))
			{
				return FALSE;
			}
		}
		
		return TRUE;
	}
}



/* End of file MY_array_helper.php */