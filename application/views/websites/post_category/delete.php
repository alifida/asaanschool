<?php ?>

<div class="col-centered">
	<div class="alert alert-warning">
		<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?
	</div>
</div>
<br />
<form class="form-horizontal" action="<?= site_url('website/deletePostCat') ?>" method="post">
	<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name:</td>
					<td><strong><?= $postCat["name"] ?></strong></td>
				</tr>
				<tr>
					<td>Parent:</td>
					<td><strong><?= isset($postCat["parent"]["name"]) && !empty($postCat["parent"]["name"])? $postCat["parent"]["name"]:'' ?></strong></td>
				</tr>
				<tr>
					<td>Display in Menu:</td>
					<td><strong><?= $postCat["display_in_menu"] ?></strong></td>
				</tr>

			</table>
		</div>


		<br />
		<!-- Button (Double) -->
		<div class="col-centered">
			<button class="btn btn-danger btn-raised ">Yes (Delete)</button>
		</div>

	</fieldset>
	<input id="id" name="id" type="hidden" value="<?= $postCat["id"] ?>">

</form>

