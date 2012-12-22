<div class="bodyContent">
	<div class="gridOne spaceTop spaceBottom">
		<p>The following projects meet your search criteria:</p>
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
					<th>Discussion<br />Date</th>
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
					<td><?= $temp*10 ?></td>
				</tr>
				<?php $temp--; } while($temp) ?>
		</table>
	</div>
</div>
<div class="clear"></div>