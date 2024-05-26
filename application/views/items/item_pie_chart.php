<?php ?>


 

<div class="box box-solid">
	<div class="box-header"> </div>
	<div class="box-body text-center">
		<div class="sparkline" data-type="pie" data-offset="90" data-width="197px" data-height="197px">
        	<?= $stock ?>,<?= $dueItems ?>,0,<?= $paidItems ?>
		</div>
		<br/>
		
	</div><!-- /.box-body -->
	<div class="box-footer">
		<div class="row text-center">
			<div class="col-md-4 col-sm-4 col-xs-4">Available<br/>(Stock)<br/><i class="fa fa-fw fa-square" style="color: #36C" ></i></div>
			<div class="col-md-4 col-sm-4 col-xs-4">Issued<br/>(Due)<br/><i class="fa fa-fw fa-square" style="color: #DC3912"></i></div>
			<div class="col-md-4 col-sm-4 col-xs-4">Issued<br/>(Paid)<br/><i class="fa fa-fw fa-square" style="color: #109618"></i></div>
		</div>
	</div>
</div><!-- /.box -->