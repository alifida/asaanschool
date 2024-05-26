<?php // pre($emailUser); ?>
<?php if(!empty($emailUser)){?>
	
		<?php while(!empty($emailUser)){ ?>
            	
                	<div class="border-shadow" style="width: 100% !important">
                   		
                   			<div class="row">
                   				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    	                    		<h4 class="timeline-title"><?= isset($emailUser["email"]["subject"])? $emailUser["email"]["subject"] :""?></h4>
	                   			</div>
                   				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    	                    		<em class="time pull-right text-muted small "><?= isset($emailUser["updated_at"])? $emailUser["updated_at"]:"" ?></em>
	                   			</div>
                   			</div>
                 		
						
						
							<div class="row">
                   				<div class="col-lg-10 col-md-9 col-sm-7 col-xs-5">
    	                    		
	    	                    			From: <span class="text-muted "><?= isset($emailUser["userFrom"]["display_name"]) ? $emailUser["userFrom"]["display_name"]:"" ?> &lt;<?= isset($emailUser["userFrom"]["email"])? $emailUser["userFrom"]["email"]:"" ?>&gt;</span>
	    	                    			<br/>
	    	                    			To: <span class="text-muted "><?= isset($emailUser["userTo"]["display_name"])? $emailUser["userTo"]["display_name"]:"" ?> &lt;<?= isset($emailUser["userTo"]["email"])? $emailUser["userTo"]["email"]:"" ?>&gt;</span>
    	                    		
	                   			</div>
                   				<div class="col-lg-2 col-md-3 col-sm-5 col-xs-7">
    	                    		<div class="">
    	                    			<div class="btn-group pull-right">
										  <button type="button" class="btn btn-xs btn-default">Action</button>
										  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										    <span class="caret"></span>
										    <span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu " role="menu">
										  	<?php if($emailUser["status"]!=get_app_message("db.email.status.trash")){?>
											  	<?php if(isset($emailUser["userFrom"]["id"]) && $emailUser["userFrom"]["id"] != $_SESSION["sessionUser"]["id"]){?>
											    	<li><a href="<?= site_url("email/reply")?>/<?= encodeID($emailUser["id"]) ?>">Reply</a></li>
											    <?php } ?>
											    <li><a href="<?= site_url("email/forward")?>/<?= encodeID($emailUser["id"]) ?>">Forward</a></li>
											    <li class="divider"></li>
											    <li><a href="<?= site_url("email/moveToTrash")?>/<?= encodeID($emailUser["id"]) ?>">Trash</a></li>
										    <?php }else{ ?>
										    	<li><a href="<?= site_url("email/restoreFromTrash")?>/<?= encodeID($emailUser["id"]) ?>">Restore</a></li>
										    	<li><a href="<?= site_url("email/deleteForever")?>/<?= encodeID($emailUser["id"]) ?>">Delete Forever</a></li>
										   <?php  } ?>
										  </ul>
										</div>
    	                    		</div>
	                   			</div>
	                   			
	                   			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                   				<hr/>
	                   					<div class="conversation_body">
		                   					<?= $emailUser["email"]["body"]?>
	                   					</div>
	                   				<hr/>
	                   			</div>
                   			</div>
						
					</div>
         			
				<?php 
					if(isset($emailUser["referenceEmail"]) && !empty($emailUser["referenceEmail"])){
						$emailUser = $emailUser["referenceEmail"];
					}else{
						$emailUser = array();
					}
				
				?>
				
		<?php } ?>
	
<?php }?>
							
                          