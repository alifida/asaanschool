<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Reverttransaction_Model extends CI_Model {

	//reverted_transactions

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
		$this->db->select()->from('reverted_transactions');

		// where condition if id is present
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			return $query->row_array(); // single row
		} else {
			return $query->result_array(); // array of result
		}
	}
	public function getByRevertedTransactionId($revertedTransactionId = null) {
		$response = array();
		if($revertedTransactionId == null){
			return $response;
		}
		$this->db->select()->from('reverted_transactions');
		$this->db->where('reverted_transaction_id', $revertedTransactionId);
		$query = $this->db->get();
		$revertTransaction = $query->result_array(); // single row

		if(!empty($revertTransaction)){
			$response = $revertTransaction[0]; // only to get the first reverted transaction if there are multiple.
			if(isset($response["transaction_id"]) && isset($response["reverted_transaction_id"])){
				$this->load->model('Moneytransaction_Model', 'moneyTransaction');
				$response["orignalTransaction"] = $this->moneyTransaction->get($response["transaction_id"]);
				$response["revertedTransaction"] = $this->moneyTransaction->get($response["reverted_transaction_id"]);
			}else{
				return array();
			}
		}
		return $response;
	}




	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('reverted_transactions');
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
			$this->db->update('reverted_transactions', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			$this->db->insert('reverted_transactions', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}
	public function update($data) {
		if (isset($data['id']) && !empty($data['id'])) {
			$this->db->where('id', $data['id']);
			$this->db->update('reverted_transactions', $data); // update the record
		}
	}

	public function insert($data) {
		$this->db->insert('reverted_transactions', $data); // insert new record
		$newId = $this->db->insert_id();
		$this->db->trans_complete();
		return $newId;
	}


	public function revert($moneyTransactionId, $sessionUser){

		if(empty($moneyTransactionId)){
			return get_app_message("response.failed") ;
		}

		$this->load->model('Moneytransaction_Model', 'moneyTransaction');
		$this->load->model('Transactiontype_Model', 'transactionType');

		$orignalTransaction = $this->moneyTransaction->get($moneyTransactionId);
		if(empty($orignalTransaction) ){
			return get_app_message("response.failed") ;
		}

		$newTransaction = array();
		$newTransaction["amount"] = $orignalTransaction["amount"];
		$newTransaction["created_at"] = getCurrentDateTime();
		$newTransaction["created_by"] = $sessionUser["id"];
		$newTransaction["updated_at"] = getCurrentDateTime();
		$newTransaction["updated_by"] = $sessionUser["id"];


		$revertTransactionType = $this->transactionType->getByKey("revert.transaction");
		$newTransaction["transaction_type_id"] = $revertTransactionType["id"];

		$newTransactionId =  $this->moneyTransaction->merge($newTransaction);
		if(!is_numeric($newTransactionId)){
			return get_app_message("response.failed") ;
		}


		// save reverted Transaction to reverted_transactions table
		$revertedTrsaction = array();
		$revertedTrsaction["transaction_id"]=$moneyTransactionId;
		$revertedTrsaction["reverted_transaction_id"]=$newTransactionId;

		$response = $this->merge($revertedTrsaction);

		// update the status of orignal mony_transaction as reverted

		$orignalTransactionUpdate = array();
		$orignalTransactionUpdate["id"] = $orignalTransaction["id"];
		$orignalTransactionUpdate["status"] = get_app_message("db.status.reverted");
		$orignalTransactionUpdate["updated_by"] = $sessionUser["id"];
		$orignalTransactionUpdate["updated_at"] = getCurrentDateTime();

		$this->moneyTransaction->merge($orignalTransactionUpdate);


		if($orignalTransaction["type"]["internal_key"]=="student.dues.clearance"){
			$this->load->model('Studentfee_Model', 'studentFee');
			$this->load->model('Studentitem_Model', 'studentItem');
			
			$updateStudentFee = array();
			$updateStudentFee["transaction_id"] = $moneyTransactionId;
			$updateStudentFee["payment_status"] = get_app_message("db.status.reverted");
				
			$this->studentFee->updateByTransactionId($updateStudentFee);

			// update the Student Item Table against same Transaction ID if any
			$studentItem = array();
			$studentItem["transaction_id"] = $moneyTransactionId;
			$studentItem["payment_status"] = get_app_message("db.status.reverted");
			$this->studentItem->updateByTransactionId($studentItem);
				
				
				
		}elseif($orignalTransaction["type"]["internal_key"]=="other.expenses"){
			$this->load->model('Expense_Model', 'expense');
			$expenseUpdate = array();
			$expenseUpdate["transaction_id"] = $moneyTransactionId;
			$expenseUpdate ["status"]= get_app_message("db.status.reverted");
			$this->expense->updateByTransactionId($expenseUpdate);
		}elseif($orignalTransaction["type"]["internal_key"]=="employee.salaries"){
			$this->load->model('Employeesalary_Model', 'employeeSalary');
			$employeeSalaryUpdate =  array();
			$employeeSalaryUpdate["transaction_id"]= $moneyTransactionId;
			$employeeSalaryUpdate["payment_status"]= get_app_message("db.status.reverted");
			$employeeSalaryUpdate["updated_by"] = $sessionUser["id"];
			$employeeSalaryUpdate["updated_at"] = getCurrentDateTime();
			$res = $this->employeeSalary->updateByTransactionId($employeeSalaryUpdate);
		}




		if(is_numeric($response)){
			return $newTransactionId;
		}else{
			return get_app_message("response.failed") ;
		}

	}

}
