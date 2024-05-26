<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Package_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null, $status = "", $countryCode ="" ) {
		$rs = array();
		if(empty($status)){
			$status = get_app_message("db.status.active");
		}
		if(empty($countryCode)){
			$countryCode = "Other";
		}
		$this->db->select()->from('app_packages');

		$this->db->where('status', $status);
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			$rs = $query->row_array();
			if(!empty($rs)){
				$this->load->model('Packageprice_Model', 'packagePrice');
				$price = $this->packagePrice->getPrice($rs["id"],$countryCode);
				$rs["price"]=$price;
			}
		} else {
			$rs = $query->result_array(); // array of result
			if(!empty($rs)){
				$this->load->model('Packageprice_Model', 'packagePrice');
				foreach($rs as $key=>$row){
					$price = $this->packagePrice->getPrice($row["id"],$countryCode);
					$rs[$key]["price"]=$price;
				}
			}
		}
		
		return $rs;
	}
	public function getPaid($status = "") {
		
		if(empty($status)){
			$status = get_app_message("db.status.active");
		}
		
		$countryCode = getClientCountry();
		
		$this->db->select()->from('app_packages');

		$this->db->where('status', $status);
		//$this->db->where('price > 0');
		$this->db->order_by('id');
		$query = $this->db->get();
		$rs = $query->result_array(); // array of result
		if(!empty($rs)){
			$this->load->model('Packageprice_Model', 'packagePrice');
			foreach($rs as $key=>$row){
				$price = $this->packagePrice->getPrice($row["id"],$countryCode);
				
				if($price["price"] > 0 ){
					$rs[$key]["price"]=$price;
				}else{
					unset($rs[$key]);
				}
			}
		}
		
		return $rs;
	}

	/*
	 public function getByStatus($campusId = null, $status = null) {
		$rs = array();
		if($campusId == null || $status == null ){
		return $rs;
		}
		$this->db->select()->from('app_packages');
		$this->db->where("(campus_id = '$campusId' AND status = '$status')");
		$query = $this->db->get();
		$rs = $query->result_array();
		return $rs;
		}
		*/



	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('app_packages');
	}

	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert. One function doing both add and edit.
	 * @param $data
	 */
	public function merge($data) {

		// comma must be the first and last character of String if it is not empty.

		$newId = "";
		$this->db->trans_start();

		if (isset($data['id']) && !empty($data['id'])) {
			$this->db->where('id', $data['id']);
			$this->db->update('app_packages', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			$this->db->insert('app_packages', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}

	
	public function getCountryWise($id = null, $status = "", $countryCode="Other" ) {
		$rs = array();
		if(empty($status)){
			$status = get_app_message("db.status.active");
		}
		$this->db->select()->from('app_packages');
	
		$this->db->where('status', $status);
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}
	
		$query = $this->db->get();
	
		if ($id != null) {
			$rs = $query->row_array();
			if(!empty($rs)){
				$this->load->model('Packageprice_Model', 'packagePrice');
				$price = $this->packagePrice->getPrice($rs["id"],$countryCode);
				$rs["price"]=$price;
			}
		} else {
			$rs = $query->result_array(); // array of result
			if(!empty($rs)){
				$this->load->model('Packageprice_Model', 'packagePrice');
				foreach($rs as $key=>$row){
					$price = $this->packagePrice->getPrice($row["id"],$countryCode);
					$rs[$key]["price"]=$price;
				}
			}
		}
		return $rs;
	}
	
	

}
