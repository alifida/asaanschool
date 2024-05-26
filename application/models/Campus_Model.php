<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Campus_Model extends Base_Model {
	private $table = "campuses";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	public function get($id = null, $schoolId = null) {
		$rs = array ();
		if ($schoolId == null) {
			return $rs;
		}
		
		$condition = "";
		
		if ($id != null) {
			// only to get the campuses of the school
			$condition = "( school_id = '$schoolId' AND id = '$id' )";
		} else {
			$condition = "( school_id = '$schoolId' )";
		}
		
		$rs = parent::getByCondition ( $condition );
		if ($id != null) {
			$row = $rs [0];
			if (! empty ( $row )) {
				$this->load->model ( 'School_Model', 'school' );
				$this->load->model ( 'Contactdetail_Model', 'contactDetail' );
				$school = $this->school->get ( $row ['school_id'] );
				$contactDetail = $this->contactDetail->get ( $row ['contact_detail_id'] );
				$row ["school"] = $school;
				$row ["contactDetail"] = $contactDetail;
				$rs = $row;
			}
		} else {
			
			if (! empty ( $rs )) {
				$this->load->model ( 'School_Model', 'school' );
				$this->load->model ( 'Contactdetail_Model', 'contactDetail' );
				foreach ( $rs as $key => $row ) {
					$school = $this->school->get ( $row ['school_id'] );
					$contactDetail = $this->contactDetail->get ( $row ['contact_detail_id'] );
					$rs [$key] ["school"] = $school;
					$row [$key] ["contactDetail"] = $contactDetail;
				}
			}
		}
		return $rs;
	}
	public function getById($id = null) {
		$rs = array ();
		if ($id == null) {
			return $rs;
		}
		
		$rs = parent::getByColumn ( "id", $id );
		if (! empty ( $rs )) {
			$row = $rs [0];
			$this->load->model ( 'School_Model', 'school' );
			$this->load->model ( 'Contactdetail_Model', 'contactDetail' );
			$school = $this->school->get ( $row ['school_id'] );
			$contactDetail = $this->contactDetail->get ( $row ['contact_detail_id'] );
			$row ["school"] = $school;
			$row ["contactDetail"] = $contactDetail;
			$rs = $row;
		}
		return $rs;
	}
	public function getByUser($userId) {
		$rs = array ();
		if (! empty ( $userId )) {
			$this->load->model ( 'Usercampus_Model', 'userCampus' );
			$rs = $this->userCampus->getByUserId ( $userId );
			
			if (! empty ( $rs )) {
				// set campuses first
				foreach ( $rs as $key => $row ) {
					$campus = $this->getById ( $row ["campus_id"] );
					$rs [$key] ["campus"] = $campus;
				}
				// set user
				$this->load->model ( 'User_Model', 'user' );
				$user = $this->user->get ( $userId );
				$rs ["user"] = $user;
			}
		}
		return $rs;
	}
	public function getBySchool($schoolId = null) {
		$rs = array ();
		if ($schoolId == null) {
			return $rs;
		}
		$rs = parent::getByColumn("school_id",$schoolId);
		if (! empty ( $rs )) {
			$this->load->model ( 'School_Model', 'school' );
			$this->load->model ( 'Contactdetail_Model', 'contactDetail' );
			foreach ( $rs as $key => $row ) {
				$school = $this->school->get ( $row ['school_id'] );
				$contactDetail = $this->contactDetail->get ( $row ['contact_detail_id'] );
				$rs [$key] ["school"] = $school;
				$rs [$key] ["contactDetail"] = $contactDetail;
			}
		}
		
		return $rs;
	}
	
}
