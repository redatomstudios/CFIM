<div class="gridOne spaceTop">
	<strong>Display Criteria:</strong>
</div>
<div class="gridOne spaceTop">
	<label for="discussionDate">Discussion Date: </label>
	<input type="text" name="discussionDate" id="discussionDate" class="datePicker" />
</div>
<table>
	<tr>
		<th><?= form_label('Discussion Date', 'discussionDate') ?></th>
		<th><?= form_label('Sector', 'sector') ?></th>
		<th><?= form_label('Sub-Sector', 'subSector') ?></th>
		<th><?= form_label('Geographical Region', 'geoRegion') ?></th>
		<th><?= form_label('Status', 'status') ?></th>
	</tr>
	<tr>
		<th>
			<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'class' => 'datePicker', 'value' => 'ALL')) ?>
		</th>
		<th>
			<?= form_dropdown('sector', $sectors, '0') ?>
		</th>
		<th>
			<?= form_dropdown('subSector', $subsectors, '0') ?>
		</th>
		<th>
			<?= form_dropdown('province', $provinces, '0') ?>
		</th>
		<th>
			<?= form_dropdown('status', $status, '0') ?>
		</th>
	</tr>
	<tr>
		<td colspan="5"><input type="submit" value="Display" /></td>
	</tr>
</table>
<div class="gridOne">
	<table class="data">
		<thead>
			<tr>
				<th>Project<br />Name</th>
				<th>Project<br />Leader</th>
				<th>Sector</th>
				<th>Sub-Sector</th>
				<th>Geo Region</th>
				<th>Deal Size</th>
				<th>Discussion<br />Date</th>
				<th>Expenses<br />Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $temp = 5; do { ?>
			<tr>
				<td>Project Name</td>
				<td>Project Leader</td>
				<td>Sector</td>
				<td>Sub-Sector</td>
				<td>Geo Region</td>
				<td><?= $temp ?></td>
				<th>Discussion Date</th>
				<th>Expenses Status</th>
			</tr>
			<tr>
				<td></td>
				<td colspan="5">Comment Body</td>
				<td>Member Name</td>
				<td>Time Stamp</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="5">Comment Body</td>
				<td>Member Name</td>
				<td>Time Stamp</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="5">Comment Body</td>
				<td>Member Name</td>
				<td>Time Stamp</td>
			</tr>
			
			<?php $temp--; } while($temp) ?>
	</table>
</div>
<div class="clear"></div>