<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Expense_Model extends CI_Model {


	public $campusId ;

	public function __construct() {
		parent::__construct();
		$this->campusId = $_SESSION["currentCampus"]["id"];
	}


	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null) {
		$this->db->select()->from('expenses');

		// where condition if id is present
		if ($id != null) {
			$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		} else {
			$this->db->where('campus_id', $this->campusId);
			$this->db->order_by('expense_date','DESC');
		}

		$query = $this->db->get();

		if ($id != null) {
			$expense = $query->row_array();
			if(!empty($expense)){
				$this->load->model('Expensetype_Model', 'expenseType');
				$expenseType = $this->expenseType->get($expense["expense_type_id"]);
				$expense["type"]=$expenseType;
					
			}
			return $expense; // single row
		} else {
			$expenses = $query->result_array();
			if(!empty($expenses)){
				$this->load->model('Expensetype_Model', 'expenseType');
				foreach($expenses as $key => $expense){
					$expenseType = $this->expenseType->get($expense["expense_type_id"]);
					$expenses[$key]["type"]=$expenseType;
				}
			}
			return $expenses ;
		}
	}


	public function getByStatus($status){



		$expenses = array();
		if(!empty($status)){

			//if(get_app_message("db.status.active") == $status){
			// fetch only with valid profit ID
			/*$this->db->select()->from('expenses')
			 ->join('money_transactions','expenses.transaction_id = money_transactions.id');

				$this->db->where("(expenses.campus_id = '$this->campusId' AND expenses.status = '$status' AND money_transactions.profit_id IS NULL)");
				$this->db->order_by('expense_date', "DESC");
				$query = $this->db->get();
				//pre_d($this->db->last_query());
				$expenses = $query->result_array();
				*/
			//}else{
			$this->db->select()->from('expenses');
			$this->db->where("(campus_id = '$this->campusId' AND status = '$status')");
			$this->db->order_by('expense_date', "DESC");
			$query = $this->db->get();
			$expenses = $query->result_array();
			//}


			if(!empty($expenses)){
				$this->load->model('Expensetype_Model', 'expenseType');
				foreach($expenses as $key => $expense){
					$expenseType = $this->expenseType->get($expense["expense_type_id"]);
					$expenses[$key]["type"]=$expenseType;
				}
			}
		}
		return $expenses;
	}

	public function getByTransactionId($transactionId){
		$expenses = array();
		if(!empty($transactionId)){
			$this->db->select()->from('expenses');
			//$this->db->where('transaction_id', $transactionId);
			$this->db->where("(campus_id = '$this->campusId' AND transaction_id = '$transactionId')");
			$this->db->order_by('expense_date', "DESC");
			$query = $this->db->get();

			$expenses = $query->result_array();
			if(!empty($expenses)){
				$this->load->model('Expensetype_Model', 'expenseType');
				foreach($expenses as $key => $expense){
					$expenseType = $this->expenseType->get($expense["expense_type_id"]);
					$expenses[$key]["type"]=$expenseType;
				}
			}
		}
		return $expenses;
	}


	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		$this->db->delete('expenses');
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
		$data["campus_id"] = $this->campusId;
		if (isset($data['id']) && !empty($data['id'])) {
			$this->db->where('id', $data['id']);
			$this->db->update('expenses', $data); // update the record
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('expenses', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}
	public function update($data) {
		if (isset($data['id']) && !empty($data['id'])) {
			$id = $data['id'];
			$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
			$this->db->update('expenses', $data); // update the record
		}
	}


	public function insert($data) {
		$newId = "";
		$data["campus_id"] = $this->campusId;
		$this->db->insert('expenses', $data); // insert new record
		$newId = $this->db->insert_id();
		return $newId;
	}



	public function saveExpense($expense){
		if(!isset($expense["id"])){
			$this->db->trans_start();
			$this->load->model('Moneytransaction_Model', 'moneyTransaction');
			$this->load->model('Transactiontype_Model', 'transactionType');
			// money Transaction
			$moneyTransactionType = $this->transactionType->getByKey("other.expenses");
			$moneyTransaction = array();
			$moneyTransaction["amount"]=$expense["amount"];
			$moneyTransaction["transaction_type_id"]=$moneyTransactionType["id"];
			$moneyTransaction["created_at"]=getCurrentDateTime();
			$moneyTransaction["created_by"]=$expense["updated_by"];
			$moneyTransaction["updated_by"]=$expense["updated_by"];

			$transactionId = $this->moneyTransaction->insert($moneyTransaction);

			$expense["transaction_id"] = $transactionId;

			$this->insert($expense);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return get_app_message("response.failed");
			} else {
				$this->db->trans_complete();
				return get_app_message("response.success");
			}
		}else{
			$res = $this->merge($expense);
			if(get_app_message ( "response.success" ) == $res){
				return get_app_message("response.success");
			}else{
				return get_app_message("response.failed");
			}
		}


	}

	public function updateByTransactionId($data) {
		if (isset($data['transaction_id']) && !empty($data['transaction_id'])) {
			$t_id = $data['transaction_id'];
			$this->db->where("(campus_id = '$this->campusId' AND transaction_id = '$t_id')");
			$this->db->update('expenses', $data); // update the record
			return get_app_message ( "response.success" );
		}else{
			return get_app_message ( "response.failed" );
		}
	}

/*
	public function updateByTransactionId($data) {
		if (isset($data['transaction_id']) && !empty($data['transaction_id'])) {
			$this->db->where('transaction_id', $data['transaction_id']);
			$this->db->update('expenses', $data); // update the record
			return get_app_message ( "response.success" );
		}else{
			return get_app_message ( "response.failed" );
		}
	}
*/
	public function revertExpense($expense, $sessionUser){
		$response = "";
		if(isset($expense["transaction_id"]) && !empty($expense["transaction_id"])){
			$this->load->model('Reverttransaction_Model', 'revertTransaction');
			$response = $this->revertTransaction->revert($expense["transaction_id"], $sessionUser);
			if(get_app_message("response.success") == $response){
				$expenseUpdate = array();
				$expenseUpdate["transaction_id"] = $expense["transaction_id"];
				$expenseUpdate ["status"]= get_app_message("db.status.reverted");
				$this->updateByTransactionId($expenseUpdate);
			}
		}
		//pre_d($response);
		return $response;
	}

}
