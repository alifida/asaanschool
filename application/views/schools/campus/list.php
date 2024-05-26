<?php  ?>

                    <div class="box box-success">
                        <div class="box-header">
                            Campuses
                           
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover simpleDataTables" id="">
                                    <thead>
                                        <tr>
											<th>Name</th>
											<th class="all disable-sort" ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($campuses as $campus){ ?>
											<tr>
												<td><?= $campus['campus_name'] ?></td>
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-outline btn-success dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="<?= site_url("appadmin/campusDetail") ?>/<?= encodeID($campus['id']) ?>/<?= $campus['slug'] ?>">Details</a></li>
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
                
