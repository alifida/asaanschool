<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Invoice_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null, $campusId=null) {
		if($id==null || $campusId == null){
			return array();
		}

		$this->db->select()->from('invoices');
		// where condition if id is present
		$this->db->where('id', $id);
		$this->db->where('campus_id', $campusId);

		$query = $this->db->get();

		$row = $query->row_array(); // single row
		if(!empty($row)){
			// load reference models
			$this->load->model('Campuspackage_Model', 'campusPackage');
			$campusPackage = $this->campusPackage->getById($row["campus_package_id"]);
			$row["campusPackage"]=$campusPackage;
		}
		return $row;
	}
	public function getByCampus($campusId = null) {
		if($campusId == null){
			return array();
		}

		$this->db->select()->from('invoices');
		$this->db->where('campus_id', $campusId);
		$this->db->order_by('invoice_date','desc');
		$query = $this->db->get();

		$rs = $query->result_array(); // single row
		if(!empty($rs)){
			$this->load->model('Campuspackage_Model', 'campusPackage');
			foreach ($rs as $key => $row){
				$campusPackage = $this->campusPackage->getById($row["campus_package_id"]);
				$rs[$key]["campusPackage"]=$campusPackage;
			}
		}
		return $rs;
	}

	public function getLatestByCampus($campusId = null, $order_by=null){
		if($campusId == null ){
			return array();
		}
		
		if($order_by == null ){
			$order_by =  "invoice_expiry_date";
		}

		$this->db->select()->from('invoices');
		$this->db->where('campus_id', $campusId);
		
		$this->db->order_by($order_by,'desc');
		$query = $this->db->get();

		$rs = $query->result_array(); 
		if(!empty($rs)){
			$this->load->model('Campuspackage_Model', 'campusPackage');
			foreach ($rs as $key => $row){
				$campusPackage = $this->campusPackage->getById($row["campus_package_id"]);
				$rs[$key]["campusPackage"]=$campusPackage;
			}
		}
		return $rs;
	}

	public function getByCampusAndStatus($campusId = null , $status = null, $order_by="invoice_expiry_date") {
		if($campusId == null || $status == null){
			return array();
		}

		$this->db->select()->from('invoices');
		$this->db->where('campus_id', $campusId);
		$this->db->where('status', $status);
		$this->db->order_by($order_by,'desc');
		$query = $this->db->get();

		$rs = $query->result_array(); // single row
		if(!empty($rs)){
			$this->load->model('Campuspackage_Model', 'campusPackage');
			foreach ($rs as $key => $row){
				$campusPackage = $this->campusPackage->getById($row["campus_package_id"]);
				$rs[$key]["campusPackage"]=$campusPackage;
			}
		}
		return $rs;
	}

	public function getPaidActiveInvoice($campusId = null) {
		if($campusId == null ){
			return array();
		}
		$status = get_app_message("db.status.paid");
		$today = getCurrentDate();

		$this->db->select()->from('invoices');
		$this->db->where("(campus_id = '$campusId' AND status = '$status' AND invoice_expiry_date > '$today')");
		$query = $this->db->get();
		$rs = $query->result_array(); //

		/*
		 if(!empty($rs)){
			$this->load->model('Campuspackage_Model', 'campusPackage');
			foreach ($rs as $key => $row){
			$campusPackage = $this->campusPackage->getById($row["campus_package_id"]);
			$rs[$key]["campusPackage"]=$campusPackage;
			}
			}
			*/
		return $rs;
	}
	public function getByStatus($status = null) {
		if($status == null){
			return array();
		}

		$this->db->select()->from('invoices');
		$this->db->where('status', $status);

		$query = $this->db->get();

		$rs = $query->result_array(); // single row
		if(!empty($rs)){
			$this->load->model('Campuspackage_Model', 'campusPackage');
			foreach ($rs as $key => $row){
				$campusPackage = $this->campusPackage->getById($row["campus_package_id"]);
				$rs[$key]["campusPackage"]=$campusPackage;
			}
		}
		return $rs;
	}
	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('invoices');
	}

	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert. One function doing both add and edit.
	 * @param $data
	 */
	public function merge($data) {

		// comma must be the first and last character of String if it is not empty.
		//$data = $this->makeCalculation($data);




		$newId = "";
		$this->db->trans_start();

		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('invoices', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('invoices', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}
	/*

	private function makeCalculation($invoice=null){
	if($invoice==null){
	return $invoice;
	}

	if(empty($invoice["invoice_no"])){
	$invoice["invoice_no"]= $this->generateInvoiceNumber();
	}

	$totalBalance = $this->getTotalBalanceByCampus($_SESSION["currentCampus"]["id"]);

	$totalArrear = $this->getTotalArrearsByCampus($_SESSION["currentCampus"]["id"]);

	$balance = $totalBalance - $totalArrear + $invoice["paid_amount"];

	/ *
	if(isset($invoice["paid_amount"]) && $invoice["paid_amount"]){
	$balance = $balance - $invoice["paid_amount"];
	}
	* /
	if($balance <= 0){
	$balance = 0;
	}
	$invoice["balance"]=$balance;


	$arrears = $totalArrear - $totalBalance - $invoice["paid_amount"];

	if($arrears <=0){
	$arrears = 0;
	}

	$invoice["arrears"] = $arrears;

	$invoice["total_payable_amount"] = $currentPackageCharges + $arrears - $balance;






	return $invoice;

	}
	*/
	public function getTotalBalanceByCampus($campusId = null){
		if($campusId == null){
			return get_app_message("response.failed");
		}
		$this->db->select_sum('balance')->from('invoices');
		$this->db->where('campus_id', $campusId);
		$query = $this->db->get();
		$balance = $query->row_array();

		return $balance["balance"];
	}

	public function getTotalArrearsByCampus($campusId = null){
		if($campusId == null){
			return get_app_message("response.failed");
		}
		$this->db->select_sum('arrears')->from('invoices');
		$this->db->where('campus_id', $campusId);
		$query = $this->db->get();
		$arrear = $query->row_array();
		return $arrear["arrears"];
	}

	public function getTotalDiscountByCampus($campusId = null){
		if($campusId == null){
			return get_app_message("response.failed");
		}
		$this->db->select_sum('discount')->from('invoices');
		$this->db->where('campus_id', $campusId);
		$query = $this->db->get();
		$discount = $query->row_array();
		return $discount["discount"];
	}

	public function getTotalPaidAmount($campusId = null){
		if($campusId == null){
			return get_app_message("response.failed");
		}
		$this->db->select_sum('paid_amount')->from('invoices');
		$this->db->where('campus_id', $campusId);
		$query = $this->db->get();
		$paidAmount = $query->row_array();
		return $paidAmount["paid_amount"];
	}

	public function generateInvoiceNumber(){

		$this->db->select_max('invoice_no')->from('invoices');

		$query = $this->db->get();
		$maxNo = $query->row_array();

		return $maxNo["invoice_no"]+1;
	}


}
