<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Employeesalary_Model extends CI_Model {

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
		$this->db->select()->from('employee_salaries');

		// where condition if id is present
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			$employeeSalary =  $query->row_array(); // single row


			if(!empty($employeeSalary)){
				$this->load->model('Employee_Model', 'employee');
				$employee = $this->employee->get($employeeSalary["employee_id"]);
				$employeeSalary["employee"]=$employee;
			}

			return $employeeSalary;

		} else {
			$employeeSalaries = $query->result_array(); // array of result
			if(!empty($employeeSalaries)){
				$this->load->model('Employee_Model', 'employee');
				foreach($employeeSalaries as $key => $employeeSalary){
					$employee = $this->employee->get($employeeSalary["employee_id"]);
					$employeeSalaries[$key]["employee"]=$employee;
				}
			}
			return $employeeSalaries;

		}
	}


	public function getByEmployeeId($employeeId = null) {
		$this->db->select()->from('employee_salaries');
		$this->db->where('employee_id', $employeeId);
		$this->db->order_by('month',"desc");
		$query = $this->db->get();
		return $query->result_array();

	}

	public function getByTransactionId($transactionId = null) {
		$employeeSalaries = array();
		if($transactionId == null){
			return $employeeSalaries;
		}
		$this->db->select()->from('employee_salaries');
		$this->db->where('transaction_id', $transactionId);
		$this->db->order_by('month',"desc");
		$query = $this->db->get();
		$employeeSalaries = $query->result_array(); // array of result
		if(!empty($employeeSalaries)){
			$this->load->model('Employee_Model', 'employee');
			foreach($employeeSalaries as $key => $employeeSalary){
				$employee = $this->employee->get($employeeSalary["employee_id"]);
				$employeeSalaries[$key]["employee"]=$employee;
			}
		}
		return $employeeSalaries;

	}




	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('employee_salaries');
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
			$this->db->update('employee_salaries', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('employee_salaries', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}


	public function update($data) {
		if (isset($data['id']) && !empty($data['id'])) {
			$this->db->where('id', $data['id']);
			$this->db->update('employee_salaries', $data); // update the record
		}
	}
	public function updateByTransactionId($data) {

		if (isset($data['transaction_id']) && !empty($data['transaction_id'])) {
				
			$this->db->where('transaction_id', $data['transaction_id']);
			$this->db->update('employee_salaries', $data); // update the record
			return get_app_message ( "response.success" );
		}else{
				
			return get_app_message ( "response.failed" );
		}

	}


	public function getEmployeeSalariesByMonth($date){
		$employeeSalaries= array();
		if(empty($date)){
			return $employeeSalaries;
		}
		$date= $date ."-01";
		$this->db->select()->from('employee_salaries');

		$this->db->where('month', $date);
		$query = $this->db->get();
		$employeeSalaries = $query->result_array();
		return $employeeSalaries;

	}

	public function issueSalaryForMonth($employees, $salaryMonth,$comments, $sessionUser){

		$employeeSalaries = array();
		$issuedEmployeeSalaries =  $this->getEmployeeSalariesByMonth($salaryMonth);
		$salaryDate =  $salaryMonth ."-01";
		$totalTransactionAmount=0;
		foreach($employees as $employee){
			$alreadyIssued = false;

			if(!empty($issuedEmployeeSalaries)){
				foreach($issuedEmployeeSalaries as $issuedSalary){
					if($employee["id"] == $issuedSalary["employee_id"] && $salaryDate == $issuedSalary["month"] ){
						$alreadyIssued = true;
						break;
					}
				}
			}

			if(!$alreadyIssued){
				$employeeSalary= array();
				$employeeSalary["employee_id"]=$employee["id"];
				$employeeSalary["month"]=$salaryDate;
				$employeeSalary["amount"]=$employee["salary"];
				$employeeSalary["payment_status"]=get_app_message("db.status.paid");

				$employeeSalary["paid_date"]=getCurrentDate();
				$employeeSalary["updated_at"]=getCurrentDateTime();
				$employeeSalary["updated_by"]=$sessionUser["id"];
				$employeeSalary["comments"]=$comments;

				$totalTransactionAmount = $totalTransactionAmount + $employee["salary"];
				$employeeSalaries[] = $employeeSalary;
			}

		}

		$this->db->trans_start();
		$this->load->model('Transactiontype_Model', 'transactionType');

		$moneyTransactionType = $this->transactionType->getByKey("employee.salaries");

		// insert Money Transaction and get id and insert with each employeeSalary record.
		$this->load->model('Moneytransaction_Model', 'moneyTransaction');
		$moneyTransaction = array();
		$moneyTransaction["amount"]=$totalTransactionAmount;
		$moneyTransaction["transaction_type_id"]=$moneyTransactionType["id"];
		$moneyTransaction["created_at"]=getCurrentDateTime();
		$moneyTransaction["created_by"]=$sessionUser["id"];
		$moneyTransaction["updated_by"]=$sessionUser["id"];

		$transactionId = $this->moneyTransaction->insert($moneyTransaction);


		foreach($employeeSalaries as $key => $empSal){
			$employeeSalaries[$key]["transaction_id"]=$transactionId;
		}
		$data=$employeeSalaries;

		$this->db->insert_batch('employee_salaries', $data);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return get_app_message("response.failed");
		} else {
			$this->db->trans_complete();
			return get_app_message("response.success");
		}
	}


	public function returnSalary($employeeSalary, $sessionUser){
		$response ="";
		if(isset($employeeSalary["transaction_id"]) && !empty($employeeSalary["transaction_id"])){
			$this->load->model('Reverttransaction_Model', 'revertTransaction');
			$response =  $this->revertTransaction->revert($employeeSalary["transaction_id"], $sessionUser);

			if(get_app_message("response.success") == $response){
				$employeeSalaryUpdate =  array();
				$employeeSalaryUpdate["transaction_id"]= $employeeSalary["transaction_id"];
				$employeeSalaryUpdate["payment_status"]= get_app_message("db.status.reverted");
				$employeeSalaryUpdate["updated_by"] = $sessionUser["id"];
				$employeeSalaryUpdate["updated_at"] = getCurrentDateTime();
				$res = $this->updateByTransactionId($employeeSalaryUpdate);
			}
		}

		return $response;

	}

	

}
