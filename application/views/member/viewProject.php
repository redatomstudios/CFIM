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
		<?php echo '<th>Status</th>'; // Echo this only if the person viewing is not a member of the project ?>
	</tr>
	<tr>
		<td>
			<?= $name ?>
		</td>
		<td>
			<?=  $sector ?>
		</td>
		<td>
			<?=  $subsector ?>
		</td>
		<td>
			<?=  $georegion ?>
		</td>
		<td>
			<?=  $dealSize ?>
		</td>
		<td>
			<?=  "<input type='button' value='Attachments' />" ?>
		</td>
		<?php // Echo this only if the person viewing is not a member of the project
		echo '<td>Status</td>';
		?>
	</tr>
</table>
<div class="gridOne">
	<table class="data">
		<thead>
			<tr>
				<th>Member</th>
				<th>Comments</th>
				<th>Attachment</th>
				<th>Date</th>
				<th>Time</th>
				<th>Agreements</th>
				<th><!-- Actions like agree or follow --></th>
			</tr>
		</thead>
		<tbody>
			<?php $temp = 5; do { ?>
			<tr>
				<td>Ben</td>
				<td>This project is good.</td>
				<td><input type="button" value="View" /></td>
				<td>12/12/2012</td>
				<td>15:34</td>
				<td>23</td>
				<td>
					<input type="button" value="Agree" /> <br />
					<input type="button" value="Follow On Comment" />
				</td>
			</tr>
			<?php // Only echo this part if there are follow on comments ?>
			<tr>
				<td colspan="7">Follow On Comments</td>
			</tr>
			<tr>
				<td>John</td>
				<td>I like this project as well.</td>
				<td></td>
				<td>12/13/2012</td>
				<td>00:24</td>
				<td>23</td>
				<td></td>
			</tr>
			<?php // End of part to echo only if there are follow on comments ?>
			
			<?php $temp--; } while($temp) ?>
	</table>
</div>
<?php // Only echo these if viewer is not a member of the project ?>
<div class="gridTwo spaceTop">
	<input type="button" value="Add New Comment"/>
</div>
<div class="gridTwo spaceTop">
	<input type="button" value="Back to Home"/>
</div>
<?php // End of things to echo only if viewer is not a member of the project ?>
<?php // Only echo these if viewer is a member of the project ?>
<div class="gridOne spaceTop spaceBottom"> Update on Progress: </div>
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