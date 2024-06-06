<?php
class Appconstants{

	public static  $APP_MSGS = array(
		"release.version"=>RELEASE_VERSION,
		"securityKey"=>"F%^!d1330",
		"app.environment"=>ENVIRONMENT,   // Production , Development, Training
		"app.domain"=>"asaanschool.com",
		"app.page.title"=>"School Management System", 
		//"app.subdomain"=>"farabi",
		"system.reserved.subdomains"=>array("www","cpanel","training"), 

			
		"enable_cloud_storage"=>"TRUE",	
		"enable_cloud_email"=>"FALSE",	
		"storage_cloud_name"=>"hbgvcyjil",
		"storage_api_key"=>"544661793883191",
		"storage_api_secret"=>"pVSuoqf2R0ooOyRVMvbPgZbHNbs",
		 
		
			
			
		"organization.name" => "Asaanschool",
		"organization.address" => "H 69, S 14<br/>Margalla Town (phase-1)<br/>Islamabad",
		"organization.phone" => "0092 300 911 3800",
		"organization.phone" => "0092 300 911 3800",
		"organization.email" => "info@asaanschool.com",
		"organization.bank.account.no" => "01 - 324 69 49 - 01",
		"organization.bank.account.title" => "Ali Fida",
		"organization.bank.account.branch" => "G-9 Markaz Islamabad",
		"organization.bank.account.branch.code" => "150",
		"organization.bank.account.bank" => "Standard Chartered Bank",
		"organization.easypaisa.cnic" => "13504-6507063-1",
		"organization.easypaisa.cell" => "0092 300 911 3800",
	
		"public.template" => "publicDefault",
		"admin.template"=>"default",	
		"admin.dialog.template"=>"default_dialog",	
	
	
		"sender.email.display.name"=>"Admin",
		"sender.email.address"=>"info@asaanschool.com",
		"sender.email.password"=>"Fedora@10",
		"admin.email.address"=>"info@asaanschool.com",
		"admin.email.address2"=>"asaanschool@gmail.com",
		"admin.email.address3"=>"alifida86@gmail.com",

		"app.trail.period"=>"30",
		"app.trail.message"=>"You are using Trial version.",
		"app.expired.message"=>"Your account has been expired.",
		"empty_credentials" => "Please provide the Login Id and Password.",
		"invalid_credentials" => "Invalid Credentials. Please try again.",
		"unauthorized.user" => "You are not authorized to use this feature. Please contact the Admin for rights assignment.",
		"inactive_user" => "Your account is currently <b>In Active</b>. Please check your email and follow the instructions to activate your account.",
		"invalid_url" => "The Requested URL is invalid.",
		"username.not.available"=>"Provided email is already registered. Please go for Forgot Password option (At Login Page) or provide some other email address for new signup.",
		"no_record_found" => "No Record Found.",

		"image.uploaded.to.tmp"=>"This is just a preview. Please save to commit the changes.",
		"image.is.not.valid"=>"File is not an image. Please upload the Image File.",
		"image.is.not.valid"=>"File is not an image. Please upload the Image File.",
		"image.invalid.type"=>"Invalid File type. Allowed types (.png, .jpg, .jpeg, .gif)",
	
		
		"request_processed_successfully" => "Your request has been processed successfully.",
		"cannot_process_request" => "Request Processing Faild. Please Try again.",
		"incomplete.input.form" => "Provided information is incomplete. Request Processing Faild. ",
		"paid_amount_is_0" => "Please Provide the Amount to Pay.",
		"db.status.licenced" => "Licenced",
		"db.status.trail" => "Trial",
		"db.status.expired" => "Expired",
		"db.status.warning" => "Warning",
		"db.status.paid" => "Paid",
		"db.status.due" => "Due",
		"db.status.returned" => "Returned",
		"db.status.reverted" => "Reverted",
		"db.status.active" => "Active",
		"db.status.inactive" => "In Active",
			"db.status.published" => "Published",
			"db.status.trash" => "Trash",
			"response.success" => "Success",
			"response.failed" => "Failed",
		"db.duplicate.entry" => "Record already exist. Please avoid duplications.",
		"db.error1451" => "Unable to Delete Parent Record. Please DELETE the References first.",
		"db.error1062" => "Duplicate entry. Record already exist",
		"db.record.not.exist" => "Record does not exist.",
		"db.email.type.sent" => "Sent",
		"db.email.type.inbox" => "Inbox",
		"db.email.type.draft" => "Draft",
		"db.email.status.trash" => "Trash",
		"db.email.status.unread" => "Unread",
		"db.email.status.notdelivered" => "Not Delivered",
	 	"db.email.status.delivered" => "Delivered",
			
			 
			

			"db.website.template.layout.1" => "1 Column (100%)",
			"db.website.template.layout.2" => "2 Columns (7:3)",
			"db.website.template.layout.3" => "2 Columns (1:1)",
			"db.website.template.layout.4" => "3 Columns (3:1:1)",
			"db.website.template.layout.5" => "3 Columns (1:1:1)",
				
			"web.menu.type.page"=>"page",
			"web.menu.type.post.cat"=>"postCat",
			"web.menu.type.static"=>"static",
				
			"post.status.published"=>"Published",
			"post.status.draft"=>"Draft",
			"post.status.trash"=>"Trash",
			
			
		"email.verification.instructions"=>"Email Verification Code has been sent to your email address. Please check your email get the code to complete your registration. <br/><br/><b>If you did not get the email, please verify the Junk and Spam Mails.</b>",
		
		"invalid.signup.email.code"=>"Your Email code is invalid.",
	
		"due.invoice.warning.message"=>"Please Clear your due Invoices for uninterrupted service.",
		"due.invoice.expired.message"=>"Your License has been expired. Please clear your due invoice to activate your Account.",
		
	
	
	 	"db.website.template.type.home" => "Home Page",
	 	"db.website.template.type.fullwidth" => "Full Width",
	 	"db.website.template.type.footer" => "Footer",
	
	
	
		"response.success" => "Success",
		"response.failed" => "Failed",
		"item.issue.amount.not.available" => "The requested quantity is not available.",
		"current.and.to.class.not.different" => "<b>Current Class</b> and <b>Promote to</b> cannot be same.",
		"campus.details.seo.message" => "Please provide your real information and address for getting better business by search. ",
		"file.upload.path" => "uploads",
		"file.upload.max.size" => "3145728",
		"reports.config.message"=>"Following settings will be used for report generation, Please verfiy you settings are properly reflecting on reports.",
		"webpage.status.published"=>"Published",
		"webpage.status.draft"=>"Draft",
		"webpage.status.trash"=>"Trash",
		"help.report.title"=>"This Value will be placed in the header of all the reports. You can provide your school Name.",
		"help.report.header.string"=>"This value will be placed in the header of all the reports, below the title. You can provide school address and contact details.",
		"help.report.logo"=>"This will be placed in header of all the reports, you can provide your school logo.",
		"help.report.logo.width"=>"This is width of logo to be displayed on the reports.",
		"help.report.digital.stamp"=>"Provided stamp or signature will be displayed on all the reports.",
		"help.cannot.update.primaryemail"=>"Primary Email can't be updated, <br/>because it is used as login Id",
		"help.remaing.dues.as.arrears"=>"Remaining Dues are considered as arrears,<br/>and will be displayed in dues section.",
		
		"registered.user.not.logged.in"=>"You are a registered user, Please login before performing any operation.",
			
		"defaulter.guardian.sms.template"=> "Hello! Mr. Khan, Please clear the due amount Rs. 15000/- of Azam Khan<br/>Sender: My public School",
		
		"account.activation.message"=>"Your Account Activation request has been sent to the admin. Please clear your payment against the selected package. You can get the details of pricing from our main site.",
		
			
		"student.certificate.params"=>array(
				["name"=>"Student First Name", "short_code"=>"{@st_first_name@}","db_table"=>"students","db_col"=>"first_name", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Student Last Name", "short_code"=>"{@st_last_name@}","db_table"=>"students","db_col"=>"last_name", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Father Name", "short_code"=>"{@st_father_name@}","db_table"=>"students","db_col"=>"father_name", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Roll No.", "short_code"=>"{@st_roll_no@}","db_table"=>"students","db_col"=>"roll_no", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Registration No.", "short_code"=>"{@st_registration_no@}","db_table"=>"students","db_col"=>"reg_no", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Date of birth", "short_code"=>"{@st_dob@}","db_table"=>"students","db_col"=>"date_of_birth", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Address", "short_code"=>"{@st_address@}","db_table"=>"students","db_col"=>"address", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Admission date", "short_code"=>"{@st_date_of_admission@}","db_table"=>"students","db_col"=>"admission_date", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Leaving date", "short_code"=>"{@st_date_of_leaving@}","db_table"=>"students","db_col"=>"unroll_date", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Picture", "short_code"=>"{@st_picture@}","db_table"=>"students","db_col"=>"student_picture", "forign_table"=>"" , "forign_column"=>""],
				["name"=>"Class", "short_code"=>"{@st_class@}","db_table"=>"students","db_col"=>"class_id", "forign_table"=>"classes" , "forign_column"=>"name"],
				
		),
			
		"employee.certificate.params"=>array(
					["name"=>"Employee First Name", "short_code"=>"{@em_first_name@}","db_table"=>"employees","db_col"=>"first_name", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Employee Last Name", "short_code"=>"{@em_last_name@}","db_table"=>"employees","db_col"=>"last_name", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"CNIC", "short_code"=>"{@em_cnic@}","db_table"=>"employees","db_col"=>"cnic", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Employee No.", "short_code"=>"{@em_employee_no@}","db_table"=>"employees","db_col"=>"employee_no", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Email", "short_code"=>"{@em_email@}","db_table"=>"employees","db_col"=>"email", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Address", "short_code"=>"{@em_address@}","db_table"=>"employees","db_col"=>"address", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Salary", "short_code"=>"{@em_salary@}","db_table"=>"employees","db_col"=>"salary", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Qualification", "short_code"=>"{@em_qualification@}","db_table"=>"employees","db_col"=>"qualification", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Date of Joining", "short_code"=>"{@em_date_of_joining@}","db_table"=>"employees","db_col"=>"date_of_joining", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Date of Resigning", "short_code"=>"{@em_date_of_resigning@}","db_table"=>"employees","db_col"=>"date_of_resigning", "forign_table"=>"" , "forign_column"=>""],
					["name"=>"Employee Type", "short_code"=>"{@em_employee_type@}","db_table"=>"employees","db_col"=>"employee_type_id", "forign_table"=>"employee_types" , "forign_column"=>"type"],
					["name"=>"Picture", "short_code"=>"{@em_picture@}","db_table"=>"employees","db_col"=>"employee_picture", "forign_table"=>"" , "forign_column"=>""],
			
			)
			
			
		);



		static function get_message($key) {
	$message = Appconstants::$APP_MSGS [$key];
	if (empty ( $message )) {
		$message = "???" . $key . "???";
	}
	return $message;
}


}