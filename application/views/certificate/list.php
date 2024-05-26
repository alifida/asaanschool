<?php
//pre_d($certificates);
?>

<div class="box box-warning">
	<div class="box-header">
		<div class="pull-right ">
			<div class="btn-group ">
				<button type="button" onclick="global_ajax_from_submit('<?= site_url("certificate/edit") ?>','','certificate_area');" class="btn btn-outline btn-warning btn-xs">New Certificate</button>
			</div>
		</div>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table  table-hover table-responsive dataTables" id="certificates_table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Page Size</th>
						<th>Margins</th>
						<th>Linked With</th>
						<th class="all disable-sort"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($certificates as $certificate){ ?>
						<tr>
						<td><?= $certificate['name'] ?></td>
						<td><?= $certificate['description'] ?></td>
						<td><?= $certificate['page_size'] ?></td>
						<td><?= $certificate['margins'] ?></td>
						<td><?= $certificate['linked_with'] ?></td>
						<td>
							<div class="btn-group col-centered">
								<button type="button" class="btn btn-xs btn-warning btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li><a href="javascript:void(0);" onclick="global_ajax_from_submit('<?= site_url("certificate/edit/".encodeID($certificate["id"])) ?>','','certificate_area');" >Edit</a></li>
									<li><a href="javascript:void(0);" onclick="global_ajax_from_submit('<?= site_url("certificate/preview/".encodeID($certificate["id"])) ?>','','certificate_area');" >Preview</a></li>
									<li><a>Details</a></li>
									<li class="divider"></li>
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
<script type="text/javascript">
	initDatatablesById("certificates_table");
</script>
