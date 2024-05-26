<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Profile extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'Contactdetail_Model', 'contactDetail' );
		$this->load->model ( 'User_Model', 'user' );
		/*
		 * $this->load->model('Moneytransaction_Model', 'transaction');
		 * $this->load->model('Reverttransaction_Model', 'revertTransaction');
		 */
	}
	public function index($data = array()) {
		
		$contactDetailId = $_SESSION ["sessionUser"] ["contact_detail_id"];
		$contactDetail = $this->contactDetail->get ( $contactDetailId );
		$data ["contactDetail"] = $contactDetail;
		$this->template->load($this->activeTemplate,  'users/profile', $data );
	}
	public function edit($data = array()) {
		$contactDetailId = $_SESSION ["sessionUser"] ["contact_detail_id"];
		 
		$contactDetail = $this->contactDetail->get ( $contactDetailId );
		$data ["contactDetail"] = $contactDetail;
		$this->template->load($this->activeTemplate,  'users/profileUpdate', $data );
	}
	public function save() {
		$contactDetail = array ();
		if(isset($_SESSION ["sessionUser"] ["contact_detail_id"]) && !empty($_SESSION ["sessionUser"] ["contact_detail_id"])){
			$contactDetailId = $_SESSION ["sessionUser"] ["contact_detail_id"];
			$contactDetail ["id"] = $contactDetailId;
		}
		$contactDetail["primary_email"] = $_SESSION["sessionUser"] ["email"];
		//$contactDetail ["primary_email"] = $this->input->post ( "primary_email" );
		$contactDetail ["secondary_email"] = $this->input->post ( "secondary_email" );
		$contactDetail ["website"] = $this->input->post ( "website" );
		$contactDetail ["primary_phone"] = $this->input->post ( "primary_phone" );
		$contactDetail ["secondary_phone"] = $this->input->post ( "secondary_phone" );
		$contactDetail ["fax"] = $this->input->post ( "fax" );
		$contactDetail ["city"] = $this->input->post ( "city" );
		$contactDetail ["state"] = $this->input->post ( "state" );
		$contactDetail ["post_code"] = $this->input->post ( "post_code" );
		$contactDetail ["address"] = $this->input->post ( "address" );
		
		$response = $this->contactDetail->merge ( $contactDetail );
		 
		if (get_app_message ( "response.success" ) == $response || is_numeric($response)) {
			$user = array ();
			$user ["id"] = $_SESSION ["sessionUser"] ["id"];
			if(is_numeric($response)){
				$user["contact_detail_id"] = $response;
			}
			$user ["display_name"] = $this->input->post ( "display_name" );
			$picPath = $this->input->post ( "profile_pic_path" );
			if (! empty ( $picPath )) {
				// replace current profile pic with temp one. and delete from temp
				
				$absolutePath = ImageFileUpdateWithTemp ( $picPath, "profile-pic" );
				$user ["profile_picture"] = $absolutePath;
			}
			 
			$response = $this->user->merge ( $user );
		}
		
		if (get_app_message ( "response.success" ) == $response) {
			 
			$user = $this->user->validate ( $_SESSION ["sessionUser"] ["email"], $_SESSION ["sessionUser"] ["password"] );
			$_SESSION ["sessionUser"] = $user;
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		 redirect ( "/profile" );
	}
}
