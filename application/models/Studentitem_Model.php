<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Studentitem_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function get($id = null) {
		$this->db->select()->from('student_items');

		// where condition if id is present
		if ($id != null) {
			$this->db->where('id', $id);
		} else {
			$this->db->order_by('id');
		}

		$query = $this->db->get();

		if ($id != null) {
			$studentItem = $query->row_array(); // single row
			if(!empty($studentItem)){
				$this->load->model('Student_Model', 'student');
				$this->load->model('Item_Model', 'item');
				$student= $this->student->get($studentItem["student_id"]);
				$item = $this->item->get($studentItem["item_id"]);
				$studentItem["student"] = $student;
				$studentItem["item"] = $item;
			}
			return $studentItem;
		} else {
			$studentItems = $query->result_array(); // array of result
			if(!empty($studentItems)){
				foreach($studentItems as $key=>$studentItem){
					$this->load->model('Student_Model', 'student');
					$this->load->model('Item_Model', 'item');
					$student= $this->student->get($studentItem["student_id"]);
					$item = $this->item->get($studentItem["item_id"]);
					$studentItems[$key]["student"] = $student;
					$studentItems[$key]["item"] = $item;
				}
			}
			return $studentItems;
		}
	}





	public function getByTransactionId($transactionId) {
		$studentItems = array();
		if ($transactionId == null) {
			return $studentItems;
		}

		$this->db->select()->from('student_items');
		$this->db->where('transaction_id', $transactionId);
		$query = $this->db->get();

		$studentItems = $query->result_array(); // array of result
		if(!empty($studentItems)){
				$this->load->model('Student_Model', 'student');
				$this->load->model('Item_Model', 'item');
			foreach($studentItems as $key=>$studentItem){
				$student= $this->student->get($studentItem["student_id"]);
				$item = $this->item->get($studentItem["item_id"]);
				$studentItems[$key]["student"] = $student;
				$studentItems[$key]["item"] = $item;
			}
		}
		return $studentItems;

	}


	public function getByTransactionIds($transactionIds = array()){
		$studentItems = array();
		if (empty($transactionIds)) {
			return $studentItems;
		}

		$this->db->select()->from('student_items');
		$this->db->where_in('transaction_id', $transactionIds);
		$query = $this->db->get();

		$studentItems = $query->result_array(); // array of result
		if(!empty($studentItems)){
				$this->load->model('Student_Model', 'student');
				//$this->load->model('Item_Model', 'item');
			foreach($studentItems as $key=>$studentItem){
				$student= $this->student->get($studentItem["student_id"]);
				//$item = $this->item->get($studentItem["item_id"]);
				$studentItems[$key]["student"] = $student;
				//$studentItems[$key]["item"] = $item;
			}
		}
		return $studentItems;
	}
	
	
	
	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('student_items');
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

		if (isset($data['id']) && !empty($data['id'])) {

			$this->db->where('id', $data['id']);
			$this->db->update('student_items', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('student_items', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}

	public function update($data) {

		if (isset($data['id']) && !empty($data['id'])) {
			$this->db->where('id', $data['id']);
			$this->db->update('student_items', $data); // update the record
		}else{
			return get_app_message ( "response.failed" );
		}
	}


	public function updateByTransactionId($data) {
		if (isset($data['transaction_id']) && !empty($data['transaction_id'])) {
			$this->db->where('transaction_id', $data['transaction_id']);
			$this->db->update('student_items', $data); // update the record
			return get_app_message ( "response.success" );
		}else{
			return get_app_message ( "response.failed" );
		}
	}






	public function getStudentItemsByStatus($studentId, $status){

		$query = $this->db->query("SELECT\n".
				"	i.*, \n".
				"	si.id as student_item_id,\n".
				"	si.issue_date,\n".
				"	si.due_money,\n".
				"	si.issued_amount\n".
				" FROM\n".
				"	items i,\n".
				"	student_items si,\n".
				"	students s\n".
				" WHERE\n".
				"	i.id = si.item_id\n".
				" AND si.student_id = s.id\n".
				" AND si.payment_status = '".$status."'\n".
				" AND s.id = ".$studentId.
    			" ORDER BY si.issue_date DESC"
    			);
    			$rs = $query->result_array();

    			if(!empty($rs)){
    				$this->load->model('Itemtype_Model', 'itemtype');

    				foreach($rs as $key => $row){
    					$rs[$key]["item_type"]=$this->itemtype->get($row["item_type_id"]);
    				}
    			}

    			return $rs;
	}
	public function getStudentItems($studentId){

		$query = $this->db->query("SELECT\n".
				"	i.*, \n".
				"	si.id as student_item_id , \n".
				"	si.issue_date,\n".
				"	si.issued_amount,\n".
				"	si.payment_status,\n".
				"	si.paid_by,\n".
				"	si.paid_date,\n".
				"	si.comments,\n".
				"	si.transaction_id\n".
				" FROM\n".
				"	items i,\n".
				"	student_items si,\n".
				"	students s\n".
				" WHERE\n".
				"	i.id = si.item_id\n".
				" AND si.student_id = s.id\n".
				" AND s.id = ".$studentId.
    			" ORDER BY si.issue_date DESC"
    			);
    			$rs = $query->result_array();
    			if(!empty($rs)){
    				$this->load->model('Itemtype_Model', 'itemtype');

    				foreach($rs as $key => $row){
    					$rs[$key]["item_type"]=$this->itemtype->get($row["item_type_id"]);
    				}
    			}

    			return $rs;
	}

	public function getByPaymentStatus($campusId =null, $paymentStatus){
		$rs = array();
		if ($campusId == null) {
			return $rs;
		}
		$this->db->select("student_items.*")->from('student_items');
		$this->db->join('students', 'students.id = student_items.student_id', 'left');
		$this->db->where("(students.campus_id = '$campusId' AND student_items.payment_status = '$paymentStatus')");
		$query = $this->db->get();
		$rs = $query->result_array();
		
		if(!empty($rs)){
			$this->load->model('Item_Model', 'item');
			$this->load->model('Student_Model', 'student');
			
			foreach($rs as $key => $row){
				$rs[$key]["item"]=$this->item->get($row["item_id"]);
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		return $rs;
	}
	public function getByPaymentStatusAndStudents($campusId =null,$studentIds, $paymentStatus){
		$rs = array();
		if ($campusId == null) {
			return $rs;
		}
		$this->db->select("student_items.*")->from('student_items');
		$this->db->join('students', 'students.id = student_items.student_id', 'left');
		$this->db->where("(students.campus_id = '$campusId' AND students.id in($studentIds) AND student_items.payment_status = '$paymentStatus')");
		$query = $this->db->get();
		$rs = $query->result_array();
		
		if(!empty($rs)){
			$this->load->model('Item_Model', 'item');
			$this->load->model('Student_Model', 'student');
			
			foreach($rs as $key => $row){
				$rs[$key]["item"]=$this->item->get($row["item_id"]);
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		return $rs;
	}

	
	public function getByPaymentStatusAndGuardian($guardianId, $feeStatus){
		$rs = array();
		if ($guardianId == null) {
			return $rs;
		}
		$sql ="select si.* from student_items si, students_guardians sg, guardians g "
				." where si.student_id = sg.student_id  "
				." and g.id = sg.guardian_id  "
				." and si.payment_status = '$feeStatus' "
				." and g.id = '$guardianId' "
				;
		
				 
			$query = $this->db->query ( $sql );
			$rs = $query->result_array ();
			
			if(!empty($rs)){
				$this->load->model('Item_Model', 'item');
				$this->load->model('Student_Model', 'student');
				
				foreach($rs as $key => $row){
					$rs[$key]["item"]=$this->item->get($row["item_id"]);
					$rs[$key]["student"] = $this->student->get($row["student_id"]);
				}
			}
			return $rs;
	}
	
	public function getByItemId($itemId =null){
		$rs = array();
		if ($itemId == null) {
			return $rs;
		}
		$this->db->select("student_items.*")->from('student_items');
	
		$this->db->where("(item_id = '$itemId')");
		$query = $this->db->get();
		$rs = $query->result_array();
		
		if(!empty($rs)){
			
			$this->load->model('Student_Model', 'student');
			
			foreach($rs as $key => $row){
				
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		return $rs;
	}
}
