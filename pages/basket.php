
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
	<title>basket</title>
	<link rel="stylesheet" href="../styles/style_log.css">
</head>
<body>
	<div class="main">
		<h1>sabate kharid Shoma</h1>
		<?php
			$username = $_POST['user'];
			while ($i < count($_SESSION['basket'])) {
				if (in_array($i, $_SESSION['basket'], true)) {
					echo "tekrari '$i'   ";
				} else {
					echo $i;
				}
			}

		?>

		<a href="./say_hello.php">safhe asli</a>
	</div>
</body>
</html>
