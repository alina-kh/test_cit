<?php

// Настройки подключения к БД.
$hostname = 'localhost';
$username = 'homestead';
$password = 'secret';
$dbName = 'citrus';

// Языковая настройка.
setlocale(LC_ALL, 'utf-8');

// Подключение к БД.

$dbc = mysqli_connect($hostname, $username, $password) or die('No connect with data base');
mysqli_query($dbc, 'SET NAMES utf-8');
mysqli_select_db($dbc, $dbName) or die('No data base');

// Открытие сессии.
session_start();
