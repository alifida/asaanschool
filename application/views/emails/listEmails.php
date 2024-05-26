<?php  ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="btn-toolbar" role="toolbar">
			<div class="btn-group">
			  	<button type="button" class="btn btn-default" aria-label="Left Align" onclick="location.reload();">
				  <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
				</button>
				<?php if($emailType == get_app_message("db.email.status.trash")){ ?>
				  	<button type="button" class="btn btn-default" aria-label="Left Align" onclick="$('#action').val('deleteForever');$('#emailListForm').submit();">
					  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</button>
				<?php }else{ ?>
					<button type="button" class="btn btn-default" aria-label="Left Align" onclick="$('#action').val('moveToTrash');$('#emailListForm').submit();">
					  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</button>
				<?php } ?>
				
				<?php if($emailType == get_app_message("db.email.status.trash")){ ?>
				  	<button type="button" class="btn btn-default" aria-label="Left Align"  onclick="$('#action').val('restore');$('#emailListForm').submit();">
					  Restore
					</button>
				<?php }else{ ?>
					<button type="button" class="btn btn-default" aria-label="Left Align"  onclick="$('#action').val('markRead');$('#emailListForm').submit();">
					  Mark as read
					</button>
				<?php } ?>
			</div>
		</div>
		<br/>
	</div>
</div>
	<form class="form-horizontal" id="emailListForm" action="<?= site_url('email/emailsListAction'); ?>" method="post" >
							<div class="list-group">
								<?php $totalPages = 0; ?>
								<?php if(!empty($emailsList)){ ?>
									<?php
										if(isset($emailsList["totalPages"])){
											$totalPages = $emailsList["totalPages"];
										 	unset($emailsList["totalPages"]);
										} 
										?>
									<?php foreach($emailsList as $key => $email){?>
										<?php 
											$href = site_url("email/view") ."/".encodeID($email["id"]); 
											if($emailType == get_app_message("db.email.type.draft")){
												$href = site_url("email/composeDraft") ."/".encodeID($email["id"]); 
											}
										?>
									
									
												
									
										<a href="<?= $href ?>" class="list-group-item">
		                                	<span class="row email-list <?= ($email["status"] == get_app_message("db.email.status.unread"))?"unread":"" ?>">
		                                     	<span class="subject col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
		                                     		<span class="checkbox pull-left" style="margin-top: 0px; font-size: 16px; color: #367fa9">
							  							<label style="padding-left:0px;">
								            				<input type="checkbox" name="emailsList[]" value="<?= encodeID($email["id"]) ?>"  >
								      							<span></span>
								  						</label>
							  						</span> 
		                                     	</span>
		                                     	<span class="subject col-lg-2 col-md-2 col-sm-3 col-xs-3 text-overflow-hide">
		                                          <?= $email["email"]["subject"] ?>
		                                     	</span>
		                                     	<span class="body col-lg-7 col-md-7 col-sm-6 col-xs-6 text-overflow-hide"><?=preg_replace('/(?:\s\s+|\n|\t|&nbsp;)/', ' ',strip_tags($email["email"]["body"]))  ?></span>
		                                    	<span class="time pull-right text-muted small col-lg-2 col-md-2 col-sm-2 col-xs-2"><em class="pull-right"><?= $email["updated_at"] ?></em></span>
		                                	</span>
		                                </a>
									<?php } ?>
								<?php } ?>
                            </div>
                            <input type="hidden" name="action" id="action"/>
</form>
                            
                            	<?php if($totalPages > 1){ 	?>
	                            	 <div >
		                            	<ul class="pagination  pull-right">
		                            		<li class="<?= ($currentPage <=1 )?"disabled":"" ?>"><a href="<?= ($currentPage <=1 )?"#":site_url("email")."/".$emailType."/".($currentPage-1) ?>">Prev</a></li>
											<?php for($pageNo = 1; $pageNo <= $totalPages; $pageNo++){ ?>
		                            			<li  class="<?= ($currentPage == $pageNo)?"active":"" ?>" ><a href="<?= site_url("email")?>/<?= $emailType ?>/<?= $pageNo ?>"><?= $pageNo ?></a></li>
		                            		<?php }?>
		                            		<li class="<?= ($currentPage >=$totalPages )?"disabled":"" ?>"><a href="<?= ($currentPage >=$totalPages )?"#":site_url("email")."/".$emailType."/".($currentPage + 1) ?>">Next</a></li>
		                            	</ul>
	                            	</div>
                            	<?php }?>
							  
							
