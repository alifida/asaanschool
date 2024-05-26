<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

include_once('Base_Model.php');
class Campuspackage_Model extends Base_Model{

	private $table = "campus_packages";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	

	
	public function getById($id = null) {
		$row = array();
		if($id == null){
			return $row;
		}
		
		$row = parent::getByColumn("id", $id);
		
		if(!empty($row)){
			$row = $row[0];
			$this->load->model('Package_Model', 'package');
			
			$package = $this->package->get($row["package_id"], "", getClientCountry());
			$row["package"] = $package;
		}
		return $row;
	}

	public function getByStatus($campusId = null, $status = null) {
		$rs = array();
		if($campusId == null || $status == null ){
			return $rs;
		}
		/* $this->db->select()->from('campus_packages');
		$this->db->where("(campus_id = '$campusId' AND status = '$status')");
		$query = $this->db->get();
		$rs = $query->result_array();
		 */
		$condition = "(campus_id = '$campusId' AND status = '$status')";
		$rs = parent::getByCondition($condition);
		if(!empty($rs)){
			$this->load->model('Package_Model', 'package');
			foreach ($rs as $key=>$row) {
				$package = $this->package->get($row["package_id"]);
				$rs[$key]["package"] = $package;
			}
		}
		return $rs;
	}

	public function getByCampus($campusId = null) {
		$rs = array();
		if($campusId == null){
			return $rs;
		}
		/*
		$this->db->select()->from('campus_packages');
		$this->db->where('campus_id', $campusId);
		$this->db->order_by('id');
		$query = $this->db->get();
		$rs = $query->result_array(); // array of result
		*/
		$condition = "(campus_id = '$campusId' )";
		$rs = parent::getByCondition($condition, "id", "desc");
		if(!empty($rs)){
			$this->load->model('Package_Model', 'package');
			foreach ($rs as $key=>$row) {
				$package = $this->package->get($row["package_id"]);
				$rs[$key]["package"] = $package;
			}
		}
		return $rs;
	}

 

	public function deactivateCurrentPackage($campusId){

		$currentTime = getCurrentDateTime();
		$campusPackageUpdate = array();
		$campusPackageUpdate["status"]=get_app_message("db.status.inactive");
		$campusPackageUpdate["end_date"]=$currentTime;
		$campusPackageUpdate["comments"]="Inactivated by system, with the selection of package at : ".$currentTime;

		$this->db->trans_start();
		$this->db->where('campus_id', $campusId);
		$this->db->where('status', get_app_message("db.status.active"));
		$this->db->update('campus_packages', $campusPackageUpdate); // update the record
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return get_app_message ( "response.failed" );
		} else {
			return get_app_message ( "response.success" );
		}

	}

}
