
<?php require_once '../configs/config.php' ?>

<?php
	function change_range_limit ($number) {
		$limit_counter = 3;
		$_SESSION['limit_kala'][0] = ($number * $limit_counter) - $limit_counter;
		$_SESSION['limit_kala'][1] = $_SESSION['limit_kala'][0] + $limit_counter;
	}
	if (isset($_GET['limit_kala'])) {
		change_range_limit($_GET['limit_kala']);
	}
?>


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
						array_push($_SESSION['basket'], $_POST['id']);
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
			$limit_counter = 3;
			if (!isset($_SESSION['number_kala'])) {
				$q                        = mysqli_query($db, "SELECT * FROM kala");
				$_SESSION['number_kala']  = mysqli_num_rows($q);
			}
			if (!isset($_SESSION['limit_kala'])) {
				$_SESSION['limit_kala'] = array(0, $limit_counter);
			}
			$x1    = $_SESSION['limit_kala'][0];
			$x2    = $_SESSION['limit_kala'][1];
			$query = mysqli_query($db, "SELECT * FROM kala LIMIT $x1, $limit_counter");
			if (mysqli_num_rows($query) == 0) {
				echo "hich kalayi baraye namayesh vojod nadarad.";
			} else {
				while ($row = $query->fetch_assoc()) {
					$id          = $row['id'];
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
			$n = ($x1 / $limit_counter) - $limit_counter;
			$i = 0;
			if (($_SESSION['number_kala']/$limit_counter) === intdiv($_SESSION['number_kala'], $limit_counter)) {
				$x = ($_SESSION['number_kala']/$limit_counter);
			} else {
				$x = ($_SESSION['number_kala']/$limit_counter) + 1;
			}
			while ($i < 7) {
				if ($n >= 1 and $n <= $x) {
					if ($n === ($x1/$limit_counter)+1) {
						echo "<a id=","this_page"," href=","kalaha.php?limit_kala=$n"," >$n</a>";
					} else {
						echo "<a id=","this_not_page"," href=","kalaha.php?limit_kala=$n"," >$n</a>";
					}
				}
				$n += 1;
				$i += 1;
			}
		?>
		<br>
		<a href="./say_hello.php">safhe asli</a>
	</div>
</body>
</html>

