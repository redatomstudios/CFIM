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
	  $viewString = "<input type='button' onClick='showAttachments(" . $JSData . ")' value='&#26597;&#38405;' />";
	} else {
	  $viewString = "None";
	}
	return $viewString;
}
?>
<style>
	div.innerDetails { display: none }
</style>
<?php
/* Sort the comments into the following structure:
 * $rootID represents the id of the ROOT comment, meaning
 * the comment that started the current thread
 *
 * Each response to a comment by a random member
 * or a team member will be in separate arrays,
 * with the index being the rootID of the comment
 * thats being responded to
 */

	$rootComments = array(); 	// Store the root comments here
	$memberReplies = array();	// Store the comments from members not on the team here
	$teamReplies = array();	// Store the responses from the project team here
	$sImageUrl = "http://www.datatables.net/release-datatables/examples/examples_support/";
	
	foreach($comments as $thisComment) {
	/* Split the order number
	 * orderNumber structure : rootID.Increment.commentType
	 * Where 	rootID is unique to each root comment
	 *				Increment is an index for each rootID
	 * 				commentType is 1(Member Comment) or 2(Team Response)
	 */
		$orderNumber = explode('.', $thisComment['orderNumber']); 
		// If the split array has only one element, then we know it's a root comment
		if(sizeof($orderNumber) == 1) {
			// This is a root comment
			$rootID = $orderNumber[0];
			// $fileNames = '';
			// if(isset($thisComment['files'])){
			// 	foreach ($thisComment['files'] as $file) {
			// 		$fileNames .= $file . "</ br>";
			// 	}
			// 	$fileNames = substr($fileNames, 0, strlen($fileNames)-6);
			// }
			$rootComments[$rootID] = array(
					'name' => $this->membersModel->getName($thisComment["memberId"]),
					'comment' => $thisComment['body'],
					'attachment' => createViewButton(( isset($thisComment['files']) ? $thisComment['files'] : '' ), $id),
					'agreements' => $thisComment['counter'],
					'date' => $thisComment['timestamp']
				);
		} else {
			// If the array size isn't one, then its 3, and
			// this is a reply to a root comment
			$rootID = $orderNumber[0];
			$commentIndex = $orderNumber[1];
			$commentType = $orderNumber[2];
			if($commentType == '1') {
				// This is a response from a member NOT on the team
				$memberReplies[$rootID][] = array(
					'name' => $this->membersModel->getName($thisComment["memberId"]),
					'comment' => $thisComment['body'],
					'attachment' => createViewButton(( isset($thisComment['files']) ? $thisComment['files'] : '' ), $id),
					'date' => $thisComment['timestamp']
				);
			} else {
				// This is a response from a member ON the team
				$teamReplies[$rootID][] = array(
					'name' => $this->membersModel->getName($thisComment["memberId"]),
					'comment' => $thisComment['body'],
					'attachment' => createViewButton(( isset($thisComment['files']) ? $thisComment['files'] : '' ), $id),
					'date' => $thisComment['timestamp']
				);
			}
		}
	}

/* Once the comments are organize, we need to store them into a 
 * JSON object so the frontend javascript can access and process it
 * the structure of the JSON object is as follows:
 * rootComment {
 *		commentDate
 *		"comments" : [
 *			memberReplies as objects
 *		]
 *		"responses" : [
 *			teamResponses as objects
 *		]
 * }
 *
 * Afterwards, we can just pull each root comment and it's associated
 * responses or comments at once
 */

/* Since a lot of different forms will be required on each page, 
 * Lets use a script to automatically generate the forms instead of
 * hard coding them. So first lets define the JSON strings
 * that will determine the fields for each form
 */

// String used to generate form for posting a NEW ROOT COMMENT
$newCommentString = 
"{'elements' : [".
"{'name' : 'userID','type' : 'hidden','value' : '". $this->session->userdata('id') ."'},".
"{'name' : 'projectID','type' : 'hidden','value' : '". $id ."'},".
"{'name' : 'commentBody','type' : 'textarea', 'label' : '&#24847;&#35265;'},".
"{'name' : 'file[]','type' : 'file', 'multiple' : 'multiple', 'label' : '&#38468;&#20214;'}],".
" 'action' : '" . site_url("/member/newComment") . "',".
" 'method' : 'POST',".
" 'enctype' : 'multipart/form-data',".
" 'heading' : '&#26032;&#22686;&#24847;&#35265;' }";

