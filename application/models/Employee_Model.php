<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Employee_Model extends Base_Model {
	private $table = "employees";
	public $campusId;
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
		$this->campusId = $_SESSION ["currentCampus"] ["id"];
	}
	public function get($id = null) {
		$rs = array ();
		if ($id != null) {
			$condition = "(campus_id = '$this->campusId' AND id = '$id')";
			$rs = parent::getByCondition ( $condition );
			if (! empty ( $rs )) {
				$rs = $rs [0];
				$this->load->model ( 'Employeetype_Model', 'employeeType' );
				$employeeType = $this->employeeType->get ( $rs ["employee_type_id"] );
				$rs ["type"] = $employeeType;
			}
		} else {
			$condition = "(campus_id = '$this->campusId')";
			$rs = parent::getByCondition ( $condition );
			$this->load->model ( 'Employeetype_Model', 'employeeType' );
			foreach ( $rs as $key => $employee ) {
				$employeeType = $this->employeeType->get ( $employee ["employee_type_id"] );
				$rs [$key] ["type"] = $employeeType;
			}
		}
		
		return $rs;
	}
	
	public function getEmailAddresses(){
		$sql ="select distinct email from $this->table where email is not null and email <> '' and campus_id = '$this->campusId'  ";
		return parent::getBySQLQuery($sql);
		
	}
	
	/*
	 * public function get($id = null) {
	 * $this->db->select ()->from ( 'employees' );
	 *
	 * if ($id != null) {
	 * $this->db->where ( "(campus_id = '$this->campusId' AND id = '$id')" );
	 * } else {
	 * $this->db->where ( 'campus_id', $this->campusId );
	 * $this->db->order_by ( 'id' );
	 * }
	 * $query = $this->db->get ();
	 *
	 * if ($id != null) {
	 * $employee = $query->row_array (); // single row
	 * if (! empty ( $employee )) {
	 * $this->load->model ( 'Employeetype_Model', 'employeeType' );
	 * $employeeType = $this->employeeType->get ( $employee ["employee_type_id"] );
	 * $employee ["type"] = $employeeType;
	 * }
	 *
	 * return $employee;
	 * } else {
	 * $employees = $query->result_array (); // array of result
	 * if (! empty ( $employees )) {
	 * $this->load->model ( 'Employee_Model', 'employeeType' );
	 * foreach ( $employees as $key => $employee ) {
	 * $employeeType = $this->employeeType->get ( $employee ["employee_type_id"] );
	 * $employees [$key] ["type"] = $employeeType;
	 * }
	 * }
	 * return $employees;
	 * }
	 * }
	 */
	public function getByIds($ids = array()) {
		$this->db->select ()->from ( 'employees' );

		if (! empty ( $ids )) {
			$this->db->where ( 'campus_id', $this->campusId );
			$this->db->where_in ( 'id', $ids );
		}
		
		$query = $this->db->get ();
		
		$employees = $query->result_array (); // array of result
		if (! empty ( $employees )) {
			$this->load->model ( 'Employee_Model', 'employeeType' );
			foreach ( $employees as $key => $employee ) {
				$employeeType = $this->employeeType->get ( $employee ["employee_type_id"] );
				$employees [$key] ["type"] = $employeeType;
			}
		}
		return $employees;
	}
	public function getByStatus($status = "") {
		if (empty ( $status )) {
			$status = get_app_message ( "db.status.active" );
		}
		
		$this->db->select ()->from ( 'employees' );
		// $this->db->where('status', $status);
		$this->db->where ( "(campus_id = '$this->campusId' AND status = '$status')" );
		$this->db->order_by ( 'first_name' );
		
		$query = $this->db->get ();
		
		$employees = $query->result_array (); // array of result
		
		if (! empty ( $employees )) {
			$this->load->model ( 'Employee_Model', 'employeeType' );
			foreach ( $employees as $key => $employee ) {
				$employeeType = $this->employeeType->get ( $employee ["employee_type_id"] );
				$employees [$key] ["type"] = $employeeType;
			}
		}
		return $employees;
	}
	public function getByType($typeId = "") {
		$status = get_app_message ( "db.status.active" );
		$this->db->select ()->from ( 'employees' );
		$this->db->where ( 'campus_id', $this->campusId );
		$this->db->where ( 'status', $status );
		if (! empty ( $typeId )) {
			$this->db->where ( 'employee_type_id', $typeId );
		}
		// $this->db->where("(employee_type_id = '$this->campusId' AND status = '$status')");
		$this->db->order_by ( 'first_name' );
		
		$query = $this->db->get ();
		
		$employees = $query->result_array (); // array of result
		
		if (! empty ( $employees )) {
			$this->load->model ( 'Employee_Model', 'employeeType' );
			$employeeType = array ();
			if (! empty ( $typeId )) {
				$employeeType = $this->employeeType->get ( $typeId );
			}
			foreach ( $employees as $key => $employee ) {
				if (empty ( $typeId )) {
					$employeeType = $this->employeeType->get ( $employee ["employee_type_id"] );
				}
				$employees [$key] ["type"] = $employeeType;
			}
		}
		return $employees;
	}
	public function getByEmail($email = "") {
		$employe = array ();
		if (empty ( $email )) {
			return $employe;
		}
		
		$this->db->select ()->from ( 'employees' );
		$this->db->where ( "(campus_id = '$this->campusId' AND email = '$email')" );
		
		$query = $this->db->get ();
		
		$employe = $query->row_array (); // array of result
		
		if (! empty ( $employe )) {
			$this->load->model ( 'Employee_Model', 'employeeType' );
			$employeType = $this->employeeType->get ( $employe ["employee_type_id"] );
			$employe ["type"] = $employeType;
		}
		return $employe;
	}
	/*
	 * public function getByKey($key = null) {
	 * $this->db->select()->from('employees');
	 * $this->db->where('internal_key', $key);
	 * $query = $this->db->get();
	 * return $query->row_array(); // single row
	 * }
	 */
	
	/**
	 * This function will delete the record based on the id
	 *
	 * @param
	 *        	$id
	 */
	public function remove($id, $deleteByColumn = "id") {
		$this->db->where ( "(campus_id = '$this->campusId' AND id = '$id')" );
		$this->db->delete ( 'employees' );
	}
	
	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert.
	 * One function doing both add and edit.
	 *
	 * @param
	 *        	$data
	 */
	public function merge($data) {
		
		// comma must be the first and last character of String if it is not empty.
		$newId = "";
		$this->db->trans_start ();
		$data ["campus_id"] = $this->campusId;
		if (isset ( $data ['id'] ) && ! empty ( $data ['id'] )) {
			
			$this->db->where ( 'id', $data ['id'] );
			$this->db->update ( 'employees', $data ); // update the record
			$this->db->trans_complete ();
			
			if ($this->db->trans_status () === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			
			$this->db->insert ( 'employees', $data ); // insert new record
			$newId = $this->db->insert_id ();
			$this->db->trans_complete ();
			return $newId;
		}
	}
	function getAutocomplete($params) {
		$arr = array ();
		
		$sqlString = "SELECT\n" . "	e.id,\n" . "	CONCAT(e.`first_name`, \" \", e.`last_name`, \" (\", e.cnic , \")\") AS`name`  \n" . " FROM\n" . "	employees e \n" . " WHERE\n" . "  	e.campus_id = " . $this->campusId . " AND e.status = '" . get_app_message ( "db.status.active" ) . "'" . " AND (e.`first_name` LIKE '%" . $params ["q"] . "%'  OR e.`last_name` LIKE '%" . $params ["q"] . "%'  OR e.`email` LIKE '%" . $params ["q"] . "%' OR e.`cnic` LIKE '%" . $params ["q"] . "%'  OR e.`employee_no` LIKE '%" . $params ["q"] . "%' ) ";
		
		$query = $this->db->query ( $sqlString );
		$employees = $query->result_array ();
		
		// JSON-encode the response
		$json_response = json_encode ( $employees );
		
		// Optionally: Wrap the response in a callback function for JSONP cross-domain support
		if ($params ["callback"]) {
			$json_response = $params ["callback"] . "(" . $json_response . ")";
		}
		return $json_response;
	}
	public function prePopulate($email) {
		$sqlString = "SELECT\n" . "	e.id,\n" . "	CONCAT(e.`first_name`, \" \", e.`last_name`, \" (\", e.cnic , \")\") AS`name`  \n" . " FROM\n" . "	employees e \n" . " WHERE\n" . "  	e.campus_id = " . $this->campusId . " AND e.email = '$email'";
		
		$query = $this->db->query ( $sqlString );
		$employee = $query->result_array ();
		// JSON-encode the response
		$json_response = json_encode ( $employee );
		
		// Optionally: Wrap the response in a callback function for JSONP cross-domain support
		
		return $json_response;
	}
}
