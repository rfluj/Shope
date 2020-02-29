
<?php require_once '../configs/config.php' ?>

<!DOCTYPE html>
<html>
<head>
	<title>Shope</title>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
	<?php 
		if (isset($_SESSION['logged'])) {
			if ($_SESSION['logged'] == true) {
				$username = $_SESSION['user'];
				echo "<div class=","main",">
				<h1>wellcome $username</h1>
				</div>
				<div class=","float",">
			<a href=","./basket.php","><h2>sabat kharid</h2></a>
		</div>
		<div class=","clear","></div>";
			}
		}
	?>
	<div class="main">
		<h1>I Marcket</h1>
		<br>
		<ul>
			<li><a href="#">safhe asli</a></li>
			<li><a href="./kalaha.php">kalaha</a></li>
			<?php
				if (isset($_SESSION['logged'])) {
					if ($_SESSION['logged'] == true) {
						echo "<li><a href=","./profile.php",">safhe karbari man</a></li>
						<li><a href=","./exit.php",">khoroj az hesab karbari</a></li>";
					} else {
						echo "<li><a href=","./login.php",">vorod be hesab karbari</a></li>";
					}
				} else {
					echo "<li><a href=","./login.php",">vorod be hesab karbari</a></li>";
				}
			?>
			<li><a href="#">tamas be ma</a></li>
		</ul>
	</div>
	<!-- <div class="change_img">
		<img id="slider" alt="tabligat" src="../srcs/images/2.jpg">
	</div> -->
	<div id="slider">
		<img src="../srcs/images/1.jpg" class="image">
		<div class="buttons">
			<ul></ul>
		</div>
	</div>
	<hr>
	<script type="text/javascript" src="../scripts/jquery.min.js"></script>
	<script type="text/javascript" src="../scripts/setInterval.js"></script>
</body>
</html>