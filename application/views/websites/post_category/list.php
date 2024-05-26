<?php ?>

<div class="box box-primary wow fadeInLeft animation-delay-1 mb-3">
	<div class="box-header">
		Categories
		<div class="pull-right ">
			<div class="btn-group  col-centered">
				<button type="button" onclick="load_remote_model('<?= site_url('website/editPostCat') ?>','New Post Category');" class="btn btn-raised  btn-danger btn-raised  btn-xs ">New</button>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table dataTables table-hover table-responsive ">
				<thead>
					<tr>
						<th>Name</th>
						<th>Display In Menu</th>
						<th class="all disable-sort" width="10%"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($website["categories"] as $cat){ ?>
					<tr>
						<td><?= $cat['name'] ?></td>
						<td><?= $cat['display_in_menu'] ?></td>
						<td>
							<div class="btn-group col-centered">
								<button type="button" class="btn btn-xs btn-primary btn-raised dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('website/editPostCat/'.encodeID($cat['id'])) ?>','Update Post Category');">Edit</a></li>
									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('website/deletePostCatConfirmation/'.encodeID($cat['id'])) ?>','Delete Post Category');">Delete</a></li>

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

