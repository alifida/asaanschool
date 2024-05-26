<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}

include_once('Protected_Controller.php');
class Report extends Protected_Controller {
	public function __construct() {
		parent::__construct ();

		
		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			
		
		
		$this->load->model ( 'Moneytransaction_Model', 'transaction' );
		$this->load->model ( 'Reportconfiguration_Model', 'reportConfig' );
		$this->load->helper ( 'pdf_helper' );
		
		/*
		 * $this->load->model('Studentfee_Model', 'studentfee');
		 * $this->load->model('Class_Model', 'class');
		 * $this->load->model('Studentitem_Model', 'studentitem');
		 */
	}
	public function index($data = array()) {
		
		/*
		 * $data ["title"] = "Student Dues Clearance";
		 *
		 * $this->template->load($this->activeTemplate,  'reports/pdfreport', $data );
		 */
		redirect ( "report/setting" );
	}
	public function setting() {
		$data = array ();
		
		$reportConf = $this->reportConfig->getByCampus ();
		
		$data ["reportConf"] = $reportConf;
		$this->template->load($this->activeTemplate,  'reports/config/index', $data );
	}
	public function editSettings() {
		$data = array ();
		
		$reportConf = $this->reportConfig->getByCampus ();
		
		$data ["reportConf"] = $reportConf;
		$this->template->load($this->activeTemplate,  'reports/config/editForm', $data );
	}
	public function saveSettings() {
		$data = array ();
		
		$reportConfig = array ();
		
		$title = $this->input->post ( "report_title" );
		$headerString = $this->input->post ( "header_string" );
		$logoWidth = $this->input->post ( "logo_width" );
		$logoPath = $this->input->post ( "logo_path" );
		$stampPath = $this->input->post ( "stamp_path" );
		
		$reportConfig ["campus_id"] = $_SESSION ["currentCampus"] ["id"];
		
		if (! empty ( $title )) {
			$reportConfig ["title"] = $title;
		}
		
		if (! empty ( $headerString )) {
			$reportConfig ["header_string"] = $headerString;
		}
		
		if (! empty ( $logoPath )) {
			$reportConfig ["logo"] = $logoPath;
		}
		
		if (! empty ( $stampPath )) {
			$reportConfig ["stamp"] = $stampPath;
		}
		
		if (! empty ( $logoWidth )) {
			$reportConfig ["logo_width"] = $logoWidth;
		}
		
		$response = $this->reportConfig->mergeByCampus ( $reportConfig );
		
		$reportConfig = $this->reportConfig->getByCampus ();
		
		if (! is_numeric ( $response ) && $response != get_app_message ( "response.success" )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			
			
		} else {
			
			
			
			if (! empty ( $logoPath )) {
				$filePostFix = get_random_string()."report-logo";
				if($response == get_app_message ( "response.success" )){
					$filePostFix= encodeID($reportConfig["id"])."report-logo";
				}else{
					$student["id"] = $response;
					$filePostFix= encodeID($reportConfig["id"])."report-logo";
				}
				
				// replace current profile pic with temp one. and delete from temp
				$absolutePath = ImageFileUpdateWithTemp ( $logoPath , $filePostFix );
				$reportConfig ["logo"] = $absolutePath;
				
				// 2nd call to DB
				$response = $this->reportConfig->merge($reportConfig);
				if($response !=get_app_message ( "response.success" )){
					$_SESSION["appErrors"][]= get_app_message("Cannot save Logo. Please try again later.");
				}
			}
			if (! empty ( $stampPath )) {
				$filePostFix = get_random_string()."report-stamp";
				if($response == get_app_message ( "response.success" )){
					$filePostFix= encodeID($reportConfig["id"])."report-stamp";
				}else{
					$student["id"] = $response;
					$filePostFix= encodeID($reportConfig["id"])."report-stamp";
				}
				
				// replace current profile pic with temp one. and delete from temp
				$absolutePath = ImageFileUpdateWithTemp ( $stampPath , $filePostFix );
				$reportConfig ["stamp"] = $absolutePath;
				
				// 2nd call to DB
				$response = $this->reportConfig->merge($reportConfig);
				if($response !=get_app_message ( "response.success" )){
					$_SESSION["appErrors"][]= get_app_message("Cannot save stamp. Please try again later.");
				}
			}
			
			
			
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
			$_SESSION ["reportConf"] = $reportConfig;
		}
		
		redirect ( "/report/setting/" );
	}
	public function student_payment_receipt($encodedTransactionId = "") {
		if (empty ( $encodedTransactionId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( '/student' );
		}
		
		$transactionId = decodeID ( $encodedTransactionId );
		
		$transaction = $this->transaction->getDetails ( $transactionId );
		if (empty ( $transaction )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( '/student' );
		}
		
		$studentDetails = array ();
		if (isset ( $transaction ["studentFee"] ["0"] ["student"] ) && ! empty ( $transaction ["studentFee"] ["0"] ["student"] )) {
			$studentDetails = $transaction ["studentFee"] ["0"] ["student"];
		} elseif (isset ( $transaction ["studentItems"] ["0"] ["student"] ) && ! empty ( $transaction ["studentItems"] ["0"] ["student"] )) {
			$studentDetails = $transaction ["studentItems"] ["0"] ["student"];
		}
		
		$paymentMadeBy = "";
		if (isset ( $transaction ["studentFee"] ["0"] ["paid_by"] ) && ! empty ( $transaction ["studentFee"] ["0"] ["paid_by"] )) {
			$paymentMadeBy = $transaction ["studentFee"] ["0"] ["paid_by"];
		} elseif (isset ( $transaction ["studentItems"] ["0"] ["paid_by"] ) && ! empty ( $transaction ["studentItems"] ["0"] ["paid_by"] )) {
			$paymentMadeBy = $transaction ["studentItems"] ["0"] ["paid_by"];
		}
		
		if (! empty ( $paymentMadeBy )) {
			// $paymentMadeBy = strstr($paymentMadeBy, '-');
			if (($tmp = strstr ( $paymentMadeBy, '-' )) !== false) {
				$paymentMadeBy = substr ( $tmp, 2 );
			}
		}
		
		$reportConf = $this->reportConfig->getByCampus ();
		
		if (empty ( $reportConf )) {
			if (empty ( $_SESSION ["currentCampus"] ["campus_logo"] )) {
				$reportConf ["logo"] = null;
				$reportConf ["logo_width"] = null;
			} else {
				$reportConf ["logo"] = $_SESSION ["currentCampus"] ["campus_logo"];
				$reportConf ["logo_width"] = 15;
			}
			if (! empty ( $_SESSION ["currentCampus"] ["campus_name"] )) {
				$reportConf ["title"] = $_SESSION ["currentCampus"] ["campus_name"];
				$reportConf ["header_string"] = $_SESSION ["currentCampus"] ["campus_name"];
			} else {
				$reportConf ["title"] = "";
				$reportConf ["header_string"] = "";
			}
		}
		 
		$data ["header"] = $reportConf;
		$data ["paymentMadeBy"] = $paymentMadeBy;
		$data ["studentDetails"] = $studentDetails;
		$data ["transaction"] = $transaction;
		$this->load->view( 'reports/studentDuesPaidReport', $data );
	}
	
	public function bulk_student_payment_receipt($plainIds = "") {
		if (empty ( $plainIds )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( '/student' );
		}
		$plainIds = str_replace("_", ",", $plainIds);
		 
		$transactions = $this->transaction->getDetailsByIds ( $plainIds );
		if (empty ( $transactions )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( '/student' );
		}
		
		$reportConf = $this->reportConfig->getByCampus ();
		
		if (empty ( $reportConf )) {
			if (empty ( $_SESSION ["currentCampus"] ["campus_logo"] )) {
				$reportConf ["logo"] = null;
				$reportConf ["logo_width"] = null;
			} else {
				$reportConf ["logo"] = $_SESSION ["currentCampus"] ["campus_logo"];
				$reportConf ["logo_width"] = 15;
			}
			if (! empty ( $_SESSION ["currentCampus"] ["campus_name"] )) {
				$reportConf ["title"] = $_SESSION ["currentCampus"] ["campus_name"];
				$reportConf ["header_string"] = $_SESSION ["currentCampus"] ["campus_name"];
			} else {
				$reportConf ["title"] = "";
				$reportConf ["header_string"] = "";
			}
		}
		
		$data ["header"] = $reportConf;
		$data ["transactions"] = $transactions;
		$this->load->view( 'reports/multipleStudentDuesPaidReport', $data );
	}
	public function example($data = array()) {
		$this->template->load($this->activeTemplate,  'reports/example', $data );
	}
	
}
