
<?php require_once '../configs/config.php' ?>

<?php
	if (isset($_SESSION['logged'])) {
		if ($_SESSION['logged']) {
			$str = 'moshahese sabad kharid.';
			echo "<form action=","./basket.php"," method=","post",">
					<input id=","submit"," type=","submit"," name=","basket"," value='$str'>
				</form>";
			if (isset($_POST['kharid'])) {
				array_push($_SESSION['basket'], $_POST['id_kala']);
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
	if (isset($_SESSION['logged'])) {
		if ($_SESSION['logged']) {
			if (isset($_POST['send_command'])) {
				$text            = $_POST['text'];
				$KID             = $_POST['id'];
				$_GET['id_kala'] = $KID;
				if (empty($text) or empty($KID)) {
					echo "ersal command na movafag.";
				} else {
					$username = $_SESSION['user'];
					$q        = mysqli_query($db, "SELECT id FROM users WHERE username='$username'");
					$row      = $q->fetch_assoc();
					$UID      = $row['id'];
					mysqli_query($db, "INSERT INTO command (UID, KID, command_text) VALUES ('$UID', '$KID', '$text')");
				}
			}
		}
	}
?>


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
						<form action=","./show_kalaha.php"," method=","post",">
							<input type=","hidden"," name=","id"," value=$id_kala>
							<input id=","submit"," type=","submit"," name=","kharid"," value='$submit_str'>
						</form>";
					} elseif ($number != 0) {
						echo "<span>Status : '$number' ta mojod</span>
						<br>
						<form action=","./show_kalaha.php"," method=","post",">
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
				$query   = mysqli_query($db, "SELECT * FROM command WHERE KID='$id_kala' ORDER BY id DESC");
				if ($query) {
					while ($row = $query->fetch_assoc()) {
						$id        = $row['id'];
						$UID       = $row['UID'];
						$text      = $row['command_text'];
						$block     = $row['block'];
						if ($block == 'unBlock') {
							$query_UID = mysqli_query($db, "SELECT username FROM users WHERE id='$UID'");
							if ($query_UID) {
								$r = $query_UID->fetch_assoc();
								$u = $r['username']; 
								echo "<span>$u : $text</span>
								<br>";

							}
						}
						
					}
				}
				echo "<span>ersal nazar</span>
				<br>";
				if (isset($_SESSION['logged'])) {
					if ($_SESSION['logged']) {
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
			<input type=","hidden"," name=","id"," value=$id_kala>
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
