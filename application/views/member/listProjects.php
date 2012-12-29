<div class="gridOne spaceTop">
	<strong>Display Criteria:</strong>
</div>

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


<!-- <table>
	<thead>
		<tr>
			<th><?= form_label('Discussion Date', 'discussionDate') ?></th>
			<th><?= form_label('Sector', 'sector') ?></th>
			<th><?= form_label('Sub-Sector', 'subSector') ?></th>
			<th><?= form_label('Geographical Region', 'geoRegion') ?></th>
			<th><?= form_label('Status', 'status') ?></th>
		</tr>
	</thead>
	<tr>
		<td style="text-align: center;">
			<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'class' => 'datePicker', 'value' => 'ALL', 'style' => 'width: 90%;' )) ?>
		</td>
		<td style="text-align: center;">
			<?= form_dropdown('sector', $sectors, '0', 'style="width: 90%;"') ?>
		</td>
		<td style="text-align: center;">
			<?= form_dropdown('subSector', $subsectors, '0', 'style="width: 90%;"') ?>
		</td>
		<td style="text-align: center;">
			<?= form_dropdown('province', $provinces, '0', 'style="width: 90%;"') ?>
		</td>
		<td style="text-align: center;">
			<?= form_dropdown('status', $status, '0', 'style="width: 90%;"') ?>
		</td>
	</tr>
	<tr>
		<td colspan="5" style="text-align: center;"><input type="submit" value="Display" /></td>
	</tr>
</table> -->


<?php if(isset($memberProjects) && ($memberProjects != FALSE)) { ?>
<div class="gridOne spaceTop">
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
		<?php foreach ($memberProjects as $project) { ?>
			<tr>
				<td><?= anchor('/member/viewProject/'.$project['id'], $project['projectName']) ?></td>
				<td><?= $project['projectLeader'] ?></td>
				<td><?= $project['sector'] ?></td>
				<td><?= $project['subSector'] ?></td>
				<td><?= $project['geoRegion'] ?></td>
				<td><?= $project['dealSize'] ?></td>
				<td><?= $project['date'] ?></td>
				<td><?= $project['status'] ?></td>
			</tr>
			<?php foreach ($project['comments'] as $comment) { ?>
			<tr>
				<td></td>
				<td colspan="5"><?= $comment['body'] ?></td>
				<td><?= $this->membersModel->getName($comment['memberId']) ?></td>
				<td><?= $comment['timestamp'] ?></td>
			</tr>
			<?php } ?>
			
			
		<?php  } ?>
		</tbody>
	</table>
</div>
<?php } ?>
<div class="clear"></div>