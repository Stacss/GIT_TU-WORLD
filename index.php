<?
session_start();
setcookie ("worktime", "Work Time", time()+60);
include ("../postnikov/admin/db.php");
if(isset($_POST['surname'])) {$surname=$_POST['surname']; if ($surname=='') {unset($surname);}}
if(isset($_POST['name'])) {$name=$_POST['name']; if ($name=='') {unset($name);}}
if(isset($_POST['exit'])) {$exit=$_POST['exit']; if ($exit=='') {unset($exit);}}


?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../postnikov/css/style.css">		
	<title>TU-WORLD</title>
</head>
<body>
<? include  ("../postnikov/header.php")?>
	<main>
		<?if ($exit):?>
			<? 
			session_unset();
			session_destroy();
			?>
					<h5>вы вышли из аккаунта</h5>
					<a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизуйтесь</a>
					<a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрируйтесь</a>
		<?elseif ($sessName && $cookie):?>
		<H2>Добрый день, <?=$userName.$cookie?>!</H2>
		<p>Мы рады что вы выбрали нас!</p>
		<?elseif (!$cookie):?>
			<? 
			session_unset();
			session_destroy();
			?>
		<H2>Добрый день, Сессия закончилась!</H2>
		<p> <a href="http://cp81961.tmweb.ru/postnikov/authorization.php">авторизуйтесь</a></p>
		
		<?else:?>
		<H2>Добрый день, Гость!</H2>
		<p>Если вы являетесь нашим клиентом, то <a href="http://cp81961.tmweb.ru/postnikov/authorization.php">авторизуйтесь</a>. Если не являетесь, то пройдите <a href="http://cp81961.tmweb.ru/postnikov/intake.php">регистрацию</a>.</p>
		<?endif?>
	</main>
	<footer>
	</footer>
	
</body>
</html>