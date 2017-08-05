<?
session_start();
include ("../postnikov/admin/db.php");
if(isset($_POST['e_mail'])) {$e_mail=$_POST['e_mail'];}
if(isset($_POST['theme'])) {$theme=$_POST['theme'];}
if(isset($_POST['text'])) {$text=$_POST['text'];}
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../postnikov/css/style.css">		
	<title>рассылка почты</title>
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
				$userName=$arrayCheckName['name'];?>
				<?if ($exit):?>
					<? 
					session_unset();
					session_destroy();
					?>
					<h5>вы вышли из аккаунта</h5>
					<a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизуйтесь</a>
					<a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрируйтесь</a>
					
				<?elseif ($sessName):?>
					<h5><?=$userName?>, ваш логин <?=$sessName?></h5>
					<a href="http://cp81961.tmweb.ru/postnikov/my_orders.php">мои заказы</a>
					<a href="#">мои данные</a>
						<form action="../postnikov/index.php" method="post">
							<button type="submit" value="exit" name="exit">выйти</button>
						</form>
				
				<?else:?>
							<h5>Здравствуйте, Гость!</h5>
					<a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизуйтесь</a>
					<a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрируйтесь</a>
				<?endif?>
					
			</div>
		</div>
	</header>
<body>
	
	<main>
		<form action="../postnikov/mail.php" method="post">
			<h3>введите почту</h3>
			<div class="container_form">
				<label for="e_mail">e-mail</label>
				<input type="text" name="e_mail" id="e_mail" class="mini_textarea" placeholder="Иванов">
			</div>
			<div class="container_form">	
				<label for="theme">тема</label>
				<input type="text" name="theme" id="theme" class="mini_textarea" placeholder="Иван">
			</div>
			<div class="container_form">	
				<label for="text">текст письма</label>
				<input type="text" name="text" id="text" class="mini_textarea" placeholder="Иванович">
			</div>
			<button type="submit" class="btn">отправить</button>
		</form>
		<?
			if ($e_mail) {
			$sendmail=mail($e_mail, $theme, $text);
			if ($sendmail==true) {
			echo "Ваше письмо отправлено";
			} else {
			echo "Ваше письмо НЕ отправлено";
			}
			}
		?>
	</main>
</body>
</html>