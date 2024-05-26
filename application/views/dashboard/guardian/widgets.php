<?php ?>
             
<!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?= $studentStrength ?></h3>
                                    <p>Total Students</p>
                                </div>
                                <div class="icon">
                                   <i class="fa fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   <br/> 
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $totalDiscountAmount ?></h3>
                                    <p>Total Discounts</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                     <br/> 
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?= $totalPaidAmount ?></h3>
                                    <p>Total Paid</p>
                                </div>
                                <div class="icon">
                                   <i class="fa fa-level-up"></i>
                                </div>
                                <a href="" class="small-box-footer">
                                   <br/>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3><?= $totalDueAmount ?></h3>
                                    <p>Total Dues</p>
                                </div>
                                <div class="icon">
                                   	<i class="fa fa-level-down"></i>
                                </div>
                                <a href="<?= site_url("guardians/dues") ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->            
            
            
            
            
