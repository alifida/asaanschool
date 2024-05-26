<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Notification extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'Notification_Model', 'notification' );
	}
	public function index() {
		$data = array ();
		
		$notifications = $this->notification->getNoticeBoard ();
		$data ["notifications"] = $notifications;
		$this->template->load ( $this->activeTemplate, 'notification/notice_board', $data );
	}
	public function all() {
		if ($this->check_authorization () === false) {
			redirect ( '/user/welcome' );
		}
		$data = array ();
		$notifications = $this->notification->get ();
		$data ["notifications"] = $notifications;
		$this->template->load ( $this->activeTemplate, 'notification/index', $data );
	}
	public function save() {
		$data = array ();
		if ($this->check_authorization () === false) {
			redirect ( '/user/welcome' );
		}
		$id = $this->input->post ( 'notification_id' );
		
		$notification = array ();
		if (! empty ( $id )) {
			$notification ["id"] = $id;
		}
		
		$notification ["subject"] = $this->input->post ( 'notification_subject' );
		$notification ["body"] = $this->input->post ( 'notification_body' );
		$notification ["start_date"] = $this->input->post ( 'start_date' );
		$notification ["end_date"] = $this->input->post ( 'end_date' );
		$notification ["status"] = $this->input->post ( 'status' );
		
		$send_email_alert = $this->input->post ( 'send_email_alert' );
		
		$response = $this->notification->merge ( $notification );
		if (is_numeric ( $response ) || $response == get_app_message ( "response.success" )) {
			if ("yes" == $send_email_alert) {
				$this->sendEmailAlert ( $notification );
			 
			}
			 
			
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( '/notification/all' );
	}
	private function sendEmailAlert($notification) {
		if (! empty ( $notification ) && get_app_message("post.status.published")==$notification["status"]) {
			$emailData = array ();
			$emailData ["from_email"] = $_SESSION ["sessionUser"] ["email"];
			$emailData ["from_user_id"] = $_SESSION ["sessionUser"] ["id"];
			$emailData ["email_subject"] = "New Notification ";
			$emailData ["email_body"] = "<strong>". $notification ["subject"]."</strong><br/>";
			$emailData ["email_body"] .= "<p>". $notification ["body"]."</p>";
			
			$groups = "all_employees,all_guardians,all_students";
			
			sendMailToGroups ( $groups, $emailData );
		}
	}
	public function edit() {
		$data = array ();
		if ($this->check_authorization () === false) {
			redirect ( '/user/welcome' );
		}
		$id = $this->input->get ( "id" );
		
		if (! empty ( $id )) {
			$notification = $this->notification->get ( $id );
			$data ["notification"] = $notification;
		}
		
		$this->template->load ( $this->activeTemplate, 'notification/form', $data );
	}
	public function detail($id = "") {
		$data = array ();
		
		if (empty ( $id )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( '/notification' );
		}
		
		$notification = $this->notification->get ( $id );
		
		if (empty ( $notification )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( '/notification' );
		}
		
		$data ["notification"] = $notification;
		$this->template->load ( $this->activeTemplate, 'notification/detail', $data );
	}
	public function deleteConfirmation() {
		$data = array ();
		if ($this->check_authorization () === false) {
			redirect ( '/user/welcome' );
		}
		$id = $this->input->get ( "id" );
		$notification = $this->notification->get ( $id );
		$data ["notification"] = $notification;
		$this->template->load ( $this->activeTemplate, 'notification/delete', $data );
	}
	public function delete() {
		$data = array ();
		if ($this->check_authorization () === false) {
			redirect ( '/user/welcome' );
		}
		$id = $this->input->post ( "notification_id" );
		$this->notification->remove ( $id );
		$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		redirect ( '/notification/all' );
	}
	private function check_authorization() {
		if (! isAuthorizedController ( get_class ( $this ) )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "unauthorized.user" );
			return false;
		}
		return true;
	}
}

