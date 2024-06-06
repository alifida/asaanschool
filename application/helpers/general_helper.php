<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! function_exists ( 'getRandomColorCode' )) {
	function getRandomColorCode() {
		// $colorCodes = array("#BC3C6D", "#1A7B0F", "#E8A832", "#0E34AB", "#830EAB", "#FF2700","#B29D13" ,"#527761", "#932AB6", "#BD81EC","#00c0ef", "#00a65a", "#f39c12", "#f56954", "#0073b7", "#932ab6","#39cccc" ,"#85144b");
		$colorCodes = array (
				"#00c0ef",
				"#00a65a",
				"#f39c12",
				"#f56954",
				"#0073b7",
				"#932ab6",
				"#39cccc",
				"#85144b" 
		);
		$randomKey = array_rand ( $colorCodes, 1 );
		return $colorCodes [$randomKey];
	}
}

if (! function_exists ( 'getRandomWidgetClass' )) {
	function getRandomWidgetClass() {
		$classes = array (
				"bg-aqua",
				"bg-light-blue",
				"bg-navy",
				"bg-green",
				"bg-yellow",
				"bg-red",
				"bg-blue",
				"bg-purple",
				"bg-teal",
				"bg-maroon" 
		);
		$randomKey = array_rand ( $classes, 1 );
		return $classes [$randomKey];
	}
}

if (! function_exists ( 'sendEmailVerificationCode' )) {
	function sendEmailVerificationCode($data, $code) {
		$sendername = get_app_message ( "sender.email.display.name" );
		$from = get_app_message ( "sender.email.address" );
		$to = $data ["email"];
		$toName = $data ["school_name"];
		$subject = "Asaan School Sign-up Email Verification";
		$message = "Hi " . $data ["school_name"] . ",";
		$message = $message . "<br/><br/> We have got a signup request for your email i.e. <b>" . $data ["email"] . "</b>";
		$message = $message . "";
		$message = $message . "<br/><br/> Your email Verification Code is: <br/><br/><br/>";
		$message = $message . "<span style='color: #fff;background-color: #3c8dbc;border-color: #367fa9; height: 30px; padding: 20px;'><b>" . $code . "</b></span><br/>";
		// vpt stands for verify password token.
		$message = $message . "<br/><br/>In order to register, please paste this code to the signup form.<br/><br/>";
		$message = $message . "";
		$message = $message . "<br/>This link will be valid for a very short time. ";
		$message = $message . "<br/><b>Regards</b><br/>";
		$message = $message . "<br/><b>Admin</b>";
		$message = $message . "<br/>" . site_url ();
		$message = $message . "<br/> <br/><h3><span style='color: #fff;background-color: #e36957;border-color: #d43f3a; height: 30px; padding: 20px;'>Please ignore the email if you do not want to register with <a href='" . site_url () . " target='blank'>Asaanschool</a> </span></h3><br/> ";
		
		// echo $message;
		
		// $headers = 'MIME-Version: 1.0' . "\r\n";
		// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
		// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		//
		// For Multiple users...
		// $headers .= 'To: Mary <example@emai.com>, Kelly <kelly@example.com>' . "\r\n";
		$headers = 'To: ' . $toName . ' <' . $to . '>' . "\r\n";
		$headers .= 'From: ' . $sendername . ' <' . $from . '>' . "\r\n";
		
		return sendEmail ( $to, $subject, $message, $headers );
		//return send_email_by_mailgun($to, $subject, $message, $headers);
		
		// $result = mail($to, $subject, $message, $headers);
		// return $result;
	}
}

