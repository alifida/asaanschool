<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Base_Model.php');
class Classfee_Model extends Base_Model {

	
	private $table = "class_fee";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}

	
	public function get($id = null) {
		if($id==null){
			return array();
		}
		$row = parent::get($id);
			if(!empty($row)){
				// load reference models
				$this->load->model('Class_Model', 'class');
				$this->load->model('Feetype_Model', 'feeType');
				$class = $this->class->get($row["class_id"]);
				$feeType = $this->feeType->get($row["fee_type_id"]);
				$row["class"]=$class;
				$row["feeType"]=$feeType;
			}

			return $row;

	}
	public function getByClassIds($classIds = array()) {
		if (empty($classIds )) {
			return array();
		}
		$rs = parent::getIn($classIds,"class_id");
		if(!empty($rs)){
			$this->load->model('Class_Model', 'class');
			$this->load->model('Feetype_Model', 'feeType');
			foreach($rs as $key => $row){
				$class = $this->class->get($row["class_id"]);
				$feeType = $this->feeType->get($row["fee_type_id"]);
				$rs[$key]["class"]=$class;
				$rs[$key]["fee_type"]=$feeType;
			}
		}
		return $rs;
	}

	
}
