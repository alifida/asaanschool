<?php  ?>

			<div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary wow fadeInRight">
                        <div class="box-header ">
                            Web Pages
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-raised btn-danger  btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a href="<?= site_url("website/editPage/") ?>">New Page</a></li>
						               		<li><a href="<?= site_url("website/menu") ?>">Create Menu</a></li>
						               </ul>
						            </div>
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
								<?php if(isset($website['webPages']) && !empty($website['webPages'])) {?>
								<table class="table table-hover dataTables ">
									<thead>
                                        <tr>
							                <th width="30%">Page Title</th>
							                <th>Menu Title</th>
							                <th>Status</th>
							                <th>Layout</th>
							                <th>Welcome Page</th>
											<th class="all disable-sort" width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($website['webPages'] as $webPage){ ?>
										<tr>
											<td>
												<?= (isset($webPage["page_title"]))? trimRightString($webPage["page_title"],50) : "" ?>
											</td>
											<td>
												<?= (isset($webPage["menu_title"]))?$webPage["menu_title"] : "" ?>
											</td>
											<td>
												<?= (isset($webPage["status"]))?$webPage["status"] : "" ?>
											</td>
											<td>
												<?= (isset($webPage["layout"]))?$webPage["layout"] : "" ?>
											</td>
											<td>
												<?= (isset($webPage["is_welcome_page"]))?$webPage["is_welcome_page"] : "" ?>
											</td>
											
											<td>
												<div class="btn-group col-centered" >
												  <button type="button" class="btn btn-xs btn-primary btn-raised dropdown-toggle" data-toggle="dropdown">
												   	<span class="caret"></span> 
												  </button>
												  <ul class="dropdown-menu pull-right" role="menu">
													   	<li><a href='http://<?= $website["domain"]?><?=(empty($webPage["page_url"]))? "":"/site/preview/".$website["id"]."/".$webPage["page_url"]."" ?>' target="_blank" >Preview</a></li>
												  		<li><a href="<?= site_url("website/editPage/".encodeID($webPage["id"])) ?>">Edit</a></li>
												  	<?php if($webPage["status"] == get_app_message("post.status.trash")){?>
												    	<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('website/deletePageForm/'.encodeID($webPage['id'])) ?>','Delete Webpage');enlarge_remote_model();">Permanently Delete</a></li>
												   <?php  } ?>
												  </ul>
												</div>
											</td>
										</tr>
									<?php } ?>	
									</tbody>
								</table>
							<?php } ?>
							</div>
                           

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->