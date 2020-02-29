<?php
	$db = mysqli_connect('localhost', 'rfluj', '772009', 'Shope');

	if (!$db) {
		echo mysqli_connect_error();
	}

	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	session_start();
	if (!(isset($_SESSION['basket']))) {
		$_SESSION['basket'] = array();
	}

	$key  = "shamsali";
	$salt = "shamsali";

	function encrypt($string, $key) {
		$string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB)));
		return $string;
	}

	function decrypt($string, $key) {
		$string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($string), MCRYPT_MODE_ECB));
		return $string;
	}

	function change_name($name) {
		$len    = strlen($name);
		$i      = 0;
		$string = '';
		while ($i < $len) {
			if ($name[$i] == ' ') {
				$string = $string . '_';
			} else {
				$string = $string . $name[$i];
			}
			$i = $i + 1;
		}
		return $string;
	}