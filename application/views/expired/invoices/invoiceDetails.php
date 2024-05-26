<?php ?>
<section class="content no-print" style="position: relative;
width: 90%;
margin: 10px auto;
background: #fff;
border: 1px solid #f4f4f4;">
<div class="row">
	<div class="col-lg-12">
		<div class="pull-right " >
	         <div class="btn-group ">
	              <button type="button" onclick="load_remote_model('<?= site_url('expired/invoiceClearanceRequestForm/'.encodeID($invoice["id"]).'') ?>','Invoice Clearance');" 
	              	class="btn btn-outline btn-success btn-xs">Invoice Clearance</button>
            </div>
	    </div>
	    
	    <?php if(isset($_SESSION["campuses"]) && !empty($_SESSION["campuses"]) && sizeof($_SESSION["campuses"])>1 ){?>
			<div class="pull-left">
				<div class="margin">
					<div class="btn-group col-centered">
						<button type="button" class="btn   btn-warning dropdown-toggle" data-toggle="dropdown">
							<?= $_SESSION["expiredCampus"]["campus_name"] ?> &nbsp;&nbsp;<span class="caret"></span> 
						</button>
                        <ul class="dropdown-menu" role="menu">
							<?php foreach($_SESSION["campuses"] as $campus){?>
	                        	<li><a href="<?= site_url("user/changeCurrentCampus")?>/<?= encodeID($campus["campus"]["id"])?>"><?= $campus["campus"]["campus_name"]?></a></li>
							<?php } ?>
							</ul>
	               		</div>
               		</div>
				</div>
		<?php } ?>
	    
	    
	    
	    
	</div>
</div>
</section>
<section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> <?= get_app_message("organization.name") ?>.
                                <small class="pull-right">Date: <?= $invoice["invoice_date"] ?></small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong><?= get_app_message("organization.name") ?>.</strong><br>
                                <?= get_app_message("organization.address") ?><br>
                                Phone: <?= get_app_message("organization.phone") ?><br>
                                Email: <?= get_app_message("organization.email") ?><br>
                                
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                            <?php if(isset($_SESSION["expiredCampus"]["contactDetail"])&& !empty($_SESSION["expiredCampus"]["contactDetail"])){
                            	$contactDetail = $_SESSION["expiredCampus"]["contactDetail"];
                            }elseif(isset($_SESSION["expiredCampus"]["school"]["contactDetail"])&& !empty($_SESSION["expiredCampus"]["school"]["contactDetail"])){
                            	$contactDetail = $_SESSION["expiredCampus"]["school"]["contactDetail"];
                            	
                            }
                            
                            ?>
                                <strong><?= $_SESSION["expiredCampus"]['campus_name'] ?></strong><br>
                                <?= $contactDetail['address'] ?><br/>
                                <?php if(isset($contactDetail['city'])&& !empty($contactDetail['city'])){ ?>
                                	<?= $contactDetail['city'] ?>
                                <?php }?>
                                <?php if(isset($contactDetail['state'])&& !empty($contactDetail['state'])){ ?>
                                	<?= $contactDetail['state'] ?>
                                <?php }?>
                                <?php if(isset($contactDetail['primary_phone'])&& !empty($contactDetail['primary_phone'])){ ?>
                                	<br/>Phone: <?= $contactDetail['primary_phone']?>
                                <?php }?>
                                <?php if(isset($contactDetail['email'])&& !empty($contactDetail['primary_email'])){ ?>
                                	<br/>Email: <?= $contactDetail['primary_email'] ?>
                                <?php }?>
                                
                            </address>
                        </div><!-- /.col -->
                        
                        <?php 
                        
                        
                        ?>
                        
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice: <?= $invoice["invoice_no"] ?></b><br/>
                            <br/>
                            <b>Package:</b> <?= $invoice["campusPackage"]["package"]["name"] ?><br/>
                            <b>Due Date:</b> <?= $invoice["due_date"]?><br/>
                            <b>Account:</b> 968-34567
                        </div><!-- /.col -->
                    </div><!-- /.row -->

					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<p class="lead">Package Detail</p>
								<!-- /.box-header -->
									<div class="table-responsive">
										<table class="table" id="">
											<tr>
												<td width="35%"><span class="pull-right">Package: </span></td>
												<th><span><?= $invoice["campusPackage"]["package"]["name"] ?></span></th>
											</tr>
											<tr>
												<td width="35%"><span class="pull-right">Activated date: </span></td>
												<th><span><?= convertMySQLDateTimeToDate($invoice["campusPackage"]["start_date"]) ?></span></th>
											</tr>
										
											<tr>
												<td width="35%"><span class="pull-right">Package price: </span></td>
												<th><span><?= $invoice["campusPackage"]["package"]["price"]["price"] ?> <?= $invoice["currency"] ?></span></th>
											</tr>
										
										</table>
									</div>
										
						
						</div>
						<div class="col-lg-06 col-md-06 col-sm-6 col-xs-6">
							<p class="lead ">Detail</p>
							 <?php $subtotal = $invoice["payable_amount"] ?>
                            <div class="table-responsive">
                                <table class="table">
                                    
                                    <tr>
                                        <th style="width:30%"><span class="pull-right">Subtotal:</span></th>
                                        <td style="width:10%"></td>
                                        <td><?= $subtotal ?></td>
                                    </tr>
                                    <tr>
                                        <th><span class="pull-right">Balance</span></th>
                                        <td></td>
                                        <td><?= $invoice["balance"] ?></td>
                                    </tr>
                                    <tr>
                                        <th><span class="pull-right">Arrears:</span></th>
                                        <td></td>
                                        <td><?= $invoice["arrears"] ?></td>
                                    </tr>
                                    <tr>
                                        <th><span class="pull-right">Discount:</span></th>
                                        <td></td>
                                        <td><?= $invoice["discount"] ?></td>
                                    </tr>
                                    <tr>
                                        <th><span class="pull-right">Total:</span></th>
                                        <td></td>
                                        <td><?= $invoice["total_payable_amount"]   ?> <?= $invoice["currency"] ?></td>
                                    </tr>
                                </table>
                            </div>
						
						</div>
					</div>
                  
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          
                        </div>
                    </div>
                </section><!-- /.content -->
         