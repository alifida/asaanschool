<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}




if (!function_exists('get_user_for_autocomplete')) {

    function get_user_for_autocomplete($params) {

//        $rs = array();

        $arr = array();
        $CI = & get_instance();
//        $CI->load->model('User_Model', 'user');
        $CI->load->database();
//        $sqlString = sprintf("SELECT id, login_id as name from users WHERE login_id LIKE '%%%s%%' ORDER BY login_id ASC LIMIT 10", mysql_real_escape_string($params["q"]));
        $sqlString = "SELECT id, login_id as name from users WHERE login_id LIKE '%" . $params["q"] . "%' ORDER BY login_id ASC LIMIT 10";
        $query = $CI->db->query($sqlString);
        $rs = $query->result_array();


# Collect the results
        foreach ($rs as $key => $val) {
            $arr[] = $val;
        }

# JSON-encode the response
        $json_response = json_encode($arr);

# Optionally: Wrap the response in a callback function for JSONP cross-domain support
        if ($params["callback"]) {
            $json_response = $params["callback"] . "(" . $json_response . ")";
        }
# Return the response
        //echo $json_response;


        return $json_response;
    }

}
if (!function_exists('pre_populate_users')) {

    function pre_populate_users($ids) {
        $arr = array();
        $CI = & get_instance();
        $CI->load->database();
        $sqlString = sprintf("SELECT id, login_id as name from users WHERE id in (" . $ids . ")");
        $query = $CI->db->query($sqlString);
        $rs = $query->result_array();


# Collect the results
        foreach ($rs as $key => $val) {
            $arr[] = $val;
        }

# JSON-encode the response
        $json_response = json_encode($arr);

# Optionally: Wrap the response in a callback function for JSONP cross-domain support
//        if ($params["callback"]) {
//            $json_response = $params["callback"] . "(" . $json_response . ")";
//        }
# Return the response
        //echo $json_response;


        return $json_response;
    }

}


if (!function_exists('get_friend_list')) {

    function get_friend_list($ids) {

        $CI = & get_instance();
        $CI->load->database();
        $sqlString = sprintf("SELECT * from users WHERE id in (" . $ids . ")");
        $query = $CI->db->query($sqlString);
        $rs = $query->result_array();
        return $rs;
    }

}

