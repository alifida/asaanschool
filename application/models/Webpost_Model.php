<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once('Base_Model.php');
class Webpost_Model extends Base_Model {
	private $table = "web_posts";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}

	
	public function getById($id = null) {
		$post = array();
		if($id == null){
			return $post;
		}
		$websiteId = getWebsiteIdByURL();
		$condition ="(website_id = '$websiteId' AND id = '$id')";
		$post = parent::getByCondition($condition);
		
		if(!empty($post)){
			$post = $post[0];
			
			// load categories
			$this->load->model ( 'Webpostpostcat_Model', 'postPostCat' );
			$postCats = $this->postPostCat->getByPostId($id);
			$post["categories"] = $postCats;
			
			
			
		}
		return $post;
		
	}
	
	
	 public function getByIds($ids = array()) {
		$posts = array();
		
		if(empty($ids)){
			return $posts;
		}
		
		$websiteId = getWebsiteIdByURL();
		$this->db->select()->from($this->parentTable);
		
		$this->db->where("(website_id = '$websiteId')");
		$this->db->where_in('id', $ids);
	
		$query = $this->db->get();
	
		$posts = $query->result_array(); // array of result
		
		return $posts;
	
	}
	 
	
	
	public function getByWebsite() {
		$posts = array();
		$websiteId = getWebsiteIdByURL();
		$condition ="(website_id = '$websiteId' )";
		$posts = parent::getByCondition($condition, 'publish_at', 'desc');
		 
		
		return $posts;
		
	}
	public function getByWebPage($pageId = null) {
		$posts = array();
		if($pageId == null){
			return $posts;
		}
		$websiteId = getWebsiteIdByURL();
		$sql =	" SELECT distinct post.* FROM web_posts post, web_pages page, web_pages_posts page_post ".
				" WHERE page.id = page_post.page_id ".
				" AND page_post.post_id = post.id ".
				" AND post.website_id = '$websiteId' ";
		
		return parent::getBySQLQuery($sql);
	}

	public function getByCategory($categoryId = null) {
		$webPosts = array();
		if($categoryId == null){
			return $webPosts;
		}
		$websiteId = getWebsiteIdByURL();
		$sql =	" SELECT * FROM web_posts p, web_post_categories pc,  web_post_post_categories ppc  ".
				" WHERE p.id = ppc.post_id ".
				" AND ppc.category_id = pc.id ".
				" AND pc.id = '$categoryId' ".
				" AND p.website_id = '$websiteId'". 
				" ORDER BY publish_at desc ";
		return parent::getBySQLQuery($sql);
	}
	
	public function getByCategoryStatusAndDate($categoryId = null, $status = "", $date="", $recordPerPage = null, $page = 1) {
		$webPosts = array();
		if($categoryId == null){
			return $webPosts;
		}
		$websiteId = getWebsiteIdByURL();
		
		
		$sql =	" SELECT * FROM web_posts p, web_post_categories pc,  web_post_post_categories ppc  ".
				" WHERE p.id = ppc.post_id ".
				" AND ppc.category_id = pc.id ".
				" AND pc.id = '$categoryId' ";
		if(!empty($status)){
			$sql .=	" AND p.status = '$status' ";
		}
		if(!empty($status)){
			$sql .=	" AND '$date' BETWEEN p.publish_at AND p.expire_at ";
		}
		$sql .=	" AND p.website_id = '$websiteId'". 
				" ORDER BY updated_at desc ";
	
		if(!empty($recordPerPage)){
			$from = $page - 1 ;
			$from = $from * $recordPerPage;
			$sql .=' limit '.$from .', '. $recordPerPage;
		}
		return parent::getBySQLQuery($sql);
	}
	

	

	
	
	public function merge($data) {

		// comma must be the first and last character of String if it is not empty.

		$categories = array();
		if(isset($data["categories"])){
			$categories = $data["categories"];
			unset($data["categories"]);
		}
		
		$websiteId = getWebsiteIdByURL();
		$data['website_id'] = $websiteId;
		$response = parent::merge($data);
		
		if(is_numeric ( $response )){
			$data["id"] = $response;
		}
		if(!empty($data["id"]) && !empty($categories) ){
			$postCategories = array();
			foreach ($categories as $cat){
				$postCategory = array();
				$postCategory["post_id"] = $data["id"]; 
				$postCategory["category_id"] = $cat; 
				$postCategories[] = $postCategory;
			}
			
			
			
			$this->load->model ( 'Webpostpostcat_Model', 'postPostCat' );
			$res = $this->postPostCat->removeByPostId($data["id"]);
			$res = $this->postPostCat->saveMultiple($postCategories);
			
		}
		return $response;
	}
	
	public function getByCatName($cat="", $websiteId){
		$sql =	"	SELECT post.* ".
				"	FROM web_posts post, web_post_categories cat , web_post_post_categories postCat ".
				"	WHERE post.`status` = 'Published' ".
				"	AND post.website_id = $websiteId ".
				"	AND post.id= postCat.post_id ".
				"	AND postCat.category_id = cat.id  ".
				"	AND cat.`name` = '$cat'";
		return parent::getBySQLQuery($sql);
	}
	
	public function getByTitle($title="", $websiteId){
		
		return parent::getByCondition("(website_id ='$websiteId' and slug='$title' )");
	}
	


}
