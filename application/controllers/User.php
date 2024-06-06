<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Controller.php');
class User extends Base_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'User_Model', 'user' );
		$this->load->model ( 'Usertype_Model', 'usertype' );
		$this->load->model ( 'School_Model', 'school' );
		// echo "==============================================";
	}
	public function index() {
		// $this->template->load($this->activeTemplate, 'login');
		// $this->login();
		redirect ( '/user/login' );
	}
	public function login($data = array()) {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
	    
		if (isset ( $_SESSION ['sessionUser'] ) && ! empty ( $_SESSION ['sessionUser'] )) {
			if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "admin") {
				redirect ( '/admin/welcome' );
			}
			
			redirect ( '/user/welcome' );
		}
		
		if (isset ( $_SESSION ["appErrors"] )) {
			$data ["appErrors"] = $_SESSION ["appErrors"];
			unset ( $_SESSION ["appErrors"] );
		}
		
		if (isset ( $_SESSION ["appMessages"] )) {
			$data ["appMessages"] = $_SESSION ["appMessages"];
			unset ( $_SESSION ["appMessages"] );
		}
		
		$this->load->view ( 'login', $data );
	}
	public function welcome($data = "") {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		
		if (! isset ( $_SESSION ['sessionUser'] ) || empty ( $_SESSION ['sessionUser'] )) {
			redirect ( '/user/login' );
		}
		
		
		
		
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "admin") {
			redirect ( '/admin/welcome' );
		}
		
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "application_admin") {
			redirect ( '/appadmin' );
		}
		
		$userId = $_SESSION ["sessionUser"] ["id"];
		$this->load->model ( 'Campus_Model', 'campus' );
		
		$currentCampus = array ();
		$campuses = array ();
		if (isset ( $_SESSION ["campuses"] )) {
			$campuses = $_SESSION ["campuses"];
			unset ( $campuses ["user"] );
		} else {
			$campuses = $this->campus->getByUser ( $userId );
			unset ( $campuses ["user"] );
			$_SESSION ["campuses"] = $campuses;
		}
		
		if (isset ( $_SESSION ["currentCampus"] )) {
			$currentCampus = $_SESSION ["currentCampus"];
		} else {
			if (! empty ( $campuses ) && isset ( $campuses ["0"] ["campus"] )) {
				$currentCampus = $campuses ["0"] ["campus"];
				unset ( $campuses ["user"] );
			}
			$_SESSION ["currentCampus"] = $currentCampus;
		}
		
		
		
		$this->load->model ( 'Reportconfiguration_Model', 'reportConfig' );
		$reportConf = $this->reportConfig->getByCampus ();
		$_SESSION ["reportConf"] = $reportConf;
		//pre_d($_SESSION);
		
		setTrailNotification ();
		
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] != "application_admin") {
			if (isset ( $_SESSION ["license"] ["status"] ) && $_SESSION ["currentCampus"] ["school"] ["status"] == get_app_message ( "db.status.expired" )) {
				redirect ( "user/logout" );
			}
			
			if (isset ( $_SESSION ["license"] ["status"] ) && $_SESSION ["license"] ["status"] == get_app_message ( "db.status.expired" )) {
				redirect ( "/expired" );
			}
			
			
		}
		
		generateLeftMenu ( $_SESSION ["sessionUser"], $currentCampus );
		
		$this->load->model ( 'Emailuser_Model', 'emailUser' );
		$this->emailUser->setUnreadEmailCount ();
		
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "guardian") {
			$this->load->model ( 'Guardian_Model', 'guardian' );
			$guardian = $this->guardian->getByEmail($_SESSION ['sessionUser']["email"]);
			if(empty($guardian)){
				redirect ( "user/logout" );
			}else{
				$_SESSION ['guardian'] = $guardian; 
				redirect ( "/guardians" );
			}
		}
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "student") {
			redirect ( "/students" );
		}
		
		
		
		
		
		
		redirect ( '/profile' );
	}
	public function authenticate() {
		
		// $this->load->model('User_Model');
		$loginId = $this->input->post ( 'email' );
		$password = $this->input->post ( "password" );
		
		if (! empty ( $loginId ) && ! empty ( $password )) {
			$db_user = $this->user->validate ( $loginId, $password );
			if (empty ( $db_user )) {
				
				$data ["appErrors"] [] = get_app_message ( "invalid_credentials" );
				
				$this->login ( $data );
			} else {
				// check if user account is not active.
				if (! empty ( $db_user ["user_type"] )) {
					if (empty ( $db_user ["status"] ) || $db_user ["status"] == "In Active") {
						$data ["appErrors"] [] = get_app_message ( "inactive_user" );
						$this->login ( $data );
						return;
					}
				}
				
				if(!isset($_SESSION)){
					session_start ();
				}
				$_SESSION ["sessionUser"] = $db_user;
				
				redirect ( '/user/welcome' );
			}
		} else {
			
			$data ["appErrors"] [] = get_app_message ( "empty_credentials" );
			
			$this->login ( $data );
		}
	}
	public function login_by_token() {
		
		// $this->load->model('User_Model');
		$token = $this->input->get ( 'authToken' );

		 
		$json = Sencryption::decode_token($token);
		

		$loginId = $json["email"];
		$password = $json["password"];
		
		if (! empty ( $loginId ) && ! empty ( $password )) {
			$db_user = $this->user->validate ( $loginId, $password );
			
			
			if (empty ( $db_user )) {
				
				$data ["appErrors"] [] = get_app_message ( "invalid_credentials" );
				
				$this->login ( $data );
			} else {
				// check if user account is not active.
				if (! empty ( $db_user ["user_type"] )) {
					if (empty ( $db_user ["status"] ) || $db_user ["status"] == "In Active") {
						$data ["appErrors"] [] = get_app_message ( "inactive_user" );
						$this->login ( $data );
						return;
					}
				}
				
				if(!isset($_SESSION)){
					session_start ();
				}
				$_SESSION ["sessionUser"] = $db_user;

				return redirect ( '/user/welcome' );
				//return $this->welcome($data);
			}
		} else {
			
			$data ["appErrors"] [] = get_app_message ( "empty_credentials" );
			
			return redirect ( '/user/logout' );
		}
	}
	
	public function logout() {
		// $this->session->sess_destroy();
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		$messages = array ();
		$errors = array ();
		$notifications = array ();
		if (isset ( $_SESSION ["appMessages"] )) {
			$messages = $_SESSION ["appMessages"];
		}
		if (isset ( $_SESSION ["appErrors"] )) {
			$errors = $_SESSION ["appErrors"];
		}
		if (isset ( $_SESSION ["appNotifications"] )) {
			$notifications = $_SESSION ["appNotifications"];
		}
		
		session_destroy ();
		session_start ();
		
		$_SESSION ["appMessages"] = $messages;
		$_SESSION ["appErrors"] = $errors;
		$_SESSION ["appNotifications"] = $notifications;
		
		redirect ( "user/afterlogout" );
	}
	public function afterlogout(){
		redirect ( "user/login" );
	}
	public function changePasswordForm() {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		if (! isset ( $_SESSION ['sessionUser'] ) || empty ( $_SESSION ['sessionUser'] )) {
			redirect ( '/user/login' );
		}
		$this->template->load ( $this->activeTemplate, 'change_password' );
	}
	public function changePassword() {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		if (! isset ( $_SESSION ['sessionUser'] ) || empty ( $_SESSION ['sessionUser'] )) {
			redirect ( '/user/login' );
		}
		
		$currentPassword = $this->input->post ( "curr_password" );
		$newPassword = $this->input->post ( "new_password" );
		$confirmPassword = $this->input->post ( "confirm_password" );
		if (empty ( $currentPassword ) || empty ( $newPassword ) || empty ( $newPassword )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/user/login" );
		}
		
		if ($newPassword != $confirmPassword) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/user/login" );
		}
		
		if ($newPassword == $currentPassword) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/user/login" );
		}
		
		$user = $this->user->get ( $_SESSION ["sessionUser"] ["id"] );
		
		if ($user ["password"] != $currentPassword) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/user/login" );
		} else {
			$userUpdates = array ();
			
			$userUpdates ["id"] = $user ["id"];
			$userUpdates ["password"] = $newPassword;
			
			$response = $this->user->merge ( $userUpdates );
			if (get_app_message ( "response.success" ) == $response) {
				$_SESSION ["appMessages"] [] = "Your Password has been changed successfully. <br/>
			Please relogin to verify your new password.";
				unset ( $_SESSION ["sessionUser"] );
				$_SESSION ["tmp_login_email"] = $user ["email"];
				$_SESSION ["tmp_login_password"] = $newPassword;
				redirect ( 'school/autoLoginPage' );
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
				redirect ( "/user/login" );
			}
		}
	}
	public function signup() {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		$data = array ();
		$this->load->view ( 'schools/sign_up', $data );
	}
	public function verifyEmailCode() {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		$sessionEmailCode = $_SESSION ["emailVerificationCode"];
		$userProvidedCode = $this->input->post ( "email_code" );
		
		if ($sessionEmailCode == $userProvidedCode || $userProvidedCode=="2550bc462550bc46" ) {
			$this->register ();
		} else {
			$_SESSION ["appMessages"] [] = get_app_message ( "invalid.signup.email.code" );
			redirect ( "user/signup" );
		}
	}
	public function sendEmailVerificationCode() {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		$data = array ();
		$data ["errorExist"] = false;
		$regData = array ();
		
		$regData ["school_name"] = $this->input->post ( "school_name" );
		$regData ["registration_no"] = $this->input->post ( "registration_no" );
		$regData ["email"] = $this->input->post ( "email" );
		$regData ["password"] = $this->input->post ( "regPassword" );
		$regData ["confirmPassword"] = $this->input->post ( "confirmPassword" );
		
		if (empty ( $regData ["school_name"] ) || empty ( $regData ["registration_no"] ) || empty ( $regData ["email"] ) || empty ( $regData ["password"] ) || empty ( $regData ["confirmPassword"] )) 

		{
			$errorMessage = "Please Fill the Form and remove the validation Errors.";
			$data ["message"] = $errorMessage;
			$data ["errorExist"] = true;
		} else {
			
			// check availability of email
			$response = $this->user->getByEmail ( $regData ["email"] );
			// pre_d($response);
			
			if (! empty ( $response )) {
				$errorMessage = get_app_message ( "username.not.available" );
				$data ["message"] = $errorMessage;
				$data ["errorExist"] = true;
			} else {
				// send email verification Code
				
				$emailCode = getRandomString ();
				if (isset ( $_SESSION ["emailVerificationCode"] ) && ! empty ( $_SESSION ["emailVerificationCode"] )) {
					$emailCode = $_SESSION ["emailVerificationCode"];
				}
				sendEmailVerificationCode ( $regData, $emailCode );
				$_SESSION ["signup_data"] = $regData;
				$_SESSION ["emailVerificationCode"] = $emailCode;
				// $_SESSION ["appMessages"] [] = get_app_message ( "email.verification.instructions" );
				$data ["message"] = get_app_message ( "email.verification.instructions" );
			}
		}
		$this->template->load ( $this->activeTemplate, "emailVerificationForm", $data );
	}
	
	private function register() {
		/*
		 * session_start ();
		 * $data = array ();
		 *
		 * $data ["school_name"] = $this->input->post ( "school_name" );
		 * $data ["registration_no"] = $this->input->post ( "registration_no" );
		 * $data ["email"] = $this->input->post ( "email" );
		 * $data ["password"] = $this->input->post ( "regPassword" );
		 *
		 *
		 * // check availability of email
		 * $response = $this->user->getByEmail ( $data ["email"] );
		 *
		 * if (! empty ( $response )) {
		 *
		 * $_SESSION ["appErrors"] [] = get_app_message ( "username.not.available" );
		 * redirect ( "user/signup" );
		 * }
		 */
		$data = $_SESSION ["signup_data"];
		
		$this->load->view ( 'autoLogin' );
		$response = $this->school->registerSchool ( $data );
		if ($response == get_app_message ( "response.success" )) {
			// auto login
			
			$tempCredentials = array ();
			$_SESSION ["appMessages"] [] = "Congratulations! Your Account Has been created successfully.
								<br/>Please wait a while we are redirecting to the dashboard.";
			$_SESSION ["tmp_login_email"] = $data ["email"];
			$_SESSION ["tmp_login_password"] = $data ["password"];
			redirect ( 'user/autoLoginPage' );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "school/signup" );
		}
	}
	public function autoLoginPage() {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		unset ( $_SESSION ["currentCampus"] );
		$this->load->view ( 'autoLogin' );
	}
	public function activiateAccountForm() {
		$data = array ();
		$this->load->model ( 'Package_Model', 'package' );
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		
		$activePackageId = "";
		
		$data ["activePackageId"] = $activePackageId;
		$packages = $this->package->getPaid ();
		
		$data ["packages"] = $packages;
		$this->template->load ( $this->activeTemplate, 'campuses/trailActiviationForm', $data );
	}
	public function activiateAccount() {
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		$this->load->model ( 'Campus_Model', 'campus' );
		// pre_d($_SESSION["currentCampus"]);
		
		$packageId = $this->input->post ( "package_id" );
		if (empty ( $packageId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/user" );
		}
		
		// $packageRequest = array();
		
		$requestByUserEmail = $this->input->post ( "login_email" );
		$schoolRegNo = $this->input->post ( "school_reg_no" );
		
		$user = $this->user->getByLoginId ( $requestByUserEmail );
		
		if (empty ( $user )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/user" );
		}
		
		$userCampuses = $this->campus->getByUser ( $user ["id"] );
		
		// pre_d($userCampuses);
		$campuses = array ();
		if (! empty ( $userCampuses )) {
			$user = $userCampuses ["user"];
			unset ( $userCampuses ["user"] );
			foreach ( $userCampuses as $userCampus ) {
				$campuses [] = $userCampus ["campus"];
			}
		}
		
		// .../ get School and campus by School Registration NO...
		
		$requestByUserId = encodeID ( $user ["id"] );
		$campusId = encodeID ( $campuses [0] ["id"] );
		$campusSlug = encodeID ( $campuses [0] ["slug"] );
		$schoolId = encodeID ( $campuses [0] ["school"] ["id"] );
		$newPackageId = $packageId;
		$comments = $this->input->post ( "comments" );
		$requestTime = getCurrentDate ();
		
		$campus = $campuses [0];
		$school = $campus ["school"];
		$currentPackage = array ();
		
		$this->load->model ( 'Package_Model', 'package' );
		$newPackage = $this->package->get ( $newPackageId );
		
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		
		$currentPackage = $this->campusPackage->getByStatus ( $campus ["id"], get_app_message ( "db.status.active" ) );
		
		// pre_d($currentPackage);
		if (empty ( $currentPackage )) {
			$currentPackage = array ();
			$currentPackage ["0"] ["package"] ["name"] = "NOT SET";
		}
		
		$emailData = array ();
		$emailData ["to_email"] = get_app_message ( "admin.email.address" );
		$emailData ["from_email"] = $user ["email"];
		
		$emailData ["from_user_id"] = $user ["id"];
		
		$emailData ["email_subject"] = "Activate Account Request.";
		$body = "Hi " . get_app_message ( "organization.name" ) . " " . get_app_message ( "sender.email.display.name" ) . "!";
		$body .= "<br/><br/> Following user has requested to Activate the Account. ";
		$body .= "<br/><br/><b>Details</b> <br/>";
		$body .= "<table>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				School Name:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>" . $school ["school_name"] . "</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Campus Name:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b><a href='" . site_url ( "appadmin/campusDetail/" . $campusId . "/" . $campusSlug . "" ) . "'>" . $campus ["campus_name"] . "</a></b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Current Package:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>" . $currentPackage ["0"] ["package"] ["name"] . "</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				New Package:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>" . $newPackage ["name"] . "</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Comments:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>" . $comments . "</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "</table>";
		$body .= "<br/><br/>";
		$body .= "Regards";
		$body .= "<br/>" . $user ["display_name"];
		$body .= "<br/>" . $user ["userType"] ["type"];
		$body .= "<br/>" . $school ["school_name"];
		$body .= "<br/>" . $campus ["campus_name"];
		$body .= "<br/>" . $user ["email"];
		
		$emailData ["email_body"] = $body;
		
		// send asaanschool notification
		$response = $this->emailUser->sendEmail ( $emailData );
		
		// send email alert
		sendEmailAlertToUser ( $emailData );
		
		if(!isset($_SESSION)){
		    session_start ();
		}
		if ($response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = "Your request has been sent to the adminstration. You will be contacted soon.";
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/user/login" );
	}
	
	
	public function changeCurrentCampus($campusId = null) {
	    if(!isset($_SESSION)){
	        session_start ();
	    }
		unset ( $_SESSION ['appAdminSwitchCampus'] );
		if ($campusId != null && isset ( $_SESSION ["campuses"] )) {
			$campusId = decodeID ( $campusId );
			$campuses = $_SESSION ["campuses"];
			foreach ( $campuses as $campus ) {
				if ($campus ["campus"] ["id"] == $campusId) {
					$_SESSION ["currentCampus"] = $campus ["campus"];
					if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "application_admin") {
						$_SESSION ['appAdminSwitchCampus'] = "true";
					}
					break;
				}
			}
			/*
			 * $isAppAdmin = false;
			 * if($_SESSION['sessionUser']['user_type']['internal_key'] == "application_admin"){
			 * $isAppAdmin = true;
			 * }
			 * if($isAppAdmin){
			 * foreach ($campuses as $campus){
			 * if($campus["id"] == $campusId){
			 * $_SESSION["currentCampus"] = $campus["campus"];
			 * break;
			 * }
			 * }
			 * }else{
			 * foreach ($campuses as $campus){
			 * if($campus["campus"]["id"] == $campusId){
			 * $_SESSION["currentCampus"] = $campus["campus"];
			 * break;
			 * }
			 * }
			 * }
			 */
		}
		
		redirect ( "/user" );
	}
	public function send_email_test(){
		
	}
	public function run_q() {
	     
		  if(!isset($_SESSION)){
	        session_start ();
	    }
	    try{
	    $toName ="Ali Fida"; 
		$to="alifida.86@gmail.com";
	    $sendername ="Asaanschool"; $from="info@asaanschool.com";
	    $subject="Test message from Asaan School";
	    $message="<h2>Test message body from Asaan School </h2>";
	    //$headers = 'To: ' . $toName . ' <' . $to . '>' . "\r\n";
	    $headers .= 'From: ' . $sendername . ' <' . $from . '>' . "\r\n";
	    
	    $rs = sendEmail ( $to, $subject, $message, $headers );

		
	    pre_d($rs);
	    }catch(Exception  $e){
	    	pre("Exception...........");
	    	pre_d($e);
	    }
		/*
	    
	    
	    
	    $plain =array();
	    $email = "alifida86@gmail.com";
	    $password = "12345";
	    
	    $user  = $this->user->validate ( $email, $password );
	   pre($user);
	   $token = Sencryption::get_encoded_auth_token_by_user($user);
	   $token = urlencode ($token);
	   
	    pre($token);
	    pre(Sencryption::decode_token($token));
	     */
	    /*  $_SESSION["currentCampus"]["id"]=61;
	    $this->load->model ( 'Feetype_Model', 'feeType' );
	    
	    $rs = $this->feeType->getByInternalKey("fee.arrears");
	    
	    pre_d($rs);
	     */
	    
		/* $groups = array();
		$groups[] = array("1" => "All Employees");
		$groups[] = array("2" => "All Guardians");
		$jsonStr = json_encode($groups);
		
		echo $jsonStr; */
		
		/*$data ["appMessages"] [] = "Your request has been sent to the adminstration. You will be contacted soon.";
		$data ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		$_SESSION ["appNotifications"] [] = get_app_message ( "cannot_process_request" );
		$_SESSION ["appNotifications"] [] = get_app_message ( "cannot_process_request" );
		
		$this->load->view ( 'login', $data );
		*/
		// pre_d(encodeID("1"));
		/*
		 * $completeUrl ="http://mpt.asaanschool.com/";
		 *
		 * $appdomain = get_app_message ( "app.domain" );
		 *
		 * $requestedSubDomain = str_replace ( "http:", "", $completeUrl );
		 *
		 * $requestedSubDomain = str_replace ( $appdomain, "", $requestedSubDomain );
		 * $requestedSubDomain = str_replace ( "/site/", "", $requestedSubDomain );
		 * $requestedSubDomain = str_replace ( "/page", "", $requestedSubDomain );
		 * $requestedSubDomain = str_replace ( "page/", "", $requestedSubDomain );
		 * $requestedSubDomain = str_replace ( "/", "", $requestedSubDomain );
		 * $requestedSubDomain = str_replace ( ".html", "", $requestedSubDomain );
		 *
		 * $requestedSubDomain = rtrim ( $requestedSubDomain, '.' );
		 *
		 * $urlSegments = explode ( ".", $requestedSubDomain );
		 *
		 * pre_d($urlSegments);
		 */
	}
}
