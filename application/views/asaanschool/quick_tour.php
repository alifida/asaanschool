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
    

    <section id="modules">
        <div class="container">
            <div class="box">
                <div class="center gap">
                    <h2>Quick Tour</h2>
                    <p class="lead">
                    	Following screenshots are of few of the options available in the application. For better understanding you can signup and utilize the options. It is very simple and easy to use.
                    </p>
                </div><!--/.center-->
                <ul class="portfolio-filter">
                    <li><a class="btn btn-primary active" href="#" data-filter="*">All</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".student">Student</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".employee">Employees</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".class">Classes</a></li>
                    
                </ul><!--/#portfolio-filter-->
                <ul class="portfolio-items col-4">
                    <li class="portfolio-item ">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/dashboard-lg-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Dashboard School Admin" href="<?= base_url() ?>public/images/portfolio/dashboard-lg.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Dashboard - School Admin</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item student">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/student/student1-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Student Management" href="<?= base_url() ?>public/images/portfolio/student/student1.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Student Management</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item student">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/student/student2-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="New Student" href="<?= base_url() ?>public/images/portfolio/student/student2.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>New Student</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item student">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/student/student3-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Promote Students" href="<?= base_url() ?>public/images/portfolio/student/student3.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Promote Students</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    
                    <li class="portfolio-item student">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/student/student4-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Student Details" href="<?= base_url() ?>public/images/portfolio/student/student4.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Student Details</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    
                    
                    
                    
                    
                     <li class="portfolio-item employee">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/employee/employee1-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Employee Management" href="<?= base_url() ?>public/images/portfolio/employee/employee1.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Employee Management</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item employee">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/employee/employee2-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="New Employee" href="<?= base_url() ?>public/images/portfolio/employee/employee2.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>New Employee</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item employee">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/employee/employee3-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Emplooyee Details" href="<?= base_url() ?>public/images/portfolio/employee/employee3.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Emplooyee Details</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    
                    <li class="portfolio-item employee">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/employee/employee4-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Issue Salaries" href="<?= base_url() ?>public/images/portfolio/employee/employee4.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Issue Salaries</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    
                    
                    
                    
                    
                    <li class="portfolio-item class">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/classes/class1-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Class Management" href="<?= base_url() ?>public/images/portfolio/classes/class1.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Class Management</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item class">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="<?= base_url() ?>public/images/portfolio/classes/class2-thumb.png" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="New Class" href="<?= base_url() ?>public/images/portfolio/classes/class2.png"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>New Class</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    
                    
                    
                    
                    
                    
                </ul>   
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#portfolio-->
    

    
     

         <?php $this->load->view('asaanschool/contactus'); ?>
     <?php $this->load->view('asaanschool/common/footer'); ?>
    
    <?php $this->load->view('asaanschool/common/common_include_body'); ?>
    
</body>
</html>