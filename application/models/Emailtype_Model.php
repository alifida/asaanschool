<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Emailtype_Model extends Base_Model {
	
	private $table ="email_types";
	
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	
	public function getById($id = null) {
		$type = array ();
		if ($id == null) {
			return $type ;
		}
		return parent::get($id);		
	}

	public function getByType($typeStr = null) {
		$type = array ();
		if ($typeStr == null) {
			return $type ;
		}
		$type = parent::getByColumn("type", $typeStr);
		if(!empty($type)){
			$type= $type[0];
		}
		return $type;
		
	}
	
}