if (! function_exists ( 'sendEmailAlertToUser' )) {
	function sendEmailAlertToUser($emailData) {
		$sendername = get_app_message ( "sender.email.display.name" );
		$from = get_app_message ( "sender.email.address" );
		
		$to = get_app_message ( "admin.email.address" );
		;
		$toName = get_app_message ( "sender.email.display.name" );
		
		$subject = $emailData ["email_subject"];
		
		$message = $emailData ["email_body"];
		
		// For Multiple users...
		// $headers .= 'To: Mary <example@emai.com>, Kelly <kelly@example.com>' . "\r\n";
		$headers = 'Cc: ' . get_app_message ( "sender.email.display.name" ) . ' <' . get_app_message ( "admin.email.address2" ) . '>, ' . get_app_message ( "sender.email.display.name" ) . ' <' . get_app_message ( "admin.email.address3" ) . '>' . "\r\n";
		$headers .= 'To: ' . $toName . ' <' . $to . '>' . "\r\n";
		$headers .= 'From: ' . $sendername . ' <' . $from . '>' . "\r\n";
		
		// $result = mail($to, $subject, $message, $headers);
		return sendEmail ( $to, $subject, $message, $headers );
		// return $result;
	}
}

if (! function_exists ( 'sendPasswordResetToken' )) {
	function sendPasswordResetToken($user, $token) {
		$sendername = get_app_message ( "sender.email.display.name" );
		$from = get_app_message ( "sender.email.address" );
		$to = $user ["email"];
		$toName = $user ["display_name"];
		$subject = "Password Reset Request";
		$message = "Hi " . $user ["display_name"] . ",";
		$message = $message . "<br/><br/> We have got your password Reset Request. If you have not generated this request, Please ignore this email, your password will not be changed.<br/>";
		$message = $message . "If you want to Reset your password Please click the following link.<br/>";
		// vpt stands for verify password token.
		$message = $message . "<br/><b><a href='" . site_url () . "resetpassword/vpt/" . $token . "' target='_blank'>Click here</a></b><br/><br/>";
		$message = $message . "";
		$message = $message . "<br/>This link will be valid for a very short time. ";
		$message = $message . "<br/><b>Regards</b><br/>";
		$message = $message . "<br/><b>Admin</b>";
		$message = $message . "<br/>" . site_url ();
		$message = $message . "<br/> <br/><h3><span style='color: #fff;background-color: #e36957;border-color: #d43f3a; height: 30px; padding: 20px;'>It is strongly recommended to change your password after login. </span></h3><br/> ";
		
		// echo $message;
		
		// $headers = 'MIME-Version: 1.0' . "\r\n";
		// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
		// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		//
		// For Multiple users...
		// $headers .= 'To: Mary <example@emai.com>, Kelly <kelly@example.com>' . "\r\n";
		$headers = 'To: ' . $toName . ' <' . $to . '>' . "\r\n";
		$headers .= 'From: ' . $sendername . ' <' . $from . '>' . "\r\n";
		
		return sendEmail ( $to, $subject, $message, $headers );
		
		// $result = mail($to, $subject, $message, $headers);
		// return $result;
	}
}

if (! function_exists ( 'getRandomString' )) {
	function getRandomString() {
		$length = 20;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = "";
		for($i = 0; $i < $length; $i ++) {
			$randomString .= $characters [rand ( 0, strlen ( $characters ) - 1 )];
		}
		return $randomString;
	}
}

if (! function_exists ( 'sendNewPasswordToUser' )) {
	function sendNewPasswordToUser($user) {
		$sendername = get_app_message ( "sender.email.display.name" );
		$from = get_app_message ( "sender.email.address" );
		
		$to = $user ["email"];
		$toName = $user ["display_name"];
		$subject = "Password has been Changed.";
		$message = "Hi " . $user ["display_name"] . ",";
		$message = $message . "<br/><br/> Your password has been changed successfully. <br/>";
		$message = $message . "Your new password is: <br/>";
		$message = $message . $user ["password"];
		// vpt stands for verify password token.
		
		$message = $message . "<br/><b> Please <a href='" . site_url () . "/user/login' target='_blank'>Click here</a> to login.</b><br/><br/>";
		$message = $message . "";
		$message = $message . "<br/><h3><span style='color: #fff;background-color: #d9534f;border-color: #d43f3a;'>It is strongly recommended to change your password after login. </span></h3><br/> ";
		$message = $message . "<br/><b>Regards</b><br/>";
		$message = $message . "<br/><b>Admin</b>";
		$message = $message . "<br/>" . site_url ();
		
		// For Multiple users...
		// $headers .= 'To: Mary <example@emai.com>, Kelly <kelly@example.com>' . "\r\n";
		$headers = 'To: ' . $toName . ' <' . $to . '>' . "\r\n";
		$headers .= 'From: ' . $sendername . ' <' . $from . '>' . "\r\n";
		
		// $result = mail($to, $subject, $message, $headers);
		return sendEmail ( $to, $subject, $message, $headers );
		// return $result;
	}
}

