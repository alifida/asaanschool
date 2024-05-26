<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Notification_Model extends Base_Model {
	private $table = "notifications";
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
			}
		} else {
			$condition = "(campus_id = '$this->campusId')";
			$rs = parent::getByCondition ( $condition );
		}
		
		return $rs;
	}
 
 
	public function getByStatus($status = "") {
		if (empty ( $status )) {
			$status = get_app_message ( "db.status.active" );
		}
 
		$condition ="(campus_id = '$this->campusId' AND status = '$status')";
        return parent::getByCondition ( $condition );
		
	 
	}
	 
	public function getNoticeBoard( ) {
		$rs = array ();
		$currentDate= getCurrentDate();
		$condition ="(campus_id = '$this->campusId' AND  start_date <= '$currentDate' AND end_date >= '$currentDate')";
        //pre_d($condition);
        $rs = parent::getByCondition ( $condition );
		 
         
	    return $rs;
		 
	}
 
	/**
	 * This function will delete the record based on the id
	 *
	 * @param
	 *        	$id
	 */
	public function remove($id, $deleteByColumn = "id") {
		$condition ="(campus_id = '$this->campusId' AND id = '$id')";
	    $response =  parent::removeByCondition($condition);
	     
	    return $response;
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
		
		$data ["campus_id"] = $this->campusId;
		return parent::merge($data);
	}
	 
	 
}
