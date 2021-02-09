<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$title = "Авторизация"; // название формы
require "../components/db.php"; // подключаем файл для соединения с БД

// Пользователь нажимает на кнопку "Авторизоваться" и код начинает выполняться
if (isset($_POST['do_login'])) {

	// Создаем массив для сбора ошибок
	$errors = array();

	$login = $_POST['login'];
	$password = $_POST['password'];

	// Проводим поиск пользователей в таблице users
	$query = "SELECT * FROM users WHERE login='$login'";
	$result = mysqli_query($dbc, $query);

	//преобразуем ответ из бд в массив
	$user = mysqli_fetch_assoc($result);

	if (!empty($user)) {
		$query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
		$result = mysqli_query($dbc, $query);
		$userAll = mysqli_fetch_assoc($result);
		if (!empty($userAll)) {
			$_SESSION['auth'] = true;
			$_SESSION['login'] = $login;
			$_SESSION['mess'] = "Вы авторизированы как $login";
			header('Location: ../index.php');
			die();
		} else {
			$errors[] = 'Пароль неверно введен!';
		}
	} else {
		$errors[] = 'Пользователь с таким логином не найден!';
	}

	if (!empty($errors)) {
		echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
	}
}
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.min.css">
</head>

<body>
	<header>
		<nav>
			<div class="container mt-4">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Главная</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="#">Авторизация</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="reg.php">Регистрация</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Выход</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="container mt-4">
		<div class="row">
			<div class="col">
				<h2><?php echo $title ?></h2>
				<form action="login.php" method="post">
					<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required><br>
					<input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль" required><br>
					<button class="btn btn-success" name="do_login" type="submit">Авторизоваться</button>
				</form>
				<br>
				<p>Если вы еще не зарегистрированы, тогда нажмите <a href="reg.php">здесь</a>.</p>
				<p>Вернуться на <a href="../index.php">главную</a>.</p>
			</div>
		</div>
	</div>
</body>

</html>