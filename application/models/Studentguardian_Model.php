<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Studentguardian_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null) {
		$this->db->select()->from('students_guardians');

		// where condition if id is present
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}
		$query = $this->db->get();
		if ($id != null) {
			$row = $query->row_array(); // single row
			if(!empty($row)){
				$this->load->model('Studnet_Model', 'student');
				$this->load->model('Guardian_Model', 'guardian');
				$this->load->model('Relationtype_Model', 'relationType');
				$student = $this->student->get($row["student_id"]);
				$guardian = $this->guardian->get($row["guardian_id"]);
				$relationType = $this->relationType->get($row["relation_type_id"]);
				$row["relationType"]=$relationType;
				$row["student"]=$student;
				$row["guardian"]=$guardian;
			}
			return $row;
		} else {
			$rs = $query->result_array(); // array of result
			if(!empty($rs)){
				$this->load->model('Studnet_Model', 'student');
				$this->load->model('Guardian_Model', 'guardian');
				$this->load->model('Relationtype_Model', 'relationType');
				foreach($rs as $key => $row){
					$student = $this->student->get($row["student_id"]);
					$guardian = $this->guardian->get($row["guardian_id"]);
					$relationType = $this->relationType->get($row["relation_type_id"]);
					$row[$key]["relationType"]=$relationType;
					$rs[$key]["student"]=$student;
					$rs[$key]["guardian"]=$guardian;
				}
			}
			return $rs;
		}
	}

	public function getStudentsByGuardianId($guardianId = null) {
		$rs = array();

		if($guardianId == null){
			return $rs;
		}

		$this->load->model('Guardian_Model', 'guardian');
		$guardian = $this->guardian->get($guardianId);


		$this->db->select()->from('students_guardians');

		$this->db->where('guardian_id', $guardianId);

		$query = $this->db->get();
		$rs = $query->result_array(); // array of result
		if(!empty($rs)){
			$this->load->model('Studnet_Model', 'student');
			$this->load->model('Relationtype_Model', 'relationType');
			$students= array();
			foreach($rs as $key => $row){
				$relationType = $this->relationType->get($row["relation_type_id"]);
				$row[$key]["relationType"]=$relationType;
				$student = $this->student->get($row["student_id"]);
				$student["relationType"] = $relationType;
				$students[]=$student;
			}
			$rs["students"]=$students;

		}
		$rs["guardian"]=$guardian;

		return $rs;

	}
	
	



	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('students_guardians');
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

		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('students_guardians', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			// check unique constraint
			$sg = $this->getByStudentIdAndGuaridanId($data["student_id"], $data["guardian_id"]);
			if(empty($sg)){
				$this->db->insert('students_guardians', $data); // insert new record
				$newId = $this->db->insert_id();
				$this->db->trans_complete();
				return $newId;
			}else{
				return "duplicateEntry";
			}


		}
	}


	public function getByStudentId($studentId){

		$query = $this->db->query("SELECT\n".
				"	g.*, rt.relation\n".
				" FROM\n".
				"	guardians g,\n".
				"	students_guardians sg,\n".
				"	students s,\n".
				"	relation_types rt\n".
				" WHERE\n".
				"	g.id = sg.guardian_id\n".
				" AND sg.student_id = s.id\n".
				" AND sg.relation_type_id = rt.id\n".
				" AND s.id = ".$studentId);
		$rs = $query->result_array();
		return $rs;
	}

	public function getByGuardianId($guardianId){

		$query = $this->db->query("SELECT\n".
				"	g.*, rt.relation\n".
				" FROM\n".
				"	guardians g,\n".
				"	students_guardians sg,\n".
				"	students s,\n".
				"	relation_types rt\n".
				" WHERE\n".
				"	g.id = sg.guardian_id\n".
				" AND sg.student_id = s.id\n".
				" AND sg.relation_type_id = rt.id\n".
				" AND g.id = ".$guardianId);
		$rs = $query->row_array();
		return $rs;
	}


	public function getByStudentIdAndGuaridanId($studentId, $guardianId){

		$query = $this->db->query("SELECT\n".
				"	g.*, rt.relation, s.id as student_id, sg.id as student_guardian_id, rt.id as relation_type_id \n".
				" FROM\n".
				"	guardians g,\n".
				"	students_guardians sg,\n".
				"	students s,\n".
				"	relation_types rt\n".
				" WHERE\n".
				"	g.id = sg.guardian_id\n".
				" AND sg.student_id = s.id\n".
				" AND sg.relation_type_id = rt.id\n".
    			" AND g.id = ".$guardianId.
				" AND s.id = ".$studentId);
		$rs = $query->row_array();

		return $rs;
	}
	
	
	

}
