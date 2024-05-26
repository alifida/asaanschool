<?php //pre($classesChartData)?>


<div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">


                            <div class="box box-solid">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Payments Dues</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                   <?php if(isset($classesChartData) && !empty($classesChartData)){ ?>
                                    <div class="row">
                                    	<?php $totalDueAmount=0; ?>
                                    	<?php $totalPaidAmount=0; ?>
    	                                <?php foreach ($classesChartData as $classKey => $class){ ?>
	                                      	<?php $totalDueAmount = $totalDueAmount + $class["dueAmount"]; ?>
	                                      	<?php $totalPaidAmount = $totalPaidAmount + $class["paidAmount"]; ?>
	                                    <?php } ?>
	                                    <?php $mainKnobColor =getRandomColorCode(); ?>
	                                    	<div class="col-md-12 col-sm-12 col-xs-12 text-center">
	                                            <input type="text" class="knob" value="<?= $totalPaidAmount ?>" data-min="0" data-max="<?= $totalDueAmount +  $totalPaidAmount ?>"
	                                             data-width="180" data-height="180" data-fgColor="<?= $mainKnobColor ?>"  data-readonly="true"/>
	                                            <div class="col-md-6 knob-label " style="background-color:<?= $mainKnobColor ?>; margin: 0 auto !important;float:none;">Total (<?= $totalDueAmount +  $totalPaidAmount ?>) </div>
	                                            <br/>
	                                        </div>
                                    </div><!-- /.row -->
                                    <div class="row">
                                    
    	                                <?php foreach ($classesChartData as $classKey => $class){ ?>
    	                                 
	                                    	<div class="col-md-3 col-sm-6 col-xs-6 text-center">
	                                    		
	                                            <input type="text" class="knob" value="<?= $class["paidAmount"] ?>" data-min="0" data-max="<?= $class["dueAmount"] +  $class["paidAmount"] ?>"
	                                             data-width="90" data-height="90" data-fgColor="<?= $class["chartColor"] ?>"  data-readonly="true"/>
	                                            <div class="knob-label" style="background-color:<?= $class["chartColor"] ?>"><?= $class["name"] ?> (<?= $class["dueAmount"] +  $class["paidAmount"] ?>) </div>
	                                        </div><!-- ./col -->
	                                    <?php } ?>
	                                    	
                                    </div><!-- /.row -->
                                    <?php } ?>

                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">

                           
                           <?php $this->load->view('campuses/dueInvoices'); ?>
                           
                           
                           
                            <!-- solid sales graph -->
                            <div class="box box-solid bg-teal-gradient">
                                <div class="box-header">
                                    <i class="fa fa-th"></i>
                                    <h3 class="box-title">Profit</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body border-radius-none">
                                    <div class="chart" id="profit-chart" style="height: 250px;"></div>
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->

                            <!-- Calendar -->
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <h3 class="box-title">Calendar</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Add new event</a></li>
                                                <li><a href="#">Clear events</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">View calendar</a></li>
                                            </ul>
                                        </div>
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
                    
              

 
