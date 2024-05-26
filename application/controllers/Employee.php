<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Employee extends Protected_Controller {

	public function __construct() {

		parent::__construct();


		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			
		$this->load->model('Employee_Model', 'employee');
		$this->load->model('User_Model', 'user');
		$this->load->model('Employeetype_Model', 'employeeType');
		$this->load->model('Employeesalary_Model', 'employeeSalary');
		$this->load->model('Usercampus_Model', 'userCampus');
		/*
		 $this->load->model('Configuration_Model', 'conf');
		 $this->load->model('Transactiontype_Model', 'transactionType');
		 $this->load->model('Usertype_Model', 'userType');
		 */

	}

	public function index($data =array()) {
			
		$activeEmployees = $this->employee->getByStatus(get_app_message("db.status.active"));
		
		$data["activeEmployees"] = $activeEmployees;

		$allEmployees = $this->employee->get();
		$data["allEmployees"] = $allEmployees;

		$employeeTypes = $this->employeeType->get();
		$data["employeeTypes"] = $employeeTypes;

		
		$this->load->model('Certificate_Model', 'certificate');
		$certificates = $this->certificate->getByType("2");
		$data["certificates"] = $certificates;
		$this->template->load($this->activeTemplate, 'employees/index', $data);
			
	}

	public function saveEmployee($data = array()){

		$id = $this->input->post('employee_id');
		$firstName = $this->input->post('first_name');
		$lastName= $this->input->post('last_name');
		$cnic = $this->input->post('cnic');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$salary = $this->input->post('salary');
		$qualification = $this->input->post('qualification');
		$dateOfJoining = $this->input->post('date_of_joining');
		$dateOfResigning = $this->input->post('date_of_resigning');
		$employeeTypeId = $this->input->post('employee_type_id');
		$employee = array();
		if(!empty($id)){
			$employee["id"] = $id;
		}
		$employee["first_name"] = $firstName;
		$employee["last_name"] = $lastName;
		$employee["cnic"] = $cnic;
		$employee["email"] = $email;
		$employee["address"] = $address;
		$employee["salary"] = $salary;
		$employee["qualification"] = $qualification;
		$employee["date_of_joining"] = $dateOfJoining;
		if(!empty($dateOfResigning)){
			$employee["date_of_resigning"] = $dateOfResigning;
		}
		$employee["employee_type_id"] = $employeeTypeId;
		$employee["status"]=get_app_message("db.status.active");



		$response = $this->employee->merge($employee);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){


			// double call for update b/c of id does not exist in case of new Employee.
			$picPath = $this->input->post ( "employee_image_path" );

			if (! empty ( $picPath )) {
				$filePostFix = get_random_string()."emp-pic";
				if($response == get_app_message ( "response.success" )){
					$filePostFix= encodeID($employee["id"])."emp-pic";
				}else{
					$employee["id"] = $response;
					$filePostFix= encodeID($employee["id"])."emp-pic";
				}
					
				// replace current profile pic with temp one. and delete from temp
				$absolutePath = ImageFileUpdateWithTemp ( $picPath , $filePostFix );
				$employee ["employee_picture"] = $absolutePath;
					
				// 2nd call to DB
				$response = $this->employee->merge($employee);
				if($response !=get_app_message ( "response.success" )){
					$_SESSION["appErrors"][]= get_app_message("Cannot save the Employee Picture. Please try again. later.");
				}
			}

			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/employee');
	}

	public function editEmployee($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$employee = $this->employee->get($id);
			$data["employee"] = $employee;
		}

		$employeeTypes = $this->employeeType->get();
		$data["employeeTypes"] = $employeeTypes;

		$this->template->load($this->activeTemplate, 'employees/employee_form', $data);
	}

	public function unrollEmployeeForm($data = array()){
		$id =  $this->input->get("id");
		$employee = $this->employee->get($id);
		$data["employee"] = $employee;
		$this->template->load($this->activeTemplate, 'employees/employee_unroll', $data);
	}

	public function unrollEmployee($data = array()){
		$id =  $this->input->post("employee_id");
		if(empty($id)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/employee');
		}
		$employeeOrignal = $this->employee->get($id);

		$employee=array();
		$employee["id"]=$id;
		$employee["status"]=get_app_message("db.status.inactive");
		$response = $this->employee->merge($employee);





		if($response == get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			$user = $this->user->getByEmail($employeeOrignal["email"]);
			if(!empty($user)){
				$response = $this->userCampus->removeCampusUser($_SESSION["currentCampus"]["id"], $user["id"]);
				if(response == get_app_message("response.success")){
					$_SESSION["appErrors"][]="Unable to delete User Account, Please delete it manually from users list.";
				}
			}
		}else{
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
		}

		redirect('/employee');
	}

	public function changeStatusForm($data = array()){
		$id =  $this->input->get("id");
		$employee = $this->employee->get($id);
		$data["employee"] = $employee;
		$this->template->load($this->activeTemplate, 'employees/change_status_form', $data);
	}

	public function updateStatusEmployee($data = array()){
		$id =  $this->input->post("employee_id");
		$status = $this->input->post("employee_status");
		$employee = array();

		$employeeOrignal = $this->employee->get($id);

		$employee["id"]=$id;
		$employee["status"]=$status;
		$response = $this->employee->merge($employee);
		if($response == get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			// if inavtive status also delte user rights from current campus
			if($status == get_app_message("db.status.inactive")){
				$user = $this->user->getByEmail($employeeOrignal["email"]);
				if(!empty($user)){
					$response = $this->userCampus->removeCampusUser($_SESSION["currentCampus"]["id"], $user["id"]);
					if(response == get_app_message("response.success")){
						$_SESSION["appErrors"][]="Unable to delete User Account, Please delete it manually from users list.";
					}
				}
			}
		}else{
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
		}
		redirect('/employee');
	}


	public function details($data= array()){
		$id =  $this->input->get("id");

		if(empty($id)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/employee');
		}

		$employee = $this->employee->get($id);

		if(empty($employee)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/employee');
		}

		$data["employee"] = $employee;


		$employeeSalaries = $this->employeeSalary->getByEmployeeId($id);
		$data["employeeSalaries"] = $employeeSalaries;

		$allEmployees = $this->employee->get();
		$data["allEmployees"] = $allEmployees;

		$this->load->model('Certificate_Model', 'certificate');
		$certificates = $this->certificate->getByType("2");
		$data["certificates"] = $certificates;

		$this->template->load($this->activeTemplate, 'employees/detail_view', $data);


	}

	public function issueSalaryForm($data = array()){

		$employeeId = $this->input->get("id");
		if(!empty($employeeId)){
			$data["selectedEmployeeId"] = $employeeId;
		}

		$activeEmployees = $this->employee->getByStatus(get_app_message("db.status.active"));
		$data["employees"] = $activeEmployees;

		$this->template->load($this->activeTemplate, 'employees/issue_salary', $data);
	}


	public function issueSalary($data = array()){

		$employeeIds = $this->input->post("salary_multiple_employees");
		$salaryMonth = $this->input->post("salary_date");
		$comments = $this->input->post("salary_comments");
		if(empty($employeeIds) || empty($salaryMonth)){

			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			redirect('/employee');
		}

		$employees = $this->employee->getByIds($employeeIds);

		if(empty($employees)){
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			redirect('/employee');
		}

		$response = $this->employeeSalary->issueSalaryForMonth($employees, $salaryMonth, $comments, $_SESSION["sessionUser"]);

		if($response == get_app_message("response.success")){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/employee');
	}


	public function employeeSalaryDetails($data = array()){
		$employeeSalaryId = $this->input->get("id");
		if(empty($employeeSalaryId)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/employee');
		}
		$employeeSalary = $this->employeeSalary->get($employeeSalaryId);
		if(empty($employeeSalary)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/employee');
		}

		$data["employeeSalary"]=$employeeSalary;
		$this->template->load($this->activeTemplate, 'employees/employee_salary_detail', $data);

	}
	public function employeeSalaryReturnForm($data = array()){

		$employeeSalaryId = $this->input->get("id");
		if(empty($employeeSalaryId)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/employee');
		}

		$employeeSalary = $this->employeeSalary->get($employeeSalaryId);
		if(empty($employeeSalary)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/employee');
		}


		$data["employeeSalary"]=$employeeSalary;
		$this->template->load($this->activeTemplate, 'employees/employee_salary_return', $data);

	}


	public function getAutoComplete() {
		$params["q"] = $this->input->get("q");
		$params["callback"] = $this->input->get("callback");
		$result =  $this->employee->getAutocomplete($params);

		echo $result;
	}


	/*
	 public function employeeSalaryReturn($data = array()){
		$employeeSalaryId = $this->input->post("employee_salary_id");
		if(empty($employeeSalaryId)){
		$_SESSION["appErrors"][] = get_app_message("invalid_url");
		redirect('/employee');
		}

		$employeeSalary = $this->employeeSalary->get($employeeSalaryId);
		if(empty($employeeSalary)){
		$_SESSION["appErrors"][] = get_app_message("invalid_url");
		redirect('/employee');
		}
		$employeeId = $employeeSalary["employee_id"];

		//$employeeSalary["payment_status"] = get_app_message("db.status.reverted");
		$employeeSalary["updated_by"] = $_SESSION["sessionUser"]["id"];
		$employeeSalary["updated_at"] = getCurrentDateTime();

		unset($employeeSalary["employee"]);

		$response = $this->employeeSalary->returnSalary($employeeSalary, $_SESSION["sessionUser"]);

		if($response == get_app_message("response.success")){
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
		$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/employee/details?id='.$employeeId);
		}
		*/
}