// String used to generate form for posting NEW UPDATE
$newUpdateString = 
"{'elements' : [".
"{'name' : 'userID','type' : 'hidden','value' : '". $this->session->userdata('id') ."'},".
"{'name' : 'projectID','type' : 'hidden','value' : '". $id ."'},".
"{'name' : 'commentBody','type' : 'textarea', 'label' : '&#24847;&#35265;'},".
"{'name' : 'file[]','type' : 'file', 'multiple' : 'multiple', 'label' : '&#38468;&#20214;'}],".
" 'action' : '" . site_url("/member/newUpdate") . "',".
" 'method' : 'POST',".
" 'enctype' : 'multipart/form-data',".
" 'heading' : '&#26032;&#22686;&#36827;&#23637;' }";

// String used to generate form for posting a NEW EXPENSE
$newExpenseString =
"{'elements' : [".
"{'name' : 'userID','type' : 'hidden','value' : '". $this->session->userdata('id') ."'},".
"{'name' : 'projectID','type' : 'hidden','value' : '". $id ."'},".
"{'name' : 'commentBody','type' : 'textarea', 'label' : '&#25551;&#36848;'},".
"{'name' : 'expense','type' : 'text', 'label' : '&#36153;&#29992;'},".
"{'name' : 'file[]','type' : 'file', 'multiple' : 'multiple', 'label' : '&#38468;&#20214;'},".
"{'name' : 'vouchers[]','type' : 'file', 'multiple' : 'multiple', 'label' : '&#36153;&#29992;&#20973;&#35777;'}],".
" 'action' : '" . site_url("/member/newExpense") . "',".
" 'method' : 'POST',".
" 'enctype' : 'multipart/form-data',".
" 'heading' : '&#26032;&#22686;&#36153;&#29992;' }";

 /* Since we're creating a large and complicated outout, it'll be
  * better to store the data to an output buffer rather than
  * just storing it to a string 
  */

 // Start buffering
 ob_start();
 // All output from here will be store to the buffer ?>
 { "aaData" : [
 
 <?php foreach($rootComments as $rootID => $thisComment) { ?>
 	{
 		"member" : "<?= $thisComment['name'] ?>",
 		"comment" : "<?= $thisComment['comment'] ?>",
 		"attachment" : "<?= $this->mylibrary->escapeQuotes($thisComment['attachment']) ?>",
<?php 
/* Lets get the number of people who agree
 * The input array is just a CSV of the member IDs
 * that agree
 */
$rawAgreements = explode(',', $thisComment['agreements']);
$agreements = 0;
$agreeingMembers = array(); // IDs of members who agree
foreach($rawAgreements as $thisElement) {
	if(!empty($thisElement)) {
		array_push($agreeingMembers, $thisElement);
		$agreements++;
	}
}
?>
 		"agreements" : "<?= $agreements ?>",
<?php
/*
 * Determine the actions that the user can perform, based on the user type
 * If user is a part of this project, then [Respond] button should appear
 * Otherwise, [Agree] and [Comment] button appear
 * $status is only set if the member is not a part of the project team
 * so lets base the bahavior based on that variable
 */
if(!$MemberIsInProject) {
	/*
	 * This viewer is not a part of the project team
	 * Show them the [Agree] and [Comment] buttons
	 * We're already inside a buffer, so we can't use it again
	 * Without complicating things
	 */
	// String used to generate form for posting a NEW COMMENT in response to a ROOT COMMENT
	$respondComment = 
	'{"elements" : ['.
	'{"name" : "rootID","type" : "hidden","value" : "'. $rootID .'"},'.
	'{"name" : "projectID","type" : "hidden","value" : "'. $id .'"},'.	
	'{"name" : "userID","type" : "hidden","value" : "'. $this->session->userdata("id") .'"},'.
	'{"name" : "responseType","type" : "hidden","value" : "1"},'.
	'{"name" : "commentBody","type" : "textarea", "label" : "&#24847;&#35265;"},'.
	'{"name" : "file[]","type" : "file", "multiple" : "multiple", "label" : "&#38468;&#20214;"}],'.
	' "action" : "'. site_url('/member/newComment') .'",'.
	' "method" : "POST",'.
	' "enctype" : "multipart/form-data",'.
	' "heading" : "&#26032;&#22686;&#24847;&#35265;" }';

	// Form to process [Agree] button
	$agreeButton = 
		$this->mylibrary->escapeFunction(form_open('/member/agreeComment')) .
			//Project ID, the id of the project whose comment the member is agreeing to
			"<input type='hidden' name='projectID' value='".$id."' />" .
			// ID of the root comment where agreement should be added
			"<input type='hidden' name='rootID' value='".$rootID."' /> " .
			// User ID, the id that needs to be added to the agreements
			"<input type='hidden' name='userID' value='".$this->session->userdata("id")."' />" .
			"<input style='width: 100%;' type='submit' value='Agree' />" .
		"</form>";

	// Check if the viewer has already agreed with the comment
	if(in_array($this->session->userdata("id"), $agreeingMembers)) {
		$userActions = 
			"<input style='width: 100%;' type='button' value='Comment' onclick='openForm(". $this->mylibrary->escapeQuotes($respondComment) .")' />";
	} else {
		$userActions =
			$agreeButton . 
			"<input style='width: 100%;' type='button' value='Comment' onclick='openForm(". $this->mylibrary->escapeQuotes($respondComment) .")' />";
	}
} else {
	/*
	 * This viewer is a member of the project team
	 * Show them the [Respond] button
	 * We're already inside a buffer, so we can't use it again
	 * Without complicating things
	 */
	// String used to generate form for posting a RESPONSE in response to a ROOT COMMENT
	$justRespond = 
	'{"elements" : ['.
	'{"name" : "rootID","type" : "hidden","value" : "'. $rootID .'"},'.
	'{"name" : "projectID","type" : "hidden","value" : "'. $id .'"},'.	
	'{"name" : "userID","type" : "hidden","value" : "'. $this->session->userdata("id") .'"},'.
	'{"name" : "responseType","type" : "hidden","value" : "2"},'.
	'{"name" : "commentBody","type" : "textarea", "label" : "&#24847;&#35265;"},'.
	'{"name" : "file[]","type" : "file", "multiple" : "multiple", "label" : "&#38468;&#20214;"}],'.
	' "action" : "'. site_url('/member/newComment') .'",'.
	' "method" : "POST",'.
	' "enctype" : "multipart/form-data",'.
	' "heading" : "&#21453;&#39304;" }';

	// if(count($memberReplies) && isset($memberReplies[$rootID])) {
		$userActions =
		"<input style='width: 100%;' type='button' value='&#21453;&#39304;' onclick='openForm(". $this->mylibrary->escapeQuotes($justRespond) .")' />";
	// } else {
		// $userActions = "";
	// }
}

?>
 		"actions" : "<?= $userActions ?>",
 		"time" : "<?= $thisComment['date'] ?>",
 		"comments" : [
 			<?php if(count($memberReplies) && isset($memberReplies[$rootID])) { ?>
	 			<?php foreach($memberReplies[$rootID] as $memberReply) { ?>
	 				{
	 					"name" : "<?= $memberReply['name'] ?>",
	 					"comment" : "<?= $memberReply['comment'] ?>",
	 					"attachment" : "<?= $this->mylibrary->escapeQuotes($memberReply['attachment']) ?>",
	 					"date" : "<?= $memberReply['date'] ?>"
	 				},
	 			<?php } ?>
 			<?php } ?>
 		],
 		"responses" : [
	 		<?php if(count($teamReplies) && isset($teamReplies[$rootID])) { ?>
	 			<?php foreach($teamReplies[$rootID] as $teamReply) { ?>
	 				{
	 					"name" : "<?= $teamReply['name'] ?>",
	 					"comment" : "<?= $teamReply['comment'] ?>",
	 					"attachment" : "<?= $this->mylibrary->escapeQuotes($teamReply['attachment']) ?>",
	 					"date" : "<?= $teamReply['date'] ?>"
	 				},
	 			<?php } ?>
 			<?php } ?>
 		],
 		<?php if( (count($memberReplies) && isset($memberReplies[$rootID])) || (count($teamReplies) && isset($teamReplies[$rootID]))) { ?>
		"control" : "<?= '<img src=\"'.$sImageUrl.'details_open.png\">' ?>"
		<?php } else { ?>
		"control" : ""
		<?php } ?>
 	},
 <?php } ?>
 
 ]}
 <?php
