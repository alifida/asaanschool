<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class School extends Protected_Controller {

	public function __construct() {

		parent::__construct();


		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			
		

		$this->load->model('School_Model', 'school');
		/*
		 $this->load->model('Studentfee_Model', 'studentfee');
		 $this->load->model('Class_Model', 'class');
		 $this->load->model('Studentitem_Model', 'studentitem');
		 */
	}

	public function index($data =array()) {
			

			
	}


	public function view($data = array()) {

	}







	public function edit($data = array()){

	}


	public function save($data= array()){


	}

}
