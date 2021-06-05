<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$localhost = TRUE;

if ($localhost)
{
	//Facebook api configs
	$config['facebook'] = array(
    'appId'       => '1050383618399958',  
    'secret'    => 'a3dfc4bfc36d739522883070c94dbeed',
    'facebook_default_scope' => 'email,user_birthday',
	'allowSignedRequest' => false,
	);

	//Vkontakte api configs
    $config['vkontakte'] = array(
        'api_id'       => '5904782',
        'secret'       => 'eCwAd6jSWesfzbCDOoTs',
        'redirect_uri' => ''.site_url('vk').'',
        //'scope'        => 'offline,notify,friends,photos,audio,video,wall,email',
        'scope'        => 'offline,email',
        'fields'       => 'uid, first_name, last_name, screen_name, email, sex, bdate, photo_big'
    );

    // Twitter api configs
    $config['twitter'] = array(
    	//'consumer_key' 	=> "tqjoJth4uu2iGy7KtJkQQ",
	//	'consumer_secret' => "maW5OkLmlEkNgFcBWHvVKel4ro4AYkKwe93QAvvE",
     	'consumer_key' 	=> "pPqWkyDVevOed5SfAwAu4cRLa",
		'consumer_secret' => "7aXqa2mChzcRQKoPJRt69AeLQzI0cewOPkviVJQplJxFlD2m5A",        
		'oauth_callback'      	=> ''.base_url('ru').'/tw'
	);

	/*$config['ok'] = array(
		'client_id'       => '217675520',
		'application_key'    => 'CBAIHKPNABABABABA',
		'client_secret' => 'C582B4B30C422614719F920C'
	);*/
  
  $config['ok'] = array(
		'client_id'       => '1250086912',
		'application_key'    => 'CBABNDILEBABABABA',
		'client_secret' => '4FFB9DE52F9EA81B45FE2DEE'
	);
	$config['mail'] = array(
		'client_id'       => '712677',
		'application_key'    => '2414f16ee915155d7bd5f278b694deb7',
		'client_secret' => '6ddd38e8b66613b8a817e9dbaacf6248'
	);
/*	$config['google'] = array(
		'client_id'       => '1010478066906-03daqd1rt6c5oonvbcfk1vnqekelnkiq.apps.googleusercontent.com',
		'developer_key'    => 'AIzaSyBrCd2XVhPSW_Ufshhb98JpHEVcAUZ8Ia8',
		'client_secret' => 'F8wZFQrrCyakTtzz8SnaoI8Q',
		'redirect_uri' => ''.site_url('google').'',
		'scopes' => 'https://www.googleapis.com/auth/userinfo.email',
        'application_name' => 'Вход на сайт'
  );*/
  $config['googleplus']['application_name'] = 'Вход на сайт';
$config['googleplus']['client_id']        = '600479252006-jn1s236p3n1q9eifv7gqc50fknq518m5.apps.googleusercontent.com';
$config['googleplus']['client_secret']    = 'vcVyrgkbLW6NhB8K68ZN37Ri';
$config['googleplus']['redirect_uri']     = ''.site_url('google').'';
$config['googleplus']['api_key']          = 'AIzaSyAxaXyZpvRIBIAR_Aj3vqbjTE_BhCMmMoU';
$config['googleplus']['scopes']           = array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/user.birthday.read', 'https://www.googleapis.com/auth/plus.me');
}
else 
{
	//Facebook api configs
	$config['facebook_api_key']       = '376104542462857';
	$config['facebook_secret_key']    = '437903a1a70ee0df0837e48e4a58c707';
	$config['facebook_default_scope'] = 'email,publish_stream,user_birthday';
	$config['facebook_api_url']       = 'https://apps.facebook.com/376104542462857/';

	//Vkontakte api configs
}