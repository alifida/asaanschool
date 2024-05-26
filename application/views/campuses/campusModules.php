<?php

?>
<div class="box box-success">
	<div class="box-header">
		Modules
		<div class="pull-right " >
			 <div class="btn-group ">
				<a href="<?= site_url('campus/selectModules') ?>" 
					class="btn btn-outline btn-default btn-xs">Modules Selection</a>
				</div>
				  
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-hover simpleDataTables" id="">
				<thead>
					<tr>
						<th>Modules </th>
						<th class="all disable-sort" width="10%"></th>
					</tr>
				</thead>
				<tbody>
				
					<?php if(isset($campusModules) && !empty($campusModules)){ ?>
						<?php foreach($campusModules as $campusModule){ ?>
							<tr>
								<td><?= $campusModule["module"]['name'] ?></td>
								
								<td>
									
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

