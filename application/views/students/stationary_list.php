<?php //pre($allItems) ?>



<div class="box box-warning">
	<div class="box-header">
		All Items
	 </div>
	 
	<div class="box-body">
	
	
	
		<div class="table-responsive">
		
				<table class="table   table-hover table-responsive " id="stationaryList">
					<thead>
						<tr>
							<th>Name</th>
							<th >Issued Date</th>
							<th>Status</th>
							<th>Paid By</th>
							<th>Paid Date</th>
							<th>Price</th>
							<th>Comments</th>
							<th class="all disable-sort" ></th>
							
						</tr>
					</thead>
					<tbody>
					
					<?php foreach($allItems as $key => $item){ ?>
					
						<tr>
							<td><?= $item['item_type']['name'] ?> (<?= $item['issued_amount'] ?>)</td>
							<td><?= $item['issue_date'] ?></td>
							<td><?= $item['payment_status'] ?></td>
							<td><?= $item['paid_by'] ?></td>
							<td><?= $item['paid_date'] ?></td>
							<td><?= $item['price']* $item['issued_amount'] ?> PKR</td>
							<td>
								<a href="javascript:void(0);" tabindex="0" class="text-overflow-hide popover-link" role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= $item['comments'] ?>"><?= $item['comments'] ?></a>
							</td>
							<td>
									<div class="pull-right">
								         <div class="btn-group  col-centered">
								              <button type="button" class="btn btn-outline btn-warning btn-xs dropdown-toggle " data-toggle="dropdown">
								                    <span class="caret"></span>
								               </button>
								               <ul class="dropdown-menu pull-right" role="menu">
								               <?php if(isset($item["transaction_id"]) && !empty($item["transaction_id"])){?>
										  			<li><a href="javascript:void(0);"
														onclick="load_remote_model('<?= site_url() ?>profit/transactionDetail?id=<?= $item['transaction_id'] ?>&quickView=1','Transaction Detail');enlarge_remote_model();">Transaction Detail </a></li>
										  			<?php if($item['payment_status'] == get_app_message("db.status.paid")){ ?>
										  				<li><a href="<?= site_url("report/student_payment_receipt/".encodeID($item["transaction_id"])) ?>"  target="_blank"
															>Print</a></li>
													<?php } ?>	
										    	<?php } ?>
												<?php if($item['payment_status'] == get_app_message("db.status.due")){ ?>
 													<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('inventory/returnForm') ?>?student_item_id=<?= $item['student_item_id'] ?>','Return Item')">Return</a></li>
										        <?php } ?>
										        
										        
										        <li><a href="<?= site_url('inventory/itemDetail') ?>/<?= encodeID($item['id']) ?>">Detail</a></li>
							    	
										        
								               </ul>
								            </div>
							        </div>
								</td>
							
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
	</div>
	
	
</div>

