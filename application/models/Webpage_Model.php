<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Webpage_Model extends Base_Model {
	private $table = "web_pages";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	public function getByIDorURL($id,$url, $websiteId) {
		$page = array();
		if(!empty($id)){
			$page = parent::getByCondition ( "(website_id = '$websiteId' AND id = '$id')" );
		}elseif(!empty($url)){
			$page = parent::getByCondition ( "(website_id = '$websiteId' AND page_url = '$url')" );
			//pre('iiiiiiiiii');
		}
		 
		$postCategories = array ();
		
		if (! empty ( $page )) {
			$page = $page [0];
			if (! empty ( $page ["slider_id"] )) {
				$this->load->model ( 'Webslider_Model', 'slider' );
				$slider = $this->slider->getById ( $page ["slider_id"] );
				$page ["slider"] = $slider;
			}
			
			// load pagepostcategories
			$this->load->model ( 'Webpagepostcat_Model', 'pagePostCat' );
			$this->load->model ( 'Webpostcat_Model', 'postCat' );
			$this->load->model ( 'Webpost_Model', 'post' );
			$pageId = $page ["id"];
			$postCategories = $this->pagePostCat->getByCondition ( "(page_id='$pageId')", 'sort_order', 'asc' );
			 
			if(!empty($postCategories)){
				$today = getCurrentDate();
				$status = get_app_message("db.status.published");
				foreach ($postCategories as $pagePostCat){
					$category = $this->postCat->getById($pagePostCat["category_id"]);
					$posts = $this->post->getByCategoryStatusAndDate($pagePostCat["category_id"],$status, $today, $pagePostCat["top_records"]);
					//$posts = $this->post->getByCondition("(id = '".$pagePostCat["category_id"]."' and status ='".get_app_message("db.status.published")."')");
					$col = $pagePostCat["layout_column"];
					$postsWrapper = array();
					$postsWrapper["post_template"] = $pagePostCat["post_template"];
					$postsWrapper["posts"] = $posts;
					$postsWrapper["category"] = $category;
					$page[$col][] = $postsWrapper;
				}
			}
		}
		//$page ["postCategories"] = $postCategories;
		return $page;
	}
	
	
	
	
	public function getById($id = null) {
		$page = array ();
		if ($id == null) {
			return $webPage;
		}
		$postCategories = array ();
		
		$websiteId = getWebsiteIdByURL ();
		
		$page = parent::getByCondition ( "(website_id = '$websiteId' AND id = '$id')" );
		if (! empty ( $page )) {
			$page = $page [0];
			$this->load->model ( 'Webpagepostcat_Model', 'pagePostCat' );
			$pageId = $page ["id"];
			$postCategories = $this->pagePostCat->getByCondition ( "(page_id='$pageId')", 'sort_order', 'asc' );
		}
		$page ["postCategories"] = $postCategories;
		
		return $page;
	}
	public function getByIds($ids = array()) {
		$webPages = array ();
		if (empty ( $ids )) {
			return $webPages;
		}
		$websiteId = getWebsiteIdByURL ();
		$this->db->select ()->from ( 'web_pages' );
		
		$this->db->where ( "(website_id = '$websiteId' )" );
		$this->db->where_in ( 'id', $ids );
		
		$query = $this->db->get ();
		$webPages = $query->result_array ();
		
		return $webPages;
	}
	public function getByLayout($layout = null) {
		$webPage = array ();
		if ($layout == null) {
			return $webPage;
		}
		$websiteId = getWebsiteIdByURL ();
		$this->db->select ()->from ( 'web_pages' );
		
		$this->db->where ( "(website_id = '$websiteId' AND layout = '" . $layout . "')" );
		
		$query = $this->db->get ();
		$webPages = $query->result_array ();
		
		if (! empty ( $webPages )) {
			$this->load->model ( 'Webpagepostcat_Model', 'pagePostCat' );
			foreach ( $webPages as $key => $webPage ) {
				$pageId = $webPage ["id"];
				$postCategories = $this->pagePostCat->getByCondition ( "(page_id='$pageId')", 'sort_order', 'asc' );
				$webPages [$key] ["postCategories"] = $postCategories;
			}
		}
		
		return $webPages;
	}
	
	public function getDefaultFooterPageId(){
		$footerId = "";
		$websiteId = getWebsiteIdByURL ();
		$defaultFooter = parent::getByCondition("((is_default_footer='on' or is_default_footer='true' or is_default_footer='1') and website_id = '$websiteId')");
		
		if(!empty($defaultFooter)){
			$footerId = $defaultFooter[0]["id"];
		}
		return $footerId;
	}
	public function getAvailableMenuItems() {
		$availableMenuItems = array ();
		$websiteId = getWebsiteIdByURL ();
		$sqlString = sprintf ( "SELECT  * FROM   " . "	web_pages p   " .
								" WHERE   " . 
								" p.website_id = '" . $websiteId . "'  " .
								" AND p.`status` = '" . get_app_message ( "post.status.published" ) . "'   " .
								" AND p.id NOT IN(   " .
								"			SELECT  menu.web_page_id   " .
								"			FROM website_menu menu   " .
								"			WHERE menu.website_id = '" . $websiteId . "' " .
								"			AND menu.web_page_id is not null ".
								"	)" );
		//pre_d($sqlString);
		$query = $this->db->query ( $sqlString );
		$availableMenuItems = $query->result_array ();
		
		return $availableMenuItems;
	}
	
	public function getPublishedPages(){
		$websiteId = getWebsiteIdByURL ();
		return parent::getByCondition( "(website_id = '$websiteId' AND `status` = '" . get_app_message ( "post.status.published" ) . "')");
	}
	public function remove($id, $deleteByColumn = 'id') {
		$websiteId = getWebsiteIdByURL ();
		$this->db->where ( "(website_id = '$websiteId' AND id = '$id')" );
		$this->db->delete ( 'web_pages' );
	}
	public function getByWebsite($websiteId = null) {
		$webPages = array ();
		if ($websiteId == null) {
			return $webPages;
		}
		$this->db->select ()->from ( 'web_pages' );
		$this->db->where ( 'website_id', $websiteId );
		
		$query = $this->db->get ();
		$webPages = $query->result_array ();
		return $webPages;
	}
	/*
	 * public function updateWebpagePosts($newPosts, $webPageId = "") {
	 * // delete the existing posts and link the new ones...
	 * if (empty ( $webPageId )) {
	 * return;
	 * }
	 *
	 * $this->db->where ( "(page_id = '$webPageId')" );
	 * $this->db->delete ( 'web_pages_posts' );
	 *
	 * if (! empty ( $newPosts )) {
	 * foreach ( $newPosts as $post ) {
	 * $data = array ();
	 * $data ["page_id"] = $webPageId;
	 * $data ["post_id"] = $post ["id"];
	 * $this->db->insert ( 'web_pages_posts', $data ); // insert new record
	 * $newId = $this->db->insert_id ();
	 * }
	 * }
	 * }
	 */
	
	/**
	 * ****************** PUBLIC PAGES **********************
	 */
	public function getRequestedPublicWebPage($domain = null, $pageUrl) {
		$data = array ();
		if ($domain == null || $pageUrl == null) {
			return $data;
		}
		// get website object
		$website = array ();
		
		$this->db->select ()->from ( 'websites' );
		$this->db->where ( 'domain', $domain );
		$query = $this->db->get ();
		$website = $query->row_array (); // single row
		
		if (! empty ( $website )) {
			
			$this->db->select ()->from ( 'branches' );
			$this->db->where ( 'id', $website ["branch_id"] );
			$query = $this->db->get ();
			$campus = $query->row_array (); // single row
			
			if (isset ( $campus ["contact_detail_id"] ) && ! empty ( $campus ["contact_detail_id"] )) {
				$campusContactDetails = array ();
				
				$this->db->select ()->from ( 'contact_details' );
				$this->db->where ( 'id', $campus ["contact_detail_id"] );
				$query = $this->db->get ();
				$campusContactDetails = $query->row_array (); // single row
				$campus ["contactDetails"] = $campusContactDetails;
				$website ["campus"] = $campus;
			}
			
			// get contact Details of website
			
			// get page contents
			$webpage = $this->getPublicPage ( $pageUrl, $website ["id"] );
			$footer = $this->getSiteFooter ( $website ["id"] );
			// get topMenu
			$topMenu = $this->getPublicTopMenu ( $website ["id"] );
			// get template
			$template = $this->getPublicTemplate ( $website ["web_template_id"] );
			$data ["webpage"] = $webpage;
			$data ["website"] = $website;
			$data ["template"] = $template;
			$data ["topMenu"] = $topMenu;
			$data ["footer"] = $footer;
		}
		return $data;
	}
	public function getPublicPage($pageUrl, $webSiteId) {
		$webpage = array ();
		if ($pageUrl == null || $webSiteId == null) {
			return $webpage;
		}
		$this->db->select ()->from ( 'web_pages' );
		$this->db->where ( "(website_id = '$webSiteId' AND page_url = '$pageUrl' )" );
		
		$query = $this->db->get ();
		
		$webPages = $query->result_array ();
		
		if (! empty ( $webPages )) {
			$webpage = $webPages [0];
		}
		return $webpage;
	}
	public function getSiteFooter($webSiteId) {
		$footer = array ();
		if ($webSiteId == null) {
			return $footer;
		}
		$this->load->model ( 'Webpagetype_Model', 'pageType' );
		$type = $this->pageType->getByType ( get_app_message ( "db.website.template.type.footer" ) );
		
		$this->db->select ()->from ( 'web_pages' );
		$this->db->where ( "(website_id = '$webSiteId' AND type_id = '" . $type ["id"] . "' )" );
		
		$query = $this->db->get ();
		
		$webPages = $query->result_array ();
		
		if (! empty ( $webPages )) {
			$footer = $webPages [0];
			if (! empty ( $footer ["type_id"] )) {
				$footer ["pageType"] = $type;
				
				$this->load->model ( 'Webpost_Model', 'post' );
				$posts = $this->getPublicPostsByPage ( $footer ["id"] );
				$footer ["posts"] = $posts;
			}
		}
		return $footer;
	}
	public function getPublicTemplate($templateId) {
		if ($templateId == null) {
			return array ();
		}
		$this->db->select ()->from ( 'web_templates' );
		$this->db->where ( "id", $templateId );
		$this->db->where ( "status", get_app_message ( "db.status.active" ) );
		$query = $this->db->get ();
		
		$webTemplate = $query->result_array ();
		if (! empty ( $webTemplate )) {
			return $webTemplate [0];
		} else {
			array ();
		}
	}
	public function getPublicAvailableTemplates() {
		$webTemplate = array ();
		$this->db->select ()->from ( 'web_templates' );
		
		$this->db->where ( "status", get_app_message ( "db.status.active" ) );
		$query = $this->db->get ();
		
		$webTemplate = $query->result_array ();
		return $webTemplate;
	}
	public function getPublicTopMenu($webSiteId) {
		/*
		 * if( $webSiteId==null){
		 * return array();
		 * }
		 * $this->db->select('page_url,menu_title');
		 * $this->db->from('web_pages');
		 *
		 * $this->db->where("(website_id = '$webSiteId' AND type_id <> 3 AND (page_url is not null OR page_url <> '') AND status = '".get_app_message("post.status.published")."')");
		 * $this->db->order_by('menu_sort_order');
		 * $query = $this->db->get();
		 * $topMenu = $query->result_array();
		 * return $topMenu;
		 */
		$this->load->model ( 'Websitemenu_Model', 'menu' );
		$menu = $this->menu->getByWebsite ( $webSiteId );
		return $menu;
	}
	/*
	 * public function getPublicPostsByPage($webPageId = null) {
	 * $webPosts = array ();
	 * if ($webPageId == null) {
	 * return $webPosts;
	 * }
	 * $this->db->select ()->from ( 'web_pages_posts' );
	 * $this->db->distinct ();
	 * $this->db->where ( 'web_page_id', $webPageId );
	 * $this->db->order_by ( 'web_post_id', 'desc' );
	 * $query = $this->db->get ();
	 * $rs = $query->result_array ();
	 *
	 * if (! empty ( $rs )) {
	 * foreach ( $rs as $key => $row ) {
	 * if (! empty ( $row ["web_post_id"] )) {
	 * $this->db->select ()->from ( 'web_posts' );
	 * $this->db->where ( "id", $row ["web_post_id"] );
	 * $query = $this->db->get ();
	 * $post = $query->row_array ();
	 *
	 * $webPosts [] = $post;
	 * }
	 * }
	 * }
	 * return $webPosts;
	 * }
	 */
}
