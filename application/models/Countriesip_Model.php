<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Countriesip_Model extends CI_Model {

	private $TABLE = "countires_ip";
	public function __construct() {
		parent::__construct();
		
	}

	/**
	 * This funtion takes id as a parameter and will fetch the record.
	 * If id is not provided, then it will fetch all the records form the table.
	 * @param int $id
	 * @return mixed
	 */
	public function getByClientIP($ip="") {
		$rs = array();
		if(empty($ip)){
			return $rs;
		}
		$ip_num = sprintf("%u", ip2long($ip));
		
		$this->db->select()->from($this->TABLE);

		$this->db->where("( $ip_num BETWEEN `start` AND `end`)");

		$query = $this->db->get();

		$rs = $query->result_array(); 
pre_d($this->db->last_query());
		return $rs;
		
	}
	

	
	

}
