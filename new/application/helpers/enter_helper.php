<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function validateEmail($email) { // http://stackoverflow.com/a/46181/2252921
    return (preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)'.
    '|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])'.
    '|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email) === 1) ? true : false;
}

function exitWithMessage($msg, $code = 0){
    die(json_encode(array('msg' => $msg, 'code' => $code)));
}

function secureClear($text) {
    return htmlspecialchars(strip_tags($text));
}