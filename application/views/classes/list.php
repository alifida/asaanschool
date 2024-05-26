<?php ?>

 					<div class="box box-success">
                        <div class="box-header">
                             Classes
                            
                            <div class="pull-right " >
                            	
						         <div class="btn-group ">
						         	<button type="button" onclick="javascript:location.href='<?= site_url("student")?>'" 
						              	class="btn  btn-primary btn-xs">All Students</button> 
						            </div>
						            
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="list-group">
                            	<?php foreach($classes as $class){ ?>
                            		<a href="<?= site_url("student") ?>?class_id=<?= $class["id"]?>" class="list-group-item  <?= (isset($selectedClassId )&& $class["id"]==$selectedClassId)?" list-group-item-active ":"" ?>">
                                     <?= $class['name'] ?>
	                                    	<span class="pull-right text-muted small"><em></em></span>
	                                </a>
                            	<?php } ?>
                            	
                                
                            </div>
                            <!-- /.list-group
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                             -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
