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
		<header>
		<h1>tu-world</h1>
		<h2>туристическое агенство</h2>
		<div class="container_nav">
			<nav>
				<ul class="cf">
					<li><a href="http://cp81961.tmweb.ru/postnikov/index.php">главная</a></li>
					<li><a class="dropdown" href="#">администрирование</a>
						<ul>
							<li><a href="http://cp81961.tmweb.ru/postnikov/country.php">ввод стран</a></li>
							<li><a href="http://cp81961.tmweb.ru/postnikov/edit.php">редактирование клиента</a></li>
							<li><a href="http://cp81961.tmweb.ru/postnikov/delete_client.php">удаление клиента</a></li>
							<li><a href="http://cp81961.tmweb.ru/postnikov/mail.php">рассылка почты</a></li>
							
						</ul>
					</li>
					<li><a class="dropdown" href="#">клиентам</a>
						<ul>
							<li><a href="http://cp81961.tmweb.ru/postnikov/intake.php">регистрация</a></li>
							<li><a href="http://cp81961.tmweb.ru/postnikov/order_tour.php">заказ тура</a></li>
						</ul>
					<li><a href="#">контакты</a></li>
					<li><a href="http://cp81961.tmweb.ru/postnikov/authorization.php">вход для клиентов</a></li>		
				</ul>
				
			</nav>
			<div class="cabinet">
				<?
				$sessName=$_SESSION['pssess'];
				$checkLogin=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$sessName'") or die(mysql_error());
				$arrayCheckLogin=mysqli_fetch_array($checkLogin);
				$idLogin=$arrayCheckLogin['id'];
				$checkName=mysqli_query ($db, "SELECT name FROM ps_client WHERE idlogin = '$idLogin'") or die(mysql_error());
				$arrayCheckName=mysqli_fetch_array($checkName);
				$userName=$arrayCheckName['name'];
				$cookie=$_COOKIE["worktime"];?>
				<?if ($exit):?>
					<? 
					session_unset();
					session_destroy();
					?>
					<h5>вы вышли из аккаунта</h5>
					<a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизуйтесь</a>
					<a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрируйтесь</a>
					
				<?elseif ($sessName && $cookie):?>
					<h5><?=$userName?>, ваш логин <?=$sessName?></h5>
					<a href="http://cp81961.tmweb.ru/postnikov/my_orders.php">мои заказы</a>
					<a href="#">мои данные</a>
						<form action="../postnikov/index.php" method="post">
							<button type="submit" value="exit" name="exit">выйти</button>
						</form>
				<?elseif (!$cookie):?>
					<? 
					session_unset();
					session_destroy();
					?>
					<h5>Сессия законченна</h5>
					<a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизуйтесь</a>
					<a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрируйтесь</a>
				<?else:?>
							<h5>Здравствуйте, Гость!</h5>
					<a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизуйтесь</a>
					<a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрируйтесь</a>
				<?endif?>
					
			</div>
		</div>
	</header>
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