<?php ?>

<div class="col-centered">
	<div class="alert alert-warning">
		<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
		Are you sure to <strong>DELETE</strong> the following object?
	</div>
</div>
<br />
<form class="form-horizontal"
	action="<?= site_url('website/deleteSlider') ?>" method="post">
	<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name:</td>
					<td><strong><?= $slider["name"] ?></strong></td>
				</tr>
			</table>
		</div>


		<br />
		<!-- Button (Double) -->
		<div class="col-centered">
			<button class="btn btn-danger btn-raised ">Yes (Delete)</button>
		</div>

	</fieldset>
	<input id="id" name="id" type="hidden" value="<?= $slider["id"] ?>">

</form>

