<?php


if(!function_exists('getProfitChartData')) {
	function getProfitChartData() {
		$profitChartJSON = "";
		$CI = get_instance();
		$CI->load->model('Profit_Model', 'profit');

		$profitList = $CI->profit->getTop(500);
		if(!empty($profitList)){
			$profitChartData = array();
			foreach ($profitList as $profit){
				$chartEntry = array();
				$chartEntry["m"] = $profit["profit_date"]; // m is for month
				$chartEntry["profit"] = $profit["profit_amount"];
				$profitChartData[]=	$chartEntry;
			}
			$profitChartJSON = json_encode($profitChartData);
			$profitChartJSON = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $profitChartJSON);
		}
		return $profitChartJSON;
	}

}


if(!function_exists('getClassWisePaymentData')) {
	function getClassWisePaymentData($transactions) {

		$classes = array();
		$campusId = $_SESSION["currentCampus"]["id"];


		$CI = get_instance();
		$CI->load->model('Class_Model','class');
		$CI->load->model('Studentfee_Model','studentFee');
		$CI->load->model('Studentitem_Model','studentItem');
		$CI->load->model('Studentdiscount_Model','studentDiscount');

		$incomeTransactionIds = array();
		foreach ($transactions as $transaction) {
			$internalKey = $transaction["type"]["internal_key"];
			if($transaction["status"]!=get_app_message("db.status.reverted") && $internalKey=="student.dues.clearance"){
					
				$incomeTransactionIds[]=$transaction["id"];
			}

		}
		$classes = $CI->class->get();
		if(!empty($classes)){


			$studentDueFees = $CI->studentFee->getByPaymentStatus($campusId, get_app_message("db.status.due"));


			$studentDueItems = $CI->studentItem->getByPaymentStatus($campusId, get_app_message("db.status.due"));


			$studentPaidFees = $CI->studentFee->getByTransactionIds($incomeTransactionIds);
			$studentPaidItems = $CI->studentItem->getByTransactionIds($incomeTransactionIds);
			$studentDiscounts = $CI->studentDiscount->getByTransactionIds($incomeTransactionIds);


			foreach($classes as $classKey => $class){
				// set random color
				$classes[$classKey]["chartColor"] = getRandomColorCode();



				// set Class Paid Amount
				$classes[$classKey]["paidAmount"] = 0;
				$classes[$classKey]["dueAmount"] = 0;
				if(!empty($incomeTransactionIds)){

					$classPaidAmount = 0;
					foreach ($studentPaidFees as $sf){
						if(isset($sf["student"]["class"]["id"]) && $sf["student"]["class"]["id"] == $class["id"]){
							$classPaidAmount = $classPaidAmount+ $sf["amount"];
								
							// subtract Discount if any
							foreach ($studentDiscounts as $dsKey=> $discount){
								if($discount["transaction_id"]==$sf["transaction_id"]
								&& (!isset($studentDiscounts[$dsKey]["status"]) || $studentDiscounts[$dsKey]["status"]!="adjusted")){
									$classPaidAmount = $classPaidAmount - $discount["discount_amount"];
									$studentDiscounts[$dsKey]["status"]="adjusted";
									break;
								}
							}
								
						}
					}


					foreach ($studentPaidItems as $si){
						if(isset($si["student"]["class"]["id"]) && $si["student"]["class"]["id"] == $class["id"]){
							$classPaidAmount = $classPaidAmount+ $si["due_money"];
								
								
								
							// subtract Discount if any
							foreach ($studentDiscounts as $dsKey=> $discount){
								if($discount["transaction_id"]==$si["transaction_id"]
								&& (!isset($studentDiscounts[$dsKey]["status"]) || $studentDiscounts[$dsKey]["status"]!="adjusted")){
									$classPaidAmount = $classPaidAmount - $discount["discount_amount"];
									$studentDiscounts[$dsKey]["status"]="adjusted";
									break;
								}
							}
								
						}
					}
						
					
					$classes[$classKey]["paidAmount"] = $classPaidAmount;
				}



				// set class due amount
				$dueFeeAmount = 0;
				foreach ($studentDueFees as $studentDueFee){
					if(isset($studentDueFee["student"]["class"]["id"]) && $studentDueFee["student"]["class"]["id"] == $class["id"]){
						$dueFeeAmount = $dueFeeAmount + $studentDueFee["amount"];
					}
				}

				$dueItemAmount = 0;
				foreach ($studentDueItems as $studentDueItem){
					if(isset($studentDueItem["student"]["class"]["id"]) && $studentDueItem["student"]["class"]["id"] == $class["id"]){
						$dueItemAmount = $dueItemAmount + $studentDueItem["due_money"];
					}
				}

				$classDues = $dueFeeAmount + $dueItemAmount;
				$classes[$classKey]["dueAmount"] = $classDues;
			}
		}

		
		return $classes;


	}
}




