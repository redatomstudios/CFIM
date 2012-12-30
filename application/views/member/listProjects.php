<?php if(isset($dates)) { ?>
<div class="gridOne spaceTop">
<?= form_open('member/index') ?>
	<label for="discussionDate">Discussion Date: </label>
	<?= form_dropdown('discussionDate', $dates, 0) ?>
	<!-- <input type="text" name="discussionDate" id="discussionDate" class="datePicker" /> -->
	<?= form_submit('submission', 'Filter') ?>
	<?= anchor('/member', '<input type="button" value="All">') ?>
<?= form_close() ?>
</div>
<?php } ?>

<?php if(isset($memberProjects) && ($memberProjects != FALSE)) { ?>
<style>
	div.innerDetails { display: none }
</style>
<script>
	var dataSource = 	{ "aaData": [
										<?php foreach ($memberProjects as $project) { ?>
											{
												'name': '<?= anchor("/member/viewProject/".$project["id"], $project["projectName"]) ?>',
												'leader': '<?= $project["projectLeader"] ?>',
												'sector': '<?= $project["sector"] ?>',
												'subsector': '<?= $project["subSector"] ?>',
												'region': '<?= $project["geoRegion"] ?>',
												'dealSize': '<?= $project["dealSize"] ?>',
												'status': '<?= $project["status"] ?>',
												"comments": [
												<?php foreach ($project['comments'] as $comment) { ?>
													{
														"name" : "<?= $this->membersModel->getName($comment['memberId']) ?>",
														"comment" : "<?= $comment['body'] ?>",
														"date" : "<?= $comment['timestamp'] ?>"
													},
													<?php } ?>
												]
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
		            { "mDataProp": "status" }
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
			      '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width: 100%">';
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
	            <th>Status</th>
	        </tr>
	    </thead>
	    <tbody></tbody>
	</table>
</div>
<?php } ?>
<div class="clear"></div>