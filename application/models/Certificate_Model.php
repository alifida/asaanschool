<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Certificate_Model extends Base_Model {
	public $campusId;
	private $table = "certificates";
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
		}
		return $rs;
	}
	public function getByType($linkedWith = "") {
		$rs = array ();
		if (empty ( $linkedWith )) {
			return $rs;
		}
		$condition = "(campus_id = '$this->campusId' AND linked_with = '$linkedWith')";
		$rs = parent::getByCondition ( $condition );
		
		return $rs;
	}
	public function remove($id, $deleteByColumn = "id") {
		return parent::removeByCondition ( "(campus_id = '$this->campusId' AND id = '$id')" );
	}
	public function merge($data) {
		$data ['campus_id'] = $this->campusId;
		return parent::merge ( $data );
	}
	public function initParamValues($parameters, $contents, $candidateId) {
		$sql = "";
		$tables = array ();
		$columns = array ();
		
		foreach ( $parameters as $param ) {
			
			if (strpos ( $contents, $param ["short_code"] ) !== false) {
				$tables [] = $param ["db_table"];
				$alias = str_replace ( "{@", "PPRREE__", $param ["short_code"] );
				$alias = str_replace ( "@}", "___PPOOSSTT", $alias );
				$columns [] = $param ["db_col"] . " as " . $alias;
				if (! empty ( $param ["forign_table"] )) {
					$tables [] = $param ["forign_table"];
				}
			}
		}
		
		$columns = array_unique ( $columns );
		$tables = array_unique ( $tables );
		
		if (! empty ( $columns ) && ! empty ( $tables )) {
			$sql = " SELECT " . implode ( ", ", $columns ) . " FROM " . implode ( ", ", $tables ) . " WHERE campus_id = '$this->campusId' AND id = '$candidateId' ";
			$rs = parent::getBySQLQuery ( $sql );
			if (! empty ( $rs )) {
				$rs = $rs [0];
				foreach ( $rs as $key => $row ) {
					
					$shortCode = "";
					$shortCode = str_replace ( "___PPOOSSTT", "@}", $key );
					$shortCode = str_replace ( "PPRREE__", "{@", $shortCode );
					$contents = str_replace ( $shortCode, $row, $contents );
				}
			}
		}
		
		return $contents;
	}
	private function getUsedShortCodes($shortCode, $contents) {
		$shortCodes = array ();
		
		return $shortCodes;
	}
}
