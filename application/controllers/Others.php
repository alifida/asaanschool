<?php
include_once('Protected_Controller.php');
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Others extends Protected_Controller {

	public function __construct() {

		parent::__construct();



		$this->load->model('Campus_Model', 'campus');

	}

	


	public function selectModules() {
		$data= array();
		$appModules = $this->appModule->getByStatus(get_app_message("db.status.active"));
		$campusModules = $this->campusModule->getByCampus($_SESSION["currentCampus"]["id"]);
		$data["campusModules"] = $campusModules;
		$data["appModules"] = $appModules;

		$this->template->load($this->activeTemplate, "campuses/moduleSelection" , $data);
	}

	public function moduleSelectionConfirmation() {
		$data= array();
		$moduleIds = $this->input->post("modules");

		$appModules = $this->appModule->getByIds($moduleIds);

		$data["appModules"] = $appModules;

		$this->template->load($this->activeTemplate, "campuses/moduleSelectionConfirmation" , $data);
	}

	public function saveModulesSelection() {
		$data= array();
		$moduleIds = $this->input->post("modules");

		$response = $this->campusModule->saveCampusModules($moduleIds, $_SESSION["currentCampus"]["id"]);

		if($response == get_app_message("response.success")){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
		}
		redirect("/campus/selectModules");
	}


	public function view($data = array()) {
		redirect("/user/login");
	}







	public function edit($campusId){

		$data = array();
		$schoolId = $_SESSION["currentCampus"]["school_id"];
		$campus = $this->campus->get($campusId, $schoolId);

		if(empty($campus)){
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
			// redirect to login without distroying the current session.
			redirect("/user/login");
		}

		$data["campus"]=$campus;
		$this->template->load($this->activeTemplate, 'campuses/edit', $data);

	}


	public function update(){
		$campusId= $_SESSION["currentCampus"]["id"];
		$campus= array();
		//pre_d($_POST);


		$campus["id"] = $_SESSION["currentCampus"]["id"];
		$campus["campus_name"] = $this->input->post("campus_name");
		$logoPath = $this->input->post ( "campus_logo_path" );
		if (! empty ( $logoPath )) {
			// replace current profile pic with temp one. and delete from temp
			$absolutePath = ImageFileUpdateWithTemp ( $logoPath, "campus-logo" );
			$campus ["campus_logo"] = $absolutePath;
		}

		// update campus
		$response = $this->campus->merge($campus);

		if(get_app_message ( "response.success" ) != $response){
			$_SESSION["appErrors"][]=get_app_message("cannot_process_request");
			// redirect to login without distroying the current session.
			redirect("/user/login");
		}

		//contact details of campus
		$contactDetails= array();
		$contactDetails["id"]=$_SESSION["currentCampus"]["contact_detail_id"];
		$contactDetails["primary_email"]=$this->input->post("primary_email");
		$contactDetails["secondary_email"]=$this->input->post("secondary_email");
		$contactDetails["website"]=$this->input->post("website");
		$contactDetails["primary_phone"]=$this->input->post("primary_phone");
		$contactDetails["secondary_phone"]=$this->input->post("secondary_phone");
		$contactDetails["fax"]=$this->input->post("fax");
		$contactDetails["city"]=$this->input->post("city");
		$contactDetails["state"]=$this->input->post("state");
		$contactDetails["post_code"]=$this->input->post("post_code");
		$contactDetails["address"]=$this->input->post("address");

		// update Contact Details of campus
		$response = $this->contactDetail->merge($contactDetails);
		if(get_app_message ( "response.success" ) != $response){
			$_SESSION["appErrors"][] = get_app_message("cannot_process_request");
			// redirect to login without distroying the current session.
			redirect("/user/login");
		}


		// also update school details if there is only one campus
		if(sizeof($_SESSION["campuses"]==1)){

			$school = array();
			$school["id"]= $_SESSION["currentCampus"]["school_id"];
			$school["registration_no"] = $this->input->post("registration_no");
			$school["school_name"] = $this->input->post("campus_name");
			$school["details"] = $this->input->post("school_details");
			$school["contact_detail_id"] = $_SESSION["currentCampus"]["contact_detail_id"];
			if(!empty($school["id"])){
				$response = $this->school->merge($school);

			}else{
				$response = get_app_message ( "response.failed" );
			}

			if(get_app_message ( "response.success" ) == $response){
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
				// redirect to login without distroying the current session.
			}else{
				$_SESSION["appErrors"][] = get_app_message("cannot_process_request");
			}

			// redirect to Dashboard.. login will decide.
			redirect("/user/login");

		}


	}

	public function signup(){
		$data = array();



		$this->template->load($this->activeTemplate, 'schools/sign_up', $data);

	}
	public function register(){
		$data = array();
		//pre_d($_POST);
		$data["school_name"] = $this->input->post("school_name");
		$data["registration_no"] = $this->input->post("registration_no");
		$data["email"] = $this->input->post("email");
		$data["password"] = $this->input->post("regPassword");
		$this->load->view('autoLogin');
		$response = $this->school->registerSchool($data);
		if($response == get_app_message("response.success")){
			// auto login
			$tempCredentials = array();
			$_SESSION["appMessages"][]="Congratulations! Your Account Has been created successfully.
								<br/>Please wait a while we are redirecting to the dashboard.";
			$_SESSION["tmp_login_email"] = $data["email"];
			$_SESSION["tmp_login_password"] = $data["password"];
			redirect('school/autoLoginPage');
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			redirect("school/signup");
		}




	}

	public function autoLoginPage(){
		$this->load->view('autoLogin');
	}

}
