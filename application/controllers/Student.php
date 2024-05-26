<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Student extends Protected_Controller {

	public function __construct() {

		parent::__construct();


		if(!isAuthorizedController(get_class($this))){
			$_SESSION["appErrors"][]= get_app_message("unauthorized.user");
			redirect('/user/welcome');
		}
			


		$this->load->model('Student_Model', 'student');
		$this->load->model('Studentfee_Model', 'studentfee');
		$this->load->model('Guardian_Model', 'guardian');
		$this->load->model('Studentguardian_Model', 'studentGuardian');
		$this->load->model('Class_Model', 'class');
		$this->load->model('Feetype_Model', 'feeType');
		$this->load->model('Studentitem_Model', 'studentitem');
	}

	public function index($data =array()) {
			
		$classId = $this->input->get("class_id");
		if(empty($classId)){
			$students = $this->student->getByStatus(get_app_message("db.status.active"));
			$data["students"] = $students;
			// All guardians
			$studentIds = array();
			// fetch ids
			foreach($students as $st){
				$studentIds[]= $st["id"];
			}
			$guardians = $this->guardian->getByStuents($studentIds);
			$data["guardians"] = $guardians;
		}else{
			$data["selectedClassId"] = $classId;
			$students = $this->student->getByClass($classId);
			$data["students"] = $students;

			$studentIds = array();
			// fetch ids
			foreach($students as $st){
				$studentIds[]= $st["id"];
			}
			// Guardians of students for class selected

			$guardians = $this->guardian->getByStuents($studentIds);

			$data["guardians"] = $guardians;

		}
		$oldStudents = $this->student->getByStatus(get_app_message("db.status.inactive"));
		$data["oldStudents"] = $oldStudents;
			
			
		$classes = $this->class->get();
		$data["classes"] = $classes;
		
		$this->load->model('Certificate_Model', 'certificate');
		$certificates = $this->certificate->getByType("1");
		$data["certificates"] = $certificates; 
		 
		$this->template->load($this->activeTemplate, 'students/index', $data);
	}

	public function view($studentId = null) {
		$data= array();
		if($studentId==null){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect("/student");
			return;
		}

		$studentId = decodeID($studentId);
		$students = $this->student->get();
		$data["students"] = $students;

		$student = $this->student->get($studentId);
			
		// no record exist
		if(empty($student)){
			$data["appErrors"][] = get_app_message("no_record_found");
			$this->index($data);
			return;
		}
			
		$data["student"] = $student;
		// Related Guardians
		$guardians = $this->studentGuardian->getByStudentId($studentId);
		$data["guardians"] = $guardians;
			
			
		// Due Items for Student
		$items = $this->studentitem->getStudentItemsByStatus($studentId, "Due");
		$data["items"] = $items;
			
			
		//Due Fee for Student
		$studentFee = $this->studentfee->getByStudentByFeeStatus($studentId, "Due");
		$data["studentFee"] = $studentFee;

			
		// All  Items for Student
		$allItems = $this->studentitem->getStudentItems($studentId);
		$data["allItems"] = $allItems ;
			
			
		//All Fee for Student
		$allFee = $this->studentfee->getStudentFee($studentId);
		$data["allFee"] = $allFee;
			
		
		
		$this->load->model('Certificate_Model', 'certificate');
		$certificates = $this->certificate->getByType("1");
		$data["certificates"] = $certificates;
		
		
		
		
		$this->template->load($this->activeTemplate, 'students/view', $data);
			
	}
	public function quickView($id = null) {
		$data= array();
		if($id==null){
			$_SESSION["appErrors"][] = get_app_message("invalid_url");
			redirect("/student");
			return;
		}

		$studentId = decodeID($id);
		$students = $this->student->get();
		$data["students"] = $students;

		$student = $this->student->get($studentId);
			
		// no record exist
		if(empty($student)){
			$data["appErrors"][] = get_app_message("no_record_found");
			$this->index($data);
			return;
		}
			
		$data["student"] = $student;
		// Related Guardians
		$guardians = $this->studentGuardian->getByStudentId($studentId);
		$data["guardians"] = $guardians;
			
			
		// Due Items for Student
		$items = $this->studentitem->getStudentItemsByStatus($studentId, "Due");
		$data["items"] = $items;
			
			
		//Due Fee for Student
		$studentFee = $this->studentfee->getByStudentByFeeStatus($studentId, "Due");
		$data["studentFee"] = $studentFee;

			
		// All  Items for Student
		$allItems = $this->studentitem->getStudentItems($studentId);
		$data["allItems"] = $allItems ;
			
			
		//All Fee for Student
		$allFee = $this->studentfee->getStudentFee($studentId);
		$data["allFee"] = $allFee;
			
		$this->template->load($this->activeTemplate, 'students/quickView', $data);
			
	}




	public function savePayment(){

		$payments = $this->input->post('payment_for');


		$studentId = $this->input->post('student_id');
		$payment = $this->input->post('payment');
		$discount = $this->input->post('discount');
		$paidby = $this->input->post('paidby');
		$comments = $this->input->post('payment_comments');
		$remaingDues = $this->input->post('remaing_dues');

		// convert paymentFor json to relvent Objects
		$allPayments= json_decode($payments, true);


		$studentFees = array();
		$studentItems = array();

		if(!empty($allPayments)){
			foreach ($allPayments as $key=>$paymentFor){
				$paidByString = "";
				if(is_numeric($paidby)){
					$paidByGuardian = $this->studentGuardian->getByGuardianId($paidby);
					$paidByString =$paidByGuardian["id"]
					." - ". $paidByGuardian["name"]
					." - ". $paidByGuardian["relation"];
				}else{
					$paidByString = $paidby;
				}
					
				// updating the student_fee table
				if($paymentFor["type"]=="fee_detail"){
					$studentFee = $this->studentfee->get($paymentFor["id"]);
					$studentFee["payment_status"] = get_app_message("db.status.paid");
					$studentFee["paid_date"] = getCurrentDate();
					$studentFee["comments"] = $comments;
					$studentFee["paid_by"] = $paidByString;
					//$studentFee["amount"] = $payment;
					$studentFees[]=$studentFee;
					//$this->studentfee->merge($studentFee);
					//
				}
				// updating the student_item table
				if($paymentFor["type"]=="stationary_detail"){
					$studentItem = $this->studentitem->get($paymentFor["id"]);
					$studentItem["payment_status"] = get_app_message("db.status.paid");
					$studentItem["paid_date"] = getCurrentDate();
					$studentItem["comments"] = $comments;
					$studentItem["paid_by"] =$paidByString;
					$studentItems[]=$studentItem;
					//$this->studentitem->merge($studentItem);
				}
			}
			// add the arrears to student fee_item if any.
			 
			if($remaingDues > 0 ){
			    $feeType = $this->feeType->getByInternalKey("fee.arrears");
			    $feeDate = getCurrentDate();
			     
			    
			   
			    $this->studentfee->dueArrearsToStudents($feeType["id"], $studentId, $feeDate, $remaingDues);
			    
			}
			
			
		}



		if(is_numeric($payment) && $payment > 0){
			$transaction = array();
			$this->load->model('Moneytransaction_Model', 'moneyTransaction');
			$this->load->model('Transactiontype_Model', 'transactionType');
			$transactionType =$this->transactionType->getByKey("student.dues.clearance");
			$moneyTransaction = array();
			$moneyTransaction["transaction_type_id"]=$transactionType["id"];
			$moneyTransaction["created_at"]=getCurrentDateTime();
			$moneyTransaction["created_by"]=$_SESSION["sessionUser"]["id"];
			$moneyTransaction["updated_by"]=$_SESSION["sessionUser"]["id"];
			if($remaingDues > 0 ){
				$moneyTransaction["remaining_amount"]=$remaingDues;
				//$payment = $payment - $remaingDues;
			}
			$moneyTransaction["amount"] = $payment;
			$transaction["moneyTransaction"] = $moneyTransaction;
			$transaction["studentFees"]=$studentFees;
			$transaction["studentItems"]=$studentItems;
			$transaction["discountAmount"]=$discount;

			$transactionId= $this->studentfee->payStudentDues($transaction);
			if(is_numeric($transactionId)){
				
				$_SESSION["print_student_transaction"] = $transactionId;
				$_SESSION["appMessages"][] = get_app_message("request_processed_successfully");
				$this->sendAlertOnDuesClearance($transaction, $studentId);
				
				
			} else {
				$_SESSION["appErrors"][] = get_app_message("cannot_process_request");
			}

		}else{
			$_SESSION["appErrors"][] = get_app_message("paid_amount_is_0");
		}


		//redirect('/student/view/'.encodeID($studentId));
		redirect('/student/defaulters');

	}

	
	
	private function sendAlertOnDuesClearance($transaction, $studentId){
		if(empty($transaction) || empty($studentId)){
			return;
		}
		
		$student = $this->student->get($studentId);
		$gEmails = $this->guardian->getEmailAddresses(null, $studentId);
		$addresses = array();
		if(!empty($student) && !empty($student["email"])){
			$addresses[] = $student["email"];
		}
		if(!empty($gEmails)){
			foreach ($gEmails as $email){
				$addresses[] = $email["email"];
			}
		}
		
		$studentName = $student["first_name"]." ".$student["last_name"];
		$amount = $transaction["moneyTransaction"]["amount"];
		$today = getCurrentDate();
		 
		
		$addresses= array_unique($addresses);
		$campusDetails = $_SESSION["currentCampus"]["campus_name"];
		$emailData= array();
		
		
		$emailData["email_subject"]="Attendance Alert";
		
		
		$emailData["email_body"]="Sir/Madam,
						<br/>
						<br/>
						We have received amount of $amount(Rs) against $studentName's dues on $today.
						
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
						generateAlertOnEvent(null, $addresses, $emailData);
						
		
	}
	

	public function revertStudentFeeForm($data = array()){
		$studentFeeId = $this->input->get("id");
		$studentFee= array();
		$studentFee = $this->studentfee->get($studentFeeId);
		$data["studentFee"] = $studentFee;

		$this->template->load($this->activeTemplate, 'students/revert_fee_form', $data);

	}
	public function revertStudentFee($data = array()){
		$studentFeeId = $this->input->post("student_fee_id");
		$studentFee= array();
		$studentFee = $this->studentfee->get($studentFeeId);

		$studentId = $studentFee["student_id"];
		$response = $this->studentfee->revertFee($studentFee, $_SESSION["sessionUser"]);

		if($response ==get_app_message("response.success")){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/student/view/'.$studentId);
	}

	public function edit($id=""){
		$data = array();
		if(!empty($id)){
			$id = decodeID($id);
			$student = $this->student->get($id);
			 
			$data["student"] = $student;
		}
		// get All Classes For DropDown
		$classes = $this->class->get();
		$data["classes"]=$classes;

		$feeTypes = $this->feeType->get();
		$data["feeTypes"]=$feeTypes;
		$this->template->load($this->activeTemplate, 'students/add_update_form', $data);
	}


	public function save($data= array()){
		$student=array();
		$id = $this->input->post('id');
		if(!empty($id)){
			$student["id"] = $id;
		}
		$student["first_name"]= $this->input->post('student_first_name');
		$student["last_name"]= $this->input->post('student_last_name');
		$student["father_name"]= $this->input->post('student_father_name');
		$student["roll_no"]= $this->input->post('student_rollno');
		$student["reg_no"]= $this->input->post('student_registration_no');
		$student["gender"]= $this->input->post('student_gender');
		$student["date_of_birth"]= $this->input->post('student_date_of_birth');
		$student["address"]= $this->input->post('student_address');
		$student["class_id"]= $this->input->post('student_class');
		$student["email"]= $this->input->post('student_email');
		
		$sibling_discount = $this->input->post('sibling_discount');
		$sibling_discount_type = $this->input->post('sibling_discount_type');
		$sibling_discount_fee_type = $this->input->post('sibling_discount_fee_type');
		
		if(!empty($sibling_discount) && !empty($sibling_discount_type) && !empty($sibling_discount_fee_type)){
		    if($sibling_discount <= 100){
		        $sibling_discount_type = "%";
		    }else{
		        $sibling_discount_type = "Fixed";
		    }
		    
		    $student["sibling_discount"]= $sibling_discount;
		    $student["sibling_discount_type"] = $sibling_discount_type;
		    $student["sibling_discount_fee_type"] = $sibling_discount_fee_type;
		    
		    
		}

		$status = $this->input->post('student_status');

		if(!empty($status)){
			$student["status"] = $status;
		}else{
			$student["status"] = get_app_message("db.status.inactive");
		}

		$admissionDate = $this->input->post('student_admission_date');
		$student["admission_date"]= $admissionDate;
			

		$response = $this->student->merge($student);




		if(is_numeric($response) || $response ==get_app_message ( "response.success" )){

			// double call for update b/c of id does not exist in case of new Student.
			$picPath = $this->input->post ( "student_image_path" );
			if (! empty ( $picPath )) {
				$filePostFix = get_random_string()."stu-pic";
				if($response == get_app_message ( "response.success" )){
					$filePostFix= encodeID($student["id"])."stu-pic";
				}else{
					$student["id"] = $response;
					$filePostFix= encodeID($student["id"])."stu-pic";
				}

				// replace current profile pic with temp one. and delete from temp
				$absolutePath = ImageFileUpdateWithTemp ( $picPath , $filePostFix );
				$student ["student_picture"] = $absolutePath;

				// 2nd call to DB
				$response = $this->student->merge($student);
				if($response !=get_app_message ( "response.success" )){
					$_SESSION["appErrors"][]= get_app_message("Cannot save the Student Picture. Please try again. later.");
				}
			}




			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect('/student');

	}


	public function unrollForm($data = array()){
		// get All Classes For DropDown

		$id =  $this->input->get("id");
		if(!empty($id)){
			$student = $this->student->get($id);
			$data["student"]=$student;

		}
		$this->template->load($this->activeTemplate, 'students/student_unroll_form', $data);
	}
	public function unroll($data = array()){
		// get All Classes For DropDown

		$id =  $this->input->post("student_id");

		if(!empty($id)){
			$student = $this->student->get($id);
			unset($student["class"]);
			$student["status"]="In Active";
			$student["unroll_date"] = getCurrentDate();
			$response = $this->student->merge($student);
			if($response ==get_app_message ( "response.success" )){
				$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
			}else{
				$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			}
		}else{
			$_SESSION["appErrors"][]= get_app_message("invalid_url");
		}

		redirect('/student');
	}



	public function promoteStudents($data = array()){

		$classId = $this->input->get("class_id");
		if(empty($classId)){
			$classId = $this->input->post("class_id");
		}
		if(!empty($classId)){
			$selectedClass = $this->class->get($classId);
			$data["selectedClass"]=$selectedClass;
		}

		$classes = $this->class->get($classId);
		$data["classes"] = $classes;

		$this->template->load($this->activeTemplate, 'students/promote_students', $data);

	}


	public function promoteStudentsConfirmForm($data = array()){

		$classFromId = $this->input->post("class_from_id");
		$classToId = $this->input->post("class_to_id");
		$studentIds = $this->input->post("promote_student_multiple_students");
		$studentsToBePromoted = array();
		$classFrom = array();
		$classTo = array();
		$toClassExistingStudents = array();

		if(!empty($studentIds)){
			$studentsToBePromoted = $this->student->getByIds($studentIds);
			$data["studentsToPromoteIds"] =  implode(',', $studentIds);
		}

		if(!empty($classFromId)){
			$classFrom = $this->class->get($classFromId);
		}

		if(!empty($classToId)){
			$classTo = $this->class->get($classToId);
		}

		if(!empty($classToId)){
			$toClassExistingStudents = $this->student->getByClass($classToId);
		}

		$data["studentsToBePromoted"] = $studentsToBePromoted;
		$data["classFrom"] = $classFrom;
		$data["classTo"] = $classTo;
		if(!empty($toClassExistingStudents)){
			$data["toClassExistingStudents"] = $toClassExistingStudents;
		}

		$data["promoteFromClassId"] = $classFromId;
		$data["promoteToClassId"] = $classToId;


		$this->template->load($this->activeTemplate, 'students/promote_students_confirm_form', $data);

	}

	public function processStudentPromotion($data = array()){

		$classFromId = $this->input->post("class_from_id");
		$classToId = $this->input->post("promote_to_class_id");
		$studentIdsSTR = $this->input->post("students_to_promote_ids");
		$studentIds = explode(",", $studentIdsSTR);

		if(empty($classFromId) || empty($classToId) || empty($studentIds)){
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
			redirect('/student/promoteStudents');
		}

		if($classFromId == $classToId){
			$_SESSION["appErrors"][]= get_app_message("current.and.to.class.not.different");
			redirect("/student/promoteStudents");
		}


		$response = $this->student->promoteStudentsToClass($studentIds, $classToId);
		if($response == get_app_message("response.success")){
			$_SESSION["appMessages"][]= get_app_message("request_processed_successfully");
		}else{
			$_SESSION["appErrors"][]= get_app_message("cannot_process_request");
		}
		redirect("/student/promoteStudents");
	}



	public function getStudentsByClass(){

		$classId = $this->input->get("class_id");
		if(is_numeric($classId)){
			$studentsJson = $this->student->getStudentsJSON($classId);
			echo $studentsJson;
		}
		echo "";
	}

	public function getAutoComplete() {
		$params["q"] = $this->input->get("q");
		$params["callback"] = $this->input->get("callback");
		$result =  $this->student->getAutocomplete($params);

		echo $result;
	}


	public function getStudentsByFeeDate(){
		$feeTypeId = $this->input->get("fee_type_id");
		$classId = $this->input->get("class_id");
		$dueFeeDate = $this->input->get("due_fee_date");
		$studentsJson = $this->student->getByFeeDateByClassByFeeType($dueFeeDate,$classId, $feeTypeId);
		echo $studentsJson;
	}

	public function studentsJSON($data=array()){
		$classId = $this->input->get("class_id");
		$studentsJSON = $this->student->getStudentsJSON($classId);
		echo $studentsJSON;
	}


	public function defaulters(){
		$campusId=$_SESSION["currentCampus"]["id"];
		$studentDueFee = $this->studentfee->getByPaymentStatus($campusId, get_app_message("db.status.due"));
		$studentDueItems = $this->studentitem->getByPaymentStatus($campusId, get_app_message("db.status.due"));
		//pre($studentDueFee);

		$defaulters = array();
		if(!empty($studentDueFee)) {
			$feeSum = 0;
			foreach($studentDueFee as $dueFee) {
				$defaulters = $this->addDefaulter($defaulters, $dueFee, "dueFee");
			}
		}
		if(!empty($studentDueItems)){
			$feeSum = 0;
			foreach($studentDueItems as $dueItem){
				$defaulters = $this->addDefaulter($defaulters, $dueItem, "dueItem");
			}
		}

		$data["defaulters"] = $defaulters;
		
		$action = $this->input->get("action");
		$data["action"] = $action;
		
		
		return parent::loadView('students/defaulters', $data);
		
	}
	
	public function clear_in_bulk_confirm(){
		 $studentIds = $this->input->get("sids");
		$data =array();
		 if(!empty($studentIds)){
    		 $campusId=$_SESSION["currentCampus"]["id"];
    		 $studentDueFee = $this->studentfee->getByPaymentStatusAndStudents($campusId,$studentIds, get_app_message("db.status.due"));
    		 $studentDueItems = $this->studentitem->getByPaymentStatusAndStudents($campusId,$studentIds, get_app_message("db.status.due"));
    		 //pre($studentDueFee);
    		 
    		 $defaulters = array();
    		 if(!empty($studentDueFee)) {
    		     $feeSum = 0;
    		     foreach($studentDueFee as $dueFee) {
    		         $defaulters = $this->addDefaulter($defaulters, $dueFee, "dueFee");
    		     }
    		 }
    		 if(!empty($studentDueItems)){
    		     $feeSum = 0;
    		     foreach($studentDueItems as $dueItem){
    		         $defaulters = $this->addDefaulter($defaulters, $dueItem, "dueItem");
    		     }
    		 }
    		 
    		 $data["defaulters"] = $defaulters;
    		 
    		 $data["studentIds"] = $studentIds;
		 
		 }
		 return parent::loadView('students/bulk_confirmation', $data);
	}
	
	public function process_bulk_clearance(){
	    
	    $studentIdsStr = $this->input->post("sids");
	    $studentIds= explode(',', $studentIdsStr);
	     
	    $sFeeIds = $this->input->post("sfeeids");
	    $sItemIds = $this->input->post("sitemids");
	    $successCount =0;
	    $failCount =0;
	    $transactionIds = "0";
	    $campusId=$_SESSION["currentCampus"]["id"];
	   
	    
	    $this->load->model('Moneytransaction_Model', 'moneyTransaction');
	    $this->load->model('Transactiontype_Model', 'transactionType');
	    $transactionType =$this->transactionType->getByKey("student.dues.clearance");
	    
	   
	    
        foreach ($studentIds as $sid){
    	    
    	    $studentFees = array();
    	    $studentItems = array();
    	    $amount =0;
    	    $studentDueFee = $this->studentfee->getByPaymentStatusAndStudents($campusId, $sid, get_app_message("db.status.due"));
    	    $studentDueItems = $this->studentitem->getByPaymentStatusAndStudents($campusId, $sid , get_app_message("db.status.due"));
    	   
    	    if(!empty($studentDueFee)){
        	    
        	   
        	    
    	        foreach ($studentDueFee as $fKey=> $studentFee ){
        	       // $studentFee = $this->studentfee->get($sFeeId);
    	            $studentFee["payment_status"] = get_app_message("db.status.paid");
    	            $studentFee["paid_date"] = getCurrentDate();
    	            $studentFee["comments"] = "Processed in bulk";
    	            $studentFee["paid_by"] = "Processed in bulk";
    	            $studentFees[]=$studentFee;
    	            $amount = $amount + $studentFee["amount"];
    	        }
    	    }
    	   
    	    if(!empty($studentDueItems)){
    	        
    	        foreach ($studentDueItems as $iKey=> $studentItem ){
    	           // $studentItem = $this->studentitem->get($sItemId);
        	        $studentItem["payment_status"] = get_app_message("db.status.paid");
        	        $studentItem["paid_date"] = getCurrentDate();
        	        $studentItem["comments"] = "Processed in bulk";
        	        $studentItem["paid_by"] = "Processed in bulk";
        	        $studentItems[]=$studentItem;
        	        $amount = $amount + $studentItem["amount"];
    	        }
    	    }
    	    
    	    
    	    
    	    if(!empty($studentFees) || !empty($studentItems)) {
    	            
    	            $paidByString = "Processed in Bulk";
    	               
    	            $transaction = array();
    	            $moneyTransaction= array();
    	            $moneyTransaction["amount"]=$amount;
    	            $moneyTransaction["transaction_type_id"]=$transactionType["id"];
    	            $moneyTransaction["created_at"]=getCurrentDateTime();
    	            $moneyTransaction["created_by"]=$_SESSION["sessionUser"]["id"];
    	            $moneyTransaction["updated_by"]=$_SESSION["sessionUser"]["id"];
    	            $transaction["moneyTransaction"]=$moneyTransaction;
    	            $transaction["studentFees"]=$studentFees;
    	            $transaction["studentItems"]=$studentItems;
    	            $transaction["discountAmount"]=0;
    	            
    	            $transactionId = $this->studentfee->payStudentDues($transaction);
    	           
    	            if( is_numeric($transactionId)){
    	            	$transactionIds .= "_".$transactionId;
    	                $successCount ++;
    	                
    	                $this->sendAlertOnDuesClearance($transaction, $sid);
    	                
    	                
    	                
    	            }else{
    	              $failCount ++;
    	            }
    	      //  }
    	    }
        }
	    
	    if($successCount > 0){
	        $_SESSION["appMessages"][] = $successCount ." dues have been processed successfully.";
	        $_SESSION["print_student_transactions"] = $transactionIds;
	    }
	    if($failCount > 0){
	        $_SESSION["appErrors"][] = $failCount ." dues processing failed.";
	    }
	     
	   // pre($_SESSION["appMessages"]);
	   // pre_d($_SESSION["appErrors"]);
	    redirect('/student/defaulters');
	     
	    
	    
	    
	}

	private function alreadyExist($defaulters, $student){
		$result = array();
		$result["isExist"] = false;
		foreach($defaulters as $key => $defaulter){
			if($defaulter["id"] == $student["id"]){
				$result["isExist"] = true;
				$result["index"] = $key;
				break;
			}
		}
		return $result;
	}

	private function addDefaulter($defaulters, $dues, $duesType){
		$result = $this->alreadyExist($defaulters, $dues["student"]);
		
		if($result["isExist"]){
			unset($dues["student"]);
			$defaulters[$result["index"]][$duesType][] = $dues;
		}else{
			$defaulter = $dues["student"];
			unset($dues["student"]);
			$defaulter[$duesType][]= $dues;
			$defaulters[]= $defaulter;
		}
		return $defaulters;
	}

	public function dues(){
		$campusId=$_SESSION["currentCampus"]["id"];
		$studentDueFee = $this->studentfee->getByPaymentStatus($campusId, get_app_message("db.status.due"));
		$studentDueItems = $this->studentitem->getByPaymentStatus($campusId, get_app_message("db.status.due"));


		$data["studentDueFee"] = $studentDueFee;
		$data["studentDueItems"] = $studentDueItems;

		$this->template->load($this->activeTemplate, 'students/dues', $data);

	}

	public function test($seg1=""){
		$data = array();
		$this->template->load($this->activeTemplate, 'encryption', $data);

		//$classId = $this->input->get("class_id");


	}


}
