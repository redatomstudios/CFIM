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
	$teamResponses = array();	// Store the responses from the project team here
	
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
			$rootComments[$rootID] = array(
					'name' => $this->membersModel->getName($thisComment["memberId"]),
					'comment' => $thisComment['body'],
					'attachment' => $thisComment['attachments'],
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
					'attachment' => $thisComment['attachments'],
					'date' => $thisComment['timestamp']
				);
			} else {
				// This is a response from a member ON the team
				$teamReplies[$rootID][] = array(
					'name' => $this->membersModel->getName($thisComment["memberId"]),
					'comment' => $thisComment['body'],
					'attachment' => $thisComment['attachments'],
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
	'{"elements" : ['.
'{"name" : "userID","type" : "hidden","value" : "'. $this->session->userdata("id") .'"},'.
'{"name" : "commentBody","type" : "text", "label" : "Comment"},'.
'{"name" : "file[]","type" : "file", "multiple" : "multiple", "label" : "Attachments"}],'.
' "action" : "",'.
' "method" : "POST",'.
' "heading" : "New Comment" }';

// String used to generate form for posting NEW UPDATE
$newUpdateString = 
	'{"elements" : ['.
'{"name" : "userID","type" : "hidden","value" : "'. $this->session->userdata("id") .'"},'.
'{"name" : "commentBody","type" : "text", "label" : "Comment"},'.
'{"name" : "file[]","type" : "file", "multiple" : "multiple", "label" : "Attachments"}],'.
' "action" : "",'.
' "method" : "POST",'.
' "heading" : "New Update" }';

// String used to generate form for posting a NEW EXPENSE
$newExpenseString =
	'{"elements" : ['.
'{"name" : "userID","type" : "hidden","value" : "'. $this->session->userdata("id") .'"},'.
'{"name" : "commentBody","type" : "text", "label" : "Description"},'.
'{"name" : "expenses","type" : "text", "label" : "Amount"},'.
'{"name" : "file[]","type" : "file", "multiple" : "multiple", "label" : "Attachments"},'.
'{"name" : "vouchers[]","type" : "file", "multiple" : "multiple", "label" : "Voucher"}],'.
' "action" : "",'.
' "method" : "POST",'.
' "heading" : "Add Expense" }';

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
 		"attachment" : "<?= $thisComment['attachment'] ?>",
<?php 
/* Lets get the number of people who agree
 * The input array is just a CSV of the member IDs
 * that agree
 */
$rawAgreements = explode(',', $thisComment['agreements']);
$agreements = 0;
foreach($rawAgreements as $thisElement) {
	if($thisElement) {
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
if(isset($status)) {
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
	'{"name" : "userID","type" : "hidden","value" : "'. $this->session->userdata("id") .'"},'.
	'{"name" : "responseType","type" : "hidden","value" : "1"},'.
	'{"name" : "commentBody","type" : "text", "label" : "Comment"},'.
	'{"name" : "file[]","type" : "file", "multiple" : "multiple", "label" : "Attachments"}],'.
	' "action" : "'. site_url('/member/addComment') .'",'.
	' "method" : "POST",'.
	' "heading" : "Post a Comment" }';

	$userActions =
		// Form to process [Agree] button
		$this->mylibrary->escapeFunction(form_open('/member/agreeComment')) .
			//Project ID, the id of the project whose comment the member is agreeing to
			"<input type='hidden' name='projectID' value='".$id."' />" .
			// ID of the root comment where agreement should be added
			"<input type='hidden' name='rootID' value='".$rootID."' /> " .
			// User ID, the id that needs to be added to the agreements
			"<input type='hidden' name='userID' value='".$this->session->userdata("id")."' />" .
			"<input style='width: 100%;' type='submit' value='Agree' />" .
		"</form>" .
		"<input style='width: 100%;' type='button' value='Comment' onclick='openForm(". $this->mylibrary->escapeQuotes($respondComment) .")' />";
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
	'{"name" : "userID","type" : "hidden","value" : "'. $this->session->userdata("id") .'"},'.
	'{"name" : "responseType","type" : "hidden","value" : "2"},'.
	'{"name" : "commentBody","type" : "text", "label" : "Comment"},'.
	'{"name" : "file[]","type" : "file", "multiple" : "multiple", "label" : "Attachments"}],'.
	' "action" : "'. "" .'",'.
	' "method" : "POST",'.
	' "heading" : "Post a Response" }';
	$userActions =
		"<input style='width: 100%;' type='button' value='Respond' onclick='openForm(". $this->mylibrary->escapeQuotes($justRespond) .")' />";
}

?>
 		"actions" : "<?= $userActions ?>",
 		"time" : "<?= $thisComment['date'] ?>",
 		"comments" : [
 			<?php foreach($memberReplies[$rootID] as $memberReply) { ?>
 				{
 					"name" : "<?= $memberReply['name'] ?>",
 					"comment" : "<?= $memberReply['comment'] ?>",
 					"attachment" : "<?= $memberReply['attachment'] ?>",
 					"date" : "<?= $memberReply['date'] ?>"
 				},
 			<?php } ?>
 		],
 		"responses" : [
 			<?php foreach($teamReplies[$rootID] as $teamReply) { ?>
 				{
 					"name" : "<?= $teamReply['name'] ?>",
 					"comment" : "<?= $teamReply['comment'] ?>",
 					"attachment" : "<?= $teamReply['attachment'] ?>",
 					"date" : "<?= $teamReply['date'] ?>"
 				},
 			<?php } ?>
 		]
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
		  var anOpen = [];
		    var sImageUrl = "http://www.datatables.net/release-datatables/examples/examples_support/";
		     
		    var oTable = $('.commentedTable').dataTable( {
		        "bProcessing": true,
		        "sScrollY": "350px",
		        "aaData": dataSource.aaData,
		        "bPaginate": true,
		        "iDisplayLength": 5,
		        "bLengthChange": false,
		        "bInfo": false,
		        "aaSorting": [[4, 'asc']],
		        "aoColumns": [
				        {
		               "mDataProp": null,
		               "sClass": "control centered",
		               "sDefaultContent": '<img src="'+sImageUrl+'details_open.png'+'">',
		               "bSortable": false
		            },
		            { "mDataProp": "member", "bSortable": false },
		            { "mDataProp": "comment", "bSortable": false },
		            { "mDataProp": "attachment", "bSortable": false },
		            { "mDataProp": "time" },
		            { "mDataProp": "agreements", "bSortable": false },
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
			  	if(oData.responses.length) {
			      sOut += '<table cellpadding="5" cellspacing="0" border="0" >' +
			      		'<tr class="followonComment"><td colspan="4" style="font-weight: bold;">Follow On Comments</td></tr>';
			      for( thisComment in oData.comments ) {
			      	sOut += 
				      	'<tr class="followonComment">' +
				        	'<td>' + oData.comments[thisComment].name + '</td>' +
				        	'<td>' + oData.comments[thisComment].date + '</td>' +
				        	'<td>' + oData.comments[thisComment].attachment + '</td>' +
				        	'<td>' + oData.comments[thisComment].comment + '</td>' +
			        	'</tr>'	;
			      }
			  	}
		        // sOut += '</table>';
		        if(oData.responses.length) {
			        // sOut += '<table class="responseComments" cellpadding="5" cellspacing="0" border="0" >';
			        sOut += '<tr class="responseComment"><td colspan="4" style="font-weight: bold;">Responses</td></tr>';
			        for( thisComment in oData.responses ) {
			        	sOut += 
			  	      	'<tr class="responseComment">' +
			  	        	'<td>' + oData.responses[thisComment].name + '</td>' +
			  	        	'<td>' + oData.responses[thisComment].date + '</td>' +
			  	        	'<td>' + oData.responses[thisComment].attachment + '</td>' +
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
	<strong>Project Name:</strong> <?= $name ?>
</div>
<div class="gridOne spaceTop spaceBottom">
	<table class="singleRow">
		<thead>
			<tr>
				<th>Project Leader</th>
				<th>Sector</th>
				<th>Sub-Sector</th>
				<th>Geo Region</th>
				<th>Deal Size</th>
				<th>Attachments</th>
				<?php if(isset($status)) { // Echo this only if the person viewing is not a member of the project  ?> 
				<th>Status</th> 
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
				<?=  "<input type='button' value='View' />" ?>
			</td>
			<?php if(isset($status)) { // Echo this only if the person viewing is not a member of the project ?>
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
				<th>Member</th>
				<th>Comments</th>
				<th>Attachment</th>
				<th>Time</th>
				<th>Agreements</th>
				<th><?php // Actions like comment or agree ?></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<?php if(isset($status)) { // Only echo these if viewer is not a member of the project ?>
<div class="gridOne spaceTop">
	<input type="button" value="Add New Comment" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newCommentString) ?>)" /> <a href="<?= base_url() ?>member/"><input type="button" value="Back to Home"/></a>
</div>
<?php } // End of things to echo only if viewer is not a member of the project ?>
<?php if(!isset($status)) { // Only echo these if viewer is a member of the project ?>
<div class="gridOne spaceTop spaceBottom"> <strong>Update on Progress</strong>: </div>
<div class="gridOne spaceTop">
	<table class="displayOnly">
		<thead>
			<tr>
				<th>Member</th>
				<th>Update on Project</th>
				<th>Attachment</th>
				<th>Date</th>
				<th>Time</th>
				<th>Expenses</th>
				<th>Voucher</th>
				<th>Reviewed by Finance</th>
				<th>Comments</th>
			</tr>
		</thead>
		<tbody>
			<?php $temp = 15; do { ?>
			<tr>
				<td>Ben</td>
				<td>Dinner with the CEO.</td>
				<td><input type="button" value="View" /></td>
				<td>12/12/2012</td>
				<td>15:34</td>
				<td>4000</td>
				<td><input type="button" value="View" /></td>
				<td>Approved</td>
				<td><?php // Reason for status, if any ?></td>
			</tr>			
			<?php $temp--; } while($temp) ?>
		</tbody>
	</table>
</div>
<div class="gridOne spaceTop" style="text-align: right; font-weight: bold; font-size: 1.5em;">
	Total: 5000
</div>
<div class="gridTwo spaceTop">
	<input type="button" value="Add New Update" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newUpdateString) ?>)" /> <input type="button" value="Add Expenses" onClick="openForm(<?= $this->mylibrary->escapeQuotes($newExpenseString) ?>)" />
</div>
<?php } // End of things to echo only if viewer is a member of the project ?>
<div class="clear"></div>