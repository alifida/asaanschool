<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Base_Model.php');
class Websitemenu_Model extends Base_Model {
	private $table = "website_menu";
	public function __construct() {
		parent::__construct ();
		$this->parentTable = $this->table;
	}
	public function getById($id = null) {
		$menu = array ();
		if ($id == null) {
			return $menu;
		}
		$websiteId = getWebsiteIdByURL();
		$menu = parent::getByCondition("(website_id = '$websiteId' AND id = '$id')");
		if(!empty($menu)){
			$menu = $menu[0];
		}
		
		return $menu;
	}
	public function getByWebsite($websiteId = null) {
		$menuItems = array ();
		if ($websiteId == null) {
			return $menuItems;
		}
		
		$menuItems = parent::getByCondition("(website_id = '$websiteId' )", 'sort_order','asc');
		
		$menu = array ();
		if (! empty ( $menuItems )) {
			foreach ( $menuItems as $key => $item ) {
				// $item["children"] = $children;
				if ($item ["parent_id"] == null || empty ( $item ["parent_id"] )) {
					$item = $this->setChildren ( $menuItems, $item );
					$menu [] = $item;
				}
			}
		}
		return $menu;
	}
	public function getAllByWebsite($websiteId = null) {
		$menuItems = array ();
		if ($websiteId == null) {
			return $menuItems;
		}
		
		$rs = parent::getByCondition("(website_id = '$websiteId' )", 'sort_order', 'asc');
		return $rs;
	}
	public function setChildren(&$menuItems, $parent) {
		$parent ["children"] = array ();
		foreach ( $menuItems as $key => $item ) {
			if ($item ["parent_id"] == $parent ["id"]) {
				// unset($menuItems[$key]);
				$item = $this->setChildren ( $menuItems, $item );
				$parent ["children"] [] = $item;
			}
		}
		return $parent;
	}
	public function saveMenu($menuJSON) {
		$menuItems = array ();
		$menuIds = array ();
		if (! empty ( $menuJSON )) {
			$menuIds = json_decode ( $menuJSON );
		}
		
		if (! empty ( $menuIds )) {
			
			$menuItem = array ();
			$this->load->model ( 'Webpage_Model', 'page' );
			foreach ( $menuIds as $key => $menuId ) {
				/*
				 * if (strpos($menuId->id,'page-') !== false) {
				 * // load page and create menu Item
				 * $pageId = str_replace("page-","",$menuId->id);
				 * $page = $this->page->getById($pageId);
				 * if(!empty($page)){
				 * $menuItem = array();
				 * $menuItem["title"] = $page["menu_title"];
				 * $menuItem["target_url"] = $page["page_url"];
				 * $menuItem["website_id"] = $page["website_id"];
				 * //$menuItem["parent_id"] = "";
				 * $newId = $this->insert($menuItem);
				 * $menuItem["id"] = $newId;
				 * }
				 * }else{
				 * $menuItem = $this->getById($menuId->id);
				 * $menuItem["parent_id"] = "";
				 * }
				 */
				
				$menuItem = $this->getById ( $menuId->id );
				$menuItem ["parent_id"] = "";
				$menuItem ["sort_order"] = $key + 1;
				$menuItems [] = $menuItem;
				if (isset ( $menuId->children ) && ! empty ( $menuId->children )) {
					$childs = $this->getChild ( $menuId->id, $menuId->children, $key );
					$menuItems = array_merge ( $menuItems, $childs );
				}
			}
		}
		if (! empty ( $menuItems )) {
			// save existing menu
			$this->db->trans_start ();
			$this->db->update_batch ( 'website_menu', $menuItems, 'id' );
			if ($this->db->trans_status () === FALSE) {
				$this->db->trans_rollback ();
				return get_app_message ( "response.failed" );
			} else {
				$this->db->trans_complete ();
				return get_app_message ( "response.success" );
			}
		} else {
			return get_app_message ( "response.success" );
		}
	}
	public function deleteBySite($websiteId) {
		$this->db->where ( "(website_id = '$websiteId')" );
		$this->db->delete ( 'website_menu' );
	}
	public function getChild($parentId, $menuIds, $counter) {
		$menuItems = array ();
		$menuItem = array ();
		foreach ( $menuIds as $menuId ) {
			/*
			 * if (strpos($menuId->id,'page-') !== false) {
			 * // load page and create menu Item
			 * $pageId = str_replace("page-","",$menuId->id);
			 * $page = $this->page->getById($pageId);
			 * if(!empty($page)){
			 * $menuItem = array();
			 * $menuItem["title"] = $page["menu_title"];
			 * $menuItem["target_url"] = $page["page_url"];
			 * $menuItem["website_id"] = $page["website_id"];
			 * //$menuItem["parent_id"] = "";
			 *
			 * $newId = $this->insert($menuItem);
			 * $menuItem["id"] = $newId;
			 *
			 * }
			 * }else{
			 * $menuItem = $this->getById($menuId->id);
			 * $menuItem["parent_id"] = $parentId;
			 * }
			 */
			
			$menuItem = $this->getById ( $menuId->id );
			$menuItem ["parent_id"] = $parentId;
			
			$menuItem ["sort_order"] = $counter + 1;
			
			$menuItems [] = $menuItem;
			if (isset ( $menuId->children ) && ! empty ( $menuId->children )) {
				$childs = $this->getChild ( $menuId->id, $menuId->children, $counter );
				$menuItems = array_merge ( $menuItems, $childs );
			}
		}
		return $menuItems;
	}
	
	/**
	 * This function will take the post data passed from the controller
	 * If id is present, then it will do an update
	 * else an insert.
	 * One function doing both add and edit.
	 * 
	 * @param
	 *        	$data
	 */
	public function insert($data) {
		$newId = "";
		$this->db->insert ( $this->parentTable, $data ); // insert new record
		$newId = $this->db->insert_id ();
		return $newId;
	}
	/* public function saveMultiple($menuItems = array()) {
		if (! empty ( $menuItems )) {
			// save existing menu
			$this->db->trans_start ();
			$this->db->insert_batch ( 'website_menu', $menuItems );
			
			if ($this->db->trans_status () === FALSE) {
				$this->db->trans_rollback ();
				return get_app_message ( "response.failed" );
			} else {
				$this->db->trans_complete ();
				return get_app_message ( "response.success" );
			}
		} else {
			return get_app_message ( "response.success" );
		}
	} */
	public function removeByIds($menuItemIds) {
		
		// set parent_id to null before deleting the item
		if (empty ( $menuItemIds )) {
			return get_app_message ( "response.failed" );
		}
		
		$this->setParentToNull ( $menuItemIds );
		
		$this->db->where ( 'website_id', getWebsiteIdByURL() );
		$this->db->where_in ( 'id', $menuItemIds );
		$this->db->delete ( $this->table );
		
		if ($this->db->affected_rows () > 0) {
			return get_app_message ( "response.success" );
		} else {
			return get_app_message ( "response.failed" );
		}
	}
	public function setParentToNull($ids) {
		if (empty ( $ids )) {
			return;
		}
		$websiteId = getWebsiteIdByURL();
		
		$menuItem = array ();
		$menuItem ["parent_id"] = "";
		$menuItem ["website_id"] = $websiteId;
		$this->db->where ( 'website_id', $websiteId );
		$this->db->where_in ( 'parent_id', $ids );
		$this->db->update ( $this->table , $menuItem ); // update the record
	}
}
