<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Webpostcat_Model extends Base_Model {
	private $table = "web_post_categories";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	public function getById($id = null, $loadParent=true, $loadChild=false) {
		$cat = array ();
		if ($id == null) {
			return $cat;
		}
		$websiteId = getWebsiteIdByURL();
		$condition = "(website_id = '$websiteId' AND id = '$id')";
		$cat = parent::getByCondition ( $condition );
		if (! empty ( $cat )) {
			$cat = $cat [0];
		}
		
		if ($loadParent && ! empty ( $cat ["parent_id"] ) && $cat ["parent_id"] != 0) {
			$cat ["parent"] = $this->getById ( $cat ["parent_id"], $loadParent, $loadChild );
		}

		if ($loadChild) {
			$cat ["childs"] = $this->getChilds( $cat ["id"]);
		}
		
		return $cat;
	}
	public function getForMenu($id = null) {
		$cat = array ();
		if ($id == null) {
			return $cat;
		}
		$websiteId = getWebsiteIdByURL();
		$sql = 	" SELECT cat.id as id, cat.name as title, cat.id as target_url, 'postCat' as type FROM web_post_categories cat ".
				" where cat.id = '$id' ". 
				" and cat.website_id = '$websiteId' ";
		$cat = parent::getBySQLQuery( $sql);
		if (! empty ( $cat )) {
			$cat = $cat [0];
		}

		$cat ["children"] = $this->getChildsForMenu( $cat ["id"]);
		if(!empty($cat ["children"])){
			$cat["target_url"] = "javascript:void(0);";
		}
		
		return $cat;
	}
	public function getByIds($ids = array()) {
		$cats = array ();
		
		if (empty ( $ids )) {
			return $cats;
		}
		
		$websiteId = getWebsiteIdByURL();
		$this->db->select ()->from ( $this->parentTable );
		
		$this->db->where ( "(website_id = '$websiteId')" );
		$this->db->where_in ( 'id', $ids );
		
		$query = $this->db->get ();
		
		$cats = $query->result_array (); // array of result
		if (! empty ( $cats )) {
			foreach ( $cats as $key => $cat ) {
				$cats [$key] ["childs"] = $this->getChilds ( $cat ["id"] );
				
			}
		}
		return $cats;
	}
	public function getByWebsite() {
		$cats = array ();
		
		$websiteId = getWebsiteIdByURL();
		$condition = "(website_id= '$websiteId')";
		$cats = parent::getByCondition ( $condition );
		if (! empty ( $cats )) {
			foreach ( $cats as $key => $cat ) {
				if (! empty ( $cat ["parent_id"] ) && $cat ["parent_id"] != 0) {
					$cats [$key] ["parent"] = $this->getById ( $cat ["parent_id"] );
				}
			}
		}
		return $cats;
	}
	public function getChilds($parentId) {
		$cats = array ();
		if ($parentId == null) {
			return $cats;
		}
		$websiteId = getWebsiteIdByURL();
		$condition = "(website_id = '$websiteId' AND parent_id = '$parentId')";
		$cats = parent::getByCondition ( $condition );
		if(!empty($cats)){
			foreach ($cats as $key => $cat){
				$cats[$key]["childs"] = $this->getChilds($cat["id"]);
			}
		}
		return $cats;
	}
	public function getChildsForMenu($parentId) {
		$cats = array ();
		if ($parentId == null) {
			return $cats;
		}
		$websiteId = getWebsiteIdByURL();
		/* $condition = "(website_id = '$websiteId' AND parent_id = '$parentId')";
		$cats = parent::getByCondition ( $condition );
		 */
		$sql = 	" SELECT cat.id as id, cat.name as title, cat.id as target_url, 'postCat' as type FROM web_post_categories cat ".
				" where cat.parent_id = '$parentId' ".
				" and cat.website_id = '$websiteId' ";
		$cats = parent::getBySQLQuery( $sql);
		
		
		if(!empty($cats)){
			foreach ($cats as $key => $cat){
				$cats[$key]["children"] = $this->getChildsForMenu($cat["id"]);
				if(!empty($cats[$key]["children"])){
					$cats[$key]["target"] = "javascript:void(0);";
				}
			}
		}
		return $cats;
	}
	public function getAllParents() {
		$cats = array ();
		
		$websiteId = getWebsiteIdByURL();
		$condition = "(website_id= '$websiteId' and (parent_id is null or parent_id = 0))";
		$cats = parent::getByCondition ( $condition );
		
		if (! empty ( $cats )) {
			foreach ( $cats as $key => $cat ) {
				$cats [$key] ["childs"] = $this->getChilds ( $cat ["id"] );
			}
		}
		return $cats;
	}

	public function getAvailableForMenu() {
		$cats = array ();
		
		$websiteId = getWebsiteIdByURL();
		$sql = 	" SELECT * FROM ".
				" web_post_categories cat ".
				" WHERE ".
				" cat.website_id = '$websiteId' ".
				" AND (cat.parent_id is null or cat.parent_id = 0) ".
				" AND cat.id NOT IN( ".
				" 		SELECT ".
				" 		menu.web_post_cat_id ".
				" 		FROM ".
				" 		website_menu menu ".
				" 		WHERE ".
				" 		menu.website_id = '$websiteId' ".
				" 		and menu.web_post_cat_id is not null ".
				" )";
		//pre_d($sql);
		$cats = parent::getBySQLQuery($sql);
		
		if (! empty ( $cats )) {
			foreach ( $cats as $key => $cat ) {
				$cats [$key] ["childs"] = $this->getChilds ( $cat ["id"] );
			}
		}
		return $cats;
	}
	public function merge($data) {
		
		if(isset($data["parent_id"]) && (empty($data["parent_id"]) || $data["parent_id"]==0)){
			unset($data["parent_id"]);
		}
		
		return parent::merge($data);
	
	}
}
