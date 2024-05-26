<?php ?>

<form class="form-horizontal" action="<?= site_url("website/savePostCat")?>" method="post">
	<fieldset>

		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="name">Name</label>
			<div class="col-md-6">
				<input value="<?= isset($postCat["name"])?$postCat["name"]:"" ?>" id="name" name="name" type="text" placeholder="Name" class="form-control input-md  " required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label" for="description">Description</label>
			<div class="col-md-6">
				<textarea name="description" id="description" rows="1"  class="form-control  "><?= isset($postCat['description'])?$postCat["description"]:""?></textarea>
			</div>
		</div>


		<div class="form-group">
			<label class="col-md-4 control-label" for="parent_cat">Parent Category</label>
			<div class="col-md-6">
				<select id="parent_cat" name="parent_cat" class="form-control  " >
					<option value=""></option>
					<?php if (isset($categories)){?>
						<?php foreach ($categories as $cat){?>
							<option value="<?= $cat["id"] ?>" <?= isset($postCat["parent"]["id"]) && $postCat["parent"]["id"] == $cat["id"]? ' selected ':'' ?>><?= $cat["name"] ?></option>
						<?php }?>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label" for="footer_page">Footer Page</label>  
		  	<div class="col-md-6">
		  		<select id="footer_page" name = "footer_page" class="form-control   " >
	  				<option value="">Default</option>
					<?php if(isset($webPages) && !empty($webPages)){ ?>
						<?php foreach($webPages as $footerPage){ ?>
								<option value="<?= $footerPage["id"] ?>"  <?= (!empty($postCat["footer_page_id"]) && $postCat["footer_page_id"] == $footerPage["id"])? " selected = 'true'":"" ?>   ><?= $footerPage["page_title"] ?></option>
						<?php } ?>
					<?php } ?>
				</select>
		  	</div>
		</div>
								


		<!-- Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="submit"></label>
			<div class="col-md-4">
				<input type="hidden" name="cat_id" value="<?= isset($postCat["id"])?$postCat["id"]:"" ?>" />
				<button id="submit" name="submit" class="btn btn-danger btn-raised ">Save</button>
			</div>
		</div>

	</fieldset>
</form>

