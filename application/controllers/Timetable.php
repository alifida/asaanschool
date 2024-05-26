<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Timetable extends Protected_Controller {
	
	public function __construct() {
		
		parent::__construct();

		if (! isAuthorizedController ( get_class ( $this ) )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "unauthorized.user" );
			redirect ( '/user/welcome' );
		}
		
		$this->load->model('timetable_Model', 'timetable');
		$this->load->model('Subject_Model', 'subject');
		$this->load->model('Class_Model', 'class');
		//$this->load->model('Campus_Model', 'campus');
		
		
	}
	
	public function index($data =array()) {
		
		$classes = $this->class->getClassTimetable();
		$data["classes"] = $classes;
		parent::loadView("timetables/index", $data);
		
	}
	public function cls($classId) {
		$data = array();
		$classes = $this->class->getClassTimetable($classId);
		$data["classes"] = $classes;
		 
		parent::loadView("timetables/index", $data);
		
	}
	
	public function save($data = array()){
		
	    //no need to check the authorization
		$id = $this->input->post('id');
		
		$timetable = array();
		if(!empty($id)){
			$timetable["id"] = $id;
		}
		
		$timetable["subject_id"] = $this->input->post('subject_id');
		$timetable["start_time"] = $this->input->post('timetable_start_time');
		$timetable["end_time"] = $this->input->post('timetable_end_time');
		$timetable["week_day"] = $this->input->post('timetable_week_day');
		$timetable["status"] = $this->input->post('timetable_status');
		//$timetable["campus_id"] = $this->input->post('campus_id');
		
		$response = $this->timetable->merge($timetable);
		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/timetable');
	}
	public function edit($id =""){
	    $data = array();
	    $subjects = $this->subject->get();
	    $data["subjects"] =$subjects;
	    
	    if(!empty($id)){
	        $timetable = $this->timetable->get($id);  // ths is the call to model.
	        $data["timetable"] = $timetable;
	    }
	    
	    $this->template->load($this->activeTemplate, 'timetables/form', $data);
	}
	

	
	
	
	public function detail($id=""){
		$data= array();
		
		if(empty($id)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/timetable');
		}
		
		$timetable = $this->timetable->get($id);
		
		if(empty($timetable)){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect('/timetable');
		}
		
		$data["timetable"] = $timetable;
		$this->template->load($this->activeTemplate, 'timetables/detail', $data);
			
	}

	public function deleteConfirmation($data = array()){
		
		$id =  $this->input->get("id");
		$timetable = $this->timetable->get($id);
		$data["timetable"] = $timetable;
		$this->template->load($this->activeTemplate, 'timetables/delete', $data);
	}
	
	
	public function delete($data = array()){
		
		$id =  $this->input->post("id");
		$this->timetable->remove($id);
		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect('/timetable');
	}
	

}

