<?php  ?>

			<div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            Web Pages
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a href="<?= site_url("website/createPage/") ?>">New Page</a></li>
						               		<li><a href="<?= site_url("website/editFooter") ?>">Create Footer</a></li>
						               		<li><a href="<?= site_url("website/createMenu") ?>">Create Menu</a></li>
						               </ul>
						            </div>
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
								<?php if(isset($website['webPages']) && !empty($website['webPages'])) {?>
								<table class="table table-hover simpleDataTables ">
									<thead>
                                        <tr>
							                <th>Page Title</th>
							                <th>Menu Title</th>
							                <th>Status</th>
							                <th>Page Type</th>
							                <th width="30%">Contents</th>
											<th class="all disable-sort" width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($website['webPages'] as $webPage){ ?>
										<tr>
											<td>
												<?= (isset($webPage["page_title"]))?$webPage["page_title"] : "" ?>
											</td>
											<td>
												<?= (isset($webPage["menu_title"]))?$webPage["menu_title"] : "" ?>
											</td>
											<td>
												<?= (isset($webPage["status"]))?$webPage["status"] : "" ?>
											</td>
											<td>
												<?= (isset($webPage["pageType"]["type"]))?$webPage["pageType"]["type"] : "" ?>
											</td>
											<td><span class="text-overflow-hide" style="max-width: 200px;">
												<?php if(isset($webPage["html"]) && !empty($webPage["html"])){
													echo preg_replace('/(?:\s\s+|\n|\t|&nbsp;)/', ' ',strip_tags($webPage["html"]));
												} else{
													echo "";
												}
													?>
												</span>
												
											</td>
											<td>
												<div class="btn-group col-centered" >
												  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
												   	<span class="caret"></span> 
												  </button>
												  <ul class="dropdown-menu pull-right" role="menu">
												  <?php if($webPage["pageType"]["type"] ==  get_app_message("db.website.template.type.footer")){ ?>
												  		<li><a href="<?= site_url("website/editFooter/".encodeID($webPage["id"])) ?>">Edit</a></li>
												  <?php }else{ ?>
													   	<li><a href='http://<?= $website["domain"]?><?=(empty($webPage["page_url"]))? "":"/site/page/".$webPage["page_url"].".html" ?>' target="_blank" >Preview</a></li>
												  		<li><a href="<?= site_url("website/editPage/".encodeID($webPage["id"])) ?>">Edit</a></li>
												  <?php } ?>
												  	<?php if($webPage["status"] == get_app_message("webpage.status.trash")){?>
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