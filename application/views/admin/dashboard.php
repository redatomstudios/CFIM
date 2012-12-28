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