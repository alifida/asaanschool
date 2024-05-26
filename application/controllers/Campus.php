<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Campus extends Protected_Controller {

	public function __construct() {

		parent::__construct();


		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			


		$this->load->model('Campus_Model', 'campus');
		$this->load->model('School_Model', 'school');
		$this->load->model('Student_Model', 'student');
		$this->load->model('Contactdetail_Model', 'contactDetail');
		$this->load->model('Class_Model', 'class');
		$this->load->model('Moneytransaction_Model', 'transaction');
		$this->load->model('Campusmodule_Model', 'campusModule');
		$this->load->model('Appmodule_Model', 'appModule');
		$this->load->model('Usermodule_Model', 'userModule');
		$this->load->model('Campuspackage_Model', 'campusPackage');
		$this->load->model('Invoice_Model', 'invoice');

	}

	public function index($data =array()) {

		$currentCampus = $_SESSION["currentCampus"] ;
		$data["campus"] = $currentCampus;

 
		// load campus Modules
		$campusModules = $this->campusModule->getByCampus($currentCampus["id"]);
		$data["campusModules"] = $campusModules;

		$openTransactions = $this->transaction->getOpenTransactions();
		$studentStrength = $this->student->countStudentsByStatus(get_app_message("db.status.active"));
		$totalDiscountAmount = calculateDiscounts($openTransactions);
		$totalPaidAmount = getTotalPaidAmount($openTransactions);
		$totalDueAmount = getTotalDueAmount($currentCampus["id"]);
		
		$campusCurrentPackage = $this->campusPackage->getByStatus($currentCampus["id"], get_app_message("db.status.active"));
		if(!empty($campusCurrentPackage)){
			$data["campusCurrentPackage"]= $campusCurrentPackage[0];
		}else{
			$campusCurrentPackage = array();
			$trail = get_app_message("db.status.trail");
			$campusCurrentPackage["package"]["name"] = $trail;
			$campusCurrentPackage["package"]["price"]["price"] = $trail;
			$campusCurrentPackage["package"]["price"]["currency"] = "";
			$campusCurrentPackage["package"]["description"] = $trail;
			$campusCurrentPackage["start_date"] = $trail;
			$data["campusCurrentPackage"] = $campusCurrentPackage;
		}


		$dueInvoices = $this->invoice->getByCampusAndStatus($currentCampus["id"], get_app_message("db.status.due"));


		$data["invoices"] = $dueInvoices;

		$data["studentStrength"] = $studentStrength;
		$data["totalDiscountAmount"] = $totalDiscountAmount ;
		$data["totalPaidAmount"] = $totalPaidAmount;
		$data["totalDueAmount"] = $totalDueAmount;

		$this->template->load($this->activeTemplate, 'campuses/index', $data);
	}


	public function selectModules() {
		$data= array();
		$appModules = $this->appModule->getByStatus(get_app_message("db.status.active"));
		$campusModules = $this->campusModule->getByCampus($_SESSION["currentCampus"]["id"]);
		$data["campusModules"] = $campusModules;
		$data["appModules"] = $appModules;

		$this->template->load($this->activeTemplate, "campuses/moduleSelection" , $data);
	}

	public function moduleSelectionConfirmation() {
		$data= array();
		$moduleIds = $this->input->post("modules");

		$appModules = $this->appModule->getByIds($moduleIds);

		$data["appModules"] = $appModules;

		$this->template->load($this->activeTemplate, "campuses/moduleSelectionConfirmation" , $data);
	}

	public function saveModulesSelection() {
		$data= array();
		$moduleIds = $this->input->post("modules");

		$response = $this->campusModule->saveCampusModules($moduleIds, $_SESSION["currentCampus"]["id"]);

		if($response == get_app_message("response.success")){
			//provide rights to current user on these modules
			$campusModuleIds = array();
			$campusModules = $this->campusModule->getByCampus($_SESSION["currentCampus"]["id"]);

			foreach ($campusModules as $campusModule){
				$campusModuleIds[]=$campusModule["id"];
			}

			if(!empty($campusModuleIds)){
				$response = $this->userModule->updateUserCampusModules($_SESSION["sessionUser"]["id"], $campusModuleIds);
				if($response == get_app_message("response.success")){
					generateLeftMenu($_SESSION["sessionUser"], $_SESSION["currentCampus"]);
					$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
				}else{
					$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
				}
			}

		}else{
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
		}
		redirect("/campus/selectModules");
	}


	public function view($data = array()) {
		redirect("/user/login");
	}







	public function edit($campusId){

		$data = array();
		$schoolId = $_SESSION["currentCampus"]["school_id"];
		$campus = $this->campus->get($campusId, $schoolId);

		if(empty($campus)){
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
			// redirect to login without distroying the current session.
			redirect("/user/login");
		}

		$data["campus"]=$campus;
		$this->template->load($this->activeTemplate, 'campuses/edit', $data);

	}


	public function update(){
		$campusId= $_SESSION["currentCampus"]["id"];
		$campus= array();
		//pre_d($_POST);


		$campus["id"] = $_SESSION["currentCampus"]["id"];
		$campus["campus_name"] = $this->input->post("campus_name");
		$logoPath = $this->input->post ( "campus_logo_path" );
		if (! empty ( $logoPath )) {
			// replace current profile pic with temp one. and delete from temp
			$absolutePath = ImageFileUpdateWithTemp ( $logoPath, "campus-logo" );
			$campus ["campus_logo"] = $absolutePath;
			 
		}

		// update campus
		$response = $this->campus->merge($campus);

		if(get_app_message ( "response.success" ) != $response){
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
			// redirect to login without distroying the current session.
			redirect("/user/login");
		}

		//contact details of campus
		$contactDetails= array();
		$contactDetails["id"]=$_SESSION["currentCampus"]["contact_detail_id"];
		$contactDetails["primary_email"]=$this->input->post("primary_email");
		$contactDetails["secondary_email"]=$this->input->post("secondary_email");
		$contactDetails["website"]=$this->input->post("website");
		$contactDetails["primary_phone"]=$this->input->post("primary_phone");
		$contactDetails["secondary_phone"]=$this->input->post("secondary_phone");
		$contactDetails["fax"]=$this->input->post("fax");
		$contactDetails["city"]=$this->input->post("city");
		$contactDetails["state"]=$this->input->post("state");
		$contactDetails["post_code"]=$this->input->post("post_code");
		$contactDetails["address"]=$this->input->post("address");

		// update Contact Details of campus
		$response = $this->contactDetail->merge($contactDetails);
		if(get_app_message ( "response.success" ) != $response){
			$_SESSION["appErrors"][] = get_app_message("cannot_process_request");
			// redirect to login without distroying the current session.
			redirect("/user/login");
		}


		// also update school details if there is only one campus
		if(sizeof($_SESSION["campuses"]==1)){

			$school = array();
			$school["id"]= $_SESSION["currentCampus"]["school_id"];
			$school["registration_no"] = $this->input->post("registration_no");
			$school["school_name"] = $this->input->post("campus_name");
			$school["details"] = $this->input->post("school_details");
			$school["contact_detail_id"] = $_SESSION["currentCampus"]["contact_detail_id"];
			if(!empty($school["id"])){
				$response = $this->school->merge($school);

			}else{
				$response = get_app_message ( "response.failed" );
			}

			if(get_app_message ( "response.success" ) != $response){
				$_SESSION["appErrors"][] = get_app_message("cannot_process_request");
				// redirect to login without distroying the current session.
				redirect("/user/login");
			}

		}

		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		$_SESSION["appMessages"][]= "Your changes will be updated on next login.";
		redirect ( 'user/login' );

	}

	public function signup(){
		$data = array();



		$this->template->load($this->activeTemplate, 'schools/sign_up', $data);

	}
	public function register(){
		$data = array();
		//pre_d($_POST);
		$data["school_name"] = $this->input->post("school_name");
		$data["registration_no"] = $this->input->post("registration_no");
		$data["email"] = $this->input->post("email");
		$data["password"] = $this->input->post("regPassword");
		$this->load->view('autoLogin');
		$response = $this->school->registerSchool($data);
		if($response == get_app_message("response.success")){
			// auto login
			$tempCredentials = array();
			$_SESSION["appMessages"][]="Congratulations! Your Account Has been created successfully.
								<br/>Please wait a while we are redirecting to the dashboard.";
			$_SESSION["tmp_login_email"] = $data["email"];
			$_SESSION["tmp_login_password"] = $data["password"];
			redirect('school/autoLoginPage');
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			redirect("school/signup");
		}
	}
	public function invoices(){
		$data = array();
		$currentCampus = $_SESSION["currentCampus"] ;
		$invoices = $this->invoice->getByCampus($currentCampus["id"]);
		$data["invoices"] = $invoices;
		$this->template->load($this->activeTemplate, 'invoices/index', $data);

	}
	public function invoiceDetails($invoiceId){
		$data = array();
		if(empty($invoiceId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/campus/invoices');
		}
		$invoiceId = decodeID($invoiceId);

		$currentCampus = $_SESSION["currentCampus"] ;
		$invoice = $this->invoice->get($invoiceId,$currentCampus["id"]);

		if(empty($invoice)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/campus/invoices');
		}

		$data["invoice"] = $invoice;
		$this->template->load($this->activeTemplate, 'invoices/view', $data);

	}




	public function autoLoginPage(){
		$this->load->view('autoLogin');
	}

}