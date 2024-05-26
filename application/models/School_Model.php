<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class School_Model extends CI_Model {

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
		$this->db->select()->from('schools');

		// where condition if id is present
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			$school = $query->row_array(); // single row
			if(!empty($school["contact_detail_id"])){
				$this->load->model('Contactdetail_Model', 'contactDetail');
				$contactDetail = $this->contactDetail->get($school['contact_detail_id']);
				$school["contactDetail"]= $contactDetail;
			}
			return $school;
		} else {
			return $query->result_array(); // array of result
		}
	}

	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('schools');
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
			$this->db->update('schools', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('schools', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}

	public function registerSchool($data = array()){

		if(!empty($data)){

			$this->load->model('Campus_Model', 'campus');
			$this->load->model('Contactdetail_Model', 'contactDetail');
			$this->load->model('User_Model', 'user');
			$this->load->model('Usertype_Model', 'userType');
			$this->load->model('Usercampus_Model', 'userCampus');
			$this->load->model('Appmodule_Model', 'appModule');
			$this->load->model('Campusmodule_Model', 'campusModule');
			$this->load->model('Usermodule_Model', 'userModule');

			$this->db->trans_start();

			$school = array();
			$school["school_name"] = $data["school_name"];
			$school["registration_no"] = $data["registration_no"];
			$school["school_name"] = $data["school_name"];
			$school["created_at"] = getCurrentDateTime();
			$school["status"] = get_app_message("db.status.trail");


			// create school contact_detail
			$contactDetail = array();
			$contactDetail["primary_email"] = $data["email"];
			$contactDetailId = $this->contactDetail->merge($contactDetail);

			if(!is_numeric($contactDetailId)){
				return get_app_message("response.failed");
			}


			// save school and get school id
			$school["contact_detail_id"] = $contactDetailId;
			$schoolId = $this->merge($school);
			if(!is_numeric($schoolId)){
				return get_app_message("response.failed");
			}





			// create 1st campus for school by default
			$campus = array();
			$campus["campus_name"] = $data["school_name"];
			$campus["school_id"] = $schoolId;
			$campus["contact_detail_id"] = $contactDetailId;
			$campusId = $this->campus->merge($campus);

			if(!is_numeric($campusId)){
				return get_app_message("response.failed");
			}
			$campus["id"] = $campusId;
			$_SESSION["currentCampus"] = $campus;

			$userContactDetail = array();
			$userContactDetail["primary_email"] = $data["email"];
			$userContactDetailId = $this->contactDetail->merge($userContactDetail);

			if(!is_numeric($userContactDetailId)){
				return get_app_message("response.failed");
			}




			// create user for school
			$user = array();
			$user["email"]=$data["email"];
			$user["password"]= $data["password"];
			$user["status"] = get_app_message("db.status.active");
			$user["display_name"] = $data["school_name"];
			
			$user["contact_detail_id"]=$userContactDetailId;
			
			// get user type id for admin account
			$userType = $this->userType->getByKey("admin");
			
			if(!empty($userType)){
				$user["user_type_id"] = $userType["id"];
			}else{
				// set non-empty
				$user["user_type_id"] = 1;
			}

			$userId = $this->user->merge($user);
			if(!is_numeric($userId)){
				return get_app_message("response.failed");
			}


			// Register the user to its campus
			$userCampus = array();
			$userCampus["campus_id"] = $campusId;
			$userCampus["user_id"] = $userId;

			$userCampusId = $this->userCampus->merge($userCampus);
			if(!is_numeric($userCampusId)){
				return get_app_message("response.failed");
			}




			// Register app modules for campus
			$appModules = $this->appModule->getByStatus(get_app_message("db.status.active"));
			$moduleIds = array();
			foreach ($appModules as $module){
				$moduleIds[] = $module["id"];
			}
			$response = $this->campusModule->saveCampusModules($moduleIds, $campusId);
			if($response == get_app_message("response.failed")){
				return $response;
			}

			$campusModules = $this->campusModule->getByCampus($campusId);
			$campusModuleIds = array();
			foreach ($campusModules as $campusModule){
				$campusModuleIds[] = $campusModule["id"];
			}

			$response = $this->userModule->updateUserCampusModules($userId, $campusModuleIds);
			if($response == get_app_message("response.failed")){
				return $response;
			}
 
			// school sign up has been completed now commit the transaction
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return get_app_message("response.failed");
			} else {
				$this->insertDummyData($campusId);
				return get_app_message("response.success");
			}
		}

	}

	function insertDummyData($campusId){
		$this->db->query("call new_registration_data($campusId)");
	}


}