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
	</style>
	<link href="<?= base_url() ?>resources/css/formalize.css" />
	<script src="<?= base_url() ?>resources/js/jquery-1.8.2.min.js"></script>
	<script src="<?= base_url() ?>resources/js/jquery.formalize.min.js"></script>
	<script>
		// jQuery(document).ready(function($){
		// // $.each($('input[type="text"], input[type="password"]'), function(){
		// // 		if(this.attributes['data-hint']) {
		// // 			this.value = this.attributes['data-hint'].value;
		// // 			this.style.color = "rgba(0, 0, 0, 0.3)";
		// // 		}
		// // 	});

		// 	$('input[type="text"], input[type="password"]').each(function(){
		// 		if($(this).attr('data-hint')) {
		// 			$(this).val($(this).attr('data-hint'));
		// 			this.style.color = "rgba(0, 0, 0, 0.3)";
		// 		}
		// 	}).focus(function(){
		// 		if(this.attributes['data-hint']) {
		// 			if(this.value == this.attributes['data-hint'].value) {
		// 				this.value = "";
		// 				this.style.color = "#000";
		// 			}
		// 		}
		// 	}).blur(function(){
		// 		if(this.value == '') {
		// 			if(this.attributes['data-hint']) {
		// 				this.value = this.attributes['data-hint'].value;
		// 				this.style.color = "rgba(0, 0, 0, 0.3)";
		// 			}
		// 		}
		// 	});
		// });
	</script>
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
</body>
</html>