
<?php require_once '../configs/config.php' ?>

<?php
	$_SESSION['logged'] = false;
	header('location: ./say_hello.php');
	exit();
?>

