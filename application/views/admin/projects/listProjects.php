<div class="gridOne spaceTop">
	<strong>Display Criteria:</strong>
</div>
<?php if(isset($dates)) { ?>
<div class="gridOne spaceTop">

	<span class="lg-en"><?= form_label('Discussion Date:', 'discussionDate') ?></span>
	<span class="lg-cn"><?= form_label('&#35752;&#35770;&#26085;&#26399;:', 'discussionDate') ?></span>
	<?= form_dropdown('discussionDate', $dates, (isset($_POST['discussionDate']) ? $_POST['discussionDate'] : '' )) ?>
	<!-- <input type="text" name="discussionDate" id="discussionDate" class="datePicker" /> -->
</div>
<?php } ?>
<table>
	<tr>
		<th>
			<span class="lg-en"><?= form_label('Discussion Date', 'discussionDate') ?></span>
			<span class="lg-cn"><?= form_label('&#35752;&#35770;&#26085;&#26399;', 'discussionDate') ?></span>
		</th>
		<th>
			<span class="lg-en"><?= form_label('Sector', 'sector') ?></span>
			<span class="lg-cn"><?= form_label('&#20027;&#35201;&#20998;&#31867;', 'sector') ?></span>
		</th>
		<th>
			<span class="lg-en"><?= form_label('Sub-Sector', 'subSector') ?></span>
			<span class="lg-cn"><?= form_label('&#19979;&#35774;&#20998;&#31867;', 'subSector') ?></span>
		</th>
		<th>
			<span class="lg-en"><?= form_label('Geographical Region', 'geoRegion') ?></span>
			<span class="lg-cn"><?= form_label('&#30465;', 'geoRegion') ?></span>
		</th>
		<th>
			<span class="lg-en"><?= form_label('Status', 'status') ?></span>
			<span class="lg-cn"><?= form_label('&#39033;&#30446;&#36827;&#31243;', 'status') ?></span>
		</th>
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
<?php if($memberProjects != FALSE) { ?>
<div class="gridOne">
	<table class="data">
		<thead>
			<tr>
				<th>
					<span class="lg-en">Project<br />Name</span>
					<span class="lg-cn">&#39033;&#30446;&#20195;&#21495;</span>
				</th>
				<th>
					<span class="lg-en">Project<br />Leader</span>
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
				<th>
					<span class="lg-en">Discussion<br />Date</span>
					<span class="lg-cn">&#35752;&#35770;&#26085;&#26399;</span>
				</th>
				<th>
					<span class="lg-en">Expenses<br />Status</span>
					<span class="lg-cn">Expenses<br />Status</span>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($memberProjects as $project) {
			 ?>
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
			
			
			<?php  } ?>
	</table>
</div>
<?php } ?>
<div class="clear"></div>