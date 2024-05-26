<?php  ?>

<div class="col-centered">
	<div class="alert alert-warning">
		<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?
	</div>
</div>
<br />
<form class="form-horizontal" action="<?= site_url('website/deleteGalaryFile') ?>" method="post">
		<?php 
						$filePath = site_url("public/images/attachment.jpg"); 
									if(isImageFile($file["file_path"])){
										$filePath = $file["file_path"];
									}
								
								?>
		<div class='text-center'> <img src="<?= $filePath ?>" style="max-width: 100%;"></div>
		<br />
		<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong> <?= isset($file["name"])?$file["name"]:"" ?>	</strong> </td>
				</tr>
				<tr>
					<td>URL: </td>
					<td><strong> <?= isset($file["file_path"])?$file["file_path"]:"" ?>	</strong> </td>
				</tr>
		</table>
		<div class="col-centered">
			<button class="btn btn-danger btn-raised ">Yes (Delete)</button>
		</div>
	
	
	
	
	
	
	
	
	<input id="gal_file_id" name="gal_file_id" type="hidden" value="<?= $file["id"] ?>">
		
</form>

