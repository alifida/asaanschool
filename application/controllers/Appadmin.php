<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

include_once('Protected_Controller.php');
class Appadmin extends Protected_Controller {

	public function __construct() {
		parent::__construct();
			
		if ($_SESSION['sessionUser']['user_type']['internal_key'] != "application_admin") {
			redirect('/user/login');
		}
		
		
		/*
		 if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
			}
			*/



	}

	public function index() {
		setTrailNotification();
		//
		//redirect('/user/login');
		/*$data = array();
		$currentCampus = null;
		if(isset($_SESSION["currentCampus"]) && !empty($_SESSION["currentCampus"])){
			$currentCampus = $_SESSION["currentCampus"];
		}
		generateLeftMenu($_SESSION["sessionUser"], $currentCampus);
		$this->template->load($this->activeTemplate, 'dashboard/appAdmin', $data);
		*/
		if(isset($_SESSION ['appAdminSwitchCampus']) && ($_SESSION ['appAdminSwitchCampus']=="true")){
			redirect("/campus");
		}else{
			redirect("/appadmin/schools");
		}
	}
	public function schools() {

		if(!isset($_SESSION ['appAdminSwitchCampus']) || ($_SESSION ['appAdminSwitchCampus']!="true")){
			unset($_SESSION["currentCampus"]);
			unset($_SESSION["campuses"]);
		}
		
		
		unset($_SESSION["trailNotification"]);
		unset($_SESSION["appNotifications"]["trail"]);


		$data = array();

		$this->load->model('School_Model', 'school');

		$schools = $this->school->get();
		$data["schools"] = $schools;
		generateLeftMenu($_SESSION["sessionUser"], null);

		$this->template->load($this->activeTemplate, 'schools/index', $data);
		
	}
	
	public function test(){
	
		
		
	
		
		validateLicense();
	}

