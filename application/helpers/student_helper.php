<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}




if (!function_exists('getAdmissionCount')) {
    function getCurrentYearAdmissionCount($campusId=null) {
		$admissionCount = 0;
    	$year = getCurrentYear();
    	
		$students = getStudentAdmissionsByYear($campusId, $year);
		if(!empty($students)){
			$admissionCount = sizeof($students);
		}
		return $admissionCount;
    }
}




if (!function_exists('getStudentAdmissionsByYear')) {
	function getStudentAdmissionsByYear($campusId=null,$year) {
		$CI = get_instance();
		$CI->load->model('Student_Model','student');
		$students = $CI->student->getStudentsByAdmissionYear($year);
		return $students;
	}
}	