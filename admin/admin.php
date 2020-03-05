
<?php require_once "../configs/config.php" ?>

<?php
	if (isset($_POST['login'])) {
		// echo "ssss";
		$name     = $_POST['admin'];
		$password = encrypt($_POST['password'], $key);
		if (empty($name) or empty($password)) {
			echo "tamam field ha ra por kond.";
		} else {
			$query = mysqli_query($db, "SELECT * FROM admin WHERE name='$name' AND password='$password'");
			if (mysqli_num_rows($query) == 0) {
				echo "jamchin admini vojod nadarad.";
			} else {
				$_SESSION['admin'] = $name;
				echo "vared shpdid.";
			}
		}
	} elseif (isset($_POST['exit'])) {
		// echo "string";
		$_SESSION['admin'] = false;
	}
?>

<html>
<head>
	<title>admin</title>
	<link rel="stylesheet" href="../styles/style_log.css">
</head>
<body>
	<div class="main">
		<?php
			if (!isset($_SESSION['admin'])) {
				echo "<h1>login admin</h1>
				<form action=","./admin.php"," method=","post",">
				<input type=","text"," name=","admin"," placeholder=","admin",">
				<br>
				<input type=","password"," name=","password"," placeholder=","enter password",">
				<br>
				<input type=","submit"," name=","login"," value=","login",">
			</form>";
			} elseif (!$_SESSION['admin']) {
				echo "<h1>login admin</h1>
				<form action=","./admin.php"," method=","post",">
				<input type=","text"," name=","admin"," placeholder=","admin",">
				<br>
				<input type=","password"," name=","password"," placeholder=","enter password",">
				<br>
				<input type=","submit"," name=","login"," value=","login",">
			</form>";
			} else {
				$name = $_SESSION['admin'];
				echo "<h1>wellcome $name</h1>
				<a href=","./users.php",">users</a>
				<br>
				<a href=","./kalaha.php",">kalaha</a>
				<br>
				<form action=","./admin.php"," method=","post",">
				<input type=","submit"," name=","exit"," value=","exit",">
				</form>";
			}
		?>
	</div>
</body>
</html>

