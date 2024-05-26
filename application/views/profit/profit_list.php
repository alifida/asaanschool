<?php ?>
<div class="box box-primary">
	<div class="box-header">
		Recent Profit
		
	</div>
	<div class="box-body">
	<div class="table-responsive">
	
		<table class="table table-hover simpleDataTables">
			<thead>
				<tr>
					<th>Date</th>
					<th>Amount</th>
					<th class="all disable-sort" ></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($profitList as $key => $profit){ ?>
				<tr>
					<td><?= $profit['profit_date'] ?></td>
					<td><?= $profit['profit_amount']?></td>
					<td>
						<div class="btn-group col-centered" >
						  <button type="button" class="btn btn-outline btn-primary btn-xs dropdown-toggle " data-toggle="dropdown">
			                    <span class="caret"></span>
			               </button>
						  <ul class="dropdown-menu pull-right" role="menu">
				    		<li><a href="<?= site_url("profit/profitDetail")?>?id=<?= $profit['id'] ?>" >Details</a></li>
						  </ul>
						</div>
					</td>
				</tr>
				<?php } ?>
				
			</tbody>
		</table>
		</div>
	</div>
</div>
