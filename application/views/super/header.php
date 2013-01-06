<!DOCTYPE html>
<html>
<head>
	<?php 
		$pageTitle = array(
			'home' => 'Home',
			'changePassword' => 'Change Password',
		);
	?>
	<meta charset="UTF-8">
	<title><?= $pageTitle[$currentPage] ?> :: Project Management System</title>
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/ui-lightness/jquery-ui-1.9.2.custom.min.css?<?= hash_file('crc32', 'resources/css/ui-lightness/jquery-ui-1.9.2.custom.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/jquery.dataTables.css?<?= hash_file('crc32', 'resources/css/jquery.dataTables.css') ?>" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/formalize.css?<?= hash_file('crc32', 'resources/css/formalize.css') ?>" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/member.css?<?= hash_file('crc32', 'resources/css/member.css') ?>" />
	<script src="<?= base_url() ?>resources/js/jquery-1.8.2.min.js?<?= hash_file('crc32', 'resources/js/jquery-1.8.2.min.js') ?>"></script>
	<script src="<?= base_url() ?>resources/js/jquery-ui-1.9.2.custom.min.js?<?= hash_file('crc32', 'resources/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>
	<script src="<?= base_url() ?>resources/js/jquery.dataTables.min.js?<?= hash_file('crc32', 'resources/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url() ?>resources/js/jquery.formalize.min.js?<?= hash_file('crc32', 'resources/js/jquery.formalize.min.js') ?>"></script>
	<script src="<?= base_url() ?>resources/js/h2o.js?<?= hash_file('crc32', 'resources/js/h2o.js') ?>"></script>
	<script>
		function getTime() {
			var dateObj = new Date(),
				hoursNow = dateObj.getHours(),
				minutesNow = dateObj.getMinutes(),
				secondsNow = dateObj.getSeconds(),
				Suffix = "AM";

				if(secondsNow < 10) {
					secondsNow = '0' + secondsNow;
				}

				if(minutesNow < 10) {
					minutesNow = '0' + minutesNow;
				}

				// if(hoursNow > 12) {
				// 	hoursNow -= 12;
				// 	Suffix = "PM";
				// }

				if(hoursNow < 10) {
					hoursNow = '0' + hoursNow;
				}

			return hoursNow + ':' + minutesNow + ':' + secondsNow;	
		}

		function getDate() {
			var Months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
			var dateObj = new Date(),
				yearsNow = dateObj.getFullYear(),
				monthsNow = Months[dateObj.getMonth()],
				daysNow = dateObj.getDate();

				if(monthsNow < 10) {
					monthsNow = '0' + monthsNow;
				}

				if(daysNow < 10) {
					daysNow = '0' + daysNow;
				}

			return monthsNow + ' ' + daysNow + ', ' + yearsNow;		
		}

		function updateHUD() {
			$('span#dateDisplay').html(getDate());
			$('span#timeDisplay').html(getTime());
		}

		jQuery(document).ready(function($) {
			updateHUD();
			setInterval('updateHUD()', 1000);
		});
	</script>
</head>
<body>
	<header>
		<div id="username" class="spaceBottom">Username: <?php echo $username; ?></div> <div id="dateTime"><span id="dateDisplay" class="spaceBottom">12/12/2012</span> <span id="timeDisplay">12:12 AM</span></div>
		<div class="clear"></div>
		<nav>
			<ul>
				<li<?= $currentPage == 'home' ? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>supervisor">Home</li>
				<li<?= $currentPage == 'changePassword' 	? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>supervisor/changePassword">Change Password</li>
				<li><a href="<?= base_url() ?>home/logout">Logout</a></li>
			</ul>
			<div class="clear"></div>
		</nav>
	</header>
	<div class="bodyContent">
