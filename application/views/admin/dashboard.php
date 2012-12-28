<div class="gridOne spaceTop">
	<label for="meetingDate">Meeting Date: </label><select name="meetingDate" id="meetingDate">
		<option selected="selected">ALL</option>
		<option>Option 2</option>
		<option>Option 3</option>
		<option>Option 4</option>
		<option>Option 5</option>
		<option>Option 6</option>
	</select>
</div>
<div class="gridOne spaceTop">
	<strong>Projects for Discussion:</strong>
</div>
<?php if($memberProjects != FALSE) { ?>
<div class="gridOne">
	<table class="data">
		<thead>
			<tr>
				<th>Project Name</th>
				<th>Project Leader</th>
				<th>Sector</th>
				<th>Sub-Sector</th>
				<th>Geo Region</th>
				<th>Deal Size</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($memberProjects as $project) {	 ?>
			<tr>
				<td><?= $project['projectName'] ?></td>
				<td><?= $project['projectLeader'] ?></td>
				<td><?= $project['sector'] ?></td>
				<td><?= $project['subSector'] ?></td>
				<td><?= $project['geoRegion'] ?></td>
				<td><?= $project['dealSize'] ?></td>
			</tr>
			<?php  } ?>
	</table>
</div>
<?php } ?>
<div class="clear"></div>