
<?php require_once '../configs/config.php' ?>

<?php
	$_SESSION['logged'] = false;
	$_SESSION['basket'] = [];
	header('location: ./say_hello.php');
	exit();
?>

