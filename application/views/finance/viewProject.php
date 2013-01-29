<?php
function createViewButton($documents, $id) {
	if(is_array($documents) && count($documents)) {
	  // Construct JS object with details to pass to View button
	  $JSData = '{ "attachments" : [';
	  foreach($documents as $thisDocument) {
	    $JSData .= '{' . 
	            '"filename" : "' . $thisDocument['filename'] . '",' .
	            '"projectID" : "' . $id . '",' .
	            '"rootURL" : "' . base_url() . '",' .
	            '"timestamp" : "' . $thisDocument['timestamp'] . '"' .
	          '},';
	  }
	  $JSData .= ']}';
	  $viewString = "<input type='button' value='View' onClick='showAttachments(" . $JSData . ")' />";
	} else {
	  $viewString = "None";
	}
	return $viewString;
}
?>

<div class="gridOne spaceTop">
	<span class="lg-en"><strong>Project Name: </strong></span>
	<span class="lg-cn"><strong>&#39033;&#30446;&#20195;&#21495;: </strong></span>
	<?= $project['name'] ?>
</div>
<div class="gridOne spaceTop spaceBottom">
	<table class="singleRow centered">
		<thead>
			<tr>
				<th>
					<span class="lg-en">Project Leader</span>
					<span class="lg-cn">&#39033;&#30446;&#32463;&#29702;</span>
				</th>
				<th>
					<span class="lg-en">Sector</span>
					<span class="lg-cn">&#20027;&#35201;&#20998;&#31867;</span>
				</th>
				<th>
					<span class="lg-en">Sub-Sector</span>
					<span class="lg-cn">&#19979;&#35774;&#20998;&#31867;</span>
				</th>
				<th>
					<span class="lg-en">Geo Region</span>
					<span class="lg-cn">&#30465;</span>
				</th>
				<th>
					<span class="lg-en">Attachments</span>
					<span class="lg-cn">&#38468;&#20214;</span>
				</th>
			</tr>
		</thead>
		<tr>
			<td>
				<?= $leader ?>
			</td>
			<td>
				<?=  $sector ?>
			</td>
			<td>
				<?=  $subsector ?>
			</td>
			<td>
				<?=  $georegion ?>
			</td>
			<td class="centered">
				<?php 
		          $viewString = createViewButton($documents, $project['id']);
		        ?>
		        <?=  $viewString ?>
			</td>
		</tr>
	</table>
</div>
<div class="clear"></div>

<div class="gridOne spaceTop">
	<?php //$expenses = $project['expenses'] ?>
	<?php if(sizeof($expenses) > 0) { ?>
	<table class="displayOnly">
		<thead>
			<tr>
				<th>
					<span class="lg-en">Member</span>
					<span class="lg-cn">&#25104;&#21592;&#21517;&#23383;</span>
				</th>
				<th>
					<span class="lg-en">Update on Project</span>
					<span class="lg-cn">&#36827;&#23637;&#31616;&#36848;</span>
				</th>
				<th>
					<span class="lg-en">Time</span>
					<span class="lg-cn">&#26102;&#38388;</span>
				</th>
				<th>
					<span class="lg-en">Expenses</span>
					<span class="lg-cn">&#36153;&#29992;</span>
				</th>
				<th>
					<span class="lg-en">Voucher</span>
					<span class="lg-cn">&#36153;&#29992;&#20973;&#35777;</span>
				</th>
				<th>
					<span class="lg-en">Review</span>
					<span class="lg-cn">&#36130;&#21153;&#23457;&#26680;</span>
				</th>
				<th>
					<span class="lg-en">Actions</span>
					<span class="lg-cn">&#34892;&#21160;</span>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php $totalExpenses = 0; ?>
			<?php foreach ($expenses as $thisExpense) { ?>
			<tr>
				<td><?= $this->membersModel->getName($thisExpense['memberId']) ?></td>
				<td><?= $thisExpense['updateBody'] ?></td>
				<td class="centered"><?= $thisExpense['timestamp'] ?></td>
					<td class="centered"><?= $thisExpense['expense'] ?></td>
					<?php $totalExpenses += $thisExpense['expense']; ?>

					<?php 
			          // Check if there are any attachments
			          // If so, echo the formatted data with button, otherwise echo "None"
					if(isset($thisExpense['vouchers'])) {
						$viewString = createViewButton($thisExpense['vouchers'], $project['id']);
					} else {
						$viewString = 'None';
					}
			        ?>

					<td class='centered'><?= $viewString ?></td>
					<?php 
						$statusString = '';
						if(isset($thisExpense['status'])) {
							switch($thisExpense['status']) {
								case 'Pending': 
								$statusString = "Pending";
								break;

								case 'Approved':
								$statusString = "Approved by " . $this->membersModel->getName($thisExpense['reviewedBy']);
								break;

								case 'Rejected':
								$statusString = "Rejected by " . $this->membersModel->getName($thisExpense['reviewedBy']);
								break;

								default:
								$statusString = "-";
								break;
							}
						}
					?>
					<td class="centered"><?= (isset($thisExpense['reviewedBy'])? $statusString :'-') ?></td>
				<td class="centered">
				<?php
					if($thisExpense['status'] == 'Pending') {
						/*
						 * Expense hasn't been reviewed yet 
						 * Display the [Approve] and [Reject] buttons
						 * along with a textbox for the reason
						 */
					?> 
						<?= form_open('finance/reviewExpense') ?>
						<input type="text" name="reason" placeholder="Reason for approval/rejection" style="width: 215px;" /> <br />
						<input type="hidden" name="expenseID" value="<?= $thisExpense['id'] ?>" />
						<input type="hidden" name="projectID" value="<?= $thisExpense['projectId'] ?>" />
						<input type="hidden" name="financeID" value="<?= $this->session->userdata('id') ?>" />
						<span class="lg-en">
							<input type="submit" name="approve" value="Approve" />
							<input type="submit" name="reject" value="Reject" />
						</span>
						<span class="lg-cn">
							<input type="submit" name="approve" value="&#25209;&#20934;" />
							<input type="submit" name="reject" value="&#25298;&#32477;" />
						</span>
						<?= form_close() ?>
					<?php	
					} else {
						/*
						 * Expense hasn't been reviewed yet 
						 * No options need to be shown
						 */
						echo '-';
					}
				?>
				</td>
			</tr>			
			<?php  }  ?>
			<?php 
				$totalExpenses *= 100;
			?>
		</tbody>
	</table>
	<?php } ?>
</div>
<div class="gridOne spaceTop spaceBottom" style="text-align: right; font-weight: bold; font-size: 1.5em;">
	<span class="lg-en">Total: </span>
	<span class="lg-cn">&#24635;&#25968;: </span>
	<?php if(isset($totalExpenses)) { ?>
		<?= intval($totalExpenses / 100) . '.' . ($totalExpenses % 100) . ( $totalExpenses % 100 < 10 ? '0' : '' ) ?>
	<?php } else { ?>
		0
	<?php } ?>
</div>
<div class="clear"></div>