<?php
?>
<section class="content-header">
	<h1>Noticeboard</h1>
</section>
<section class="content">
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header">Notifications</div>
				<!-- /.box-header -->
				<div class="box-body">

					<div class="row">
						<?php foreach($notifications as $notification){ ?>
						<div class="col-lg-4 col-md-6 col-sm-6  col-xs-12">
							<div class="box box-solid bg-light-blue">
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
								<a href="#" class="small-box-footer"> <br> </a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</section>
