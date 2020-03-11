
<?php require_once "../configs/config.php" ?>

<?php
	if (!isset($_SESSION['admin']) or (!$_SESSION['admin'])) {
		header('location: ./admin.php');
		exit();
	}
?>


<html>
<head>
	<title>users</title>
	<link rel="stylesheet" href="../styles/style_log.css">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>
	<div class="main">
		<?php
			if (!isset($_POST['action'])) { #in if baraye halati hast ke mikhahim tamam kala ha ra namayesh bedahim.
				echo "<h1>Kalaha</h1>";
				$query_all_kalaha = mysqli_query($db, "SELECT * FROM kala");
				if ($query_all_kalaha) { #in if check mikonad ke aya in query ma khali ast ya na,agar khali bashad(else) yani hich kalayi dar site nist.agr khalio nabashad yani kalayi vojod darad.
					echo "<table>
						<tr>
							<th>id</th>
							<th>name</th>
							<th>about</th>
							<th>price</th>
							<th>number</th>
							<th>block</th>
							<th>edit</th>
							<th>delete</th>
						</tr>";
					while ($row = $query_all_kalaha->fetch_assoc()) { #in while baraye in hast ke baraye tamam kala ha vared while shavad va an ra namayesh dahad.
						$id     = $row['id'];
						$name   = $row['name'];
						$about  = $row['about'];
						$price  = $row['price'];
						$number = $row['number'];
						$block  = $row['block'];
						echo "<tr>
						<td>$id</td>
						<td>$name</td>
						<td>$about</td>
						<td>$price</td>
						<td>$number</td>";
						if ($block == 'Block') {
							echo "<td><span>&#9745</span></td>";
						} else {
							echo "<td><span>&#9744</span></td>";
						}
						echo "<form action=","./kalaha.php"," method=","post",">
							<input type=","hidden"," name=","id"," value=$id>
							<td><input id=","action"," type=","submit"," name=","action"," value=","edit","></td>
							<td><input id=","action"," type=","submit"," name=","action"," value=","delete","></td>
						</form>
						</tr>";
					}
					echo "</table>";
				} else {
					echo "<span>hich kalayi dar site vojod nadarad.</span>";
				}
			}
		?>
	</div>
</body>
</html>
