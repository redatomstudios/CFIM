	</div> <!-- End of bodyContent -->
<?php if(isset($_GET['n'])) { ?>
<script>
jQuery(document).ready(function($){
	// NOTIFICATIONS: format is MESSAGE|TYPE
	// USE ; TO DELIMIT MULTIPLE MESSAGE. I.E.:
	// MESSAGE1|TYPE;MESSAGE2|TYPE;etc.
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