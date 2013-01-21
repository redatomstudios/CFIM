
<?= form_open('/finance/index') ?>
<div class="gridOne spaceTop small centered">
	<table class="singleRow">
		<thead>
			<tr>
				<th>
					<span class="lg-en">Project Leader</span>
					<span class="lg-cn">&#39033;&#30446;&#32463;&#29702;</span>
				</th>
				<th>
					<span class="lg-en">Project Member</span>
					<span class="lg-cn">&#39033;&#30446;&#25104;&#21592;</span>
				</th>
				<th>
					<span class="lg-en">Status</span>
					<span class="lg-cn">&#39033;&#30446;&#36827;&#31243;</span>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?= form_dropdown('projectLeader', $members, 0) ?></td>
				<td><?= form_dropdown('projectMember', $members, 0) ?></td>
				<td><?= form_dropdown('status', $status, (isset($something) ? $something : 'On-Going'), 'style="width: 100%;"') ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="gridOne" style="text-align: right; margin-top: 10px;">
	<input type="submit" value="Display" />	
</div>
<?= form_close() ?>

<?php 
	if(isset($memberProjects) && ($memberProjects != FALSE)) { 
?>
<style>
	div.innerDetails { display: none }
</style>
<script>
	var dataSource = 	{ "aaData": [
										<?php foreach ($memberProjects as $project) { ?>
											{
												'name': '<?= anchor("/finance/viewProject/".$project["id"], $project["name"]) ?>',
												'leader': '<?= $this->membersModel->getName($project["leaderId"]) ?>',
												'totalExpenses': '<?= $project["accumulatedExpense"] ?>',
												'expenseType': '-',
												'vouchers': '-',
												'claimDate': '-'
											},
											
										<?php } ?>
										] }
	// Code for proper display of comments in member accounts
		jQuery(document).ready(function($) {
		  var anOpen = [];
		    var sImageUrl = "http://www.datatables.net/release-datatables/examples/examples_support/";
		     
		    var oTable = $('.commentedTable').dataTable( {
		        "bProcessing": true,
		        "aaData": dataSource.aaData,
		        "bPaginate": true,
		        "iDisplayLength": 10,
		        "bLengthChange": false,
		        "aaSorting": [],
		        "bInfo": false,
		        "aoColumns": [
		            { "mDataProp": "name" },
		            { "mDataProp": "leader" },
		            { "mDataProp": "totalExpenses" },
		            { "mDataProp": "expenseType" },
		            { "mDataProp": "vouchers" },
		            { "mDataProp": "claimDate" },
		        ]
		    } );
		} );
</script>
<div class="gridOne spaceTop">
	<table cellpadding="0" cellspacing="0" border="0" class="display commentedTable centered">
	    <thead>
	        <tr>
	            <th>
	            	<span class="lg-en">Name</span>
	            	<span class="lg-cn">&#39033;&#30446;&#20195;&#21495;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Leader</span>
	            	<span class="lg-cn">&#39033;&#30446;&#32463;&#29702;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Accumulated<br />Expense</span>
	            	<span class="lg-cn">&#36153;&#29992;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Expense<br />Type</span>
	            	<span class="lg-cn">Expense<br />Type</span>
	            </th>
	            <th>
	            	<span class="lg-en">Voucher</span>
	            	<span class="lg-cn">&#36153;&#29992;&#20973;&#35777;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Claim Date</span>
	            	<span class="lg-cn">Claim Date</span>
	            </th>
	        </tr>
	    </thead>
	    <tbody></tbody>
	</table>
</div>
<div class="clear"></div>
<?php } else { ?>
<div class="gridOne centered spaceTop">
	No projects matching your criteria
</div>
<?php } ?>