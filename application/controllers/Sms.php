<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Sms extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'Student_Model', 'student' );
		$this->load->model ( 'Guardian_Model', 'guardian' );
		$this->load->model ( 'Studentitem_Model', 'studentitem' );
		$this->load->model ( 'Studentfee_Model', 'studentfee' );
		$this->load->model ( 'Studentguardian_Model', 'studentGuardian' );
		/*
		 * $this->load->model('Studentfee_Model', 'studentfee');
		 * $this->load->model('Class_Model', 'class');
		 * $this->load->model('Studentitem_Model', 'studentitem');
		 */
	}
	public function index($data = array()) {
	}
	public function defaultersNotificationForm() {
		$data = array ();
		$dues = $this->student->getDues();
		$studentIds = array ();
		if (! empty ( $dues )) {
			foreach ( $dues as $student ) {
				$studentIds [] = $student ["id"];
			}
		}
		
		$guardians = $this->guardian->getByStuents ( $studentIds );
		$jsonGuardian = array ();
		if (! empty ( $guardians )) {
			foreach ( $guardians as $guardian ) {
				$tempGuardian ["id"] = $guardian ["id"];
				$tempGuardian ["name"] = $guardian ["name"] . "(" . $guardian ["mobile"] . ")";
				$jsonGuardian [] = $tempGuardian;
			}
		}
		
		$prePopulateGuardian = json_encode ( $jsonGuardian );
		$data ["prePopulateGuardian"] = $prePopulateGuardian;
		$this->template->load($this->activeTemplate,  "sms/defaulter_notification_form", $data );
	}
	public function defaultersNotification() {
		$notificationsSent = array();
		$notificationsFailed = array();
		
		$defaulterGuardianIds = $this->input->post ( "defaulter_guardians" );
		$guardians = $this->guardian->getByIds ( $defaulterGuardianIds );
		
		if (! empty ( $guardians )) {
			foreach ( $guardians as $guardian ) {
				$sms = array ();
				if (isset ( $guardian ["mobile"] ) && ! empty ( $guardian ["mobile"] )) {
					
					$students = $this->studentGuardian->getStudentsByGuardianId ( $guardian ["id"] );
					if (isset ( $students["students"] ) && ! empty ( $students["students"] )) {
						foreach ( $students["students"] as $student ) {
							// check if student is of current campus
							if (isset($student ["campus_id"]) && $student ["campus_id"] == $_SESSION ["currentCampus"] ["id"]) {
								// get student dues
								$items = $this->studentitem->getStudentItemsByStatus ( $student ["id"], "Due" );
								$studentFee = $this->studentfee->getByStudentByFeeStatus ( $student ["id"], "Due" );
								// calculate total dues.
								
								$dues = 0;
								if (! empty ( $items )) {
									foreach ( $items as $item ) {
										$dues = $dues + $item ["due_money"];
									}
								}
								if (! empty ( $studentFee )) {
									foreach ( $studentFee as $fee ) {
										$dues = $dues + $fee ["amount"];
									}
								}
								
								// send sms
								$message = "Hello! " . $guardian ['name'] . ", Please clear the due amount Rs." . $dues . " of " . $student ["first_name"] . " " . ($student ["last_name"]) ? $student ["last_name"] : "";
								$message .= "Sender: " . $_SESSION ["currentCampus"] ["campus_name"];
								$sms ["to"] = $guardian ["mobile"];
								$sms ["message"] = $message;
								$sms ["sender"] = $_SESSION ["currentCampus"] ["campus_name"];
								$smsStatus = sendPublicSMS ( $sms );
								
								if($smsStatus == true){
									$sentFor = "";
									$studentDetail = $student ["first_name"] . " " .($student ["last_name"]) ? $student ["last_name"] : "" ;
									$studentDetail .= $student["class"]['name']. "(". $student["roll_no"].")";
									$sentFor = "Student Details: <strong>" .$studentDetail."</strong><br/>";
									$sentFor .= "Guardian Details: <strong>".$guardian["name"]." (".$guardian["mobile"].")</strong>";
									$_SESSION ["appMessages"] [] = "SMS sent to : ".$sentFor;
								}else{
									$faildFor = "";
									$studentDetail = $student ["first_name"] . " " .($student ["last_name"]) ? $student ["last_name"] : "" ;
									$studentDetail .= $student["class"]["name"]. "(". $student["roll_no"].")";
									$faildFor = "Student Details: <strong>" .$studentDetail."</strong><br/>";
									$faildFor .= "Guardian Details: <strong>".$guardian["name"]." (".$guardian["mobile"].")</strong>";
									$_SESSION ["appErrors"] [] = "SMS not sent to : ". $faildFor;
								}
							}
						}
					}
				}
			}
			
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "student/dues" );
	}
	public function edit($data = array()) {
	}
	public function save($data = array()) {
	}
}
