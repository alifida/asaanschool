<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Site extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->activeTemplate = get_app_message ( "public.template" );
		$this->load->model ( 'Webpage_Model', 'page' );
		$this->load->model ( 'Webpost_Model', 'post' );
	}
	public function index() {
		$this->page ();
	}
	public function _404(){
		$this->load->view(  'asaanschool/_404' );
	}
	public function page($uri = "index") {
		$data = array ();
		
		$websiteId = getWebsiteIdByURL ();
		 
		if($websiteId =="10"){
			return redirect ( "/welcome" );
		}
		
		$page = $this->page->getByIDorURL ( null, $uri, $websiteId );
		$footerPageId = "";
		if (isset ( $page ["footer_page_id"] ) && ! empty ( $page ["footer_page_id"] )) {
			$footerPageId = $page ["footer_page_id"];
		} else {
			$footerPageId = $this->page->getDefaultFooterPageId (); // getDefault footer page id
		}
		$data = $this->setFooter ( $footerPageId, $data );
		$data ['page'] = $page;
		if (isset ( $page ['slider'] ) && ! empty ( $page ['slider'] )) {
			$data ['slider'] = $page ["slider"];
		}
		//	pre_d($data);
		if (! empty ( $data )) {
			
			$this->loadViewPublic ( 'webtemplates/public/page', $data );
		} else {
			//redirect ( "/site/page/404" );
			$this->_404();
		}
	}
	private function loadView($view, $data) {
		$this->template->load ( $this->activeTemplate, $view, $data );
	}
	private function loadViewPublic($view, $data) {
		$this->template->loadPublic ( $this->activeTemplate, $view, $data );
	}
	public function preview($websiteId, $uri = "index") {
		$data = array ();
		
		$websiteId = getWebsiteIdByURL ();
		$page = $this->page->getByIDorURL ( null, $uri, $websiteId );
		$footerPageId = "";
		if (isset ( $page ["footer_page_id"] ) && ! empty ( $page ["footer_page_id"] )) {
			$footerPageId = $page ["footer_page_id"];
		} else {
			$footerPageId = $this->page->getDefaultFooterPageId (); // getDefault footer page id
		}
		$data = $this->setFooter ( $footerPageId, $data );
		$data ['page'] = $page;
		if (isset ( $page ['slider'] ) && ! empty ( $page ['slider'] )) {
			$data ['slider'] = $page ["slider"];
		}
		if (! empty ( $data )) {
			
			$this->loadViewPublic ( 'webtemplates/public/page', $data );
		} else {
			//redirect ( "/site/page/404" );
			$this->_404();
		}
	}
	private function setFooter($footerPageId, $data) {
		$websiteId = getWebsiteIdByURL ();
		if (! empty ( $footerPageId )) {
			$footerPage = $this->page->getByIDorURL ( $footerPageId, null, $websiteId );
			$data ["footerPage"] = $footerPage;
		}
		return $data;
	}
	public function pc($title, $catId = "", $template = "1", $displayCategoryInfo = "") {
		if (! empty ( $catId )) {
			$catId = decodeID ( $catId );
			
		}
		$data = array ();
		
		$this->load->model ( 'Webpostcat_Model', 'postCat' );
		$posts = $this->post->getByCategory ( $catId );
		$category = $this->postCat->getById ( $catId );
		
		$footerPageId = "";
		if (isset ( $category ["footer_page_id"] ) && ! empty ( $category ["footer_page_id"] )) {
			$footerPageId = $category ["footer_page_id"];
		} else {
			$footerPageId = $this->page->getDefaultFooterPageId (); // getDefault footer page id
		}
		$data = $this->setFooter ( $footerPageId, $data );
		
		$postsWrapper = array ();
		$postsWrapper ["post_template"] = $template;
		if (! empty ( $category )) {
			$postsWrapper ["posts"] = $posts;
			$postsWrapper ["category"] = $category;
		}
		
		if ($displayCategoryInfo == '1') {
			$data ["header"] ["title"] = $category ['name'];
			$data ["header"] ["description"] = $category ['description'];
		}
		$data ["postsWrapper"] = $postsWrapper;
		// $this->loadView( 'webtemplates/public/postcat_tmp_6', $data );
		// $this->load->view ( 'webtemplates/public/postcat_tmp_7', $data );
		// pre_d($template);
		$this->loadViewPublic ( 'webtemplates/public/postcat_tmp_' . $template, $data );
	}
	public function post($title = "", $postId, $template = "1") {
		$data = array ();
		$post = array ();
		// $data ["top_menu"] = getTopMenu ();
		if (! empty ( $postId )) {
			$postId = decodeID ( $postId );
			$post = $this->post->getById ( $postId );
		}
		$data ['post'] = $post;
		
		$footerPageId = "";
		if (isset ( $post ["footer_page_id"] ) && ! empty ( $post ["footer_page_id"] )) {
			$footerPageId = $post ["footer_page_id"];
		} else {
			$footerPageId = $this->page->getDefaultFooterPageId (); // getDefault footer page id
		}
		$data = $this->setFooter ( $footerPageId, $data );
		
		$this->loadViewPublic ( 'webtemplates/public/post_tmp_' . $template, $data );
	}
	public function test($enc) {
		//	pre ( decodeID ( $enc ) );
		/*
		 * for ($i=1; $i<=100;$i++){
		 * $encodedId = encodeID($i);
		 * pre("ORIGNAL: ".$i." ENCODED: ".$encodedId."---- DECODED: ".decodeID($encodedId));
		 * pre("-----------------------------------------------");
		 * }
		 */
	}
	
	/*
	 * public function __construct() {
	 *
	 * parent::__construct();
	 *
	 * session_start();
	 *
	 *
	 * }
	 *
	 * public function page() {
	 *
	 *
	 * $this->setSessionData();
	 *
	 * if( isset($_SESSION["domain"] ) && !empty($_SESSION["domain"] ) && isset($_SESSION["pageUrl"] ) && !empty($_SESSION["pageUrl"])){
	 * $this->load->model('Webpage_Model','webpage');
	 * $data = $this->webpage->getRequestedPublicWebPage($_SESSION["domain"],$_SESSION["pageUrl"]);
	 * if(empty($data) || empty($data["template"]) || empty($data["webpage"]) ){
	 * redirect("/site/error404");
	 * }
	 *
	 * // load template view
	 * $template= $data["template"];
	 * $webpage = $data["webpage"];
	 * //pre($webpage);
	 * $templatePage = "index";
	 * if($webpage["pageType"]["type"] == get_app_message("db.website.template.type.home")){
	 * $templatePage = "index";
	 * }
	 * $forwardTo = $template["path"]."/".$templatePage;
	 *
	 * // get session message if any
	 * if(isset($_SESSION["serverMessage"])){
	 * $sessionMessage = $_SESSION["serverMessage"];
	 * unset($_SESSION["serverMessage"]);
	 * $data["serverMessage"] = $sessionMessage;
	 * }
	 *
	 * $this->load->view($forwardTo, $data);
	 * return;
	 *
	 * }else{
	 * redirect("/site/error404");
	 * }
	 *
	 * $this->load->view( $_SESSION["forwardTo"], $_SESSION["completePageData"]);
	 *
	 *
	 * }
	 *
	 * public function email(){
	 *
	 *
	 * //$this->setSessionData();
	 * // $emailFromEncodedId = contact Detail ID.
	 * $emailTo = $this->input->post("e_t");
	 * if(empty($emailTo )){
	 * // set error message
	 * $_SESSION["publicMessage"]="Can not send email. Please try again.";
	 * }else{
	 *
	 * $redirectTo = $this->input->post("redirectTo");
	 *
	 *
	 * $emailData= array();
	 * $emailData["displayName"]=$this->input->post("name");
	 * $emailData["from_email"]=$this->input->post("email");
	 * $emailData["email_body"]=$this->input->post("message");
	 * //$emailData["from_user_id"]=$_SESSION["sessionUser"]["id"];
	 * $emailData["email_subject"]="Message from Public User";
	 * $emailData["to_email"]=$emailTo;
	 *
	 * $_SESSION["serverMessage"] ="";
	 *
	 * if(empty($emailData["displayName"]) || empty($emailData["from_email"]) || empty($emailData["email_body"]) || empty($emailData["to_email"]) ){
	 * $_SESSION["serverMessage"] = "Please provide all the required fields.";
	 * }else{
	 * $response = sendPublicSiteEmail($emailData);
	 *
	 * if($response==get_app_message ( "response.success" )){
	 * $_SESSION["serverMessage"] = "Email has been sent Successfully.";
	 * }else if($response = get_app_message ( "registered.user.not.logged.in" )){
	 * $_SESSION["serverMessage"] = $response ;
	 * }else{
	 * $_SESSION["serverMessage"] = "Can not send email. Please try again.";
	 * }
	 *
	 * }
	 *
	 *
	 *
	 *
	 *
	 * }
	 * redirect($redirectTo);
	 * }
	 *
	 * public function error404($data = array()){
	 *
	 * //redirect("site/error404");
	 * $serverMessage="We can't Find the page you are looking for. Please visit the main site. i.e. <a href='http://".get_app_message("app.domain")."'>asaanschool.com</a>";
	 * $errorCode = "Error (404)";
	 * $data["errorCode"] = $errorCode;
	 * $data["serverMessage"] = $serverMessage;
	 * $this->load->view( "errors/index", $data);
	 *
	 * }
	 *
	 *
	 *
	 * private function setSessionData(){
	 * if(isSiteRequest()){
	 * $res = getRequestedDomainAndPage();
	 * if(is_array($res)){
	 * $domain = $res["domain"];
	 * $pageUrl = $res["pageUrl"];
	 * if(!empty($domain) && !empty($pageUrl)){
	 * $_SESSION["domain"] = $domain;
	 * $_SESSION["pageUrl"] = $pageUrl;
	 * }
	 * }
	 * }
	 * }
	 *
	 *
	 *
	 * public function listTemplates(){
	 * //getPublicAvailableTemplates
	 * }
	 *
	 * public function previewTemplate($slug="", $templateId=null, $page="index"){
	 * if($templateId == null){
	 * $_SESSION["appErrors"][]= get_app_message("invalid_url");
	 * redirect("/site/listTemplates");
	 * }
	 *
	 * $this->load->model('Webpage_Model','webpage');
	 *
	 * $templateId = decodeID($templateId);
	 * $template = $this->webpage->getPublicTemplate($templateId);
	 * $data["template"] = $template;
	 * $page = str_replace(".html", "", $page);
	 * $page = "/preview/".$page . ".php";
	 * $forward = $template["path"].$page;
	 * $this->load->view( $forward, $data);
	 *
	 * }
	 */
}