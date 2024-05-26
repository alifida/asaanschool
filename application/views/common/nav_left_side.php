<?php //pre_d($_SESSION["campuses"]);?>
            
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user box -->
                   
                    <!-- search form 
                    -->
					
					<?php if(isset($_SESSION["campuses"]) && !empty($_SESSION["campuses"]) && sizeof($_SESSION["campuses"])>1 ){?>
					
						<div class="margin">
							<div class="btn-group col-centered">
								<button type="button" class="btn   btn-warning dropdown-toggle" data-toggle="dropdown">
									<?= $_SESSION["currentCampus"]["campus_name"] ?> &nbsp;&nbsp;<span class="caret"></span> 
								</button>
		                        <ul class="dropdown-menu" role="menu">
									<?php foreach($_SESSION["campuses"] as $campus){?>
			                        	<li><a href="<?= site_url("user/changeCurrentCampus")?>/<?= encodeID($campus["campus"]["id"])?>"><?= $campus["campus"]["campus_name"]?></a></li>
									<?php } ?>
								</ul>
		               		</div>
	               		</div>
					
					
					<?php } ?>					  
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?= $_SESSION["left_menu"] ?>
                    
                    
                </section>
                <!-- /.sidebar -->
            </aside>
        
        
        
        
        
        