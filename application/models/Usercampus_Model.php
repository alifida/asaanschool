<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Usercampus_Model extends CI_Model {

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
		$this->db->select()->from('user_campus');

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
				$this->load->model('Campus_Model', 'campus');
				$this->load->model('User_Model', 'user');
				$campus = $this->campus->get($row['campus_id']);
				$user = $this->user->get($row['user_id']);
				$row["campus"]= $campus;
				$row["user"]= $user;

			}
			return $row;
		} else {
			$rs = $query->result_array(); // array of result
			if(!empty($rs)){
				$this->load->model('Campus_Model', 'campus');
				$this->load->model('User_Model', 'user');
				foreach($rs as $key => $row){
					$campus = $this->campus->get($row['campus_id']);
					$user = $this->user->get($row['user_id']);
					$rs[$key]["campus"]= $campus;
					$rs[$key]["user"]= $user;
				}
			}
			return $rs;
		}
	}
	public function getById($id = null) {
		$userCampus = array();
		if ($id != null) {
			return $userCampus;
		}

		$this->db->select()->from('user_campus');
		$this->db->where('id', $id);
		$query = $this->db->get();

		$row = $query->row_array(); // single row
		if(!empty($row)){
			$this->load->model('Campus_Model', 'campus');
			$this->load->model('User_Model', 'user');
			$campus = $this->campus->get($row['campus_id']);
			$user = $this->user->get($row['user_id']);
			$row["campus"]= $campus;
			$row["user"]= $user;
		}
		return $row;
	}


	public function getCampusUsers($campusId = null) {

		$campusUsers = array();
		if($campusId == null){
			return $campusUsers;
		}

		$this->db->select()->from('user_campus');

		// where condition if id is present

		$this->db->where('campus_id', $campusId);
		$this->db->order_by('user_id');
		$query = $this->db->get();

		$rs = $query->result_array(); // array of result
		if(!empty($rs)){
			$this->load->model('Campus_Model', 'campus');
			$this->load->model('User_Model', 'user');

			// load campus
			$campus = $this->campus->get($campusId);
			foreach($rs as $key => $row){
				$user = $this->user->get($row['user_id']);
				$rs[$key]["campus"]= $campus;
				$rs[$key]["user"]= $user;
			}
		}
		return $rs;
	}

	public function getByUserId($userId){
		$userCampus= array();
		if(!empty($userId)){
			$this->db->select()->from('user_campus');
			$this->db->where('user_id', $userId);
			$query = $this->db->get();
			$userCampus = $query->result_array();
		}
		return $userCampus;
	}
	public function getByUserIdAndCampusId($userId, $campusId){
		$userCampus= array();
		if(!empty($userId)){
			$this->db->select()->from('user_campus');
			$this->db->where("(campus_id = '$campusId' AND user_id = '$userId')");
			$query = $this->db->get();
			$userCampus = $query->row_array();
		}
		return $userCampus;
	}



	public function getByUserAndCampus($userId, $campusId){
		$userCampus= array();

		if(!empty($userId) && !empty($campusId)){
			$this->db->select()->from('user_campus');
			$this->db->where("(campus_id = '$campusId' AND user_id = '$userId')");
			$query = $this->db->get();
			$userCampuses = $query->result_array();
			//pre_d($userCampuses);
			if(!empty($userCampuses)){
				$this->load->model('User_Model', 'user');
				$this->load->model('Campus_Model', 'campus');
				$this->load->model('Usermodule_Model', 'userModule');
				foreach ($userCampuses as $key => $userCampus){
					$user = $this->user->get($userId);
					if(isset($user["contact_detail_id"]) && !empty($user["contact_detail_id"])){
						$this->load->model('Contactdetail_Model', 'contactDetail');
						$contactDetail = $this->contactDetail->get($user["contact_detail_id"]);
						$user["contactDetail"] = $contactDetail;


					}
					$userModules = $this->userModule->getByUserCampusId($userCampus["id"]);
					$user["userModules"] = $userModules;
					$userCampuses[$key]["user"]= $user;
				}
			}
		}
		return $userCampuses;
	}

	public function getDetailByUser($userId){
		$userCampus= array();

		if(!empty($userId) ){
			$this->db->select()->from('user_campus');
			$this->db->where("(user_id = '$userId')");
			$query = $this->db->get();
			$userCampuses = $query->result_array();
			//pre_d($userCampuses);
			if(!empty($userCampuses)){
				$this->load->model('User_Model', 'user');
				$this->load->model('Campus_Model', 'campus');
				$this->load->model('Usermodule_Model', 'userModule');
				foreach ($userCampuses as $key => $userCampus){
					$user = $this->user->get($userId);
					if(isset($user["contact_detail_id"]) && !empty($user["contact_detail_id"])){
						$this->load->model('Contactdetail_Model', 'contactDetail');
						$contactDetail = $this->contactDetail->get($user["contact_detail_id"]);
						$user["contactDetail"] = $contactDetail;


					}
					
					$userModules = $this->userModule->getByUserCampusId($userCampus["id"]);
					$user["userModules"] = $userModules;
					$userCampuses[$key]["user"]= $user;
				}
			}
		}
		return $userCampuses;
	}

	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('user_campus');
	}

	public function removeCampusUser($campusId, $userId) {
		$this->db->trans_start();
		$this->db->where("(campus_id = '$campusId' AND user_id = '$userId')");
		$this->db->delete('user_campus');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return get_app_message("response.failed");
		} else {
			$this->db->trans_complete();
			return get_app_message("response.success");
		}
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
			$this->db->update('user_campus', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('user_campus', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}


}
