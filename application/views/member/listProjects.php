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
		<td>
			<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'class' => 'datePicker', 'value' => 'ALL')) ?>
		</td>
		<td>
			<?= form_dropdown('sector', $sectors, '0') ?>
		</td>
		<td>
			<?= form_dropdown('subSector', $subsectors, '0') ?>
		</td>
		<td>
			<?= form_dropdown('province', $provinces, '0') ?>
		</td>
		<td>
			<?= form_dropdown('status', $status, '0') ?>
		</td>
	</tr>
	<tr>
		<td colspan="5"><input type="submit" value="Display" /></td>
	</tr>
</table>
<?php if(isset($memberProjects)) { ?>
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
				<td>Discussion<br />Date</td>
				<td>Expenses<br />Status</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($memberProjects as $project) { ?>
			<tr>
				<td><?= anchor('/member/viewProject/'.$project['id'], $project['projectName']) ?></td>
				<td><?= $project['projectLeader'] ?></td>
				<td><?= $project['sector'] ?></td>
				<td><?= $project['subSector'] ?></td>
				<td><?= $project['geoRegion'] ?></td>
				<td><?= $project['dealSize'] ?></td>
				<th><?= $project['date'] ?></th>
				<th><?= $project['status'] ?></th>
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
			
			<?php  } ?>
	</table>
</div>
<?php } ?>
<div class="clear"></div>