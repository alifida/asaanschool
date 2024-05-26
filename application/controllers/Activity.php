<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Activity extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	
	
	
	public function index($data = array()) {
		redirect ( "/user" );
	}
	
	
	public function detailByUser($userId = "", $timestamp = "") {
		$data = array ();
		if (!empty ( $userId )) {
			$userId = decodeID ( $userId );
			$this->load->model ( 'User_Model', 'user' );
			$user = $this->user->get ( $userId );
			$data["user"] = $user;
			$data["activity_at"] = urldecode($timestamp);
		}
		$this->template->load($this->activeTemplate, "activities/activityByUser",$data);
	}
	
	
	
}
