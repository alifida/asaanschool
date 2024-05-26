<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Usermodule_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function getByUserCampusId($userCampusId = null) {
		$userModules = array();
		if($userCampusId == null){
			return $userModules ;
		}

		$this->db->select()->from('user_campus_modules');
		$this->db->where('user_campus_id', $userCampusId);
		$query = $this->db->get();

		$userModules  = $query->result_array(); // single row
		if(!empty($userModules)){
			foreach ($userModules as $key=>$userModule){
				//$this->load->model('Usercampus_Model', 'userCampus');
				$this->load->model('Campusmodule_Model', 'campusModule');
				//$userCampus = $this->userCampus->getById($userModule["user_campus_id"]);
				$campusModule = $this->campusModule->getById($userModule["campus_module_id"]);
				//$userModules[$key]["userCampus"]= $userCampus;
				$userModules[$key]["campusModule"]= $campusModule;
			}

		}
		return $userModules ;
	}
	public function getByCampusModuleId($campusModuleId = null) {
		$userModules = array();
		if($campusId == null){
			return $userModules ;
		}

		$this->db->select()->from('user_campus_modules');
		$this->db->where('campus_module_id', $campusModuleId);
		$query = $this->db->get();

		$userModules  = $query->row_array(); // single row
		if(!empty($userModules)){
			foreach ($userModules as $key=>$userModule){
				$this->load->model('Usercampus_Model', 'userCampus');
				$this->load->model('Campusmodule_Model', 'campusModule');
				$userCampus = $this->userCampus->getById($userModule["user_campus_id"]);
				$campusModule = $this->campusModule->getById($userModule["campus_module_id"]);
				$userModules[$key]["userCampus"]= $userCampus;
				$userModules[$key]["campusModule"]= $campusModule;
			}
		}
		return $userModules ;
	}


	public function updateUserCampusModules($userId=null, $campusModuleIds=array()){
		 
		if($userId == null || empty($campusModuleIds)){
			return get_app_message("response.failed");
		}
		$userCampus = array();
		$this->load->model('Usercampus_Model', 'userCampus');
		$userCampus = $this->userCampus->getByUserIdAndCampusId($userId, $_SESSION["currentCampus"]["id"]);

		if(empty($userCampus)){
			// register this user with current Campus
			$userCampus["user_id"]=$userId;
			$userCampus["campus_id"]=$_SESSION["currentCampus"]["id"];
			
			$newId = $this->userCampus->merge($userCampus);
			$userCampus = $this->userCampus->getByUserIdAndCampusId($userId, $_SESSION["currentCampus"]["id"]);
		}


		if(!empty($userCampus)){
			$userCampusModules = array();
			foreach ($campusModuleIds as $campusModuleId){
				$userCampusModule["user_campus_id"] = $userCampus["id"];
				$userCampusModule["campus_module_id"] = $campusModuleId;
				$userCampusModules[] = $userCampusModule;
			}

			//pre($userCampusModules);
			// remove all exiting campusModules for this campusUser
			$this->removeCurrentCampusUserModules($userCampus["id"]);


			$this->db->trans_start();
			$this->db->insert_batch('user_campus_modules', $userCampusModules);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return get_app_message("response.failed");
			} else {
				$this->db->trans_complete();
				return get_app_message("response.success");
			}
		}else{
			return get_app_message("response.failed");
		}






	}


	public function removeCurrentCampusUserModules($userCampusId) {
		$this->db->where('user_campus_id', $userCampusId);
		$this->db->delete('user_campus_modules');
	}


}
