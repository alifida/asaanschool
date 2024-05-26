<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Emailattachments_Model extends CI_Model {
	private $table="email_attachments";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	
	/* public function getById($id = null) {
		$attachment = array ();
		if ($id == null) {
			return $attachment;
		}
		
		$this->db->select ()->from ( 'email_attachments' );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		return $query->row_array (); // single row
		
	}
	
	
	public function getByEmailId($emailId = null) {
		$attachment = array ();
		if ($emailId == null) {
			return $attachment;
		}
	
		$this->db->select ()->from ( 'email_attachments' );
		$this->db->where ( 'email_id', $emailId );
		$query = $this->db->get ();
		return $query->row_array (); // single row
	
	}
	public function save($data) {
		// comma must be the first and last character of String if it is not empty.
		$newId = "";
		$this->db->trans_start ();
		$this->db->insert ( 'email_attachments', $data ); // insert new record
		$newId = $this->db->insert_id ();
		$this->db->trans_complete ();
		return $newId;
	} */
}
