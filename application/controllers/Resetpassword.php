<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
include_once('Base_Controller.php');
class Resetpassword extends Base_Controller {

    public function __construct() {
        parent::__construct();
         session_start();
        unset($_SESSION["sessionUser"]);
        
    }

    public function index() {

       // $this->template->load($this->activeTemplate, "reset_password");
    }


	public function form(){
		
		$this->template->load($this->activeTemplate, 'forget_password');
	}
	
	
	public function reset() {

		$data = array();
		$this->load->model('User_Model', 'user');
		$loginId = $this->input->post("fp_email");
		$user = $this->user->getByLoginId($loginId);
		if (!empty($user)) {
			 
			$token = getRandomString();
			$result = sendPasswordResetToken($user, $token);
			if ($result) {
				// Email message sent successfully
				$data["appMessages"][] = "Email has been sent to the associated Email address, Please Follow the instructions in the email.";
				$_SESSION["resetPassToken"] = $token;
				$_SESSION["resetPassId"] = $user["id"];

			} else {
				// cannot reset the password , try again later
				$data["appErrors"][] = "Unable to reset the Password, Please Try again later, or contact the Admin.";
			}
		} else {
			// invalid user login id.
			$data["appErrors"][] = "Please Provide a valid Email, If you forgot the Email you can contact the admin.";
		}

		$this->template->load($this->activeTemplate, 'login', $data);
	}

	// vpt ----- Verify Password-reset Token
	public function vpt($urlToken="") {

		$data = array();
		$this->load->model('User_Model', 'user');
		$sessionToken = $_SESSION["resetPassToken"];
		$sessionUserId = $_SESSION["resetPassId"];

		if ($sessionToken == $urlToken) {
			// update the password and send email..
			$user = $this->user->get($sessionUserId);
			$user["password"] = get_random_string();
			$response = $this->user->merge($user);
			sendNewPasswordToUser($user);
			if ($response == get_app_message ( "response.success" )) {
				$_SESSION["appMessages"][] = "Your password has been reset, Please Check your email.";
			} else {
				$_SESSION["appErrors"][]  = "Unable to reset your password. Please try again later.";
			}
		} else {
			// INvalid
			$_SESSION["appErrors"][]  = "Your Reset Password Request has been expired. Please try again to reset your password.";
		}
		//Remove token and user from session
		unset($_SESSION["resetPassToken"]);
		unset($_SESSION["resetPassId"]);
		redirect("user/login");
	}
    
}
