
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

<?php
	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		while (in_array($id, $_SESSION['basket'], true)) {
			unset($id);
		}
	} elseif (isset($_POST['delete_1'])) {
		$id       = $_POST['id'];
		$number   = index_of_element($_SESSION['basket'], $id);
		if ($number !== -1) {
			unset($_SESSION['basket'][$number]);
		}
		// $in_array = arr_tekrar($_SESSION['basket']);
		// $j = 0;
		// while ($j < count($in_array)) {
		// 	if ($id == $in_array[$j][0]) {
		// 		$x = $in_array[$j][1];
		// 		$x -= 1;
		// 		$in_array[$j][1] = $x;
		// 	}
		// 	$j += 1;
		// }
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
			$username = $_SESSION['user'];
			$in_array = arr_tekrar($_SESSION['basket']);
			$j = 0;
			while ($j < count($in_array)) {
				$id     = $in_array[$j][0];
				$number = $in_array[$j][1];
				$query  = mysqli_query($db, "SELECT * FROM kala WHERE id='$id'");
				$str_1  = "hazf az sabat kharid";
				$str_2  = "1 adad kam shavad";
				if ($query) {
					$row         = $query->fetch_assoc();
					$name        = $row['name'];
					$price       = $row['price'];
					$about       = $row['about'];
					$change_name = change_name($name);
					echo "<h3>$name</h3>
					<br>
					<img id=","image_kala"," src=","../srcs/images/kalaha/$change_name.jpg"," alt=$name>
					<br>
					<span>price(rial): $price</span>
					<p>$about</p>
					<br>
					<span>tedad : $number</span>
					<br>";
					if ($number > 1) {
						echo "<form action=","basket.php"," method=","post",">
						<input type=","hidden"," name=","id"," value=$id>
						<input id=","delete_kala"," type=","submit"," name=","delete_1"," value='$str_2'>
						<br>
						<input id=","delete_kala"," type=","submit"," name=","delete"," value='$str_1'>
					</form>
					<hr>";
					} else {
						echo "<form action=","basket.php"," method=","post",">
						<input type=","hidden"," name=","id"," value=$id>
						<input id=","delete_kala"," type=","submit"," name=","delete"," value='$str_1'>
					</form>
					<hr>";
					}
				}
					
					
				// echo "\n";
				// echo "id kala -> ", $in_array[$j][0], " ; tedad -> ", $in_array[$j][1];
				$j += 1;
			}

		?>

		<a href="./say_hello.php">safhe asli</a>
	</div>
</body>
</html>
