<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

if (!function_exists('calculateProfit')) {

	function calculateProfit($transactions = array()) {
		$profit = 0;
		if(empty($transactions)){
			return get_app_message("response.failed");
		}
		$CI = get_instance();
		$CI->load->model('Studentitem_Model','studentItem');
		foreach ($transactions as $key => $transaction){
			if(isset($transaction["type"]["internal_key"])){
				// skip Transaction with status = "Reverted" and with Transaction Type internal Key = "revert.transaction"
				if($transaction["type"]["internal_key"]!="revert.transaction" && $transaction["status"]!=get_app_message("db.status.reverted")){
					if($transaction["type"]["internal_key"]=="student.dues.clearance"){
						/* get the amount paid for student_item and subtract it from  $profit for same transaction
						 * b/c if there is any amount paid for student fee against the same transaction id
						 * should be added to $profit and the aomount for student_item should not be added.
						 *
						 * items profit is calculated separatly.
						 *
						 * So, First Add the Transaction["amount"] to $profit and then subtract
						 * the $student_item["due_money"] if $student_item["payment_status"]==paid.
						 */

						$profit = $profit + $transaction["amount"];
						$studentItems = $CI->studentItem->getByTransactionId($transaction["id"]);
						if(!empty($studentItems)){
							foreach($studentItems as $key => $studentItem){

								if($studentItem["payment_status"] ==  get_app_message("db.status.paid")){
									// 	only to subtract paid status becuase due status is not in money_transactions.
									$profit = $profit - $studentItem["due_money"];
								}
							}
						}

					}elseif($transaction["type"]["internal_key"]=="other.expenses"){
						$profit = $profit - $transaction["amount"];
					}elseif($transaction["type"]["internal_key"]=="employee.salaries"){
						$profit = $profit - $transaction["amount"];
					}


				}
			}
		}
			
		return $profit;
	}

}
if (!function_exists('calculateExpense')) {
	function calculateExpense($transactions = array()) {
		$expense = 0;
		if(empty($transactions)){
			return get_app_message("response.failed");
		}
		$CI = get_instance();
		$CI->load->model('Studentitem_Model','studentItem');
		foreach ($transactions as $key => $transaction){
			$internalKey = $transaction["type"]["internal_key"];
			if($transaction["status"]!=get_app_message("db.status.reverted")){
				if($internalKey=="other.expenses" || $internalKey == "employee.salaries"){
					$expense = $expense + $transaction["amount"] ;
				}
			}
		}
		return $expense;
	}
}

if (!function_exists('calculateInventorySaleProfit')) {
	function calculateInventorySaleProfit($transactions = array()) {
		$salePaid = 0;
		$saleDue = 0;
		$remainingAmount=0;
		$inventoryProfit = 0;
		$inventoryProfitDue = 0;
		if(empty($transactions)){
			return get_app_message("response.failed");
		}
			
		$CI = get_instance();

		$CI->load->model('Studentitem_Model','studentItem');
			
		foreach ($transactions as $key => $transaction){
			
			if(isset($transaction["remaining_amount"]) && !empty($transaction["remaining_amount"]) && is_numeric($transaction["remaining_amount"])){
				$remainingAmount = $remainingAmount + $transaction["remaining_amount"];
			}
			
			
			$internalKey = $transaction["type"]["internal_key"];
			if($transaction["status"]!=get_app_message("db.status.reverted")){
				if($internalKey=="student.dues.clearance"){
					// get paid and due money amount from student_items table bacause money_transaction table may contain fee amount and inventry amount as sum.
					$studentItems = $CI->studentItem->getByTransactionId($transaction["id"]);
					if(!empty($studentItems)){
						foreach($studentItems as $key => $studentItem){

							if($studentItem["payment_status"] ==  get_app_message("db.status.paid")){
								$salePaid = $salePaid + $studentItem["due_money"];
								$itemProfit =0;
								$purchasePrice = $studentItem["item"]["purchase_price"] * $studentItem["issued_amount"];
								$itemProfit = $studentItem["due_money"] - $purchasePrice;
								$inventoryProfit = $inventoryProfit + $itemProfit;

								/*	}elseif($studentItem["payment_status"] ==  get_app_message("db.status.due")){
								 $saleDue = $saleDue + $studentItem["due_money"];

								 $itemProfitDue =0;
								 $purchasePrice = $studentItem["item"]["purchase_price"] * $studentItem["issued_amount"];
								 $itemProfitDue = $studentItem["due_money"] - $purchasePrice;
								 $inventoryProfit = $inventoryProfit + $itemProfitDue;
								 */
							}
						}
					}
				}
			}
		}
		$inventoryStatus = array();
		$inventoryStatus["salePaid"] = $salePaid;
		//$inventoryStatus["saleDue"] = $saleDue;
		$inventoryStatus["inventoryProfit"] = $inventoryProfit;
		$inventoryStatus["remaining_amount"] = $remainingAmount;
		//$inventoryStatus["inventoryProfitDue"] = $inventoryProfitDue;
		return $inventoryStatus;
	}
}


