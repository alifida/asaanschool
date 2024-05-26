<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Campusmodule_Model extends Base_Model {
	private $table = "campus_modules";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	

	public function getById($id = null) {
		//pre_d($id);
		$campusModule = array ();
		if ($id == null) {
			return $campusModule;
		}
		$rs = parent::getByColumn("id", $id);
		if(empty($rs)){
			return  $rs;
		}
		$campusModule = $rs[0];
		if (! empty ( $campusModule )) {
			$this->load->model ( 'Campus_Model', 'campus' );
			$this->load->model ( 'Appmodule_Model', 'appModule' );
			$campus = $this->campus->get ( $campusModule ["campus_id"] );
			$module = $this->appModule->get ( $campusModule ["module_id"] );
			$campusModule ["campus"] = $campus;
			$campusModule ["module"] = $module;
		}
		return $campusModule;
	}
	public function getByCampus($campusId = null) {
		$campusModules = array ();
		if ($campusId == null) {
			return $campusModules;
		}
		
		$campusModules = parent::getByColumn("campus_id", $campusId);
		
		if (! empty ( $campusModules )) {
			$this->load->model ( 'Campus_Model', 'campus' );
			$this->load->model ( 'Appmodule_Model', 'appModule' );
			$campus = $this->campus->getById ( $campusId );
			foreach ( $campusModules as $key => $campusModule ) {
				$module = $this->appModule->get ( $campusModule ["module_id"] );
				$campusModules [$key] ["campus"] = $campus;
				$campusModules [$key] ["module"] = $module;
			}
		}
		return $campusModules;
	}
	public function getByModule($moduleId = null) {
		$campusModules = array ();
		if ($moduleId == null) {
			return $campusModules;
		}
		/* 
		$this->db->select ()->from ( 'campus_modules' );
		$this->db->where ( 'module_id', $moduleId );
		$query = $this->db->get ();
		$campusModules = $query->result_array (); */
		$campusModules = parent::getByColumn('module_id', $moduleId);
		if (! empty ( $campusModules )) {
			$this->load->model ( 'Campus_Model', 'campus' );
			$this->load->model ( 'Appmodule_Model', 'appModule' );
			$module = $this->appModule->get ( $moduleId );
			foreach ( $campusModules as $key => $campusModule ) {
				$campus = $this->campus->getById ( $campusModule ["campus_id"] );
				$campusModules [$key] ["campus"] = $campus;
				$campusModules [$key] ["module"] = $module;
			}
		}
		return $campusModules;
	}
	public function saveCampusModules($moduleIds, $campusId) {
		$this->db->trans_start ();
		// getExistingCampusModules
		/*$this->db->select ()->from ( 'campus_modules' );
		$this->db->where ( 'campus_id', $campusId );
		$query = $this->db->get ();
		$campusExistingModules = $query->result_array ();*/
		$campusExistingModules = parent::getByColumn('campus_id', $campusId );
		
		
		// find the modules to be deleted
		$modulesToDelete = array ();
		foreach ( $campusExistingModules as $key => $existingModule ) {
			if (! in_array ( $existingModule ["module_id"], $moduleIds )) {
				$modulesToDelete [] = $existingModule ["module_id"];
			}
		}
		
		// find the modules to be inserted for new selection
		$newModules = array ();
		foreach ( $moduleIds as $moduleId ) {
			$found = false;
			foreach ( $campusExistingModules as $existingModule ) {
				if ($moduleId == $existingModule ["module_id"]) {
					$found = true;
					break;
				}
			}
			if (! $found) {
				$newModules [] = array (
						"campus_id" => $campusId,
						"module_id" => $moduleId 
				);
			}
		}
		
		// delete unselected modules
		if (! empty ( $modulesToDelete )) {
			$this->db->where ( 'campus_id', $campusId );
			$this->db->where_in ( 'module_id', $modulesToDelete );
			$this->db->delete ( 'campus_modules' );
		}
		
		if (! empty ( $newModules )) {
			// insert new selection
			$this->db->insert_batch ( 'campus_modules', $newModules );
		}
		
		if ($this->db->trans_status () === FALSE) {
			$this->db->trans_rollback ();
			return get_app_message ( "response.failed" );
		} else {
			$this->db->trans_complete ();
			return get_app_message ( "response.success" );
		}
	}
}
