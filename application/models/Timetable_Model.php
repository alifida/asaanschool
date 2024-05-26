<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Timetable_Model extends Base_Model {
	private $table = "time_tables";
	private $campusId; // Enable this line for the models that contains campus_id in its table
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
		$this->load->model ( 'Subject_Model', 'subject' );
		
		$this->campusId = $_SESSION ["currentCampus"] ["id"]; // Enable this line for the models that contains campus_id in its table4
	}
	public function get($id = null) {
		$rs = array ();
		$rs = parent::get ( $id );
		if (! empty ( $rs )) {
			if ($id != null) {
				if (! empty ( $rs ["subject_id"] )) {
					$subject = $this->subject->get ( $rs ["subject_id"] );
					$rs ["subject"] = $subject;
				}
			} else {
				if (! empty ( $rs )) {
					foreach ( $rs as $key => $row ) {
						if (! empty ( $rs [$key] ["subject_id"] )) {
							$subject = $this->subject->get ( $rs [$key] ["subject_id"] );
							$rs [$key] ["subject"] = $subject;
						}
					}
				}
			}
		}
		
		return $rs;
	}
	public function getByClass($classId = null) {
		$rs = array ();
		
		if (empty ( $classId )) {
			return $rs;
		}
		
		$rs = $this->subject->getByClass($classId);
		/* if($classId =="2"){
			pre($subjects);
		} */
		/* $sql = " select t.* from ".$this->parentTable." t, subjects s where s.id = t.subject_id and s.class_id = $classId ";
		$rs = parent::getBySQLQuery( $sql ); */
		if (! empty ( $rs )) {
			foreach ( $rs as $key => $subject ) {
					if (! empty ( $subject ["id"] )) {
						$timetable = $this->getBySubject($subject["id"]);
						$rs [$key] ["timetable"] = $timetable;
					}
				}
		}
		 
		return $rs;
	}
	
	
	public function getBySubject($subjectId = null) {
		
		$rs = array ();
		if(empty($subjectId)){
			return $rs;
		}
		$condition = "(`subject_id` = '$subjectId')";
		$rs =  parent::getByCondition($condition, "start_time","asc");
		return $rs;
	}
	
	public function merge($data) {
		// pre_d($data);
		$data ["campus_id"] = $this->campusId;
		$rs = parent::merge ( $data );
		
		return $rs;
	}
}

