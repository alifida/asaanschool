<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Base_Model.php');
class Websitefile_Model extends Base_Model {

	
	private $table = "website_files";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}


	public function getById($id = null) {
		$webImage = array();
		
		if($id == null){
			return $webImage;
		}
		$websiteId = getWebsiteIdByURL();
		$this->db->select()->from($this->table);

		$this->db->where("(website_id = '$websiteId' AND id = '$id')");

		$query = $this->db->get();
		$webImage = $query->row_array();
	
		return $webImage;

	}
	
	public function removeById($id = null){
		return parent::remove($id);
	}
	
	public function getByWebsite($websiteId = null) {
		$webFiles = array();
		if($websiteId == null){
			$websiteId = getWebsiteIdByURL();
		}
		$this->db->select()->from($this->table);
		$this->db->where('website_id', $websiteId);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		
		$webFiles = $query->result_array();

		return $webFiles;

	}

	public function merge($data) {
		// comma must be the first and last character of String if it is not empty.
		$newId = "";
		$this->db->trans_start();
		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('website_images', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert($this->table, $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}



}
