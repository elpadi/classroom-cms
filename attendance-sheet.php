<?php
require 'bootstrap.php';
if (!empty($_POST)):
	$db->takeAttendance();
	header("Location: $_SERVER[PHP_SELF]");	
else:
?><!doctype html>
<html lang="en">
	<head>
		<title>Attendance Sheet</title>
		<?php include 'views/styles.php'; ?>
	</head>
	<body><?php
		include(empty($_GET) ? 'views/attendance-selector.php' : 'views/attendance-form.php');
		include 'views/scripts.php';
	?></body>
</html><?php endif;
