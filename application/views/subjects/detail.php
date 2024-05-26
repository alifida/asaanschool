<?php ?>


<div class="row">
	<div class="col-lg-12">
		<div class="box box-danger">
			<div class="box-header">Subject</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="col-centered">
					<table class="table table-hover" id="">
						<tr>
							<td>Name:</td>
							<td><strong> <?=   (isset($subject["name"]))?$subject["name"]:"$subject"; ?> </strong></td>
						</tr>
						<tr>
							<td>Description:</td>
							<td><strong> <?=   (isset($subject["description"]))?$subject["description"]:''; ?> </strong></td>
						</tr>
						<tr>
						<td>Class :</td>
							<td><strong> <?=   (isset($subject["class"]))?$subject["class"]['name']:''; ?> </strong></td>
						</tr>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>




