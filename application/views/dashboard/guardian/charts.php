<?php //pre($classesChartData)?>


					<div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <div class="box box-solid">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Payments/Dues</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div> 
                                <div class="box-body">
                                    
                                    <div class="row">
                                    	 
	                                    <?php $mainKnobColor =getRandomColorCode(); ?>
	                                    	<div class="col-md-12 col-sm-12 col-xs-12 text-center">
	                                            <input type="text" class="knob" value="<?= $totalDueAmount ?>" data-min="0" data-max="<?= $totalDueAmount +  $totalPaidAmount ?>"
	                                             data-width="180" data-height="180" data-fgColor="<?= $mainKnobColor ?>"  data-readonly="true"/>
	                                            <div class="col-md-6 knob-label " style="background-color:<?= $mainKnobColor ?>; margin: 0 auto !important;float:none;">Paid  (<?= $totalPaidAmount ?>) </div>
	                                            <br/>
	                                        </div>
                                    </div>
                                    
                                </div> 
                            </div> 


                        </section> 
                        <section class="col-lg-5 connectedSortable">
 

                            <!-- Calendar -->
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <h3 class="box-title">Calendar</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        <!-- <div class="btn-group">
                                            <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Add new event</a></li>
                                                <li><a href="#">Clear events</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">View calendar</a></li>
                                            </ul>
                                        </div> -->
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->
                    
              

 
