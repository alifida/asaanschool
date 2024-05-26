<?php
?>


<div class="box box-danger">
	<div class="box-header">
		Subjects
		<div class="pull-right  col-centered">
			<div class="btn-group  col-centered">
				<button type="button"
					class="btn btn-outline btn-default btn-xs dropdown-toggle "
					data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="javascript:void(0);"
						onclick="load_remote_model('<?= site_url('subject/edit') ?>','Create Subject');">Create New</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table  table-hover table-responsive dataTables" id="">
				<thead>
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Class</th>

						<th width="10%"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($subjects as $subject){ ?>
					<tr>
						<td><?= $subject['name'] ?></td>
						<td><?= $subject['description'] ?></td>
						<td><?= $subject['class']['name'] ?></td>


						<td>
							<div class="btn-group">
								<button type="button"
									class="btn btn-xs btn-danger btn-outline dropdown-toggle"
									data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">

									<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url('subject/edit') ?>/<?= $subject['id'] ?>','Update Subject');">Edit</a></li>
									<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url('subject/detail') ?>/<?= $subject['id'] ?>','Detail');">Detail</a></li>
									<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url('subject/deleteConfirmation') ?>/<?= $subject['id'] ?>','Delete Subject');">Delete</a></li>


								</ul>
							</div>

						</td>
					</tr>
											<?php } ?>
										</tbody>
			</table>
		</div>

	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

