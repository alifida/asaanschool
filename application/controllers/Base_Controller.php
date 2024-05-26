<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Base_Controller extends CI_Controller {
	protected $activeTemplate;
	public function __construct() {
		parent::__construct ();
		 
		$this->load->model ( 'Emailuser_Model', 'emailUser' );
		if($this->isRestAPICall()){
		    
		}else if (isSiteRequest ()) {
			$res = getRequestedDomainAndPage ();
			if (is_array ( $res )) {
				$domain = $res ["domain"];
				$pageUrl = "index";
				if (! empty ( $domain ) && ! empty ( $pageUrl )) {
					$_SESSION ["domain"] = $domain;
					$_SESSION ["pageUrl"] = $pageUrl;
					redirect ( "site/page/index" );
					// $this->loadRequestedSite($domain, $pageUrl);
				}
			}
		} else {
			$requestType = $this->input->get ( 'rt' );
			if ($requestType == 'm') {
				$this->activeTemplate = get_app_message ( "admin.dialog.template" );
			} else {
				$this->activeTemplate = get_app_message ( "admin.template" );
			}
		}
	}
	
	protected function returnJSON($data) {
	    $jsonStr = json_encode($data);
	    header('Content-Type: application/json');
	    echo $jsonStr; 
	}
	
	
	protected function loadView($view, $data) {
		$this->template->load ( $this->activeTemplate, $view, $data );
	}
	protected function loadViewPublic($view, $data) {
		$this->template->loadPublic ( $this->activeTemplate, $view, $data );
	}
	private function loadRequestedSite($domain = "", $pageUrl = "") {
		if (empty ( $domain ) || empty ( $pageUrl )) {
			
			redirect ( "/site/error404" );
		} else {
			
			$this->load->model ( 'Webpage_Model', 'webpage' );
			
			$data = $this->webpage->getRequestedPublicWebPage ( $domain, $pageUrl );
			if (empty ( $data ) || empty ( $data ["template"] ) || empty ( $data ["webpage"] )) {
				redirect ( "/site/error404" );
			}
			
			// load template view
			$template = $data ["template"];
			$webpage = $data ["webpage"];
			$templatePage = "index";
			if ($webpage ["pageType"] ["type"] == get_app_message ( "db.website.template.type.home" )) {
				$templatePage = "index";
			}
			$forwardTo = $template ["path"] . "/" . $templatePage;
			
			// get session message if any
			if (isset ( $_SESSION ["serverMessage"] )) {
				$sessionMessage = $_SESSION ["serverMessage"];
				unset ( $_SESSION ["serverMessage"] );
				$data ["serverMessage"] = $sessionMessage;
			}
			
			$this->load->view ( $forwardTo, $data );
			
			// return;
		}
		
		// $this->load->view( $_SESSION["forwardTo"], $_SESSION["completePageData"]);
	}
	private function setSessionData() {
		if (isSiteRequest ()) {
			$res = getRequestedDomainAndPage ();
			
			if (is_array ( $res )) {
				$domain = $res ["domain"];
				$pageUrl = $res ["pageUrl"];
				if (! empty ( $domain ) && ! empty ( $pageUrl )) {
					$_SESSION ["domain"] = $domain;
					$_SESSION ["pageUrl"] = $pageUrl;
				}
			}
		}
	}
	
	private function isRestAPICall(){
	    $requestType = $this->input->get ( 'rt' );
	    if ($requestType == 'json') {
	        return true;
	    } else {
	        false;
	    }
	}
}