<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Class_Model extends Base_Model {
	public $campusId;
	private $table = "classes";
	public function __construct() {
		parent::__construct ();
		$this->campusId = $_SESSION ["currentCampus"] ["id"];
		$this->parentTable = $this->table;
	}
	public function get($id = null) {
		$rs = array ();
		if ($id != null) {
			$condition = "(campus_id = '$this->campusId' AND id = '$id')";
			$rs = parent::getByCondition ( $condition );
			if (! empty ( $rs )) {
				$rs = $rs [0];
			}
		} else {
			$condition = "(campus_id = '$this->campusId')";
			$rs = parent::getByCondition ( $condition );
			// pre_d($this->campusId);
		}
		return $rs;
	}
	public function getClassTimetable($id = null) {
		$rs = array ();
		if ($id != null) {
			$condition = "(campus_id = '$this->campusId' AND id = '$id')";
			$rs = parent::getByCondition ( $condition );
			if (! empty ( $rs )) {
				//$rs = $rs [0];
			}
		} else {
			$condition = "(campus_id = '$this->campusId')";
			$rs = parent::getByCondition ( $condition );
		}
		
		if (! empty ( $rs )) {
			
			$this->load->model('Timetable_Model', 'timetable');
		 
				if (! empty ( $rs )) {
					foreach ( $rs as $key => $row ) {
						 
						$timetable = $this->timetable->getByClass ( $rs [$key] ["id"] );
						$rs [$key] ["subjects"] = $timetable;
					}
				}
			
		}
		//pre_d($rs);
		return $rs;
	}
	public function remove($id, $deleteByColumn = 'id') {
		return parent::removeByCondition ( "(campus_id = '$this->campusId' AND id = '$id')" );
	}
	public function merge($data) {
		$data ['campus_id'] = $this->campusId;
		
		return parent::merge ( $data );
	}
}
