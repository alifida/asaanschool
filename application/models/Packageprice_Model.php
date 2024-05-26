<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Packageprice_Model extends CI_Model {

	private $TABLE = "app_packages_price";
	public function __construct() {
		parent::__construct();
		
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function getPrice($packageId, $countryCode) {
		
		if('PK' != $countryCode){
			$countryCode ='Other';
		}
		
		$rs = array();
		
		if(empty($packageId) || empty($countryCode)){
			return $rs;
		}
		
		$this->db->select()->from($this->TABLE);

		$this->db->where("(`country`='$countryCode' AND `app_package_id`='$packageId' )");

		$query = $this->db->get();

		$rs = $query->row_array(); 

		return $rs;
		
	}
	

	
	

}
