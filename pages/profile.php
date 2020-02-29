
<?php require_once '../configs/config.php' ?>

<?php
	if (!(isset($_SESSION['logged']))) {
		header('location: ./login.php');
		exit();
	} elseif (!($_SESSION['logged'])) {
		header('location: ./login.php');
		exit();
	}
?>

<html>
<head>
	<title>profile</title>
	<link rel="stylesheet" href="../styles/style_log.css">
</head>
<body>
	<div class="main">
		<?php
		if (isset($_SESSION['logged'])) {
			if ($_SESSION['logged'] == true) {
				$username = $_SESSION['user'];
				echo "<h1>$username</h1>";
			}
		}
		?>
	</div>
</body>
</html>
