<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Website_Model extends Base_Model {
	private $table = "websites";
	public $branchId;
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
		//$this->branchId = getWebsiteIdByURL();
		$this->branchId = $_SESSION["currentCampus"]["id"];
	}
	public function getByBranchId() {
		// pre_d($_SESSION["currentCampus"]);
		$website = parent::getByColumn( "campus_id", $this->branchId );
		
		if (! empty ( $website )) {
			 
			$website = $website [0];
			$this->load->model ( 'Webpage_Model', 'webPage' );
			$webPages = $this->webPage->getByWebsite ( $website ["id"] );
			$website ["webPages"] = $webPages;
			$template = $this->webPage->getPublicTemplate ( $website ["web_template_id"] );
			$website ["webTemplate"] = $template;
		}
		return $website;
	}
	
	public function merge($data) {
		$data ["campus_id"] = $this->branchId;
		return parent::merge ( $data );
	}
	public function createFreshWebsiteByBranch() {
		$website = array ();
		$website ["campus_id"] = $this->branchId;
		$res = $this->merge ( $website );
		
		//pre_d($this->db->last_query());
		return $res;
	}
	public function isDomainAvailable($requestedDomain = "") {
		if (empty ( $requestedDomain )) {
			return array ();
		}
		$website = parent::getByColumn ( "domain, $requestedDomain" );
		
		if (empty ( $website )) {
			return true;
		} else {
			return false;
		}
	}
}
