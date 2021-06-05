<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Furqat U.
 * @copyright 2012
 **/

function char_lim($str, $limit)
{
    if(mb_strlen($str) > $limit)
        $str = mb_substr($str, 0, $limit).'&hellip;';
    else
        $str = $str;
    return $str;
}       

function t_date($format, $date=FALSE, $lang=LANG)
{
	$months['January'] = array('uz'=>'Yanvar');
	$months['February'] = array('uz'=>'Fevral');
	$months['March'] = array('uz'=>'Mart');
	$months['April'] = array('uz'=>'Aprel');
	$months['May'] = array('uz'=>'May');
	$months['June'] = array('uz'=>'Iyun');
	$months['July'] = array('uz'=>'Iyul');
	$months['August'] = array('uz'=>'Avgust');
	$months['September'] = array('uz'=>'Sentabr');
	$months['October'] = array('uz'=>'Oktabr');
	$months['November'] = array('uz'=>'Noyabr');
	$months['December'] = array('uz'=>'Dekabr');

	$days['Monday'] = array('uz'=>'Dushanba');
	$days['Tuesday'] = array('uz'=>'Seshanba');
	$days['Wednesday'] = array('uz'=>'Chorshanba');
	$days['Thursday'] = array('uz'=>'Payshanba');
	$days['Friday'] = array('uz'=>'Juma');
	$days['Saturday'] = array('uz'=>'Shanba');
	$days['Sunday'] = array('uz'=>'Yakshanba');

	if ($date)
		$date = date($format, strtotime($date));
	else
		$date = date($format, NOW);

	foreach ($months as $key => $val)
		$date = str_replace($key, $val[$lang], $date);
	foreach ($days as $key => $val)
		$date = str_replace($key, $val[$lang], $date);

	return $date;
}