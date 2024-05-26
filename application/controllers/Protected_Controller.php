<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Base_Controller.php');
class Protected_Controller extends Base_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION)){
		    session_start ();
		}
	
		if (!isset($_SESSION['sessionUser']) || empty($_SESSION['sessionUser'])) {
			redirect('/user/login');
		}
		if ($_SESSION['sessionUser']['user_type']['internal_key'] != "application_admin") {
			//pre_d($_SESSION["currentCampus"]["school"]["status"]);
			if (isset($_SESSION["currentCampus"]["school"]["status"]) &&  $_SESSION["currentCampus"]["school"]["status"] == get_app_message("db.status.expired")) {
				redirect('/expired');
			}
			/*if (isset($_SESSION["license"]["status"]) &&  $_SESSION["license"]["status"] == get_app_message("db.status.expired")) {
				redirect('/expired');
			}
			*/
		}



		$this->emailUser->setUnreadEmailCount();
	}
}