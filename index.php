<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$title = "Главная страница"; // название формы
require "components/db.php"; // подключаем файл для соединения с БД
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
	<header>
		<nav>
			<div class="container mt-4">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" href="#">Главная</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="pages/login.php">Авторизация</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="pages/reg.php">Регистрация</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="pages/logout.php">Выход</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="container mt-4">
		<div class="main">
			<h1 class="title">Главная</h1>
			<?php if (empty($_SESSION['auth'])) : ?>
				<h2 class="subtitle">Для просмотра страницы пожалуйста авторизируйтесь.</h2>
			<?php endif; ?>
			<!-- Если авторизован выведет приветствие -->
			<?php if (isset($_SESSION['auth'])) : ?>
				<h2 class="subtitle">Список чек листов</h2>
				<ul class="check_list">
					<li><a href="pages/content.php">Чеклист технического аудита сайта</a></li>
					<li><a href="#">Чеклист </a></li>
					<li><a href="#">Чеклист </a></li>
					<li><a href="#">Чеклист </a></li>
					<li><a href="#">Чеклист </a></li>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</body>

</html>