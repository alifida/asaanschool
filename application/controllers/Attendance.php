<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

include_once('Protected_Controller.php');
class Attendance extends Protected_Controller {

	public function __construct() {

		parent::__construct();

		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			

		$this->load->model('Class_Model', 'class');
		$this->load->model('Student_Model', 'student');
		$this->load->model('Guardian_Model', 'guardian');
		$this->load->model('Attendance_Model', 'attendance');
	}

	public function index($data =array()) {
			
		redirect("/attendance/take");
			
	}
	public function take($classId="") {
		
		if(empty($classId)){
			if(isset($_SESSION["attendanceClass"]) && !empty($_SESSION["attendanceClass"])){
				$classId = $_SESSION["attendanceClass"];
			}else{
				$_SESSION["appMessages"][]= "Please Select a Class";
			}
		}else{
			$_SESSION["attendanceClass"]=$classId;
		}
		$classId = decodeID($classId);

		$data =array();

		$classes = $this->class->get();
		$data["classes"] = $classes;
		$students = $this->student->getByClass($classId);
		if(!empty($students)){
			foreach ($students as $key=> $student){
				$students[$key]["attendance"]["attendance"] = "P";
			}
		}

		$data["selectedClass"] = encodeID($classId);
		$data["students"] = $students;
		parent::loadView("attendance/index", $data);
		//$this->template->load($this->activeTemplate, "attendance/index", $data);
			
	}

	public function old($classId = "",$date = "") {

		$data =array();
		$isDetailAvailable = false;
		$attandanceDetails = array();
		$data["enableLoadByDate"]=true;
		$data["attendanceLabel"]="Old Attendance";

		if(empty($classId)){
			if(isset($_SESSION["attendanceClass"]) && !empty($_SESSION["attendanceClass"])){
				$classId = $_SESSION["attendanceClass"];
			}else{
				$_SESSION["appMessages"][]= "Please Select a Class";
			}
		}else{
			$_SESSION["attendanceClass"]=$classId;
		}
		$classId = decodeID($classId);

		if(empty($date)){
			if(isset($_SESSION["attendanceDate"]) && !empty($_SESSION["attendanceDate"])){
				$date=$_SESSION["attendanceDate"];
			}else{
				$_SESSION["appMessages"][]= "Please Select a Date";
			}
		}else{
			$_SESSION["attendanceDate"]=$date;
		}

		$classes = $this->class->get();
		$data["classes"] = $classes;
		$students = $this->attendance->getByClassAndDate($classId,$date);
		
		if(!empty($students[0]["attendance"]["created_by"]) && isset($students[0]["attendance"]["created_by"])){
			$isDetailAvailable =true;
			$attandanceDetails["created_by"] = $students[0]["attendance"]["created_by"];
			$attandanceDetails["updated_at"] = $students[0]["attendance"]["updated_at"];
			
		}
		$data["isDetailAvailable"] = $isDetailAvailable;
		$data["date"] = $date;
		$data["students"] = $students;
		$data["redirectTo"]= "old";
		
		$classId = encodeID($classId);
		$data["classId"] = $classId;
		$data["selectedClass"] = $classId;

		$this->template->load($this->activeTemplate, "attendance/index", $data);
			
	}


	public function save(){

		$allStudentIds = explode(",", $this->input->post('all_students'));

		if(!empty($allStudentIds)){
			$classAttendance = array();
			 
			$saveOrUpdate = "save";
			
			foreach($allStudentIds as $studentId){
				
				$attendance = array();
				$studentAttendance = $this->input->post("stu-".$studentId);
				$attendanceId = $this->input->post("att-".$studentId);
				
				if(!empty($attendanceId)){
					$attendanceId = decodeID($attendanceId);
					$attendance["id"] = $attendanceId;
					$saveOrUpdate = "update";
				}
				
				$attendance["date"] = $this->input->post("attendance_date");
				$attendance["created_by"] = $_SESSION["sessionUser"]["id"];
				$attendance["updated_at"] = getCurrentDateTime();
				$attendance["student_id"] = decodeID($studentId) ;
				$attendance["attendance"] = $studentAttendance;
				$classAttendance[] = $attendance;
				 
				
				
			}
			if($saveOrUpdate == "save"){
				
				$response = $this->attendance->saveMultiple( $classAttendance );
				
				
			}else{
				
				$response = $this->attendance->updateMultiple( $classAttendance );
			}
			

			if($response == get_app_message("response.success")){
				foreach ($classAttendance as $att){
					$this->generateAlertOnAttendance($att);
				}
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
				
			}else{
				$_SESSION["appErrors"][]= get_app_message("cannot_process_request")."<br/>Kindly check in old attendance, selected class attendance in provided date may already be taken.";
			}
		}else{
			// no student
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		
		 
		$redirectTo = $this->input->post("redirectTo");
		if(!empty($redirectTo) && $redirectTo == "old"){
			redirect("/attendance/old/".$_SESSION["attendanceClass"]."/".$_SESSION["attendanceDate"]);
		}else{
			redirect("/attendance/index");
		}

	}

	private function generateAlertOnAttendance($attendance){
		
		$studentId =$attendance["student_id"]; 
		$date =$attendance["date"] ;
		$attendance =$attendance["attendance"];
		
		if(!empty($studentId) && !empty($date ) && !empty($attendance)){
			$student = $this->student->get($studentId);
			$gEmails = $this->guardian->getEmailAddresses(null, $studentId);
			$addresses = array();
			if(!empty($student) && !empty($student["email"])){
				$addresses[] = $student["email"];
			}
			if(!empty($gEmails)){
				foreach ($gEmails as $email){
					$addresses[] = $email["email"];
				}
			}
			
			$studentName = $student["first_name"]." ".$student["last_name"];
			$att = $attendance["attendance"];
			$date = $attendance["date"];
			
			if("P"== $att){
				$att ="Present";
			}elseif("L"== $att){
				$att ="Leave";
			}elseif("A"== $att){
				$att ="Absent";
			}
			
			$addresses= array_unique($addresses);
			$campusDetails = $_SESSION["currentCampus"]["campus_name"];
			$emailData= array();
			
			
			$emailData["email_subject"]="Attendance Alert";
			 
			
			$emailData["email_body"]="Sir/Madam,
						<br/>
						<br/>
						Most respectfully, it is informed that $studentName's attendance is marked as $att on $date.
						
						<br/>
						<br/>
						Thanking you!
						<br/>
						<br/>
						Sincerely,
						<br/>
						<br/>
						Admin<br/>
						$campusDetails";
						generateAlertOnEvent(null, $addresses, $emailData);
		}
	}
	
	





	public function edit($data = array()){

	}



}
