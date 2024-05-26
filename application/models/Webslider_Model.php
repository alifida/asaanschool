<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Webslider_Model extends Base_Model {
	private $table = "web_slider";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	public function getById($id='') {
		$slider = array ();
		if(empty($id)){
			return $slider;
		}
		$websiteId = getWebsiteIdByURL();
		$condition = "(website_id = '$websiteId' AND id ='$id' )";
		$slider = parent::getByCondition ( $condition );
		if(!empty($slider)){
			$slider = $slider[0];
			
			$slides = array ();
			if ($slider ["config"]) {
				$slides = json_decode ( $slider ["config"], true );
				$slider ["slides"] = $slides;
			}
				
			$slider ["slides"] = $slides;
			
		}
		return $slider;
	}
	public function getByWebsite() {
		$sliders = array ();
		$websiteId = getWebsiteIdByURL();
		$condition = "(website_id = '$websiteId' )";
		$sliders = parent::getByCondition ( $condition );
		
		return $sliders;
	}
}
