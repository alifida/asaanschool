<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Student_Model extends CI_Model {


	public $campusId ;

	public function __construct() {
		parent::__construct();
		$this->campusId = $_SESSION["currentCampus"]["id"];
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null) {
		$this->db->select()->from('students');

		// where condition if id is present
		if ($id != null) {
			$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		} else {
			$this->db->where('campus_id', $this->campusId);
			$this->db->order_by('id');
		}
		$query = $this->db->get();
		if ($id != null) {
			$student = $query->row_array(); // single row
			// get referenced objects
			if($student!=null && !empty($student)){
				$this->load->model('Class_Model', 'class');
				$this->load->model('Guardian_Model', 'guardian');
				$class = $this->class->get($student['class_id']);
				$student["class"]= $class;
				$student["class"]= $class;

				$guardians = $this->guardian->getByStuents(array($student['id']));
				if(!empty($guardians)){
    				$student["guardian"]= $guardians[0];
				}
			}
			return $student;
		} else {
			$students = $query->result_array(); // array of result
			// get referenced objects
			if($students!=null && !empty($students)){
				$this->load->model('Class_Model', 'class');
				$this->load->model('Guardian_Model', 'guardian');
				foreach($students as $key => $student){
					$class = $this->class->get($student['class_id']);
					$students[$key]["class"]= $class;
					
					
					$guardians = $this->guardian->getByStuents(array($student['id']));
					if(!empty($guardians)){
					    $students[$key]["guardian"]= $guardians[0];
					}
					
				}
			}

			return $students;
		}
	}
	public function getEmailAddresses($classId=null, $studentIds=null){
		$sql ="select distinct email from students where email is not null and email <> '' and campus_id = '$this->campusId'  ";
		if(!empty($classId)){
			$sql .= " and class_id= '$classId' ";
		}
		 
		if(!empty($studentIds)){
			$sql .= " and id in($studentIds) ";
		}
		 
		$query = $this->db->query ( $sql );
		return $query->result_array ();
	}
	 
	public function getByIds($ids = array()) {
		$this->db->select()->from('students');
		$students=array();

		if (!empty($ids)) {
			$this->db->where('campus_id', $this->campusId);
			$this->db->where_in('id', $ids);
			$this->db->order_by('first_name asc, last_name asc');

			$query = $this->db->get();

			$students = $query->result_array();
			// get referenced objects
			if($students!=null && !empty($students)){
				$this->load->model('Class_Model', 'class');
				foreach($students as $key => $student){
					$class = $this->class->get($student['class_id']);
					$students[$key]["class"]= $class;
				}
			}
		}
		return $students;

	}

	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {

		$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		$this->db->delete('students');
	}

	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert. One function doing both add and edit.
	 * @param $data
	 */
	public function merge($data) {

		// comma must be the first and last character of String if it is not empty.

		$newId = "";
		$this->db->trans_start();
		$data["campus_id"] = $this->campusId;
		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('students', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('students', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}

	public function getByStatus($status = null) {
		$this->db->select()->from('students');
		$students = array();
		// where condition if id is present
		if ($status != null) {
			$this->db->where("(campus_id = '$this->campusId' AND status = '$status')");

			$query = $this->db->get();

			$students = $query->result_array(); // array of result
			// get referenced objects
			if($students!=null && !empty($students)){
				$this->load->model('Class_Model', 'class');
				foreach($students as $key => $student){
					$class = $this->class->get($student['class_id']);
					$students[$key]["class"]= $class;
				}
			}
		}
		return $students;
	}
	public function getByClass($classId = null) {
		$this->db->select()->from('students');
		$students = array();
		// where condition if id is present
		if ($classId != null) {
			//$this->db->where('class_id', $classId);
			$this->db->where("(campus_id = '$this->campusId' AND class_id = '$classId' AND status = '".get_app_message("db.status.active")."')");
			//$this->db->where('status', get_app_message("db.status.active"));

			$query = $this->db->get();

			$students = $query->result_array(); // array of result
			// get referenced objects
			if($students!=null && !empty($students)){
				$this->load->model('Class_Model', 'class');
				foreach($students as $key => $student){
					$class = $this->class->get($student['class_id']);
					$students[$key]["class"]= $class;
				}
			}
		}
		return $students;
	}

	public function getByClassIds($classIds = array()) {
		if(empty($classIds)){
			return array();
		}
		$this->db->select()->from('students');
		$students=array();
		$this->db->where("(campus_id = '$this->campusId')");
		$this->db->where_in('class_id', $classIds);

		$query = $this->db->get();

		$students = $query->result_array();
		// get referenced objects
		if($students!=null && !empty($students)){
			$this->load->model('Class_Model', 'class');
			foreach($students as $key => $student){
				$class = $this->class->get($student['class_id']);
				$students[$key]["class"]= $class;
			}
		}
		return $students;
	}

	
	public function getByGuardian($guardianId = null){
		
		$rs = array();
		if(empty($guardianId)){
			return $rs;
		}
		
		$sql ="select s.* from students s, students_guardians sg "
				." where s.id= sg.student_id  "
				." and sg.guardian_id = '$guardianId' " ;
								
			 				
		$query = $this->db->query ( $sql );
		$rs = $query->result_array ();
		return $rs;
	}



	function getAutocomplete($params) {
		$arr = array();

		$sqlString =
        	"SELECT\n".
			"	s.id,\n".
			"	CONCAT(s.`first_name` ,\" \", s.`last_name`,\" (\", c.`name`,\" - \", s.roll_no,\" )\") as `name` \n".
			"FROM\n".
			"	students s, classes c \n".
			"WHERE\n".
			" c.id = s.class_id	\n".
			" AND	s.`campus_id`= '".$this->campusId."'\n".
			" AND	s.`status`= '".get_app_message("db.status.active")."'\n".
			" AND (s.`first_name` LIKE '%".$params["q"]."%' OR s.`last_name` LIKE '%".$params["q"]."%' ) ";

		$query = $this->db->query($sqlString);
		$items = $query->result_array();

		# JSON-encode the response
		$json_response = json_encode($items);

		# Optionally: Wrap the response in a callback function for JSONP cross-domain support
		if ($params["callback"]) {
			$json_response = $params["callback"] . "(" . $json_response . ")";
		}
		return $json_response;
	}


	public function prePopulate($studentId) {

		$sqlString =
        	"SELECT\n".
			"	s.id,\n".
			"	CONCAT(s.`first_name` ,\" \", s.`last_name`,\" (\", c.`name`,\" - \", s.roll_no,\" )\") as `name` \n".
			"FROM\n".
			"	students s, classes c \n".
			"WHERE\n".
			" c.id = s.class_id	\n".
			" AND	s.`status`= '".get_app_message("db.status.active")."'\n".
			" AND s.id = ".$studentId;
			" AND s.campus_id = ".$this->campusId;

		$query = $this->db->query($sqlString);
		$students = $query->result_array();

		# JSON-encode the response
		$json_response = json_encode($students);

		# Optionally: Wrap the response in a callback function for JSONP cross-domain support

		return $json_response;
	}


	public function getStudentsJSON($classId){

		$sqlString = "SELECT\n".
						"	s.id as `index`, CONCAT(s.`first_name` ,\" \", s.`last_name`,\" (\", c.`name`,\" - \", s.roll_no,\" )\") as `name`\n".
						" FROM\n".
						"	students s, classes c\n".
						" WHERE \n".
						" s.`status` = 'Active'	\n".
						" AND s.class_id = c.id";
						" AND s.campus_id = ".$this->campusId;
		if(!empty($classId)){
			$sqlString = $sqlString. " AND c.id = s.class_id ";
			$sqlString = $sqlString. " AND c.id = ".$classId;
		}

		$sqlString = $sqlString. " group by s.id";
		$query = $this->db->query($sqlString);
		$students = $query->result_array();
		$json_response = json_encode($students);
		return $json_response;

	}


	public function getByFeeDateByClassByFeeType($feeDate, $classId, $feeTypeId){

		$sqlString = "SELECT \n".
						"	s.id as `index`, CONCAT(s.`first_name` ,\" \", s.`last_name`,\" (\", c.`name`,\" - \", s.roll_no,\" )\") as `name`\n".
						" FROM \n".
						"	students s, \n".
						"	student_fee sf, \n".
						"	classes c \n".
						" WHERE \n".
						"	s.id = sf.student_id \n".
						" AND sf.fee_date = '".$feeDate."' \n".
						" AND c.id = s.class_id \n".
						" AND s.class_id = ".$classId." \n".
						" AND sf.fee_type_id = ".$feeTypeId." ";
						" AND s.campus_id = ".$this->campusId;
		$query = $this->db->query($sqlString);
		$students = $query->result_array();

		$json_response = json_encode($students);
		return $json_response;
	}

	public function promoteStudentsToClass($studentIds, $toClassId){
		$response = get_app_message("response.failed");

		if(!empty($studentIds) && !empty($toClassId)){
			$students = $this->getByIds($studentIds);
			if(!empty($students)){
				foreach($students as $key => $student){
					$student["class_id"] = $toClassId;
					unset($student["class"]);
					$this->merge($student);
				}
				$response =  get_app_message("response.success");
			}

		}

		return $response;
	}


	public function getStudentsByAdmissionYear( $year){
		$students = array();
		$this->db->select()->from('students');
		$this->db->where("(students.campus_id = '$this->campusId' AND students.admission_date like ('$year%'))");
		$this->db->order_by('admission_date', 'desc');
		$query = $this->db->get();
		$students = $query->result_array(); // array of result
		return $students;
	}
	 

	public function countStudentsByStatus( $status){
		$this->db->where("(students.campus_id = '$this->campusId' AND students.status ='$status')");
		$count = $this->db->count_all_results('students');
		return $count;

	}

	public function getDues(){
		
		$campusId = $this->campusId;
		
		$this->load->model('Studentfee_Model', 'studentfee');
		$this->load->model('Studentitem_Model', 'studentitem');
		
		$studentDueFee = $this->studentfee->getByPaymentStatus($campusId, get_app_message("db.status.due"));
		$studentDueItems = $this->studentitem->getByPaymentStatus($campusId, get_app_message("db.status.due"));
		
		$studentIds = array();
		
		if(!empty($studentDueFee)){
			foreach ($studentDueFee as $sf){
				$studentIds[]=$sf["student_id"];
			}
		}
		
		
		if(!empty($studentDueItems)){
			foreach ($studentDueItems as $si){
				$studentIds[]=$si["student_id"];
			}
		}
		
		
		$dues = $this->getByIds($studentIds);
		return $dues;
		
	}
	
	
	


}
