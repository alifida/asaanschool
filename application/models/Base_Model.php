<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Base_Model extends CI_Model {
	protected $parentTable = "";
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 *
	 * @param int $id        	
	 * @return mixed
	 */
	public function get($id = null) {
		if ($id != null) {
			$condition = "(id = '$id')";
		} else {
			$condition = "fetchAll";
		}
		
		$rs = $this->getByCondition ( $condition );
		
		if ($id != null) {
			if (! empty ( $rs )) {
				$rs = $rs [0];
			}
		}
		
		return $rs;
	}
	public function getBySQLQuery($sql) {
		$query = $this->db->query ( $sql );
		return $query->result_array ();
	}
	
	/**
	 * This function will delete the record based on the id
	 *
	 * @param
	 *        	$id
	 */
	public function remove($value, $deleteByColumn = "id") {
		$this->db->trans_start ();
		
		$this->db->where ( $deleteByColumn, $value );
		$this->db->delete ( $this->parentTable );
		
		$this->db->trans_complete ();
		
		if ($this->db->trans_status () === FALSE) {
			return get_app_message ( "response.failed" );
		} else {
			return get_app_message ( "response.success" );
		}
	}
	public function removeByCondition($condition) {
		$this->db->trans_start ();
		
		$this->db->where ( $condition );
		$this->db->delete ( $this->parentTable );
		
		$this->db->trans_complete ();
		
		if ($this->db->trans_status () === FALSE) {
			return get_app_message ( "response.failed" );
		} else {
			return get_app_message ( "response.success" );
		}
	}
	public function removeIn($ids, $deleteByColumn = "id") {
		$this->db->trans_start ();
		
		$this->db->where_in ( $deleteByColumn, $ids );
		$this->db->delete ( $this->parentTable );
		
		$this->db->trans_complete ();
		
		if ($this->db->trans_status () === FALSE) {
			return get_app_message ( "response.failed" );
		} else {
			return get_app_message ( "response.success" );
		}
	}
	public function getIn($inValues, $inColumn = "id", $condition = null, $orderBy = null, $order = 'desc') {
		if (empty ( $inValues )) {
			return array ();
		}
		
		$this->db->select ()->from ( $this->parentTable );
		
		if ($condition != null) {
			$this->db->where ( $condition );
		}
		$this->db->where_in ( $inColumn, $inValues );
		
		if ($orderBy != null) {
			$this->db->order_by ( "`" . $orderBy . "`", $order );
		}
		
		$query = $this->db->get ();
		return $query->result_array ();
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
		
		if (isset ( $data ['id'] ) && ! empty ( $data ['id'] )) {
			
			$this->db->where ( 'id', $data ['id'] );
			$this->db->update ( $this->parentTable, $data ); // update the record
			$this->db->trans_complete ();
			
			if ($this->db->trans_status () === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			$this->db->insert ( $this->parentTable, $data ); // insert new record
			$newId = $this->db->insert_id ();
			$this->db->trans_complete ();
			return $newId;
		}
	}
	public function getByColumn($column = "", $value = "") {
		if (empty ( $column ) || empty ( $value )) {
			return array ();
		}
		$condition = "($column = '$value')";
		
		return $this->getByCondition ( $condition );
	}
	public function getByKey($key = null) {
		$condition = "(`internal_key` = '$key')";
		$rs = $this->getByCondition ( $condition );
		if (! empty ( $rs )) {
			$rs = $rs [0];
		}
		return $rs;
	}
	public function getByCondition($condition = null, $orderBy = null, $order = 'desc', $recordPerPage = null, $startFrom = null) {
		$rs = array ();
		if ($condition == null) {
			return $rs;
		}
		$this->db->select ()->from ( $this->parentTable );
		if ("fetchAll" !== $condition) {
			$this->db->where ( $condition );
		}
		if ($orderBy != null) {
			$this->db->order_by ( "`" . $orderBy . "`", $order );
		}
		
		if ($recordPerPage !== null && $startFrom !== null) {
			
			
			$this->db->limit ( $recordPerPage, $startFrom );
		}
		$query = $this->db->get ();
		 
		$rs = $query->result_array (); // array of result
		return $rs;
	}
	public function saveMultiple($data) {
		$this->db->trans_start ();
		$this->db->insert_batch ( $this->parentTable, $data );
		
		if ($this->db->trans_status () === FALSE) {
			$this->db->trans_rollback ();
			 
			return get_app_message ( "response.failed" );
		} else {
			$this->db->trans_complete ();
			return get_app_message ( "response.success" );
		}
	}
	public function updateMultiple($data, $updateByColumn = "id") {
		if (! empty ( $data )) {
			$this->db->trans_start ();
			$this->db->update_batch ( $this->parentTable, $data, $updateByColumn );
			$this->db->trans_complete ();
			if ($this->db->trans_status () === FALSE) {
				$this->db->trans_rollback ();
				return get_app_message ( "response.failed" );
			} else {
				$this->db->trans_complete ();
				return get_app_message ( "response.success" );
			}
		}
	}
}
