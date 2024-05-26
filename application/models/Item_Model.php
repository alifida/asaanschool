<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Item_Model extends CI_Model {

	public $campusId ;

	public function __construct() {
		parent::__construct();
		$this->campusId = $_SESSION["currentCampus"]["id"];
	}




	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null) {
		$this->db->select()->from('items');

		// where condition if id is present
		if ($id != null) {
			$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		} else {
			$this->db->where('campus_id', $this->campusId);
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			$item = $query->row_array(); // single row
			if(!empty($item)){
				$this->load->model('Itemtype_Model', 'itemType');
				$itemType = $this->itemType->get($item["item_type_id"]);
				$item["type"]=$itemType;
			}

			return $item;
		} else {
			$items = $query->result_array(); // array of result
			if(!empty($items)){
				$this->load->model('Itemtype_Model', 'itemType');
				foreach($items as $key => $item){
					$itemType = $this->itemType->get($item["item_type_id"]);
					$items[$key]["type"]=$itemType;
				}
					
			}
			return $items;
		}
	}




	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where("(campus_id = '$this->campusId' AND id = '$id')");
		$this->db->delete('items');
		if ($this->db->_error_number() == 1451){
			return "1451";
		}
		return "deleted";
	}

	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert. One function doing both add and edit.
	 * @param $data
	 */
	public function merge($data) {

		// comma must be the first and last character of String if it is not empty.

		$newId = "";
		$this->db->trans_start();
		$data["campus_id"] = $this->campusId;
		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('items', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('items', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}
	public function update($data) {

		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('items', $data); // update the record

		}
	}


	public function getAvailable() {
		$this->db->select()->from('items');
		$this->db->where("(campus_id = '$this->campusId' AND available_amount > 0)");
		$query = $this->db->get();
		$items = $query->result_array();

		if(!empty($items)){
			$this->load->model('Itemtype_Model', 'itemType');
			foreach($items as $key => $item){
				$itemType = $this->itemType->get($item["item_type_id"]);
				$items[$key]["type"]=$itemType;
			}

		}
		return $items;

	}
	public function getOldItems() {
		$this->db->select()->from('items');
		$this->db->where("(campus_id = '$this->campusId' AND available_amount <= 0)");
		$query = $this->db->get();
		$items = $query->result_array();

		if(!empty($items)){
			$this->load->model('Itemtype_Model', 'itemType');
			foreach($items as $key => $item){
				$itemType = $this->itemType->get($item["item_type_id"]);
				$items[$key]["type"]=$itemType;
			}

		}
		return $items;

	}


	function getAutocomplete($params) {
		$arr = array();

		$sqlString =
        	"SELECT\n".
			"	i.id,\n".
			"	CONCAT(it.`name`,\" (\", i.available_amount , \")\") AS`name`  \n".
			" FROM\n".
			"	items i,\n".
			"	item_types it\n".
			" WHERE\n".
			"  	i.campus_id = ".$this->campusId.
			" AND	i.item_type_id = it.id\n".
			" AND i.available_amount > 0". 
			" AND (it.`name` LIKE '%".$params["q"]."%' OR i.description LIKE '%".$params["q"]."%' ) ";

		$query = $this->db->query($sqlString);
		$items = $query->result_array();

		# JSON-encode the response
		$json_response = json_encode($items);

		# Optionally: Wrap the response in a callback function for JSONP cross-domain support
		if ($params["callback"]) {
			$json_response = $params["callback"] . "(" . $json_response . ")";
		}
		return $json_response;
	}



	public function prePopulate($itemId) {

		$sqlString =
        	"SELECT\n".
			"	i.id,\n".
			"	CONCAT(it.`name`,\" (\", i.available_amount , \")\") AS`name`  \n".
			" FROM\n".
			"	items i,\n".
			"	item_types it\n".
			" WHERE\n".
			"	i.item_type_id = it.id\n".
			" AND i.available_amount > 0".
			" AND i.id = ".$itemId; 
			" AND i.campus_id = ".$this->campusId; 
			

		$query = $this->db->query($sqlString);
		$items = $query->result_array();

		# JSON-encode the response
		$json_response = json_encode($items);

		# Optionally: Wrap the response in a callback function for JSONP cross-domain support

		return $json_response;
	}


	function issue($itemId, $studentId, $amountToIssue, $paymentStatus, $sessionUser){
		$response = "";

		//amount_not_available, get_app_message("response.failed"), get_app_message("response.success")

		// check amount availablity
		$query = $this->db->query("SELECT\n ".
				"	* \n ".
				" FROM \n ".
				"	items i \n ".
				" WHERE \n ".
				" 	i.id = ".$itemId.
				" 	AND	i.available_amount >= ". $amountToIssue);
		$item = $query->row_array();
		if(empty($item)){
			$response = "amount_not_available";
			return $response;
		}else{
			// Item is available
			$this->db->trans_start();

			// update the available amount
			$item["available_amount"] = $item["available_amount"] - $amountToIssue;
			$this->merge($item);

			$unitPrice = $item["price"];

			// insert Student_Item record.
			$this->load->model('Studentitem_Model', 'studentItem');
			$studentItem = array();
			$studentItem["item_id"] = $itemId;
			$studentItem["student_id"] = $studentId;
			$studentItem["issued_amount"] = $amountToIssue;
			$studentItem["due_money"] = $amountToIssue * $unitPrice;

			$studentItem["payment_status"] = $paymentStatus;
			if($paymentStatus == get_app_message("db.status.paid")){
				$studentItem["paid_date"] = getCurrentDate();
				$studentItem["paid_by"] = "Student";

				// update the money_transaction table
				$payment = $unitPrice * $amountToIssue;
				$transaction = array();
				$this->load->model('Moneytransaction_Model', 'moneyTransaction');
				$this->load->model('Transactiontype_Model', 'transactionType');
				$transactionType =$this->transactionType->getByKey("student.dues.clearance");
				$moneyTransaction= array();
				$moneyTransaction["amount"]=$payment;
				$moneyTransaction["transaction_type_id"]=$transactionType["id"];
				$moneyTransaction["created_at"]=getCurrentDateTime();
				$moneyTransaction["created_by"]=$_SESSION["sessionUser"]["id"];
				$moneyTransaction["updated_by"]=$_SESSION["sessionUser"]["id"];

				$transactionId = $this->moneyTransaction->merge($moneyTransaction);
					
				$studentItem["transaction_id"] = $transactionId;
			}
			$studentItem["issue_date"] = getCurrentDate();

			$this->studentItem->merge($studentItem);


			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return get_app_message("response.failed");
			} else {
				return get_app_message("response.success");
			}

		}
		return $response;

	}

	function returnItem($studentItemId, $sessionUser){
		$response = get_app_message("response.failed");

		$this->load->model('Studentitem_Model', 'studentItem');
		$studentItem = $this->studentItem->get($studentItemId);
		if(!empty($studentItem) && $studentItem["payment_status"] == get_app_message("db.status.due")){
			$item = $this->get($studentItem["item_id"]);
			//pre($studentItem);
			$itemUpdate = array();
			$itemUpdate["id"]=$item["id"];
			$itemUpdate["available_amount"] = $item["available_amount"] + $studentItem["issued_amount"];

			$this->db->trans_start();
			// update the available amount of item table
			$this->update($itemUpdate);

			// simply remove the entry from student_items table. as there is no money transaction against this entry.
			$this->studentItem->remove($studentItem["id"]);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				$response = get_app_message("response.failed");
			} else {
				$response = get_app_message("response.success");
			}
		}
		return $response;
	}



	public function getItemDetails($id = null){

		$item = array();
		if($id == null){
			return $item;
		}

		$item = $this->get($id);
		if(!empty($item)){
			$this->load->model('Studentitem_Model', 'studentItem');
			$studentItems = $this->studentItem->getByItemId($id);
			$item["studentItems"] =$studentItems;
		}
		return $item;

	}

}
