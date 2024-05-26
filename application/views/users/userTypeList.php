<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-warning">
                        <div class="box-header">
                            User Types
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="">
                                    <thead>
                                        <tr>
							                <th>Type</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($userTypes as $userType){ ?>
											<tr>
												<td><?= $userType['type'] ?></td>
												
												
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
