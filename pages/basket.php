
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
			$username = $_SESSION['user'];
			// $i        = 0;
			$in_array = arr_tekrar($_SESSION['basket']);
			// $id_array = array();
			// while ($i < count($_SESSION['basket'])) {
			// 	$num = $_SESSION['basket'][$i];
			// 	if (in_array($num, $id_array, TRUE)) {
			// 		echo "tekrari";
			// 		echo $num;
			// 		$x = $in_array[$i][1];
			// 		$x += 1;
			// 		$in_array[$i][1] = $x;
			// 	} else {
			// 		array_push($id_array, $num);
			// 		array_push($in_array, array($num, 1));
			// 		echo $num;
			// 	}
			// 	$i += 1;
			// }
			$j = 0;
			while ($j < count($in_array)) {
				echo "\n";
				echo "id kala -> ", $in_array[$j][0], " ; tedad -> ", $in_array[$j][1];
				$j += 1;
			}

		?>

		<a href="./say_hello.php">safhe asli</a>
	</div>
</body>
</html>
