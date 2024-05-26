<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Emailuser_Model extends Base_Model{
	private $table ="email_users";
	private $recordsPerPage = 10;
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	
	public function getById($id = null) {
		$emailUser = array ();
		if ($id == null) {
			return $emailUser;
		}
		$this->load->model ( 'User_Model', 'user' );
		$this->load->model ( 'Email_Model', 'email' );
		$this->load->model ( 'Emailtype_Model', 'emailType' );
		
		$this->db->select ()->from ( $this->table );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$emailUser = $query->row_array (); // single row
		
		if (! empty ( $emailUser )) {
			// get Email object
			if (isset ( $emailUser ["email_id"] ) && ! empty ( $emailUser ["email_id"] )) {
				$email = $this->email->getById ( $emailUser ["email_id"] );
				$emailUser ["email"] = $email;
			}
			
			// get Email Type
			if (isset ( $emailUser ["email_type_id"] ) && ! empty ( $emailUser ["email_type_id"] )) {
				$emailType = $this->emailType->getById ( $emailUser ["email_type_id"] );
				$emailUser ["emailType"] = $emailType;
			}
			
			// get user detail
			if (isset ( $emailUser ["user_from_id"] ) && ! empty ( $emailUser ["user_from_id"] )) {
				$user = $this->user->get ( $emailUser ["user_from_id"] );
				$emailUser ["userFrom"] = $user;
			}
			if (isset ( $emailUser ["user_to_id"] ) && ! empty ( $emailUser ["user_to_id"] )) {
				$user = $this->user->get ( $emailUser ["user_to_id"] );
				$emailUser ["userTo"] = $user;
			}
			
			if (isset ( $emailUser ["owner_user"] ) && ! empty ( $emailUser ["owner_user"] )) {
				$user = $this->user->get ( $emailUser ["owner_user"] );
				$emailUser ["ownerUser"] = $user;
			}
			
			// get reference email id to get complete conversation
			if (isset ( $emailUser ["reference_email_user_id"] ) && ! empty ( $emailUser ["reference_email_user_id"] )) {
				$referenceEmail = $this->getById ( $emailUser ["reference_email_user_id"] );
				$emailUser ["referenceEmail"] = $referenceEmail;
			}
		}
		
		return $emailUser;
	}
	
	
public function getByIds($ids = array()) {
		$emailUsers = array ();
		if (empty($ids)) {
			return $emailUsers;
		}
		//$this->load->model ( 'User_Model', 'user' );
		//$this->load->model ( 'Email_Model', 'email' );
		//$this->load->model ( 'Emailtype_Model', 'emailType' );
		
		return parent::getIn($ids);
		/* 
		$this->db->select ()->from ( $this->table );
		$this->db->where_in ( 'id', $ids );
		$query = $this->db->get ();
		$emailUsers = $query->result_array (); // single row
		
		
		
		return $emailUsers; */
	}
	
	
	
	
	
	
	
	public function save($data) {
		$newId = "";
		// $data["owner_user"] = $_SESSION["sessionUser"]["id"];
		$this->db->insert ( $this->table, $data ); // insert new record
		$newId = $this->db->insert_id ();
		
		return $newId;
	}
	
	public function getEmailsByTypeAndUser($emailType, $userId, $pageNo) {
		$emailTypeId = $emailType ["id"];
		
		$trash = get_app_message ( "db.email.status.trash" );
		
		/* if($pageNo <=0){
			$pageNo =1;
		} */
		
		$startLimit = ($this->recordsPerPage * $pageNo) - $this->recordsPerPage;
		$endLimit = $this->recordsPerPage * $pageNo;
		//pre($startLimit);
		//pre($endLimit);
		$this->db->select ()->from ( $this->table);
		if ($emailType ["type"] == get_app_message ( "db.email.type.inbox" )) {
			$this->db->where ( "(email_type_id = '$emailTypeId' AND owner_user = '$userId' AND status <> '$trash')" );
		}
		
		if ($emailType ["type"] == get_app_message ( "db.email.type.sent" )) {
			$this->db->where ( "(email_type_id = '$emailTypeId' AND owner_user = '$userId' AND status <> '$trash')" );
		}
		
		if ($emailType ["type"] == get_app_message ( "db.email.type.draft" )) {
			$this->db->where ( "(email_type_id = '$emailTypeId' AND owner_user = '$userId' AND status <> '$trash')" );
		}
		$this->db->limit( $this->recordsPerPage , $startLimit);
		
		$this->db->order_by("id", "desc");
		
		$query = $this->db->get ();
		$userEmails = $query->result_array ();
		
		
		if (! empty ( $userEmails )) {
			$this->load->model ( 'Email_Model', 'email' );
			foreach ( $userEmails as $key => $userEmail ) {
				$email = $this->email->getById ( $userEmail ["email_id"] );
				$userEmails [$key] ["email"] = $email;
			}
		}
		$totalCount = $this->countUserEmailsByType ( $emailType, $userId );
		//pre_d($totalCount);
		$totalPages = 0;
		if ($totalCount <= $this->recordsPerPage) {
			$totalPages = 1;
		} else {
			$totalPages = $totalCount / $this->recordsPerPage;
			$totalPages = ( int ) ($totalPages);
			if ($totalCount % $this->recordsPerPage != 0) {
				$totalPages ++;
			}
		}
		$userEmails ["totalPages"] = $totalPages;
		return $userEmails;
	}
	public function getEmailsByStatusAndUser($status, $userId, $pageNo) {
		$startLimit = ($this->recordsPerPage * $pageNo) - $this->recordsPerPage;
		$endLimit = $this->recordsPerPage * $pageNo;
		
		$this->db->select ()->from ( $this->table, $startLimit, $endLimit );
		$this->db->where ( "(status = '$status' AND owner_user = '$userId')" );
		$this->db->order_by("id", "desc");
		$query = $this->db->get ();
		$userEmails = $query->result_array ();
		
		if (! empty ( $userEmails )) {
			$this->load->model ( 'Email_Model', 'email' );
			foreach ( $userEmails as $key => $userEmail ) {
				$email = $this->email->getById ( $userEmail ["email_id"] );
				$userEmails [$key] ["email"] = $email;
			}
		}
		$totalCount = $this->countUserEmailsByStatus ( $status, $userId );
		
		$totalPages = 0;
		if ($totalCount <= $this->recordsPerPage) {
			$totalPages = 1;
		} else {
			$totalPages = $totalCount / $this->recordsPerPage;
			$totalPages = ( int ) ($totalPages);
			if ($totalCount % $this->recordsPerPage != 0) {
				$totalPages ++;
			}
		}
		$userEmails ["totalPages"] = $totalPages;
		return $userEmails;
	}
	public function countUserEmailsByType($emailType, $userId) {
		$emailTypeId = $emailType ["id"];
		
		$this->db->select ()->from ( $this->table );
		if ($emailType ["type"] == get_app_message ( "db.email.type.inbox" )) {
			$this->db->where ( "(email_type_id = '$emailTypeId' AND user_to_id = '$userId')" );
		}
		if ($emailType ["type"] == get_app_message ( "db.email.type.sent" )) {
			$this->db->where ( "(email_type_id = '$emailTypeId' AND user_from_id = '$userId')" );
		}
		
		if ($emailType ["type"] == get_app_message ( "db.email.type.draft" )) {
			$this->db->where ( "(email_type_id = '$emailTypeId' AND user_from_id = '$userId')" );
		}
		
		// $this->db->where("(email_type_id = '$emailTypeId' AND user_id = '$userId')");
		$count = $this->db->count_all_results ();
		return $count;
	}
	public function countUserEmailsByStatus($status, $userId) {
		$this->db->select ()->from ( $this->table );
		$this->db->where ( "(status = '$status' AND owner_user = '$userId')" );
		$count = $this->db->count_all_results ();
		return $count;
	}
	public function getInbox($pageNo = 1) {
		$userId = $_SESSION ["sessionUser"] ["id"];
		
		$this->load->model ( 'Emailtype_Model', 'emailType' );
		$emailTypeString = get_app_message ( "db.email.type.inbox" );
		$emailType = $this->emailType->getByType ( $emailTypeString );
		//pre_d($emailType);
		$inbox = $this->getEmailsByTypeAndUser ( $emailType, $userId, $pageNo );
		
		return $inbox;
	}
	public function setUnreadEmailCount() {
		unset ( $_SESSION ["unreadEmailsCount"] );
		$userId = $_SESSION ["sessionUser"] ["id"];
		$unreadEmailsCount = $this->countUserEmailsByStatus ( get_app_message ( "db.email.status.unread" ), $userId );
		if (! empty ( $unreadEmailsCount ) && $unreadEmailsCount > 0) {
			$_SESSION ["unreadEmailsCount"] = $unreadEmailsCount;
		}
	}
	public function getSent($pageNo = 1) {
		$userId = $_SESSION ["sessionUser"] ["id"];
		$this->load->model ( 'Emailtype_Model', 'emailType' );
		$emailTypeString = get_app_message ( "db.email.type.sent" );
		$emailType = $this->emailType->getByType ( $emailTypeString );
		
		$inbox = $this->getEmailsByTypeAndUser ( $emailType, $userId, $pageNo );
		
		return $inbox;
	}
	public function getDraft($pageNo = 1) {
		$userId = $_SESSION ["sessionUser"] ["id"];
		$this->load->model ( 'Emailtype_Model', 'emailType' );
		$emailTypeString = get_app_message ( "db.email.type.draft" );
		$emailType = $this->emailType->getByType ( $emailTypeString );
		
		$draft = $this->getEmailsByTypeAndUser ( $emailType, $userId, $pageNo );
		
		return $draft;
	}
	public function getTrash($pageNo = 1) {
		$userId = $_SESSION ["sessionUser"] ["id"];
		$status = get_app_message ( "db.email.status.trash" );
		
		$trash = $this->getEmailsByStatusAndUser ( $status, $userId, $pageNo );
		
		return $trash;
	}
	public function sendEmail($emailDetail) {
		$this->load->model ( 'Email_Model', 'email' );
		$this->load->model ( 'User_Model', 'user' );
		$this->load->model ( 'Emailtype_Model', 'emailType' );
		
		$email = array ();
		$emailUserFrom = array ();
		$emailUserTo = array ();
		
		
		
		if(isset($emailDetail["email_user_id"]) &&  !empty($emailDetail["email_user_id"])) {
			$draftEmailUser = $this->getById(decodeID($emailDetail["email_user_id"])) ;
			$emailUserFrom["id"] = $draftEmailUser["id"];
			$email["id"] = $draftEmailUser["email_id"];
			$emailUserTo["email_id"] = $email["id"];
			$emailUserFrom["email_id"] = $email["id"];
		}
		
		
		$email ["subject"] = $emailDetail ["email_subject"];
		$email ["body"] = $emailDetail ["email_body"];
		$emailResponse = $this->email->merge ( $email );
		
		if (is_numeric ( $emailResponse )) {
			$email ["id"] = $emailResponse;
			$emailUserFrom["email_id"] = $emailResponse;
			$emailUserTo["email_id"] = $emailResponse;
		} elseif($emailResponse != get_app_message ( "response.success" )) {
			return get_app_message ( "response.failed" );
		}
		
		$toUser = $this->user->getByEmail ( $emailDetail ["to_email"] );
		if (empty ( $toUser )) {
			// create new guest User
			$guestUser = array ();
			$guestUser ["email"] = $emailDetail ["to_email"];
			$guestUserId = $this->user->createGuestUser ( $guestUser );
			
			if (! is_numeric ( $guestUserId )) {
				$emailUserFrom ["delivery_status"] = get_app_message ( "db.email.status.notdelivered" );
				return get_app_message ( "response.failed" );
			} else {
				$emailUserFrom ["delivery_status"] = get_app_message ( "db.email.status.delivered" );
				$toUser ["id"] = $guestUserId;
			}
		}
		
		$fromUserId = $emailDetail ["from_user_id"];
		$toUserId = $toUser ["id"];
		
		$emailUserFrom ["user_from_id"] = $fromUserId;
		$emailUserFrom ["user_to_id"] = $toUserId;
		if(isset( $_SESSION ["sessionUser"] ["id"])){
		$emailUserFrom ["owner_user"] = $_SESSION ["sessionUser"] ["id"];
		}else{
			$emailUserFrom ["owner_user"] = $fromUserId;
		}
		
// 		$emailUserFrom ["email_id"] = $emailId;
		$emailTypeSent = $this->emailType->getByType ( get_app_message ( "db.email.type.sent" ) );
		$emailUserFrom ["email_type_id"] = $emailTypeSent ["id"];
		
		if (isset ( $emailDetail ["reference_email_user_id"] )) {
			$emailUserFrom ["reference_email_user_id"] = decodeID ( $emailDetail ["reference_email_user_id"] );
		}
		
		$emailUserFromResponse = $this->merge ( $emailUserFrom );
		if ( is_numeric ( $emailUserFromResponse )  ) {
			$emailUserFrom ["id"] = $emailUserFromResponse;
		} else if($emailUserFromResponse != get_app_message ( "response.success" )) {
			return get_app_message ( "response.failed" );
		}
		
		
		$emailUserTo ["user_from_id"] = $fromUserId;
		$emailUserTo ["user_to_id"] = $toUserId;
		$emailUserTo ["owner_user"] = $toUserId;
// 		$emailUserTo ["email_id"] = $emailId;
		$emailTypeInbox = $this->emailType->getByType ( get_app_message ( "db.email.type.inbox" ) );
		$emailUserTo ["email_type_id"] = $emailTypeInbox ["id"];
		$emailUserTo ["status"] = get_app_message ( "db.email.status.unread" );
		if (isset ( $emailDetail ["reference_email_user_id"] )) {
			$emailUserTo ["reference_email_user_id"] = decodeID ( $emailDetail ["reference_email_user_id"] );
		}
		
		$emailUserToId = $this->merge ( $emailUserTo );
		if (! is_numeric ( $emailUserToId )) {
			$emailUserFrom ["delivery_status"] = get_app_message ( "db.email.status.notdelivered" );
			$this->merge ( $emailUserFrom );
			return get_app_message ( "response.failed" );
		} else {
			return get_app_message ( "response.success" );
		}
	}
	public function saveEmail($emailDetail) {
		$this->load->model ( 'Email_Model', 'email' );
		$this->load->model ( 'User_Model', 'user' );
		$this->load->model ( 'Emailtype_Model', 'emailType' );
		$email = array ();
		$emailUserFrom = array ();
		//load emailUser object if id exist
		if(isset($emailDetail['email_user_id']) && !empty($emailDetail["email_user_id"])){
			$emailUserId = decodeID($emailDetail['email_user_id']);
			
			$emailUserDraft = $this->getById($emailUserId);
			if(!empty($emailUserDraft )){
				$email["id"] = $emailUserDraft["email_id"]; 	
				$emailUserFrom["id"] = $emailUserId;
			} 
			
		}
		
		
		$email ["subject"] = $emailDetail ["email_subject"];
		$email ["body"] = $emailDetail ["email_body"];
		$emailResponse = $this->email->merge ( $email );
		
		if ( is_numeric ( $emailResponse )  ) {
			
			$email ["id"] = $emailResponse;
		} else if($emailResponse ==get_app_message ( "response.success" )) {
			// do nothing.. dead area.
		}else{
			
			return get_app_message ( "response.failed" );
			
		}
		
		
		
		$toUser = $this->user->getByEmail ( $emailDetail ["to_email"] );
		
		if (!empty ( $toUser )) {
			$emailUserFrom ["user_to_id"] = $toUser ["id"];
			
		}
		
		$fromUserId = $emailDetail ["from_user_id"];
		
		
		$emailUserFrom ["user_from_id"] = $fromUserId;
		$emailUserFrom ["owner_user"] = $_SESSION ["sessionUser"] ["id"];
		
		$emailUserFrom ["email_id"] = $email ["id"];
		$emailTypeDraft = $this->emailType->getByType ( get_app_message ( "db.email.type.draft" ) );
		$emailUserFrom ["email_type_id"] = $emailTypeDraft ["id"];
		$emailUserFrom ["status"] = "";
		
		if (isset ( $emailDetail ["reference_email_user_id"] )) {
			$emailUserFrom ["reference_email_user_id"] = decodeID ( $emailDetail ["reference_email_user_id"] );
		}

	
		
		
		$emailUserFromResponse = $this->merge ( $emailUserFrom );
		if ( is_numeric ( $emailUserFromResponse ) || $emailUserFromResponse ==get_app_message ( "response.success" )) {
			return get_app_message ( "response.success" );
		} else {
			return get_app_message ( "response.failed" );
		}
		

		
	}
}
