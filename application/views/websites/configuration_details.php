<?php //pre($website);?>
<br/>
<div class="box box-success ">
	<div class="box-header">
		Configuration <span class="pull-right">
		<a href="<?= site_url("website/editWebsite/") ?>" class="btn btn-xs btn-warning">Edit Configuration</a>
		<a href="<?= site_url("website/menu") ?>" class="btn btn-xs btn-warning">Website Menu</a>
		</span>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<h4>Website Details</h4>
			
				<table cellpadding="10px" class="table-padding table-user-information " style="width: 100%;">
					<tbody>
						<tr>
							<td width="30%" >
								<label class="pull-right">Site Title: </label>
							</td>
							<td>
								<?= (isset($website["site_title"]))?$website["site_title"] : "" ?>
							</td>
						</tr>
						<tr>
							<td >
								<label class="pull-right"> Tag line: </label>
							</td>
							<td>
								<?= (isset($website["tag_line"]))?$website["tag_line"] : "" ?>
							</td>
						</tr>
						<tr>
							<td>
								<label class="pull-right">Domain: </label>
							</td>
							<td>
								<a href="http://<?= (isset($website["domain"]))?$website["domain"] : "" ?>" target="_blank"  ><?= (isset($website["domain"]))?$website["domain"] : "" ?></a>
							</td>
						</tr>
						
					</tbody>
				</table>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
				<img src="<?= (isset($website["logo"]))?$website["logo"] : "" ?>" alt="" style="width: 150px;"/>
			</div>
			
		</div>
			
		
	</div>
	<!-- /.box-body -->
	
</div>



