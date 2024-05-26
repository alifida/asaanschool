<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Expense extends Protected_Controller {

	public function __construct() {

		parent::__construct();

		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			
		
		 
		$this->load->model('Expense_Model', 'expense');
		$this->load->model('Expensetype_Model', 'expenseType');


	}

	public function index($data =array()) {
			

		$activeExpenses  = $this->expense->getByStatus(get_app_message("db.status.active"));
		$data["activeExpenses"]=$activeExpenses ;
		
		$allExpenses = $this->expense->get();
		$data["allExpenses"]=$allExpenses;


		$expenseTypes = $this->expenseType->get();
		$data["expenseTypes"] = $expenseTypes;

		$this->template->load($this->activeTemplate, 'expense/index', $data);
			
	}

	public function saveExpense($data = array()){
		$id = $this->input->post('expense_id');
		$expenseTypeId= $this->input->post('expense_type_id');
		$description = $this->input->post('expense_description');
		$date = $this->input->post('expense_date');
		$amount = $this->input->post('expense_amount');
		$comments = $this->input->post('expense_comments');
		$expense = array();

		if(!empty($id)){
			$expense =  $this->expense->get($id);
			unset($expense["type"]);
		}else{
			$expense["status"] = get_app_message("db.status.active");
			$expense["amount"] = $amount;
		}
		$expense["expense_type_id"] = $expenseTypeId;
		$expense["description"] = $description;
		$expense["expense_date"] = $date;
		$expense["comments"] = $comments;
		$expense["updated_by"] = $_SESSION["sessionUser"]["id"];

		
		$response = $this->expense->saveExpense($expense);
		//pre_d($response);

		if($response == get_app_message("response.success")){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}

		redirect('/expense');
	}

	public function editExpense($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$expense = $this->expense->get($id);
			$data["expense"] = $expense;
		}
			
		$expenseTypes = $this->expenseType->get();
		$data["expenseTypes"] = $expenseTypes;


		$this->template->load($this->activeTemplate, 'expense/expense_form', $data);
	}
	public function  detailView($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$expense = $this->expense->get($id);
			$data["expense"] = $expense;
		}

		$this->template->load($this->activeTemplate, 'expense/detail_view', $data);
	}
/*
	public function revertConfirmationExpense($data = array()){
		$id =  $this->input->get("id");
		$expense = $this->expense->get($id);

		$data["expense"] = $expense;
		$this->template->load($this->activeTemplate, 'expense/expense_revert', $data);
	}

	public function revertExpense($data = array()){
		$id = $this->input->post("expense_id");
		if(!empty($id)){
			$expense = $this->expense->get($id);
			
			$response = $this->expense->revertExpense($expense, $_SESSION["sessionUser"]);
			if(get_app_message("response.success") == $response){
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			}else{
				$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			}
		}
		redirect('/expense');
	}
*/
}

