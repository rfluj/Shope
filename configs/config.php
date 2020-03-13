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
	echo "string";
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

	function get_file_type ($filedir, $filename)
	{
		if (file_exists($filedir . $filename . '.jpg')) {
			return '.jpg';
		} elseif (file_exists($filedir . $filename . '.png')) {
			return '.png';
		} elseif (file_exists($filedir . $filename . '.jpeg')) {
			return '.jpeg';
		} elseif (file_exists($filedir . $filename . '.gif')) {
			return '.gif';
		} return false;
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

	function arr_tekrar ($array) {
		$in_array = array();
		$arr      = array();
		$i        = 0;
		while ($i < count($array)) {
			$num = $array[$i];
			if (in_array($num, $in_array, true)) {
				$j = 0;
				while ($j < count($arr)) {
					if ($arr[$j][0] == $num) {
						$x = $arr[$j][1];
						$x += 1;
						$arr[$j][1] = $x;
						break;
					}
					$j += 1;
				}
			} else {
				array_push($arr, array($num, 1));
				array_push($in_array, $num);
			}
			$i += 1;
		}
		return $arr;
	}

	function index_of_element ($array, $var) {
		$i = 0;
		while ($i < count($array)) {
			if ($var === $array[$i]) {
				return $i;
			}
			$i += 1;
		}
		return -1;
	}
	
	function intdiv($a, $b){
		return ($a - $a % $b) / $b;
	}
