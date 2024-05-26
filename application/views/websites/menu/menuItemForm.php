<?php ?>

<form class="form-horizontal" action="<?= site_url("website/saveMenuItem")?>" method="post">
	<fieldset>
		<div class="form-group">
			<label class="col-md-4 control-label" for="mi_title">Title</label>
			<div class="col-md-6">
				<input value="" id="mi_title" name="mi_title" type="text"  class="form-control input-md  " required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label" for="mi_url">URL</label>
			<div class="col-md-6">
				<input value="" id="mi_url" name="mi_url" type="text"  class="form-control input-md  " required="">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="submit"></label>
			<div class="col-md-4">
				<button id="submit" name="submit" class="btn btn-danger btn-raised ">Save</button>
			</div>
		</div>

	</fieldset>
</form>

			