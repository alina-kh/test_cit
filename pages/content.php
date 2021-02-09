<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require "../components/db.php";

$title = 'Чеклист технического аудита сайта';
$allCheck = ['robots', 'robots_1', 'robots_2', 'robots_3', 'robots_4', 'robots_5', 'sitemap', 'red301', 'err404', 'five'];

$login = $_SESSION['login'];
$query = "SELECT namecheck FROM users WHERE login='$login'";
$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
$row = mysqli_fetch_array($result);
$ch = " checked='checked'";
foreach ($row as $value) {
    $name = explode(',', $value);
}
mysqli_close($dbc);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                        <a class="nav-link" href="reg.php">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Выход</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="main">
        <div class="container md-4">
            <div class="row">
                <div class="col">
                    <form action="../components/checklist.php" method="post" id="check">
                        <h1 class="title"><?php echo $title ?></h1>
                        <div class="check">

                            <div class="check_item">
                                <div class="check_name">
                                    <div>
                                        <input type="checkbox" name="check[]" value="<?php echo $allCheck[0] ?>" <?php if (in_array($allCheck[0], $name)) {
                                                                                                                        echo $ch;
                                                                                                                    } ?> />
                                        <a href="#">Robots.txt</a>
                                    </div>
                                    <button class="btn_tog">+</button>
                                </div>
                                <div class="check_about">
                                    Файл Robots.txt – это обычный текстовый файл в формате .txt, содержащий инструкции и директивы для поисковых роботов, запрещающие индексировать определенные файлы сайта, его документы и папки. То есть, данный файл ограничивает ботам поисковых систем доступ к содержимому сайта.<br />
                                    <input type="checkbox" name="check[]" value="<?php echo $allCheck[1] ?>" <?php if (in_array($allCheck[1], $name)) {
                                                                                                                    echo $ch;
                                                                                                                } ?> />Закрыты служебные и ненужные разделы<br />
                                    <input type="checkbox" name="check[]" value="<?php echo $allCheck[2] ?>" <?php if (in_array($allCheck[2], $name)) {
                                                                                                                    echo $ch;
                                                                                                                } ?> />Заданы разные User-Agent<br />
                                    <input type="checkbox" name="check[]" value="<?php echo $allCheck[3] ?>" <?php if (in_array($allCheck[3], $name)) {
                                                                                                                    echo $ch;
                                                                                                                } ?> />Задано главное зеркало для яндекса<br />
                                    <input type="checkbox" name="check[]" value="<?php echo $allCheck[4] ?>" <?php if (in_array($allCheck[4], $name)) {
                                                                                                                    echo $ch;
                                                                                                                } ?> />Закрыты страницы с динамическими параметрами<br />
                                    <input type="checkbox" name="check[]" value="<?php echo $allCheck[5] ?>" <?php if (in_array($allCheck[5], $name)) {
                                                                                                                    echo $ch;
                                                                                                                } ?> />Указана ссылка на карту сайта для роботов
                                </div>
                            </div>

                            <div class="check_item">
                                <div class="check_name">
                                    <div>
                                        <input type="checkbox" name="check[]" value="<?php echo $allCheck[6] ?>" <?php if (in_array($allCheck[6], $name)) {
                                                                                                                        echo $ch;
                                                                                                                    } ?> />
                                        <a href="#">Sitemap.xml</a>
                                    </div>
                                    <button class="btn_tog">+</button>
                                </div>
                                <div class="check_about">
                                    Sitemap.xml — это файл, содержащий в специальном формате ссылки на страницы сайта, которые должны быть проиндексированы поисковыми системами. Исчерпывающая информация о формате может быть найдена на <a href="Sitemaps.org.">Sitemaps.org.</a>
                                </div>
                            </div>

                            <div class="check_item">
                                <div class="check_name">
                                    <div>
                                        <input type="checkbox" name="check[]" value="<?php echo $allCheck[7] ?>" <?php if (in_array($allCheck[7], $name)) {
                                                                                                                        echo $ch;
                                                                                                                    } ?> />
                                        <a href="#">301 редирект</a>
                                    </div>
                                    <button class="btn_tog">+</button>
                                </div>
                                <div class="check_about">
                                    Permanent Redirect 301 применяется с целью организации постоянной переадресации с неактуального доменного адреса или url отдельной страницы на рабочую версию. Редирект может понадобиться в связи с глобальным переносом сайта на другой домен, техническими изменениями в написании адреса, удалением страниц, необходимостью внутренней и внешней перелинковки. Один из вариантов использования перманентной переадресации – редирект с нескольких доменных имен, созданных в разных зонах, на один актуальный адрес. Грамотное использование редиректа позволяет перемещать контент без потерь в поисковой индексации, сохранить и даже увеличить прежний вес и позицию в выдаче.
                                </div>
                            </div>

                            <div class="check_item">
                                <div class="check_name">
                                    <div>
                                        <input type="checkbox" name="check[]" value="<?php echo $allCheck[8] ?>" <?php if (in_array($allCheck[8], $name)) {
                                                                                                                        echo $ch;
                                                                                                                    } ?> />
                                        <a href="#">404 страница</a>
                                    </div>
                                    <button class="btn_tog">+</button>
                                </div>
                                <div class="check_about">
                                    404 - это код статуса HTTP (Not found), который отдает сервер, если пользователь пытается получить доступ к URL-адресу страницы, которая не существует.
                                </div>
                            </div>

                            <div class="check_item">
                                <div class="check_name">
                                    <div>
                                        <input type="checkbox" name="check[]" value="<?php echo $allCheck[9] ?>" <?php if (in_array($allCheck[9], $name)) {
                                                                                                                        echo $ch;
                                                                                                                    } ?> />
                                        <a href="#">ошибки 5**</a>
                                    </div>
                                    <button class="btn_tog">+</button>
                                </div>
                                <div class="check_about">
                                    ....
                                </div>
                            </div>

                        </div>
                        <br />
                        <input type='submit' name='submit' class="submit btn btn-success" value='Сохранить' />
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/script.js"></script>
</body>

</html>