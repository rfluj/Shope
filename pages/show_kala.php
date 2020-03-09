
<?php require_once '../configs/config.php' ?>

<html>
<head>
	<title>show kala</title>
	<link rel="stylesheet" href="../styles/style_log.css">
</head>
<body>
	<div class="main">
		<h1>show kala</h1>
		<?php
			if (isset($_GET['id_kala'])) {
				$id_kala = $_GET['id_kala'];
				$query_kala = mysqli_query($db, "SELECT * FROM kala WHERE id='$id_kala'");
				if ($query_kala) {
					$row = $query_kala->fetch_assoc();
					$name        = $row['name'];
					$price       = $row['price'];
					$about       = $row['about'];
					$number      = $row['number'];
					$change_name = change_name($name);
					$submit_str  = 'afzodan be sabad kharid.';
					echo "<h3>$name</h3>
					<br>
					<img id=","image_kala"," src=","../srcs/images/kalaha/$change_name.jpg"," alt=$name>
					<br>
					<span>price(rial): $price</span>
					<p>$about</p>
					<br>";
					if ($number >= 10) {
						echo "<span>Status : mojod</span>
						<br>
						<form action=","./kalaha.php"," method=","post",">
							<input type=","hidden"," name=","id"," value=$id_kala>
							<input id=","submit"," type=","submit"," name=","kharid"," value='$submit_str'>
						</form>";
					} elseif ($number != 0) {
						echo "<span>Status : '$number' ta mojod</span>
						<br>
						<form action=","./kalaha.php"," method=","post",">
							<input type=","hidden"," name=","id"," value=$id_kala>
							<input id=","submit"," type=","submit"," name=","kharid"," value='$submit_str'>
						</form>";
					} else {
						echo "<span>Status : namojod</span>";
					}
					echo "<hr>";
				}
				echo "<span>nazarat</span>
				<br>";
				$query   = mysqli_query($db, "SELECT * FROM cammand WHERE KID='$id_kala' ORDER BY id DESC");
				if ($query) {
					while ($row = $query->fetch_assoc()) {
						$id   = $row['id'];
						$UID  = $row['UID'];
						$text = $row['text'];
						echo $id;
					}
				}
				echo "<span>ersal nazar</span>
				<br>";
				if (isset($_SESSION['user'])) {
					if ($_SESSION['user']) {
						$username       = $_SESSION['user'];
						$query_username = mysqli_query($db, "SELECT id FROM users WHERE username='$username'");
						if ($query_username) {
							$row = $query_username->fetch_assoc();
							$UID = $row['id'];
						}
						// $arr = [$UID, $id_kala];
						echo "<form action=","./show_kala.php"," method=","post",">
			<span>ferestadan nazar</span>
			<br>
			<input type=","hidden"," name=","id"," value=$UID>
			<input type=","text"," name=","text"," placeholder=","enter your text",">
			<br>
			<input type=","submit"," name=","send_command"," value=","send",">
		</form>";
					} else {
					echo "<span>shoma vared hesab karbari khod nashodeid.</span>
					<br>
					<span>baraye ersal nazarat bayad aval vared hesab karbari khod shavid.</span>
					<br>
					<a href=","./login.php",">baraye login click konid.</a>";
				}
				} else {
					echo "<span>shoma vared hesab karbari khod nashodeid.</span>
					<br>
					<span>baraye ersal nazarat bayad aval vared hesab karbari khod shavid.</span>
					<br>
					<a href=","./login.php",">baraye login click konid.</a>";
				}
				echo "string";
			} else {
				echo "<span>hich kalayi baraye namyesh entekhab nashode ast.</span>
				<br>
				<a href=","./kalaha.php",">kalaha</a>";
			}
		?>
	</div>
</body>
</html>
