
<?php require_once '../configs/config.php' ?>




<html>
<head>
	<title>kalaha</title>
	<link rel="stylesheet" href="../styles/style_log.css">
</head>
<body>
	<div class="main">
		<h1>Kalaha</h1>
		<?php
			if (isset($_SESSION['logged'])) {
				if ($_SESSION['logged']) {
					$str = 'moshahese sabad kharid.';
					echo "<form action=","./basket.php"," method=","post",">
							<input id=","submit"," type=","submit"," name=","basket"," value='$str'>
						</form>";
					if (isset($_POST['kharid'])) {
						$id = array($_POST['id']);
						array_push($_SESSION['basket'], $id);
						echo "<span>kala be sabad kharid ezafe shod.</span>";
					}
				} elseif (isset($_POST['kharid'])) {
					echo "<p>shamo vared site nashodeied lotfan varede hesab karbari khod shavid.</p>
					<br>
					<a href=","./login.php",">safhe login</a>";
				}
			} elseif (isset($_POST['kharid'])) {
				echo "<p>shamo vared site nashodeied lotfan varede hesab karbari khod shavid.</p>
				<br>
				<a href=","./login.php",">safhe login</a>";
			}
		?>
		<?php
			$query = mysqli_query($db, "SELECT * FROM kala");
			if (mysqli_num_rows($query) == 0) {
				echo "hich kalayi baraye namayesh vojod nadarad.";
			} else {
				while ($row = $query->fetch_assoc()) {
					$id          = $row['id'];
					$name        = $row['name'];
					$about       = $row['about'];
					$number      = $row['number'];
					$change_name = change_name($name);
					$submit_str  = 'afzodan be sabad kharid.';
					echo "<h3>$name</h3>
					<br>
					<img id=","image_kala"," src=","../srcs/images/kalaha/$change_name.jpg"," alt=$name>
					<br>
					<p>$about</p>
					<br>";
					if ($number >= 10) {
						echo "<span>Status : mojod</span>
						<br>
						<form action=","./kalaha.php"," method=","post",">
							<input type=","hidden"," name=","id"," value=$id>
							<input id=","submit"," type=","submit"," name=","kharid"," value='$submit_str'>
						</form>";
					} elseif ($number != 0) {
						echo "<span>Status : '$number' ta mojod</span>
						<br>
						<form action=","./kalaha.php"," method=","post",">
							<input type=","hidden"," name=","id"," value=$id>
							<input id=","submit"," type=","submit"," name=","kharid"," value='$submit_str'>
						</form>";
					} else {
						echo "<span>Status : namojod</span>";
					}
					echo "<hr>";
				}
			}
		?>
		<a href="./say_hello.php">safhe asli</a>
	</div>
</body>
</html>

