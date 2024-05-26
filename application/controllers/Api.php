<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Controller.php');
class Api extends Base_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'User_Model', 'user' );
		// echo "==============================================";
	}
	public function index() {
		$data ["message"] = get_app_message ( "empty_credentials" );
		$data ["status"] = get_app_message ( "response.failed" );
		parent::returnJSON ( $data );
	}
	public function authenticate() {
		
		$loginId = $this->input->post ( 'email' );
		$password = $this->input->post ( "password" );
		
		$data = array ();
		 
		if (empty ( $loginId ) || empty ( $password )) {
			
			$data ["message"] = get_app_message ( "empty_credentials" );
			$data ["status"] = get_app_message ( "response.failed" );
			$data ["status"] = get_app_message ( "response.failed" );

		} else {
			
			$db_user = $this->user->validate ( $loginId, $password );
			 
			if (empty ( $db_user )) {
				$data ["message"] = get_app_message ( "invalid_credentials" );
				$data ["status"] = get_app_message ( "response.failed" );
			} else if (empty ( $db_user ["user_type"] )) {
				$data ["message"] = get_app_message ( "empty_credentials" );
				$data ["status"] = get_app_message ( "response.failed" );
			} else if ($db_user ["status"] == "Active") {
				$data ["status"] = get_app_message ( "response.success" );
				$data ["user"] = $db_user;
			} else {
				$data ["message"] = get_app_message ( "cannot_process_request" );
				$data ["status"] = get_app_message ( "response.failed" );
			}
		}
		
		
		$token = Sencryption::get_encoded_auth_token_by_user($db_user);
		$webURL = base_url() . "user/login_by_token?authToken=".urlencode ($token);
		$data["authToken"]  = $token;
		$data["webURL"]  = $webURL;
		
		
		parent::returnJSON ( $data );
	}
	
	/*
	 * Returns user Alerts count by provided token*/
	public function alertscount() {
		
		$token = $this->input->post ( 'authToken' );
		
		$json = Sencryption::decode_token($token);
		
		
		$loginId = $json["email"];
		$password = $json["password"];
		$data = array();
		if (! empty ( $loginId ) && ! empty ( $password )) {
			$db_user = $this->user->validate ( $loginId, $password );
			
			
			if (empty ( $db_user )) {
				
				$data ["status"] = get_app_message ( "response.failed" );
				$data ["message"] = get_app_message ( "invalid_credentials" );
				
				
			} else {
				$this->load->model ( 'Emailuser_Model', 'emailUser' );
				$data ["status"] = get_app_message ( "response.success" );
				$unreadEmailsCount = $this->emailUser->countUserEmailsByStatus ( get_app_message ( "db.email.status.unread" ), $db_user["id"] );
				
				if($unreadEmailsCount>0){
					$plural ="";
					if($unreadEmailsCount>1){
						$plural = "s";
					}
					
					$data ["message"] = "You have received $unreadEmailsCount new message$plural.";
					$data ["title"] = "Asaanschool School";
					$data ["webURL"] = base_url() . "email/inbox";
				
				}else{
					$data ["status"] = get_app_message ( "response.failed" );
					$data ["message"] =  "no. new notification";
				}
			}
		} else {
			
			$data ["status"] = get_app_message ( "response.failed" );
			$data ["message"] = get_app_message ( "invalid_credentials" );
			 
		}
		parent::returnJSON ( $data );
	}
	 public function job_config() {
		
		$data= array();
		$data["notification_job_start_after"] = "0";
		$data["notification_job_interval"] = "3600";
		
		parent::returnJSON ( $data );
	} 
}
