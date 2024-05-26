<?php //pre_d($websiteConf);?>

<header class="ms-header ms-header-primary ">
        <div class="container container-full ">
          <div class="ms-title">
               <?php if(isset($websiteConf["logo"]) && !empty($websiteConf["logo"])){ ?>
            <a href="<?= getRequestedDomain() ?>">
               
               <img src="<?= $websiteConf["logo"] ?>" class="animated zoomInUp " alt="" 
               style="	
               		width: 275px;
				    position: absolute;
				    margin: 20px 10px;
    					
    			">  
        	     
        		        
    			
<!--             <span class="ms-logo animated zoomInDown animation-delay-5">M</span> -->
            </a>
            <?php } ?>
              <h1 class="animated fadeInRight animation-delay-6" style="    margin-left: 150px;"><?= isset($websiteConf["site_title"])?$websiteConf["site_title"]:"" ?>
                <span></span>
              </h1>
          </div>
          <div class="header-right" >
            <div class="share-menu">
              <ul class="share-menu-list">
                <li class="animated fadeInRight animation-delay-3" style="display: none;">
                  <a href="javascript:void(0)" class="btn-circle btn-google">
                    <i class="zmdi zmdi-google"></i>
                  </a>
                </li>
                <li class="animated fadeInRight animation-delay-2">
                  <a target="_blank" href="https://www.facebook.com/asaanschoolofficial/" class="btn-circle btn-facebook">
                    <i class="zmdi zmdi-facebook"></i>
                  </a>
                </li>
                <li class="animated fadeInRight animation-delay-1" style="display: none;">
                  <a href="javascript:void(0)" class="btn-circle btn-twitter">
                    <i class="zmdi zmdi-twitter"></i>
                  </a>
                </li>
              </ul>
              <a href="javascript:void(0)" class="btn-circle btn-circle-primary animated zoomInDown animation-delay-7">
                <i class="zmdi zmdi-share"></i>
              </a>
            </div>
            <a href="<?= getRequestedDomain("user/login")?>" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-8" >
              <i class="zmdi zmdi-account"></i>
            </a>
            <form class="search-form animated zoomInDown animation-delay-9"  style="display: none;" >
              <input id="search-box" type="text" class="search-input" placeholder="Search..." name="q">
              <label for="search-box">
                <i class="zmdi zmdi-search"></i>
              </label>
            </form>
            <a href="javascript:void(0)" class="btn-ms-menu btn-circle btn-circle-primary sb-toggle-left animated zoomInDown animation-delay-10"  style="display: none;">
              <i class="zmdi zmdi-menu"></i>
            </a>
          </div>
        </div>
      </header>

