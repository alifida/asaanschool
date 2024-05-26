<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('sendPublicSMS')) {

    function sendPublicSMS($data) {
 
    	if(!isset($data["to"]) || empty($data["to"]) ){
    		return false;
    	}
    	
    	if(!isset($data["message"]) || empty($data["message"]) ){
    		return false;
    	}
    	
    	if(!isset($data["sender"]) || empty($data["sender"]) ){
    		return false;
    	}
    	
    	$CI = & get_instance();
    	$CI->load->library('AsaanschoolSMS');
    	$sms = new AsaanschoolSMS();
    	return $sms->sendsms($data['to'], $data['message'],0, $data["sender"]);
    }

}

