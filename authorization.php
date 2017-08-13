<?
session_start();
setcookie ("worktime", "Work Time", time()+60);
include ("../postnikov/admin/db.php");
if (isset($_POST['login'])) {$login=$_POST['login'];}
if (isset($_POST['password'])) {$password=$_POST['password'];}

?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../postnikov/css/style.css">		
	<title>Document</title>
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
							<li><a href="http://cp81961.tmweb.ru/postnikov/new_order.php">заказ тура</a></li>
						</ul>
					<li><a href="#">контакты</a></li>
					<li><a href="http://cp81961.tmweb.ru/postnikov/authorization.php">вход для клиентов</a></li>
				</ul>

			</nav>
			<div class="cabinet">
				<?
				$_SESSION['pssess']=$login;

				$sessName=$_SESSION['pssess'];
				$checkLogin=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$sessName'") or die(mysql_error());
				$arrayCheckLogin=mysqli_fetch_array($checkLogin);
				$idLogin=$arrayCheckLogin['id'];
				$_SESSION['pssessid']=$idLogin;
				$checkName=mysqli_query ($db, "SELECT name FROM ps_client WHERE idlogin = '$idLogin'") or die(mysql_error());
				$arrayCheckName=mysqli_fetch_array($checkName);
				$userName=$arrayCheckName['name'];
				$cookie=$_COOKIE["worktime"];
				echo $idLogin;
				?>
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
	
	<?if ($login && $password):?>
	
	<?
		$login=htmlspecialchars($login);
		$login=trim($login);
		$login=stripslashes($login);			
		$password=htmlspecialchars($password);
		$password=trim($password);
		$password=stripslashes($password);
		$password=strrev($password);
		$password = md5($password);
		$checkLogin=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$login' && password='$password'") or die(mysql_error());
		$arrayCheckLogin=mysqli_fetch_array($checkLogin);
		$idLogin=$arrayCheckLogin['id'];
		$checkName=mysqli_query ($db, "SELECT name FROM ps_client WHERE idlogin = '$idLogin'") or die(mysql_error());
		$arrayCheckName=mysqli_fetch_array($checkName);
		$userName=$arrayCheckName['name'];
				
			if (isset($arrayCheckLogin)) {
				echo "Поздравляем! ".$userName.", Вы авторизовались!<br><a href='http://cp81961.tmweb.ru/postnikov/index.php'>перейдите по ссылке</a>";
				echo "имя логина сессии >>> ".($_SESSION['pssess']).(session_id());
			} else {
				exit ('авторизация не прошла. Введен неверный логин или пароль.<br><a href="http://cp81961.tmweb.ru/postnikov/authorization.php">пробовать снова</a>');
			}
	?>
	<?else:?>
		<form action='../postnikov/authorization.php' method='post'>
			<div class='container_form'>
				<label for='logan'>введите логин</label>
					<input type='text' id='login' name='login' class='mini_textarea'>
			</div>
			<div class='container_form'>
				<label for='password'>введите пароль</label>
					<input type='password' id='password' name='password' class='mini_textarea'>
			</div>
				<button type='submit' class='btn'>отправить</button>
		</form>
	<?endif?>	
	</main>
	
</body>
</html>