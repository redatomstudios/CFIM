
<?= form_open('/supervisor') ?>
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
				<th>
					<span class="lg-en">Discussion Date</span>
					<span class="lg-cn">&#35752;&#35770;&#26085;&#26399;</span>
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
					<span class="lg-en">Status</span>
					<span class="lg-cn">&#39033;&#30446;&#36827;&#31243;</span>
				</th> 
			</tr>
		</thead>
		<tr>
			<td>
				<?= form_input(array('name' => 'discussionDate', 'class' => 'datePicker extended', 'style' => 'width: 100%;')) ?>
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
	<span class="lg-en"><button type="submit">Display</button></span>
	<span class="lg-cn"><button type="submit">&#25552;&#20132;</button></span>
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
	            <th>
	            	<span class="lg-en">Name</span>
	            	<span class="lg-cn">&#39033;&#30446;&#20195;&#21495;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Leader</span>
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
	            	<span class="lg-en">Region</span>
	            	<span class="lg-cn">&#30465;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Deal Size</span>
	            	<span class="lg-cn">&#39033;&#30446;&#37329;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Discussion Date</span>
	            	<span class="lg-cn">&#35752;&#35770;&#26085;&#26399;</span>
	            </th>
	            <th>
	            	<span class="lg-en">Expenses</span>
	            	<span class="lg-cn">&#36153;&#29992;</span>
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