if (! function_exists ( 'setTrailNotification' )) {
	function setTrailNotification() {
		
		unset ( $_SESSION ["trailNotification"] );
		if (isset ( $_SESSION ["currentCampus"] ["school"] ["status"] )) {
			
			if ($_SESSION ["currentCampus"] ["school"] ["status"] == get_app_message ( "db.status.trail" )) {
				$startDate = convertMySQLDateTimeToDate ( $_SESSION ["currentCampus"] ["school"] ["created_at"] );
				$today = getCurrentDate ();
				$trailLeft = 30 - getDateDifference ( $startDate, $today );
				
				if ($trailLeft > - 1) {
					// $activationURL = site_url("admin/activiateAccountForm");
					$activationURL = "load_remote_model(\"" . site_url ( 'admin/activiateAccountForm' ) . "\",\"Activate Account\");";
					
					$_SESSION ["trailNotification"] = get_app_message ( "app.trail.message" ) . " (" . $trailLeft . " days left). Click <b><a href='javascript:void(0);' onclick='" . $activationURL . "'>here </a></b>to activate your account.";
					// pre_d($_SESSION["trailNotification"]);
				} else {
					$_SESSION ["trailNotification"] = get_app_message ( "app.expired.message" );
					$_SESSION ["appNotifications"] ["trail"] = get_app_message ( "app.expired.message" );
					$_SESSION ["currentCampus"] ["school"] ["status"] = get_app_message ( "db.status.expired" );
					
					$activationURL = "load_remote_model(\"" . site_url ( 'user/activiateAccountForm' ) . "\",\"Activate Account\");";
					$_SESSION ["appNotifications"] ["trail"] = get_app_message ( "app.expired.message" ) . " Click <b><a href='javascript:void(0);' onclick='" . $activationURL . "'> here </a></b>to activate your account.";
				}
			} else {
				validateLicense ();
			}
		}
	}
}



if (! function_exists ( 'getEmailGroups' )) {
	function getEmailGroups() {
		$groups = array("all_employees"=>"All Employees", "all_guardians"=>"All Guardians", "all_students"=>"All Students");
		$CI = & get_instance ();
		$CI->load->database ();
		$CI->load->model ( 'Class_Model', 'class' );
		$classes = $CI->class->get();
		if(!empty($classes)){
			 
			foreach ($classes as $cls){
				$groups[$cls["id"]."_guardians"] = "All Guardians of ".$cls["name"];
				$groups[$cls["id"]."_students"] = "All Students of ".$cls["name"];
			}
		}
		return $groups;
	}
}
if (! function_exists ( 'getLastestInvoice' )) {
	function getLastestInvoice() {
		$latestInvoice = array ();
		$CI = & get_instance ();
		$CI->load->database ();
		$CI->load->model ( 'Invoice_Model', 'invoice' );
		$rs = $CI->invoice->getLatestByCampus ( $_SESSION ["currentCampus"] ["id"], "invoice_expiry_date" );
		if (! empty ( $rs )) {
			$latestInvoice = $rs [0];
		}
		return $latestInvoice;
	}
}
if (! function_exists ( 'getCampusCurrentPackage' )) {
	function getCampusCurrentPackage() {
		$currentCampus = $_SESSION ["currentCampus"];
		$campusCurrentPackage = array ();
		$CI = & get_instance ();
		$CI->load->database ();
		$CI->load->model ( 'Campuspackage_Model', 'campusPackage' );
		$rs = $CI->campusPackage->getByStatus ( $currentCampus ["id"], get_app_message ( "db.status.active" ) );
		
		if (! empty ( $rs )) {
			$campusCurrentPackage = $rs [0];
		}
		return $campusCurrentPackage;
	}
}

