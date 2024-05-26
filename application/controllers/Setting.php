<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Setting extends Protected_Controller {

	public function __construct() {

		parent::__construct();

			
		$this->load->model('Itemtype_Model', 'itemtype');
		$this->load->model('Feetype_Model', 'feetype');
		$this->load->model('Expensetype_Model', 'expenseType');
		$this->load->model('Employeetype_Model', 'employeeType');
		$this->load->model('Relationtype_Model', 'relationtype');
		$this->load->model('Configuration_Model', 'conf');
		$this->load->model('Transactiontype_Model', 'transactionType');
		$this->load->model('Usertype_Model', 'userType');


	}

	public function index($data =array()) {
			
		$itemTypes = $this->itemtype->get();
		$data["itemTypes"] = $itemTypes;
			
		$feeTypes = $this->feetype->get();
		$data["feeTypes"] = $feeTypes;
			
		$expenseTypes = $this->expenseType->get();
		$data["expenseTypes"] = $expenseTypes;
			
		$employeeTypes = $this->employeeType->get();
		$data["employeeTypes"] = $employeeTypes;
			

		$relationTypes = $this->relationtype->get();
		$data["relationTypes"] = $relationTypes;
			
		$configurations = $this->conf->getId();
		$data["configurations"] = $configurations;
			
		/*
		 $transactionTypes = $this->transactionType->get();
		 $data["transactionTypes"] = $transactionTypes;
		 */


		$userTypes = $this->userType->get();
		$data["userTypes"] = $userTypes;
			
		$this->template->load($this->activeTemplate, 'others/index', $data);
	}




	// ITEM TYPE Actions -------------=====================Starts
	public function saveItemType($data = array()){
		$id = $this->input->post('item_type_id');
		$name = $this->input->post('item_type_name');
		$itemType = array();
		if(!empty($id)){
			$itemType["id"] = $id;
		}
		$itemType["name"] = $name;
		$response = $this->itemtype->merge($itemType);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/inventory');
	}

	public function editItemType($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$itemType = $this->itemtype->get($id);
			$data["itemType"] = $itemType;
		}
		$this->template->load($this->activeTemplate, 'others/item_type_form', $data);
	}

	public function deleteConfirmationItemType($data = array()){
		$id =  $this->input->get("id");
		$itemType = $this->itemtype->get($id);
		$data["itemType"] = $itemType;
		$this->template->load($this->activeTemplate, 'others/item_type_delete', $data);
	}

	public function deleteItemType($data = array()){
		$id =  $this->input->post("item_type_id");
		$this->itemtype->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/inventory');
	}
	// ITEM TYPE Actions -------------=====================Ends



	// Fee TYPE Actions -------------=====================Starts
	public function saveFeeType($data = array()){
		$id = $this->input->post('fee_type_id');
		$name = $this->input->post('fee_type_name');
		$feeType = array();
		if(!empty($id)){
			$feeType["id"] = $id;
		}
		$feeType["type"] = $name;
		$response = $this->feetype->merge($feeType);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/classes');
	}

	public function editFeeType($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$feeType = $this->feetype->get($id);
			$data["feeType"] = $feeType;
		}
		$this->template->load($this->activeTemplate, 'others/fee_type_form', $data);
	}

	public function deleteConfirmationFeeType($data = array()){
		$id =  $this->input->get("id");
		$feeType = $this->feetype->get($id);

		$data["feeType"] = $feeType;
		$this->template->load($this->activeTemplate, 'others/fee_type_delete', $data);
	}

	public function deleteFeeType($data = array()){
		$id =  $this->input->post("fee_type_id");
		$feeType = $this->feetype->get($id);
	
		if($feeType['can_delete'] != "No"){
    		$this->feetype->remove($id);
    		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
		    $_SESSION["appErrors"][]= get_app_message("unauthorized.user");
		}
		
		redirect('/classes');
	}
	// Fee TYPE Actions -------------=====================Ends


	// Expense TYPE Actions -------------=====================Starts
	public function saveExpenseType($data = array()){
		$id = $this->input->post('expense_type_id');
		$name = $this->input->post('expense_type_name');
		$expenseType = array();
		if(!empty($id)){
			$expenseType["id"] = $id;
		}
		$expenseType["type"] = $name;
		$response = $this->expenseType->merge($expenseType);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/expense');
	}

	public function editExpenseType($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$expenseType = $this->expenseType->get($id);
			$data["expenseType"] = $expenseType;
		}
		$this->template->load($this->activeTemplate, 'others/expense_type_form', $data);
	}

	public function deleteConfirmationExpenseType($data = array()){
		$id =  $this->input->get("id");
		$expenseType = $this->expenseType->get($id);

		$data["expenseType"] = $expenseType;
		$this->template->load($this->activeTemplate, 'others/expense_type_delete', $data);
	}

	public function deleteExpenseType($data = array()){
		$id =  $this->input->post("expense_type_id");
		$this->expenseType->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/expense');
	}
	// Expense TYPE Actions -------------=====================Ends



	// Employee TYPE Actions -------------=====================Starts
	public function saveEmployeeType($data = array()){
		$id = $this->input->post('employee_type_id');
		$name = $this->input->post('employee_type_name');
		$employeeType = array();
		if(!empty($id)){
			$employeeType["id"] = $id;
		}
		$employeeType["type"] = $name;
		$response = $this->employeeType->merge($employeeType);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/employee');
	}

	public function editEmployeeType($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$employeeType = $this->employeeType->get($id);
			$data["employeeType"] = $employeeType;
		}
		$this->template->load($this->activeTemplate, 'others/employee_type_form', $data);
	}

	public function deleteConfirmationEmployeeType($data = array()){
		$id =  $this->input->get("id");
		$employeeType = $this->employeeType->get($id);

		$data["employeeType"] = $employeeType;
		$this->template->load($this->activeTemplate, 'others/employee_type_delete', $data);
	}

	public function deleteEmployeeType($data = array()){
		$id =  $this->input->post("employee_type_id");
		$this->employeeType->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/employee');
	}
	// Employee TYPE Actions -------------=====================Ends




	// Transaction TYPE Actions -------------=====================Starts
	public function saveTransactionType($data = array()){
		$id = $this->input->post('transaction_type_id');
		$name = $this->input->post('transaction_type_name');
		$transactionType = array();
		if(!empty($id)){
			$transactionType["id"] = $id;
		}
		$transactionType["type"] = $name;
		$response = $this->transactionType->merge($transactionType);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/setting');
	}

	public function editTransactionType($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$transactionType = $this->transactionType->get($id);
			$data["transactionType"] = $transactionType;
		}
		$this->template->load($this->activeTemplate, 'others/transaction_type_form', $data);
	}

	public function deleteConfirmationTransactionType($data = array()){
		$id =  $this->input->get("id");
		$transactionType = $this->transactionType->get($id);
		$data["transactionType"] = $transactionType;
		$this->template->load($this->activeTemplate, 'others/transaction_type_delete', $data);
	}

	public function deleteTransactionType($data = array()){
		$id =  $this->input->post("transaction_type_id");
		$this->transactionType->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/setting');
	}
	// Transaction TYPE Actions -------------=====================Ends






	// Relation TYPE Actions -------------=====================Starts
	public function saveRelationType($data = array()){
		$id = $this->input->post('relation_type_id');
		$name = $this->input->post('relation_type_name');
		$relationType = array();
		if(!empty($id)){
			$relationType["id"] = $id;
		}
		$relationType["relation"] = $name;
		$response = $this->relationtype->merge($relationType);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/setting');
	}

	public function editRelationType($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$relationType = $this->relationtype->get($id);
			$data["relationType"] = $relationType;
		}
		$this->template->load($this->activeTemplate, 'others/relation_type_form', $data);
	}

	public function deleteConfirmationRelationType($data = array()){
		$id =  $this->input->get("id");
		$relationType = $this->relationtype->get($id);
		$data["relationType"] = $relationType;
		$this->template->load($this->activeTemplate, 'others/relation_type_delete', $data);
	}

	public function deleteRelationType($data = array()){
		$id =  $this->input->post("relation_type_id");
		$this->relationtype->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/setting');
	}
	// Relation TYPE Actions -------------=====================Ends






	// Configuration TYPE Actions -------------=====================Starts
	public function saveConfiguration($data = array()){
		$id = $this->input->post('configuration_id');
		$label = $this->input->post('configuration_label');
		$value = $this->input->post('configuration_value');
		$configuration = array();
		if(!empty($id)){
			$configuration["id"] = $id;
		}
		$configuration["label"] = $label;
		$configuration["value"] = $value;
		//pre_d($configuration);
		$response = $this->conf->update($configuration);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/setting');
	}

	public function editConfiguration($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$configuration = $this->conf->getId($id);
			$data["configuration"] = $configuration;
		}
		$this->template->load($this->activeTemplate, 'others/configuration_form', $data);
	}




	// Configuration  Actions -------------=====================Ends

}

