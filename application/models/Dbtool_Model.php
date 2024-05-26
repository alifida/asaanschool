<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Dbtool_Model extends Base_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function setTable($table) {
		$this->parentTable = $table;
	}
	public function getTables() {
		$schema = $this->db->database;
		$query = "select table_name from information_schema.tables where table_schema ='$schema'";
		
		return parent::getBySQLQuery ( $query );
	}
	public function getTotalCount($table) {
		$query = "Select count(*) as cnt  from `$table`";
		$rs = parent::getBySQLQuery ( $query );
		return $rs [0] ["cnt"];
	}
	public function getTableMetaInfo($table) {
		$query = "SELECT column_name, ordinal_position, data_type, numeric_precision, column_type, column_key,character_maximum_length,extra, is_nullable FROM information_schema.columns WHERE table_name = '$table'  group by column_name  order by ordinal_position";
		return parent::getBySQLQuery ( $query );
	}
	public function runSQL($sql) {
		$response = array ();
		$query = $this->db->query ( sprintf ( $sql ) );
		$errNum = $this->db->_error_number ();
		$errMsg = $this->db->_error_message ();
		if (empty ( $errNum ) && empty ( $errMsg )) {
			if(is_bool($query) && $query == 1){
				$response ["successMessage"] ="Affected Rows: ". $this->db->affected_rows();					
			}else{
				$response ["rs"] = $query->result();
			}
			$response ["status"] = get_app_message ( "response.success" );
		} else {
			$response ["status"] = get_app_message ( "response.failed" );
			$response ["errorNo"] = $this->db->_error_number ();
			$response ["errorMessage"] = $this->db->_error_message ();
		}
		return $response;
	}
}