if (! function_exists ( 'validateLicense' )) {
	function validateLicense() {
		
		$today = getCurrentDate ();
		unset ( $_SESSION ["licenseNotification"] );
		$currentCampus = $_SESSION ["currentCampus"];
		$campusCurrentPackage = getCampusCurrentPackage ();
		if (empty ( $campusCurrentPackage )) {
			$_SESSION ["license"] ["status"] = get_app_message ( "db.status.expired" );
			$_SESSION ["appNotifications"] ["licenseExpired"] = "Please Choose the Package First.";
			return;
		}
		$_SESSION ["campusCurrentPackage"] = $campusCurrentPackage;
		// variables
		$packageDurationMonths = $campusCurrentPackage ["package"] ["duration_months"];
		
		
		$lastInvoiceDate;
		$lastDueDate;
		$lastExpiryDate;
		
		$newInvoiceDate;
		$newDueDate;
		$newExipryDate;
		if (isset ( $currentCampus ["school"] ["status"] )) {
			if ($currentCampus ["school"] ["status"] == get_app_message ( "db.status.licenced" )) {
				$latestInvoice = getLastestInvoice ();
				//pre_d($latestInvoice);
				if (! empty ( $latestInvoice )) {
					$lastInvoiceDate = convertMySQLDateTimeToDate ( $latestInvoice ["invoice_date"] );
					$lastDueDate = convertMySQLDateTimeToDate ( $latestInvoice ["due_date"] );
					$lastExpiryDate = convertMySQLDateTimeToDate ( $latestInvoice ["invoice_expiry_date"] );
				}
				
				if (empty ( $latestInvoice )) {
					// if no invoice so far then generate new invoice with due_date = TODAY
					$newInvoiceDate = $today;
					$newDueDate = $today;
					$newExipryDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $today ) ) );
					
					$invoiceId = generateInvoice ( $newInvoiceDate, $newDueDate, $newExipryDate );
					
					if ($invoiceId == null) {
						return expireLogin ();
					} else {
						validateLicense ();
					}
				} elseif ($latestInvoice ["status"] == get_app_message ( "db.status.expired" )) {
					// generate Invoice with Expiry_date, with Due_date and GenerateDate.
					
					$newInvoiceDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $lastInvoiceDate ) ) );
					$newDueDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $lastDueDate ) ) );
					$newExipryDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $lastExpiryDate ) ) );
					
					if(new DateTime () <= new DateTime ( $newDueDate )){
						$newDueDate = $today;
					}
					
					$invoiceId = generateInvoice ( $newInvoiceDate, $newDueDate, $newExipryDate );
					
					if ($invoiceId == null) {
						return expireLogin ();
					} else {
						validateLicense ();
					}
				} elseif (isPastDate ( $lastExpiryDate )) {
					// generate Invoice
					$latestInvoice ["status"] = get_app_message ( "db.status.expired" );
					
					updateInvoiceStatus ( $latestInvoice );
					validateLicense ();
				} elseif ($latestInvoice ["status"] == get_app_message ( "db.status.due" )) {
					
					/**
					 * 1- if due_date is past
					 * then stop login
					 *
					 * 2- elseif expiry_date is past
					 * then update status=EXPIRED and call validateLicense() again
					 *
					 * 3- else
					 * Allow Login
					 */
					
					if (isPastDate ( $lastDueDate )) {
						/**
						 * if DUE_DATE is past then stop login
						 */
						$_SESSION ["dueInvoice"] = $latestInvoice;
						return expireLogin ();
					} elseif (isPastDate ( $lastExpiryDate )) {
						/**
						 * EXPIRY_DATE is past then status=EXPIRED and call validateLicense() again
						 */
						$latestInvoice ["status"] = get_app_message ( "db.status.expired" );
						updateInvoiceStatus ( $latestInvoice );
						validateLicense ();
					} else {
						/**
						 * Allow Login
						 */
						return allowLogin ();
					}
				} elseif ($latestInvoice ["status"] == get_app_message ( "db.status.paid" )) {
					
					/**
					 * 1- if expiry_date is past
					 * then update status=EXPIRED and call validateLicense() again
					 *
					 * 2- elseif expiry date is near to expire
					 * then generateInvoice and call validateLicense()
					 *
					 * 3- Else Allow Login
					 *
					 *
					 */
					$invoiceDuePeriod = $campusCurrentPackage ["package"] ["invoice_due_period"];
					$lastExpiryWithMargin = date ( "Y-m-d", strtotime ( "-" . $invoiceDuePeriod . " day", strtotime ( $lastExpiryDate ) ) );
					
					if (isPastDate ( $lastExpiryDate )) {
						/**
						 * EXPIRY_DATE is past then status=EXPIRED and call validateLicense() again
						 */
						$latestInvoice ["status"] = get_app_message ( "db.status.expired" );
						updateInvoiceStatus ( $latestInvoice );
						validateLicense ();
					} elseif (isPastDate ( $lastExpiryWithMargin )) {
						/**
						 * EXPIRY DATE is near to expire then generateInvoice and call validateLicense()
						 */
						
						$newInvoiceDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $lastInvoiceDate ) ) );
						$newDueDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $lastDueDate ) ) );
						$newExipryDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $lastExpiryDate ) ) );
						
						$invoiceId = generateInvoice ( $newInvoiceDate, $newDueDate, $newExipryDate );
						
						if ($invoiceId == null) {
							return expireLogin ();
						} else {
							validateLicense ();
						}
					} else {
						/**
						 * Allow Login
						 */
						return allowLogin ();
					}
				}
			}
		}
	}
}

