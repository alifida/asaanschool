<?php  ?>

<div class="box box-primary wow zoomInUp">
	<div class="box-header">
		Sliders
		<div class="pull-right ">
			<div class="btn-group  col-centered">
				<a href="<?= site_url('website/editSlider') ?>" class="btn btn-raised  btn-danger btn-raised  btn-xs ">New</a>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table  table-hover table-responsive " >
				<thead>
					<tr>
						<th>Name</th>
						<th class="all disable-sort" width="10%"></th>
					</tr>
				</thead>
				<tbody>
				<?php if(isset($website["sliders"])){?>
					<?php foreach($website["sliders"] as $slider){ ?>
						<tr>
							<td><?= $slider['name'] ?></td>
							<td>
								<div class="btn-group col-centered">
									<button type="button" class="btn btn-xs btn-primary btn-raised  dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li><a href="<?= site_url('website/editSlider/'.$slider['id']) ?>" >Edit</a></li>
										<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('website/deleteSliderConfirmation/'.$slider['id']) ?>','Delete Slider');">Delete</a></li>
									</ul>
								</div>
							</td>
						</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

