<?php  ?>

			<div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary wow zoomInUp">
                        <div class="box-header">
                            Posts
                            <div class="pull-right " >
						            <div class="btn-group  col-centered">
										<a href="<?= site_url("website/editPost/") ?>" class="btn btn-raised  btn-danger btn-raised  btn-xs ">New Post</a>
									</div>
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
								<table class="table table-hover dataTables ">
									<thead>
                                        <tr>
							                <th  width="30%">Title</th>
							                <th>Status</th>
							                <th>Publish Date</th>
							                <th>Expiry Date</th>
											<th class="all disable-sort"  width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php if(isset($website['posts']) && !empty($website['posts'])) {?>
									<?php foreach($website['posts'] as $post){ ?>
										<tr>
											<td><?= (isset($post["title"]))? trimRightString($post["title"],50) : "" ?></td>
											<td><?= (isset($post["status"]))?$post["status"] : "" ?></td>
											<td><?= (isset($post["publish_at"]))?$post["publish_at"] : "" ?></td>
											<td><?= (isset($post["expire_at"]))?$post["expire_at"] : "" ?></td>
											
											
											<td>
												<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-primary btn-raised dropdown-toggle" data-toggle="dropdown">
													   	<span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													  	<li>
													  		<a href="<?= site_url("website/editPost/".encodeID($post["id"])) ?>" >Edit</a>
													  	</li>
													   <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('website/deletePostForm/'.encodeID($post['id'])) ?>','Delete Post');">Delete</a></li>
													  </ul>
													</div>
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->