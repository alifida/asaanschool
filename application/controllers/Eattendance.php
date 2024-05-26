<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Eattendance extends Protected_Controller {

	public function __construct() {

		parent::__construct();

		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			

		$this->load->model('Employeetype_Model', 'employeeType');
		$this->load->model('Employee_Model', 'employee');
		$this->load->model('Attendance_Model', 'attendance');
		/*
		 $this->load->model('Studentfee_Model', 'studentfee');
		 $this->load->model('Class_Model', 'class');
		 $this->load->model('Studentitem_Model', 'studentitem');
		 */
	}

	public function index($data =array()) {
		
		unset($_SESSION["employeeTypeId"]);
		redirect("/eattendance/take");
	}
	public function take($employeeTypeId="") {
		
		if(empty($employeeTypeId)){
			if(isset($_SESSION["employeeTypeId"]) && !empty($_SESSION["employeeTypeId"])){
				$employeeTypeId = $_SESSION["employeeTypeId"];
			}
		}else{
			$_SESSION["employeeTypeId"]=$employeeTypeId;
		}
		if(!empty($employeeTypeId)){
			$employeeTypeId = decodeID($employeeTypeId);
		}
		
		//pre_d($employeeTypeId );
		
		$data =array();

		$employeeTypes = $this->employeeType->get();
		$data["employeeTypes"] = $employeeTypes;
		$employees = $this->employee->getByType($employeeTypeId);
		if(!empty($employees)){
			foreach ($employees as $key=> $employee){
				$employees[$key]["attendance"]["attendance"] = "P";
			}
		}

		$data["selectedType"] = encodeID($employeeTypeId);
		$data["employees"] = $employees;
		$this->template->load($this->activeTemplate, "attendance/employee/index", $data);
			
	}

	public function old($employeeTypeId = "",$date = "") {

		$data =array();
		$isDetailAvailable = false;
		$attandanceDetails = array();
		$data["enableLoadByDate"]=true;
		$data["attendanceLabel"]="Old Attendance";

		if(empty($employeeTypeId)){
			if(isset($_SESSION["employeeTypeId"]) && !empty($_SESSION["employeeTypeId"])){
				$employeeTypeId = $_SESSION["employeeTypeId"];
			}else{
				$_SESSION["appMessages"][]= "Please Select Employee Type";
			}
		}else{
			$_SESSION["employeeTypeId"]=$employeeTypeId;
		}
		$employeeTypeId = decodeID($employeeTypeId);

		if(empty($date)){
			if(isset($_SESSION["attendanceDate"]) && !empty($_SESSION["attendanceDate"])){
				$date=$_SESSION["attendanceDate"];
			}else{
				$_SESSION["appMessages"][]= "Please Select a Date";
			}
		}else{
			$_SESSION["attendanceDate"]=$date;
		}

		$employeeTypes = $this->employeeType->get();
		$data["employeeTypes"] = $employeeTypes;
		$employees = $this->attendance->getByEmployeeTypeAndDate($employeeTypeId,$date);
		
		if(!empty($employees[0]["attendance"]["created_by"]) && isset($employees[0]["attendance"]["created_by"])){
			$isDetailAvailable =true;
			$attandanceDetails["created_by"] = $employees[0]["attendance"]["created_by"];
			$attandanceDetails["updated_at"] = $employees[0]["attendance"]["updated_at"];
			
		}
		$data["isDetailAvailable"] = $isDetailAvailable;
		$data["date"] = $date;
		$data["employees"] = $employees;
		$data["redirectTo"]= "old";
		
		$employeeTypeId = encodeID($employeeTypeId);
		$data["employeeTypeId"] = $employeeTypeId;
		$data["selectedType"] = $employeeTypeId;

		$this->template->load($this->activeTemplate, "attendance/employee/index", $data);
			
	}


	public function save(){

		$allEmployeeIds = explode(",", $this->input->post('all_employees'));



		if(!empty($allEmployeeIds)){
			$employeesAttendance = array();
			$saveOrUpdate = "save";
			foreach($allEmployeeIds as $employeeId){
				
				$attendance = array();
				$employeeAttendance = $this->input->post("emp-".$employeeId);
				$attendanceId = $this->input->post("att-".$employeeId);
				
				if(!empty($attendanceId)){
					$attendanceId = decodeID($attendanceId);
					$attendance["id"] = $attendanceId;
					$saveOrUpdate = "update";
				}
				
				$attendance["date"] = $this->input->post("attendance_date");
				$attendance["created_by"] = $_SESSION["sessionUser"]["id"];
				$attendance["updated_at"] = getCurrentDateTime();
				$attendance["employee_id"] = decodeID($employeeId) ;
				$attendance["attendance"] = $employeeAttendance;
				$employeesAttendance[] = $attendance;
				
			}
			//pre_d($employeesAttendance);
			if($saveOrUpdate == "save"){
				
				$response = $this->attendance->saveMultiple( $employeesAttendance );
			}else{
				
				$response = $this->attendance->updateMultiple( $employeesAttendance );
			}
			

			if($response == get_app_message("response.success")){
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			}else{
				$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			}
		}else{
			// no student
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		$redirectTo = $this->input->post("redirectTo");
		if(!empty($redirectTo) && $redirectTo == "old"){
			redirect("/eattendance/old/".$_SESSION["employeeTypeId"]."/".$_SESSION["attendanceDate"]);
		}else{
			redirect("/eattendance/take");
		}

	}


	public function edit($data = array()){

	}



}
