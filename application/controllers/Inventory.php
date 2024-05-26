<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Inventory extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		
		if (! isAuthorizedController ( get_class ( $this ) )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "unauthorized.user" );
			redirect ( '/user/welcome' );
		}
		
		$this->load->model ( 'Item_Model', 'item' );
		$this->load->model ( 'Itemtype_Model', 'itemtype' );
		$this->load->model ( 'Student_Model', 'student' );
		$this->load->model ( 'Studentitem_Model', 'studentItem' );
		/*
		 * $this->load->model('Studentitem_Model', 'studentitem');
		 */
	}
	public function index($data = array()) {
		
		// get Available items
		$items = $this->item->getAvailable ();
		$data ["items"] = $items;
		
		$oldItems = $this->item->getOldItems ();
		$data ["oldItems"] = $oldItems;
		
		$itemTypes = $this->itemtype->get ();
		$data ["itemTypes"] = $itemTypes;
		
		$this->template->load ( $this->activeTemplate, 'items/index', $data );
	}
	public function saveItem($data = array()) {
		$id = $this->input->post ( 'item_id' );
		
		$item = array ();
		if (! empty ( $id )) {
			$item ["id"] = $id;
		}
		$item ["item_type_id"] = $this->input->post ( 'item_type_id' );
		$item ["description"] = $this->input->post ( 'item_description' );
		$item ["amount"] = $this->input->post ( 'item_amount' );
		$item ["available_amount"] = $this->input->post ( 'item_available_amount' );
		$item ["price"] = $this->input->post ( 'item_price' );
		$item ["purchase_price"] = $this->input->post ( 'item_purchase_price' );
		
		$response = $this->item->merge ( $item );
		if (is_numeric ( $response ) || $response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( '/inventory' );
	}
	public function editItem($data = array()) {
		$id = $this->input->get ( "id" );
		
		$itemTypes = $this->itemtype->get ();
		$data ["itemTypes"] = $itemTypes;
		
		if (! empty ( $id )) {
			$item = $this->item->get ( $id );
			$data ["item"] = $item;
		}
		$this->template->load ( $this->activeTemplate, 'items/item_form', $data );
	}
	public function itemDetail($itemId = "") {
		if (empty ( $itemId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/inventory" );
		}
		$itemId = decodeID ( $itemId );
		$item = $this->item->getItemDetails ( $itemId );
		
		if (empty ( $item )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/inventory" );
		}
		
		$stock = $item ["available_amount"];
		$paidItems = 0;
		$dueItems = 0;
		if (isset ( $item ["studentItems"] ) && ! empty ( $item ["studentItems"] )) {
			foreach ( $item ["studentItems"] as $key => $studentItem ) {
				if ($studentItem ['payment_status'] == get_app_message ( "db.status.paid" )) {
					$paidItems = $paidItems + $studentItem ["issued_amount"];
				} elseif ($studentItem ['payment_status'] == get_app_message ( "db.status.due" )) {
					$dueItems = $dueItems + $studentItem ["issued_amount"];
				}
			}
		}
		
		$data ["stock"] = $stock;
		$data ["paidItems"] = $paidItems;
		$data ["dueItems"] = $dueItems;
		
		$data ["item"] = $item;
		
		$items = $this->item->getAvailable ();
		$data ["items"] = $items;
		
		$this->template->load ( $this->activeTemplate, 'items/item_detail', $data );
	}
	public function deleteConfirmationItem($data = array()) {
		$id = $this->input->get ( "id" );
		$item = $this->item->get ( $id );
		$data ["item"] = $item;
		$this->template->load ( $this->activeTemplate, 'items/item_delete', $data );
	}
	public function deleteItem($data = array()) {
		$id = $this->input->post ( "item_id" );
		$response = $this->item->remove ( $id );
		
		if ("deleted" == $response) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else if ("1451" == $response) {
			$_SESSION ["appErrors"] [] = get_app_message ( "db.error1451" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( '/inventory' );
	}
	public function issueForm($data = array()) {
		// Prepopulate the User if student identified.
		$studentId = $this->input->get ( "student_id" );
		if (! empty ( $studentId )) {
			$prePopulateStudent = $this->student->prePopulate ( $studentId );
			$data ["prePopulateStudent"] = $prePopulateStudent;
			$data ["readonlyStudentOnIssueForm"] = "readonly";
		}
		
		$itemId = $this->input->get ( "item_id" );
		if (! empty ( $itemId )) {
			$prePopulateItem = $this->item->prePopulate ( $itemId );
			$data ["prePopulateItem"] = $prePopulateItem;
			$data ["readonlyItemOnIssueForm"] = "readonly";
		}
		
		$paymentStatuses = array ();
		$paymentStatuses [] = get_app_message ( "db.status.due" );
		$paymentStatuses [] = get_app_message ( "db.status.paid" );
		$data ["paymentStatuses"] = $paymentStatuses;
		
		// Redirect to URL after processing the request
		$redirectURL = $this->input->get ( "redirectURL" );
		if (empty ( $redirectURL )) {
			$redirectURL = "/inventory";
		}
		$data ["redirectURL"] = $redirectURL;
		
		$this->template->load ( $this->activeTemplate, 'items/issue_item', $data );
	}
	public function issueItem() {
		$studentId = $this->input->post ( "student_id" );
		$itemId = $this->input->post ( "item_id" );
		$amountToIssue = $this->input->post ( "issued_amount" );
		$paymentStatus = $this->input->post ( "payment_status" );
		
		// it will also update the money_transaction table
		$response = $this->item->issue ( $itemId, $studentId, $amountToIssue, $paymentStatus, $_SESSION ["sessionUser"] );
		
		if ("amount_not_available" == $response) {
			$_SESSION ["appErrors"] [] = get_app_message ( "item.issue.amount.not.available" );
		}
		
		if (get_app_message ( "response.failed" ) == $response) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		if (get_app_message ( "response.success" ) == $response) {
			$this->generateAlert ( $itemId, $studentId, $amountToIssue, $paymentStatus );
			
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		}
		
		$redirectURL = $this->input->post ( "redirectURL" );
		if (stringContains ( $redirectURL, "/asaanschool" )) {
			$redirectURL = str_replace ( "/asaanschool", "", $redirectURL );
		}
		if (! empty ( $redirectURL )) {
			redirect ( $redirectURL );
		}
		
		redirect ( '/inventory' );
	}
	private function generateAlert($itemId, $studentId, $issuedQuantity, $paymentStatus) {
		
		if (empty ( $itemId ) || empty ( $studentId ) || empty ( $issuedQuantity ) || empty ( $paymentStatus )) {
			return;
		}
		
		$item = $this->item->get ( $itemId );
		$student = $this->student->get ( $studentId );
		
		$gEmails = $this->guardian->getEmailAddresses ( null, $studentId );

		$addresses = array ();
		if (! empty ( $student ) && ! empty ( $student ["email"] )) {
			$addresses [] = $student ["email"];
		}
		if (! empty ( $gEmails )) {
			foreach ( $gEmails as $email ) {
				$addresses [] = $email ["email"];
			}
		}
		
		$studentName = $student ["first_name"] . " " . $student ["last_name"];
		$itemDesc = $item["description"];
		 
		
		$addresses = array_unique ( $addresses );
		$campusDetails = $_SESSION ["currentCampus"] ["campus_name"];
		$emailData = array ();
		
		$emailData ["email_subject"] = "Item issued";
		
		$emailData ["email_body"] = "Sir/Madam,
						<br/>
						<br/>
						It is informed that we have issued ".$issuedQuantity."  ".$itemDesc."(s) to $studentName with payment status as $paymentStatus.
						
						<br/>
						<br/>
						Thanking you!
						<br/>
						<br/>
						Sincerely,
						<br/>
						<br/>
						Admin<br/>
						$campusDetails";
		generateAlertOnEvent ( null, $addresses, $emailData );
	}
	public function returnForm($data = array()) {
		// Prepopulate the User if student identified.
		$studentItemId = $this->input->get ( "student_item_id" );
		
		if (empty ( $studentItemId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( "/student" );
		}
		
		$studentItem = $this->studentItem->get ( $studentItemId );
		$data ["studentItem"] = $studentItem;
		
		$this->template->load ( $this->activeTemplate, 'items/return_item', $data );
	}
	public function returnItem() {
		$studentItemId = $this->input->post ( "student_item_id" );
		$studentId = $this->input->post ( "student_id" );
		
		if (empty ( $studentItemId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			redirect ( '/student/view?id=' . $studentId );
		}
		
		$response = $this->item->returnItem ( $studentItemId, $_SESSION ["sessionUser"] );
		
		if (get_app_message ( "response.failed" ) == $response) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		if (get_app_message ( "response.success" ) == $response) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		}
		
		redirect ( '/student/view?student_id=' . $studentId );
	}
	public function getAutoComplete() {
		$params ["q"] = $this->input->get ( "q" );
		$params ["callback"] = $this->input->get ( "callback" );
		$result = $this->item->getAutocomplete ( $params );
		
		echo $result;
	}
}
