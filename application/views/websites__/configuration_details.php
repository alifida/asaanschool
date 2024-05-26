<?php //pre($website);?>

<div class="box box-primary">
	<div class="box-header">
		Configuration <span class="pull-right">
		<a href="<?= site_url("website/editWebsite/") ?>" class="btn btn-xs btn-warning">Edit Configuration</a>
		<a href="<?= site_url("website/createMenu/") ?>" class="btn btn-xs btn-warning">Website Menu</a>
		</span>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			
			<div class="col-lg-7 col-md-7 col-sm-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
				<h4>Website Details</h4>
				<table class="table table-user-information ">
					<tbody>
						<tr>
							<td class="col-lg-4">
								Site Title:
							</td>
							<td>
								<?= (isset($website["site_title"]))?$website["site_title"] : "" ?>
							</td>
						</tr>
						<tr>
							<td class="col-lg-4">
								Tag line:
							</td>
							<td>
								<?= (isset($website["tag_line"]))?$website["tag_line"] : "" ?>
							</td>
						</tr>
						<tr>
							<td>
								Domain:
							</td>
							<td>
								<a href="http://<?= (isset($website["domain"]))?$website["domain"] : "" ?>" target="_blank"  ><?= (isset($website["domain"]))?$website["domain"] : "" ?></a>
							</td>
						</tr>
						
					</tbody>
				</table>
			</div>
				
			
		</div>
			
		
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<br/>
	</div>
</div>



