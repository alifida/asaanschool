<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Guardians extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		if (! isAuthorizedController ( get_class ( $this ) )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "unauthorized.user" );
			redirect ( '/user/welcome' );
		}
	
		if(!isset($_SESSION ["guardian"]) || empty($_SESSION ["guardian"])){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/user/logout');
		}
		
		$this->load->model ( 'Guardian_Model', 'guardian' );
		$this->load->model ( 'Student_Model', 'student' );
		$this->load->model ( 'Studentguardian_Model', 'studentGuardian' );
		$this->load->model ( 'Relationtype_Model', 'relationtype' );
		$this->load->model('Studentfee_Model', 'studentfee');
		$this->load->model('Studentguardian_Model', 'studentGuardian');
		$this->load->model('Feetype_Model', 'feeType');
		$this->load->model('Studentitem_Model', 'studentitem');
		
		$this->load->model('Attendance_Model', 'attendance');
		$this->load->model('Notification_Model', 'notification');
		$this->load->model('Class_Model', 'class');
		
		
	}
	public function index() {
		$data = array ();
		$guardianId = $_SESSION ["guardian"] ["id"];
		 
		$studentStrength = $this->guardian->getCountByGuardian($guardianId);
		 
		$totalDueAmount = $this->guardian->getPaymentSumByGuardian($guardianId,get_app_message ( "db.status.due" ));
		 
		$totalPaidAmount = $this->guardian->getPaymentSumByGuardian($guardianId,get_app_message ( "db.status.paid" ));
		
		$data ["studentStrength"] = $studentStrength;
		$data ["totalDiscountAmount"] = "0";
		$data ["totalPaidAmount"] = $totalPaidAmount;
		$data ["totalDueAmount"] = $totalDueAmount;
		
		$notifications = $this->notification->getNoticeBoard();
		$data["notifications"] = $notifications;
		
		parent::loadView ( "dashboard/guardian/index", $data );
	}
	public function dependents() {
		$data = array ();
		$guardianId = $_SESSION ["guardian"] ["id"];
		$studentGuardian = $this->studentGuardian->getStudentsByGuardianId ( $guardianId );
		$data ["guardianDetail"] = $studentGuardian;
		parent::loadView ( 'guardians/readonly/view', $data );
	}
	public function timetable($classId) {
		$data = array();
		$classes = $this->class->getClassTimetable($classId);
		$data["classes"] = $classes;
		
		parent::loadView("guardians/readonly/timetable", $data);
		
	}
	public function dependent($encId) {
		
		$data= array();
		if($encId==null){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect("/guardians/dependents");
			return;
		}
		
		
		
		$studentId = decodeID($encId);
		$studentguardian = $this->studentGuardian->getByStudentIdAndGuaridanId($studentId, $_SESSION["guardian"]["id"]);
		 
		
		// no record exist
		if(empty($studentguardian)){
			$data["appErrors"][] = get_app_message("no_record_found");
			redirect("/guardians/dependents");
		}
		$student = $this->student->get($studentguardian["student_id"]);
		$data["student"] = $student;
		// Related Guardians
		$guardians = $this->studentGuardian->getByStudentId($studentId);
		$data["guardians"] = $guardians;
		
		
		// Due Items for Student
		$items = $this->studentitem->getStudentItemsByStatus($studentId, "Due");
		$data["items"] = $items;
		
		
		//Due Fee for Student
		$studentFee = $this->studentfee->getByStudentByFeeStatus($studentId, "Due");
		$data["studentFee"] = $studentFee;
		
		
		// All  Items for Student
		$allItems = $this->studentitem->getStudentItems($studentId);
		$data["allItems"] = $allItems ;
		
		
		//All Fee for Student
		$allFee = $this->studentfee->getStudentFee($studentId);
		$data["allFee"] = $allFee;
		 
		
		parent::loadView("students/readonly/view", $data);
		
	}
	public function dues() {
		$data = array ();
		$campusId=$_SESSION["currentCampus"]["id"];
		$studentDueFee = $this->studentfee->getByPaymentStatusAndGuardian($_SESSION["guardian"]["id"], get_app_message("db.status.due"));
		$studentDueItems = $this->studentitem->getByPaymentStatusAndGuardian($_SESSION["guardian"]["id"], get_app_message("db.status.due"));
		$data["studentDueFee"] = $studentDueFee;
		$data["studentDueItems"] = $studentDueItems;
		parent::loadView("students/readonly/dues", $data);
	}
	public function attendance($date = "") {
		
		$data =array();
		$isDetailAvailable = false;
		$attandanceDetails = array();
		$data["enableLoadByDate"]=true;
		$data["attendanceLabel"]="Old Attendance";
		
		 
		
		if(empty($date)){
			if(isset($_SESSION["attendanceDate"]) && !empty($_SESSION["attendanceDate"])){
				$date=$_SESSION["attendanceDate"];
			}else{
				$_SESSION["appMessages"][]= "Please Select a Date";
			}
		}else{
			$_SESSION["attendanceDate"]=$date;
		}
		
		 
		$students = $this->attendance->getByGuardianAndDate($_SESSION["guardian"]["id"],$date);
		 
		if(!empty($students[0]["attendance"]["created_by"]) && isset($students[0]["attendance"]["created_by"])){
			$isDetailAvailable =true;
			$attandanceDetails["created_by"] = $students[0]["attendance"]["created_by"];
			$attandanceDetails["updated_at"] = $students[0]["attendance"]["updated_at"];
			
		}
		$data["isDetailAvailable"] = $isDetailAvailable;
		$data["date"] = $date;
		$data["students"] = $students;
		$data["redirectTo"]= "old";
		
		 
		parent::loadView("attendance/readonly/index", $data);
		
	}
}
