<?php ?>
<div class="row"  id="cat_wrapper___<?= isset($itemId)?$itemId:'' ?>">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-centered ">
		<div class="panel panel-default">
			<div class="panel-heading">
            	Configure Post Category
          	</div>
			<div class="panel-body">
				<div class="pull-right ">
					<a href="javascript:void(0)" onclick="removePagePostCatItem('<?= isset($itemId)?$itemId:'' ?>')" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised " style="margin: -33px 0px 0px -10px;position: absolute;">
						<i class="fa fa-times" aria-hidden="true"></i>
						<div class="ripple-container"></div>
					</a>
				</div>
             	<div class="row">     
                      <br/> 
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label  " for="category___<?= isset($itemId)?$itemId:'' ?>">Post Category</label>
						<select id="category___<?= isset($itemId)?$itemId:'' ?>" name = "category___<?= isset($itemId)?$itemId:'' ?>" class="form-control   " required="required" >
				  			<option value="" >Select</option>
							<?php if(isset($categories) && !empty($categories)){
								foreach($categories as $cat){ ?>
									<option value="<?= $cat["id"] ?>"  <?= (isset($pagePostCat["category_id"]) && !empty($pagePostCat["category_id"]) && $pagePostCat["category_id"] == $cat["id"])? " selected = 'true'":"" ?>   ><?= $cat["name"] ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label  " for="layout_column___<?= isset($itemId)?$itemId:'' ?>">Column</label>
						<select id="layout_column___<?= isset($itemId)?$itemId:'' ?>" name = "layout_column___<?= isset($itemId)?$itemId:'' ?>" class="form-control   " required="required" >
				  			<option value="" >Select</option>
				  			<option value="col_1"  <?= (isset($pagePostCat["layout_column"]) && !empty($pagePostCat["layout_column"]) && $pagePostCat["layout_column"] == 'col_1')? " selected = 'true'":"" ?>   >Column 1</option>
				  			<option value="col_2"  <?= (isset($pagePostCat["layout_column"]) && !empty($pagePostCat["layout_column"]) && $pagePostCat["layout_column"] == 'col_2')? " selected = 'true'":"" ?>   >Column 2</option>
				  			<option value="col_3"  <?= (isset($pagePostCat["layout_column"]) && !empty($pagePostCat["layout_column"]) && $pagePostCat["layout_column"] == 'col_3')? " selected = 'true'":"" ?>   >Column 3</option>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label  " for="post_template___<?= isset($itemId)?$itemId:'' ?>">Post Template</label>
						<select id="post_template___<?= isset($itemId)?$itemId:'' ?>" name = "post_template___<?= isset($itemId)?$itemId:'' ?>" class="form-control   " required="required" >
				  			<option value="" >Select</option>
				  			<option value="1"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '1')? " selected = 'true'":"" ?>   >Template 1</option>
				  			<option value="2"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '2')? " selected = 'true'":"" ?>   >Template 2</option>
				  			<option value="3"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '3')? " selected = 'true'":"" ?>   >Template 3</option>
				  			<option value="4"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '4')? " selected = 'true'":"" ?>   >Template 4</option>
				  			<option value="5"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '5')? " selected = 'true'":"" ?>   >Template 5</option>
				  			<option value="6"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '6')? " selected = 'true'":"" ?>   >Template 6</option>
				  			<option value="7"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '7')? " selected = 'true'":"" ?>   >Template 7</option>
				  			<option value="8"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '8')? " selected = 'true'":"" ?>   >Template 8</option>
				  			<option value="9"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '9')? " selected = 'true'":"" ?>   >Template 9</option>
				  			<option value="10"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '10')? " selected = 'true'":"" ?>   >Template 10</option>
				  			<option value="11"  <?= (isset($pagePostCat["post_template"]) && !empty($pagePostCat["post_template"]) && $pagePostCat["post_template"] == '11')? " selected = 'true'":"" ?>   >Template 11</option>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label  " for="top_records___<?= isset($itemId)?$itemId:'' ?>">Top Posts</label>
						<input id="top_records___<?= isset($itemId)?$itemId:'' ?>" name="top_records___<?= isset($itemId)?$itemId:'' ?>" type="text" class="form-control input-md   " required="required" value="<?= (isset($pagePostCat["top_records"]))?$pagePostCat["top_records"] : "" ?>" />
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label  " for="sort_order___<?= isset($itemId)?$itemId:'' ?>">Sort Order</label>
						<input id="sort_order___<?= isset($itemId)?$itemId:'' ?>" name="sort_order___<?= isset($itemId)?$itemId:'' ?>" type="text" class="form-control input-md   " required="required" value="<?= (isset($pagePostCat["sort_order"]))?$pagePostCat["sort_order"] : "" ?>" />
					</div>
					
				</div>
			</div>
		 </div>
	</div>
</div>