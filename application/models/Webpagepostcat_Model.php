<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Webpagepostcat_Model extends Base_Model {
	private $table = "web_page_post_categories";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	
	
	
}
