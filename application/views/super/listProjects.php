
<?= form_open('/supervisor') ?>
<div class="gridOne spaceTop small centered">
	<table class="singleRow">
		<thead>
			<tr>
				<th>Project Leader</th>
				<th>Project Member</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?= form_dropdown('leader', $members, 0) ?></td>
				<td><?= form_dropdown('member', $members, 0) ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="gridOne small">
	<table class="singleRow">
		<thead>
			<tr>
				<th>Discussion Date</th>
				<th>Sector</th>
				<th>Sub-Sector</th>
				<th>Geo Region</th>
				<th>Status</th> 
			</tr>
		</thead>
		<tr>
			<td>
				<?= form_input(array('name' => 'discussionDate', 'class' => 'datePicker', 'style' => 'width: 100%;')) ?>
			</td>
			<td>
				<?= form_dropdown('sector', $sectors, (isset($something) ? $something : '0'), 'style="width: 100%;"') ?>
			</td>
			<td>
				<?php
				// Remove the colon from the names
				foreach($subsectors as $index => $thisSubsector) {
					$thisSubsector = explode(':', $thisSubsector);
					if(isset($thisSubsector[0]) && strlen($thisSubsector[0])) {
						$subsectors[$index] = $thisSubsector[0];
					}
				}
				?>
				<?= form_dropdown('subsector', $subsectors, (isset($something) ? $something : '0'), 'style="width: 100%;"') ?>
			</td>
			<td>
				<?= form_dropdown('province', $provinces, (isset($something) ? $something : '0'), 'style="width: 100%;"') ?>
			</td>
			<td>
				<?= form_dropdown('status', $status, (isset($something) ? $something : '0'), 'style="width: 100%;"') ?>
			</td>
		</tr>
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
												'name': '<?= anchor("/supervisor/viewProject/".$project["id"], $project["projectName"]) ?>',
												'leader': '<?= $project["projectLeader"] ?>',
												'sector': '<?= $project["sector"] ?>',
												'subsector': '<?= $project["subSector"] ?>',
												'region': '<?= $project["geoRegion"] ?>',
												'dealSize': '<?= $project["dealSize"] ?>',
												'discussionDate': '<?= $project["date"] ?>',
												'status': '<?= $project["status"] ?>',
												"comments": [
												<?php  foreach ($project['comments'] as $comment) { ?>
													{
														"name" : "<?= $this->membersModel->getName($comment['memberId']) ?>",
														"comment" : "<?= $comment['body'] ?>",
														"date" : "<?= $comment['timestamp'] ?>"
													},
													<?php }  ?>
												],
												'expenses': '<?= $project["expenses"] ?>'
											},
											
										<?php } ?>
										] }
	// Code for proper display of comments in member accounts
		jQuery(document).ready(function($) {
		  var anOpen = [];
		    var sImageUrl = "http://www.datatables.net/release-datatables/examples/examples_support/";
		     
		    var oTable = $('.commentedTable').dataTable( {
		        "bProcessing": true,
		        "sScrollY": "350px",
		        "aaData": dataSource.aaData,
		        "bPaginate": false,
		        "aoColumns": [
		            { "mDataProp": "name", "sClass": "control" },
		            { "mDataProp": "leader" },
		            { "mDataProp": "sector" },
		            { "mDataProp": "subsector" },
		            { "mDataProp": "region" },
		            { "mDataProp": "dealSize" },
		            { "mDataProp": "discussionDate" },
		            { "mDataProp": "expenses" }
		        ]
		    } );

		    // $('#commentedTable td.control').live( 'ready', function () {
		    $('.commentedTable td.control').each(function () {
			  var nTr = this.parentNode;
			  var i = $.inArray( nTr, anOpen );
			   
			  if ( i === -1 ) {
			    var nDetailsRow = oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'comments' );
			    $('div.innerDetails', nDetailsRow).slideDown();
			    anOpen.push( nTr );
			  }
			  else {
			    $('div.innerDetails', $(nTr).next()[0]).slideUp( function () {
			      oTable.fnClose( nTr );
			      anOpen.splice( i, 1 );
			    } );
			  }
			} );
			 
			function fnFormatDetails( oTable, nTr )
			{
			  var oData = oTable.fnGetData( nTr );
			  var sOut =
			    '<div class="innerDetails">'+
			      '<table cellpadding="5" cellspacing="0" border="0">';
			      for( thisComment in oData.comments ) {
			      	sOut += 
				      	'<tr>' +
				        	'<td>'+oData.comments[thisComment].name+'</td>' +
				        	'<td>'+oData.comments[thisComment].comment+'</td>' +
				        	'<td>'+oData.comments[thisComment].date+'</td>' +
			        	'</tr>'	;
			      }
			      sOut += 
				      '</table>'+
				    '</div>';
			  return sOut;
			}
		} );
</script>
<div class="gridOne spaceTop">
	<table cellpadding="0" cellspacing="0" border="0" class="display commentedTable">
	    <thead>
	        <tr>
	            <th>Name</th>
	            <th>Leader</th>
	            <th>Sector</th>
	            <th>Sub-Sector</th>
	            <th>Region</th>
	            <th>Deal Size</th>
	            <th>Discussion Date</th>
	            <th>Expenses</th>
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