if (! function_exists ( 'updateInvoice' )) {
	function updateInvoiceStatus($invoice = null) {
		$CI = & get_instance ();
		$CI->load->database ();
		$CI->load->model ( 'Invoice_Model', 'invoice' );
		unset ( $invoice ["campusPackage"] );
		$CI->invoice->merge ( $invoice );
	}
}

if (! function_exists ( 'allowLogin' )) {
	function allowLogin() {
		$_SESSION ["license"] ["status"] = get_app_message ( "db.status.licenced" );
	}
}

if (! function_exists ( 'expireLogin' )) {
	function expireLogin() {
		$_SESSION ["license"] ["status"] = get_app_message ( "db.status.expired" );
		$_SESSION ["appNotifications"] ["licenseExpired"] = get_app_message ( "due.invoice.expired.message" );
	}
}

if (! function_exists ( 'generateInvoice' )) {
	function generateInvoice($invoiceDate = null, $dueDate = null, $expiryDate = null) {
		if ($invoiceDate == null || $dueDate == null || $expiryDate == null) {
			return null;
		}
		
		$invoice = array ();
		$today = getCurrentDate ();
		$campusCurrentPackage = $_SESSION ["campusCurrentPackage"];
		$currentCampus = $_SESSION ["currentCampus"];
		
		$CI = & get_instance ();
		$CI->load->database ();
		$CI->load->model ( 'Invoice_Model', 'invoice' );
		
		/*
		 * $lastExpirytime = strtotime($lastInvoiceExpiryDate);
		 * //$lastDuetime = strtotime($lastInvoiceDueDate);
		 * $packageDurationMonths =$campusCurrentPackage["package"]["duration_months"];
		 * $packageDueDays =$campusCurrentPackage["package"]["invoice_due_period"];// days
		 *
		 * $expiryDate = date("Y-m-d", strtotime("+".$packageDurationMonths." month", $lastExpirytime));
		 * //$dueDate = date("Y-m-d", strtotime("+".$packageDueDays." day", $lastDuetime));
		 * //$dueDate = date("Y-m-d", strtotime("-1 day", strtotime($today)));
		 *
		 */
		
		$invoiceNo = $CI->invoice->generateInvoiceNumber ();
		
		
		$invoice ["campus_package_id"] = $campusCurrentPackage ["id"];
		$invoice ["invoice_no"] = $invoiceNo;
		$invoice ["payable_amount"] = $campusCurrentPackage ["package"] ["price"]["price"];
		$invoice ["total_payable_amount"] = $campusCurrentPackage ["package"] ["price"]["price"];
		$invoice ["currency"] = $campusCurrentPackage ["package"] ["price"]["currency"];
		$invoice ["invoice_date"] = $invoiceDate;
		$invoice ["status"] = get_app_message ( "db.status.due" );
		$invoice ["due_date"] = $dueDate;
		$invoice ["created_by"] = "0";
		$invoice ["created_at"] = getCurrentDateTime ();
		$invoice ["campus_id"] = $currentCampus ["id"];
		$invoice ["invoice_expiry_date"] = $expiryDate;
		
		
		$newId = $CI->invoice->merge ( $invoice );
		
		if (! empty ( $newId ) && is_numeric ( $newId )) {
			return $newId;
		} else {
			return null;
		}
		
		// order_by invoice_date, compare with paid_date
		/*
		 * $paidInvoices = $CI->invoice->getByCampusAndStatus($currentCampus["id"], get_app_message("db.status.paid"), "invoice_date");
		 * $latestPaidInvoice = array();
		 * if(empty($paidInvoices )){
		 * // create new invoice with due date today.
		 * }else{
		 * $latestPaidInvoice = $paidInvoices[0];
		 * //$latestPaidInvoice
		 * }
		 */
		
		// pre_d($campusCurrentPackage );
	}
}

