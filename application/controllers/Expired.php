<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Base_Controller.php');
class Expired extends Base_Controller {

	private $expiredTemplate ="expired";
	public function __construct() {

		parent::__construct();
		if(!isset($_SESSION)){
			session_start ();
		}

			


	}

	public function index($data =array()) {
		$data = array();

		if(!isset($_SESSION ["expiredCampus"]) && isset($_SESSION ["currentCampus"])){
			$campus = $_SESSION ["currentCampus"] ;
			unset($_SESSION ["currentCampus"]);
			$_SESSION ["expiredCampus"] = $campus;
		}

		if(!isset($_SESSION ["expiredCampus"] )){
			unset($_SESSION["appNotifications"]["licenseExpired"]);
			redirect("/user/logout");
		}
		
		//pre_d($_SESSION);
		
		if(isset($_SESSION["dueInvoice"]) && !empty($_SESSION["dueInvoice"])){
			redirect("/expired/invoiceDetails");
		}else{
			$this->template->load($this->expiredTemplate, 'expired/invoices/index', $data);
		}
	}
	public function invoiceDetails(){
		
		$data = array();
		
		//pre_d($_SESSION);

		//$expiredCampus = $_SESSION["expiredCampus"] ;
		$invoice = $_SESSION["dueInvoice"];
		
//pre_d($invoice);
		$data["invoice"] = $invoice;
		$this->template->load($this->expiredTemplate, 'expired/invoices/view', $data);

	}	

/*
	public function invoiceDetails($invoiceId=""){
		$this->load->model('Invoice_Model', 'invoice');
		$data = array();
		if(empty($invoiceId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/expired');
		}
		$invoiceId = decodeID($invoiceId);

		$expiredCampus = $_SESSION["expiredCampus"] ;
		$invoice = $this->invoice->get($invoiceId,$expiredCampus["id"]);

		if(empty($invoice)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/expired');
		}

		$data["invoice"] = $invoice;
		$this->template->load($this->expiredTemplate, 'expired/invoices/view', $data);

	}
*/

	public function invoiceClearanceRequestForm($invoiceId=""){
		$this->load->model('Invoice_Model', 'invoice');
		$data = array();
		if(empty($invoiceId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/expired');
		}
		$invoiceId = decodeID($invoiceId);

		$expiredCampus = $_SESSION["expiredCampus"] ;
		$invoice = $this->invoice->get($invoiceId,$expiredCampus["id"]);
		
		if(empty($invoice)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/expired');
		}
		
		$data["invoice"] = $invoice;
		$this->template->load($this->expiredTemplate, 'expired/invoices/invoiceClearnceForm', $data);
		

	}
	
	public function invoiceClearanceRequest(){
		$this->load->model('Invoice_Model', 'invoice');
		
		$invoiceId=$this->input->post("invoice_id");
		
		
		if(empty($invoiceId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/expired');
		}
		$invoiceId = decodeID($invoiceId);

		$expiredCampus = $_SESSION["expiredCampus"] ;
		$invoice = $this->invoice->get($invoiceId,$expiredCampus["id"]);
		
		if(empty($invoice)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/expired');
		}
		
		$invoice["paid_date"] = $this->input->post("invoice_paid_date");
		$invoice["payment_method"] = $this->input->post("paid_through");
		$paidThrough ="";
		if("1"==$invoice["payment_method"]){
			$paidThrough="Standard Chartered Bank";
		}elseif("2"==$invoice["payment_method"]){
			$paidThrough="Easy Paisa";
		}elseif("3"==$invoice["payment_method"]){
			$paidThrough="Mobicash";
		}
		
		
		
		$campus = $_SESSION["expiredCampus"];
		$school = $campus["school"];
		$campusId = encodeID($campus["id"]);
		$comments = $this->input->post("comments");
		
		
		$emailData= array();
		$emailData["to_email"]=get_app_message("admin.email.address");
		$emailData["from_email"]=$_SESSION["sessionUser"]["email"];
		
		$emailData["from_user_id"]=$_SESSION["sessionUser"]["id"];
		
		$emailData["email_subject"]="Invoice Clearance Request";
		$body = "Hi ".get_app_message("organization.name")." " .get_app_message("sender.email.display.name")."!";
		$body .= "<br/><br/>Following user has requested Invoice Clearance. ";
		$body .= "<br/><br/><b>Details</b> <br/>";
		$body .= "<table>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				School Name:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>".$school["school_name"]."</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Campus Name:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b><a href='".site_url("appadmin/campusDetail/".$campusId."")."'>".$campus["campus_name"]."</a></b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Invoice No.:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>".$invoice["invoice_no"]."</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Paid Date:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>".$invoice["paid_date"]."</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Paid Through:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>".$paidThrough."</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "		<tr>";
		$body .= "			<td>";
		$body .= "				Comments:  ";
		$body .= "			</td>";
		$body .= "			<td>";
		$body .= "				<b>".$comments."</b>";
		$body .= "			</td>";
		$body .= "		</tr>";
		$body .= "</table>";
		$body .= "<br/><br/>";
		$body .= "Regards";
		$body .= "<br/>".$_SESSION["sessionUser"]["display_name"];
		$body .= "<br/>".$_SESSION["sessionUser"]["user_type"]["type"];
		$body .= "<br/>".$school["school_name"];
		$body .= "<br/>".$campus["campus_name"];
		$body .= "<br/>".$_SESSION["sessionUser"]["email"];
		
		
		$emailData["email_body"]=$body;

		// send asaanschool notification 
		$response = $this->emailUser->sendEmail($emailData);
		
		// send email alert
		sendEmailAlertToUser($emailData);
		
		if($response == get_app_message("response.success")){
			$_SESSION["appMessages"][]= "Your Message has been sent to Admin for verification.";
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			
		}
		
		
		
		
		redirect('/expired');

	}






}
