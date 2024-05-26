<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
if (! function_exists ( 'getWebsiteByURL' )) {
	function getWebsiteByURL() {
		$CI = get_instance ();
		
		$CI->db->select ()->from ( 'websites' );
		//$siteUrl = site_url ();
		$requestedURL = getRequestedDomain();
		//pre_d($requestedURL);
		$siteUrl = $requestedURL;
		$siteUrl = str_replace ( "http://", "", $siteUrl );
		$siteUrl = str_replace ( "https://", "", $siteUrl );
		$siteUrl = str_replace ( "www.", "", $siteUrl );
		$pos = strpos($siteUrl, "/");
		
		//pre_d($siteUrl);
		
		if ($pos === false) {
			//echo "The string '/' was not found in the string '$siteUrl'";
		} 
		//else {
			if(strpos($siteUrl, "localhost/asaanschool")===false){
				$siteUrl = substr($siteUrl, 0, $pos);
			}else{
				$siteUrl ="localhost/asaanschool";
			}
		//}
		if (substr ( $siteUrl, - 1 ) == '/') {
		 		$siteUrl = substr ( $siteUrl, 0, - 1 );
		 }
		
		$CI->db->where ( "( domain like '$siteUrl%')" );
		$query = $CI->db->get ();
		$website = $query->row_array ();
		//pre_d($website);
		return $website;
	}
}
 
