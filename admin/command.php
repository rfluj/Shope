
<?php require_once "../configs/config.php" ?>

<?php
	if (!isset($_SESSION['admin']) or (!$_SESSION['admin'])) {
		header('location: ./admin.php');
		exit();
	}
?>

<html>
<head>
	<title>users</title>
	<link rel="stylesheet" href="../styles/style_log.css">
</head>
<body>
	<div class="main">
		<h1>Commands</h1>
	</div>
</body>
</html>