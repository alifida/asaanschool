<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Guardian_Model extends CI_Model {

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
		if ($id == null) {
			return array();
		}

		$this->db->select()->from('guardians');
		$this->db->where('id', $id);

		$query = $this->db->get();
		return $query->row_array(); // single row
	}
	public function getEmailAddresses($classId=null, $studentIds=null){
		$sql =" SELECT distinct g.email from guardians g, students s, students_guardians sg "
						." where  g.id = sg.guardian_id " 
						." and sg.student_id = s.id " 
						." and s.campus_id = ".$_SESSION["currentCampus"]["id"]	 ;
		if(!empty($classId)){
			$sql .= " and s.class_id= '$classId' ";
		}
		if(!empty($studentIds)){
			$sql .= " and s.id in ($studentIds) ";
		}
		$query = $this->db->query ( $sql );
		return $query->result_array ();
	}
	public function getByEmail($email = null) {
		if ($email == null) {
			return array();
		}

		$this->db->select()->from('guardians');
		$this->db->where('email', $email);

		$query = $this->db->get();
		$rs = $query->result_array(); 
		if(!empty($rs)){
			return $rs[0];
		}
		return array();
	}

	public function getByCurrentCampus(){
		/*;*/

		$gaurdians = array();
		$query = $this->db->query(" SELECT distinct g.* from guardians g, students s, students_guardians sg "
						." where  g.id = sg.guardian_id " 
						." and sg.student_id = s.id " 
						." and s.campus_id = ".$_SESSION["currentCampus"]["id"]	 );
		$gaurdians = $query->result_array();
		return  $gaurdians;

	}
	
	public function getByIds($ids = array()) {
		$this->db->select()->from('guardians');
		$guardians=array();
	
		if (!empty($ids)) {
			$this->db->where_in('id', $ids);
			$this->db->order_by('name asc');
	
			$query = $this->db->get();
	
			$guardians = $query->result_array();
			// get referenced objects
		}
		return $guardians;
	
	}
	
	

	public function getByStuents($studentIds = array()) {
		$gaurdians = array();
		// where condition if id is present
		if (!empty($studentIds)) {

			$query = $this->db->query(" SELECT \n".
										"	g.* \n".
										" FROM\n".
										"	guardians g, \n".
										"	students_guardians sg \n".
										" WHERE\n".
										"	sg.guardian_id = g.id \n".
										" AND sg.student_id IN(".implode(",", $studentIds).") "
										);
										$gaurdians = $query->result_array();
		}

		return  $gaurdians;
	}





	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('guardians');
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
			$this->db->update('guardians', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {

			$this->db->insert('guardians', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}

	function getAutocomplete($params) {
		$arr = array();
	
		$sqlString =
		" SELECT \n".
		"	g.id, \n".
		"	CONCAT(g.`name` ,\" (\", g.`cnic`,\" )\") as `name` \n".
		" FROM \n".
		"	guardians g \n".
		" WHERE \n".
		"  (g.`name` LIKE '%".$params["q"]."%' OR g.`cnic` LIKE '%".$params["q"]."%' ) ";
	//pre_d($sqlString);
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
	
	
	
	public function prePopulateByIds($guardianIds = array()) {
	
		if(empty($guardianIds)){
			return "";
		}
		
		$ids = implode(",", $guardianIds);
		$sqlString =
		" SELECT \n".
		"	g.id, \n".
		"	CONCAT(g.`name` ,\" (\", g.`mobile`,\" )\") as `name` \n".
		" FROM \n".
		"	guardians g \n".
		"WHERE\n".
		" g.`id` in (".$ids.")\n;";
	
		$query = $this->db->query($sqlString);
		$guardians = $query->result_array();
	
		# JSON-encode the response
		$json_response = json_encode($guardians);
	
	
		return $json_response;
	}
	public function getCountByGuardian($guardianId=null){
		if(empty($guardianId)){
			return 0;
		}
		$status =  get_app_message ( "db.status.active" );
		$sql ="SELECT count(s.id) as cnt from students s, students_guardians sg "
				." where s.id = sg.student_id "
						." and sg.guardian_id = '$guardianId' "
						." and s.status ='$status'";
						
						$query = $this->db->query($sql) ;
						
						$rs = $query->row_array();
						if(!empty($rs)){
							return $rs["cnt"];
						}
						
						return 0;
	}
	public function getFeeSumByGuardian($guardianId=null, $paymentStatus=null){
		 
		$fee_sum =0;

		if(empty($guardianId) || empty($paymentStatus)){
			return $fee_sum;
		}
		 
		$status =  get_app_message ( "db.status.active" );
		$sql ="select sum(sf.amount) as fee_sum from student_fee sf , students_guardians sg, students s "
				." where "
				." sg.student_id = s.id "
				." and s.id = sf.student_id "
				." and sg.student_id=sf.student_id "
				." and s.status='$status' "
				." and sf.payment_status ='$paymentStatus' "
				." and sg.guardian_id = '$guardianId'";
						
		$query = $this->db->query($sql) ;
		
		$rs = $query->row_array();
		if(!empty($rs)){
			$fee_sum = $rs["fee_sum"];
		}
		
		return $fee_sum;
	}
	public function getInventorySumByGuardian($guardianId=null, $paymentStatus){
		 
		$inv_sum =0;

		if(empty($guardianId) || empty($paymentStatus)){
			return $inv_sum;
		}
		
		 
		$status =  get_app_message ( "db.status.active" );
		$sql ="select sum(si.due_money) as inv_sum from student_items si , students_guardians sg, students s "
				." where "
				." sg.student_id = s.id "
				." and s.id = si.student_id "
				." and sg.student_id=si.student_id "
				." and s.status='$status' "
				." and si.payment_status ='$paymentStatus' "
				." and sg.guardian_id = '$guardianId'";
					 
		$query = $this->db->query($sql) ;
		
		$rs = $query->row_array();
		if(!empty($rs)){
			$inv_sum = $rs["inv_sum"];
		}
		
		return $inv_sum;
	}
	public function getPaymentSumByGuardian($guardianId=null, $paymentStatus){
		 
		if(empty($guardianId) || empty($paymentStatus)){
			return 0;
		}
		
		$fee_sum =$this->getFeeSumByGuardian($guardianId, $paymentStatus);
		$inv_sum =$this->getInventorySumByGuardian($guardianId, $paymentStatus);
		
		
		return $fee_sum + $inv_sum;
	}
	

}
