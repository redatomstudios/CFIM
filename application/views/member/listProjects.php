<?php if(isset($dates) && $currentPage != 'investedProjects') { ?>
<div class="gridOne spaceTop">
<?= form_open('member/index') ?>
	<span class="lg-en"><label for="discussionDate">Discussion Date: </label></span>
	<span class="lg-cn"><label for="discussionDate">&#35752;&#35770;&#26085;&#26399;: </label></span>
	<?= form_dropdown('discussionDate', $dates, (isset($_POST['discussionDate']) ? $_POST['discussionDate'] : '' )) ?>
	<!-- <input type="text" name="discussionDate" id="discussionDate" class="datePicker" /> -->
	<span class="lg-en">
		<input type="submit" value="Filter" />
		<?= anchor('/member', '<input type="button" value="All" />') ?>
	</span>
	<span class="lg-cn">
		<input type="submit" value="&#25628;&#23547;" />
		<?= anchor('/member', '<input type="button" value="&#20840;&#37096;" />') ?>
	</span>
<?= form_close() ?>
</div>
<?php } else if ( $currentPage == 'investedProjects' ) { ?>

<?php } else { ?>
<?= form_open('member/myProjects') ?>
<div class="gridOne spaceTop">
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
				<?= form_input(array('name' => 'discussionDate', 'class' => 'datePicker', 'style' => 'width: 100%;')) ?>
			</td>
			<td>
				<?= form_dropdown('sector', $sectors, (isset($something) ? $something : '0'), 'style="width: 100%;"') ?>
			</td>
			<td>
				<?php 
					$subsectorNames = array();
					foreach( $subsectors as $index => $thisSubsector ) {
						$thisSubsector = explode(':', $thisSubsector);
						$subsectorNames[$index] = $thisSubsector[0];
					}
				?>
				<?= form_dropdown('subsector', $subsectorNames, (isset($something) ? $something : '0'), 'style="width: 100%;"') ?>
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
<?php } ?>

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
												'name': '<?= anchor("/member/viewProject/".$project["id"], $project["projectName"]) ?>',
												'leader': '<?= $project["projectLeader"] ?>',
												'sector': '<?= $project["sector"] ?>',
												'subsector': '<?= $project["subSector"] ?>',
												'region': '<?= $project["geoRegion"] ?>',
												'dealSize': '<?= $project["dealSize"] ?>',
												<?php if($currentPage == 'myProjects') { ?> 'discussionDate': '<?= $project["date"] ?>',<?php } ?>
												'status': '<?= $project["status"] ?>',
												"comments": [
												<?php  foreach ($project['comments'] as $comment) { ?>
													{
														"name" : "<?= $this->membersModel->getName($comment['memberId']) ?>",
														"comment" : "<?= $comment['body'] ?>",
														"date" : "<?= $comment['timestamp'] ?>"
													},
													<?php }  ?>
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
		        "aaData": dataSource.aaData,<?php if(isset($currentPage) && $currentPage == 'investedProjects') { ?>
		        "aaSorting": [],
		        <?php } ?>"bPaginate": false,
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
	            	<span class="lg-en">Status</span>
	            	<span class="lg-cn">&#39033;&#30446;&#36827;&#31243;</span>
	            </th>
	        </tr>
	    </thead>
	    <tbody></tbody>
	</table>
</div>
<div class="clear"></div>
<?php } else { ?> 
<div class="gridOne spaceTop centered" style="font-size: 1.3em;">
	No projects matching criteria
</div>
<?php } ?>