/* 
 * Alright, now we've got everything we need.
 * Lets store the buffer to a variable so we can
 * play with it.
 */

 $JSON_comments = ob_get_clean();
?>
<script>
	// Store data into JS variable to access from dataTables
	var dataSource = <?= $JSON_comments ?>;
	// Code for proper display of comments in member accounts
		jQuery(document).ready(function($) {

				$('table.displayOnlyTimeSort').dataTable({
		      "bPaginate": true,
		      "iDisplayLength": 10,
		      "bLengthChange": false,
		      "bFilter" : false,
		      "aaSorting" : [[3, 'desc']],
		      "bInfo" : false,
		      "bSort": true
				});

		  var anOpen = [];
		    var sImageUrl = "http://www.datatables.net/release-datatables/examples/examples_support/";
		     
		    var oTable = $('.commentedTable').dataTable( {
		        "bProcessing": true,
		        // "sScrollY": "350px",
		        "aaData": dataSource.aaData,
		        "bPaginate": true,
		        "iDisplayLength": 5,
		        "bLengthChange": false,
		        "bInfo": false,
		        "aaSorting": [[4, 'asc']],
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

		    $('.commentedTable td.control').live( 'click', function () {
		    //$('.commentedTable td.control').each(function () {
			  var nTr = this.parentNode;
			  var i = $.inArray( nTr, anOpen );

			  if ( i === -1 ) {
			  	$('img', this).attr( 'src', sImageUrl+"details_close.png" );
			    var nDetailsRow = oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'comments' );
			    $('div.innerDetails', nDetailsRow).slideDown();
			    anOpen.push( nTr );
			  }
			  else {
			  	$('img', this).attr( 'src', sImageUrl+"details_open.png" );
			    $('div.innerDetails', $(nTr).next()[0]).slideUp( function () {
			      oTable.fnClose( nTr );
			      anOpen.splice( i, 1 );
			    } );
			  }
			} );
			 
			function fnFormatDetails( oTable, nTr )
			{
			  var oData = oTable.fnGetData( nTr );
			  var sOut = '<div class="innerDetails">';
			  	if(oData.comments.length) {
			      sOut += '<table cellpadding="5" cellspacing="0" border="0" >' +
			      		'<tr class="followonComment"><td colspan="4" style="font-weight: bold;">Follow On Comments</td></tr>';
			      for( thisComment in oData.comments ) {
			      	sOut += 
				      	'<tr class="followonComment">' +
				        	'<td>' + oData.comments[thisComment].name + '</td>' +
				        	'<td>' + oData.comments[thisComment].date + '</td>' +
				        	'<td class="centered">' + oData.comments[thisComment].attachment + '</td>' +
				        	'<td>' + oData.comments[thisComment].comment + '</td>' +
			        	'</tr>'	;
			      }
			  	}
		        // sOut += '</table>';
		        if(!oData.comments.length) {
		        	sOut += '<table cellpadding="5" cellspacing="0" border="0" >';
		        }
		        if(oData.responses.length) {
			        // sOut += '<table class="responseComments" cellpadding="5" cellspacing="0" border="0" >';
			        sOut += '<tr class="responseComment"><td colspan="4" style="font-weight: bold;">Responses</td></tr>';
			        for( thisComment in oData.responses ) {
			        	sOut += 
			  	      	'<tr class="responseComment">' +
			  	        	'<td>' + oData.responses[thisComment].name + '</td>' +
			  	        	'<td>' + oData.responses[thisComment].date + '</td>' +
			  	        	'<td class="centered">' + oData.responses[thisComment].attachment + '</td>' +
			  	        	'<td>' + oData.responses[thisComment].comment + '</td>' +
			          	'</tr>'	;
			        }
			        sOut += '</table>';
			      }
			      sOut += '</div>';
			  return sOut;
			}
		} );
</script>

<div class="gridOne spaceTop">
	<span class="lg-en"><strong>Project Name: </strong></span>
	<span class="lg-cn"><strong>&#39033;&#30446;&#20195;&#21495;: </strong></span>
	<?= $name ?>
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
					<span class="lg-en">Deal Size</span>
					<span class="lg-cn">&#39033;&#30446;&#37329;</span>
				</th>
				<th>
					<span class="lg-en">Attachments</span>
					<span class="lg-cn">&#38468;&#20214;</span>
				</th>
				<?php if(!$MemberIsInProject) { // Echo this only if the person viewing is not a member of the project  ?> 
				<th>
					<span class="lg-en">Status</span>
					<span class="lg-cn">&#39033;&#30446;&#36827;&#31243;</span>
				</th> 
				<?php } ?>
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
			<td>
				<?=  $dealSize ?>
			</td>
			<td style="text-align: center;">
				<?php 
		          // Check if there are any attachments
		          // If so, echo the formatted data with button, otherwise echo "None"

		          $viewString = createViewButton($documents, $id);
		        ?>
		        <?=  $viewString ?>
			</td>
			<?php if(!$MemberIsInProject) { // Echo this only if the person viewing is not a member of the project ?>
			<td>
				<?= $status ?>
			</td>
			<?php } ?>
		</tr>
	</table>
</div>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<table class="commentedTable">
		<thead>
			<tr>
				<th></th>
				<th>
					<span class="lg-en">Member</span>
					<span class="lg-cn">&#39033;&#30446;&#25104;&#21592;</span>
				</th>
				<th>
					<span class="lg-en">Comments</span>
					<span class="lg-cn">&#24847;&#35265;</span>
				</th>
				<th>
					<span class="lg-en">Attachment</span>
					<span class="lg-cn">&#38468;&#20214;</span>
				</th>
				<th>
					<span class="lg-en">Time</span>
					<span class="lg-cn">&#26102;&#38388;</span>
				</th>
				<th>
					<span class="lg-en">Agreements</span>
					<span class="lg-cn">&#21516;&#24847;</span>
				</th>
				<th>
					<span class="lg-en">Actions</span>
					<span class="lg-cn">&#34892;&#21160;</span>
				</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<?php if(!$MemberIsInProject) { // Only echo these if viewer is not a member of the project ?>
<div class="gridOne spaceTop">
	<span class="lg-en"><input type="button" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newCommentString) ?>)" value="Add New Comment" /></span>
	<span class="lg-cn"><input type="button" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newCommentString) ?>)" value="&#26032;&#22686;&#24847;&#35265;" /></span>
	<a href="<?= base_url() ?>member/">
		<span class="lg-en"><input type="button" value="Back to Home" /></span>
		<span class="lg-cn"><input type="button" value="&#21462;&#28040;" /></span>
	</a>