if (!function_exists('is_username_available')) {

    function is_username_available($loginId) {

        $CI = & get_instance();
        $CI->load->database();
        $sqlString = sprintf("SELECT * from users WHERE email = '" . $loginId . "'");
        $query = $CI->db->query($sqlString);
        $rs = $query->result_array();
        if (empty($rs)) {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists('is_email_address_available')) {

    function is_email_address_available($email) {

        $CI = & get_instance();
        $CI->load->database();
        $sqlString = sprintf("SELECT * from users WHERE email = '" . $email . "'");
        $query = $CI->db->query($sqlString);
        $rs = $query->result_array();
        if (empty($rs)) {
            return true;
        } else {
            return false;
        }
    }

}


if (!function_exists('set_user_account_type')) {

    function set_user_account_type($user) {

        $CI = & get_instance();
        $CI->load->database();
        $sqlString = sprintf("select * from user_types where id = " . $user["user_type_id"]);
        $query = $CI->db->query($sqlString);
        $rs = $query->row_array();
        if (!empty($rs)) {
            $user["user_type"] = $rs;
        }
        return $user;
    }

}



if (!function_exists('get_pending_users')) {

    function get_pending_users() {

        $CI = & get_instance();
        $CI->load->database();
        $sqlString = sprintf("select u.*, ut.type from users u, user_types ut where u.status ='Pending' and u.user_type_id = ut.id group by u.login_id ");
        $query = $CI->db->query($sqlString);
        $rs = $query->result_array();

//        pre_d($rs);
        return $rs;
    }

}
if (!function_exists('get_active_users')) {

    function get_active_users() {

        $CI = & get_instance();
        $CI->load->database();
        $sqlString = sprintf(
                " select u.*, ut.type from users u, user_types ut  " .
                " where u.status ='active'  " .
                " and u.user_type_id = ut.id  " .
                " and ut.type <> 'Admin' " .
                " group by u.login_id "
        );
        $query = $CI->db->query($sqlString);
        $rs = $query->result_array();

        return $rs;
    }

}
if (!function_exists('update_user_status')) {

    function update_user_status($userid, $status = "Pending") {

        $CI = & get_instance();
        $CI->load->database();
        $CI->db->trans_start();
        $data = array();
        $data["status"] = $status;
        $CI->db->where('id', $userid);
        $CI->db->update('users', $data); // update the record
        $CI->db->trans_complete();

        if ($CI->db->trans_status() === FALSE) {
            return "failed";
        } else {
            return "success";
        }
    }

}

if (!function_exists('isUserModuleSelected')) {

	function isUserModuleSelected($userModules, $campusModule){
		$isSelected = false;
		foreach ($userModules as $userModule){
			if($userModule["campusModule"]["module"]["id"]==$campusModule["module"]["id"]){
				$isSelected = true;
				break;
			}
		}
		return $isSelected;
	}

}



if (!function_exists('generateAlertOnEvent')) {
	function generateAlertOnEvent($groupStr, $emailArray, $emailData){
	 	 
/* 	 	
	 	$emailData["email_subject"]=$this->input->post("email_subject");
	 	$emailData["email_body"]=$this->input->post("email_body");
 */	 	
	 	$emailData["from_email"]=$_SESSION["sessionUser"]["email"];
	 	$emailData["from_user_id"]=$_SESSION["sessionUser"]["id"];
	 	
	 	$toEmails = array();
	 	if(!empty($groupStr)){
	 		$toEmails = getEmailsBelongsToGroups($groupStr);
	 	}
	 	if(!empty($emailArray)){
	 		$toEmails = array_merge($toEmails, $emailArray);
	 	}
	 	
	 	if(!empty($toEmails)){
	 		return sendBulkEmails($toEmails, $emailData);
	 	}
	 	return 0;
	 }
 }
	 
if (!function_exists('sendBulkEmails')) {
	function sendBulkEmails($toEmails, $emailData){
		$successCount=0;
		if(!empty($toEmails)){
			$CI = get_instance();
			$CI->load->model ( 'Emailuser_Model', 'emailUser' );
			foreach ($toEmails as $toEmail){
				$emailData["to_email"] = $toEmail;
				$response = $CI->emailUser->sendEmail($emailData);
				if($response == get_app_message("response.success")){
					$successCount++;
				}
			}
			
		}
		return $successCount;
	 }
}
if (!function_exists('sendMailToGroups')) {
	 function sendMailToGroups($groupStr, $emailData){
		$toEmails = getEmailsBelongsToGroups($groupStr);
		return sendBulkEmails($toEmails, $emailData);
	}
}
if (!function_exists('getEmailsBelongsToGroups')) {

	 function getEmailsBelongsToGroups($groupStr){
		
		$emails=array();
		if(!empty($groupStr)){
			$CI = get_instance();
			$CI->load->model('Student_Model','student');
			$CI->load->model('Guardian_Model', 'guardian');
			$CI->load->model('Employee_Model', 'employee');
			$groups =  explode(',', $groupStr);
			foreach ($groups as $group){
				if("all_employees" == $group){
					// get all the employees having email adress
					
					$eEmails = $CI->employee->getEmailAddresses();
					if(!empty($eEmails)){
						foreach ($eEmails as $e){
							$emails[] = $e["email"];
						}
					}
				}elseif("all_guardians" == $group){
					// get all guardians having email address
					$gEmails = $CI->guardian->getEmailAddresses(null, null);
					if(!empty($gEmails)){
						foreach ($gEmails as $e){
							$emails[] = $e["email"];
						}
					}
				}elseif("all_students" == $group){
					// get all students having email address
					$sEmails = $CI->student->getEmailAddresses(null,null);
					if(!empty($sEmails)){
						foreach ($sEmails as $e){
							$emails[] = $e["email"];
						}
					}
				}else{
					// tokenize and get class id
					try{
						$groupToken =  explode('_', $group);
						if(is_numeric($groupToken[0])){
							$classId = $groupToken[0];
							$type = $groupToken[1];
							if("guardians"==$type){
								
								$tEmails =$CI->guardian->getEmailAddresses($classId, null);
							}elseif("students"==$type){
								
								$tEmails =$CI->student->getEmailAddresses($classId, null);
							}
							if(!empty($tEmails)){
								foreach ($tEmails as $e){
									$emails[] = $e["email"];
								}
							}
						}
					}catch (exception $e){
						pre( $e->getMessage());
					}
					
				}
			}
			}
		$emails = array_unique($emails);
		return $emails;
	}
}