if (! function_exists ( 'getRequestedDomain' )) {
	function getRequestedDomain($uri="") {
		$url= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
		if(!empty($uri)){
			$url = $url ."/".$uri;
		}
		return $url;
	}
}
if (! function_exists ( 'getRequestedURL' )) {
	function getRequestedURL() {
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
}
if (! function_exists ( 'getWebsiteIdByURL' )) {
	function getWebsiteIdByURL() {
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		if (isset ( $_SESSION ["currentWebsiteId"] ) && ! empty ( isset ( $_SESSION ["currentWebsiteId"] ) )) {
			return $_SESSION ["currentWebsiteId"];
		} else {
		   
			$website = getWebsiteByURL ();
			return $website ["id"];
		}
	}
}
if (! function_exists ( 'getRequestedDomainAndPage' )) {
	function getRequestedDomainAndPage() {
		if (get_app_message ( "app.environment" ) == "Production") {
			$completeUrl = base_url () . uri_string ();
			
			if (isFreeSubdomain ( $completeUrl )) {
				return loadFreeDomainSite ( $completeUrl );
			} else {
				return loadPurchasedDomainSite ( $completeUrl );
			}
		}
	}
}

if (! function_exists ( 'loadPurchasedDomainSite' )) {
	function loadPurchasedDomainSite($completeUrl = '') {
		$appdomain = get_app_message ( "app.domain" ); // asaanschool.com
		// $appSubDomain = get_app_message("app.subdomain"); //*
		base_url (); // http://subdomain.asaanschool.com
		if (empty ( $completeUrl )) {
			$completeUrl = base_url () . uri_string ();
		}
		$requestedDomain = str_replace ( "http://", "", $completeUrl );
		$requestedDomain = str_replace ( "https://", "", $requestedDomain );
		$requestedDomain = str_replace ( "www.", "", $requestedDomain );
		
		// $requestedDomain = str_replace ( $appdomain, "", $requestedDomain );
		$requestedDomain = str_replace ( "/site", "", $requestedDomain );
		$requestedDomain = str_replace ( "/page", "", $requestedDomain );
		// $requestedDomain = str_replace ( "page/", "", $requestedDomain );
		$requestedDomain = str_replace ( "//", "/", $requestedDomain );
		$requestedDomain = str_replace ( "//", "/", $requestedDomain );
		$requestedDomain = str_replace ( "//", "/", $requestedDomain );
		$requestedDomain = str_replace ( "//", "/", $requestedDomain );
		$requestedDomain = str_replace ( ".html", "", $requestedDomain );
		
		$requestedDomain = rtrim ( $requestedDomain, '.' );
		
		$urlSegments = explode ( "/", $requestedDomain );
		
		$urlSegments = unset_empty_indexes ( $urlSegments );
		
		if (sizeof ( $urlSegments ) == 0) {
			return "404";
		}
		if (sizeof ( $urlSegments ) == 1) {
			$urlSegments [1] = "index";
		}
		
		if (sizeof ( $urlSegments ) >= 2) {
			$requestedSiteDomain = "";
			/*
			 * $reservedDomains = get_app_message ( "system.reserved.subdomains" );
			 * if (! in_array ( $urlSegments ["0"], $reservedDomains )) {
			 * $requestedSiteDomain = $urlSegments ["0"] . "." . get_app_message ( "app.domain" );
			 * }
			 */
			$requestedSiteDomain = $urlSegments ["0"];
			$pageUrl = $urlSegments ["1"];
			$response ["domain"] = $requestedSiteDomain;
			$response ["pageUrl"] = $pageUrl;
			
			return $response;
		}
	}
}

if (! function_exists ( 'loadFreeDomainSite' )) {
	function loadFreeDomainSite($completeUrl = '') {
		$reservedSudomains = get_app_message ( "system.reserved.subdomains" );
		$appdomain = get_app_message ( "app.domain" ); // asaanschool.com
		// $appSubDomain = get_app_message("app.subdomain"); //*
		base_url (); // http://subdomain.asaanschool.com
		if (empty ( $completeUrl )) {
			$completeUrl = base_url () . uri_string ();
		}
		
		$requestedSubDomain = str_replace ( "http://", "", $completeUrl );
		$requestedSubDomain = str_replace ( "https://", "", $requestedSubDomain );
		$requestedSubDomain = str_replace ( "www.", "", $requestedSubDomain );
		$requestedSubDomain = str_replace ( $appdomain, "", $requestedSubDomain );
		$requestedSubDomain = str_replace ( "/site/", "", $requestedSubDomain );
		$requestedSubDomain = str_replace ( "/page", "", $requestedSubDomain );
		$requestedSubDomain = str_replace ( "page/", "", $requestedSubDomain );
		$requestedSubDomain = str_replace ( "/", "", $requestedSubDomain );
		$requestedSubDomain = str_replace ( ".html", "", $requestedSubDomain );
		
		$requestedSubDomain = rtrim ( $requestedSubDomain, '.' );
		
		$urlSegments = explode ( ".", $requestedSubDomain );
		
		if (sizeof ( $urlSegments ) == 0) {
			return "404";
		}
		if (sizeof ( $urlSegments ) == 1) {
			$urlSegments [1] = "index";
		}
		
		if (sizeof ( $urlSegments ) >= 2) {
			$requestedSiteDomain = "";
			$reservedDomains = get_app_message ( "system.reserved.subdomains" );
			if (! in_array ( $urlSegments ["0"], $reservedDomains )) {
				$requestedSiteDomain = $urlSegments ["0"] . "." . get_app_message ( "app.domain" );
			}
			$pageUrl = $urlSegments ["1"];
			$response ["domain"] = $requestedSiteDomain;
			$response ["pageUrl"] = $pageUrl;
			
			return $response;
		}
	}
}

if (! function_exists ( 'isSiteRequest' )) {
	function isSiteRequest() {
		if (get_app_message ( "app.environment" ) == "development") {
			return false;
		}
		$siteRequest = false;
		$baseUrl = base_url ();
		$appDomain = get_app_message ( "app.domain" ); // *
		
		$baseUrl = str_replace ( "http://", "", $baseUrl );
		$baseUrl = str_replace ( "https://", "", $baseUrl );
		$baseUrl = str_replace ( "www.", "", $baseUrl );
		
		if (0 === strpos ( $baseUrl, $appDomain )) {
			// site not requested. NORMAL USER
			$siteRequest = false;
		} elseif (strpos ( $baseUrl, $appDomain ) === false) {
			// Purchased Domain requestd.
			$siteRequest = true;
		} else {
			// free subdomain requested
			$siteRequest = true;
		}
		
		return $siteRequest;
	}
}

if (! function_exists ( 'isFreeSubdomain' )) {
	function isFreeSubdomain($url = "") {
		$appDomain = get_app_message ( "app.domain" );
		$pos = strpos ( $url, $appDomain );
		if ($pos === false) {
			return false;
		} else {
			return true;
		}
	}
}

if (! function_exists ( 'getContactUsDefaultHTML' )) {
	function getContactUsDefaultHTML($emailId, $templateId = 1) {
		$html = "";
		if ($templateId == 1) {
			$html = '<div "server_message_container" style="display:none;"></div>
					<form name="enq" method="post" action="' . site_url ( 'site/email' ) . '" id="concat_us_email_form" >
						<fieldset>
							<input type="text" name="name" id="name" value=""  class="input-block-level" placeholder="Name" />
							<input type="text" name="email" id="email" value="" class="input-block-level" placeholder="Email" />
							<textarea rows="11" name="message" id="message" class="input-block-level" placeholder="Message"></textarea>
						</fieldset>
						<input type="hidden" value="' . $emailId . '" name="e_t"/>
						<input type="hidden" value="' . base_url () . uri_string () . '" name="redirectTo"/>
							<div class="actions">
								<input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-info pull-right" title="Click here to submit your message!" />
							</div>
					</form>';
		} elseif ($templateId == 2) {
			$html = '
  						<div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" id="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" id="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Subject *</label>
                            <input type="text" name="subject" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="form-group">
						<input type="hidden" value="' . $emailId . '" name="e_t"/>
						<input type="hidden" value="' . base_url () . uri_string () . '" name="redirectTo"/>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                        </div>
                    ';
		}
		return $html;
	}
}

if (! function_exists ( 'getWebPageLayouts' )) {
	function getWebPageLayouts() {
		$layouts = array ();
		$layouts [] = get_app_message ( "db.website.template.layout.1" );
		$layouts [] = get_app_message ( "db.website.template.layout.2" );
		$layouts [] = get_app_message ( "db.website.template.layout.3" );
		$layouts [] = get_app_message ( "db.website.template.layout.4" );
		$layouts [] = get_app_message ( "db.website.template.layout.5" );
		return $layouts;
	}
}

if (! function_exists ( 'sendPublicSiteEmail' )) {
	function sendPublicSiteEmail($emailData) {
		$email = array ();
		$email ["subject"] = $emailData ["email_subject"];
		$email ["body"] = $emailData ["email_body"];
		
		$CI = get_instance ();
		$CI->load->model ( 'Email_Model', 'email' );
		$CI->load->model ( 'User_Model', 'user' );
		$CI->load->model ( 'Emailtype_Model', 'emailType' );
		$emailResponse = $CI->email->merge ( $email );
		
		// get $user by primaryEmail i.e. LoginId
		$CI->db->select ()->from ( 'users' );
		$CI->db->where ( 'email', $emailData ["to_email"] );
		$query = $CI->db->get ();
		$userTo = $query->row_array ();
		
		$emailTypeSent = $CI->emailType->getByType ( get_app_message ( "db.email.type.sent" ) );
		$emailTypeInbox = $CI->emailType->getByType ( get_app_message ( "db.email.type.inbox" ) );
		
		// create email User Entry for $user in inbox
		$userEmailTo = array ();
		$userEmailTo ["email_id"] = $emailResponse;
		$userEmailTo ["email_type_id"] = $emailTypeInbox ["id"];
		$userEmailTo ["user_to_id"] = $userTo ["id"];
		$userEmailTo ["status"] = get_app_message ( "db.email.status.unread" );
		$userEmailTo ["owner_user"] = $userTo ["id"];
		
		// check userEmailFrom email if its account is not created, create new one
		$userFrom = $CI->user->getByEmail ( $emailData ["from_email"] );
		if (empty ( $userFrom )) {
			// create new guest User
			$guestUser = array ();
			$guestUser ["email"] = $emailData ["from_email"];
			$guestUserId = $CI->user->createGuestUser ( $guestUser );
			
			if (! is_numeric ( $guestUserId )) {
				$userEmailInbox ["delivery_status"] = get_app_message ( "db.email.status.notdelivered" );
				return get_app_message ( "response.failed" );
			} else {
				$userEmailInbox ["delivery_status"] = get_app_message ( "db.email.status.delivered" );
				$userFrom ["id"] = $guestUserId;
				$userEmailTo ["user_from_id"] = $guestUserId;
			}
		} else {
			return get_app_message ( "registered.user.not.logged.in" );
		}
		// create sent email entry for sending user
		$userEmailFrom = array ();
		$userEmailFrom ["email_id"] = $emailResponse;
		$userEmailFrom ["email_type_id"] = $emailTypeSent ["id"];
		$userEmailFrom ["user_to_id"] = $userTo ["id"];
		$userEmailFrom ["user_from_id"] = $userFrom ["id"];
		$userEmailFrom ["status"] = "";
		$userEmailFrom ["owner_user"] = $userFrom ["id"];
		
		$CI->db->trans_start ();
		$CI->db->insert ( 'email_users', $userEmailFrom ); // insert new record
		$newId = $CI->db->insert_id ();
		$CI->db->insert ( 'email_users', $userEmailTo ); // insert new record
		$newId = $CI->db->insert_id ();
		$CI->db->trans_complete ();
		
		if (! is_numeric ( $newId )) {
			return get_app_message ( "response.failed" );
		} else {
			return get_app_message ( "response.success" );
		}
	}
}

// =================================================================================
if (! function_exists ( 'getTopMenu' )) {
	function getTopMenu() {
		$CI = get_instance ();
		$CI->load->model ( 'Websitemenu_Model', 'menu' );
		$CI->load->model ( 'Webpostcat_Model', 'postCat' );
		$websiteId = getWebsiteIdByURL ();
		$menu = $CI->menu->getByWebsite ( $websiteId );
		// pre_d($menu);
		foreach ( $menu as $key => $menuItem ) {
			$subMenuItems = iniMenuPostChilds ( $menuItem );
			if (isset ( $subMenuItems ["children"] )) {
				$menu [$key] ['children'] = $subMenuItems ["children"];
			}
		}
		
		return $menu;
	}
}
if (! function_exists ( 'iniMenuPostChilds' )) {
	function iniMenuPostChilds($menuItem) {
		if (isset ( $menuItem ["children"] ) && ! empty ( $menuItem ["children"] )) {
			foreach ( $menuItem ["children"] as $key => $subItem ) {
				$subChild = iniMenuPostChilds ( $subItem );
				if (isset ( $subChild ['children'] )) {
					$menuItem ["children"] [$key] ["children"] = $subChild ["children"];
				}
			}
		}
		if ($menuItem ["type"] == get_app_message ( "web.menu.type.post.cat" )) {
			$CI = get_instance ();
			$CI->load->model ( 'Webpostcat_Model', 'postCat' );
			$categoryMenu = $CI->postCat->getForMenu ( $menuItem ["web_post_cat_id"] );
			$menuItem ["children"] = array_merge ( $menuItem ["children"], $categoryMenu ["children"] );
		}
		
		return $menuItem;
	}
}


