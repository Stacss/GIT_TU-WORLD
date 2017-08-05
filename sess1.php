<?
include ("../postnikov/admin/db.php");
if (isset($_POST['login'])) {$login=$_POST['login'];}
if (isset($_POST['password'])) {$password=$_POST['password'];}
session_start();
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
				<a href="http://cp81961.tmweb.ru/postnikov/intake.php">регистрация</a></li>
				<a href="http://cp81961.tmweb.ru/postnikov/order_tour.php">заказ тура</a></li>
			</ul>
        <li><a href="#">контакты</a></li>
		<li><a href="http://cp81961.tmweb.ru/postnikov/authorization.php">вход для клиентов</a></li>
		
    </ul>
		</nav>
	</header>
	<main>
		
	<?if ($login && $password):?>
	
	<?
		$_SESSION['post123'] = $login;
		$sessName=$_SESSION['post123'];
		
		$login=htmlspecialchars($login);
		$login=trim($login);
		$login=stripslashes($login);			
		$password=htmlspecialchars($password);
		$password=trim($password);
		$password=stripslashes($password);
		$password=strrev($password);
		$password = md5($password);
		$checkLogin=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$login' && password='$password'");
		$arrayCheckLogin=mysqli_fetch_array($checkLogin);
		$idLogin=$arrayCheckLogin['id'];
		$checkName=mysqli_query ($db, "SELECT name FROM ps_client WHERE idlogin = '$idLogin'");
		$arrayCheckName=mysqli_fetch_array($checkName);
		$userName=$arrayCheckName['name'];
				
			if (isset($arrayCheckLogin)) {
				echo "Поздравляем! ".$userName.", Вы авторизовались!"." Ваш логин ".$sessName."<a href='http://cp81961.tmweb.ru/postnikov/sess2.php'>жми сюда</a>";
			} else {
				exit ('авторизация не прошла. Введен неверный логин или пароль.<br><a href="http://cp81961.tmweb.ru/postnikov/authorization.php">пробовать снова</a>');
			}
	?>
	<?else:?>
		<form action="../postnikov/sess1.php" method="post">
			<div class="container_form">
				<label for="logan">введите логин</label>
					<input type="text" id="login" name="login" class="mini_textarea">
			</div>
			<div class="container_form">
				<label for="password">введите пароль</label>
					<input type="password" id="password" name="password" class="mini_textarea">
			</div>
				<button type="submit" class="btn">отправить</button>
		</form>
	<?endif?>	
	</main>
	
</body>
</html>