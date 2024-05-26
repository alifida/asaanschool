<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Email extends Protected_Controller {
	public function __construct() {
		parent::__construct ();


		/*
		 * $this->load->model('Class_Model', 'class');
		 * $this->load->model('Studentitem_Model', 'studentitem');
		 */
	}
	public function index() {
		redirect("/email/inbox");
	}
	public function inbox($pageNo = 1) {
		$data = array ();

		$emails = $this->emailUser->getInbox ( $pageNo );
		$data ["emailsList"] = $emails;
		$data ["emailType"] = get_app_message("db.email.type.inbox");
		$data["currentPage"] = $pageNo;
		$this->template->load($this->activeTemplate,  'emails/index', $data );
	}
	public function sent($pageNo = 1) {
		$data = array ();
		$emails = $this->emailUser->getSent ( $pageNo );
		$data ["emailsList"] = $emails;
		$data ["emailType"] = get_app_message("db.email.type.sent");
		$data["currentPage"] = $pageNo;

		$this->template->load($this->activeTemplate,  'emails/index', $data );
	}
	public function draft($pageNo = 1) {
		$data = array ();
		$emails = $this->emailUser->getDraft ( $pageNo );
		$data ["emailsList"] = $emails;
		$data ["emailType"] = get_app_message("db.email.type.draft");
		$data["currentPage"] = $pageNo;

		$this->template->load($this->activeTemplate,  'emails/index', $data );
	}
	public function trash($pageNo = 1) {
		$data = array ();
		$emails = $this->emailUser->getTrash( $pageNo );
		$data ["emailsList"] = $emails;
		$data ["emailType"] = get_app_message("db.email.status.trash");
		$data["currentPage"] = $pageNo;

		$this->template->load($this->activeTemplate,  'emails/index', $data );
	}

	public function view($encodedEmailUserId="") {
		if(empty($encodedEmailUserId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}
		$emailUserId= decodeID($encodedEmailUserId);

		$emailUser = $this->emailUser->getById($emailUserId);
		// mark as read... remove Unread status
		if($emailUser["status"] == get_app_message("db.email.status.unread")){
			$emailUserUpdate= array();
			$emailUserUpdate["id"]= $emailUser["id"];
			$emailUserUpdate["status"]= "";
			$this->emailUser->merge($emailUserUpdate);

			$this->emailUser->setUnreadEmailCount();
		}


		if(empty($emailUser)){

			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}



		$data = array ();
		$data["emailUser"]=$emailUser;
		$this->template->load($this->activeTemplate,  'emails/view', $data );
	}

	public function reply($encodedEmailUserId="") {
		if(empty($encodedEmailUserId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}
		$emailUserId= decodeID($encodedEmailUserId);

		$emailUser = $this->emailUser->getById($emailUserId);

		$data = array();
		//$emailData["to_email"]=$this->input->post("to_email");
		//$emailData["from_email"]=$_SESSION["sessionUser"]["email"];
		//$emailData["from_user_id"]=$_SESSION["sessionUser"]["id"];
		$data["email_subject"]="Re: ".$emailUser["email"]["subject"];
		$data["reference_email_user_id"]=$encodedEmailUserId;

		$data["to_email"] = $emailUser["userFrom"]["email"];
		$data["emailUser"]=$emailUser;

		$this->template->load($this->activeTemplate,  'emails/compose', $data );

	}
	public function forward($encodedEmailUserId="") {
		if(empty($encodedEmailUserId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}
		$emailUserId= decodeID($encodedEmailUserId);

		$emailUser = $this->emailUser->getById($emailUserId);

		$data = array();
		//$emailData["to_email"]=$this->input->post("to_email");
		//$emailData["from_email"]=$_SESSION["sessionUser"]["email"];
		//$emailData["from_user_id"]=$_SESSION["sessionUser"]["id"];
		$data["email_subject"]="Fwd: ".$emailUser["email"]["subject"];
		$data["email_body"]=$emailUser["email"]["body"];
		$data["reference_email_user_id"]=$encodedEmailUserId;

		$data["to_email"] = "";
		$data["emailUser"]=$emailUser;

		$this->template->load($this->activeTemplate,  'emails/compose', $data );

	}
	public function compose($data = array ()) {
		$toGroups = getEmailGroups();
		$data["toGroups"] = $toGroups;
		$this->template->load($this->activeTemplate,  'emails/compose', $data );
	}


	public function composeDraft($encodedEmailUserId="") {
		if(empty($encodedEmailUserId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}
		$emailUserId= decodeID($encodedEmailUserId);

		$emailUser = $this->emailUser->getById($emailUserId);

		$data = array();
		$data["email_user_id"] = $encodedEmailUserId;
		$data["email_subject"]=$emailUser["email"]["subject"];
		$data["email_body"]=$emailUser["email"]["body"];

		if(isset($emailUser["userTo"]) && !empty($emailUser["userTo"])){
			$data["to_email"]=$emailUser["userTo"]["email"];
		}

		if(isset($emailUser["reference_email_user_id"]) && !empty($emailUser["reference_email_user_id"])){
			$data["reference_email_user_id"]=encodeID($emailUser["reference_email_user_id"]);
		}
		if(isset($emailUser["referenceEmail"])){
			$data["emailUser"] = $emailUser["referenceEmail"];
		}else{
			$data["emailUser"] = array();
		}

		$this->template->load($this->activeTemplate,  'emails/compose', $data );
	}



	public function save() {
		$emailData= array();
		$emailData["to_email"]=$this->input->post("to_email");
		$emailData["from_email"]=$_SESSION["sessionUser"]["email"];
		$emailData["from_user_id"]=$_SESSION["sessionUser"]["id"];
		$emailData["email_subject"]=$this->input->post("email_subject");
		$emailData["email_body"]=$this->input->post("email_body");

		$refEmailId = $this->input->post("ref_id");
		$email_user_id = $this->input->post("email_user_id");




		if(!empty($refEmailId)){
			$emailData["reference_email_user_id"] = $refEmailId;
		}


		if(!empty($email_user_id)){
			$emailData["email_user_id"] = $email_user_id;
		}

		$response = $this->emailUser->saveEmail($emailData);
		if($response == get_app_message("response.success")){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			redirect("/email/draft");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			return $this->compose($emailData);
		}
	}

	public function send() {
		$emailData= array();
		$emailData["to_email"]=$this->input->post("to_email");
		$emailData["to_email_group"]=$this->input->post("to_email_group");
		
		$emailData["from_email"]=$_SESSION["sessionUser"]["email"];
		$emailData["from_user_id"]=$_SESSION["sessionUser"]["id"];
		$emailData["email_subject"]=$this->input->post("email_subject");
		$emailData["email_body"]=$this->input->post("email_body");
		$refEmailId = $this->input->post("ref_id");

		$email_user_id = $this->input->post("email_user_id");
		
		if(empty($emailData["to_email"]) && empty($emailData["to_email_group"])){
			$_SESSION["appErrors"][]= get_app_message("incomplete.input.form");
			return $this->compose($emailData);
		}
		
		if( empty($emailData["from_email"])
			|| empty($emailData["from_user_id"]) 
			|| empty($emailData["email_subject"])
			|| empty($emailData["email_body"])){
			
				$_SESSION["appErrors"][]= get_app_message("incomplete.input.form");
				return $this->compose($emailData);
		}

		if(!empty($refEmailId)){
			$emailData["reference_email_user_id"] = $refEmailId;
		}



		if(!empty($email_user_id)){
			$emailData["email_user_id"] = $email_user_id;
		}
		$response = "";
		if(!empty($emailData["to_email"])){
			$response = $this->emailUser->sendEmail($emailData);
		}
		
		$message = get_app_message("request_processed_successfully");
		if(!empty($emailData["to_email_group"])){
			$res = sendMailToGroups($emailData["to_email_group"], $emailData);
			if(is_numeric($res)){
				if($res > 0){
					$response = get_app_message("response.success");
					$message = "Email has been sent successfully to ".$res." user(s) who belongs to selected group(s).";
				}else{
					$_SESSION["appErrors"][]= "There is not valid email address associated to the selected group(s).";
				}
			}
		}
		if($response == get_app_message("response.success")){
			$_SESSION["appMessages"][]= $message;
			redirect("/email");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			return $this->compose($emailData);
		}

	}
	
	
	/* private function getEmailsBelongsToGroups($groupStr){
		
		$emails=array();
		$groups =  explode(',', $groupStr);
		
		foreach ($groups as $group){
			if("all_employees" == $group){
				// get all the employees having email adress
				$this->load->model('Employee_Model', 'employee');
				$eEmails = $this->employee->getEmailAddresses();
				if(!empty($eEmails)){
					foreach ($eEmails as $e){
						$emails[] = $e["email"];
					}
					 
				}
			}elseif("all_guardians" == $group){
				// get all guardians having email address
				$this->load->model('Guardian_Model', 'guardian');
				$gEmails = $this->guardian->getEmailAddresses();
				if(!empty($gEmails)){
					foreach ($gEmails as $e){
						$emails[] = $e["email"];
					}
				}
			}elseif("all_students" == $group){
				// get all students having email address
				$this->load->model('Student_Model', 'student');
				$sEmails = $this->student->getEmailAddresses();
				if(!empty($sEmails)){
					foreach ($sEmails as $e){
						$emails[] = $e["email"];
					}
				}
			}else{
				// tokenize and get class id
				try{
					$groupToken =  explode('_', $group);
					if(is_numeric($groupToken[0])){
						$classId = $groupToken[0];
						$type = $groupToken[1];
						if("guardians"==$type){
							$this->load->model('Guardian_Model', 'guardian');
							$tEmails =$this->guardian->getEmailAddresses($classId);
						}elseif("students"==$type){
							$this->load->model('Student_Model', 'student');
							$tEmails =$this->student->getEmailAddresses($classId);
						}
						if(!empty($tEmails)){
							foreach ($tEmails as $e){
								$emails[] = $e["email"];
							}
						}
					}
				}catch (exception $e){
					pre( $e->getMessage());
				}
				
			}
		}
		$emails = array_unique($emails);
		return $emails;
	} */

	public function moveToTrash($encodedEmailUserId=""){

		if(empty($encodedEmailUserId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}

		if($encodedEmailUserId == "noId-yet"){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			redirect("/email");
		}
		$emailUserId= decodeID($encodedEmailUserId);

		$emailUser = $this->emailUser->getById($emailUserId);
		if(empty($emailUser)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}

		$emailUserUpdate = array();
		$emailUserUpdate["id"] = $emailUserId;
		$emailUserUpdate["status"] = get_app_message("db.email.status.trash");
		$response = $this->emailUser->merge($emailUserUpdate);

		if($response == get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect("/email");


	}
	public function emailsListAction(){

		$action = $this->input->post("action");
		if(empty($action)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}



		$encodedEmaiIds = $this->input->post("emailsList");
		if(empty($encodedEmaiIds)){
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			redirect("/email");
		}

		$response = "";
		$selectedIds = array();
		foreach($encodedEmaiIds as $encodedId){
			$selectedIds[]= decodeID($encodedId);
		}

		$emailUsers = $this->emailUser->getByIds($selectedIds);
		if(empty($emailUsers)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}

		if($action == "moveToTrash"){
			$response =	$this->moveMultipleToTrash($emailUsers);
		}

		if($action == "markRead"){
			$response =	$this->markMultipleAsRead($emailUsers);
		}

		if($action == "deleteForever"){
			$response =	$this->multipleDeleteForever($emailUsers);
		}

		if($action == "restore"){
			$response =	$this->multipleRestore($emailUsers);
		}
		if($response == get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect("/email");

	}

	private function moveMultipleToTrash($emailUsers=array()){
		$response = "failed";
		if(empty($emailUsers)){
			return $response;
		}
		foreach ($emailUsers as $eu){
			$emailUsersUpdate = array();
			$emailUserUpdate["id"] = $eu["id"];
			$emailUserUpdate["status"] = get_app_message("db.email.status.trash");
			$response = $this->emailUser->merge($emailUserUpdate);
		}
		return $response;

	}
	private function markMultipleAsRead($emailUsers){
		$response = "failed";
		if(empty($emailUsers)){
			return $response;
		}
		foreach ($emailUsers as $eu){
			$emailUserUpdate= array();
			$emailUserUpdate["id"]= $eu["id"];
			$emailUserUpdate["status"]= "";
			$response = $this->emailUser->merge($emailUserUpdate);
		}
		$this->emailUser->setUnreadEmailCount();
		return $response;
	}

	private function multipleDeleteForever($emailUsers){
		//pre_d($emailUsers);
		$response = "failed";
		if(empty($emailUsers)){
			return $response;
		}
		foreach ($emailUsers as $eu){
			$isAllowedToDelete = false;

			if($eu["owner_user"] == $_SESSION["sessionUser"]["id"]){
				$isAllowedToDelete = true;
			}

			if(!$isAllowedToDelete){
				$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
				redirect("/email"); return;
			}


			$this->emailUser->remove($eu["id"]);
			$response = get_app_message ( "response.success" );
		}

		return $response;
	}
	private function multipleRestore($emailUsers){
		//pre_d($emailUsers);
		$response = "failed";
		if(empty($emailUsers)){
			return $response;
		}
		foreach ($emailUsers as $eu){
			
			$emailUserUpdate = array();
			$emailUserUpdate["id"] = $eu["id"];
			$emailUserUpdate["status"] = "";
			$response = $this->emailUser->merge($emailUserUpdate);
				
				
		}

		return $response;
	}

	public function restoreFromTrash($encodedEmailUserId=""){
		if(empty($encodedEmailUserId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}
		$emailUserId= decodeID($encodedEmailUserId);

		$emailUser = $this->emailUser->getById($emailUserId);
		if(empty($emailUser)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}

		$emailUserUpdate = array();
		$emailUserUpdate["id"] = $emailUserId;
		$emailUserUpdate["status"] = "";
		$response = $this->emailUser->merge($emailUserUpdate);

		if($response == get_app_message ( "response.success" )){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect("/email");


	}
	public function deleteForever($encodedEmailUserId=""){
		if(empty($encodedEmailUserId)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}
		$emailUserId= decodeID($encodedEmailUserId);

		$emailUser = $this->emailUser->getById($emailUserId);
		if(empty($emailUser)){
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
			redirect("/email");
		}

		$isAllowedToDelete = false;

		if($emailUser["owner_user"] == $_SESSION["sessionUser"]["id"]){
			$isAllowedToDelete = true;
		}
			
		if(!$isAllowedToDelete){
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			redirect("/email"); return;
		}


		$this->emailUser->remove($emailUser["id"]);

		$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		redirect("/email");


	}

}
