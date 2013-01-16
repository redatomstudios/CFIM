<?php if(isset($dates) && sizeof($dates)) { ?>
<div class="gridOne spaceTop">
<?= form_open('admin/index') ?>
	<label for="discussionDate"><span class="lg-en">Discussion Date</span><span class="lg-cn">&#35752;&#35770;&#26085;&#26399;</span>: </label>
	<?= form_dropdown('discussionDate', $dates, (isset($_POST['discussionDate']) ? $_POST['discussionDate'] : '' )) ?>
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
				<th>
					<span class="lg-en">Project Name</span>
					<span class="lg-cn">&#39033;&#30446;&#20195;&#21495;</span>
				</th>
				<th>
					<span class="lg-en">Project Leader</span>
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
					<span class="lg-en">Geo Region</span>
					<span class="lg-cn">&#30465;</span>
				</th>
				<th>
					<span class="lg-en">Deal Size</span>
					<span class="lg-cn">&#39033;&#30446;&#37329;</span>
				</th>
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