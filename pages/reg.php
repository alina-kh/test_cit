<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$title = "Регистрация"; // название формы
require "../components/db.php"; // подключаем файл для соединения с БД

// Пользователь нажимает на кнопку "Зарегистрировать" и код начинает выполняться
if (isset($_POST['do_reg'])) {

	// Создаем массив для сбора ошибок
	$errors = array();

	$login = $_POST['login'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$family = $_POST['family'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	// Проводим проверки
	// trim — удаляет пробелы (или другие символы) из начала и конца строки
	if (trim($login) == '') {
		$errors[] = "Введите логин!";
	}

	if (trim($email) == '') {
		$errors[] = "Введите Email";
	}

	if (trim($name) == '') {
		$errors[] = "Введите Имя";
	}

	if (trim($family) == '') {
		$errors[] = "Введите фамилию";
	}

	if ($password == '') {
		$errors[] = "Введите пароль";
	}

	if ($confirm != $password) {
		$errors[] = "Повторный пароль введен не верно!";
	}
	// функция mb_strlen - получает длину строки
	// Если логин будет меньше 5 символов и больше 90, то выйдет ошибка
	if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
		$errors[] = "Недопустимая длина логина";
	}

	if (mb_strlen($name) < 3 || mb_strlen($name) > 50) {
		$errors[] = "Недопустимая длина имени";
	}

	if (mb_strlen($family) < 3 || mb_strlen($family) > 50) {
		$errors[] = "Недопустимая длина фамилии";
	}

	if (mb_strlen($password) < 2 || mb_strlen($password) > 12) {
		$errors[] = "Недопустимая длина пароля (от 2 до 12 символов)";
	}

	// проверка на правильность написания Email
	if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) {
		$errors[] = 'Неверно введен е-mail';
	}

	// Проверка на уникальность логина
	$query = 'SELECT*FROM users WHERE login="$login"';
	$isLoginFree = mysqli_fetch_assoc(mysqli_query($dbc, $query));

	//Если $isLoginFree не пустой - то логин занят!
	if (!empty($isLoginFree)) {
		$errors[] = "Пользователь с таким логином существует!";
	}

	// Проверка на уникальность email
	$query = 'SELECT*FROM users WHERE email="$email"';
	$isEmailFree = mysqli_fetch_assoc(mysqli_query($dbc, $query));
	if (!empty($isEmailFree)) {
		$errors[] = "Пользователь с таким Email существует!";
	}

	if (empty($errors)) {


		$query = "INSERT INTO users SET login='$login', email='$email', name='$name', family='$family', password='$password', namecheck=''";
		mysqli_query($dbc, $query);
		echo '<div style="color: green; ">Вы успешно зарегистрированы! Можно <a href="login.php">авторизоваться</a>.</div><hr>';
	} else {
		// array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
		echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
	}
}
mysqli_close($dbc);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.min.css">
	<meta content="text/html; charset=utf-8">
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
						<a class="nav-link" href="login.php">Авторизация</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="#">Регистрация</a>
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
				<h2>Регистрация</h2>
				<form action="reg.php" method="post" id="reg">
					<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите Email"><br>
					<input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" required><br>
					<input type="text" class="form-control" name="family" id="family" placeholder="Введите фамилию" required><br>
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
					<input type="password" class="form-control" name="confirm" id="confirm" placeholder="Повторите пароль"><br>
					<button class="btn btn-success" name="do_reg" type="submit">Зарегистрировать</button>
				</form>
				<br>
				<br>
				<p>Если вы зарегистрированы, тогда нажмите <a href="login.php">здесь</a>.</p>
				<p>Вернуться на <a href="../index.php">главную</a>.</p>
			</div>
		</div>
	</div>
</body>

</html>