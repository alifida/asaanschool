<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Profit_model extends CI_Model {

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
		$this->db->select()->from('profit');

		// where condition if id is present
		if ($id != null) {
			$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		} else {
			$this->db->where('campus_id', $this->campusId);
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			return $query->row_array(); // single row
		} else {
			return $query->result_array(); // array of result
		}
	}

	public function getTop($top = 100) {
		
	    
		$rs = array ();
		
		$this->db->select ()->from ( 'profit' );
		$this->db->where ( "campus_id='$this->campusId'" );
		
		$this->db->order_by ( "`profit_date`", 'desc' );
		
		$this->db->limit ( $top, 0 );
		
		$query = $this->db->get ();
		
		$rs = $query->result_array (); // array of result
		return $rs;
	}




	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {

		$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		$this->db->delete('profit');
		return $this->db->affected_rows();
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
			$this->db->update('profit', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('profit', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}


	public function calculateCurrentProfit(){
		$this->load->model('Moneytransaction_Model', 'transaction');
		$response = array();
		$openTransactions = $this->transaction->getOpenTransactions();
		if(empty($openTransactions)){
			return array();
		}
		$response["openTransactions"] = $openTransactions;

		$profitCal = calculateProfit($openTransactions);
		if($profitCal != get_app_message("response.failed")){
			$response["profitAmount"] = $profitCal;
		}
//		pre_d($openTransactions);

		$expenseDetails = calculateExpense($openTransactions);
		if($expenseDetails != get_app_message("response.failed")){
			$response["expenseDetails"] = $expenseDetails;
		}


		$feeDetails = calculateFeeProfit($openTransactions);
		$remainingAmount = 0;
		if($feeDetails != get_app_message("response.failed")){
			 
			if(isset($feeDetails["remaining_amount"])){
				$remainingAmount = $feeDetails["remaining_amount"];
			}
			$paidFee = $feeDetails["paidFee"];
			$paidFee = $paidFee - $remainingAmount;
			$feeDetails["paidFee"] = $paidFee;
			$response["feeDetails"] = $feeDetails;
		}

		

		$inventoryDetails = calculateInventorySaleProfit($openTransactions);
		if($inventoryDetails != get_app_message("response.failed")){
			if($remainingAmount == 0 && isset($inventoryDetails["remaining_amount"])){
				$remainingAmount = $inventoryDetails["remaining_amount"];
			$salePaid = $inventoryDetails["salePaid"];
			$inventoryProfit = $inventoryDetails["inventoryProfit"];
			
			$salePaid = $salePaid = $remainingAmount;
			$inventoryProfit = $inventoryProfit - $remainingAmount;
			$inventoryDetails["salePaid"] = $salePaid;
			$inventoryDetails["inventoryProfit"] = $inventoryProfit;
			}
			
			$response["inventoryDetails"] = $inventoryDetails;
		}

		$discountsDetails = calculateDiscounts($openTransactions);
		if($discountsDetails != get_app_message("response.failed")){
			$response["discountsDetails"] = $discountsDetails;
		}


		return $response;
	}



	public function commetCurrentProfit($sessionUser){
		$profitResponse= $this->calculateCurrentProfit();
		if($profitResponse == get_app_message("response.failed")){
			return $profitResponse;
		}
		$currentProfit = array();

		$balance =0;
		$profit =0;
		if(isset($profitResponse["feeDetails"]["paidFee"])){
			$balance = $balance + $profitResponse["feeDetails"]["paidFee"];
			$profit = $profit + $profitResponse["feeDetails"]["paidFee"];
		}
		if(isset($profitResponse["inventoryDetails"]["salePaid"])){
			$balance = $balance + $profitResponse["inventoryDetails"]["salePaid"];
		}
		if(isset($profitResponse["inventoryDetails"]["inventoryProfit"])){
			$profit = $profit + $profitResponse["inventoryDetails"]["inventoryProfit"];
		}

		if (isset($profitResponse["expenseDetails"])){
			$profit = $profit - $profitResponse["expenseDetails"];
			$balance = $balance - $profitResponse["expenseDetails"];
		}
		if (isset($profitResponse["discountsDetails"])){
			$profit = $profit - $profitResponse["discountsDetails"];
			$balance = $balance - $profitResponse["discountsDetails"];
		}

		$currentProfit["profit_amount"] = $profit;
		$currentProfit["balance_amount"] = $balance;
		$currentProfit["profit_date"] = getCurrentDate();
		$currentProfit["created_by"] = $sessionUser["id"];

		$profitId = $this->merge($currentProfit);
		if(!is_numeric($profitId)){
			return get_app_message("response.failed");
		}


		// lock the transactions related to currentProfit

		$transactions = $profitResponse["openTransactions"];
		$transactionsUpdates = array();
		$expenseUpdates = array();
		foreach($transactions as $key => $transaction){
			$transactionsUpdate = array();
			$transactionsUpdate["id"] = $transaction["id"];
			$transactionsUpdate["profit_id"] =$profitId;
			$transactionsUpdates[] = $transactionsUpdate;
			
			$expenseUpdate = array();
			$expenseUpdate["transaction_id"]= $transaction["id"];
			$expenseUpdate["status"]= get_app_message("db.status.inactive");
			$expenseUpdates[] = $expenseUpdate;
			
		}

		$this->load->model('Moneytransaction_Model', 'transaction');
		$res = $this->transaction->updateProfitId($transactionsUpdates);
		if(!empty($expenseUpdates)){
			$this->load->model('Expense_Model', 'expense');
			foreach($expenseUpdates as $expenseUpdate){
				$this->expense->updateByTransactionId($expenseUpdate);
			}
		}
		
		
		if($res == get_app_message("response.failed")){
			// delete the newly created profit entry
			$this->remove($profitId);
			return get_app_message("response.failed");
		}else{
			return $profitId;
		}








	}

}
