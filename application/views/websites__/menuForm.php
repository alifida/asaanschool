<?php

?>
<div class="row">
	<div class="col-lg-7 col-md-7  col-sm-7  col-xs-12 ">
		<div class="box box-primary">
			<div class="box-header">Menu Items</div>
				<!-- /.box-header -->
			<div class="box-body">
			
			
			
			
			<form class="form-horizontal" action="<?= site_url('website/removeMenuItems')?>" method="post" id="remove_menu_items_form">
				 	
		        	<?php if(isset($allMenuItems) && !empty($allMenuItems)){?>
				        	<div class="table-responsive">
                                <table class="table table-hover simpleDataTables" id="">
                                    <thead>
                                        <tr>
							                <th>Menu Title</th>
							                <th>URL</th>
											<th class="all disable-sort"  width="10%">
												
											</th>
                                        </tr>
                                    </thead>
                                    <tbody>
						            	<?php foreach ($allMenuItems as $key => $menuItem) {?>
				            		<tr>
				            			<td><?= $menuItem["title"] ?></td>
				            			<td><?= $menuItem["target_url"] ?></td>
				            			<td>
				            				<div class="checkbox pull-right" style="margin-top: 0px; font-size: 16px; ">
						  							<label>
							            				<input type="checkbox" name="menuItemIds[]" value="<?= $menuItem["id"]  ?>"  >
							      							<span></span>
							  						</label>
							  					</div>
				            			
										</td>
				            		</tr>
					            <?php }?>
				            </tbody>
						</table>
					</div>
					<br/>
					<br/>
			            <div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 pull-right">
								<button type="submit" class="btn btn-block btn-primary pull-right "  style="margin-right: 20px;" >Remove</button>
							</div>
						</div>
		            <?php } else{?>
		            <br/>
		            	<div class="row">
							<div class="col-centered col-lg-11 col-md-11 col-sm-11 col-xs-11">
								<div class="alert alert-warning">
							    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
							    	Please add items to menu from right side.                           
								</div>
							</div>
							<br/>
						</div>
		            <?php } ?>
					
				</form>
			
				<form class="form-horizontal" action="<?= site_url('website/saveMenu')?>" method="post" id="create_menu_form">
				    <?php if(isset($currentMenu) && !empty($currentMenu)){?>
				    	<div class="row">
				    	<br/>
				    	<br/>
							<div class="col-centered col-lg-11 col-md-11 col-sm-11 col-xs-11">
								<div class="alert alert-info">
							    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
										Drag the menu items and to set the sort order.
								</div>
							</div>
							
						</div>
				        <div class="dd" id="menuItems">
					            <ol class="dd-list">
					               <?php foreach ($currentMenu as $menuItem){?>
					                <li class="dd-item " data-id="<?= $menuItem["id"]?>">
					                    <div class="dd-handle "><?= $menuItem["title"]?></div>
					                    <?php printChildMenuItems($menuItem)?>
					                </li>
					                <?php }?>
					            </ol>
							
				            
				                
				        </div>
				        <div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 pull-right">
								<button type="submit" class="btn btn-block btn-primary pull-right " style="margin-right: 20px;">Save</button>
							</div>
						</div>
					    <textarea style="display:none;" id="menuSortOrder" name="menuSortOrder"></textarea>
				   <?php } ?>
				        
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-5 col-md-5  col-sm-5  col-xs-12">
		<div class="box box-primary">
			<div class="box-header">Available Menu Itmes</div>
				<!-- /.box-header -->
			<div class="box-body">
				<form class="form-horizontal" action="<?= site_url('website/addPagesToMenu')?>" method="post" id="create_menu_form">
				 	
		        	<?php if(isset($availableMenuItems) && !empty($availableMenuItems)){?>
				        	<div class="table-responsive">
                                <table class="table table-hover simpleDataTables" id="">
                                    <thead>
                                        <tr>
							                <th>Page Title</th>
							                <th>Menu Title</th>
											<th class="all disable-sort"  width="10%">
												
											</th>
                                        </tr>
                                    </thead>
                                    <tbody>
						            	<?php foreach ($availableMenuItems as $key => $item) {?>
				            		<tr>
				            			<td><?= $item["page_title"] ?></td>
				            			<td><?= $item["menu_title"] ?></td>
				            			<td>
				            				<div class="checkbox pull-right" style="margin-top: 0px; font-size: 16px; ">
						  							<label>
							            				<input type="checkbox" name="pageIds[]" value="<?= $item["id"]  ?>"  >
							      							<span></span>
							  						</label>
							  					</div>
				            			
										</td>
				            		</tr>
					            <?php }?>
				            </tbody>
						</table>
					</div>
			            <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 pull-right">
								<button type="submit" class="btn btn-block btn-primary pull-right " >Add to menu</button>
							</div>
						</div>
		            <?php } else{?>
		            <br/>
		            	<div class="row">
							<div class="col-centered col-lg-11 col-md-11 col-sm-11 col-xs-11">
								<div class="alert alert-warning">
							    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
							    	No item available.                            
								</div>
							</div>
							<br/>
						</div>
		            <?php } ?>
					
				</form>
			</div>
		</div>
	</div>	
</div>	

<?php function printChildMenuItems($menuItem){
	if( isset($menuItem["children"]) && !empty($menuItem["children"])){
		foreach ($menuItem["children"] as $subMenuItem){?>
			<ol class="dd-list">
				<li class="dd-item " data-id="<?= $subMenuItem["id"] ?>">
                	<div class="dd-handle "><?= $subMenuItem["title"] ?></div>
                	<?php printChildMenuItems($subMenuItem); ?>
              	</li>
			</ol>
			
		<?php }
	}
	
}?>

