<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Appmodule_Model extends Base_Model {
	private $table = "app_modules";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	
	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 *
	 * @param int $id        	
	 * @return mixed public function get($id = null) {
	 *        
	 *         $this->db->select ()->from ( $this->table );
	 *        
	 *         // where condition if id is present
	 *         if ($id != null) {
	 *         $this->db->where ( 'id', $id );
	 *         } else {
	 *         $this->db->order_by ( 'id' );
	 *         }
	 *        
	 *         $query = $this->db->get ();
	 *        
	 *         if ($id != null) {
	 *         return $query->row_array (); // single row
	 *         } else {
	 *         return $query->result_array (); // array of result
	 *         }
	 *         }
	 */
	public function getByIds($ids = array()) {
		return parent::getIn ( $ids );
		/*
		 * if (empty ( $ids )) {
		 * return array ();
		 * }
		 *
		 * $this->db->select ()->from ( $this->table );
		 * $this->db->where_in ( 'id', $ids );
		 * $query = $this->db->get ();
		 * return $query->result_array (); // array of result
		 */
	}
	public function getByStatus($status = null) {
		if ($status == null) {
			return array ();
		}
		return parent::getByColumn ( 'status', $status );
		//return $this->db->select ()->from ( $this->table );
		/*
		 * // where condition if id is present
		 *
		 * $this->db->where ( 'status', $status );
		 *
		 * $query = $this->db->get ();
		 *
		 * return $query->result_array (); // array of result
		 */
	}
}
