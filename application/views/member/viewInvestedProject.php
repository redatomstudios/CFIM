<div class="gridOne spaceTop">
	<strong>Project Name:</strong> <?php // Echo project name here ?>
</div>
<div class="gridOne spaceTop">
	<label for="discussionDate">Discussion Date: </label>
	<input type="text" name="discussionDate" id="discussionDate" class="datePicker" />
</div>
<table>
	<tr>
		<th>Project Leader</th>
		<th>Sector</th>
		<th>Sub-Sector</th>
		<th>Geo Region</th>
		<th>Deal Size</th>
		<th>Attachments</th>
	</tr>
	<tr>
		<td>
			<?=  "Project Leader"; ?>
		</td>
		<td>
			<?=  "Sector"; ?>
		</td>
		<td>
			<?=  "Sub-Sector" ?>
		</td>
		<td>
			<?=  "Geo Region" ?>
		</td>
		<td>
			<?=  "Deal Size" ?>
		</td>
		<td>
			<?=  "<input type='button' value='Attachments' />" ?>
		</td>
	</tr>
</table>
<div class="gridOne spaceTop">
	<table class="data">
		<thead>
			<tr>
				<th>Member</th>
				<th>Update on Project</th>
				<th>Attachment</th>
				<th>Date</th>
				<th>Time</th>
				<th>Expenses</th>
				<th>Voucher</th>
				<th colspan="2">Reviewed by Finance</th>
			</tr>
		</thead>
		<tbody>
			<?php $temp = 5; do { ?>
			<tr>
				<td>Ben</td>
				<td>Dinner with the CEO.</td>
				<td><input type="button" value="View" /></td>
				<td>12/12/2012</td>
				<td>15:34</td>
				<td>4000</td>
				<td>*</td>
				<td>Approved</td>
				<td><?php // Reason for status, if any ?></td>
			</tr>			
			<?php $temp--; } while($temp) ?>
	</table>
</div>
<div class="gridOne">
	Total: 5000
</div>
<div class="gridTwo spaceTop">
	<input type="button" value="Add New Update"/>
</div>
<div class="gridTwo spaceTop">
	<input type="button" value="Add Expenses"/>
</div>
<div class="clear"></div>