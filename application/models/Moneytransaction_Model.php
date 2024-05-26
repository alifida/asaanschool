<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Moneytransaction_Model extends CI_Model {
	
	// money_transactions
	public $campusId;
	public function __construct() {
		parent::__construct ();
		
		$this->campusId = $_SESSION ["currentCampus"] ["id"];
	}
	
	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null) {
		$this->db->select ()->from ( 'money_transactions' );
		
		// where condition if id is present
		if ($id != null) {
			$this->db->where ( "(campus_id = '$this->campusId' AND id = '$id')" );
		} else {
			$this->db->where ( 'campus_id', $this->campusId );
		}
		$this->db->order_by ( 'updated_at', "DESC" );
		
		$query = $this->db->get ();
		if ($id != null) {
			$row = $query->row_array (); // single row
			if (! empty ( $row )) {
				$this->load->model ( 'Transactiontype_Model', 'transactionType' );
				$type = $this->transactionType->get ( $row ["transaction_type_id"] );
				$row ["type"] = $type;
			}
			return $row;
		} else {
			$rs = $query->result_array (); // array of result
			if (! empty ( $rs )) {
				$this->load->model ( 'Transactiontype_Model', 'transactionType' );
				foreach ( $rs as $key => $row ) {
					$type = $this->transactionType->get ( $row ["transaction_type_id"] );
					$rs [$key] ["type"] = $type;
				}
			}
			return $rs;
		}
	}
	public function getDetails($id = null) {
		$transaction = array ();
		$this->db->select ()->from ( 'money_transactions' );
		if ($id == null) {
			return $transaction;
		}
		$this->db->where ( "(campus_id = '$this->campusId' AND id = '$id')" );
		$query = $this->db->get ();
		
		$transaction = $query->row_array (); // single row
		if (! empty ( $transaction )) {
			// get Transaction Type
			$this->load->model ( 'Transactiontype_Model', 'transactionType' );
			$type = $this->transactionType->get ( $transaction ["transaction_type_id"] );
			$transaction ["type"] = $type;
			// get the Transactions References
			$transaction = $this->getReferecesByTransaction ( $transaction );
		}
		return $transaction;
	}
	public function getDetailsByIds($ids = null) {
		$transactions = array ();
		$this->db->select ()->from ( 'money_transactions' );
		if ($ids == null) {
			return $transaction;
		}
		$this->db->where ( "(campus_id = '$this->campusId' AND id in ($ids))" );
		$query = $this->db->get ();
		 
		$transactions = $query->result_array ();
		//pre_d($transactions);
		if (! empty ( $transactions )) {
			$this->load->model ( 'Transactiontype_Model', 'transactionType' );
			foreach ( $transactions as $key=>$transaction ) {
				$type = $this->transactionType->get ( $transaction ["transaction_type_id"] );
				$transaction ["type"] = $type;
				// get the Transactions References
				$transactions[$key] = $this->getReferecesByTransaction ( $transaction );
			}
		}
		return $transactions;
	}
	public function getReferecesByTransaction($transaction) {
		$type = $transaction ["type"];
		// get the transaction referenced record.
		if ($type ["internal_key"] == "student.dues.clearance") {
			/*
			 * load student_fee by transaction_id
			 * load student_item by transaction_id
			 * load student_discount by transaction_id
			 */
			$this->load->model ( 'Studentfee_Model', 'studentFee' );
			$this->load->model ( 'Studentitem_Model', 'studentItem' );
			$this->load->model ( 'Studentdiscount_Model', 'studentDiscount' );
			
			$studentFee = $this->studentFee->getByTransactionId ( $transaction ["id"] );
			$studentItems = $this->studentItem->getByTransactionId ( $transaction ["id"] );
			$studentDiscounts = $this->studentDiscount->getByTransactionIds ( $transaction ["id"] );
			$transaction ["studentFee"] = $studentFee;
			$transaction ["studentItems"] = $studentItems;
			$transaction ["studentDiscounts"] = $studentDiscounts;
		} elseif ($type ["internal_key"] == "employee.salaries") {
			// load employee_salaries by transaction_id
			$this->load->model ( 'Employeesalary_Model', 'employeeSalary' );
			$employeeSalary = $this->employeeSalary->getByTransactionId ( $transaction ["id"] );
			$transaction ["employeeSalary"] = $employeeSalary;
		} elseif ($type ["internal_key"] == "other.expenses") {
			// load expenses by transaction_id
			$this->load->model ( 'Expense_Model', 'expense' );
			$otherExpenses = $this->expense->getByTransactionId ( $transaction ["id"] );
			$transaction ["otherExpenses"] = $otherExpenses;
		} elseif ($type ["internal_key"] == "revert.transaction") {
			// load the reverted transaction and then on the basis of reverted transaction_id["internal_key"]
			$this->load->model ( 'Reverttransaction_Model', 'revertTransaction' );
			$revertTransaction = $this->revertTransaction->getByRevertedTransactionId ( $transaction ["id"] );
			if (empty ( $revertTransaction )) {
				return array ();
			} else {
				$orignalTransaction = $revertTransaction ["orignalTransaction"];
				$orignalTransactionWithReferences = $this->getReferecesByTransaction ( $orignalTransaction );
				$transaction ["orignalTransaction"] = $orignalTransactionWithReferences;
			}
		}
		return $transaction;
	}
	
	/**
	 * This function will delete the record based on the id
	 *
	 * @param
	 *        	$id
	 */
	public function remove($id) {
		$this->db->where ( "(campus_id = '$this->campusId' AND id = '$id')" );
		$this->db->delete ( 'money_transactions' );
	}
	
	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert.
	 * One function doing both add and edit.
	 *
	 * @param
	 *        	$data
	 */
	public function merge($data) {
		
		// comma must be the first and last character of String if it is not empty.
		$newId = "";
		$this->db->trans_start ();
		$data ["campus_id"] = $this->campusId;
		
		if (isset ( $data ['id'] ) && ! empty ( $data ['id'] )) {
			
			$this->db->where ( 'id', $data ['id'] );
			$this->db->update ( 'money_transactions', $data ); // update the record
			$this->db->trans_complete ();
			
			if ($this->db->trans_status () === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
			$this->db->insert ( 'money_transactions', $data ); // insert new record
			$newId = $this->db->insert_id ();
			$this->db->trans_complete ();
			return $newId;
		}
	}
	public function update($data) {
		if (isset ( $data ['id'] ) && ! empty ( $data ['id'] )) {
			$data ["campus_id"] = $this->campusId;
			
			$this->db->where ( 'id', $data ['id'] );
			$this->db->update ( 'money_transactions', $data ); // update the record
		}
	}
	public function updateProfitId($data) {
		if (! empty ( $data )) {
			$this->db->trans_start ();
			
			// $this->db->where('id', $data['id']);
			$this->db->update_batch ( 'money_transactions', $data, 'id' );
			$this->db->trans_complete ();
			if ($this->db->trans_status () === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		}
	}
	public function insert($data) {
		$data ["campus_id"] = $this->campusId;
		
		$this->db->insert ( 'money_transactions', $data ); // insert new record
		$newId = $this->db->insert_id ();
		$this->db->trans_complete ();
		return $newId;
	}
	public function getOpenTransactions() {
		$this->db->select ()->from ( 'money_transactions' );
		// where condition if id is present
		$this->db->where ( 'profit_id', null, "" );
		$this->db->where ( "(campus_id = '$this->campusId' AND (profit_id is NULL OR profit_id = ''))" );
		$this->db->order_by ( 'updated_at', "DESC" );
		$query = $this->db->get ();
		$rs = $query->result_array (); // array of result
		if (! empty ( $rs )) {
			$this->load->model ( 'Transactiontype_Model', 'transactionType' );
			foreach ( $rs as $key => $row ) {
				$type = $this->transactionType->get ( $row ["transaction_type_id"] );
				$rs [$key] ["type"] = $type;
			}
		}
		return $rs;
	}
	public function getByProfitId($profitId = null) {
		$rs = array ();
		if ($profitId == null) {
			return $rs;
		}
		
		$this->db->select ()->from ( 'money_transactions' );
		// where condition if id is present
		$this->db->where ( "(campus_id = '$this->campusId' AND profit_id = '$profitId')" );
		$this->db->order_by ( 'updated_at' );
		$query = $this->db->get ();
		$rs = $query->result_array (); // array of result
		
		if (! empty ( $rs )) {
			$this->load->model ( 'Transactiontype_Model', 'transactionType' );
			foreach ( $rs as $key => $row ) {
				$type = $this->transactionType->get ( $row ["transaction_type_id"] );
				$rs [$key] ["type"] = $type;
			}
		}
		return $rs;
	}
	public function getByGuardian($guardianId = null) {
		if (empty ( $guardianId )) {
			return 0;
		}
		$status = get_app_message ( "db.status.active" );
		$sql = "SELECT count(s.id) as cnt from students s, students_guardians sg " . " where s.id = sg.student_id " . " and sg.guardian_id = '$guardianId' " . " and s.status ='$status'";
		
		$query = $this->db->query ( $sql );
		
		$rs = $query->row_array ();
		if (! empty ( $rs )) {
			return $rs ["cnt"];
		}
		
		return 0;
	}
}
