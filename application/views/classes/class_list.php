<?php

?>
<div class="box box-success">
	<div class="box-header">
		Classes
		<div class="pull-right " >
			 <div class="btn-group ">
				<a href="<?= site_url('subject') ?>" class="btn btn-outline btn-success btn-xs">Subjects</a>
				<a href="<?= site_url('timetable') ?>" class="btn btn-outline btn-success btn-xs">Timetable</a>
				<button type="button" onclick="load_remote_model('<?= site_url('classes/editClass') ?>','Create Class');" class="btn btn-outline btn-success btn-xs">New Class</button>
				</div>
				  
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-hover simpleDataTables " id="">
				<thead>
					<tr>
						<th>Name</th>
						<th class="all disable-sort"  width="10%"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($classes as $class){ ?>
						<tr>
							<td><?= $class['name'] ?></td>
							
							<td>
								<div class="btn-group col-centered" >
								  <button type="button" class="btn btn-xs btn-success btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu pull-right" role="menu">
									<li><a href="javascript:void(0);" 
										onclick="load_remote_model('<?= site_url('classes/editClass') ?>?id=<?= $class['id'] ?>','Update Class');">Edit</a></li>
									<li><a href="javascript:void(0);" 
										onclick="load_remote_model('<?= site_url('classes/deleteClassForm') ?>?id=<?= $class['id'] ?>','Delete Class');">Delete</a></li>
									<li class="divider"></li>
									<li><a href="<?= site_url("subject/cls/") ?><?= $class["id"]?>">Related Subjects</a></li>
									<li><a href="<?= site_url("timetable/cls/") ?><?= $class["id"]?>">Timetable</a></li>
									<li><a href="<?= site_url("student") ?>?class_id=<?= $class["id"]?>">Related Students</a></li>
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

