<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Contactdetail_Model extends Base_Model {
	
	private $table = "contact_details";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	
	public function get($id = null) {
		$contactDetail = array ();
		if ($id == null) {
			return $contactDetail;
		}
		return parent::get($id);
	}
}
