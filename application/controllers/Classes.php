<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Classes extends Protected_Controller {

	public function __construct() {

		parent::__construct();

		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			
		
		 
		$this->load->model('Class_Model', 'class');
		$this->load->model('Classfee_Model', 'classFee');
		$this->load->model('Feetype_Model', 'feetype');
		$this->load->model('Student_Model', 'student');
		$this->load->model('Guardian_Model', 'guardian');
		$this->load->model('Studentfee_Model', 'studentFee');
		/*$this->load->model('Class_Model', 'class');
		 $this->load->model('Classtype_Model', 'classType');
		 */

	}

	public function index($data =array()) {
			
		$classes = $this->class->get();
		$data["classes"] = $classes;

		$classIds = array();
		
		if(!empty($classes)){
			foreach($classes as $class){
				$classIds[] = $class["id"];
			}
		}
		
		$classFees = $this->classFee->getByClassIds($classIds);
		$data["classFees"] = $classFees;
		//pre_d($classFees);

		$feeTypes = $this->feetype->get();
		$data["feeTypes"] = $feeTypes;

		
		$data["allFee"] = $this->studentFee->getByClassIds($classIds);;
		
		

		$this->template->load($this->activeTemplate, 'classes/index', $data);
			
	}

	public function saveClass($data = array()){
		$id = $this->input->post('class_id');
		$name = $this->input->post('class_name');


		if(!empty($id)){
			$class["id"] = $id;
		}
		$class["name"] = $name;

		$response = $this->class->merge($class);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/classes');
	}

	public function editClass($data = array()){

		$this->load->model('Feetype_Model', 'feetype');

		$id =  $this->input->get("id");
		if(!empty($id)){
			$class = $this->class->get($id);
			$data["class"] = $class;
		}

			
		$this->template->load($this->activeTemplate, 'classes/class_form', $data);
	}

	public function deleteClassForm($data = array()){
		$id =  $this->input->get("id");
		$class = $this->class->get($id);
		$data["class"] = $class;
		$this->template->load($this->activeTemplate, 'classes/class_delete_form', $data);
	}

	public function deleteClass($data = array()){
		$id =  $this->input->post("class_id");
		$class = array();
		$class["id"]=$id;
		$this->class->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/classes');
	}


	// Class Fee---------------------------------------- Starts
	public function saveClassFee($data = array()){
		$id = $this->input->post('class_fee_id');
		$classId = $this->input->post('class_fee_class_id');
		$feeTypeId = $this->input->post('class_fee_type_id');
		$amount = $this->input->post('class_fee_amount');

		$classFee = array();

		if(!empty($id)){
			$classFee["id"] = $id;
		}
		$classFee["class_id"] = $classId;
		$classFee["fee_type_id"] = $feeTypeId;
		$classFee["amount"] = $amount;
		$response = $this->classFee->merge($classFee);
		//pre_d($response);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/classes');
	}

	public function editClassFee($data = array()){

		$feeTypes = $this->feetype->get();
		$data["feeTypes"] = $feeTypes;

		$classes = $this->class->get();
		$data["classes"] = $classes;


		$id =  $this->input->get("id");
		if(!empty($id)){
			$classFee = $this->classFee->get($id);
			$data["classFee"] = $classFee;
		}

			
		$this->template->load($this->activeTemplate, 'classes/classFee/fee_form', $data);
	}

	public function deleteClassFeeForm($data = array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$classFee = $this->classFee->get($id);
			$data["classFee"] = $classFee;
		}
		$this->template->load($this->activeTemplate, 'classes/classFee/fee_delete_form', $data);
	}


	public function deleteClassFee($data = array()){
		$id =  $this->input->post("class_fee_id");
		$class = array();
		$class["id"]=$id;
		$this->classFee->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/classes');
	}


	public function dueFeeForm($data = array()){

	    $classFeeId =  $this->input->get("id");
		if(!empty($classFeeId)){
			$classFee = $this->classFee->get($classFeeId);
			$data["classFee"] = $classFee;
			$classId = $classFee["class_id"];
				
			$students = $this->student->getByClass($classId);
			$data["students"] = $students;
		}
		$this->template->load($this->activeTemplate, 'classes/classFee/due_fee_form', $data);
				
	}
	public function dueClassFee($dara= array()) {
	    
		$feeDateTemp = $this->input->post("due_fee_date");
		$classFeeId = $this->input->post("class_fee_id");
		$studentIds = $this->input->post("due_fee_multiple_students");
		$feeDate="";
		$classFee = $this->classFee->get($classFeeId );
		if(!empty($classFee)){
			$feeTypeInternalKey = $classFee["feeType"]["internal_key"];
			if($feeTypeInternalKey == "tuition.fee"){
				$feeDate = $feeDateTemp ."-01";
			}elseif($feeTypeInternalKey == "admission.fee"){
				$feeDate = $feeDateTemp ."-01-01";
			}else{
				$feeDate = $feeDateTemp;
			}
			// get students objects for submitted student ID's
			$students = $this->student->getByIds($studentIds);
			
			$this->studentFee->dueFeeToStudents($classFee["feeType"]["id"], $students, $feeDate);
			$this->generateAlertOnDues($classFee, $feeDate, $studentIds);
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
		}

		redirect('/classes');

	}
	private function generateAlertOnDues($classFee, $feeDate, $studentIds){
		if(!empty($studentIds)){
			$idsStr = implode(",", $studentIds);
			$sEmails = $this->student->getEmailAddresses(null, $idsStr);
			$gEmails = $this->guardian->getEmailAddresses(null, $idsStr);
			$addresses = array();
			if(!empty($sEmails)){
				foreach ($sEmails as $email){
					$addresses[] = $email["email"];
				}
			}
			if(!empty($gEmails)){
				foreach ($gEmails as $email){
					$addresses[] = $email["email"];
				}
			}
			 
			$addresses= array_unique($addresses);
			$campusDetails = $_SESSION["currentCampus"]["campus_name"];
			$emailData= array();
			$emailData["email_subject"]="Request for Clearance of Dues ";
			$feeType = $classFee['feeType']['type'];
			
			$emailData["email_body"]="Sir/Madam,
						<br/>
						<br/>
						Most respectfully, <br/>We request you to kindly settle the payment($feeType) for $feeDate within the due date.
						Your prompt attention will be highly appreciated.
						<br/>
						<br/>
						Thanking you!
						<br/>
						<br/>
						Sincerely,
						<br/>
						<br/>
						Accounts Department.<br/>
						$campusDetails";
			
			
			
			generateAlertOnEvent(null, $addresses, $emailData);
		}
	}
	
	

	public function deleteDueFeeForm($data = array()){

		$feeTypes = $this->feetype->get();
		$data["feeTypes"] = $feeTypes;

		$classes = $this->class->get();
		$data["classes"] = $classes;

		// get Distinct Fee Dates from fee_student

		$this->template->load($this->activeTemplate, 'classes/classFee/delete_due_fee_form', $data);
	}
	public function deleteDueFee($data = array()){

		
		$feeTypeId = $this->input->post("due_fee_type_id");
		$classId = $this->input->post("due_fee_class_id");
		$feeDate = $this->input->post("due_fee_date");
		$studentIds = $this->input->post("due_fee_multiple_students");

		$rowsEffected = $this->studentFee->deleteDueFee($feeTypeId, $classId, $feeDate, $studentIds);

		if(is_numeric($rowsEffected)){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}

		redirect('/classes');
	}

	// Class Fee-------------------------------------------------- Ends

	public function getDueFeeDates(){

		$feeTypeId = $this->input->get("fee_type_id");
		$classId = $this->input->get("class_id");
		$feeDates = $this->studentFee->getAllDueDates($feeTypeId,$classId);
		$json_response = json_encode($feeDates);
		echo $json_response;
	}

	

}

