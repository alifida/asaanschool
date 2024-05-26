<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

if (!function_exists('generateLeftMenu')) {

	function generateLeftMenu($user, $campus = null) {
		$leftMenu = "";
			
		$leftMenu ='<ul class="sidebar-menu">';

		if($user["user_type"]["internal_key"]=="application_admin"){
				
			$leftMenu .= '	<li>
            					<a class="" href="'.site_url("user/login").'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
							</li>';
						
			$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "db" ) . '"><i class="fa fa-dashboard"></i> <span>Database</span></a>
							</li>';
			$leftMenu .= '	<li>
            					<a class="" href="'.site_url("appadmin/schools").'"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <span>Schools</span></a>
							</li>';
			if(isset($_SESSION["currentCampus"]) && !empty($_SESSION["currentCampus"])){
				$leftMenu .= generateAppAdminMenu();
			}
		} 
		
		
		
		
		
		
		
		
		
		

	if($campus!=null){
		$CI = & get_instance();
		$CI->load->database();
		$sqlString = sprintf(
					        	" SELECT ".
								"	ap.controllers ".
								" FROM ".
								"	users u, ".
								"	campuses c, ".
								"	user_campus uc, ".
								"	campus_modules cm, ".
								"	user_campus_modules ucm, ".
								"	app_modules ap ".
								" WHERE ".
								"	u.id = ".$user["id"].
								" AND c.id = ".$campus["id"].
								" AND c.id = cm.campus_id ".
								" AND c.id = uc.campus_id ".
								" AND u.id = uc.user_id ".
								" AND ucm.campus_module_id = cm.id ".
								" AND ucm.user_campus_id = uc.id ".
								" AND ap.id = cm.module_id".
								" ORDER BY ap.sort_order"
								
								);
								$query = $CI->db->query($sqlString);
								$rs = $query->result_array();
								 
								$controllers = array();
								if(!empty($rs)){
									foreach ($rs as $row){
										$moduleControllers = explode(",", $row["controllers"]);
										$controllers = array_unique( array_merge( $controllers , $moduleControllers ) );
									}
								}
								
								$_SESSION["authorizedControllers"]= $controllers;

								 
								
								
								
								
								
								
								
								if($user["user_type"]["internal_key"]=="guardian"){
									
									$_SESSION["authorizedControllers"]= array("guardians");
									
									$leftMenu .= '	<li>
            					<a class="" href="'.site_url("guardians").'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
							</li>';
									
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "guardians/dependents" ) . '"><i class="fa fa-dashboard"></i> <span>Dependents</span></a>
							</li>';
									
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "guardians/dues" ) . '"><i class="fa fa-dashboard"></i> <span>Dues</span></a>
							</li>';
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "guardians/attendance" ) . '"><i class="fa fa-dashboard"></i> <span>Attendance</span></a>
							</li>';
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "notification" ) . '"><i class="fa fa-dashboard"></i> <span>Noticeboard</span></a>
							</li>';
									
									
								} else if($user["user_type"]["internal_key"]=="student"){
									$_SESSION["authorizedControllers"]= array("students");
									$leftMenu .= '	<li>
            					<a class="" href="'.site_url("students").'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
							</li>';
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "students/dues" ) . '"><i class="fa fa-dashboard"></i> <span>Dues</span></a>
							</li>';
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "students/details" ) . '"><i class="fa fa-dashboard"></i> <span>Student Details</span></a>
							</li>';
									
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "students/attendance" ) . '"><i class="fa fa-dashboard"></i> <span>Attendance</span></a>
							</li>';
									$leftMenu .= '	<li>
            					<a class="" href="' . site_url ( "notification" ) . '"><i class="fa fa-dashboard"></i> <span>Noticeboard</span></a>
							</li>';
									
									
								}
								
								
								
								

								if(!empty($controllers)){
									foreach ($controllers as $controller){
										if($controller == "admin"){
											$leftMenu .= '	<li>
								            					<a class="" href="'.site_url("admin/welcome").'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
															</li>';
												
										}

										if($controller == "campus"){
											$leftMenu .= '	<li class="treeview">
										                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-home"></i><span>School</span><i class="fa fa-angle-left pull-right"></i><small class="badge pull-right bg-green">new</small></a>
										                         <ul class="treeview-menu">
										                            <li>
										                                <a href="'. site_url("campus").'"><i class="fa fa-angle-double-right"></i>Campus Details</a>
										                            </li>
										                            <li>
										                                <a href="'. site_url("campus/invoices").'"><i class="fa fa-angle-double-right"></i>Invoices</a>
										                            </li>
																	<li>
										                                <a href="'. site_url("campus/edit/".$_SESSION['currentCampus']['id']) .'"><i class="fa fa-angle-double-right"></i>Update Campus</a>
										                            </li>
																	<li>
										                                <a href="'. site_url("admin/users/") .'"><i class="fa fa-angle-double-right"></i>Users<small class="badge pull-right bg-green">new</small></a>
										                            </li>
										                        </ul>
										                    </li>';
										}


										if($controller == "student"){
											$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"> <i class="fa fa-users"></i><span>Students</span><i class="fa fa-angle-left pull-right"></i></a>
				                         <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("student").'"><i class="fa fa-angle-double-right"></i>All Students</a>
				                            </li>
				                            <li>
				                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url("student/edit") .'\',\'New Student\');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>New Student</a>
				                            </li>
											<li>
				                                <a href="'. site_url("student/defaulters").'"><i class="fa fa-angle-double-right"></i>Defaulters</a>
				                            </li>
											<li>
				                                <a href="'. site_url("student/defaulters").'?action=bulk"><i class="fa fa-angle-double-right"></i>Bulk Dues Clearance</a>
				                            </li>
											<li>
				                                <a href="'. site_url("student/dues").'"><i class="fa fa-angle-double-right"></i>Student Dues</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("student/promoteStudents").'" ><i class="fa fa-angle-double-right"></i>Promote Students</a>
				                            </li>
				                        </ul>
				                    </li>';
										}

										if($controller == "attendance"){
											$leftMenu .= '	<li class="treeview">
													<a href="javascript:void(0);"><i class="fa fa-fw fa-book"></i><span>Attendance</span><i class="fa fa-angle-left pull-right"></i><small class="badge pull-right bg-green">new</small></a>
				                         		<ul class="treeview-menu">
				                            		<li>			
														<a href="'. site_url("attendance").'"><i class="fa fa-angle-double-right"></i>Students Attendance</a>
				                    				</li>
													<li>			
														<a href="'. site_url("eattendance").'"><i class="fa fa-angle-double-right"></i>Employee Attendance</a>
				                    				</li>			
												</ul>
											</li>';
										}

										if($controller == "employee"){
											$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span>Employees</span><i class="fa fa-angle-left pull-right"></i></a>
				                         <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("employee").'"><i class="fa fa-angle-double-right"></i>All Employees</a>
				                            </li>
				                           	<li>
				                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url('employee/editEmployee') .'\',\'Create Employee\');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>New Employee</a>
				                            </li>
				                           	<li>
				                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url('employee/issueSalaryForm').'\' ,\'Issue Salary\');"><i class="fa fa-angle-double-right"></i>Issue Salaries</a>
				                            </li>
				                        </ul>
				                    </li>';
										}


										if($controller == "classes"){
											
										
											$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-subtitles"></i><span>Classes & Fee</span><i class="fa fa-angle-left pull-right"></i></a>
				                         <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("classes").'"><i class="fa fa-angle-double-right"></i>Classes and Fee setup</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("subject").'"><i class="fa fa-angle-double-right"></i>Class Subjects</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("timetable").'"><i class="fa fa-angle-double-right"></i>Timetable</a>
				                            </li>
				                           	 
				                        </ul>
				                    </li>';
										
										
										}

										if($controller == "inventory"){
											$leftMenu .= '	<li>
				                         <a href="'. site_url("inventory").'"><span class="glyphicon glyphicon-book"></span>&nbsp; Inventory</a>
				                    </li> ';
										}

										if($controller == "expense"){
											$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-usd"></span>&nbsp; Expenses<i class="fa fa-angle-left pull-right"></i></a>
				                         <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("expense").'" ><i class="fa fa-angle-double-right"></i>All Expenses</a>
				                            </li>
				                            <li>
				                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url('employee/issueSalaryForm').'\' ,\'Issue Salary\');"><i class="fa fa-angle-double-right"></i>Issue Salaries</a>
				                            </li>
				                        </ul>
				                     </li> ';
										}

										if($controller == "profit"){
											$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"><span class="glyphicon glyphicon glyphicon-usd"></span>&nbsp; Profit/Transactions<i class="fa fa-angle-left pull-right"></i></a>
				                         <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("profit").'"><i class="fa fa-angle-double-right"></i>Transactions</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("profit/expectedProfit").'" ><i class="fa fa-angle-double-right"></i>Expected Profit</a>
				                            </li>
				                        </ul>
				                  	</li> ';
										}

										if($controller == "report"){
											$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-wrench"></span>&nbsp; Reports<i class="fa fa-angle-left pull-right"></i></a>
				                        <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("report/setting").'" ><i class="fa fa-angle-double-right"></i>Report Settings</a>
				                            </li>
				                            <li>
				                                <a href="javascript:void(0);"  onclick="load_remote_model(\''. site_url("report/editSettings") .'\',\'Report Settings\');enlarge_remote_model();"     ><i class="fa fa-angle-double-right"></i>Update Report Settings</a>
				                            </li>
				                        </ul>
				                   </li> ';
										}
										if($controller == "certificate"){
											$leftMenu .= '	<li>
						                         <a href="'. site_url("certificate").'"><span class="glyphicon glyphicon-book"></span>&nbsp; Certificates </i><small class="badge pull-right bg-green">new</small></a>
						                    </li> ';
										}

                                    	if($controller == "notification"){	
                                    						$leftMenu .= '<li class="treeview">
                                                             <a href="javascript:void(0);"><i class="fa fa-dashboard"></i>&nbsp; Notifications<i class="fa fa-angle-left pull-right"></i></a>
                                                            <ul class="treeview-menu">
                                                                <li>
                                                                    <a href="'. site_url("notification/all") .'" ><i class="fa fa-angle-double-right"></i>Notifications</a>
                                                                </li>
                                                                
                                                            </ul>
                                                       </li>';
						                    }
										if($controller == "website"){
											$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"><i class="fa fa-fw fa-globe"></i>&nbsp; Website<i class="fa fa-angle-left pull-right"></i><small class="badge pull-right bg-green">new</small></a>
				                        <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("website") .'" ><i class="fa fa-angle-double-right"></i>Configurations</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("website/menu") .'" ><i class="fa fa-angle-double-right"></i>Website Menu</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("website/editPage") .'" ><i class="fa fa-angle-double-right"></i>New Page</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("website/editPost") .'" ><i class="fa fa-angle-double-right"></i>New Post</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("website/editSlider") .'" ><i class="fa fa-angle-double-right"></i>New Slider</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("website/gallery").'" ><i class="fa fa-angle-double-right"></i>Gallery</a>
				                            </li>
				                            <li>
				                                <a href="javascript:void(0);"  onclick="load_remote_model(\''. site_url("website/quickGallery") .'\',\'Report Settings\');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>Quick Gallery</a>
				                            </li>
				                        </ul>
				                    </li>';
										}
										 
									}
								}

                       
	                   
	                     
								
    								// adding default features like email and profile settings
    								$leftMenu .= '	<li class="treeview">
    	                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-wrench"></span>&nbsp; Profile<i class="fa fa-angle-left pull-right"></i></a>
    	                        <ul class="treeview-menu">
	                            <li>
	                                <a href="'. site_url("profile").'" ><i class="fa fa-angle-double-right"></i>View Profile</a>
	                            </li>
	                            <li>
	                                <a href="'. site_url("profile/edit").'" ><i class="fa fa-angle-double-right"></i>Update Profile</a>
	                            </li>
	                            <li>
	                                <a href="javascript:void(0);"  onclick="load_remote_model(\''. site_url("user/changePasswordForm") .'\',\'Change Password\');"     ><i class="fa fa-angle-double-right"></i>Change Password</a>
	                            </li>
	                                    
	                        </ul>
	                   </li>    ';

								$leftMenu .= '<li class="treeview">
                         <a href="javascript:void(0);"><i class="fa fa-envelope"></i>&nbsp; Mailbox<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="'. site_url("email/compose") .'" ><i class="fa fa-angle-double-right"></i>Compose</a>
                            </li>
                            <li>
                                <a href="'. site_url("email/inbox") .'" ><i class="fa fa-angle-double-right"></i>Inbox</a>
                            </li>
                            <li>
                                <a href="'. site_url("email/sent") .'" ><i class="fa fa-angle-double-right"></i>Sent Mail</a>
                            </li>
                            <li>
                                <a href="'. site_url("email/draft") .'" ><i class="fa fa-angle-double-right"></i>Draft</a>
                            </li>
                            <li>
                                <a href="'. site_url("email/trash") .'" ><i class="fa fa-angle-double-right"></i>Trash</a>
                            </li>
                        </ul>
                   </li>';

	}
	
	
	


								$leftMenu .= '</ul >';


								$_SESSION["left_menu"] = $leftMenu;
	}

}
if (!function_exists('generateAppAdminMenu')) {

	function generateAppAdminMenu() {
		$leftMenu = "";
		$leftMenu .= '	<li>
				            <a class="" href="'.site_url("admin/welcome").'"><i class="fa fa-dashboard"></i> <span>Campus Dashboard</span></a>
						</li>';
	     
                	$leftMenu .= '	<li>
            					<a class="" href="'.site_url("notification/all").'"><i class="fa fa-dashboard"></i> <span>Notifications</span></a>
							</li>';	
				$leftMenu .= '	<li class="treeview">
						                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-home"></i><span>School</span><i class="fa fa-angle-left pull-right"></i><small class="badge pull-right bg-green">new</small></a>
						                         <ul class="treeview-menu">
						                            <li>
						                                <a href="'. site_url("campus").'"><i class="fa fa-angle-double-right"></i>Campus Details</a>
						                            </li>
						                            <li>
						                                <a href="'. site_url("campus/invoices").'"><i class="fa fa-angle-double-right"></i>Invoices</a>
						                            </li>
						                           	<li>
						                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url("appadmin/choosePackage") .'\',\'Change Package\');"><i class="fa fa-angle-double-right"></i>Change Package</a>
						                            </li>
													<li>
						                                <a href="'. site_url("campus/edit/".$_SESSION['currentCampus']['id']) .'"><i class="fa fa-angle-double-right"></i>Update Campus</a>
						                            </li>
													<li>
						                                <a href="'. site_url("admin/users/") .'"><i class="fa fa-angle-double-right"></i>Users<small class="badge pull-right bg-green">new</small></a>
						                            </li>
						                        </ul>
						                    </li>';


				$leftMenu .= '	<li class="treeview">
                         <a href="javascript:void(0);"> <i class="fa fa-users"></i><span>Students</span><i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="'. site_url("student").'"><i class="fa fa-angle-double-right"></i>All Students</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url("student/edit") .'\',\'New Student\');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>New Student</a>
                            </li>
							<li>
                                <a href="'. site_url("student/defaulters").'"><i class="fa fa-angle-double-right"></i>Defaulters</a>
                            </li>
 
							<li>
                                <a href="'. site_url("student/defaulters").'?action=bulk"><i class="fa fa-angle-double-right"></i>Bulk Dues Clearance<small class="badge pull-right bg-green">new</small></a>
                            </li>

							<li>
                                <a href="'. site_url("student/dues").'"><i class="fa fa-angle-double-right"></i>Student Dues</a>
                            </li>
                            <li>
                                <a href="'. site_url("student/promoteStudents").'" ><i class="fa fa-angle-double-right"></i>Promote Students</a>
                            </li>
                        </ul>
                    </li>';

				$leftMenu .= '	<li class="treeview">
													<a href="javascript:void(0);"><i class="fa fa-fw fa-book"></i><span>Attendance</span><i class="fa fa-angle-left pull-right"></i><small class="badge pull-right bg-green">new</small></a>
				                         		<ul class="treeview-menu">
				                            		<li>			
														<a href="'. site_url("attendance").'"><i class="fa fa-angle-double-right"></i>Students Attendance</a>
				                    				</li>
													<li>			
														<a href="'. site_url("eattendance").'"><i class="fa fa-angle-double-right"></i>Employee Attendance</a>
				                    				</li>			
												</ul>
											</li>';

				$leftMenu .= '	<li class="treeview">
                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i><span>Employees</span><i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="'. site_url("employee").'"><i class="fa fa-angle-double-right"></i>All Employees</a>
                            </li>
                           	<li>
                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url('employee/editEmployee') .'\',\'Create Employee\');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>New Employee</a>
                            </li>
                           	<li>
                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url('employee/issueSalaryForm').'\' ,\'Issue Salary\');"><i class="fa fa-angle-double-right"></i>Issue Salaries</a>
                            </li>
                        </ul>
                    </li>';


				$leftMenu .= '	<li class="treeview">
				                         <a href="javascript:void(0);"><i class="glyphicon glyphicon-subtitles"></i><span>Classes & Fee</span><i class="fa fa-angle-left pull-right"></i></a>
				                         <ul class="treeview-menu">
				                            <li>
				                                <a href="'. site_url("classes").'"><i class="fa fa-angle-double-right"></i>Classes and Fee setup</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("subject").'"><i class="fa fa-angle-double-right"></i>Class Subjects</a>
				                            </li>
				                            <li>
				                                <a href="'. site_url("timetable").'"><i class="fa fa-angle-double-right"></i>Timetable</a>
				                            </li>
				                                		
				                        </ul>
				                    </li>';

				$leftMenu .= '	<li>
                         <a href="'. site_url("inventory").'"><span class="glyphicon glyphicon-book"></span>&nbsp; Inventory</a>
                    </li> ';

				$leftMenu .= '	<li class="treeview">
                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-usd"></span>&nbsp; Expenses<i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="'. site_url("expense").'" ><i class="fa fa-angle-double-right"></i>All Expenses</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="load_remote_model(\''. site_url('employee/issueSalaryForm').'\' ,\'Issue Salary\');"><i class="fa fa-angle-double-right"></i>Issue Salaries</a>
                            </li>
                        </ul>
                     </li> ';

			$leftMenu .= '	<li class="treeview">
                         <a href="javascript:void(0);"><span class="glyphicon glyphicon glyphicon-usd"></span>&nbsp; Profit/Transactions<i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                            <li>
                                <a href="'. site_url("profit").'"><i class="fa fa-angle-double-right"></i>Transactions</a>
                            </li>
                            <li>
                                <a href="'. site_url("profit/expectedProfit").'" ><i class="fa fa-angle-double-right"></i>Expected Profit</a>
                            </li>
                        </ul>
                  	</li> ';

			$leftMenu .= '	<li class="treeview">
                         <a href="javascript:void(0);"><span class="glyphicon glyphicon-wrench"></span>&nbsp; Reports<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="'. site_url("report/setting").'" ><i class="fa fa-angle-double-right"></i>Report Settings</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"  onclick="load_remote_model(\''. site_url("report/editSettings") .'\',\'Report Settings\');enlarge_remote_model();"     ><i class="fa fa-angle-double-right"></i>Update Report Settings</a>
                            </li>
                        </ul>
                   </li> ';
			
				$leftMenu .= '	<li>
									<a href="'. site_url("certificate").'"><span class="glyphicon glyphicon-book"></span>&nbsp; Certificates </i><small class="badge pull-right bg-green">new</small></a>
						        </li> ';

			$leftMenu .= '	<li class="treeview">
                         <a href="javascript:void(0);"><i class="fa fa-fw fa-globe"></i>&nbsp; Website<i class="fa fa-angle-left pull-right"></i><small class="badge pull-right bg-green">new</small></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="'. site_url("website") .'" ><i class="fa fa-angle-double-right"></i>Configurations</a>
                            </li>
                            <li>
                                <a href="'. site_url("website/menu") .'" ><i class="fa fa-angle-double-right"></i>Website Menu</a>
                            </li>
                            <li>
                                <a href="'. site_url("website/editPage") .'" ><i class="fa fa-angle-double-right"></i>New Page</a>
                            </li>
                            <li>
                                <a href="'. site_url("website/editPost") .'" ><i class="fa fa-angle-double-right"></i>New Post</a>
                            </li>
                            <li>
                                <a href="'. site_url("website/editSlider") .'" ><i class="fa fa-angle-double-right"></i>New Slider</a>
                            </li>
                            <li>
                                <a href="'. site_url("website/gallery").'" ><i class="fa fa-angle-double-right"></i>Gallery</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"  onclick="load_remote_model(\''. site_url("website/quickGallery") .'\',\'Report Settings\');enlarge_remote_model();"><i class="fa fa-angle-double-right"></i>Quick Gallery</a>
                            </li>
                        </ul>
                    </li>';

			//pre_d($leftMenu);
			
		return $leftMenu;
								
	}
}
if (!function_exists('isAuthorizedController')) {

	function isAuthorizedController($controller) {
		if($_SESSION['sessionUser']['user_type']['internal_key'] == "application_admin"){
			return true;
		}
		return in_array(strtolower($controller),  $_SESSION["authorizedControllers"]);
	}}