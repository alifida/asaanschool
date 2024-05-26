<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Email_Model extends Base_Model {
	private $table="emails";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	
	public function getById($id = null) {
		$email = array ();
		if ($id == null) {
			return $email;
		}
		return parent::get($id);
		
	}
	public function save($data) {
		$newId = "";
		$this->db->trans_start ();
		$this->db->insert ( $this->table, $data ); // insert new record
		$newId = $this->db->insert_id ();
		$this->db->trans_complete ();
		return $newId;
	}
	
}
