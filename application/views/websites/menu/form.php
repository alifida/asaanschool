<?php
?>
<div class="row">
	<div class="col-lg-6 col-md-6  col-sm-12  col-xs-12">
		<div class="box box-primary">
			<div class="box-header">Menu Items
				<div class="pull-right ">
					<div class="btn-group  col-centered">
						<button type="button" onclick="load_remote_model('<?= site_url('website/createNewMenuItem') ?>','Menu Item');" class="btn btn-raised  btn-danger btn-raised  btn-xs ">New Menu Item</button>
					</div>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">

				<form class="form-horizontal" action="<?= site_url('website/removeMenuItems')?>" method="post" id="remove_menu_items_form">
		        	<?php if(isset($currentMenu) && !empty($currentMenu)){?>
				        	<div class="table-responsive">
						<table class="table table-hover dataTables" id="">
							<thead>
								<tr>
									<th>Order</th>
									<th>Menu Title</th>
									<th>URL</th>
									<th class="all disable-sort" width="10%"></th>
								</tr>
							</thead>
							<tbody>
						      <?php foreach ($currentMenu as $key => $menuItem) {?>
				            	<tr>
									<td><?= $menuItem["sort_order"] ?></td>
									<td><?= $menuItem["title"] ?></td>
									<td><?= trimRightString($menuItem["target_url"], 20) ?></td>
									<td style="padding: 0px;">
										<div class="checkbox pull-right checkbox-md" >
											<label > <input type="checkbox" name="menuItemIds[]" value="<?= $menuItem["id"]  ?>"> <span></span>
											</label>
										</div>

									</td>
								</tr>
					            <?php }?>
				            </tbody>
						</table>
					</div>
					
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 pull-right">
							<button type="submit" class="btn btn-raised btn-primary pull-right " style="margin-right: 20px;">Remove</button>
						</div>
					</div>
		            <?php } else{?>
		            <br />
					<div class="row">
						<div class="col-centered col-lg-11 col-md-11 col-sm-11 col-xs-11">
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Please add items to menu from right side.
							</div>
						</div>
						<br />
					</div>
		            <?php } ?>
					
				</form>
			</div>
		</div>
		
		
		<div class="box box-primary">
			<div class="box-header">Post Categories</div>
			<!-- /.box-header -->
			<div class="box-body">
				<form class="form-horizontal" action="<?= site_url('website/addPostCatToMenu')?>" method="post" >
				 	
		        	<?php if(isset($postCats) && !empty($postCats)){?>
				        	<div class="table-responsive">
						<table class="table table-hover simpleDataTables">
							<thead>
								<tr>
									<th>Name</th>
									<th class="all disable-sort" width="10%"></th>
								</tr>
							</thead>
							<tbody>
						     	<?php foreach ($postCats as $key => $cat) {?>
				            	<tr>
									<td><?= $cat["name"] ?></td>
									<td>
										<div class="checkbox pull-right checkbox-md" >
											<label> <input type="checkbox" name="catIds[]" value="<?= $cat["id"]  ?>"> <span></span>
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
							<button type="submit" class="btn  btn-raised btn-primary pull-right ">Add to menu</button>
						</div>
					</div>
		            <?php } else{?>
					<div class="row">
						<div class="col-centered col-lg-11 col-md-11 col-sm-11 col-xs-11">
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; No item available.
							</div>
						</div>
						<br />
					</div>
		            <?php } ?>
				</form>
			</div>
		</div>
		
		
		
	</div>
	
	
	
	
	
	
	<div class="col-lg-6 col-md-6  col-sm-12  col-xs-12">
		<div class="box box-primary">
			<div class="box-header">Menu Order</div>
			<!-- /.box-header -->
			<div class="box-body">
				<form class="form-horizontal" action="<?= site_url('website/saveMenu')?>" method="post" >
				    <?php if(isset($currentMenu) && !empty($currentMenu)){?>
				    	<div class="row">
						<div class="col-centered col-lg-11 col-md-11 col-sm-11 col-xs-11">
							<div class="alert alert-info">
								<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Drag menu items to set the sort order.
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
							<button type="submit" class="btn btn-raised btn-primary pull-right " style="margin-right: 20px;">Save</button>
						</div>
					</div>
					<textarea style="display: none;" id="menuSortOrder" name="menuSortOrder"></textarea>
				   <?php } ?>
				</form>
			</div>
		</div>
		
		<div class="box box-primary">
			<div class="box-header">Pages</div>
			<!-- /.box-header -->
			<div class="box-body">
				<form class="form-horizontal" action="<?= site_url('website/addPagesToMenu')?>" method="post" >
				 	
		        	<?php if(isset($pages) && !empty($pages)){?>
				        	<div class="table-responsive">
						<table class="table table-hover simpleDataTables" id="">
							<thead>
								<tr>
									<th>Page Title</th>
									<th>Menu Title</th>
									<th class="all disable-sort" width="10%"></th>
								</tr>
							</thead>
							<tbody>
						     	<?php foreach ($pages as $key => $page) {?>
				            	<tr>
									<td><?= $page["page_title"] ?></td>
									<td><?= $page["menu_title"] ?></td>
									<td>
										<div class="checkbox pull-right checkbox-md" >
											<label> <input type="checkbox" name="pageIds[]" value="<?= $page["id"]  ?>"> <span></span>
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
							<button type="submit" class="btn  btn-raised btn-primary pull-right ">Add to menu</button>
						</div>
					</div>
		            <?php } else{?>
		            <br />
					<div class="row">
						<div class="col-centered col-lg-11 col-md-11 col-sm-11 col-xs-11">
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; No item available.
							</div>
						</div>
						<br />
					</div>
		            <?php } ?>
				</form>
			</div>
		</div>
		
	</div>
	
	
	
	
	
	
	
	
	
	
		
		
	
	
	
</div>

<?php

function printChildMenuItems($menuItem) {
	if (isset ( $menuItem ["children"] ) && ! empty ( $menuItem ["children"] )) {
		foreach ( $menuItem ["children"] as $subMenuItem ) {
			?>
<ol class="dd-list">
	<li class="dd-item " data-id="<?= $subMenuItem["id"] ?>">
		<div class="dd-handle "><?= $subMenuItem["title"] ?></div>
                	<?php printChildMenuItems($subMenuItem); ?>
              	</li>
</ol>

<?php
		
}
	}
}
?>

