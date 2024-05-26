<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Studentfee_Model extends CI_Model {

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
		$this->db->select()->from('student_fee');

		// where condition if id is present
		$this->db->where('id', $id);

		$query = $this->db->get();

		$rs =  $query->row_array(); // single row
		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			$rs["fee_type"]=$this->feetype->get($rs["fee_type_id"]);
		}
		return $rs;
	}

	public function getByClassIds($classIds = array()){
		if(empty($classIds)){
			return array();
		}
		$this->load->model('Student_Model', 'student');
		$students = $this->student->getByClassIds($classIds );
		$ids = array();
		if(!empty($students)){
			foreach($students as $student){
				$ids[]=$student["id"];
			}
		}

		$classFee = $this->getByStudentIds($ids);
		
		return $classFee;

	}
	public function getByStudentIds($studentIds = array()){
		if(empty($studentIds)){
			return array();
		}
		$this->db->select()->from('student_fee');
		$this->db->where_in('student_id', $studentIds);
		$query = $this->db->get();
		$rs = $query->result_array();
		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			$this->load->model('Student_Model', 'student');

			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		return $rs;

	}
	public function getByTransactionId($transactionId = null){
		$rs = array();
		if ($transactionId == null) {
			return $rs;
		}
		$this->db->select()->from('student_fee');
		$this->db->where('transaction_id', $transactionId);
		$this->db->order_by('transaction_id','DESC');
		$query = $this->db->get();
		$rs = $query->result_array();
		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			$this->load->model('Student_Model', 'student');

			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		return $rs;
	}
	
	public function getByTransactionIds($transactionIds = array()){
		$rs = array();
		if (empty($transactionIds)) {
			return $rs;
		}
		$this->db->select()->from('student_fee');
		//$this->db->where('transaction_id', $transactionId);
		$this->db->where_in('transaction_id', $transactionIds);
		$this->db->order_by('transaction_id','DESC');
		$query = $this->db->get();
		$rs = $query->result_array();
		if(!empty($rs)){
			//$this->load->model('Feetype_Model', 'feetype');
			$this->load->model('Student_Model', 'student');

			foreach($rs as $key => $row){
				//$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		return $rs;
	}
	public function getByPaymentStatus($campusId =null, $feeStatus){
		$rs = array();
		if ($campusId == null) {
			return $rs;
		}
		$this->db->select("student_fee.*")->from('student_fee');
		$this->db->join('students', 'students.id = student_fee.student_id', 'left');
		$this->db->where("(students.campus_id = '$campusId' AND student_fee.payment_status = '$feeStatus')");
		//$this->db->where('payment_status', $feeStatus);
		$query = $this->db->get();
		$rs = $query->result_array();

		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			$this->load->model('Student_Model', 'student');

			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		 
		return $rs;
	}
	public function getByPaymentStatusAndStudents($campusId =null,$studentIds, $feeStatus){
		$rs = array();
		if ($campusId == null) {
			return $rs;
		}
		$this->db->select("student_fee.*")->from('student_fee');
		$this->db->join('students', 'students.id = student_fee.student_id', 'left');
		$this->db->where("(students.campus_id = '$campusId' AND students.id in($studentIds)  AND student_fee.payment_status = '$feeStatus')");
		//$this->db->where('payment_status', $feeStatus);
		$query = $this->db->get();
		$rs = $query->result_array();

		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			$this->load->model('Student_Model', 'student');

			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
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
		$sql ="select sf.* from student_fee sf, students_guardians sg, guardians g "
				." where sf.student_id = sg.student_id  "
				." and g.id = sg.guardian_id  "
				." and sf.payment_status = '$feeStatus' "
				." and g.id = '$guardianId' "
				." "
				;
		 
		$query = $this->db->query ( $sql );
		$rs = $query->result_array ();
		
		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			$this->load->model('Student_Model', 'student');

			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
				$rs[$key]["student"] = $this->student->get($row["student_id"]);
			}
		}
		return $rs;
	}

	/**
	 * This function will delete the record based on the id
	 * @param $id
	 */
	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('student_fee');
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
			$this->db->update('student_fee', $data); // update the record
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return get_app_message ( "response.failed" );
			} else {
				return get_app_message ( "response.success" );
			}
		} else {
    
			$this->db->insert('student_fee', $data); // insert new record
			$newId = $this->db->insert_id();
			$this->db->trans_complete();
			return $newId;
		}
	}
	public function update($data) {
			
		if (isset($data['id']) && !empty($data['id'])) {
			$this->db->where('id', $data['id']);
			$this->db->update('student_fee', $data); // update the record
			return get_app_message ( "response.success" );
		}else{
			return get_app_message ( "response.failed" );
		}
	}

	public function updateByTransactionId($data) {
		if (isset($data['transaction_id']) && !empty($data['transaction_id'])) {
			$this->db->where('transaction_id', $data['transaction_id']);
			$this->db->update('student_fee', $data); // update the record
			return get_app_message ( "response.success" );
		}else{
			return get_app_message ( "response.failed" );
		}
	}

	public function getByStudentByFeeStatus($student_id, $status){
		//$this->updateNextMonthFee();
		$query = $this->db->query("SELECT\n".
				"	*\n".
				" FROM\n".
				"	student_fee sf\n".
				" WHERE\n".
				"	sf.student_id = ".$student_id."\n".
				" AND sf.`payment_status` = '".$status."'");
		$rs = $query->result_array();
			
		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
			}
		}
			
		return $rs;
	}
	public function getByTypeAndStatus($feeType, $status){
		//$this->updateNextMonthFee();
		$query = $this->db->query("SELECT ".
				"	* ".
				" FROM ".
				"	student_fee sf, fee_types t  ".
				" WHERE sf.fee_type_id = t.id ".
				" and t.internal_key = '$feeType' ".
				" AND sf.`payment_status` = '".$status."'");
		$rs = $query->result_array();
			
		/* if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
			}
		} */
			
		return $rs;
	}
	public function getStudentFee($student_id){
		//$this->updateNextMonthFee();
		$query = $this->db->query("SELECT\n".
				"	*\n".
				" FROM\n".
				"	student_fee sf\n".
				" WHERE\n".
				"	sf.student_id = ".$student_id);
		$rs = $query->result_array();
			
		if(!empty($rs)){
			$this->load->model('Feetype_Model', 'feetype');
			foreach($rs as $key => $row){
				$rs[$key]["fee_type"]=$this->feetype->get($row["fee_type_id"]);
			}
		}
		return $rs;
	}
	/**
	 * This function will check today date and mark the
	 * next fee as pending dues for each student, This method will only execute after the due
	 * date set by Admin in Configuration table for key: "tuition.fee.due.date" defaul = 25

	 public function updateNextMonthFee(){
		$this->load->model('Configuration_Model', 'conf');
		$this->load->model('Feetype_Model', 'feetype');
		$day = $this->conf->getValue("tuition.fee.due.date");
		if(!is_numeric($day) || $day > 31 || $day < 1){
		$day = 25;
		}
		// get today date and compare with $day
		$currentDay = date("d");
		$currentMonth= date("m");
		$year= date("Y");
		$nextMonth = $currentMonth +1;
			
		if($nextMonth > 12){
		$nextMonth = 1;
		$year = $year +1;
		}
		$dueDate = $year."-".$nextMonth."-01";
		if($currentDay >= $day){
		//    		echo "Run scheduled task";

		$query = $this->db->query("SELECT\n".
		"	s.*\n".
		" FROM\n".
		"	students s\n".
		"	\n".
		" WHERE ".
		"	s.`status` = '".get_app_message("db.status.active")."'	".
		"	AND s.id NOT IN(\n".
		"	SELECT sf.student_id from student_fee sf, fee_types ft \n".
		"	WHERE sf.fee_type_id = ft.id \n".
		"	AND ft.internal_key = 'tuition.fee'\n".
		"	AND sf.fee_date  LIKE '".$year."-".$nextMonth."%'\n".
		")");

		$studentsRS = $query->result_array();

		$feetypeRow = $this->feetype->getByKey("tuition.fee");
		$feeTypeId = 1;
		if(!empty($feetypeRow)){
		$feeTypeId = $feetypeRow["id"];
		}


		$this->dueFeeToStudents($feeTypeId, $studentsRS, $dueDate);

		}else{
		//echo "return";
		return;
		}
			
		}

		*/
	public function dueFeeToStudents($feeTypeId, $students, $dueDate){
		if(!empty($students)){
			$this->load->model('Feetype_Model', 'feetype');
			foreach($students as $key=> $student){
				$studentFee = array();

				$studentFee["fee_type_id"] = $feeTypeId;
				$studentFee["student_id"] = $student["id"];
				$studentFee["fee_date"] = $dueDate;

				// check if already has fee entry of same date in student_fee table

				$existanceQuery = 	$this->db->query("SELECT\n".
									"	sf.id\n".
									" FROM\n".
									"	student_fee sf\n".
									" WHERE\n".
									"	sf.student_id = ".$student["id"]."\n".
									" AND sf.fee_type_id = ".$feeTypeId."\n".
									" AND sf.fee_date = '".$dueDate."'");
				$feeExistanceRow = $existanceQuery -> result_array();
				// if empty $feeExistanceRow means there no entry for this fee and Date for this student
				if(empty($feeExistanceRow)){
					// get the Fee Amount Against Class of Student
					$feeAmountQry =	$this->db->query("SELECT\n".
													"	cf.amount, cf.fee_type_id \n".
													" FROM\n".
													"	classes c,\n".
													"	class_fee cf \n".
													" WHERE\n".
													"	c.id = cf.class_id\n".
													" AND cf.fee_type_id = ".$feeTypeId."\n".
													" AND c.id = ".$student["class_id"]);
					$feeAmountRS = $feeAmountQry->row_array();

					$classFee = 0;
					if(!empty($feeAmountRS)){
						$classFee = $feeAmountRS["amount"];
						
						if ($studentFee["fee_type_id"] == $student["sibling_discount_fee_type"] && !empty($student["sibling_discount"])) {
				            $discountType ="Fixed";
    						if(!empty($student["sibling_discount_type"])){
    						    $discountType= $student["sibling_discount_type"];
    						}
				            
    						if ($discountType =="Fixed") {
    						    $classFee = $classFee - $student["sibling_discount"] ;
    						} else {
    						    $percentValue = 0 ;
    						    $percentValue = ($classFee*$student["sibling_discount"]/100) ;
    						    $classFee = $classFee - $percentValue ;
    						}
						}
					}

					$studentFee["amount"] = $classFee ;
					$studentFee["payment_status"] = "Due" ;
					$this->merge($studentFee);
				}
			}
		}
	}
	public function dueArrearsToStudents($feeTypeId, $studentId, $dueDate, $arrears){
	    if(!empty($studentId)){
			$this->load->model('Feetype_Model', 'feetype');
				$studentFee = array();

				$studentFee["fee_type_id"] = $feeTypeId;
				$studentFee["student_id"] = $studentId;
				$studentFee["fee_date"] = $dueDate;
 
					// get the Fee Amount Against Class of Student
			    $studentFee["amount"] = $arrears ;
				$studentFee["payment_status"] = "Due" ;
				
				$res =$this->merge($studentFee);
				
				
		}
	}

	public function getAllDueDates($feeTypeId ="", $classId=""){
		$sqlString = 	"SELECT DISTINCT sf.fee_date FROM student_fee sf ";
		if(!empty($classId)){
			$sqlString = $sqlString. " , students s ";
		}
		$sqlString = $sqlString." WHERE sf.payment_status = 'Due' ";
		if(!empty($feeTypeId)){
			$sqlString = $sqlString . " AND sf.fee_type_id =".$feeTypeId;
		}
		if(!empty($classId)){
			$sqlString = $sqlString. "  AND s.class_id =".$classId;
			$sqlString = $sqlString. "  AND s.id = sf.student_id ";
		}
		$sqlString = $sqlString. "  ORDER BY sf.fee_date desc ";
		$query = $this->db->query($sqlString);
		$dates = $query->result_array();

		return $dates;
	}


	public function deleteDueFee($feeTypeId, $classId, $feeDate, $studentIds){

		if(!empty($feeTypeId) && !empty($classId) && !empty($feeDate) && !empty($studentIds) ){
			$ids = implode(', ', $studentIds);
			$sqlString ="DELETE sf.*\n".
					" FROM\n".
					"	student_fee sf,\n".
					"	students s\n".
					" WHERE\n".
					"	sf.fee_type_id = ".$feeTypeId.
					" AND sf.fee_date = '".$feeDate."'".
					" AND s.class_id = ".$classId.
					" AND sf.student_id = s.id\n".
					" AND s.id IN(".$ids.")";
			echo $sqlString;
			$response = $this->db->query($sqlString);
			$rows = $this->db->affected_rows();
			return $rows;

		}

	}



	public function payStudentDues($data) {

		$moneyTransaction = $data["moneyTransaction"];
		$newTransactionId = "";
		$this->db->trans_start();

		$this->load->model('Moneytransaction_Model', 'moneyTransaction');
		$newTransactionId = $this->moneyTransaction->insert($moneyTransaction);

		$studentFees = $data["studentFees"];
		$studentItems = $data["studentItems"];

		if(!empty($studentFees)){
			//$this->load->model('Studentfee_Model', 'studentFee');
			foreach($studentFees as $sfKey => $studentFee){
				unset($studentFee["item"]);
				unset($studentFee["fee_type"]);
				unset($studentFee["student"]);
				$studentFee["transaction_id"] =$newTransactionId;
				$this->update($studentFee);
			}
		}

		if(!empty($studentItems)){
			$this->load->model('Studentitem_Model', 'studentItem');
			foreach($studentItems as $siKey => $studentItem){
				unset($studentItem["item"]);
				unset($studentItem["student"]);
				$studentItem["transaction_id"] =$newTransactionId;
				$this->studentItem->update($studentItem);
			}
		}



		// insert Discount if any
		if(isset($data["discountAmount"]) && is_numeric($data["discountAmount"]) && $data["discountAmount"] > 0 ){
			$this->load->model('Studentdiscount_Model', 'studentDiscount');
			$studentDiscount = array();
			$studentDiscount["transaction_id"]=$newTransactionId;
			$studentDiscount["discount_amount"] =$data["discountAmount"];
			$studentDiscount["orignal_amount"] = $moneyTransaction["amount"];
			$this->studentDiscount->insert($studentDiscount);
		}

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return get_app_message("response.failed");
		} else {
			return $newTransactionId;
		}

	}

	public function revertFee($studentFee, $sessionUser){

		unset($studentFee["fee_type"]);

		if(get_app_message("db.status.paid")==$studentFee["payment_status"]){
			return 	$this->revertPaidFee($studentFee, $sessionUser);
		}
		if(get_app_message("db.status.due")==$studentFee["payment_status"]){
			return 	$this->revertDueFee($studentFee, $sessionUser);
		}
	}

	public function revertPaidFee($studentFee, $sessionUser){
		$response ="";
		if(isset($studentFee["transaction_id"]) && !empty($studentFee["transaction_id"])){
			$this->load->model('Reverttransaction_Model', 'revertTransaction');
			$response =  $this->revertTransaction->revert($studentFee["transaction_id"], $sessionUser);

			if(get_app_message("response.success")==$response){
				$updateStudentFee = array();
				$updateStudentFee["transaction_id"] = $studentFee["transaction_id"];
				$updateStudentFee["payment_status"] = get_app_message("db.status.reverted");
					
				$this->updateByTransactionId($updateStudentFee);

				// update the Student Item Table against same Transaction ID if any
				$this->load->model('Studentitem_Model', 'studentItem');
				$studentItem = array();
				$studentItem["transaction_id"] = $studentFee["transaction_id"];
				$studentItem["payment_status"] = get_app_message("db.status.reverted");
				$this->studentItem->updateByTransactionId($studentItem);

			}
		}
		return $response;
	}
	public function revertDueFee($studentFee, $sessionUser){
		$response ="";
		$studentFee["payment_status"]= get_app_message("db.status.reverted");
		$response = $this->merge($studentFee);
		if($response==get_app_message ( "response.success" )){
			$response = get_app_message("response.success");
		}else{
			$response = get_app_message("response.failed");
		}

		return $response;
	}

}