</div>
<?php } // End of things to echo only if viewer is not a member of the project ?>
<?php if($MemberIsInProject) { // Only echo these if viewer is a member of the project ?>
<div class="gridOne spaceTop">
	<span class="lg-en"><strong>Update on Progress</strong>: </span>
	<span class="lg-cn"><strong>&#39033;&#30446;&#36827;&#23637;</strong>: </span>
</div>
<div class="gridOne spaceTop small">
	<?php if(sizeof($updates) > 0) { ?>
	<table class="displayOnlyTimeSort">
		<thead>
			<tr>
				<th>
					<span class="lg-en">Member</span>
					<span class="lg-cn">&#39033;&#30446;&#25104;&#21592;</span>
				</th>
				<th>
					<span class="lg-en">Update on Project</span>
					<span class="lg-cn">&#36827;&#23637;&#31616;&#36848;</span>
				</th>
				<th>
					<span class="lg-en">Attachment</span>
					<span class="lg-cn">&#38468;&#20214;</span>
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
					<span class="lg-en">Reviewed by Finance</span>
					<span class="lg-cn">&#36130;&#21153;&#23457;&#26680;</span>
				</th>
				<th>
					<span class="lg-en">Comments</span>
					<span class="lg-cn">&#24847;&#35265;</span>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php $totalExpenses = 0; ?>
			<?php foreach ($updates as $update) { ?>
			<tr>
				<td><?= $this->membersModel->getName($update['memberId']) ?></td>
				<td><?= $update['updateBody'] ?></td>

				<?php 
		          // Check if there are any attachments
		          // If so, echo the formatted data with button, otherwise echo "None"
				if(isset($update['attachments'])) {
					$viewString = createViewButton($update['attachments'], $id);
				} else {
					$viewString = 'None';
				}
		        ?>

				<td class="centered"><?= $viewString ?></td>
				<td class="centered"><?= $update['timestamp'] ?></td>
				<?php if($update['expense'] != '0.00') { ?>
					<td class="centered"><?= $update['expense'] ?></td>
					<?php $totalExpenses += $update['expense']; ?>

					<?php 
			          // Check if there are any attachments
			          // If so, echo the formatted data with button, otherwise echo "None"
					if(isset($update['vouchers'])) {
						$viewString = createViewButton($update['vouchers'], $id);
					} else {
						$viewString = 'None';
					}
			        ?>

					<td class='centered'><?= $viewString ?></td>
					<?php 
						$statusString = '';
						if(isset($update['status'])) {
							switch($update['status']) {
								case 'Pending': 
								$statusString = "Pending";
								break;

								case 'Approved':
								$statusString = "Approved by " . $this->membersModel->getName($update['reviewedBy']);
								break;

								case 'Rejected':
								$statusString = "Rejected by " . $this->membersModel->getName($update['reviewedBy']);
								break;

								default:
								$statusString = "-";
								break;
							}
						}
					?>
					<td class='centered'><?= (isset($update['reviewedBy'])? $statusString :'-') ?></td>
				<?php } else { ?>
					<td></td>
					<td></td>
					<td></td>
				<?php } ?>
				<td><?php // Reason for status, if any ?></td>
			</tr>			
			<?php  }  ?>
			<?php 
				$totalExpenses *= 100;
			?>
		</tbody>
	</table>
	<?php } ?>
</div>
<div class="gridOne spaceTop" style="text-align: right; font-weight: bold; font-size: 1.5em;">
	<span class="lg-en">Total: </span>
	<span class="lg-cn">&#24635;&#25968;: </span>
	<?php if(isset($totalExpenses)) { ?>
		<?= intval($totalExpenses / 100) . '.' . ($totalExpenses % 100) . ( $totalExpenses % 100 < 10 ? '0' : '' ) ?>
	<?php } else { ?>
		0
	<?php } ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en">
		<input type="button" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newUpdateString) ?>)" value="Add New Update" />
		<input type="button" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newExpenseString) ?>)" value="Add Expenses" />
	</span>
	<span class="lg-cn">
		<input type="button" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newUpdateString) ?>)" value="&#26032;&#22686;&#36827;&#23637;" />
		<input type="button" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newExpenseString) ?>)" value="&#26032;&#22686;&#36153;&#29992;" />
	</span>
</div>
<?php } // End of things to echo only if viewer is a member of the project ?>
<div class="clear"></div>
<script>
filesToDelete = '';
  $('body').on('click', 'input[type="checkbox"].deleteAttachmentFlag', function(){
    if(this.checked) {
      filesToDelete += this.value + ',';
    } else {
      filesToDelete = filesToDelete.split(this.value + ',').join('');
    }
    document.getElementById('attachmentsToDelete').value = filesToDelete.substring(0, filesToDelete.length - 1);
  });
</script>