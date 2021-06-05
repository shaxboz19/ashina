<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function sms($id, $phone, $message){
$input_xml='{"messages":[{"recipient":"'.$phone.'","message-id":"'.$id.'","sms":{"originator": "3700","content": {"text": "'.$message.'"}}}]}';
   // $url = "http://91.204.239.42:8083/broker-api/send";
	$url = "http://91.204.239.44/broker-api/send";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=UTF-8'));
    curl_setopt($ch, CURLOPT_USERPWD, '');
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);
    return true;
}

?>