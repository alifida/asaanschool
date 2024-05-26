<?php
?>
 
	<!-- /.row -->

		<?php foreach($notifications as $notification){ ?>
		<div class="col-lg-4 col-md-6 col-sm-6  col-xs-12">
			<div class="box box-solid <?= getRandomWidgetClass() ?>">
				<div class="box-header" style="padding: 0px;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3 class="box-title"><?= $notification['subject'] ?></h3>
						</div>
					</div>
				</div>
				<div class="box-body">
									<?= $notification['body'] ?>
								</div>
				<a href="#" class="small-box-footer"> <br>
				</a>
			</div>
		</div>
	<?php } ?>


