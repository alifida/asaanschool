<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Profit extends Protected_Controller {

	public function __construct() {

		parent::__construct();

		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			

			
		$this->load->model('Moneytransaction_Model', 'transaction');
		$this->load->model('Reverttransaction_Model', 'revertTransaction');
		$this->load->model('Profit_Model', 'profit');

	}

	public function index($data =array()) {
			
		$transactions = $this->transaction->getOpenTransactions();
		$data["transactions"] = $transactions;

		$profitList = $this->profit->getTop(500);
		$data["profitList"] = $profitList;

		$this->template->load($this->activeTemplate, 'profit/index', $data);
			
	}

	public function profitDetail($data =array()) {
			
		$profitId = $this->input->get("id");
		if(empty($profitId)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/profit');
		}

		$profit = $this->profit->get($profitId);
		if(empty($profit)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/profit');
		}

		$data["profit"] = $profit;

		$transactions = $this->transaction->getByProfitId($profitId);
		$data["transactions"] = $transactions;

		// get balance expense and inventory profit/sale details from transactions
		$discount = calculateDiscounts($transactions);
		$expense = calculateExpense($transactions);
		$feeProfit = calculateFeeProfit($transactions);
		$inventoryDetails = calculateInventorySaleProfit($transactions);

		
		
		
		
		$remainingAmount = 0;
		if($discount != get_app_message("response.failed")){
			$data["discount"] = $discount;
		}
		if($expense != get_app_message("response.failed")){
			$data["expense"] = $expense;
		}
		if($feeProfit != get_app_message("response.failed")){
			if(isset($feeProfit["remaining_amount"])){
				$remainingAmount = $feeProfit["remaining_amount"];
			}
			$paidFee = $feeProfit["paidFee"];
			$paidFee = $paidFee - $remainingAmount;
			$feeProfit["paidFee"] = $paidFee;
			
			$data["feeProfit"] = $feeProfit;
		}
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
			
			
			
			$data["inventoryDetails"] = $inventoryDetails;
		}

		/*
		 if($response != get_app_message("response.failed")){
			$data["expectedProfit"] = $response;
			}else{
			$data["appErrors"][] = get_app_message("cannot_process_request");
			}
			*/
		$this->template->load($this->activeTemplate, 'profit/profit_detail', $data);
			
	}


	public function deleteProfit(){
		$profitId = $this->input->post("profit_id");
		$isConfirmed = $this->input->post("is_confirmed");
		if($isConfirmed  == "yes" && is_numeric($profitId)){
			$transactions = $this->transaction->getByProfitId($profitId);
			$rowsEffected = $this->profit->remove($profitId);
			if(is_numeric($rowsEffected)){
				$this->load->model('Expense_Model', 'expense');
				foreach ($transactions as $transaction){
					$expenseUpdate = array();
					$expenseUpdate["transaction_id"] = $transaction["id"];
					$expenseUpdate["status"] = get_app_message("db.status.active");
					$this->expense->updateByTransactionId($expenseUpdate);
				}
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			}else{
				$data["appErrors"][] = get_app_message("cannot_process_request");
			}
		}else{
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
		}
		redirect("/profit");
	}
	public function deleteProfitConfirm(){

		$profitId = $this->input->get("id");
		if(empty($profitId)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			// load
			$this->template->load($this->activeTemplate, 'profit/delete_profit_form', $data);
			return;
		}

		$profit = $this->profit->get($profitId);
		if(empty($profit)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			$this->template->load($this->activeTemplate, 'profit/delete_profit_form', $data);
			return;
		}

		$data["profit"] = $profit;

		$transactions = $this->transaction->getByProfitId($profitId);
		$data["transactions"] = $transactions;

		// get balance expense and inventory profit/sale details from transactions
		$discount = calculateDiscounts($transactions);
		$expense = calculateExpense($transactions);
		$feeProfit = calculateFeeProfit($transactions);
		$inventoryDetails = calculateInventorySaleProfit($transactions);


		if($discount != get_app_message("response.failed")){
			$data["discount"] = $discount;
		}
		if($expense != get_app_message("response.failed")){
			$data["expense"] = $expense;
		}
		if($feeProfit != get_app_message("response.failed")){
			$data["feeProfit"] = $feeProfit;
		}
		if($inventoryDetails != get_app_message("response.failed")){
			$data["inventoryDetails"] = $inventoryDetails;
		}


		$this->template->load($this->activeTemplate, 'profit/delete_profit_form', $data);
	}


	public function expectedProfit($data= array()){
		$response = $this->profit->calculateCurrentProfit();

		if($response == get_app_message("response.failed")){
			$data["appErrors"][] = get_app_message("cannot_process_request");
		}else{
			if(!empty($response)){
				$data["expectedProfit"] = $response;
			}
		}
		$this->template->load($this->activeTemplate, 'profit/expected_profit', $data);

	}

	public function calculateProfitForm($data= array()){
		$hideCalculateGridButton ="yes";
		$transactions = $this->transaction->getOpenTransactions();
		$data["transactions"] = $transactions;
		$data["hideCalculateButton"] = $hideCalculateGridButton;
		$this->template->load($this->activeTemplate, 'profit/calculate_profit_form', $data);
	}

	public function calculateCurrentProfit($data= array()){
		$isConfirmed = $this->input->post("is_confirmed");
		$transactions = $this->transaction->getOpenTransactions();
		if($isConfirmed  == "yes" && !empty($transactions)){
			// Calculate the profit and redirect to redirect('/profit');
			$response = $this->profit->commetCurrentProfit($_SESSION["sessionUser"]);
 
			if($response == get_app_message("response.failed")){
				$_SESSION["appErrors"][] = get_app_message("cannot_process_request");
			}else{
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
				//redirect("profit/profitDetail?id=".$response);
			}

		}else{
			$_SESSION["appErrors"][] = get_app_message("cannot_process_request");
				
		}
		redirect("/profit");
	}
	public function transactionDetail($data= array()){
		$transactionId = $this->input->get("id");
		if(empty($transactionId )){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/profit');
		}

		$transaction = $this->transaction->getDetails($transactionId);
		if(empty($transaction)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/profit');
		}


		$data["transaction"] = $transaction;
		$quickView = $this->input->get("quickView");
		if($quickView ==  1){
			$this->template->load($this->activeTemplate, 'profit/transaction_detail_view', $data);
		}else{
			$this->template->load($this->activeTemplate, 'profit/transaction_detail', $data);
		}
	}

	public function revertTransactionForm($data = array()){

		$transactionId = $this->input->get("id");
		if(empty($transactionId )){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			$this->template->load($this->activeTemplate, 'profit/revert_transaction_form', $data);
			return;
		}

		$transaction = $this->transaction->getDetails($transactionId);
		if(empty($transaction)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			$this->template->load($this->activeTemplate, 'profit/revert_transaction_form', $data);
			return;
		}


		$data["orignalTransaction"] = $transaction;
		$this->template->load($this->activeTemplate, 'profit/revert_transaction_form', $data);

	}

	public function revertTransaction(){
		$transactionId = $this->input->post("transaction_id");
		if(empty($transactionId )){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/profit');
			return;
		}

		$response = $this->revertTransaction->revert($transactionId, $_SESSION["sessionUser"]);
		if(!is_numeric($response)){
			$data["appErrors"][] = get_app_message("cannot_process_request");
			redirect("profit/transactionDetail?id=".$transactionId);
		}else{
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			redirect("profit/transactionDetail?id=".$response);
		}
	}

}

