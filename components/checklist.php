<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require "db.php";

$login = $_SESSION['login'];

if (isset($_POST['submit'])) {
	$addCh = $_POST["check"];

	$addCh_this = '';
	for ($a = 0; $a < count($addCh); $a++) {
		$addCh_this .= $addCh[$a] . ',';
		$namecheck = substr($addCh_this, 0, -1);
	}
	$query = "UPDATE users SET namecheck = '$namecheck' WHERE login='$login'";
	mysqli_query($dbc, $query);
}
mysqli_close($dbc);

header('Location: ../pages/content.php');
exit;
