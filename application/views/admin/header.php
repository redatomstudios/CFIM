<!DOCTYPE html>
<html>
<head>
	<title>Random Header</title>
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/ui-lightness/jquery-ui-1.9.2.custom.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/jquery.dataTables.css" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/main.css" />
	<script src="<?= base_url() ?>resources/js/jquery-1.8.2.min.js"></script>
	<script src="<?= base_url() ?>resources/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="<?= base_url() ?>resources/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>resources/js/h2o.js"></script>
</head>
<body>
	<header>
		<nav>
			<ul>
				<li<?= $currentPage == 'home' 		? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin">Home</a></li>
				<li<?= $currentPage == 'newProject' ? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/addProject">Add New Project</li>
				<li<?= $currentPage == 'modProject' ? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>">Modify Existing Project</a></li>
				<li<?= $currentPage == 'newMember' 	? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/addMember">Add New Member</a></li>
				<li<?= $currentPage == 'modMember' 	? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/editMember">Modify Current Member</a></li>
				<li<?= $currentPage == 'stats' 		? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>">Statistics</a></li>
				<li><a href="">Logout</a></li>
			</ul>
			<div class="clear"></div>
		</nav>
	</header>