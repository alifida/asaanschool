<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Reportconfiguration_Model extends CI_Model {
	public $campusId;
	public function __construct() {
		parent::__construct ();
		$this->campusId = $_SESSION ["currentCampus"] ["id"];
	}
	
	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * 
	 * @param int $id        	
	 * @return mixed
	 */
	public function get($id = null) {
		$this->db->select ()->from ( 'report_configurations' );
		
		// where condition if id is present
		if ($id != null) {
			$this->db->where ( "(campus_id = '$this->campusId' AND id = '$id')" );
		} else {
			
			$this->db->where ( 'campus_id', $this->campusId );
			$this->db->order_by ( 'id' );
		}
		
		$query = $this->db->get ();
		
		if ($id != null) {
			return $query->row_array (); // single row
		} else {
			return $query->result_array (); // array of result
		}
	}
	public function getByCampus() {
		$this->db->select ()->from ( 'report_configurations' );
		$this->db->where ( 'campus_id', $this->campusId );
		$query = $this->db->get ();
		return $query->row_array (); // single row
	}
	
	/**
	 * This function will delete the record based on the id
	 * 
	 * @param
	 *        	$id
	 */
	public function remove($id) {
		$this->db->where ( "(campus_id = '$this->campusId' AND id = '$id')" );
		$this->db->delete ( 'report_configurations' );
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
		// comma must be the first and last character of String if it is not empty.
		$newId = "";
		$this->db->trans_start ();
		
		
		
		$data ['campus_id'] = $this->campusId;
		
		if (isset ( $data ['id'] ) && ! empty ( $data ['id'] )) {
			
			$this->db->where ( 'id', $data ['id'] );
			$this->db->update ( 'report_configurations', $data ); // update the record
			$this->db->trans_complete ();
			
			if ($this->db->trans_status () === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			
			$this->db->insert ( 'report_configurations', $data ); // insert new record
			$newId = $this->db->insert_id ();
			$this->db->trans_complete ();
			return $newId;
		}
	}
	public function mergeByCampus($data) {
		// comma must be the first and last character of String if it is not empty.
		$newId = "";
		$this->db->trans_start ();
		$existingSetting = $this->getByCampus();
		if(!empty($existingSetting)){
			$data["id"] = $existingSetting["id"];
		}
		$data ['campus_id'] = $this->campusId;
		
		if (isset ( $data ['id'] ) && ! empty ( $data ['id'] )) {
			
			$this->db->where ( 'id', $data ['id'] );
			$this->db->update ( 'report_configurations', $data ); // update the record
			$this->db->trans_complete ();
			
			if ($this->db->trans_status () === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			
			$this->db->insert ( 'report_configurations', $data ); // insert new record
			$newId = $this->db->insert_id ();
			$this->db->trans_complete ();
			return $newId;
		}
	}
}
