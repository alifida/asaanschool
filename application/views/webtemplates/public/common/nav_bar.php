<?php  $top_menu = getTopMenu (); ?>
<nav class="navbar yamm ms-navbar ms-navbar-primary navbar-static-top ">
        <div class="container container-full">
          <div class="navbar-header ">
            <a class="navbar-brand" href="<?= getRequestedDomain() ?>">
              <img src="<?= isset($websiteConf["logo"])?$websiteConf["logo"]:"" ?>" alt="" style="width: 35px; margin-top: -4px;"> 
              
              <span class="ms-title"><?= isset($websiteConf["site_title"])?"":"" ?>
                
              </span>
            </a>
          </div>
          
          <?php ?>
         <?php if(isset($top_menu)){
         	//pre_d($top_menu);
	        	echo getMenu($top_menu); 
         	} ?>
          
          
      <?php 
     
      
    function getMenu($top_menu){
    	$menuHtml = '<div id="navbar" class="navbar-collapse collapse">';
    	$menuHtml .= '<ul class="nav navbar-nav">';
    	foreach ($top_menu as $key => $menuItem ){ 
  			
    		if(isset($menuItem["children"]) && !empty($menuItem["children"])){
	  			
  				$menuHtml .= '<li class="dropdown ">';
    			$menuHtml .= '	<a href="javascript:void(0);" class="dropdown-toggle animated fadeIn animation-delay-4 " data-toggle="dropdown" data-hover="dropdown" data-name="tm_'.$menuItem["id"].'">'.$menuItem["title"];
    			$menuHtml .= '		<i class="zmdi zmdi-chevron-down"></i>';
    			$menuHtml .= '		<div class="ripple-container"></div>';
    			$menuHtml .= '	</a>';
    			$menuHtml = getSubMenus($menuItem, $menuHtml);
    			$menuHtml .= '</li>';
		 	}else{
		 		if($menuItem["type"] == get_app_message("web.menu.type.page")){
//		 			$menuHtml .= '<li><a href="'.getRequestedDomain('site/page/'.seoUrl($menuItem["title"]).'/'.encodeID($menuItem["target_url"])).'">'.$menuItem["title"].'</a></li>';
			 		$menuHtml .= '<li><a href="'.getRequestedDomain('site/page/'.$menuItem["target_url"]).'"  class="dropdown-toggle animated fadeIn animation-delay-4 "      >'.$menuItem["title"].'</a></li>';
		 			
		 		}elseif($menuItem["type"] == get_app_message("web.menu.type.post.cat")){
		 			$menuHtml .= '<li><a href="'.getRequestedDomain('site/pc/'.$menuItem["target_url"])."/7/1".'"    class="dropdown-toggle animated fadeIn animation-delay-4 "    >'.$menuItem["title"].'</a></li>';
		 		}else{
			 		$menuHtml .= '<li><a href="'.$menuItem["target_url"].'"   class="dropdown-toggle animated fadeIn animation-delay-4 "     >'.$menuItem["title"].'</a></li>';
		 		}
    		} 
    	}
    	
    	//session_start();
    	
    	
    	//pre_d($_SESSION ['sessionUser'] ['user_type'] ['internal_key']);
    	if (isset($_SESSION ['sessionUser'] ['user_type'] ['internal_key']) && $_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "admin") {
    		$adminMenu = getAdminMenuItems();
    	//	pre_d($adminMenu);
    		$menuHtml  .= $adminMenu;
    	}
    	if (isset($_SESSION ['sessionUser'] ['user_type'] ['internal_key']) && $_SESSION ['sessionUser'] ['user_type'] ['internal_key'] == "candidate") {
    		$candidateMenu = getCandidateMenuItems();
    		$menuHtml  .= $candidateMenu;
    	}
    	
		$menuHtml .= '</ul>';
    	$menuHtml .= '</div>';
    	return $menuHtml;
    }
      
	function getSubMenus($subMenuItem , $menuHtml = "") {
		
		$menuHtml .= '<ul class="dropdown-menu dropdown-menu-left open_t">';
		
		foreach ( $subMenuItem ["children"] as $child ) {
			if (isset ( $child ["children"] ) && ! empty ( $child ["children"] )) {
				$menuHtml .= '<li class="dropdown-submenu ">';
				$elemId = "mi_". $subMenuItem["id"]."_". $child['id'];
				$menuHtml .= '<a href="javascript:void(0);" class="has_children">'.$child["title"];
				$menuHtml .= '		';
				$menuHtml .= '		<div class="ripple-container"></div>';
				$menuHtml .= '</a>';
				
				$menuHtml = getSubMenus($child, $menuHtml);
				$menuHtml .= '</li>';
				
			} else {
				$menuHtml .= '<li>';
				//$menuHtml .= '<a href="'.$child["target_url"].' ">'.$child["title"].'</a>';
				
				if($child["type"] == get_app_message("web.menu.type.page")){
					//$menuHtml .= '<li><a href="'.getRequestedDomain('site/page/'.encodeID($child["id"]).'/'.$child["target_url"]).'">'.$child["title"].'</a></li>';
					$menuHtml .= '<li><a href="'.getRequestedDomain('site/page/'.$child["target_url"]).'">'.$child["title"].'</a></li>';
				
				}elseif($child["type"] == get_app_message("web.menu.type.post.cat")){
					$menuHtml .= '<li><a href="'.getRequestedDomain('site/pc/'.seoUrl($child["title"]).'/'.encodeID($child["target_url"])."/7/1").'">'.$child["title"].'</a></li>';
				}else{
					$menuHtml .= '<li><a href="'.$child["target_url"].'">'.$child["title"].'</a></li>';
				}
				
				$menuHtml .= '</li>';
			}
		}
		
		
		
		
		$menuHtml .='</ul>';
		
		
		return $menuHtml;
	}
     
	function getCandidateMenuItems(){
		$menuItem = '<li class="dropdown" >
			  <a  class="btn navbar-btn  btn-danger btn-raised "  data-toggle="dropdown" ><?= $_SESSION["sessionUser"]["display_name"]?><b class="caret"></b></a>
			  <ul class="dropdown-menu">
			  	<li><a  href="'. getRequestedDomain('job').'" >Open Jobs</a></li>
			  	<li role="separator" class="divider"></li>
			    <li><a  href="'. getRequestedDomain('profile').'" >Profile</a></li>
			    <li><a  href="'. getRequestedDomain('candidate/applications').'" >Applications</a></li>
			    <li role="separator" class="divider"></li>
			     <li><a  href="javascript:void(0);" onclick="load_remote_model(\''. getRequestedDomain("user/changePasswordForm") .'\',\'Change Password\');" >Change Password</a></li>
			    <li><a  href="'. getRequestedDomain('user/logout').'" >Logout</a></li>
			  </ul>
			</li>';
		return $menuitem;
	}
	
	function getAdminMenuItems(){
		$menuitem = '
			     			<li class="dropdown">
			     				<a href="javascript:void(0)" class="dropdown-toggle animated fadeIn animation-delay-5" data-toggle="dropdown" data-hover="dropdown" data-name="page">'. $_SESSION["sessionUser"]["display_name"].'
                  					<i class="zmdi zmdi-chevron-down"></i>
                				</a>
			     				<ul class="dropdown-menu dropdown-menu-right animated-2x animated fadeIn">
			                  		<li class="dropdown-submenu">
			                    		<a href="javascript:void(0)" class="has_children">Website<div class="ripple-container"></div></a>
			                    		<ul class="dropdown-menu dropdown-menu-right open_t">
					                      	<li><a href="'. getRequestedDomain('website/').'" >Configuration</a></li>
					                      	<li><a href="'. getRequestedDomain('website/menu').'" >Menu</a></li>
					                      	<li><a href="'. getRequestedDomain('website/editPage').'" >New Page</a></li>
					                      	<li><a href="'. getRequestedDomain('website/editPost').'" >New Post</a></li>
					                      	<li><a href="javascript:void(0);" onclick="load_remote_model(\''. getRequestedDomain('website/editPostCat') .'\',\'New Post Category\');"  >New Post Category</a></li>
					                      	<li><a href="'. getRequestedDomain('website/editSlider').'" >New Slider</a></li>
					                      	<li><a href="'. getRequestedDomain('website/gallery').'" >Images</a></li>
					                      	<li><a href="javascript:void(0);" onclick="load_remote_model(\''. getRequestedDomain('website/quickGallery') .'\',\'Images\');enlarge_remote_model();"  >Quick Images</a></li>
										  
			                    		</ul>
			           				</li>
			     					<li class="dropdown-submenu">
			                    		<a href="javascript:void(0)" class="has_children">Jobs<div class="ripple-container"></div></a>
			                    		<ul class="dropdown-menu dropdown-menu-left open_t">
					                      	<li><a href="javascript:void(0);" onclick="load_remote_model(\''. getRequestedDomain('admin/editJob/') .'\',\'New Job Status\');enlarge_remote_model();">New Job</a></li>
										    <li><a  href="'. getRequestedDomain('admin/jobs/'.get_app_message("db.status.published")) .'" >Published Jobs</a></li>
										    <li><a  href="'. getRequestedDomain('admin/jobs/'.get_app_message("db.status.expired")) .'" >Expired Jobs</a></li>
										    <li><a  href="'. getRequestedDomain('admin/jobs/'.get_app_message("db.status.draft")) .'" >Un published Jobs</a></li>
										  
			                    		</ul>
			           				</li>
			                  		<li class="dropdown-submenu">
			                    		<a href="javascript:void(0)" class="has_children">Applications<div class="ripple-container"></div></a>
			                    		<ul class="dropdown-menu dropdown-menu-left open_t">';
											if(isset($_SESSION['applicationStatuses']) && !empty($_SESSION['applicationStatuses'])){
												$menuitem .= '<li><a href="'. getRequestedDomain("admin/applications/") .'">All</a></li>';
												foreach($_SESSION['applicationStatuses'] as $s){
													$menuitem .= '<li><a href="'. getRequestedDomain("admin/applications/".$s["id"]) .'">'. $s["status"] .'</a></li>';
												}
											}
		$menuitem .=					'</ul>
			           				</li>';
			                    				
			                    				
		$menuitem .= '<li role="separator" class="divider"></li>';
	  	$menuitem .= '<li><a href="'. getRequestedDomain('admin/config') .'">Configuration </a></li>';
	  	$menuitem .= '<li><a href="'. getRequestedDomain('admin/employees') .'">Employees</a></li>';
	  	$menuitem .= '<li><a href="'. getRequestedDomain('admin/notifications') .'">Notification</a></li>';
	  
	  	$menuitem .= '<li role="separator" class="divider"></li>';
	    $menuitem .= '<li><a  href="'. getRequestedDomain('profile').'" >Profile</a></li>';

	    $menuitem .= '<li><a  href="javascript:void(0);" onclick="load_remote_model(\''. getRequestedDomain("user/changePasswordForm") .'\',\'Change Password\');" >Change Password</a></li>';
	    $menuitem .= '<li><a  href="'. getRequestedDomain('user/logout').'" >Logout</a></li>';
							     	                    				
			                    				
			                    				
        $menuitem .=	'</ul>
			     			</li>
			     		';
		return $menuitem;
	}
	 
      ?>          			
          
          
       
          
          
          <!-- navbar-collapse collapse -->
          <a href="javascript:void(0)" class="sb-toggle-left btn-navbar-menu" style="display: none;">
            <i class="zmdi zmdi-menu"></i>
          </a>
        </div>
        <!-- container -->
      </nav>
      
      
      
      
      
    
    
    
    
    
    
    
    
    <!-- Left Side Menu -->
    <div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
      <div class="sb-slidebar-container">
        <header class="ms-slidebar-header">
          <div class="ms-slidebar-login">
            <a href="#ms-login-tab" class="withripple modal-target-tab" data-toggle="modal" data-target="#ms-account-modal">
              <i class="zmdi zmdi-account"></i> Login</a>
            <a href="#ms-register-tab" class="withripple modal-target-tab"  data-toggle="modal" data-target="#ms-account-modal">
              <i class="zmdi zmdi-account-add"></i> Register</a>
          </div>
          <div class="ms-slidebar-title">
            <form class="search-form">
              <input id="search-box-slidebar" type="text" class="search-input" placeholder="Search..." name="q" />
              <label for="search-box-slidebar">
                <i class="zmdi zmdi-search"></i>
              </label>
            </form>
            <div class="ms-slidebar-t">
              <span class="ms-logo ms-logo-sm">M</span>
              <h3>Material
                <span>Style</span>
              </h3>
            </div>
          </div>
        </header>
        <ul class="ms-slidebar-menu" id="slidebar-menu" role="tablist" aria-multiselectable="true">
          <li class="panel" role="tab" id="sch1">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#slidebar-menu" href="#sc1" aria-expanded="false" aria-controls="sc1">
              <i class="zmdi zmdi-home"></i> Home </a>
            <ul id="sc1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sch1">
              <li>
                <a href="index.html">Default Home</a>
              </li>
              <li>
                <a href="home-generic-2.html">Home Black Slider</a>
              </li>
              <li>
                <a href="home-landing.html">Home Landing Intro</a>
              </li>
              <li>
                <a href="home-landing3.html">Home Landing Video</a>
              </li>
              <li>
                <a href="home-shop.html">Home Shop 1</a>
              </li>
            </ul>
          </li>
          <li class="panel" role="tab" id="sch2">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#slidebar-menu" href="#sc2" aria-expanded="false" aria-controls="sc2">
              <i class="zmdi zmdi-desktop-mac"></i> Pages </a>
            <ul id="sc2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sch2">
              <li>
                <a href="page-about.html">About US</a>
              </li>
              <li>
                <a href="page-team.html">Our Team</a>
              </li>
              <li>
                <a href="page-product.html">Products</a>
              </li>
              <li>
                <a href="page-services.html">Services</a>
              </li>
              <li>
                <a href="page-faq.html">FAQ</a>
              </li>
              <li>
                <a href="page-timeline_left.html">Timeline</a>
              </li>
              <li>
                <a href="page-contact.html">Contact Option</a>
              </li>
              <li>
                <a href="page-login.html">Login</a>
              </li>
              <li>
                <a href="page-pricing.html">Pricing</a>
              </li>
              <li>
                <a href="page-coming.html">Coming Soon</a>
              </li>
            </ul>
          </li>
          <li class="panel" role="tab" id="sch4">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#slidebar-menu" href="#sc4" aria-expanded="false" aria-controls="sc4">
              <i class="zmdi zmdi-edit"></i> Blog </a>
            <ul id="sc4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sch4">
              <li>
                <a href="blog-sidebar.html">Blog Sidebar 1</a>
              </li>
              <li>
                <a href="blog-sidebar2.html">Blog Sidebar 2</a>
              </li>
              <li>
                <a href="blog-masonry.html">Blog Masonry 1</a>
              </li>
              <li>
                <a href="blog-masonry2.html">Blog Masonry 2</a>
              </li>
              <li>
                <a href="blog-full.html">Blog Full Page 1</a>
              </li>
              <li>
                <a href="blog-full2.html">Blog Full Page 2</a>
              </li>
              <li>
                <a href="blog-post.html">Blog Post 1</a>
              </li>
              <li>
                <a href="blog-post2.html">Blog Post 2</a>
              </li>
            </ul>
          </li>
          <li class="panel" role="tab" id="sch5">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#slidebar-menu" href="#sc5" aria-expanded="false" aria-controls="sc5">
              <i class="zmdi zmdi-shopping-basket"></i> E-Commerce </a>
            <ul id="sc5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sch5">
              <li>
                <a href="ecommerce-filters.html">E-Commerce Sidebar</a>
              </li>
              <li>
                <a href="ecommerce-filters-full.html">E-Commerce Sidebar Full</a>
              </li>
              <li>
                <a href="ecommerce-filters-full2.html">E-Commerce Topbar Full</a>
              </li>
              <li>
                <a href="ecommerce-item.html">E-Commerce Item</a>
              </li>
              <li>
                <a href="ecommerce-cart.html">E-Commerce Cart</a>
              </li>
            </ul>
          </li>
          <li class="panel" role="tab" id="sch6">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#slidebar-menu" href="#sc6" aria-expanded="false" aria-controls="sc6">
              <i class="zmdi zmdi-collection-image-o"></i> Portfolio </a>
            <ul id="sc6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sch6">
              <li>
                <a href="portfolio-filters_sidebar.html">Portfolio Sidebar Filters</a>
              </li>
              <li>
                <a href="portfolio-filters_topbar.html">Portfolio Topbar Filters</a>
              </li>
              <li>
                <a href="portfolio-filters_sidebar_fluid.html">Portfolio Sidebar Fluid</a>
              </li>
              <li>
                <a href="portfolio-filters_topbar_fluid.html">Portfolio Topbar Fluid</a>
              </li>
              <li>
                <a href="portfolio-cards.html">Porfolio Cards</a>
              </li>
              <li>
                <a href="portfolio-masonry.html">Porfolio Masonry</a>
              </li>
              <li>
                <a href="portfolio-item.html">Portfolio Item 1</a>
              </li>
              <li>
                <a href="portfolio-item2.html">Portfolio Item 2</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="link" href="component-typography.html">
              <i class="zmdi zmdi-view-compact"></i> UI Elements</a>
          </li>
          <li>
            <a class="link" href="page-all.html">
              <i class="zmdi zmdi-link"></i> All Pages</a>
          </li>
        </ul>
       
      </div>
    </div>  
      
      
      
      
      
      
