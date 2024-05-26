<?php ?>

                <section class="content-header">
                    <h1>Student Details</h1>
                </section>

                <!-- Main content -->
                <section class="content">
           <?php //$this->load->view('common/widget_notifications'); ?>
            
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
            		<?php $this->load->view('students/list'); ?>
            
            	</div>
            </div>
            
            
            
            <div class="row">
                <div class="col-lg-8">
                    <?php $this->load->view('guardians/list'); ?>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                     <?php $this->load->view('classes/list'); ?>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            
            
             <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
            		<?php $this->load->view('students/old_student_list'); ?>
            
            	</div>
            </div>
        </section>
        