if (! function_exists ( 'validateLicense_old' )) {
	function validateLicense_old() {
		$today = getCurrentDate ();
		
		unset ( $_SESSION ["licenseNotification"] );
		$currentCampus = $_SESSION ["currentCampus"];
		
		$campusCurrentPackage = getCampusCurrentPackage ();
		if (empty ( $campusCurrentPackage )) {
			$_SESSION ["license"] ["status"] = get_app_message ( "db.status.expired" );
			$_SESSION ["appNotifications"] ["licenseExpired"] = "Please Choose the Package First.";
			return;
		}
		$_SESSION ["campusCurrentPackage"] = $campusCurrentPackage;
		
		// variables
		$packageDurationMonths = $campusCurrentPackage ["package"] ["duration_months"];
		$lastDueDate;
		$lastExpiryDate;
		$newDueDate;
		$newExipryDate;
		
		if (isset ( $currentCampus ["school"] ["status"] )) {
			if ($currentCampus ["school"] ["status"] == get_app_message ( "db.status.licenced" )) {
				
				// get lastest invoice by invoice_expiry_date
				$latestInvoice = getLastestInvoice ();
				if (empty ( $latestInvoice )) {
					// if no invoice so far then generate new invoice with due_date = TODAY
					
					generateInvoice ( $lastActiveExpiry, $lastActiveDueDateMargin );
				}
				
				// If last paid invoice is near to expire then create the new invoice but don't expire the last invoice.
				$lastPaidInvoice = getLastActivePaidInvoice ();
				if (! empty ( $lastPaidInvoice )) {
					$lastPaidInvoice = $lastPaidInvoice [0];
					$lastActiveExpiry = $lastPaidInvoice ["invoice_expiry_date"];
					$lastActiveDueDate = $lastPaidInvoice ["due_date"];
					$invoiceDuePeriod = $campusCurrentPackage ["package"] ["invoice_due_period"];
					$lastActiveExpiryMargin = date ( "Y-m-d", strtotime ( "-" . $invoiceDuePeriod . " day", strtotime ( $lastActiveExpiry ) ) );
					$lastActiveDueDateMargin = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $lastActiveDueDate ) ) );
					
					if (isPastDate ( $lastActiveExpiryMargin )) {
						// create invoice and don't expire the old one.
						generateInvoice ( $lastActiveExpiry, $lastActiveDueDateMargin );
					}
					return;
				}
				
				// If there is no Due Invoice then generate new Invoice with Due=TODAY and Expiry_Date=TODAY.
				// otherwise Get the Latest Due Invoice by Due Date ... for further validations.
				$CI = & get_instance ();
				$CI->load->database ();
				$CI->load->model ( 'Invoice_Model', 'invoice' );
				$dueInvoices = $CI->invoice->getByCampusAndStatus ( $currentCampus ["id"], get_app_message ( "db.status.due" ) );
				$dueInvoice = array ();
				if (empty ( $dueInvoices )) {
					$dueInvoice = generateInvoice ();
				} else {
					$dueInvoice = $dueInvoices [0];
				}
				
				// Further Validations: If there is a due Invoice
				// Check whether it is expired or not.
				// If expired Then Generate new invoice with Expiry_date = (LastExpiry Date ) and Due_Date=(last_due_date + package_duration)
				// and update Old Expired Invoice status to "EXPIRED"
				if (! empty ( $dueInvoice )) {
					
					$invoiceExpiryDate = $dueInvoice ["invoice_expiry_date"];
					$invoiceDueDate = $dueInvoice ["due_date"];
					if (isPastDate ( $invoiceExpiryDate )) {
						// update expiry date status to expired
						//
						$updateInvoice = $dueInvoice;
						unset ( $updateInvoice ['campusPackage'] );
						$updateInvoice ["status"] = get_app_message ( "db.status.expired" );
						if (get_app_message ( "response.success" ) == $CI->invoice->merge ( $updateInvoice )) {
							
							$invoiceDueDateMargin = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", strtotime ( $invoiceDueDate ) ) );
							// set Due Date to Past if last invoice status is set to Expired.
							if (new DateTime () <= new DateTime ( $invoiceDueDateMargin )) {
								$invoiceDueDateMargin = $today;
							}
							$dueInvoice = generateInvoice ( $invoiceExpiryDate, $invoiceDueDateMargin );
							// newly generated Invoice is also Expired then re-Validate // recursive Method Call
							if (isPastDate ( $dueInvoice ["invoice_expiry_date"] )) {
								validateLicense ();
							}
						} else {
							$_SESSION ["license"] ["status"] = get_app_message ( "db.status.expired" );
							$_SESSION ["appNotifications"] ["licenseExpired"] = get_app_message ( "due.invoice.expired.message" );
							$dueInvoice = array ();
						}
					}
					
					// Now If the Due Invoice Due Date is past then Don't allow to login
					$latestInvoice = $dueInvoice;
					
					$dueDate = convertMySQLDateTimeToDate ( $latestInvoice ["due_date"] );
					
					if (isPastDate ( $dueDate )) {
						
						$_SESSION ["license"] ["status"] = get_app_message ( "db.status.expired" );
						$_SESSION ["appNotifications"] ["licenseExpired"] = get_app_message ( "due.invoice.expired.message" );
						$_SESSION ["dueInvoice"] = $dueInvoice;
					} else {
						$daysLeft = getDateDifference ( $today, $dueDate );
						if ($daysLeft < 5) {
							$_SESSION ["license"] ["status"] = get_app_message ( "db.status.warning" );
							$_SESSION ["appNotifications"] ["licenseWarning"] = get_app_message ( "due.invoice.warning.message" );
						} else {
							$_SESSION ["license"] ["status"] = get_app_message ( "db.status.licenced" );
						}
					}
				}
			}
		}
	}
}