if (!function_exists('calculateFeeProfit')) {
	function calculateFeeProfit($transactions = array()) {
		$paidFee = 0;
		$remainingAmount = 0;
		if(empty($transactions)){
			return get_app_message("response.failed");
		}
		$CI = get_instance();
		$CI->load->model('Studentfee_Model','studentFee');
		foreach ($transactions as $key => $transaction){
			if(isset($transaction["remaining_amount"]) && !empty($transaction["remaining_amount"]) && is_numeric($transaction["remaining_amount"])){
				$remainingAmount = $remainingAmount + $transaction["remaining_amount"];
			}
			$internalKey = $transaction["type"]["internal_key"];
			if($transaction["status"]!=get_app_message("db.status.reverted")){
				if($internalKey=="student.dues.clearance"){
					$studentFees = $CI->studentFee->getByTransactionId($transaction["id"]);
					if(!empty($studentFees)){
						foreach($studentFees as $key => $studentFee){

							if($studentFee["payment_status"] ==  get_app_message("db.status.paid")){
								$paidFee = $paidFee + $studentFee["amount"];
							}
						}
					}
				}
			}
		}
		$feeStatus = array();
		$feeStatus["remaining_amount"] = $remainingAmount;
		$feeStatus["paidFee"]=$paidFee;
		
		return $feeStatus;
		
	}
}
/* if (!function_exists('calculateArrears')) {
	function calculateArrears($transactions = array()) {
		$arrearAmount= 0;
		
		if (empty ( $transactions )) {
			return get_app_message ( "response.failed" );
		}
		$CI = get_instance ();
		$CI->load->model ( 'Studentfee_Model', 'studentFee' );
		$arrears = $CI->studentFee->getByTypeAndStatus ( 'fee.arrears', get_app_message ( "db.status.due" ) );
		
		if (! empty ( $arrears )) {
			
			foreach ( $arrears as $key => $studentFee ) {
				
				$arrearAmount = $arrearAmount + $studentFee ["amount"];
			}
		}
		$feeStatus = array ();
		$feeStatus ["paidFee"] = $paidFee;
		return $feeStatus;
	}
} */

if (!function_exists('calculateDiscounts')) {
	function calculateDiscounts($transactions = array()) {
		$totalDiscount = 0;
		if(empty($transactions)){
			return $totalDiscount;
		}
		$CI = get_instance();
		$CI->load->model('Studentdiscount_Model','discount');
		$transactionIds = array();
		foreach ($transactions as $key => $tr){
			$transactionIds[] = $tr["id"];
		}

		//pre_d($transactionIds);
		$discounts = $CI->discount->getByTransactionIds($transactionIds);

		if(!empty($discounts)){
			foreach ($discounts as $key => $discount){
				$transaction = $discount["transaction"];
				$internalKey = $transaction["type"]["internal_key"];
				if($transaction["status"] != get_app_message("db.status.reverted")){
					$totalDiscount = $totalDiscount + $discount["discount_amount"];
				}
			}
		}
		return $totalDiscount;
	}

}

if (!function_exists('getFeePaid')) {
	function getFeePaid($transactions = array()) {
		$feeStatus = calculateFeeProfit($transactions);
		if($feeStatus == get_app_message("response.failed")){
			return 0;
		}
		return $feeStatus["paidFee"] ;
	}
}

if (!function_exists('getTotalFeeDues')) {
	function getTotalFeeDues($campusId=null) {
		$feeDues =0;
		$CI = get_instance();
		$CI->load->model('Studentfee_Model','studentFee');
		$studentDueFee = $CI->studentFee->getByPaymentStatus($campusId, get_app_message("db.status.due"));
		//pre_d($studentDueFee );
		if(!empty($studentDueFee)){
			foreach ($studentDueFee as $key => $dueFee){
				$feeDues =  $feeDues + $dueFee["amount"];
			}
		}
		return $feeDues;
	}
}
if (!function_exists('getTotalInventoryDues')) {
	function getTotalInventoryDues($campusId) {
		$itemDues =0;
		$CI = get_instance();
		$CI->load->model('Studentitem_Model','studentItem');
		$studentDueItems = $CI->studentItem->getByPaymentStatus($campusId, get_app_message("db.status.due"));
		if(!empty($studentDueItems)){
			foreach ($studentDueItems as $key => $dueItem){
				$itemDues = $itemDues + $dueItem["due_money"];
			}
		}
		return $itemDues;
	}
}




if (!function_exists('getTotalPaidAmount')) {
	function getTotalPaidAmount($transactions = array()) {
		$paidAmount = 0;
		if(empty($transactions)){
			return $paidAmount;
		}
		//$CI = get_instance();
		//$CI->load->model('Studentfee_Model','studentFee');
		foreach ($transactions as $key => $transaction){
			$internalKey = $transaction["type"]["internal_key"];
			if($transaction["status"]!=get_app_message("db.status.reverted")){
				if($internalKey=="student.dues.clearance"){
					$paidAmount = $paidAmount + $transaction["amount"];
				}
			}
		}
		return $paidAmount;
	}
}


if (!function_exists('getTotalDueAmount')) {
	function getTotalDueAmount($campusId) {
		
		$feeDues = getTotalFeeDues($campusId);
		$inventoryDues = getTotalInventoryDues($campusId);
		$totalDues = $feeDues + $inventoryDues;
		return $totalDues;
		
	}
}





