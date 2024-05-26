<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

include_once('Protected_Controller.php');
class Guardian extends Protected_Controller {

	public function __construct() {

		parent::__construct();
		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
		 
		$this->load->model('Guardian_Model', 'guardian');
		$this->load->model('Student_Model', 'student');
		$this->load->model('Studentguardian_Model', 'studentGuardian');
		$this->load->model('Relationtype_Model', 'relationtype');
		
	}

	public function index($data =array()) {
			

			
	}


	public function view($data = array()) {
		$guardian = array();
		$id =  $this->input->get("id");
		 
		if(!empty($id)){
			$studentGuardian = $this->studentGuardian->getStudentsByGuardianId($id);
			$data["guardianDetail"] = $studentGuardian;
			$this->template->load($this->activeTemplate, 'guardians/view', $data);
		}else{
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/student');
		}
	}







	public function edit($data = array()){
		// Relation Type Dropdown list
		$relationTypes = $this->relationtype->get();
		$data["relationTypes"] = $relationTypes;
		// in case of edit of existing guardian relation with student or create new guardian for student.
		$studentId = $this->input->post('student_id');
		// check in get if not in post
		if(empty($studentId)){
			$studentId = $this->input->get('student_id');
		}

		$data["student_id"]=$studentId;
		$id =  $this->input->get("id");
		if(!empty($id)){
			$guardian = $this->guardian->get($id);

			if(!empty($studentId)){
				$studentGuardian = $this->studentGuardian->getByStudentIdAndGuaridanId($studentId, $id);
				if(!empty($studentGuardian)){
					$guardian["studentGuardian"]=$studentGuardian;

				}


			}
			$data["guardian"] = $guardian;
		}
		$this->template->load($this->activeTemplate, 'guardians/add_update_form', $data);
	}


	public function save($data= array()){
		$guardian=array();
		$id = $this->input->post('id');
		if(!empty($id)){
			$guardian["id"] = $id;
		}
		$studentId = $this->input->post('student_id');

		// check in get if not in post
		if(empty($studentId)){
			$studentId = $this->input->get('student_id');
		}
		$guardian["name"]= $this->input->post('guardian_name');
		$guardian["gender"]= $this->input->post('guardian_gender');
		$guardian["cnic"]= $this->input->post('guardian_cnic');
		$guardian["occupation"]= $this->input->post('guardian_occupation');
		$guardian["mobile"]= $this->input->post('guardian_mobile');
		$guardian["home_phone"]= $this->input->post('guardian_home_phone');
		$guardian["work_phone"]= $this->input->post('guardian_work_phone');
		$guardian["email"]= $this->input->post('guardian_email');

		$guardian["address"]= $this->input->post('guardian_address');
		$response = $this->guardian->merge($guardian);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			if(is_numeric($response) && !empty($studentId)){
				$guardianId= $response;
				// update the student_guardian Relation
				$relationTypeId = $this->input->post('guardian_relation');
				$studentGuardian = $this->studentGuardian->getByStudentIdAndGuaridanId($studentId, $guardianId);
				if(empty($studentGuardian )){
					$studentGuardian = array();
					$studentGuardian["relation_type_id"] = $relationTypeId;
					$studentGuardian["student_id"] = $studentId;
					$studentGuardian["guardian_id"] = $guardianId;
				}else{
					$studentGuardian["relation_type_id"] = $relationTypeId;
				}
				$this->studentGuardian->merge($studentGuardian);
			}
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		if(empty($studentId)){
			redirect('/student');
		}else{
			redirect('/student/view/'. encodeID($studentId));
		}

	}


