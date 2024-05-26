<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Admin extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] != "admin" && $_SESSION ['sessionUser'] ['user_type'] ['internal_key'] != "application_admin") {
			redirect ( '/user/login' );
		}
		/*
		 * if(!isAuthorizedController(get_class($this))){
		 * $_SESSION["appErrors"][]= get_app_message("unauthorized.user");
		 * redirect('/user/welcome');
		 * }
		 */
		$this->load->model ( 'User_Model', 'user' );
	}
	public function index() {
		redirect ( '/user/login' );
	}
	public function welcome($data = array()) {
		$this->load->model ( 'Campus_Model', 'campus' );
		$this->load->model ( 'Invoice_Model', 'invoice' );
		
		
		
		$userId = $_SESSION ["sessionUser"] ["id"];
		
		// get dashboard widegts
		$currentCampus = array ();
		$campuses = array ();
		if (isset ( $_SESSION ["campuses"] )) {
			unset ( $campuses ["user"] );
			$campuses = $_SESSION ["campuses"];
		} else {
			$campuses = $this->campus->getByUser ( $userId );
			unset ( $campuses ["user"] );
			$_SESSION ["campuses"] = $campuses;
		}
		
		
		//pre_d($_SESSION ['campuses'] );
		
		if (isset ( $_SESSION ["currentCampus"] )) {
			$currentCampus = $_SESSION ["currentCampus"];
		} else {
			if (! empty ( $campuses ) && isset ( $campuses ["0"] ["campus"] )) {
				$currentCampus = $campuses ["0"] ["campus"];
			}
			$_SESSION ["currentCampus"] = $currentCampus;
		}
		
		
		$this->load->model ( 'Reportconfiguration_Model', 'reportConfig' );
		$reportConf = $this->reportConfig->getByCampus ();
		$_SESSION ["reportConf"] = $reportConf;
		 
		
		
		// pre_d($_SESSION["currentCampus"]);
		
		// loading the first campus by default
		
		setTrailNotification ();
		
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] != "application_admin") {
			
			if ($_SESSION ["currentCampus"] ["school"] ["status"] == get_app_message ( "db.status.expired" )) {
				redirect ( "user/logout" );
			}
			
			if (isset ( $_SESSION ["license"] ["status"] ) && $_SESSION ["license"] ["status"] == get_app_message ( "db.status.expired" )) {
				redirect ( "/expired" );
			}
		}
		
		generateLeftMenu ( $_SESSION ["sessionUser"], $currentCampus );
		
		$this->load->model ( 'Moneytransaction_Model', 'transaction' );
		$this->load->model ( 'Student_Model', 'student' );
		$openTransactions = $this->transaction->getOpenTransactions ();
		// $currentFeePaid = getFeePaid($openTransactions);
		// $totalInventoryDues = getTotalInventoryDues($currentCampus["id"]);
		// $totalFeeDues = getTotalFeeDues($currentCampus["id"]);
		// $currentYearAdmissions= getCurrentYearAdmissionCount($currentCampus["id"]);
		
		$studentStrength = $this->student->countStudentsByStatus ( get_app_message ( "db.status.active" ) );
		$totalDiscountAmount = calculateDiscounts ( $openTransactions );
		$totalPaidAmount = getTotalPaidAmount ( $openTransactions );
		$totalDueAmount = getTotalDueAmount ( $currentCampus ["id"] );
		
		// charts
		$profitChartJSON = getProfitChartData ();
		$data ["profitChartJSON"] = $profitChartJSON;
		
		$classesChartData = getClassWisePaymentData ( $openTransactions );
		
		// due Invoices
		$dueInvoices = $this->invoice->getByCampusAndStatus ( $currentCampus ["id"], get_app_message ( "db.status.due" ) );
		$data ["invoices"] = $dueInvoices;
		
		$data ["studentStrength"] = $studentStrength;
		$data ["totalDiscountAmount"] = $totalDiscountAmount;
		$data ["totalPaidAmount"] = $totalPaidAmount;
		$data ["totalDueAmount"] = $totalDueAmount;
		$data ["classesChartData"] = $classesChartData;
		
		// $this->template->load($this->activeTemplate, 'dashboard/index', $data);
		 
		//$this->template->load ( $this->activeTemplate, 'dashboard/index', $data );
		parent::loadView('dashboard/index', $data);
	}
	public function users() {
		$data = array ();
		
		$this->load->model ( 'Usercampus_Model', 'campusUser' );
		$this->load->model ( 'Usertype_Model', 'userType' );
		$this->load->model ( 'Campusmodule_Model', 'campusModule' );
		/*
		 * $userTypes = $this->userType->get();
		 * $data["userTypes"] = $userTypes;
		 */
		
		$campusModules = $this->campusModule->getByCampus ( $_SESSION ["currentCampus"] ["id"] );
		$data ["campusModules"] = $campusModules;
		
		$campusUsers = $this->campusUser->getCampusUsers ( $_SESSION ["currentCampus"] ["id"] );
		$data ["campusUsers"] = $campusUsers;
		$this->template->load ( $this->activeTemplate, "users/index", $data );
	}
	public function createUserForm() {
		$this->load->model ( 'Campusmodule_Model', 'campusModule' );
		$this->load->model ( 'Usertype_Model', 'userType' );
		
		$data = array ();
		$userTypes = $this->userType->getByKeys ( array (
				"employee",
				"guardian",
				"student" 
		) );
		$data ["userTypes"] = $userTypes;
		$campusModules = $this->campusModule->getByCampus ( $_SESSION ["currentCampus"] ["id"] );
		$data ["campusModules"] = $campusModules;
		$data ["userModules"] = array ();
		$this->template->load ( $this->activeTemplate, "users/createCampusUser", $data );
	}
	public function saveUser() {
		
		
		$this->load->model('Employee_Model', 'employee');
		$this->load->model('Student_Model', 'student');
		$this->load->model('Guardian_Model', 'guardian');
		$this->load->model ( 'Usermodule_Model', 'userModule' );
		$this->load->model ( 'Usertype_Model', 'userType' );
		
		$typeId = $this->input->post ( "user_type" );
		if (empty ( $typeId )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "cannot_process_request" );
			return redirect ( "admin/users" );
		}
		
		$userType = $userTypes = $this->userType->get ( $typeId );
		if (empty ( $userType )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "cannot_process_request" );
			return redirect ( "admin/users" );
		}
		
		$newUser = false;
		$employeeId = null;
		$studentId = null;
		$guardianId = null;
		if ($userType ["internal_key"] == "employee") {
			
			$employeeId = $this->input->post ( "employee_id" );
			if (empty ( $employeeId )) {
				$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
				redirect ( "/admin/users" );
			}
		}else  if ($userType ["internal_key"] == "guardian") {
			$guardianId = $this->input->post ( "guardian_id" );
			if (empty ( $guardianId )) {
				$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
				redirect ( "/admin/users" );
			}
		}else  if ($userType ["internal_key"] == "student") {
			$studentId = $this->input->post ( "student_id" );
			if (empty ( $studentId )) {
				$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
				redirect ( "/admin/users" );
			}
		}
		
		$userId = $this->input->post ( "user_id" );
		$user = array ();
		
		$response = array ();
		
		if (! empty ( $userId )) {
			$userId = decodeID ( $userId );
			$user = $this->user->get ( $userId );
		} else {
			// create new user from employee Id
			$newUser = true;
			if ($userType ["internal_key"] == "employee") {
				
				$employee = $this->employee->get($employeeId);
				if (empty ( $employee ) || empty($employee["email"])) {
					$_SESSION ["appErrors"] [] = "Kindly set a email address for this employee before creating user account.";
					return redirect ( "/admin/users" );
				}
				
				
				$user = $this->user->createUserFromEmployee ( $employee, $userType ["id"] );
				$campusModuleIds = $this->input->post ( "campusModules" );
				if (! empty ( $campusModuleIds )) {
					// link selected CampusModules to $employee
					
					$response = $this->userModule->updateUserCampusModules ( $user ["id"], $campusModuleIds );
				}
			} else if ($userType ["internal_key"] == "student") {
				$student = $this->student->get($studentId);
				if (empty ( $student ) || empty($student["email"])) {
					$_SESSION ["appErrors"] [] = "Kindly set a email address for this student before creating user account.";
					return redirect ( "/admin/users" );
				}
				$user = $this->user->createUserFromStudent ( $student, $userType ["id"] );
				$this->linkUserCampus($user["id"]);
				
			} else if ($userType ["internal_key"] == "guardian") {
				$guardian = $this->guardian->get($guardianId);
				if (empty ( $guardian ) || empty($guardian["email"])) {
					$_SESSION ["appErrors"] [] = "Kindly set a email address for this guardian before creating user account.";
					return redirect ( "/admin/users" );
				}
				$user = $this->user->createUserFromGuardian( $guardian, $userType ["id"] );
				$this->linkUserCampus($user["id"]);
			}
		}
		
		if (! empty ( $user )) {
			$response = get_app_message ( "response.success" );
		}
		
		if ($response == get_app_message ( "response.success" )) {
			// send email to user
			if ($newUser) {
				emailCampusUserCreation ( $_SESSION ["currentCampus"], $user );
			} else {
				emailCampusUserUpdation ( $_SESSION ["currentCampus"], $user );
			}
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "admin/users" );
	}
	
	private function linkUserCampus($userId){
		$userCampus = array();
		$this->load->model('Usercampus_Model', 'userCampus');
		$userCampus = $this->userCampus->getByUserIdAndCampusId($userId, $_SESSION["currentCampus"]["id"]);
		
		if(empty($userCampus)){
			// register this user with current Campus
			$userCampus["user_id"]=$userId;
			$userCampus["campus_id"]=$_SESSION["currentCampus"]["id"];
			
			$newId = $this->userCampus->merge($userCampus);
			
		}
	}
	
	public function editUserForm($userId) {
		$data = array ();
		$this->load->model ( 'Campusmodule_Model', 'campusModule' );
		
		
		
		
		if (empty ( $userId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/admin/users" );
		}
		
		
		
		
		$this->load->model ( 'Usertype_Model', 'userType' );
		$data = array ();
		$userTypes = $this->userType->getByKeys ( array (
				"employee",
				"guardian",
				"student"
		) );
		$data ["userTypes"] = $userTypes;
		
		
		$data ["userId"] = $userId;
		$userId = decodeID ( $userId );
		
		$this->load->model ( 'Usercampus_Model', 'userCampus' );
		$usersCampuses = $this->userCampus->getByUserAndCampus ( $userId, $_SESSION ["currentCampus"] ["id"] );
		
		if (empty ( $usersCampuses )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/admin/users" );
		} else {
			$userCampus = $usersCampuses [0];
		}
		$userModules = array ();
		if (isset ( $userCampus ["user"] ["userModules"] )) {
			$userModules = $userCampus ["user"] ["userModules"];
		}
		
		$data ["userModules"] = $userModules;
		$campusModules = $this->campusModule->getByCampus ( $_SESSION ["currentCampus"] ["id"] );
		$data ["campusModules"] = $campusModules;
		
		// prePopulate Employee
		
		$user = $this->user->get ( $userId );
		$data["user"] = $user;
		
		
		
		$this->load->model ( 'Employee_Model', 'employee' );
		$prePopulateEmployee = $this->employee->prePopulate ( $user ["email"] );
		$data ["prePopulateEmployee"] = $prePopulateEmployee;
		$data ["readonlyEmployee"] = "true";
		
		$this->template->load ( $this->activeTemplate, "users/createCampusUser", $data );
	}
	public function viewUser($userId) {
		$data = array ();
		
		if (empty ( $userId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/admin/users" );
		}
		/* Usercampus_Model */
		$userId = decodeID ( $userId );
		$this->load->model ( 'Usercampus_Model', 'userCampus' );
		$usersCampuses = $this->userCampus->getByUserAndCampus ( $userId, $_SESSION ["currentCampus"] ["id"] );
		$userCampus = array ();
		
		if (empty ( $usersCampuses )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/admin/users" );
		} else {
			$userCampus = $usersCampuses [0];
		}
		$data ["userCampus"] = $userCampus;
		
		$this->template->load ( $this->activeTemplate, "users/viewCampusUser", $data );
	}
	public function deleteUserForm($userId) {
		$data = array ();
		
		if (empty ( $userId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/admin/users" );
		}
		$data ["userId"] = $userId;
		$userId = decodeID ( $userId );
		$this->load->model ( 'Usercampus_Model', 'userCampus' );
		$usersCampuses = $this->userCampus->getByUserAndCampus ( $userId, $_SESSION ["currentCampus"] ["id"] );
		$userCampus = array ();
		
		if (empty ( $usersCampuses )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/admin/users" );
		} else {
			$userCampus = $usersCampuses [0];
		}
		$data ["userCampus"] = $userCampus;
		
		$this->template->load ( $this->activeTemplate, "users/deleteCampusUser", $data );
	}
	public function deleteCampusUser() {
		$userId = $this->input->post ( "userId" );
		if (empty ( $userId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/admin/users" );
		}
		$userId = decodeID ( $userId );
		
		$this->load->model ( 'Usercampus_Model', 'userCampus' );
		$response = $this->userCampus->removeCampusUser ( $_SESSION ["currentCampus"] ["id"], $userId );
		
		if ($response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "admin/users" );
	}
	public function packageChangeRequest() {
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		// pre_d($_SESSION["currentCampus"]);
		
		$packageId = $this->input->post ( "package_id" );
		if (empty ( $packageId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/campus" );
		}
		
		// $packageRequest = array();
		
		$requestByUserId = encodeID ( $_SESSION ["sessionUser"] ["id"] );
		$campusId = encodeID ( $_SESSION ["currentCampus"] ["id"] );
		$campusSlug = encodeID ( $_SESSION ["currentCampus"] ["slug"] );
		$schoolId = encodeID ( $_SESSION ["currentCampus"] ["school"] ["id"] );
		$newPackageId = $packageId;
		$comments = $this->input->post ( "comments" );
		$requestTime = getCurrentDate ();
		
		$campus = $_SESSION ["currentCampus"];
		$school = $campus ["school"];
		$currentPackage = array ();
		
		$this->load->model ( 'Package_Model', 'package' );
		$newPackage = $this->package->get ( $newPackageId );
		
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		
		$currentPackage = $this->campusPackage->getByStatus ( $_SESSION ["currentCampus"] ["id"], get_app_message ( "db.status.active" ) );
		
		// pre_d($currentPackage);
		if (empty ( $currentPackage )) {
			$currentPackage = array ();
			$currentPackage ["0"] ["package"] ["name"] = "NOT SET";
		}
		
		$emailData = array ();
		$emailData ["to_email"] = get_app_message ( "admin.email.address" );
		$emailData ["from_email"] = $_SESSION ["sessionUser"] ["email"];
		
		$emailData ["from_user_id"] = $_SESSION ["sessionUser"] ["id"];
		
		$emailData ["email_subject"] = "Package Change Request";
		$body = "Hi " . get_app_message ( "organization.name" ) . " " . get_app_message ( "sender.email.display.name" ) . "!";
		$body .= "<br/><br/> Following user has requested to change the Package. ";
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
		$body .= "<br/>" . $_SESSION ["sessionUser"] ["display_name"];
		$body .= "<br/>" . $_SESSION ["sessionUser"] ["user_type"] ["type"];
		$body .= "<br/>" . $school ["school_name"];
		$body .= "<br/>" . $campus ["campus_name"];
		$body .= "<br/>" . $_SESSION ["sessionUser"] ["email"];
		
		$emailData ["email_body"] = $body;
		
		// send asaanschool notification
		$response = $this->emailUser->sendEmail ( $emailData );
		
		// send email alert
		sendEmailAlertToUser ( $emailData );
		
		if ($response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		redirect ( "/campus" );
	}
	public function packageChangeRequestForm() {
		$data = array ();
		$this->load->model ( 'Package_Model', 'package' );
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		
		$campusPackage = $this->campusPackage->getByStatus ( $_SESSION ["currentCampus"] ["id"], get_app_message ( "db.status.active" ) );
		$activePackageId = "";
		
		if (! empty ( $campusPackage )) {
			$activePackageId = $campusPackage [0] ["package_id"];
		}
		
		$data ["activePackageId"] = $activePackageId;
		
		$packages = $this->package->getPaid ();
		
		$data ["packages"] = $packages;
		$this->template->load ( $this->activeTemplate, 'campuses/packageChangeRequestForm', $data );
	}
	public function activiateAccountForm() {
		$data = array ();
		$this->load->model ( 'Package_Model', 'package' );
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		
		$campusPackage = $this->campusPackage->getByStatus ( $_SESSION ["currentCampus"] ["id"], get_app_message ( "db.status.active" ) );
		$activePackageId = "";
		
		if (! empty ( $campusPackage )) {
			$activePackageId = $campusPackage [0] ["package_id"];
		}
		
		$data ["activePackageId"] = $activePackageId;
		
		$packages = $this->package->getPaid ();
		
		$data ["packages"] = $packages;
		$this->template->load ( $this->activeTemplate, 'campuses/trailActiviationForm', $data );
	}
	public function activiateAccount() {
		$this->load->model ( 'Campuspackage_Model', 'campusPackage' );
		// pre_d($_SESSION["currentCampus"]);
		
		$packageId = $this->input->post ( "package_id" );
		if (empty ( $packageId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/campus" );
		}
		
		// $packageRequest = array();
		
		$requestByUserId = encodeID ( $_SESSION ["sessionUser"] ["id"] );
		$campusId = encodeID ( $_SESSION ["currentCampus"] ["id"] );
		$campusSlug = encodeID ( $_SESSION ["currentCampus"] ["slug"] );
		$schoolId = encodeID ( $_SESSION ["currentCampus"] ["school"] ["id"] );
		$newPackageId = $packageId;
		$comments = $this->input->post ( "comments" );
		$requestTime = getCurrentDate ();
		
		$campus = $_SESSION ["currentCampus"];
		$school = $campus ["school"];
		$currentPackage = array ();
		
		$this->load->model ( 'Package_Model', 'package' );
		$newPackage = $this->package->get ( $newPackageId );
		
		$currentPackage = $this->campusPackage->getByStatus ( $_SESSION ["currentCampus"] ["id"], get_app_message ( "db.status.active" ) );
		
		// pre_d($currentPackage);
		if (empty ( $currentPackage )) {
			$currentPackage = array ();
			$currentPackage ["0"] ["package"] ["name"] = "NOT SET";
		}
		
		$emailData = array ();
		$emailData ["to_email"] = get_app_message ( "admin.email.address" );
		$emailData ["from_email"] = $_SESSION ["sessionUser"] ["email"];
		
		$emailData ["from_user_id"] = $_SESSION ["sessionUser"] ["id"];
		
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
		$body .= "<br/>" . $_SESSION ["sessionUser"] ["display_name"];
		$body .= "<br/>" . $_SESSION ["sessionUser"] ["user_type"] ["type"];
		$body .= "<br/>" . $school ["school_name"];
		$body .= "<br/>" . $campus ["campus_name"];
		$body .= "<br/>" . $_SESSION ["sessionUser"] ["email"];
		
		$emailData ["email_body"] = $body;
		
		// send asaanschool notification
		$response = $this->emailUser->sendEmail ( $emailData );
		
		// send email alert
		sendEmailAlertToUser ( $emailData );
		
		if ($response == get_app_message ( "response.success" )) {
			$activationMessage = get_app_message ( "account.activation.message" ) . " i.e. <a href='" . get_app_message ( "app.domain" ) . "'>" . get_app_message ( "app.domain" ) . "</a>";
			$_SESSION ["appMessages"] [] = $activationMessage;
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		redirect ( "/campus" );
	}
	public function pending_users($data = array()) {
		$users = get_pending_users ();
		$data ["pending_users"] = $users;
		$this->template->load ( $this->activeTemplate, 'pending_users', $data );
	}
	public function approve_user() {
		$userid = $this->input->get ( "id" );
		if ("success" == update_user_status ( $userid, "active" )) {
			$data ["success"] = "User has been set as <b>Active</b> successfully.";
		} else {
			$data ["error"] = "Unable to approve the user right now, please try again later.";
		}
		
		$this->pending_users ( $data );
	}
}
