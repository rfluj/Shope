
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
			if (isset($_POST['edit'])) { # in if baraye halati hast ke rafte bashe to halat edit va bekhad ye user ro edit kone.
				// echo "edit";
				$id       = $_POST['id'];
				$username = $_POST['username'];
				$password = encrypt($_POST['password'], $key);
				if (isset($_POST['block'])) {
					$block = 'Block';
				} else {
					$block = 'unBlock';
				}
				$email   = $_POST['email'];
				$address = $_POST['address'];
				if (empty($username) or empty($password) or empty($block) or empty($email) or empty($address)) {
					echo "tamam field ha ra por konid.";
					$query = mysqli_query($db, "SELECT * FROM users WHERE id='$id'");
					if ($query) {
						$row_user = $query->fetch_assoc();
						$username = $row_user['username'];
						$password = decrypt($row_user['password'], $key);
						$block    = $row_user['block'];
						$email    = $row_user['email'];
						$address  = $row_user['address'];
						echo "<form action=","./users.php"," method=","post",">
							<input type=","text"," name=","username"," value=","$username",">
							<br>
							<input type=","password"," name=","password"," value=","$password",">
							<br>
							<input type=","hidden"," name=","id"," value=$id>";
						if ($block == 'Block') {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  checked>
							<label for=","block",">Block</label>
							<br>";
						} else {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  >
							<label for=","block",">Block</label>
							<br>";
						}
						echo "<input type=","email"," name=","email"," value=","$email",">
							<br>
							<input type=","text"," name=","address"," value=","$address",">
							<br>
							<input type=","submit"," name=","edit"," value=","edit",">
						</form>";
					}
				} else {
					// echo $id;
					mysqli_query($db, "UPDATE users SET id='$id', username='$username', password='$password', block='$block', email='$email', address='$address' WHERE id='$id'");
					header('location: ./users.php');
				}
			}
			elseif (isset($_POST['delete'])) { # in if baraye halati hast ke rafte bashe to halat delete va bekhad ye user ro delete kone.
				$id = $_POST['id'];
				mysqli_query($db, "DELETE FROM users WHERE id='$id'");
				header('location: ./users.php');
			}




			elseif (!isset($_POST['action'])) { #in if baraye halat hayi hast ke bedon hich posti(dastori) in page neshon dade mishe.
				// echo "dddd";
				echo "<h1>Users</h1>";
				$query_all_users = mysqli_query($db, "SELECT * FROM users");
				if ($query_all_users) {
					echo "<table>
					<tr>
						<th>id</th>
						<th>username</th>
						<th>password</th>
						<th>Block</th>
						<th>email</th>
						<th>address</th>
						<th>edit</th>
						<th>delete</th>
					</tr>";
					while ($row = $query_all_users->fetch_assoc()) {
						$id       = $row['id'];
						$username = $row['username'];
						$password = decrypt($row['password'], $key);
						$block    = $row['block'];
						$email    = $row['email'];
						$address  = $row['address'];
						echo "<tr>
							<td>$id</td>
							<td>$username</td>
							<td>$password</td>";
						if ($block == 'Block') {
							echo "<td><span>&#9745</span></td>";
						} else {
							echo "<td><span>&#9744</span></td>";
						}
						echo "<td>$email</td>
							<td>$address</td>
							<form action=","./users.php"," method=","post",">
								<input type=","hidden"," name=","id" ," value=","$id",">
								<td><input id=","action"," type=","submit"," name=","action"," value=","edit","></td>
								<td><input id=","action"," type=","submit"," name=","action"," value=","delete","></td>
							</form>
						</tr>";
					}
					echo "</table>";
				} else {
					echo "<span>hich useri dar site sign up nakarde ast.</span>";
				}
			} elseif (isset($_POST['action'])) { # in if baraye halati hast to list hame user ha button edit ya delete zade shode bashe.
				// echo "string";
				if ($_POST['action'] == "edit") { # in if baraye halati hast ke button edit zade bashe.
					// echo "string";
					$id    = $_POST['id'];
					$query = mysqli_query($db, "SELECT * FROM users WHERE id='$id'");
					if ($query) {
						$row_user = $query->fetch_assoc();
						$username = $row_user['username'];
						$password = decrypt($row_user['password'], $key);
						$block    = $row_user['block'];
						$email    = $row_user['email'];
						$address  = $row_user['address'];
						echo "<form action=","./users.php"," method=","post",">
							<input type=","text"," name=","username"," value=","$username",">
							<br>
							<input type=","password"," name=","password"," value=","$password",">
							<br>
							<input type=","hidden"," name=","id"," value=$id>";
						if ($block == 'Block') {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  checked>
							<label for=","block",">Block</label>
							<br>";
						} else {
							echo "<input type=","checkbox"," id=","block"," name=","block"," value=$id  >
							<label for=","block",">Block</label>
							<br>";
						}
						echo "<input type=","email"," name=","email"," value=","$email",">
							<br>
							<input type=","text"," name=","address"," value=","$address",">
							<br>
							<input type=","submit"," name=","edit"," value=","edit",">
						</form>";
					}

				} elseif ($_POST['action'] == "delete") { # in if baraye halati hast ke button delete zade bashe.
					$id = $_POST['id'];
					$query = mysqli_query($db, "SELECT * FROM users WHERE id='$id'");
					if ($query) {
						$row_user = $query->fetch_assoc();
						$username = $row_user['username'];
						$password = decrypt($row_user['password'], $key);
						$block    = $row_user['block'];
						$email    = $row_user['email'];
						$address  = $row_user['address'];
						echo "<table>
							<tr>
								<th>id</th>
								<th>username</th>
								<th>password</th>
								<th>Block</th>
								<th>email</th>
								<th>address</th>
							</tr>
							<tr>
								<td>$id</td>
								<td>$username</td>
								<td>$password</td>";
						if ($block == 'Block') {
							echo "<td><span>&#9745</span></td>";
						} else {
							echo "<td><span>&#9744</span></td>";
						}
						echo "<td>$email</td>
								<td>$address</td>
							</tr>
						</table>
						<form action=","./users.php"," method=","post",">
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

