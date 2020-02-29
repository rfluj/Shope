
<?php require_once '../configs/config.php' ?>

<?php
	if (isset($_SESSION['logged'])) {
		if ($_SESSION['logged'] == true) {
			header('location: ./say_hello.php');
			exit();
		}
	}
	if (isset($_POST['register'])) {
		$username   = $_POST['username'];
		$password   = encrypt($_POST['password'], $key);
		$repassword = encrypt($_POST['repassword'], $key);
		$email      = $_POST['email'];
		$address    = $_POST['address'];
		if (empty($username) or empty($password) or empty($repassword) or empty($email) or empty($address)) {
			echo "tamam field ha ra por konid.";
		} else {
			if ($password != $repassword) {
				echo "passwordhaye vared shode yeksan nistand.";
			} else {
				$query = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
				if (mysqli_num_rows($query) != 0) {
					echo "in username gablan gerefte shode ast.";
				} else {
					mysqli_query($db, "INSERT INTO users (username, password, email, address) VALUES ('$username', '$password', '$email', '$address')");
					$_SESSION['logged'] = true;
					$_SESSION['user']   = $username;
					header('location: ./say_hello.php');
					exit();
				}
			}
		}
	} elseif (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = encrypt($_POST['password'], $key);
		if (empty($username) or empty($password)) {
			echo "tamam feild ha ra por konid.";
		} else {
			$query = mysqli_query($db, "SELECT * FROM users WHERE username='$username' AND password='$password'");
			if (mysqli_num_rows($query) == 0) {
				echo "username ya password eshtebah ast.";
			} else {
				$_SESSION['logged'] = true;
				$_SESSION['user']   = $username;
				header('location: ./say_hello.php');
				exit();
			}
		}
	}
?>


<html>
<head>
	<title>login</title>
	<link rel="stylesheet" href="../styles/style_log.css">
</head>
<body>
	<div class="main">
		<h1>login</h1>
		<hr>
		<form action="login.php" method="post">
			<h3>register</h3>
			<input type="text" name="username" placeholder="username">
			<br>
			<input type="password" name="password" placeholder="enter password">
			<br>
			<input type="password" name="repassword" placeholder="repassword">
			<br>
			<input type="email" name="email" placeholder="enter email">
			<br>
			<input type="text" name="address" placeholder="enter address">
			<br>
			<input type="submit" name="register" value="register">
		</form>
		<hr>
		<form action="login.php" method="post">
			<h3>login</h3>
			<input type="text" name="username" placeholder="username">
			<br>
			<input type="password" name="password" placeholder="enter password">
			<br>
			<input type="submit" name="login" value="login">
		</form>
		<hr>
		<span><a href="./say_hello.php">safhe asli</a></span>
	</div>
</body>
</html>