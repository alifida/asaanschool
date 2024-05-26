<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Subject extends Protected_Controller {
	
	public function __construct() {
		
		parent::__construct();
		if (! isAuthorizedController ( get_class ( $this ) )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "unauthorized.user" );
			redirect ( '/user/welcome' );
		}
		$this->load->model('Subject_Model', 'subject');
		$this->load->model('Class_Model', 'class');
	}
	
	public function index($data =array()) {
		
		 
		$subjects = $this->subject->get(); // this is again calling model get method..
		$data["subjects"] = $subjects;
		
		$this->template->load($this->activeTemplate, 'subjects/index', $data);
		
	}
	public function cls($classId) {
		$data =array();
		$subjects = $this->subject->getByClass($classId); // this is again calling model get method..
		
		$data["subjects"] = $subjects;
		
		$this->template->load($this->activeTemplate, 'subjects/index', $data);
		
	}
	
	public function save(){
	    
	    $data = array();
	    
	     
		$id = $this->input->post('id');
		
		$subject = array();
		if(!empty($id)){
			$subject["id"] = $id;
		}
		
		$subject["name"] = $this->input->post('subject_name');
		$subject["description"] = $this->input->post('subject_description');
		$subject["class_id"] = $this->input->post('class_id');
		
		
		$response = $this->subject->merge($subject);
		 
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/subject');
	}
	
	
	public function edit($id =""){
	    $data = array();
		 
		
		$classes = $this->class->get();
		
		$data["classes"] =$classes;
		
		if(!empty($id)){
		    $subject = $this->subject->get($id);  // ths is the call to model.
		    $data["subject"] = $subject;
		}
		
		$this->template->load($this->activeTemplate, 'subjects/form', $data);
	}
	
	
	
	public function detail($id=""){
		$data= array();
		
		if(empty($id)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/subject');
		}
		
		$subject = $this->subject->get($id);
		
		if(empty($subject)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/subject');
		}
		
		$data["subject"] = $subject;
		$this->template->load($this->activeTemplate, 'subjects/detail', $data);
		
		
	}
	
	
	public function deleteConfirmation($id){
		
	    $data= array();
		$subject = $this->subject->get($id);
		$data["subject"] = $subject;
		$this->template->load($this->activeTemplate, 'subjects/delete', $data);
	}
	
	
	public function delete(){
	    $data = array();
		$id =  $this->input->post("id");
		 
		$response = $this->subject->remove($id);
		if($response ==get_app_message ( "response.success" )){
		    $_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
		    $_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		// set this message on the result of remove method.
		redirect('/subject');
	}
	
	 
}