	public function schoolLicenseStatusForm($schoolId = null){
		$data = array();
		if($schoolId == null){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
		//$this->load->model('Campus_Model', 'campus');
		$schoolId = decodeID($schoolId);
		
		$this->load->model('School_Model', 'school');
		$school  = $this->school->get($schoolId);
		
		if(empty($school)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
		
		$data["school"] =$school;
		$this->template->load($this->activeTemplate, 'schools/licenseStatusForm', $data);
	}
	
	public function saveLicenseStatus(){
		$schoolId = $this->input->post("school_id");
		if($schoolId == null){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
		
		$schoolId = decodeID($schoolId);
		
		$this->load->model('School_Model', 'school');
		$school  = $this->school->get($schoolId);
		
		if(empty($school)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
	
		$school["status"] = $this->input->post("licenseStatus");
		unset($school["contactDetail"]);
		$school["updated_by"]=$_SESSION["sessionUser"]["id"];
		
		$response = $this->school->merge($school);
		if($response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		
		redirect("/appadmin/schools");
	}

	public function schoolDetail($schoolId = null) {
		$data = array();
		if($schoolId == null){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
		$this->load->model('School_Model', 'school');
		$this->load->model('Campus_Model', 'campus');
		$schoolId = decodeID($schoolId);
		$school  = $this->school->get($schoolId);

		if(empty($school)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}

		$data["school"] = $school;

		$campuses = $this->campus->getBySchool($schoolId);
		$data["campuses"] = $campuses;
		
		if(empty($campuses)){
			$this->template->load($this->activeTemplate, 'schools/detailView', $data);
		}else{

			redirect("/appadmin/campusDetail/".encodeID($campuses[0]["id"]));
		}


	}

	public function campusDetail($campusId = null, $campusSlug=""){
		if($campusId == null){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
		
		$this->load->model('Campus_Model', 'campus');

		$campusId = decodeID($campusId);
		
		$currentCampus = $this->campus->getById($campusId);
		
		if($currentCampus == null){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
		$_SESSION["currentCampus"] = $currentCampus;
//pre_d("6");
		setTrailNotification();
//pre_d("7");



		unset($_SESSION["campuses"]);
//pre_d("8");

		$schoolCampuses = array();
		$schoolCampuses  = $this->campus->getBySchool($currentCampus["school_id"]);

//pre_d("9");
		$sessionCampuses = array();
		// set campus accoring to format
		foreach ($schoolCampuses as $key=>$campus){
			$sessionCampuses[]["campus"]=$campus;
		}
// pre_d("10");
		$_SESSION["campuses"]=$sessionCampuses;
		

		generateLeftMenu($_SESSION["sessionUser"], $currentCampus);
		redirect("/campus");

	}

	public function editInvoice($invoiceId = null){
		$this->load->model('Invoice_Model', 'invoice');
		if($invoiceId == null){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}
		$campusId = $_SESSION["currentCampus"]["id"];
		$invoiceId = decodeID($invoiceId);
		$invoice = $this->invoice->get($invoiceId, $campusId);

		if(empty($invoice)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin");
		}

		$data["invoice"] = $invoice;
		$this->template->load($this->activeTemplate, 'invoices/edit', $data);


	}
	public function createInvoice($data = array()){

		$invoice = $this->prepareInvoice();
		$data["invoice"] = $invoice;
		$this->template->load($this->activeTemplate, 'invoices/edit', $data);


	}

	
	
	public function saveInvoice(){
		$this->load->model('Invoice_Model', 'invoice');
		$this->load->model('Campuspackage_Model', 'campusPackage');
		$invoice = array();

		$invoiceId = $this->input->post("invoice_id");
		if(!empty($invoiceId)){
			$invoiceId = decodeID($invoiceId);

			$invoice = $this->invoice->get($invoiceId, $_SESSION["currentCampus"]["id"]);

			if(empty($invoice)){
				$_SESSION["appErrors"][]= get_app_message("invalid_url");
				redirect("/campus/invoices");
			}

			$invoice["status"] = $this->input->post("status");
			if($invoice["status"]== get_app_message("db.status.paid")){
				$invoice["paid_date"] = $this->input->post("paidDate");
			}
			$invoice["discount"] = $this->input->post("discount");
			$invoice["paid_amount"] = $this->input->post("paidAmount");
			$invoice["due_date"] = $this->input->post("dueDate");
			$invoice["payment_method"] = $this->input->post("paid_through");
			$invoice["invoice_expiry_date"] = $this->input->post("expiryDate");
		}else{
			$invoice["campus_id"] =  $_SESSION["currentCampus"]["id"];

			$invoice["invoice_date"] = $this->input->post("invoiceDate");
			$invoice["balance"] = $this->input->post("balance");

			$invoice["discount"] = $this->input->post("discount");
			$invoice["arrears"] = $this->input->post("arrears");
			$invoice["total_payable_amount"] = $this->input->post("totalPayable");
			$invoice["paid_amount"] = $this->input->post("paidAmount");
			$invoice["invoice_date"] = $this->input->post("invoiceDate");
			$invoice["status"] = $this->input->post("status");
			$invoice["due_date"] = $this->input->post("dueDate");
			$invoice["payment_method"] = $this->input->post("paid_through");
			$invoice["invoice_expiry_date"] = $this->input->post("expiryDate");
		}


		$invoice = $this->prepareInvoice($invoice);

		unset($invoice["campusPackage"]);

		
		
		$response = $this->invoice->merge($invoice);

		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}

		redirect("/campus/invoices");
	}

	private function prepareInvoice($invoice = array()){

		$this->load->model('Invoice_Model', 'invoice');
		$this->load->model('Campuspackage_Model', 'campusPackage');

		$campusId = $_SESSION["currentCampus"]["id"];
		$currentPackageCharges = 0;

		$campusPackage = $this->campusPackage->getByStatus($campusId, get_app_message("db.status.active"));

		if(!empty($campusPackage)){
			$currentPackageCharges = $campusPackage[0]["package"]["price"]["price"];
		}

		/*
		 $totalBalance = $this->invoice->getTotalBalanceByCampus($campusId);

		 $totalArrear = $this->invoice->getTotalArrearsByCampus($campusId);


		 $totalDiscount = $this->invoice->getTotalDiscountByCampus($campusId);

		 $totalPaidAmount = $this->invoice->getTotalPaidAmount($campusId);
		 */
		if(!isset($invoice["invoice_no"]) || empty($invoice["invoice_no"])){
			$invoice["invoice_no"]=$this->invoice->generateInvoiceNumber();
		}
		
		if(!isset($invoice["payment_method"]) || empty($invoice["payment_method"])){
			$invoice["payment_method"]="";
		}

		if(!isset($invoice["campus_package_id"]) || empty($invoice["campus_package_id"])){
			$invoice["campusPackage"] = $campusPackage;
			$invoice['campus_package_id'] = $campusPackage[0]["id"];
		}
		/*$balance = $totalBalance - $totalArrear;

		if($balance <= 0){
		$balance = 0;
		}
		$arrears = $totalArrear - $totalBalance;

		if($arrears <=0){
		$arrears = 0;
		}
		*/

		//$invoice["balance"] = $balance;

		if(!isset($invoice["payable_amount"]) || empty($invoice["payable_amount"])){
			$invoice["payable_amount"] = $currentPackageCharges;
		}

		if(!isset($invoice["discount"]) || empty($invoice["discount"])){
			$invoice["discount"] = 0;
		}

		if(!isset($invoice["arrears"]) || empty($invoice["arrears"])){
			$invoice["arrears"] = 0;
		}

		if(!isset($invoice["total_payable_amount"]) || empty($invoice["total_payable_amount"])){
			$invoice["total_payable_amount"] = $invoice["payable_amount"] - $invoice["discount"];

		}

		if(!isset($invoice["paid_amount"]) || empty($invoice["paid_amount"])){
			$invoice["paid_amount"] = 0;
		}



		if(!isset($invoice["balance"])){
			$invoice["balance"] =0;
		}

		if(!isset($invoice["invoice_date"]) || empty($invoice["invoice_date"])){
			$invoice["invoice_date"] = "";
		}
		if(!isset($invoice["due_date"]) || empty($invoice["due_date"])){
			$invoice["due_date"] = "";
		}

		if(!isset($invoice["paid_date"]) || empty($invoice["paid_date"])){
			$invoice["paid_date"] = null;
		}

		if(!isset($invoice["status"]) || empty($invoice["status"])){
			$invoice["status"] = get_app_message("db.status.due");
		}

		if(!isset($invoice["created_by"]) || empty($invoice["created_by"])){
			$invoice["created_by"] = $_SESSION["sessionUser"]["id"];
		}

		if(!isset($invoice["created_at"]) || empty($invoice["created_at"])){
			$invoice["created_at"] = getCurrentDateTime();
		}



		return $invoice;
	}




	public function choosePackage(){
		$this->load->model('Package_Model', 'package');
		$this->load->model('Campuspackage_Model', 'campusPackage');

		$campusPackage = $this->campusPackage->getByStatus($_SESSION["currentCampus"]["id"], get_app_message("db.status.active"));
		$activePackageId = "";

		if(!empty($campusPackage)){
			$activePackageId = $campusPackage[0]["package_id"];
		}

		$data["activePackageId"] = $activePackageId;

		$packages = $this->package->get();

		$data["packages"] = $packages;

		$this->template->load($this->activeTemplate, 'campuses/campusPackageForm', $data);
	}

	public function packageSave(){

		$this->load->model('Campuspackage_Model', 'campusPackage');

		$packageId = $this->input->post("package_id");
		if(empty($packageId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/appadmin/choosePackage");
		}

		$campusPackage = array();
		$campusPackage["campus_id"] =  $_SESSION["currentCampus"]["id"];
		$campusPackage["package_id"] = $packageId;
		$campusPackage["start_date"] = getCurrentDate();
		$campusPackage["status"] = get_app_message("db.status.active");
		$campusPackage["comments"] = $this->input->post("comments");
		$campusPackage["created_by"] = $_SESSION["sessionUser"]["id"];





		$response = $this->campusPackage->deactivateCurrentPackage($_SESSION["currentCampus"]["id"]);
		
		if(get_app_message ( "response.success" ) == $response){
			$response = $this->campusPackage->merge($campusPackage);
			if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
				// End the Trail if not already Activated.
				if($_SESSION["currentCampus"]["school"]["status"] == get_app_message("db.status.trail") ||
						$_SESSION["currentCampus"]["school"]["status"] == get_app_message ( "db.status.expired" )
						){
					$schoolId =$_SESSION["currentCampus"]["school"]["id"];
					if(!empty($schoolId)){
						$this->load->model('School_Model', 'school');
						$school = $this->school->get($schoolId);
						/*if($_SESSION["currentCampus"]["school"]["status"] == get_app_message ( "db.status.expired" )){
							$school["status"]=get_app_message("db.status.expired");
						}else{
						}*/
							$school["status"]=get_app_message("db.status.licenced");
						unset($school["contactDetail"]);
						$response = $this->school->merge($school);
					}
				}


			}else{
				$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			}
		}else{
			$_SESSION["appErrors"][]= "Unable to De activiate Current Package.";
		}

		redirect("/campus");

	}

	public function addFont(){
		$this->load->helper ( 'pdf_helper' );
		tcpdf();
		//$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$fontname = TCPDF_FONTS::addTTFfont('d://tmp/comic sans ms bd.ttf', '', '', 32);
		//$fontname = TCPDF_FONTS::addTTFfont($fontfile, $options['type'], $options['enc'], $options['flags'], $options['outpath'], $options['platid'], $options['encid'], $options['addcbbox'], $options['link']);
	}
}
