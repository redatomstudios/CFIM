<?php if(isset($dates) && sizeof($dates)) { ?>
<div class="gridOne spaceTop">
<?= form_open('admin/index') ?>
	<label for="discussionDate">Discussion Date: </label>
	<?= form_dropdown('discussionDate', $dates, 0) ?>
	<!-- <input type="text" name="discussionDate" id="discussionDate" class="datePicker" /> -->
	<?= form_submit('submission', 'Filter') ?>
	<?= anchor('/admin/index', '<input type="button" value="All">') ?>
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
				<td><?= ((isset($edit))?(anchor('/admin/editProject/'.$project['id'], $project['projectName'])):$project['projectName']) ?></td>
				<td><?= $project['projectLeader'] ?></td>
				<td><?= $project['sector'] ?></td>
				<td><?= $project['subSector'] ?></td>
				<td><?= $project['geoRegion'] ?></td>
				<td><?= $project['dealSize'] ?></td>
			</tr>
			<?php  } ?>
	</table>
</div>
<?php } else { ?>
<div class="gridOne centered spaceTop">
	No projects to list
</div>
<?php } ?>
<div class="clear"></div>