<?php  ?>

			<div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            Widgets
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li>
						               			<a href="javascript:void(0);" onclick="load_remote_model('<?= site_url("website/editWidget/") ?>','New Widget');enlarge_remote_model();">New Widget</a>
						               		</li>
						               </ul>
						            </div>
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
								<table class="table table-hover simpleDataTables ">
									<thead>
                                        <tr>
							                <th>Title</th>
							                <th>Contents</th>
											<th class="all disable-sort"  width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php if(isset($website['widgets']) && !empty($website['widgets'])) {?>
									<?php foreach($website['widgets'] as $widget){ ?>
										<tr>
											<td>
												<?= (isset($widget["title"]))?$widget["title"] : "" ?>
											</td>
											
											<td><span class="text-overflow-hide"  style="max-width: 200px;">
												<?php if(isset($widget["html"]) && !empty($widget["html"])){
													echo preg_replace('/(?:\s\s+|\n|\t|&nbsp;)/', ' ',strip_tags($widget["html"]));
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
													  	<li>
													  		<a href="javascript:void(0);" onclick="load_remote_model('<?= site_url("website/editWidget/".encodeID($widget["id"])) ?>','Edit Widget');enlarge_remote_model();">Edit</a>
													  	</li>
													   <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('website/deleteWidgetForm/'.encodeID($widget['id'])) ?>','Delete Widget');">Delete</a></li>
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