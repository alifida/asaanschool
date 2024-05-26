<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Controller.php');
class Tos extends Base_Controller {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$this->load->view ( 'schools/tos', array () );
	}
}
