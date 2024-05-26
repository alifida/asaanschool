<?php
?>
<div class="row invoice	no-print">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
		<br />
		<div class="row">
			<div class="col-md-3 padding-5">

				<b class="pull-right">Name:</b>
			</div>
			<div class="col-md-9 padding-5">
				<p><?= isset($certificate["name"])?$certificate["name"]:"" ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 padding-5">
				<b class="pull-right">Description:</b>
			</div>
			<div class="col-md-9 padding-5">
				<p><?= isset($certificate["description"])?$certificate["description"]:"" ?></p>
			</div>
		</div>

	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<br />
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-xs btn-warning btn-outline dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li><a href="javascript:void(0);" onclick="global_ajax_from_submit('<?= site_url("certificate/edit/".encodeID($certificate["id"])) ?>','','certificate_area');">Edit</a></li>
				<li><a href="javascript:void(0);" onclick="global_ajax_from_submit('<?= site_url("certificate/listAll/") ?>','','certificate_area');">List</a></li>
				<li><a>Details</a></li>
				<li class="divider"></li>
			</ul>
		</div>
	</div>
</div>

<section class="content invoice" >
	<?php echo getCertificateContents($certificate); ?>
</section>
<!-- this row will not appear when printing -->
<div class="row no-print invoice">

	<div class="col-xs-12 padding-10">
		<button class="btn btn-default pull-right" onclick="window.print();">
			<i class="fa fa-print"></i> Print
		</button>


	</div>
</div>