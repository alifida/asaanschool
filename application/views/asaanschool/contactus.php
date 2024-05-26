<?php ?>

<section id="contact">
        <div class="container">
            <div class="box last">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Contact Form</h3>
                        <p>If you are expecting a response please provide a valid Email address.</p>
                        <div class="status alert alert-success" style="display: none" id="serverMessage"></div>
                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="<?= site_url("welcome/sendEmail") ?>" role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Name" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="email" id="email" placeholder="Email address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger ">&nbsp;&nbsp;&nbsp;&nbsp;Send&nbsp;&nbsp;&nbsp;&nbsp; </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--/.col-sm-6-->
                    <div class="col-sm-6">
                        <h3>Our Address</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Asaanschool, Inc.</strong><br>
                                    Islamabad<br>
                                    <br>
                                    <abbr title="Phone">P:</abbr> (300) 911-3800
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address>
                                    <strong>Asaanschool, Inc.</strong><br>
                                    Islamabad<br>
                                    <br>
                                    <abbr title="Phone">P:</abbr> (300) 911-3800
                                </address>
                            </div>
                        </div>
                        <h3>Connect with us</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="social">
                                    
                                    <li><a href="https://plus.google.com/114684502167518172521" rel="publisher" target="_blank"><i class="icon-google-plus icon-social"></i> Google Plus</a></li>
                                    <!-- 
                                    <li><a href="#"><i class="icon-linkedin icon-social"></i> Linkedin</a></li>
                                    <li><a href="#"><i class="icon-pinterest icon-social"></i> Pinterest</a></li>
                                    -->
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="https://www.facebook.com/pages/School-Management-System/815488331878130" target="_blank"><i class="icon-facebook icon-social"></i> Facebook</a></li>
                                    <!--
                                    <li><a href="#"><i class="icon-twitter icon-social"></i> Twitter</a></li>
                                    <li><a href="#"><i class="icon-youtube icon-social"></i> Youtube</a></li>
                                    -->
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="https://www.youtube.com/user/asaanschool1" target="_blank"><i class="icon-youtube icon-social"></i> Youtube</a></li>
                                    <!--
                                    <li><a href="#"><i class="icon-twitter icon-social"></i> Twitter</a></li>
                                    <li><a href="#"><i class="icon-youtube icon-social"></i> Youtube</a></li>
                                    -->
                                </ul>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><div class="g-page" data-width="273" data-href="//plus.google.com/u/0/114684502167518172521" data-layout="landscape" data-showtagline="false" data-showcoverphoto="false" data-rel="publisher"></div></li>
                                   
                                </ul>
                            </div>
                            
                        </div>
                    </div><!--/.col-sm-6-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#contact-->