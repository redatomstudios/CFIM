<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
		body {
			padding: 0;
			margin: 0;
			background: #FFF;
		}

		body > div {
			width: 300px;
			height: 220px;
			text-align: center;
			margin: auto;
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
		}

		input {
			outline: none;
		}

		input[type='text'], input[type='password'] {
			width: 80%;
			line-height: 44px;
			height: 44px;
			font-size: 16px;
			background: #FFF;
			border: solid thin #999;
			border-radius: 5px;
			/*box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.5);*/
			margin: 5px 0;
			padding: 0 5%;
		}

		input[type='submit'] {
			width: 40%;
			float: right;
			font-size: 1.2em;
			line-height: 40px;
			margin-top: 6px;
			color: white;
			border: #169DD8 solid 1px!important;
			cursor: pointer;
			border-radius: 5px;
			text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.25);
			background: #14D3F0;
			background: -moz-linear-gradient(top,#14D3F0 0,#0AB1E0 51%,#09A5DB 52%,#0084C9 100%);
			background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#14D3F0),color-stop(51%,#0AB1E0),color-stop(52%,#09A5DB),color-stop(100%,#0084C9));
			background: -webkit-linear-gradient(top,#14D3F0 0,#0AB1E0 51%,#09A5DB 52%,#0084C9 100%);
			background: -o-linear-gradient(top,#14D3F0 0,#0AB1E0 51%,#09A5DB 52%,#0084C9 100%);
			background: -ms-linear-gradient(top,#14D3F0 0,#0AB1E0 51%,#09A5DB 52%,#0084C9 100%);
			background: linear-gradient(top,#14D3F0 0,#0AB1E0 51%,#09A5DB 52%,#0084C9 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#14d3f0',endColorstr='#0084c9',GradientType=0);
		}

		input[type="submit"]:hover {
			background: #1A99DC;
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5adbf7',endColorstr='#1a99dc');
			background: -webkit-gradient(linear,left top,left bottom,from(#5ADBF7),to(#1A99DC));
			background: -moz-linear-gradient(top,#5ADBF7,#1A99DC);
		}

		/* Notification Styles */
		div#notifier {
			position: fixed;
			top: 0;
			width: 100%;
			margin: 0;
			line-height: 2em;
			text-align: center;
			font-size: 1em;
			font-weight: bold;
			font-family: Arial, Verdana, sans-serif;
		}

		div.notification, div.alert {
			background: #4A4;
			width: 100%;
			height: 0;
			overflow: hidden;
			border-bottom: solid thin rgba(0, 0, 0, 0.3);
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
			text-shadow: 0 1px 1px rgba(255, 255, 255, 0.2);
			cursor: pointer;
			color: #FFF;
		}

		div.alert {
			background: #A22;
			color: #FFF;
			text-shadow: 0 1px 1px #000;
		}

		div.notification:hover, div.alert:hover {
			opacity: 0.9;
		}
	</style>
	<link href="<?= base_url() ?>resources/css/formalize.css" />
	<script src="<?= base_url() ?>resources/js/jquery-1.8.2.min.js"></script>
	<script src="<?= base_url() ?>resources/js/notify.js"></script>
	<script src="<?= base_url() ?>resources/js/jquery.formalize.min.js"></script>
</head>
<body>
<div>
<?php
echo form_open('login/doLogin');
echo form_input(array('name' => 'username', 'id' => 'username', 'placeholder' => 'Username'));
echo form_input(array('name' => 'password', 'id' => 'password', 'type' => 'password', 'placeholder' => '*****'));
echo $cap;
echo form_input(array('name' => 'captcha', 'id' => 'captcha', 'placeholder' => 'Enter CAPTCHA', 'style' => 'width: 45%; float: left;'));
echo form_submit('submission','Submit');
form_close();
 ?>
</div>
<?php if(isset($_GET['n'])) { ?>
<script>
jQuery(document).ready(function($){
	// NOTIFICATIONS: format is MESSAGE^TYPE
	// USE ; TO DELIMIT MULTIPLE MESSAGE. I.E.:
	// MESSAGE1^TYPE;MESSAGE2^TYPE;etc.
<?php 
	$notifications = explode(';', $_GET['n']);
	foreach($notifications as $message) {
		$message = explode('|', $message);
		echo 'stackNotify("'.$message[0].'", '.(sizeof($message) == 2 ? $message[1] : 0).');
'; // Populate the message stack
	}
?>
openNotification(); // Fire notification system, and BOOM!
});
</script>
<?php } ?>
</body>
</html>