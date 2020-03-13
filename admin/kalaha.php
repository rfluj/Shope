
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
			if (isset($_POST['edit'])) { # in if baraye halati hast ke ma ye kala ra edit karde iem va mikhahim in tagirat emal shavad.
				$id    = $_POST['id'];
				$query = mysqli_query($db, "SELECT * FROM kala WHERE id='$id'");
				if ($query) {
					$row    = $query->fetch_assoc(); # information feli in kala
					$name   = $row['name'];
					$about  = $row['about'];
					$price  = $row['price'];
					$number = $row['number'];
					$block  = $row['block'];
					# ******************************************* information ke az tarig method post be in safhe post shode ast
					$name_post   = $_POST['name'];
					$about_post  = $_POST['about'];
					$price_post  = $_POST['price'];
					$number_post = $_POST['number'];
					if (isset($_POST['block'])) {
						$block_post = 'Block';
					} else {
						$block_post = 'unBlock';
					}
					if (empty($name_post) or empty($about_post) or empty($price_post) or empty($number_post) or empty($block_post)) { # in if baraye halati hast ke admin tamam field ha ra por nakarde bashad.
						echo "<span>tamam field ha ra por konid.</span>
						<form action=","./kalaha.php"," method=","post",">
							<input type=","text"," name=","name"," value='$name'>
							<br>
							<textarea name=","about"," id=","about"," placeholder=","about",">$about</textarea>
							<br>
							<input type=","int"," name=","price"," value=$price>
							<br>
							<input type=","int"," name=","number"," value=$number>
							<br>";
						if ($block == 'Block') {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  checked>
							<label for=","block",">Block</label>
							<br>";
						} else {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  >
							<label for=","block",">Block</label>
							<br>";
						}
						echo "<input type=","hidden"," name=","id"," value=$id>
						<input type=","submit"," name=","edit"," value=","edit",">
						</form>";
					} else { # in if baraye halati hast ke admin tamam field ha ra kamel karde bashad.
						if (change_name($name) == change_name($name_post)) { # in if baraye hlati hast ke name kala ro tagir nadade bashim pas nabayad hich tagiri dar name image in kala bvojod biayad
							// echo "yeksan";
							mysqli_query($db, "UPDATE kala SET id='$id', name='$name_post', about='$about_post', price='$price_post', number='$number_post', block='$block_post' WHERE id='$id'");
							header('location: ./kalaha.php');
							exit();
						} else { # in dar sorati hast ke name ro tagir dade bashim pas bayas name image in kala ham tagir konad.
							// echo "motefavet";
							$target_dir  = "../srcs/images/kalaha/";
							$pathinfo    = get_file_type($target_dir, change_name($name));
							if ($pathinfo) {
								$target_file = $target_dir . change_name($name_post) . $pathinfo;
								if (file_exists($target_file)) {
									echo "<p>in name baraye kalahaye digar gerefte shode ast.
									lotfan yek name digar entekhab konid.
									</p>
									<form action=","./kalaha.php"," method=","post",">
									<input type=","text"," name=","name"," value='$name'>
									<br>
									<textarea name=","about"," id=","about"," placeholder=","about",">$about</textarea>
									<br>
									<input type=","int"," name=","price"," value=$price>
									<br>
									<input type=","int"," name=","number"," value=$number>
									<br>";
									if ($block == 'Block') {
										echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  checked>
										<label for=","block",">Block</label>
										<br>";
									} else {
										echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  >
										<label for=","block",">Block</label>
										<br>";
									}
									echo "<input type=","hidden"," name=","id"," value=$id>
									<input type=","submit"," name=","edit"," value=","edit",">
									</form>";
								} else {
									// echo "file mojod nabod";
									// echo $target_dir . change_name($name) . $pathinfo;
									// echo "yes";
									// echo $target_dir . change_name($name_post) . $pathinfo;
									if (rename($target_dir . change_name($name) . $pathinfo, $target_dir . change_name($name_post) . $pathinfo)) {
										mysqli_query($db, "UPDATE kala SET id='$id', name='$name_post', about='$about_post', price='$price_post', number='$number_post', block='$block_post' WHERE id='$id'");
										header('location: ./kalaha.php');
										exit();
									} else {
										echo "<span>error dar tagir name kala.</span>
											<br>
											<a href=","./kalaha.php",">didan kalaha</a>";
									}
									
								}
							} else {
								echo "<span>image in kala hazf shode.</span>
								<br>
								<a href=","./kalaha.php",">didan kalaha</a>";
							}
						}
					}
				}
				
			}
			elseif (!isset($_POST['action'])) { #in if baraye halati hast ke mikhahim tamam kala ha ra namayesh bedahim.
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
			elseif (isset($_POST['action'])) { # in if baraye halati hast ke ma button edit ya delete ye kalaro to list kalaha zade bashim.
				if ($_POST['action'] == "edit") { # in if baraye halati hast ke ma button edit ro zade bashim.
					$id    = $_POST['id'];
					$query = mysqli_query($db, "SELECT * FROM kala WHERE id='$id'");
					if ($query) {
						$row    = $query->fetch_assoc();
						$name   = $row['name'];
						$about  = $row['about'];
						$price  = $row['price'];
						$number = $row['number'];
						$block  = $row['block'];
						echo "<form action=","./kalaha.php"," method=","post",">
							<input type=","text"," name=","name"," value='$name'>
							<br>
							<textarea name=","about"," id=","about"," placeholder=","about",">$about</textarea>
							<br>
							<input type=","int"," name=","price"," value=$price>
							<br>
							<input type=","int"," name=","number"," value=$number>
							<br>";
						if ($block == 'Block') {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  checked>
							<label for=","block",">Block</label>
							<br>";
						} else {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  >
							<label for=","block",">Block</label>
							<br>";
						}
						echo "<input type=","hidden"," name=","id"," value=$id>
						<input type=","submit"," name=","edit"," value=","edit",">
						</form>";
					}
				}
				elseif ($_POST['action'] == "delete") { # in if baraye halati hast ke button delete ye kala ro to list kalaha zade bashe.
					$id = $_POST['id'];
					$query = mysqli_query($db, "SELECT * FROM kala WHERE id='$id'");
					if ($query) {
						$row    = $query->fetch_assoc();
						$name   = $row['name'];
						$about  = $row['about'];
						$price  = $row['price'];
						$number = $row['number'];
						$block  = $row['block'];
						echo "<table>
						<tr>
							<th>id</th>
							<th>name</th>
							<th>about</th>
							<th>price</th>
							<th>number</th>
							<th>Block</th>
						</tr>
						<tr>
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
						echo "</tr>
						</table>
						<form action=","./kalaha.php"," method=","post",">
							<input type=","hidden"," name=","id"," value=$id>
							<input type=","submit"," name=","delete"," value=","delete",">
						</form>";

					}
				}
			}
		?>
	</div>
</body>
</html>
