<?php ?>
<ul class="sidebar-menu">
	                    <li>
	                        <a class="" href="<?= site_url("user/login")?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
	                    </li>
	                    
                   	<li class="treeview">
                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-home"></i><span>School</span><i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("campus")?>"><i class="fa fa-angle-double-right"></i>Campus Details</a>
                            </li>
							<li>
                                <a href="<?= site_url("campus/edit/".$_SESSION['currentCampus']['id']) ?>"><i class="fa fa-angle-double-right"></i>Update Campus</a>
                            </li>
							<li>
                                <a href="<?= site_url("admin/users/") ?>"><i class="fa fa-angle-double-right"></i>Users</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                         <a href="javascript:void(0);"> <i class="fa fa-users"></i><span>Students</span><i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("student")?>"><i class="fa fa-angle-double-right"></i>All Students</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('student/edit') ?>','New Student');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>New Student</a>
                            </li>
							<li>
                                <a href="<?= site_url("student/dues")?>"><i class="fa fa-angle-double-right"></i>Defaulters</a>
                            </li>
                            <li>
                                <a href="<?= site_url("student/promoteStudents")?>" ><i class="fa fa-angle-double-right"></i>Promote Students</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                         <a href="<?= site_url("attendance")?>"><i class="fa fa-fw fa-book"></i>&nbsp; Attendance</a>
                    </li> 
                    
                    <li class="treeview">
                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span>Employees</span><i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("employee")?>"><i class="fa fa-angle-double-right"></i>All Employees</a>
                            </li>
                           	<li>
                                <a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/editEmployee') ?>','Create Employee');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>New Employee</a>
                            </li>
                           	<li>
                                <a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/issueSalaryForm') ?>','Issue Salary');"><i class="fa fa-angle-double-right"></i>Issue Salaries</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                         <a href="<?= site_url("classes")?>"><span class="glyphicon glyphicon-subtitles "></span>&nbsp; Classes & Fee</a>
                    </li>
                    <li>
                         <a href="<?= site_url("inventory")?>"><span class="glyphicon glyphicon-book"></span>&nbsp; Inventory</a>
                    </li>   
                      
                    
                    
                     <li class="treeview">
                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-usd"></span>&nbsp; Expenses<i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("expense")?>" ><i class="fa fa-angle-double-right"></i>All Expenses</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/issueSalaryForm') ?>','Issue Salary');"><i class="fa fa-angle-double-right"></i>Issue Salaries</a>
                            </li>
                        </ul>
                     </li>   
                   
                     <li class="treeview">
                         <a href="javascript:void(0);"><span class="glyphicon glyphicon glyphicon-usd"></span>&nbsp; Profit/Transactions<i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("profit")?>"><i class="fa fa-angle-double-right"></i>Transactions</a>
                            </li>
                            <li>
                                <a href="<?= site_url("profit/expectedProfit")?>" ><i class="fa fa-angle-double-right"></i>Expected Profit</a>
                            </li>
                        </ul>
                      </li>   
                     <li class="treeview">
                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-wrench"></span>&nbsp; Reports<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("report/setting")?>" ><i class="fa fa-angle-double-right"></i>Report Settings</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"  onclick="load_remote_model('<?= site_url("report/editSettings") ?>','Report Settings');enlarge_remote_model();"     ><i class="fa fa-angle-double-right"></i>Update Report Settings</a>
                            </li>
                        </ul>
                   </li> 
                   <li class="treeview">
                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-wrench"></span>&nbsp; Profile<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("profile")?>" ><i class="fa fa-angle-double-right"></i>View Profile</a>
                            </li>
                            <li>
                                <a href="<?= site_url("profile/edit")?>" ><i class="fa fa-angle-double-right"></i>Update Profile</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"  onclick="load_remote_model('<?= site_url("user/changePasswordForm") ?>','Change Password');"     ><i class="fa fa-angle-double-right"></i>Change Password</a>
                            </li>
                            
                        </ul>
                   </li>     
                   
                   <li class="treeview">
                         <a href="javascript:void(0);"><i class="fa fa-envelope"></i>&nbsp; Mailbox<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("email/compose") ?>" ><i class="fa fa-angle-double-right"></i>Compose</a>
                            </li>
                            <li>
                                <a href="<?= site_url("email/inbox") ?>" ><i class="fa fa-angle-double-right"></i>Inbox</a>
                            </li>
                            <li>
                                <a href="<?= site_url("email/sent") ?>" ><i class="fa fa-angle-double-right"></i>Sent Mail</a>
                            </li>
                            <li>
                                <a href="<?= site_url("email/draft") ?>" ><i class="fa fa-angle-double-right"></i>Draft</a>
                            </li>
                            <li>
                                <a href="<?= site_url("email/trash") ?>" ><i class="fa fa-angle-double-right"></i>Trash</a>
                            </li>
                        </ul>
                   </li> 
                     <li class="treeview">
                         <a href="javascript:void(0);"><i class="fa fa-fw fa-globe"></i>&nbsp; Website<i class="fa fa-angle-left pull-right"></i><small class="badge pull-right bg-green">new</small></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?= site_url("website") ?>" ><i class="fa fa-angle-double-right"></i>Configurations</a>
                            </li>
                            <li>
                                <a href="<?= site_url("website/gallery")?>" ><i class="fa fa-angle-double-right"></i>Gallery</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"  onclick="load_remote_model('<?= site_url("website/quickGallery") ?>','Report Settings');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>Quick Gallery</a>
                            </li>
                        </ul>
                    </li>
                        
                    </ul>