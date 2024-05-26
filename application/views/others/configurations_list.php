<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            Configurations
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover simpleDataTables" id="">
                                    <thead>
                                        <tr>
							                <th>Key</th>
							                <th>Value</th>
											<th  class="all disable-sort"  width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($configurations as $conf){ ?>
											<tr>
												<td><?= $conf['label'] ?></td>
												<td><?= $conf['value'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													   <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editConfiguration') ?>?id=<?= $conf['id'] ?>','Update Configuration');">Edit</a>
													    </li>
													    
													    
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
