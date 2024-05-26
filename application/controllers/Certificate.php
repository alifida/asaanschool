<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Certificate extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		
			
		if (! isAuthorizedController ( get_class ( $this ) )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "unauthorized.user" );
			redirect ( '/user/welcome' );
		}
		
		$this->load->model ( 'Certificate_Model', 'certificate' );
		$this->load->helper ( 'pdf_helper' );
		/*
		$this->load->model ( 'Student_Model', 'student' );
		$this->load->model ( 'Employee_Model', 'employee' );
		 * $this->load->model('Studentfee_Model', 'studentfee');
		 * $this->load->model('Class_Model', 'class');
		 * $this->load->model('Studentitem_Model', 'studentitem');
		 */
	}
	public function index($data = array()) {
		$certificates = $this->certificate->get ();
		$data ["certificates"] = $certificates;
		parent::loadView ( "certificate/index", $data );
		// return $this->listAll($data);
	}
	public function listAll($data = array()) {
		$certificates = $this->certificate->get ();
		$data ["certificates"] = $certificates;
		parent::loadView ( "certificate/list", $data );
	}
	public function edit($id = "") {
		$data = array ();
		$certificate = array ();
		if (! empty ( $id )) {
			$id = decodeID ( $id );
			$certificate = $this->certificate->get ( $id );
		}
		
		$studentParams = get_app_message ( "student.certificate.params" );
		$data ["studentParams"] = $studentParams;
		$employeeParams = get_app_message ( "employee.certificate.params" );
		$data ["employeeParams"] = $employeeParams ;
		$data ["certificate"] = $certificate;
		
		parent::loadView ( "certificate/form_wrapper", $data );
	}
	public function preview($id = "") {
		$certificate = array ();
		if (empty ( $id )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			$this->listAll ();
		}
		$id = decodeID ( $id );
		$certificate = $this->certificate->get ( $id );
		$data ["certificate"] = $certificate;
		parent::loadView ( "certificate/preview", $data );
	}
	public function save() {
		$certificate = array ();
		$certificate ["id"] = $this->input->post ( "certificate_id" );
		$certificate ["name"] = $this->input->post ( "certificate_name" );
		$certificate ["description"] = $this->input->post ( "certificate_description" );
		$certificate ["linked_with"] = $this->input->post ( "certificate_linked_with" );
		$certificate ["contents"] = $this->input->post ( "certificate_contents" );
		$backgroundImage = $this->input->post ( "background_image_path" );
		if (! empty ( $backgroundImage )) {
			// replace current profile pic with temp one. and delete from temp
			$absolutePath = ImageFileUpdateWithTemp ( $backgroundImage, "certificate-background" );
			$certificate ["background_image"] = $absolutePath;
		}
		/* $waterMarkPath = $this->input->post ( "watermark_path" );
		if (! empty ( $waterMarkPath )) {
			// replace current profile pic with temp one. and delete from temp
			$absolutePath = ImageFileUpdateWithTemp ( $waterMarkPath, "certificate-watermark" );
			$certificate ["watermark"] = $absolutePath;
		}
		 */
		$response = $this->certificate->merge ( $certificate );
		if (is_numeric ( $response ) || $response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		return $this->listAll ();
	}
	public function printCertificate($certificateId = "", $candidateId = "") {
		if (empty ( $certificateId ) || empty ( $candidateId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			return $this->listAll ();
		}
		
		$certificateId = decodeID ( $certificateId );
		$candidateId = decodeID ( $candidateId );
		
		$certificate = $this->certificate->get ( $certificateId );
		
		if (empty ( $certificate ) || empty ( $certificate["linked_with"] )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			return $this->listAll ();
		}
		
		$parameters = array_merge(get_app_message("student.certificate.params"),get_app_message("employee.certificate.params"));
		
		
		$certificate["contents"] = $this->certificate->initParamValues($parameters, $certificate["contents"], $candidateId);
		$data = array();
		$data["certificate"]=$certificate;
		$this->load->view( 'certificate/pdf_format', $data );
		//parent::loadView ( "certificate/pdf_format", $data );
		
	}
}
