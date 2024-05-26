<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}

if (! function_exists ( 'get_app_message' )) {
	$CI = & get_instance ();
	$CI->load->library ( 'Appconstants' );
	function get_app_message($key) {
		return Appconstants::get_message ( $key );
	}
}



if (! function_exists ( 'get_app_details' )) {
	function get_app_details() {
		$siteDetails = array ();
		$siteDetails ["admin_name"] = "Admin";
		$siteDetails ["admin_email"] = "admin@email.com";
		$siteDetails ["no_reply_email"] = "noreply@email.com";
		return $siteDetails;
	}
}

if (! function_exists ( 'get_random_string' )) {
	function get_random_string($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for($i = 0; $i < $length; $i ++) {
			$randomString .= $characters [rand ( 0, strlen ( $characters ) - 1 )];
		}
		return $randomString;
	}
}
if (! function_exists ( 'get_random_string_alpha' )) {
	function get_random_string_alpha($length = 20) {
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for($i = 0; $i < $length; $i ++) {
			$randomString .= $characters [rand ( 0, strlen ( $characters ) - 1 )];
		}
		return $randomString;
	}
}

if (! function_exists ( 'getWeekDays' )) {
	function getWeekDays() {
		return array("Monday","Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	}
}
if (! function_exists ( 'getCurrentMonth' )) {
	function getCurrentMonth() {
		return date ( "m" );
	}
}

if (! function_exists ( 'getCurrentYear' )) {
	function getCurrentYear() {
		return date ( "Y" );
	}
}

if (! function_exists ( 'getCurrentDate' )) {
	function getCurrentDate() {
		return date ( "Y-m-d" );
	}
}
if (! function_exists ( 'getCurrentDateTime' )) {
	function getCurrentDateTime() {
		return date ( "Y-m-d H:i:s" );
	}
}

if (! function_exists ( 'convertMySQLDateTimeToDate' )) {
	function convertMySQLDateTimeToDate($mySqlDateTime) {
		if (empty ( $mySqlDateTime )) {
			return "";
		}
		$date = new DateTime ( $mySqlDateTime );
		return $date->format ( 'Y-m-d' );
	}
}

if (! function_exists ( 'getDateDifference' )) {
	function getDateDifference($startDateStr, $endDateStr) {
		$startDate = new DateTime ( $startDateStr );
		$endDate = new DateTime ( $endDateStr );
		$interval = $startDate->diff ( $endDate );
		return $interval->days;
	}
}
if (! function_exists ( 'isPastDate' )) {
	function isPastDate($date) {
		return new DateTime () > new DateTime ( $date );
	}
}

/*
 * if (!function_exists('getDateDifferenceWithInvert')) {
 * function getDateDifferenceWithInvert($date1, $date2, $withInvert){
 * $dif1 = date_diff(new DateTime("2015-09-03"), new DateTime("2015-09-01"),false);
 * $dif2 = date_diff(new DateTime("2015-09-01"), new DateTime("2015-09-03"),false);
 * }
 * }
 */





	

if (! function_exists ( 'encodeID' )) {
	function encodeID($id) {
		// return $id;
		return alphaID ( $id, false, 2, get_app_message ( "securityKey" ) );
	}
}

if (! function_exists ( 'decodeID' )) {
	function decodeID($encodedId) {
		// return $encodedId;
		return alphaID ( $encodedId, true, 2, get_app_message ( "securityKey" ) );
	}
}

if (! function_exists ( 'alphaID' )) {
	function alphaID($in, $to_num = false, $pad_up = false, $pass_key = null) {
		if (empty ( $in )) {
			return "";
		}
		$out = '';
		$index = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$base = strlen ( $index );
		
		if ($pass_key !== null) {
			// Although this function's purpose is to just make the
			// ID short - and not so much secure,
			// with this patch by Simon Franz (http://blog.snaky.org/)
			// you can optionally supply a password to make it harder
			// to calculate the corresponding numeric ID
			
			for($n = 0; $n < strlen ( $index ); $n ++) {
				$i [] = substr ( $index, $n, 1 );
			}
			
			$pass_hash = hash ( 'sha256', $pass_key );
			$pass_hash = (strlen ( $pass_hash ) < strlen ( $index ) ? hash ( 'sha512', $pass_key ) : $pass_hash);
			
			for($n = 0; $n < strlen ( $index ); $n ++) {
				$p [] = substr ( $pass_hash, $n, 1 );
			}
			
			array_multisort ( $p, SORT_DESC, $i );
			$index = implode ( $i );
		}
		
		if ($to_num) {
			if (! is_numeric ( $in )) {
				// Digital number <<-- alphabet letter code
				$len = strlen ( $in ) - 1;
				
				for($t = $len; $t >= 0; $t --) {
					$bcp = bcpow ( $base, $len - $t );
					if (empty ( $out )) {
						$out = 0;
					}
					
					$out = $out + strpos ( $index, substr ( $in, $t, 1 ) ) * $bcp;
				}
				
				if (is_numeric ( $pad_up )) {
					$pad_up --;
					
					if ($pad_up > 0) {
						$out -= pow ( $base, $pad_up );
					}
				}
			} else {
				$out = $in;
			}
		} else {
			// Digital number -->> alphabet letter code
			if (is_numeric ( $pad_up )) {
				$pad_up --;
				
				if ($pad_up > 0) {
					$in += pow ( $base, $pad_up );
				}
			}
			
			for($t = ($in != 0 ? floor ( log ( $in, $base ) ) : 0); $t >= 0; $t --) {
				$bcp = bcpow ( $base, $t );
				$a = floor ( $in / $bcp ) % $base;
				$out = $out . substr ( $index, $a, 1 );
				$in = $in - ($a * $bcp);
			}
		}
		
		return $out;
	}
}

if (! function_exists ( 'isImageTypeAllowed' )) {
	function isImageTypeAllowed($filename) {
		$allowed = array (
				'gif',
				'png',
				'jpg',
				'jpeg' 
		);
		
		$ext = pathinfo ( $filename, PATHINFO_EXTENSION );
		if (in_array ( $ext, $allowed )) {
			return true;
		} else {
			return false;
		}
	}
}

if (! function_exists ( 'createDirectory' )) {
	function createDirectory($path) {
		// pre_d($path);
		if(!is_dir ($path)){
			mkdir ( $path, 0777, true );
		}
	}
}

if (! function_exists ( 'removeDirectory' )) {
	function removeDirectory($path) {
		if (file_exists ( $path )) {
			rmdir ( $path );
		}
	}
}
if (! function_exists ( 'removeDirectoryRecursively' )) {
	function removeDirectoryRecursively($path) {
		if (! file_exists ( $path )) {
			return true;
		}
		$files = array_diff ( scandir ( $path ), array (
				'.',
				'..' 
		) );
		foreach ( $files as $file ) {
			(is_dir ( "$path/$file" )) ? delTree ( "$path/$file" ) : unlink ( "$path/$file" );
		}
		return rmdir ( $path );
	}
}

if (! function_exists ( 'moveFileTo' )) {
	function moveFileTo($source, $destination) {
		// move the file path replace if already exists.
		if (copy ( $source, $destination )) {
			if (! is_dir ( $source )) {
				$source = str_replace ( basename ( $source ), "", $source );
			}
			removeDirectoryRecursively ( $source );
		}
	}
}



if (! function_exists ( 'uploadToCloud' )) {
	
	function uploadToCloud($source) {
	
		$source = str_replace ( "\\", "/", $source );
		$public_id = $source;
		$public_id = str_replace ( "/tmp/" , "/", $public_id );
		$public_id = substr($public_id,  strpos($public_id, "/uploads/"),strlen($public_id) );
		$public_id = str_replace ( "/uploads/", "", $public_id );
		$public_id = substr($public_id, 0, strpos($public_id, "."));
		
		$options["public_id"] = $public_id;
		
		if(stringContains($public_id, "/certificates/")){
			
		}else{
			$options["width"] = 180;
			$options["height"] = 180;
			$options["crop"] =  'fit';
		}
		
		/* pre($source);
		pre_d($options); */
		$url = "";
		/* require '/vendor/cloudinary/cloudinary_php/src/Cloudinary.php';
		require '/vendor/cloudinary/cloudinary_php/src/Uploader.php';
		require '/vendor/cloudinary/cloudinary_php/src/Error.php'; */
		\Cloudinary::config(array(
				"cloud_name" => get_app_message("storage_cloud_name"),
				"api_key" => get_app_message("storage_api_key"),
				"api_secret" => get_app_message("storage_api_secret")
		));
		
		/**/
		$res = \Cloudinary\Uploader::upload($source, $options);
		/* echo "<pre>";
		print_r ($res);
		echo "</pre>"; */
		$url = $res ["secure_url"];
		return $url;
	}
}
	
	
	
if (! function_exists ( 'getRealPathFromAbsolutePath' )) {
	function getRealPathFromAbsolutePath($absolutePath) {
		$realPath = $absolutePath;
		if(site_url() != "/"){
			$realPath = str_replace ( site_url (), "", $absolutePath );
		}
		$realPath = FCPATH . $realPath;
		return $realPath;
	}
}

if (! function_exists ( 'ImageFileUpdateWithTemp' )) {
	function ImageFileUpdateWithTemp($tempAbsolutePath, $filePostFix) {
		$newAbsolutePath = "";
		$tempRealPath = getRealPathFromAbsolutePath ( $tempAbsolutePath );
		
		$fileName = basename ( $tempAbsolutePath );
		$ext = pathinfo ( $tempAbsolutePath, PATHINFO_EXTENSION );
		// $fileName = $fileName. $ext;
		
		$newRealPath = str_replace ( "tmp" . "/", "", $tempRealPath );
		$newRealPath = str_replace ( $fileName, $filePostFix . "." . $ext, $newRealPath );
		
		if (get_app_message ( "enable_cloud_storage" ) == "TRUE") {
		 
			return uploadToCloud($tempRealPath);
		} else {
		 
			moveFileTo ( $tempRealPath, $newRealPath );
			$newAbsolutePath = str_replace ( "tmp/", "", $tempAbsolutePath );
			$newAbsolutePath = str_replace ( $fileName, $filePostFix . "." . $ext, $newAbsolutePath );
			
			return $newAbsolutePath;
		}
		
	}
}

if (! function_exists ( 'uploadTempImage' )) {
	function uploadTempImage($path, $filePostFix, $width = 150, $height = 150, $cssClass = "") {
		$maxsize = get_app_message ( "file.upload.max.size" );
		// validate size
		if (($_FILES ['file'] ['size'] >= $maxsize) || ($_FILES ["file"] ["size"] == 0)) {
			$response ["status"] = "failed";
			$response ["message"] = "File too large. File must be less than " . $maxsize / 1048576 . " MB.";
			$json_response = json_encode ( $response );
			return $json_response;
		}
		
		$allowed = isImageTypeAllowed ( $_FILES ["file"] ["name"] );
		// $userEncId = encodeID($_SESSION["sessionUser"]["id"]);
		
		$response = array ();
		if (! empty ( $cssClass )) {
			$response ["cssClass"] = $cssClass;
		}
		if (! $allowed) {
			$response ["status"] = "failed";
			$response ["message"] = get_app_message ( "image.invalid.type" );
			$json_response = json_encode ( $response );
			return $json_response;
		}
		
		$fileName = get_random_string ();
		
		$realPath = FCPATH . $path . "/tmp";
		
		// remove existing tmp directory of user
		//removeDirectoryRecursively ( $realPath );
		// create new working temp direcotry
		createDirectory ( $realPath );
		
		$targetFile = $realPath . "/" . basename ( $fileName . "-" . $filePostFix );
		$ext = pathinfo ( $_FILES ["file"] ["name"], PATHINFO_EXTENSION );
		// $ext = "png";
		$thumbnailFile = $targetFile . "-thumb." . $ext;
		
		$targetFile = $targetFile . "." . $ext;
		$absolutePath = site_url ( $path . "/tmp" ) . "/" . basename ( $fileName . "-" . $filePostFix );
		$absolutePath = $absolutePath . "-thumb." . $ext;
		$check = getimagesize ( $_FILES ["file"] ["tmp_name"] );
		if ($check === false) {
			$response ["status"] = "failed";
			$response ["message"] = get_app_message ( "image.is.not.valid" );
		}
		
		if (move_uploaded_file ( $_FILES ["file"] ["tmp_name"], $targetFile )) {
			
			// create thumbnail
			if ($width == "auto" && $height == "auto") {
				// move_uploaded_file ( $_FILES ["file"] ["tmp_name"], $thumbnailFile );
				copy ( $targetFile, $thumbnailFile );
			} else {
				resizeImage ( $targetFile, $thumbnailFile, $width, $height );
			}
			// delete file
			unlink ( $targetFile );
			
			$response ["status"] = "success";
			
			$response ["message"] = get_app_message ( "image.uploaded.to.tmp" );
			$response ["absolute_path"] = $absolutePath;
		} else {
			$response ["status"] = "failed";
			$response ["message"] = get_app_message ( "cannot_process_request" );
		}
		
		$json_response = json_encode ( $response );
		
		return $json_response;
	}
}

if (! function_exists ( 'uploadWebsiteImage' )) {
	function uploadWebsiteImage($path, $filePostFix) {
		$maxsize = get_app_message ( "file.upload.max.size" );
		// validate size
		if (($_FILES ['file'] ['size'] >= $maxsize) || ($_FILES ["file"] ["size"] == 0)) {
			$response ["status"] = "failed";
			$response ["message"] = "File too large. File must be less than " . $maxsize / 1048576 . " MB.";
			$json_response = json_encode ( $response );
			return $json_response;
		}
		
		$allowed = isImageTypeAllowed ( $_FILES ["file"] ["name"] );
		// $userEncId = encodeID($_SESSION["sessionUser"]["id"]);
		
		$response = array ();
		
		if (! $allowed) {
			$response ["status"] = "failed";
			$response ["message"] = get_app_message ( "image.invalid.type" );
			$json_response = json_encode ( $response );
			return $json_response;
		}
		
		$fileName = get_random_string_alpha ( 2 );
		
		$realPath = FCPATH . $path;
		
		// remove existing tmp directory of user
		// removeDirectoryRecursively($realPath);
		// create new working temp direcotry
		if (! file_exists ( $realPath ) && ! is_dir ( $realPath )) {
			createDirectory ( $realPath );
		}
		
		$targetFile = $realPath . "/" . basename ( $fileName . "-" . $filePostFix );
		$ext = pathinfo ( $_FILES ["file"] ["name"], PATHINFO_EXTENSION );
		// $ext = "png";
		// $thumbnailFile = $targetFile . "-thumb." . $ext;
		
		$targetFile = $targetFile . "." . $ext;
		$absolutePath = site_url ( $path ) . "/" . basename ( $fileName . "-" . $filePostFix );
		$absolutePath = $absolutePath . "." . $ext;
		$check = getimagesize ( $_FILES ["file"] ["tmp_name"] );
		if ($check === false) {
			$response ["status"] = "failed";
			$response ["message"] = get_app_message ( "image.is.not.valid" );
		}
		
		if (move_uploaded_file ( $_FILES ["file"] ["tmp_name"], $targetFile )) {
			
			$response ["status"] = "success";
			$response ["message"] = get_app_message ( "request_processed_successfully" );
			$response ["absolute_path"] = $absolutePath;
		} else {
			$response ["status"] = "failed";
			$response ["message"] = get_app_message ( "cannot_process_request" );
		}
		
		$json_response = json_encode ( $response );
		
		return $json_response;
	}
}


if (! function_exists ( 'resizeImage' )) {
	function resizeImage($img_name, $filename, $new_w, $new_h) {
		// get image extension.
		$ext = $ext = pathinfo ( $img_name, PATHINFO_EXTENSION );
		// creates the new image using the appropriate function from gd library
		if (! strcmp ( "jpg", $ext ) || ! strcmp ( "jpeg", $ext ))
			$src_img = imagecreatefromjpeg ( $img_name );
		if (! strcmp ( "png", $ext ))
			$src_img = imagecreatefrompng ( $img_name );
		// gets the dimmensions of the image
		$old_x = imageSX ( $src_img );
		$old_y = imageSY ( $src_img );
		// next we will calculate the new dimmensions for the thumbnail image
		// the next steps will be taken:
		// 1. calculate the ratio by dividing the old dimmensions with the new ones
		// 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
		// and the height will be calculated so the image ratio will not change
		// 3. otherwise we will use the height ratio for the image
		// as a result, only one of the dimmensions will be from the fixed ones
		$ratio1 = $old_x / $new_w;
		$ratio2 = $old_y / $new_h;
		if ($ratio1 > $ratio2) {
			$thumb_w = $new_w;
			$thumb_h = $old_y / $ratio1;
		} else {
			$thumb_h = $new_h;
			$thumb_w = $old_x / $ratio2;
		}
		// we create a new image with the new dimmensions
		$dst_img = ImageCreateTrueColor ( $thumb_w, $thumb_h );
		// resize the big image to the new created one
		imagecopyresampled ( $dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y );
		// output the created image to the file. Now we will have the thumbnail into the file named by $filename
		
		if (! strcmp ( "png", $ext )) {
			imagepng ( $dst_img, $filename );
		} else {
			imagejpeg ( $dst_img, $filename );
		}
		// destroys source and destination images.
		imagedestroy ( $dst_img );
		imagedestroy ( $src_img );
	}
}

if (! function_exists ( 'generate_slug' )) {
	function generate_slug($input = "") {
		$slug = "";
		if (empty ( $input )) {
			return $slug;
		}
		
		$slug = trim ( $input );
		$slug = strtolower ( str_replace ( "  ", " ", $slug ) );
		$slug = str_replace ( " ", "-", $slug );
		return $slug;
	}
}

if (! function_exists ( 'unset_empty_indexes' )) {
	function unset_empty_indexes($arr = array()) {
		if ($arr == null || empty ( $arr )) {
			return array ();
		}
		
		foreach ( $arr as $k => $index ) {
			if (empty ( $index )) {
				unset ( $arr [$k] );
			}
		}
		return $arr;
	}
}

if (! function_exists ( 'getClientCountry' )) {
	function getClientCountry() {
		/*
		 * $CI = get_instance();
		 * $CI->load->model('Countriesip_Model', 'countriesIp');
		 *
		 * $clientIP = $_SERVER['REMOTE_ADDR'];
		 * $countryCode="Other";
		 * $countries = $CI->countriesIp->getByClientIP($clientIP);
		 *
		 * pre_d( $countries);
		 * if(!empty($countries) && isset($countries[0]["cc"])){
		 * $countryCode = $countries[0]["cc"];
		 * }
		 * return $countryCode;
		 */
		
		// pre_d($_COOKIE);
		$countryCode = "Other";
		
		// $countryCode = $req->input->cookie('SL_COUNTRY',TRUE);
		if (isset ( $_COOKIE ['SL_COUNTRY'] )) {
			if ($_COOKIE ['SL_COUNTRY'] != '' && $_COOKIE ['SL_COUNTRY'] != null) {
				$countryCode = $_COOKIE ['SL_COUNTRY'];
			}
		}
		 
		return $countryCode;
	}
}

if (! function_exists ( 'loadDbTableLib' )) {
	function loadDbTableLib() {
		$CI = & get_instance ();
		$CI->load->library ( 'Table' );
	}
}

if (! function_exists ( 'trimRightString' )) {
	function trimRightString($str, $length) {
		if (strlen ( $str ) > $length) {
			$new = substr ( $str, 0, $length );
			$new .= "...";
			return $new;
		} else {
			return $str;
		}
	}
}

if (! function_exists ( 'stringContains' )) {
	function stringContains($source, $toFind) {
		if (strpos ( $source, $toFind ) !== false) {
			return true;
		} else {
			return false;
		}
	}
}

if (! function_exists ( 'isImageFile' )) {
	function isImageFile($url) {
		$size = getimagesize ( $url );
		return (strtolower ( substr ( $size ['mime'], 0, 5 ) ) == 'image' ? true : false);
	}
}
		





