<div class="bodyContent">
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
				<?php $temp = 51; do { ?>
				<tr>
					<td>Project Name</td>
					<td>Project Leader</td>
					<td>Sector</td>
					<td>Sub-Sector</td>
					<td>Geo Region</td>
					<td><?= $temp ?></td>
				</tr>
				<?php $temp--; } while($temp) ?>
		</table>
	</div>
</div>
<div class="clear"></div>