	public function unrollForm($data = array()){
		// get All Classes For DropDown

		$id =  $this->input->get("id");
		if(!empty($id)){
			$student = $this->student->get($id);
			$data["student"]=$student;

		}
		$this->template->load($this->activeTemplate, 'students/student_unroll_form', $data);
	}
	public function unroll($data = array()){
		// get All Classes For DropDown

		$id =  $this->input->post("student_id");

		if(!empty($id)){
			$student = $this->student->get($id);
			unset($student["class"]);
			$student["status"]="In Active";
			$student["unroll_date"] = getCurrentDate();
			$response = $this->student->merge($student);
			if($response ==get_app_message ( "response.success" )){
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			}else{
				$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			}
		}else{
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
		}

		redirect('/student');
	}

	public function linkGuardianForm($data= array()){
		$studentId =  $this->input->get("student_id");
		if(empty($studentId)){
			$studentId = $this->input->post("student_id");
		}
		if(empty($studentId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect('/student');
		}

		$student = $this->student->get($studentId);
		$guardians = $this->guardian->getByCurrentCampus();
		//pre_d($guardians );
		$relationTypes = $this->relationtype->get();
		$data["relationTypes"]=$relationTypes;
		$data["student"]=$student;
		$data["guardians"]=$guardians;
		$this->template->load($this->activeTemplate, 'guardians/student_guardian_form', $data);


	}

	public function savelinkGuardian($data= array()){

		$studentId = $this->input->post("student_id");
		$guardianId = $this->input->post("guardian_id");
		$relation =  $this->input->post("relation");
		$studentGuardian = array();
		$studentGuardian["student_id"]=$studentId;
		$studentGuardian["guardian_id"]=$guardianId;
		$studentGuardian["relation_type_id"]=$relation;

		$response =$this->studentGuardian->merge($studentGuardian);
		if("duplicateEntry"==$response){
			$_SESSION["appErrors"][]= get_app_message("db.duplicate.entry");

		}else{
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}
		redirect('/student/view/'. encodeID($studentId));
	}

	public function unLinkGuardianForm($data= array()){
		$studentId = $this->input->get("student_id");
		$guardianId = $this->input->get("guardian_id");

		$studentGuardian = array();
		$studentGuardian["student_id"]=$studentId;
		$studentGuardian["guardian_id"]=$guardianId;
		$studentGuardian = $this->studentGuardian->getByStudentIdAndGuaridanId($studentId, $guardianId);
		$data["studentGuardian"] = $studentGuardian;

		$guardian = $this->guardian->get($studentGuardian["id"]);
		$student = $this->student->get($studentGuardian["student_id"]);

		$relationTypeId = $studentGuardian["relation_type_id"];
		$relation = $this->relationtype->get($relationTypeId);
		$data["guardian"]=$guardian;
		$data["student"]=$student;
		$data["relation"]=$relation["relation"];
		$this->template->load($this->activeTemplate, 'guardians/unlink_form', $data);
	}


	public function unLinkGuardian($data= array()){

		$studentId = $this->input->post("student_id");
		$guardianId = $this->input->post("guardian_id");

		$studentGuardian = array();
		$studentGuardian["student_id"]=$studentId;
		$studentGuardian["guardian_id"]=$guardianId;
		$studentGuardian = $this->studentGuardian->getByStudentIdAndGuaridanId($studentId, $guardianId);
		if(!empty($studentGuardian)){
			$response =$this->studentGuardian->remove($studentGuardian["student_guardian_id"]);
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("db.record.not.exist");
		}

		redirect('/student/view/'. encodeID($studentId));
	}

	public function deleteGuardianForm($data= array()){
		$id =  $this->input->get("id");
		if(!empty($id)){
			$guardian = $this->guardian->get($id);
			$data["guardian"] = $guardian;
		}
		$this->template->load($this->activeTemplate, 'guardians/delete_form', $data);
	}
	public function deleteGuardian($data = array()){
		$id =  $this->input->post("guardian_id");
		$this->guardian->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/student');
	}

	
	
	
	public function getAutoComplete() {
		$params["q"] = $this->input->get("q");
		$params["callback"] = $this->input->get("callback");
		$result =  $this->guardian->getAutocomplete($params);
	
		echo $result;
	}
	

}
