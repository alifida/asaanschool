<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	include_once('Base_Controller.php');
class Welcome extends Base_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 *
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		//redirect("user/login");
		$this->load->view(  'asaanschool/index' );
		 
	}
	public function pricing() {
		$this->load->model ( 'Countriesip_Model', 'countriesIp' );
		$this->load->model ( 'Package_Model', 'package' );
		
		$data = array ();
		
		
		
		
		$status = get_app_message("db.status.active");
		//pre(getClientCountry($this));
		$packages = $this->package->getCountryWise(null, $status,getClientCountry());
		$data["packages"]=$packages;
		
		//pre_d($packages);
		$this->load->view(  'asaanschool/pricing', $data );
	}
	public function about() {
		$data = array ();
		$this->load->view(  'asaanschool/about', $data );
	}
	public function quick_tour() {
		$data = array ();
		$this->load->view(  'asaanschool/quick_tour', $data );
	}
	public function demo() {
		$data = array ();
		$this->load->view(  'asaanschool/demo', $data );
	}

	public function payments() {
		$data = array ();
		$data["message_title"]="Payment Methods";
		$data["message_body"]="We only accept the payments by following methods.";
		$bankDetails = array();
		$bankDetails["account_no"] = get_app_message("organization.bank.account.no");
		$bankDetails["account_title"] = get_app_message("organization.bank.account.title");
		$bankDetails["bank_branch"] = get_app_message("organization.bank.account.branch");
		$bankDetails["bank_branch_code"] = get_app_message("organization.bank.account.branch.code");
		$bankDetails["bank"] = get_app_message("organization.bank.account.bank");
		$data["bank_details"] = $bankDetails;
		
		$easyPaisa["title"] = "Easy Paisa";
		$easyPaisa["message"] = "Visit Easypaisa outlet and provide the info";
		$easyPaisa["cnic"] = get_app_message("organization.easypaisa.cnic");
		$easyPaisa["name"] = "Ali Fida";
		$easyPaisa["cell"] = get_app_message("organization.easypaisa.cell");
		$data["easy_paisa"] = $easyPaisa;

		
		$mobicash["title"] = "Mobicash";
		$mobicash["message"] = "Visit Mobilink franchise, Business Center";
		$mobicash["cnic"] = get_app_message("organization.easypaisa.cnic");
		$mobicash["name"] = "Ali Fida";
		$mobicash["cell"] = get_app_message("organization.easypaisa.cell");
		$data["mobicash"] = $mobicash;

		
		
		
		$this->load->view(  'asaanschool/payment_methods', $data );
	}
	
	public function sendEmail() {
		$response = array ();
		$sendername = @trim ( stripslashes ( $this->input->post ( 'name' ) ) );
		$email = @trim ( stripslashes ( $this->input->post ( 'email' ) ) );
		$subject = "Message From Asaanschool User";
		$message = @trim ( stripslashes ( $this->input->post ('message') ) );
		$isFormValid = true;
		if(empty($sendername) || empty($email) ||  empty($message)){
			$response ["message"] = "Please provide all the fields.";
			$isFormValid = false;
		}elseif(strpos($email,'@') === false){
			$response ["message"] = "Please Provide a valid Email Address";
			$isFormValid = false;
		}

		if($isFormValid){
			$email_from = $email;
			$email_to = get_app_message ( "admin.email.address" );
			$email_cc = get_app_message ( "admin.email.address2" );
			
			$message = "<br/><span style='color: #fff;background-color: #2A8FC5;border-color: #d43f3a; padding: 20px'>Asaanschool user has sent you the following message.</span><br/><br/><br/><br/>" . $message;
			// $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;
			
			$headers = 'To: Asaanschool <' . $email_to . '>' . "\r\n";
			$headers .= 'From: ' . $sendername . ' <' . $email_from . '>' . "\r\n";
			$headers .= 'Cc: Asaanschool <' . $email_cc . '>' . "\r\n";
			
			$meta = "";
			$meta .= "<b>Meta Info</b>";
			$meta .= "<br/>";
			$meta .= 'To: Asaanschool (' . $email_to . ')';
			$meta .= 'From: ' . $sendername . ' (' . $email_from . ')' ;
			$meta .= 'Cc: Asaanschool (' . $email_cc . ')' ;
			
			
			
			$message .= "<br/><br/><div style='color: #fff;background-color: #d43f3a; padding: 10px'>".$meta."</div><br/><br/>";
			
			$res = sendEmail ( $email_to, $subject = "", $message, $headers );
			
			if ($res == true) {
				$response ["message"] = "Your message has been sent to the Administration. You will be contacted soon.";
			} else {
				$response ["message"] = get_app_message ( "cannot_process_request" );
			}
		}
		echo json_encode ( $response );
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */