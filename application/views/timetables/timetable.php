<?php  //pre($classes); ?>

<div class="box box-danger">
	<div class="box-header">
		Timetable
		<div class="pull-right  col-centered">
			<div class="btn-group  col-centered">
				<button type="button"
					class="btn btn-outline btn-default btn-xs dropdown-toggle "
					data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="javascript:void(0);"
						onclick="load_remote_model('<?= site_url('timetable/edit') ?>','Create timetable');">Create
							New</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	
		<?php if(!empty($classes)){ ?>
	
		<div class="table-responsive">
			<table class="table  table-hover table-responsive simpleDataTables">
				<thead>
					<tr>
						<th>Class Name</th>
						<?php foreach(getWeekDays() as $day){ ?>
						<th><?= $day ?></th>
						<?php }?>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($classes as $class){ ?>
				<?php if(!empty($class["subjects"])){ 
					$widgetClass=getRandomWidgetClass();
					?>
				<?php  foreach ($class["subjects"] as $subject){ ?>
					<tr>
						<td width="9%"><?= $class["name"] ?></td>
						<?php foreach(getWeekDays() as $day){ ?> 
							<?php $found = false; 
							
							?>
							<?php foreach ($subject["timetable"] as $timetable){ ?>
								 
								<?php if(isset($timetable["week_day"]) && $day == $timetable["week_day"] ){ 
									$found=true;  ?>
								<td width="13%">
									<div class="small-box <?= $widgetClass ?>">
										<div class="inner col-centered">
											<p><?= date('H:i', strtotime($timetable["start_time"])) ?> to <?= date('H:i', strtotime($timetable["end_time"])) ?>  </p>
										</div>
										<div  class="small-box-footer"> <?= $subject["name"] ?>
											
											<div class="btn-group ">
												<button type="button"
													class="btn btn-xxs btn-default btn-outline dropdown-toggle "
													data-toggle="dropdown">
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu pull-right" role="menu">
													<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('timetable/edit') ?>/<?= $timetable['id'] ?>','Update Timetable');">Edit</a></li>
													<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('timetable/deleteConfirmation') ?>?id=<?= $timetable['id'] ?>','Delete Timetable');">Delete</a></li>
												</ul>
											</div>
										
										</div>
									</div>
								</td>
								<?php break; }?>
							<?php }?>
							<?php if(!$found){?>
								<td class=" ">
									<div class="small-box <?= $widgetClass ?>">
										<div class="inner col-centered">
											<p>--</p>
										</div>
										<div  class="small-box-footer"> <?= $subject["name"] ?> 
											<!-- <div class="btn-group">
												 <button type="button"
													class="btn btn-xxs btn-default btn-outline dropdown-toggle"
													data-toggle="dropdown">
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu pull-right" role="menu">
													<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('timetable/edit') ?>','Create timetable');">New</a></li>
												</ul>
											</div> -->
										</div>
									</div>
								</td>
							<?php }?>
						<?php }?>

					</tr>
					<?php } ?>
					<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
<?php } ?>
	</div>
</div>

