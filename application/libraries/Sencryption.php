<?php
class Sencryption {
	
	 
	
	static function get_encoded_auth_token_by_user($user) {
		if (! empty ( $user ) && isset ( $user ["email"] ) && isset ( $user ["password"] )) {
			$arr = array ();
			$arr ["email"] = $user ["email"];
			$arr ["password"] = $user ["password"];
			$json = json_encode ( $arr );
			return Sencryption::encrypt ( $json );
		}
		return "";
	}
	static function decode_token($str) {
		$dec = Sencryption::decrypt ( $str );
		$json = json_decode ( $dec, true );
		return $json;
	}
	
	
	static function encrypt($str) {
		$CI = & get_instance ();
		$CI->load->library ( 'encryption' );
		return $CI->encryption->encrypt ( $str );
	}
	static function decrypt($str) {
		$CI = & get_instance ();
		$CI->load->library ( 'encryption' );
		return $CI->encryption->decrypt ( $str );
	}
}