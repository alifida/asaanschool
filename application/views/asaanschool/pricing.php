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

	<section id="free-pricing">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Get Your 30 days Free Trial Today</h2>
                    <p class="lead">Just signup with valid email address and start using the below mentioned features of students, emplyees, inventory, Fee, Classes and much more.</p>
                    <p class="lead">We provide a free website, inculding development, hosting and also free domain with <span class="btn btn-success btn-sm">24/7 support.</span></p>
                </div>
            </div>
            
        </div>
    </section>
    

    
<br/>

<?php if(!empty($packages)){?>

<section id="pricing">
        <div class="container">
            <div class="box">
                <div id="pricing-table" class="row">
                <?php foreach ($packages as $package){?>
                <?php if(isset($package["price"]["price"]) && $package["price"]["price"] > 0){?>
                    <div class="col-sm-4">
                        <ul class="plan">
                            <li class="plan-name"><?= $package["name"]?></li>
                            <li class="plan-price"><?= $package["price"]["price"]?> <?= $package["price"]["currency"]?></li>
                            <li>Admissions</li>
                            <li>Fee Tracking</li>
                            <li>Inventory Tracking</li>
                            <li>Employee Management</li>
                            <li>Expense Log</li>
                            <li>Profit Calculation</li>
                            <li>Money Log</li>
                            <li>Attendance</li>
                            <li>Reports</li>
                            <li>Certificates</li>
                            <li>Notifications</li>
                            <li>Free Website</li>
                            <li class="plan-action"><a href="<?= site_url("user/signup")?>" class="btn btn-primary btn-lg">Signup</a></li>
                        </ul>
                    </div><!--/.col-sm-4-->
                    <?php }?>
                    <?php }?>
                </div> 
            </div> 
        </div>
    </section><!--/#pricing-->

<?php } ?>







    <section id="free-pricing">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Free For Government Schools</h2>
                    <p class="lead">For Governement Schools and colleges, it is totally free with all the features.</p>
                    <p><a href="<?= site_url("user/signup")?>" class="btn btn-primary btn-lg">Signup</a></p>
                </div>
                <div class="gap"></div>
                
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->

    
    
         <?php $this->load->view('asaanschool/contactus'); ?>
     <?php $this->load->view('asaanschool/common/footer'); ?>
    
    <?php $this->load->view('asaanschool/common/common_include_body'); ?>
</body>
</html>