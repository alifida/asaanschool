<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Fileupload extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
	}
	public function index($data = array()) {
		$this->template->load($this->activeTemplate,  'test', $data );
	}
	public function uploadSliderImage(){
	
		$branchEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
	
		$pathToUpload = $pathToUpload . "/campuses/".$branchEncId."/website";
	
		$filePostFix = "slider-image".getUniqueString();
		$response = uploadTempImage($pathToUpload, $filePostFix, 1920,700, false);
		echo $response;
	}
	
	public function uploadPostThumbnail(){
	
		$branchEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
	
		$pathToUpload = $pathToUpload . "/campuses/".$branchEncId."/website";
	
		$filePostFix = "post-thumbnail";
		$response = uploadTempImage($pathToUpload, $filePostFix, 0, 0);
		echo $response;
	}
	public function uploadProfilePic() {
		
		
		$userEncId = encodeID($_SESSION["sessionUser"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
		$pathToUpload = $pathToUpload . "/users/".$userEncId;
		$filePostFix = "profile-pic";
		$response = uploadTempImage($pathToUpload, $filePostFix);
		echo $response;
		
	}
	
	public function certificateBackgroundImage() {
		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId."/certificates";
		$filePostFix = "background-image";
		
		$response = uploadTempImage($pathToUpload, $filePostFix, 'auto', 'auto', " max-150 ");
		//pre_d($response);
		echo $response;
	}
	public function certificateWatermark() {
		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId."/certificates";
		$filePostFix = "watermark";
		$response = uploadTempImage($pathToUpload, $filePostFix);
		//pre_d($response);
		echo $response;
	}

	
	public function uploadCampusLogo(){

		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
		
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId;
		
		$filePostFix = "campus-logo";
		$response = uploadTempImage($pathToUpload, $filePostFix);
		echo $response;
		
		
	}
	
	public function uploadReportLogo(){

		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
		
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId;
		
		$filePostFix = "report-logo";
		$response = uploadTempImage($pathToUpload, $filePostFix);
		echo $response;
		
		
	}
	public function uploadReportDigitalStamp(){

		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
		
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId;
		
		$filePostFix = "digital-stamp";
		$response = uploadTempImage($pathToUpload, $filePostFix);
		echo $response;
		
		
	}
	
	public function uploadStudentPic(){
	
		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
	
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId."/students";
	
		$filePostFix = "student-picture";
		$response = uploadTempImage($pathToUpload, $filePostFix);
		echo $response;
	}
	
	public function uploadEmployeePic(){
	
		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
	
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId."/employees";
	
		$filePostFix = "employee-picture";
		$response = uploadTempImage($pathToUpload, $filePostFix);
		echo $response;
	}
	
	public function uploadWidgetThumbnail(){
	
		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
	
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId."/website";
	
		$filePostFix = "widget-thumbnail";
		$response = uploadTempImage($pathToUpload, $filePostFix, 300,200 );
		echo $response;
	}
	
	public function uploadToWebisteImages(){
	
		$campusEncId = encodeID($_SESSION["currentCampus"]["id"]);
		$pathToUpload = get_app_message("file.upload.path");
	
		$pathToUpload = $pathToUpload . "/campuses/".$campusEncId."/website";
	
		$filePostFix = get_random_string_alpha(2);
		$jsonResponse = uploadWebsiteImage($pathToUpload, $filePostFix);
		
		$response = json_decode($jsonResponse);
		
		$status = $response->status;
		if("success"== $status){
			$imagePath = $response->absolute_path;
			if(!empty($imagePath)){
				$webImage = array();
				$webImage["image_path"] = $imagePath;
				$webImage["website_id"] = $_SESSION["currentWebsiteId"];
				$this->load->model('Websiteimage_Model', 'webimage');
				$this->webimage->merge($webImage);
			} 
		}
		
		
		echo $jsonResponse ;
	}
	
	
	
}
