<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
include_once('Protected_Controller.php');
class Website extends Protected_Controller {
	public function __construct() {
		parent::__construct ();
		
		
		
		$this->load->model ( 'Website_Model', 'website' );
		$this->load->model ( 'Webslider_Model', 'slider' );
		$this->load->model ( 'Webpage_Model', 'webpage' );
		$this->load->model ( 'Websitefile_Model', 'webfile' );
		// $this->load->model('Webpagelayout_Model', 'webpageLayout');
		$this->load->model ( 'Webpost_Model', 'post' );
		$this->load->model ( 'Webpostcat_Model', 'postCat' );
		$this->load->model ( 'Websitemenu_Model', 'menu' );
		
		// if there is no website then create a fresh one
		 
		if (! isset ( $_SESSION ["currentWebsiteId"] ) || empty ( $_SESSION ["currentWebsiteId"] )) {
			$website = $this->website->getByBranchId ();
			
			if (empty ( $website )) {
				// create an empty website record in db to generate Website primary key ID.
				$websiteId = $this->website->createFreshWebsiteByBranch ();
				$_SESSION ["currentWebsiteId"] = $websiteId;
			} else {
				$_SESSION ["currentWebsiteId"] = $website ["id"];
			}
		}
	}
	public function index($data = array()) {
		$website = array ();
		$website = $this->website->getByBranchId ();
		
		//pre($website);
		$posts = array ();
		$posts = $this->post->getByWebsite ();
		$website ["posts"] = $posts;
		
		$sliders = $this->slider->getByWebsite ();
		$website ["sliders"] = $sliders;
		
		$categories = array ();
		$categories = $this->postCat->getByWebsite ();
		$website ["categories"] = $categories;
		 
		$data ["website"] = $website;
		$this->template->load ( $this->activeTemplate, "websites/index", $data );
	}
	public function menu() {
		$data = array ();
		
		$menu = $this->menu->getByWebsite ( $_SESSION ["currentWebsiteId"] );
		$data ["currentMenu"] = $menu;
		
		$pages = $this->webpage->getAvailableMenuItems ();
		
		$data ["pages"] = $pages;
		
		$postCats = $this->postCat->getAvailableForMenu ();
		$data ["postCats"] = $postCats;
		
		$this->template->load ( $this->activeTemplate, "websites/menu/index", $data );
	}
	public function createNewMenuItem() {
		$data = array ();
		$this->template->load ( $this->activeTemplate, "websites/menu/menuItemForm", $data );
	}
	public function saveMenuItem() {
		$menuItem = array ();
		$menuItem ["title"] = $this->input->post ( "mi_title" );
		$menuItem ["target_url"] = $this->input->post ( "mi_url" );
		$menuItem ["website_id"] = $_SESSION ["currentWebsiteId"];
		$menuItem ["type"] = get_app_message ( "web.menu.type.static" );
		$response = $this->menu->merge ( $menuItem );
		if ($response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/website/menu" );
	}
	public function addPostCatToMenu() {
		$catIds = $this->input->post ( "catIds" );
		
		if (! empty ( $catIds )) {
			$cats = $this->postCat->getByIds ( $catIds );
			
			$menuItems = array ();
			if (! empty ( $cats )) {
				foreach ( $cats as $cat ) {
					$menuItem = array ();
					$menuItem ["title"] = $cat ["name"];
					$menuItem ["web_post_cat_id"] = $cat ["id"];
					
					$menuItem ["target_url"] = seoUrl($cat["name"])."/". encodeID($cat ["id"]);
					$menuItem ["website_id"] = $cat ["website_id"];
					$menuItem ["type"] = get_app_message ( "web.menu.type.post.cat" );
					
					$menuItems [] = $menuItem;
				}
				
				$response = $this->menu->saveMultiple ( $menuItems );
				
				if ($response == get_app_message ( "response.success" )) {
					$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
				} else {
					$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
				}
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			}
		} else {
			$_SESSION ["appErrors"] [] = "Please Select atleast one item.";
		}
		
		redirect ( "/website/menu" );
	}
	public function addPagesToMenu() {
		$pageIds = $this->input->post ( "pageIds" );
		if (! empty ( $pageIds )) {
			$pages = $this->webpage->getByIds ( $pageIds );
			$menuItems = array ();
			if (! empty ( $pages )) {
				foreach ( $pages as $page ) {
					$menuItem = array ();
					$menuItem ["title"] = $page ["menu_title"];
					$menuItem ["target_url"] = $page ["page_url"];
					$menuItem ["website_id"] = $page ["website_id"];
					$menuItem ["web_page_id"] = $page ["id"];
					$menuItem ["type"] = get_app_message ( "web.menu.type.page" );
					$menuItems [] = $menuItem;
				}
				
				$response = $this->menu->saveMultiple ( $menuItems );
				if ($response == get_app_message ( "response.success" )) {
					$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
				} else {
					$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
				}
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			}
		} else {
			$_SESSION ["appErrors"] [] = "Please Select atleast one item.";
		}
		redirect ( "/website/menu" );
	}
	public function removeMenuItems() {
		$menuItemIds = $this->input->post ( "menuItemIds" );
		
		if (! empty ( $menuItemIds )) {
			$response = $this->menu->removeByIds ( $menuItemIds );
			if ($response == get_app_message ( "response.success" )) {
				$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			}
		} else {
			$_SESSION ["appErrors"] [] = "Please Select atleast one item.";
		}
		redirect ( "/website/menu" );
	}
	public function saveMenu() {
		$menuJSON = $this->input->post ( "menuSortOrder" );
		$response = $this->menu->saveMenu ( $menuJSON );
		
		if ($response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/website/menu" );
	}
	public function editWebsite($data = array()) {
		$website = array ();
		$website = $this->website->getByBranchId ();
		if (! empty ( $website )) {
			$isSubDomain = isFreeSubdomain ( $website ["domain"] );
			
			$data ["isSubDomain"] = $isSubDomain;
			if ($isSubDomain === true) {
				$data ["subdomain"] = str_replace ( get_app_message ( "app.domain" ), "", $website ["domain"] );
				$data ["subdomain"] = str_replace ( "http://", "", $data ["subdomain"] );
				$data ["subdomain"] = str_replace ( ".", "", $data ["subdomain"] );
			} else {
				$data ["domain"] = $website ["domain"];
			}
		}
		
		$this->load->model ( 'Webpage_Model', 'webpage' );
		$webTemplates = $this->webpage->getPublicAvailableTemplates ();
		
		$data ["webTemplates"] = $webTemplates;
		$data ["website"] = $website;
		$this->template->load ( $this->activeTemplate, "websites/configuration", $data );
	}
	public function updateWebsite($data = array()) {
		$website ["id"] = $_SESSION ["currentWebsiteId"];
		if($website["id"] == "0"){
			unset($website["id"]);
		}
		$siteTitle = $this->input->post ( "site_title" );
		$tagLine = $this->input->post ( "tag_line" );
		$domainType = $this->input->post ( "domain_type" );
		$website ["site_title"] = $siteTitle;
		$website ["tag_line"] = $tagLine;
		
		$themeColor = $this->input->post ( "themeColor" );
		$backgroundColor = $this->input->post ( "backgroundColor" );
		$textColor = $this->input->post ( "textColor" );
		
		$website ["theme_color"] = $themeColor;
		$website ["background_color"] = $backgroundColor;
		$website ["text_color"] = $textColor;
		
		$template = $this->input->post ( "template" );
		
		if ($template == null || empty ( $template )) {
			$template = array ();
			$template [0] = "1";
		}
		
		$website ["web_template_id"] = $template [0];
		
		$domain = "";
		if ($domainType == "freesubdomain") {
			$domain = $this->input->post ( "subdomain" );
			$website ["domain"] = $domain . "." . get_app_message ( "app.domain" );
		}
		if ($domainType == "domain") {
			$domain = $this->input->post ( "domain" );
			$website ["domain"] = $domain;
		}
		
		 
		$response = $this->website->merge ( $website );
		if (! is_numeric ( $response ) && $response != get_app_message ( "response.success" )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		} else {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		}
		redirect ( "/website" );
	}
	public function gallery() {
		$gallery = array ();
		$gallery = $this->webfile->getByWebsite ();
		$data ["gallery"] = $gallery;
		
		$this->template->load ( $this->activeTemplate, "websites/files/index", $data );
	}
	public function quickGallery() {
		$gallery = array ();
		$gallery = $this->webfile->getByWebsite ();
		$data ["gallery"] = $gallery;
		$this->template->load ( $this->activeTemplate, "websites/files/index", $data );
	}
	public function uploadGalaryFile() {
		$data = array ();
		$this->template->load ( $this->activeTemplate, "websites/files/uploadFileForm", $data );
	}
	public function deleteGalaryFileConfirmation($id){
		if(empty($id)){
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect("website/gallery");
		}
		
		$id = decodeID($id);
		$file = $this->webfile->getById($id);
	
		$data = array();
		$data["file"] = $file;
	
		parent::loadView("websites/files/delete", $data );
	
	}
	public function deleteGalaryFile(){
		
		$id = $this->input->post ( "gal_file_id" );
		
		if(empty($id)){
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect("website/gallery");
		}
		$file = $this->webfile->getById($id);
		
		$response = $this->webfile->removeById($id);
		
		if ( $response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
			deleteFileByURL($file["file_path"]);
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/website/gallery" );
		
	}
	public function galleryImagesForRichEditor() {
		$gallery = array ();
		$gallery = $this->webfile->getByWebsite ();
		$data ["gallery"] = $gallery;
		$this->template->load ( $this->activeTemplate, "websites/files/galleryImagesForRichEditor", $data );
	}
	/*
	 * public function createPage() {
	 * $data = array ();
	 * $webpage = array ();
	 * $webpageLayouts = getWebPageLayouts ();
	 *
	 * $posts = array ();
	 * $posts = $this->post->getByWebsite ();
	 *
	 * $data ["posts"] = $posts;
	 *
	 * $data ["webpageLayouts"] = $webpageLayouts;
	 * $data ["webpage"] = $webpage;
	 * $this->template->load ( $this->activeTemplate, "websites/pages/form_wrapper", $data );
	 * }
	 */
	public function editFooter() {
		$data = array ();
		$footer = array ();
		$webPages = $this->webpage->getByLayout ( get_app_message ( "db.website.template.layout.footer" ) );
		
		if (! empty ( $webPages )) {
			$footer = $webPages [0];
		}
		$posts = array ();
		$posts = $this->post->getByWebsite ();
		
		$data ["posts"] = $posts;
		
		$data ["webpage"] = $footer;
		
		$this->template->load ( $this->activeTemplate, "websites/edit_footer", $data );
	}
	public function updateFooter() {
		$webPageId = $this->input->post ( "page_id" );
		$webpage = array ();
		if (! empty ( $webPageId )) {
			$webpage ["id"] = decodeID ( $webPageId );
		}
		$webpage ["page_title"] = get_app_message ( "db.website.template.layout.footer" );
		$webpage ["menu_title"] = get_app_message ( "db.website.template.layout.footer" );
		$webpage ["menu_sort_order"] = 0;
		
		$webpage ["status"] = $this->input->post ( "page_status" );
		;
		$webpage ["html"] = $this->input->post ( "html" );
		;
		$webpage ["updated_by"] = $_SESSION ["sessionUser"] ["id"];
		$webpage ["website_id"] = $_SESSION ["currentWebsiteId"];
		
		$webpageLayout = get_app_message ( "db.website.template.layout.footer" );
		
		$webpage ["layout"] = $webpageLayout;
		
		$response = $this->webpage->merge ( $webpage );
		
		if ($response == get_app_message ( "response.success" ) || is_numeric ( $response )) {
			
			if (is_numeric ( $response )) {
				$webpage ["id"] = $response;
			}
			
			$postIds = $this->input->post ( "page_posts" );
			$selectedPosts = array ();
			if (! empty ( $postIds )) {
				$selectedPosts = $this->post->getByIds ( $postIds );
			}
			$this->webpage->updateWebpagePosts ( $selectedPosts, $webpage ["id"] );
			
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/website" );
	}
	public function editPage($encodedWebpageId = "") {
		
		$data = array ();
		if (! empty ( $encodedWebpageId )) {
			
			
			$webpageId = decodeID ( $encodedWebpageId );
			$webpage = $this->webpage->getById ( $webpageId );
			
			$data ["webpage"] = $webpage;
			if (empty ( $webpage )) {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
				redirect ( "/website" );
			}
		}
		$webPages = $this->webpage->getPublishedPages();
		$data ["webPages"] =$webPages;
		
		$webpageLayouts = getWebPageLayouts ();
		$data ["webpageLayouts"] = $webpageLayouts;
		
		$categories = array ();
		$categories = $this->postCat->getByWebsite ();
		$data ["categories"] = $categories;
		
		$sliders = array ();
		$sliders = $this->slider->getByWebsite ();
		$data ["sliders"] = $sliders;
		/*
		 * pre($sliders);
		 */
		$this->template->load ( $this->activeTemplate, "websites/pages/form_wrapper", $data );
	}
	public function deletePage($encodedWebpageId = "") {
		if (empty ( $encodedWebpageId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/website" );
		}
		$webpageId = decodeID ( $encodedWebpageId );
		$this->webpage->remove ( $webpageId );
		
		$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		redirect ( "/website" );
	}
	public function deletePageForm($encodedWebpageId = "") {
		if (empty ( $encodedWebpageId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/website" );
		}
		$webpageId = decodeID ( $encodedWebpageId );
		
		$webpage = $this->webpage->getById ( $webpageId );
		
		$data = array ();
		$data ["webpage"] = $webpage;
		$this->template->load ( $this->activeTemplate, "websites/pages/delete", $data );
	}
	public function savePage() {
		$webPageId = $this->input->post ( "page_id" );
		$webpage = array ();
		if (! empty ( $webPageId )) {
			$webpage ["id"] = decodeID ( $webPageId );
		}
		
		$webpage ["page_title"] = $this->input->post ( "page_title" );
		$webpage ["menu_title"] = $this->input->post ( "menu_title" );
		$webpage ["slider_id"] = $this->input->post ( "slider" );
		
		
		if (empty ( $webpage ["slider_id"] ) || $webpage ["slider_id"] == 0) {
			$webpage ["slider_id"] = null;
		}
		$webpage ["status"] = $this->input->post ( "page_status" );
		$webpage ["html"] = $this->input->post ( "html" );
		$webpage ["updated_by"] = $_SESSION ["sessionUser"] ["id"];
		$webpage ["website_id"] = $_SESSION ["currentWebsiteId"];
		$webpage ["layout"] = $this->input->post ( "layout" );
		$webpage ["is_welcome_page"] = $this->input->post ( "is_welcome_page" );
		$webpage ["is_default_footer"] = $this->input->post ( "is_default_footer" );
		$webpage ["footer_page_id"] = $this->input->post ( "footer_page" );
		
		if(empty($webpage ["footer_page_id"])){
			$webpage ["footer_page_id"] = null;
		}
		
		if ($webpage ["is_welcome_page"]) {
			// home page
			$webpage ["page_url"] = "index";
		} else {
			$webpage ["page_url"] = seoUrl ( $webpage ["page_title"] );
		}
		
		$response = $this->webpage->merge ( $webpage );
		
		if ($response == get_app_message ( "response.success" ) || is_numeric ( $response )) {
			
			if (is_numeric ( $response )) {
				$webpage ["id"] = $response;
			}
			
			$this->updatePagePostCategories ( $webpage ["id"] );
			
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		redirect ( "/website" );
	}
	private function updatePagePostCategories($pageId) {
		$itemIdsStr = $this->input->post ( "itemIds" );
		$pagePostCategories = array ();
		if (! empty ( $itemIdsStr )) {
			$itemIds = explode ( ',', $itemIdsStr );
		 
			
			foreach ( $itemIds as $key => $itemId ) {
				$pagePostCat = array ();
				$pagePostCat ["layout_column"] = $this->input->post ( "layout_column___" . $itemId );
				$pagePostCat ["category_id"] = $this->input->post ( "category___" . $itemId );
				$pagePostCat ["post_template"] = $this->input->post ( "post_template___" . $itemId );
				$pagePostCat ["top_records"] = $this->input->post ( "top_records___" . $itemId );
				$pagePostCat ["sort_order"] = $this->input->post ( "sort_order___" . $itemId );
				$pagePostCat ["page_id"] =$pageId;
				$pagePostCategories [] = $pagePostCat;
			}
		}
		$this->load->model ( 'Webpagepostcat_Model', 'pagePostCat' );
		$response = $this->pagePostCat->removeByCondition ( "(page_id = '$pageId')" );
		if (! empty ( $pagePostCategories )) {
			$response = $this->pagePostCat->saveMultiple ( $pagePostCategories );
			
			if ($response == get_app_message ( "response.success" )) {
				//$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
			} else {
				$_SESSION ["appErrors"] [] = "Post Categories not save properly.";
			}
		}
	}
	public function editPost($encodedId = "") {
		$data = array ();
		$categories = array ();
		$categories = $this->postCat->getByWebsite ();
		$data ["categories"] = $categories;
		
		
		$webPages = $this->webpage->getPublishedPages();
		$data ["webPages"] =$webPages;
		
		if (! empty ( $encodedId )) {
			$postId = decodeID ( $encodedId );
			$post = $this->post->getById ( $postId );
			$data ["post"] = $post;
		}
		$this->template->load ( $this->activeTemplate, "websites/posts/form", $data );
	}
	public function editSlider($sliderId = "") {
		$data = array ();
		if (! empty ( $sliderId )) {
			$slider = $this->slider->getById ( $sliderId );
			/*
			 * $slides = array ();
			 * if ($slider ["config"]) {
			 * $slides = json_decode ( $slider ["config"], true );
			 * $slider ["slides"] = $slides;
			 * }
			 * $slider ["slides"] = $slides;
			 */
			// pre_d($slider);
			$data ["slider"] = $slider;
		}
		$this->template->load ( $this->activeTemplate, "websites/slider/form", $data );
	}
	public function deleteSliderConfirmation($sliderId = "") {
		$data = array ();
		if (! empty ( $sliderId )) {
			$slider = $this->slider->getById ( $sliderId );
			$data ["slider"] = $slider;
		}
		$this->template->load ( $this->activeTemplate, "websites/slider/delete", $data );
	}
	public function deleteSlider() {
		$data = array ();
		$sliderId = $this->input->post ( "id" );
		if (! empty ( $sliderId )) {
			$response = $this->slider->remove ( $sliderId );
			if ($response == get_app_message ( "response.success" )) {
				$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			}
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		redirect ( "/website" );
	}
	public function saveSlider() {
		$slider = array ();
		$slider ["id"] = $this->input->post ( "id" );
		$slider ["name"] = $this->input->post ( "name" );
		$slider ["website_id"] = $_SESSION ["currentWebsiteId"];
		
		$itemIdsStr = $this->input->post ( "itemIds" );
		$sliderDetailJSON = "";
		if (! empty ( $itemIdsStr )) {
			$itemIds = explode ( ',', $itemIdsStr );
			$slides = array ();
			foreach ( $itemIds as $key => $itemId ) {
				$slide = array ();
				$slide ["title"] = $this->input->post ( "slide_title___" . $itemId );
				$slide ["text"] = $this->input->post ( "slide_text___" . $itemId );
				$slide ["thumbnail"] = $this->input->post ( "thumbnail_path___" . $itemId );
				
				if (! empty ( $slide ["thumbnail"] ) && stringContains ( $slide ["thumbnail"], 'tmp' )) {
					$filePostFix = "slide_" . $itemId . "_" . getUniqueString ();
					// replace current profile pic with temp one. and delete from temp
					$isLastItem = ($key == sizeof ( $itemIds ) - 1);
					$absolutePath = ImageFileUpdateWithTemp ( $slide ["thumbnail"], $filePostFix, $isLastItem );
					$slide ["thumbnail"] = $absolutePath;
				}
				
				$slides [] = $slide;
			}
			$sliderDetailJSON = json_encode ( $slides );
		}
		
		$slider ["config"] = $sliderDetailJSON;
		
		$response = $this->slider->merge ( $slider );
		if (is_numeric ( $response ) || $response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/website" );
	}
	public function editPostCat($encodedId = "") {
		$data = array ();
		
		
		$webPages = $this->webpage->getPublishedPages();
		$data ["webPages"] =$webPages;
		
		$categories = array ();
		$categories = $this->postCat->getByWebsite ();
		$data ["categories"] = $categories;
		if (! empty ( $encodedId )) {
			$catId = decodeID ( $encodedId );
			$cat = $this->postCat->getById ( $catId );
			$data ["postCat"] = $cat;
		}
		$this->template->load ( $this->activeTemplate, "websites/post_category/form", $data );
	}
	public function deletePostCatConfirmation($encodedId = "") {
		$data = array ();
		if (! empty ( $encodedId )) {
			$catId = decodeID ( $encodedId );
			$cat = $this->postCat->getById ( $catId );
			$data ["postCat"] = $cat;
		}
		$this->template->load ( $this->activeTemplate, "websites/post_category/delete", $data );
	}
	public function deletePostCat() {
		$data = array ();
		$catId = $this->input->post ( "id" );
		if (! empty ( $catId )) {
			$response = $this->postCat->remove ( $catId );
			if ($response == get_app_message ( "response.success" )) {
				$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			}
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		
		redirect ( "/website" );
	}
	public function savePostCat() {
		$cat = array ();
		$cat ["id"] = $this->input->post ( "cat_id" );
		$cat ["name"] = $this->input->post ( "name" );
		$cat ["description"] = $this->input->post ( "description" );
		$cat ["parent_id"] = $this->input->post ( "parent_cat" );
		$cat ["website_id"] = $_SESSION ["currentWebsiteId"];
		
		$cat ["footer_page_id"] = $this->input->post ( "footer_page" );
		if(empty($cat ["footer_page_id"])){
			$cat ["footer_page_id"] = null;
		}
		
		
		$response = $this->postCat->merge ( $cat );
		if (is_numeric ( $response ) || $response == get_app_message ( "response.success" )) {
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/website" );
	}
	public function deletePostForm($encodedId = "") {
		$data = array ();
		if (! empty ( $encodedId )) {
			$postId = decodeID ( $encodedId );
			$post = $this->post->getById ( $postId );
			$data ["post"] = $post;
		}
		$this->template->load ( $this->activeTemplate, "websites/posts/delete", $data );
	}
	public function deletePost($encodedPostId = "") {
		if (empty ( $encodedPostId )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			redirect ( "/website" );
		}
		$postId = decodeID ( $encodedPostId );
		$this->post->remove ( $postId );
		
		$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		redirect ( "/website" );
	}
	public function savePost() {
		$postId = $this->input->post ( "post_id" );
		$post = array ();
		if (! empty ( $postId )) {
			$post ["id"] = decodeID ( $postId );
		}
		$post ["website_id"] = $_SESSION ["currentWebsiteId"];
		$post ["title"] = $this->input->post ( "title" );
		$post ["slug"] = $this->input->post ( "slug" );
		$post ["status"] = $this->input->post ( "status" );
		$post ["publish_at"] = $this->input->post ( "publish_at" );
		$post ["expire_at"] = $this->input->post ( "expire_at" );
		$post ["thumbnail_path"] = $this->input->post ( "thumbnail_path" );
		$post ["html"] = $this->input->post ( "html" );
		$post ["categories"] = $this->input->post ( "categories" );
		$post ["footer_page_id"] = $this->input->post ( "footer_page" );
		if(empty($post ["footer_page_id"])){
			$post ["footer_page_id"] = null;
		}
		$response = $this->post->merge ( $post );
		
		if ($response == get_app_message ( "response.success" ) || is_numeric ( $response )) {
			if (is_numeric ( $response )) {
				$post ["id"] = $response;
			}
			$widthThumbnailPath = $this->input->post ( "thumbnail_path" );
			
			if (! empty ( $widthThumbnailPath )) {
				$filePostFix = get_random_string () . "post";
				/*
				 * if ($response == get_app_message ( "response.success" )) {
				 * $filePostFix = encodeID ( $post ["id"] ) . "post";
				 * } else {
				 * $post ["id"] = $response;
				 * }
				 */
				$filePostFix = encodeID ( $post ["id"] ) . "post";
				
				// replace current profile pic with temp one. and delete from temp
				$absolutePath = ImageFileUpdateWithTemp ( $widthThumbnailPath, $filePostFix );
				$post ["thumbnail_path"] = $absolutePath;
				
				// 2nd call to DB
				$response = $this->post->merge ( $post );
				if ($response != get_app_message ( "response.success" )) {
					$_SESSION ["appErrors"] [] = get_app_message ( "Cannot save the Post Thumbnail. Please try again. later." );
				}
			}
			
			$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
		} else {
			$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
		}
		redirect ( "/website" );
	}
	public function isDomainAvailable() {
		$requestedDomain = $this->input->post ( "requestedDomain" );
		$domainType = $this->input->post ( "domainType" ); // freesubdomain / domain
		$response = array ();
		
		if (! empty ( $requestedDomain )) {
			if ($domainType == "freesubdomain") {
				$requestedDomain = $requestedDomain . "." . get_app_message ( "app.domain" );
			}
			$available = $this->website->isDomainAvailable ( $requestedDomain );
			if ($available === true) {
				$response ["status"] = "success";
				$response ["message"] = "Congratulations! your domain is availble.";
			} else {
				$response ["status"] = "faild";
				$response ["message"] = "Requested Domain is already taken. Please try some different domain.";
			}
		} else {
			$response ["status"] = "faild";
			$response ["message"] = "Please Provide a valid value for domain.";
		}
		
		$json_response = json_encode ( $response );
		echo $json_response;
	}
}
