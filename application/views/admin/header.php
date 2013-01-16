<!DOCTYPE html>
<html>
<head>
	<?php 
		$pageTitle = array(
			'home' => 'Home',
			'newProject' => 'Add New Project',
			'modProject' => 'Modify Existing Project',
			'newMember' => 'Add New Member',
			'modMember' => 'Modify Existing Member',
			'stats' => 'Statistics'
		);
	?>
	<meta charset="UTF-8">
	<title><?= $pageTitle[$currentPage] ?> :: Project Management System</title>
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/ui-lightness/jquery-ui-1.9.2.custom.min.css?<?= hash_file('crc32', 'resources/css/ui-lightness/jquery-ui-1.9.2.custom.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/jquery.dataTables.css?<?= hash_file('crc32', 'resources/css/jquery.dataTables.css') ?>" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/formalize.css?<?= hash_file('crc32', 'resources/css/formalize.css') ?>" />
	<link rel="stylesheet" href="<?= base_url() ?>resources/css/admin.css?<?= hash_file('crc32', 'resources/css/admin.css') ?>" />
	<script src="<?= base_url() ?>resources/js/jquery-1.8.2.min.js?<?= hash_file('crc32', 'resources/js/jquery-1.8.2.min.js') ?>"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js?<?= hash_file('crc32', 'resources/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>
	<script src="<?= base_url() ?>resources/js/jquery.dataTables.min.js?<?= hash_file('crc32', 'resources/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url() ?>resources/js/jquery.formalize.min.js?<?= hash_file('crc32', 'resources/js/formalize.js') ?>"></script>
	<script src="<?= base_url() ?>resources/js/h2o.js?<?= hash_file('crc32', 'resources/js/h2o.js') ?>"></script>
	<!-- <meta name="google-translate-customization" content="c687adb6b162280b-7cfff027f1a5cb95-g5a9fe98f4ea6c679-10"></meta> -->
</head>
<body>
	<header>
<!-- 		<div id="dateTime">
			<div id="google_translate_element"></div><script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false, multilanguagePage: true}, 'google_translate_element');
			}
			</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		</div> -->
		<div class="clear"></div>
		<nav>
			<ul>
				<li<?= $currentPage == 'home' 		? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin"><span class="lg-en">Home</span><span class="lg-cn">&#20027;&#39029;</span></a></li>
				<li<?= $currentPage == 'newProject' ? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/addProject"><span class="lg-en">Add New Project</span><span class="lg-cn">&#26032;&#22686;&#39033;&#30446;</span></li>
				<li<?= $currentPage == 'modProject' ? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/editProject"><span class="lg-en">Modify Existing Project</span><span class="lg-cn">&#20462;&#25913;&#39033;&#30446;</span></a></li>
				<li<?= $currentPage == 'newMember' 	? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/addMember"><span class="lg-en">Add New Member</span><span class="lg-cn">&#26032;&#22686;&#25104;&#21592;</span></a></li>
				<li<?= $currentPage == 'modMember' 	? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/editMember"><span class="lg-en">Modify Current Member</span><span class="lg-cn">&#20462;&#25913;&#25104;&#21592;</span></a></li>
				<li<?= $currentPage == 'stats' 		? ' class="currentPage"' : '' ?>><a href="<?= base_url() ?>admin/statistics"><span class="lg-en">Statistics</span><span class="lg-cn">&#32479;&#35745;&#25968;&#23383;</span></a></li>
				<li><a href="<?= base_url() ?>home/logout"><span class="lg-en">Logout</span><span class="lg-cn">&#36864;&#20986;</span></a></li>
			</ul>
			<div class="clear"></div>
		</nav>
	</header>
	<div class="bodyContent">