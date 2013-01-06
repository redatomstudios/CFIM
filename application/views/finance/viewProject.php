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

<script>
		jQuery(document).ready(function($) {
		    var oTable = $('.commentedTable').dataTable( {
		        "bProcessing": true,
		        "sScrollY": "350px",
		        "aaData": dataSource.aaData,
		        "bPaginate": true,
		        "iDisplayLength": 5,
		        "bLengthChange": false,
		        "bInfo": false,
		        "aaSorting": [[4, 'desc']],
		        "aoColumns": [
				    { "mDataProp": "control", "sClass": "control centered", "bSortable": false },
		            { "mDataProp": "member", "bSortable": false },
		            { "mDataProp": "comment", "bSortable": false },
		            { "mDataProp": "attachment", "sClass": "centered", "bSortable": false },
		            { "mDataProp": "time", "sClass": "centered" },
		            { "mDataProp": "agreements", "sClass": "centered", "bSortable": false },
		            { 
		            	"mDataProp": "actions",
		            	"sClass": "centered",
						"bSortable": false
		            }
		        ],
		        "oLanguage": {
		        	"sEmptyTable": "No comments on this project yet."
		        }
		    } );
		} );
</script>

<div class="gridOne spaceTop">
	<strong>Project Name:</strong> <?= $project['name'] ?>
</div>
<div class="gridOne spaceTop spaceBottom">
	<table class="singleRow centered">
		<thead>
			<tr>
				<th>Project Leader</th>
				<th>Sector</th>
				<th>Sub-Sector</th>
				<th>Geo Region</th>
				<th>Attachments</th>
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
	<?php $expenses = $project['expenses'] ?>
	<?php if(sizeof($expenses) > 0) { ?>
	<table class="displayOnly">
		<thead>
			<tr>
				<th>Member</th>
				<th>Update on Project</th>
				<th>Time</th>
				<th>Expenses</th>
				<th>Voucher</th>
				<th>Review</th>
				<th>Actions</th>
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
						<input type="text" name="reason" placeholder="Reason for approval/rejection" style="width: 100%" /> <br />
						<input type="hidden" name="expenseID" value="<?= $thisExpense['id'] ?>" />
						<input type="hidden" name="financeID" value="<?= $this->session->userdata('id') ?>" />
						<input type="submit" name="approve" value="Approve" />
						<input type="submit" name="reject" value="Reject" />
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
	<?php if(isset($totalExpenses)) { ?>
		Total: <?= intval($totalExpenses / 100) . '.' . ($totalExpenses % 100) . ( $totalExpenses % 100 < 10 ? '0' : '' ) ?>
	<?php } else { ?>
		Total: 0
	<?php } ?>
</div>
<div class="clear"></div>