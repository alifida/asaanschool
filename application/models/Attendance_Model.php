<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Attendance_Model extends Base_Model {
	private $table = "attendance";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	public function getById($id = null) {
		$attendance = array ();
		if ($id == null) {
			return $attendance;
		}
		$rs = parent::getByColumn("id", $id);
		if(!empty($rs)){
			$attendance = $rs[0];
		}
		return $attendance;
	}
	public function getByStudentId($studentId = null) {
		$attendance = array ();
		if ($studentId == null) {
			return $attendance;
		}
		$attendance = parent::getByColumn("student_id", $id);
		return $attendance;
	}
	
	public function getByEmployeeId($employeeId = null) {
		$attendance = array ();
		if ($studentId == null) {
			return $attendance;
		}
		$attendance = parent::getByColumn("employee_id", $id);
		return $attendance;
		
		
	}
	public function getByStudentIds($studentIds = array(), $date = null) {
		$studentsAttendance = array ();
		if (empty ( $studentIds ) || $date == null) {
			return $studentsAttendance;
		}
		$condition = "( date = '$date'  )";
		$studentsAttendance = parent::getIn($studentIds,"student_id",$condition);
		return $studentsAttendance;
	}
	
	public function getByEmployeeIds($employeeIds = array(), $date = null) {
		$employeesAttendance = array ();
		if (empty ( $employeeIds ) || $date == null) {
			return $employeesAttendance;
		}
		
		$condition = "( date = '$date'  )";
		$studentsAttendance = parent::getIn($employeeIds,"employee_id",$condition);
		return $employeesAttendance;
	}

	public function getByClassAndDate($classId = null, $date) {
		$classAttendance = array ();
		if ($classId == null) {
			return $classAttendance;
		}
		
		// get students of class
		$campusId = $_SESSION ["currentCampus"] ["id"];
		$studentIds = array ();
		
		$this->load->model ( 'Student_Model', 'student' );
		$students = $this->student->getByClass ( $classId );
		if (! empty ( $students )) {
			foreach ( $students as $student ) {
				$studentIds [] = $student ["id"];
			}
			// get attendance by StudentIds and date
			if (! empty ( $studentIds )) {
				$classAttendance = $this->getByStudentIds ( $studentIds, $date );
				//pre_d($classAttendance );
			}
			
			if (! empty ( $classAttendance )) {
				foreach ( $students as $studentKey => $student ) {
					foreach ( $classAttendance as $attendance ) {
						if ($student ["id"] == $attendance ["student_id"]) {
							$students [$studentKey] ["attendance"] = $attendance;
							break;
						}
					}
				}
			}
		}
		return $students;
	}
	public function getByGuardianAndDate($guardianId = null, $date) {
		$guardianAttendance = array ();
		if ($guardianId == null) {
			return $guardianAttendance;
		}
		
		// get students of class
		$campusId = $_SESSION ["currentCampus"] ["id"];
		$studentIds = array ();
		
		$this->load->model ( 'Student_Model', 'student' );
		$students = $this->student->getByGuardian ( $guardianId );
		 
		if (! empty ( $students )) {
			foreach ( $students as $student ) {
				$studentIds [] = $student ["id"];
			}
			// get attendance by StudentIds and date
			if (! empty ( $studentIds )) {
				$guardianAttendance = $this->getByStudentIds ( $studentIds, $date );
				//pre_d($classAttendance );
			}
			
			if (! empty ( $guardianAttendance )) {
				foreach ( $students as $studentKey => $student ) {
					foreach ( $guardianAttendance as $attendance ) {
						if ($student ["id"] == $attendance ["student_id"]) {
							$students [$studentKey] ["attendance"] = $attendance;
							break;
						}
					}
				}
			}
		}
		return $students;
	}
	public function getByEmployeeTypeAndDate($employeeTypeId = null, $date) {
		$employeesAttendance = array ();
		if ($employeeTypeId == null) {
			return $employeesAttendance;
		}
		
		// get students of class
		$campusId = $_SESSION ["currentCampus"] ["id"];
		$employeeIds = array ();
		
		$this->load->model ( 'Employee_Model', 'employee' );
		$employees = $this->employee->getByType ( $employeeTypeId );
		if (! empty ( $employees )) {
			foreach ( $employees as $employee ) {
				$employeeIds [] = $employee ["id"];
			}
			// get attendance by StudentIds and date
			if (! empty ( $employeeIds )) {
				$employeesAttendance = $this->getByEmployeeIds ( $employeeIds, $date );
			}
			
			if (! empty ( $employeesAttendance )) {
				foreach ( $employees as $empKey => $employee ) {
					foreach ( $employeesAttendance as $attendance ) {
						if ($employee ["id"] == $attendance ["employee_id"]) {
							$employees [$empKey] ["attendance"] = $attendance;
							break;
						}
					}
				}
			}
		}
		return $employees;
	}
	
	
}
