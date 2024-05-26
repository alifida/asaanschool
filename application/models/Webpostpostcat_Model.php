<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Webpostpostcat_Model extends Base_Model {
	private $table = "web_post_post_categories";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	public function removeByPostId($postId) {
		$condition = "(post_id = '$postId')";
		return parent::removeByCondition ( $condition );
	}
	public function getByPostId($postId) {
		$postCategories = parent::getByColumn ( "post_id", $postId );
		
		if (! empty ( $postCategories )) {
			$this->load->model ( 'Webpostcat_Model', 'postCat' );
			foreach ( $postCategories as $key => $postCat ) {
				$category = $this->postCat->getById ( $postCat ["category_id"] );
				$postCategories [$key] ["category"] = $category;
			}
		}
		return $postCategories;
	}
	
}
