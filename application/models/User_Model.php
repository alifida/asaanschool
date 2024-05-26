<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_Model extends CI_Model {

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
		$this->db->select()->from('users');

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
				$this->load->model('Usertype_Model', 'userType');
				$userType = $this->userType->get($row["user_type_id"]);
				$row["userType"] = $userType;
			}
			return $row;
		} else {
			$rs = $query->result_array(); // array of result
			if(!empty($rs)){
				$this->load->model('Usertype_Model', 'userType');
				foreach ($rs as $key=>$row){
					$userType = $this->userType->get($row["user_type_id"]);
					$rs[$key]["userType"] = $userType;
				}
			}
			return $rs;
		}
	}





	public function validate($loginId, $password) {
		$this->db->select()->from('users');
		$this->db->where(
		array(
                    'email' => $loginId,
                    'password' => $password,
		));
		$query = $this->db->get();
		$user = $query->row_array(); // single row

		if (!empty($user)) {
			$user = set_user_account_type($user);
		}
		return $user;
	}

	public function getByLoginId($loginId) {
		$this->db->select()->from('users');
		$this->db->where(
		array(
                    'email' => $loginId
		));
		$query = $this->db->get();
		return $query->row_array(); // single row
	}

	public function getByEmail($email) {
		$this->db->select()->from('users');
		$this->db->where(
		array(
                    'email' => $email
		));
		$query = $this->db->get();
		return $query->row_array(); // single row
	}

	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('users');
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
			$this->db->update('users', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('users', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}

	public function change_password($data) {
		$this->db->trans_start();
		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('users', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return "failed";
			} else {
				return "success";
			}
		}
	}

	public function createGuestUser($user){
		/*$guestUser["password"] = get_random_string(6);
			$userTypeId = */
		if(!isset($user["password"])){
			get_random_string(6);
		}
		if(!isset($user["user_type_id"])){
			$this->load->model('Usertype_Model', 'userType');
			$userType = $this->userType->getByKey("guest");
			$user["user_type_id"] = $userType["id"];
		}

		$this->db->insert('users', $user); // insert new record
		$newId = $this->db->insert_id();
		return $newId;
	}

	public function createUserFromEmployee($employee, $userTypeId){
		if(empty($userTypeId)){
			$this->load->model('Usertype_Model', 'userType');
			$userType = $this->userType->getByKey("employee");
			$userTypeId = $userType["id"];
		}
		
		// check Employee Existence in Users by Email Address
		$user= array();

		$user = $this->getByEmail($employee["email"]);
		if(empty($user)){
			// create new user
			$user["email"] = $employee["email"];

			$displayName = "";
			if(!empty($employee["first_name"])){
				$displayName = $employee["first_name"];
			}
			if(!empty($employee["last_name"])){
				$displayName = $displayName. " ". $employee["last_name"];
			}

			$user["display_name"] = $displayName;
			$user["password"] = get_random_string(6);
			$user["status"] = get_app_message("db.status.active");
			if(isset($employee["employee_picture"]) && !empty($employee["employee_picture"])){
				$user["profile_picture"] = $employee["employee_picture"];
			}
			$user["user_type_id"] = $userTypeId;
			$this->db->insert('users', $user); // insert new record
			$newId = $this->db->insert_id();
			$user = $this->get($newId);
		}
		return $user;
	}
	
	public function createUserFromStudent($student, $userTypeId){
		if(empty($userTypeId)){
			$this->load->model('Usertype_Model', 'userType');
			$userType = $this->userType->getByKey("student");
			$userTypeId = $userType["id"];
		}
		 
		// check Student Existence in Users by Email Address
		$user= array();
		
		$user = $this->getByEmail($student["email"]);
		if(empty($user)){
			// create new user
			$user["email"] = $student["email"];
			
			$displayName = "";
			if(!empty($student["first_name"])){
				$displayName = $student["first_name"];
			}
			if(!empty($student["last_name"])){
				$displayName = $displayName. " ". $student["last_name"];
			}
			
			$user["display_name"] = $displayName;
			$user["password"] = get_random_string(6);
			$user["status"] = get_app_message("db.status.active");
			if(isset($student["student_picture"]) && !empty($student["student_picture"])){
				$user["profile_picture"] = $student["student_picture"];
			}
			$user["user_type_id"] = $userTypeId;
			$this->db->insert('users', $user); // insert new record
			$newId = $this->db->insert_id();
			$user = $this->get($newId);
		}
		return $user;
	}
	
	public function createUserFromGuardian($guardian, $userTypeId){
		if(empty($userTypeId)){
			$this->load->model('Usertype_Model', 'userType');
			$userType = $this->userType->getByKey("student");
			$userTypeId = $userType["id"];
		}
		 
		// check Guardian Existence in Users by Email Address
		$user= array();
		
		$user = $this->getByEmail($guardian["email"]);
		if(empty($user)){
			// create new user
			$user["email"] = $guardian["email"];
			
			$displayName = "";
			if(!empty($guardian["name"])){
				$displayName = $guardian["name"];
			}
			
			$user["display_name"] = $displayName;
			$user["password"] = get_random_string(6);
			$user["status"] = get_app_message("db.status.active");
		 
			$user["user_type_id"] = $userTypeId;
			$this->db->insert('users', $user); // insert new record
			$newId = $this->db->insert_id();
			$user = $this->get($newId);
		}
		return $user;
	}

}
