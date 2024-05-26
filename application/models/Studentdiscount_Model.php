<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Studentdiscount_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null) {
		$rs = array();
		$this->db->select()->from('students_discounts');

		// where condition if id is present
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			$row = $query->row_array(); // single row
			if(!empty($row)){
				$this->load->model('Moneytransaction_Model', 'transaction');
				$transaction = $this->transaction->get($row['transaction_id']);
				$row["transaction"]= $transaction;

			}
		} else {
			$rs = $query->result_array(); // array of result
			if(!empty($rs)){
				$this->load->model('Moneytransaction_Model', 'transaction');
				foreach($rs as $key => $row){
					$transaction = $this->transaction->get($row['transaction_id']);
					$rs[$key]["transaction"]= $transaction;
				}
			}
		}
		return $rs;
	}


	public function getByTransactionIds($transactionIds = array()) {
		$rs = array();
		if(empty($transactionIds)){
			return $rs;
		}

		$this->db->select()->from('students_discounts');
		// where condition if id is present
		$this->db->where_in('transaction_id', $transactionIds);
		$this->db->order_by('updated_at','ASC');
		$query = $this->db->get();
		$rs = $query->result_array(); // array of result
		
		if(!empty($rs)){
			$this->load->model('Moneytransaction_Model', 'transaction');
			
			foreach($rs as $key => $row){
				$transaction = $this->transaction->get($row['transaction_id']);
				$rs[$key]["transaction"]= $transaction;
			
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
		$this->db->delete('students_discounts');
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
			$this->db->update('students_discounts', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			$this->db->insert('students_discounts', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}
	public function insert($data) {
		$newId = "";
		$this->db->insert('students_discounts', $data); // insert new record
		$newId = $this->db->insert_id();
		return $newId;
	}

}