if (! function_exists ( 'generateInvoice_old' )) {
	function generateInvoice_old($lastInvoiceExpiryDate = null, $dueDate = null) {
		$invoice = array ();
		
		$today = getCurrentDate ();
		
		if ($lastInvoiceExpiryDate == null) {
			$lastInvoiceExpiryDate = $today;
		}
		if ($dueDate == null) {
			$dueDate = $today;
		}
		
		$currentCampus = $_SESSION ["currentCampus"];
		$campusCurrentPackage = array ();
		/*
		 *
		 *
		 */
		$CI = & get_instance ();
		$CI->load->database ();
		
		$CI->load->model ( 'Invoice_Model', 'invoice' );
		
		$campusCurrentPackage = $_SESSION ["campusCurrentPackage"];
		if (empty ( $campusCurrentPackage )) {
			$_SESSION ["license"] ["status"] = get_app_message ( "db.status.expired" );
			$_SESSION ["appNotifications"] ["licenseExpired"] = "Please choose the package first.";
			return $invoice ();
			// $campusCurrentPackage = $campusCurrentPackage [0];
		}
		// invoice_generation_period
		// pre_d($campusCurrentPackage);
		
		$lastExpirytime = strtotime ( $lastInvoiceExpiryDate );
		// $lastDuetime = strtotime($lastInvoiceDueDate);
		$packageDurationMonths = $campusCurrentPackage ["package"] ["duration_months"];
		$packageDueDays = $campusCurrentPackage ["package"] ["invoice_due_period"]; // days
		
		$expiryDate = date ( "Y-m-d", strtotime ( "+" . $packageDurationMonths . " month", $lastExpirytime ) );
		// $dueDate = date("Y-m-d", strtotime("+".$packageDueDays." day", $lastDuetime));
		// $dueDate = date("Y-m-d", strtotime("-1 day", strtotime($today)));
		
		$invoiceNo = $CI->invoice->generateInvoiceNumber ();
		
		$invoice ["campus_package_id"] = $campusCurrentPackage ["id"];
		$invoice ["invoice_no"] = $invoiceNo;
		$invoice ["payable_amount"] = $campusCurrentPackage ["package"] ["price"];
		$invoice ["total_payable_amount"] = $campusCurrentPackage ["package"] ["price"];
		$invoice ["invoice_date"] = $lastInvoiceExpiryDate;
		$invoice ["status"] = get_app_message ( "db.status.due" );
		$invoice ["due_date"] = $dueDate;
		$invoice ["created_by"] = "0";
		$invoice ["created_at"] = getCurrentDateTime ();
		$invoice ["campus_id"] = $currentCampus ["id"];
		$invoice ["invoice_expiry_date"] = $expiryDate;
		$newId = $CI->invoice->merge ( $invoice );
		if (empty ( $newId )) {
			return array ();
		} else {
			$invoice = $CI->invoice->get ( $newId, $currentCampus ["id"] );
			return $invoice;
		}
		
		// order_by invoice_date, compare with paid_date
		/*
		 * $paidInvoices = $CI->invoice->getByCampusAndStatus($currentCampus["id"], get_app_message("db.status.paid"), "invoice_date");
		 * $latestPaidInvoice = array();
		 * if(empty($paidInvoices )){
		 * // create new invoice with due date today.
		 * }else{
		 * $latestPaidInvoice = $paidInvoices[0];
		 * //$latestPaidInvoice
		 * }
		 */
		
		// pre_d($campusCurrentPackage );
	}
}
if (! function_exists ( 'getUniqueString' )) {
	function getUniqueString() {
		return  md5(uniqid('', true));
	}
}
if (! function_exists ( 'expireLastDueInvoice' )) {
	function expireLastDueInvoice() {
	}
}

if (! function_exists ( 'seoUrl' )) {
	function seoUrl($string) {
		// Lower case everything
		$string = strtolower ( $string );
		// Make alphanumeric (removes all other characters)
		$string = preg_replace ( "/[^a-z0-9_\s-]/", "", $string );
		// Clean up multiple dashes or whitespaces
		$string = preg_replace ( "/[\s-]+/", " ", $string );
		// Convert whitespaces and underscore to dash
		$string = preg_replace ( "/[\s_]/", "-", $string );
		return $string;
	}
}

