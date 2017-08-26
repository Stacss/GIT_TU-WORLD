<?
session_start();
include ("../postnikov/admin/db.php");
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../postnikov/css/style.css">		
	<title>TU-WORLD-регистрация</title>
</head>
<body>
<? include  ("../postnikov/header.php")?>
	<main>
        <div class="general">
            <a href="../postnikov/registration.php">Я впервые регистрируюсь!</a>
            <a href="#">Я уже путишествовал с Вами, но я не зарегистрирован!</a>
        </div>
    </main>
</body>
</html>