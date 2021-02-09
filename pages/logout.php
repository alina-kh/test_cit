<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

session_start(); // обязательно стартуем сессию, чтобы с ней далее работать
$_SESSION['auth'] = null;
$_SESSION['login'] = null;

$_SESSION['mess'] = "Вы не авторизованы !";
header('Location: ../index.php');
die();
