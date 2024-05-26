<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <?php $this->load->view('asaanschool/common/common_include_head'); ?>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    
</head><!--/head-->

<body data-spy="scroll" data-target="#navbar" data-offset="0">

     <?php $this->load->view('asaanschool/common/top_menu'); ?>

<br/>
	<section id="free-pricing">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2><?= $message_title ?></h2>
                    <p class="lead"><?= $message_body ?></p>
                </div>
                
                
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->
    <section id="pricing">
        <div class="container">
            <div class="box">
                
                <div id="pricing-table" class="row">
                    <div class="col-sm-4">
                        <ul class="plan">
                            <li class="plan-name"><?= $bank_details["bank"] ?></li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Account No.: </div>
                            		<div class="col-lg-7 pull-left"><?= $bank_details["account_no"] ?></div>
                            	</div>
                           </li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Account Title: </div>
                            		<div class="col-lg-7 pull-left"><?= $bank_details["account_title"] ?></div>
                            	</div>
                           </li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Branch Address: </div>
                            		<div class="col-lg-7 pull-left"><?= $bank_details["bank_branch"] ?></div>
                            	</div>
                           </li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Branch Code: </div>
                            		<div class="col-lg-7 pull-left"><?= $bank_details["bank_branch_code"] ?></div>
                            	</div>
                           </li>
                        </ul>
                    </div><!--/.col-sm-4-->
                    <div class="col-sm-4">
                        <ul class="plan ">
                            <li class="plan-name"><?= $easy_paisa["title"] ?></li>
                            <li class=""><?= $easy_paisa["message"] ?></li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Citizen No.: </div>
                            		<div class="col-lg-7 pull-left"><?= $easy_paisa["cnic"] ?></div>
                            	</div>
                           	</li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Cell: </div>
                            		<div class="col-lg-7 pull-left"><?= $easy_paisa["cell"] ?></div>
                            	</div>
                           </li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Name: </div>
                            		<div class="col-lg-7 pull-left"><?= $easy_paisa["name"] ?></div>
                            	</div>
	                       	</li>
                            
                        </ul>
                    </div><!--/.col-sm-4-->
                    <div class="col-sm-4">
                        <ul class="plan ">
                            <li class="plan-name"><?= $mobicash["title"] ?></li>
                            <li class=""><?= $mobicash["message"] ?></li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Citizen No.: </div>
                            		<div class="col-lg-7 pull-left"><?= $mobicash["cnic"] ?></div>
                            	</div>
                           	</li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Cell: </div>
                            		<div class="col-lg-7 pull-left"><?= $mobicash["cell"] ?></div>
                            	</div>
                           </li>
                            <li>
                            	<div class="row">
                            		<div class="col-lg-5 pull-left">Name: </div>
                            		<div class="col-lg-7 pull-left"><?= $mobicash["name"] ?></div>
                            	</div>
	                       	</li>
                            
                        </ul>
                    </div><!--/.col-sm-4-->
                    
                </div> 
            </div> 
        </div>
    </section><!--/#pricing-->

    

    
    
         <?php $this->load->view('asaanschool/contactus'); ?>
     <?php $this->load->view('asaanschool/common/footer'); ?>
    
    <?php $this->load->view('asaanschool/common/common_include_body'); ?>
</body>
</html>