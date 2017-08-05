<?
session_start();
setcookie ("worktime", "Work Time", time()+10);
$link = mysqli_connect ('localhost','cp81961_grope2','kostroma44','cp81961_grope2');
?>
<?if (!$link) {
	die('Ошибка подключения к БД' . mysql_error());
}
echo 'Подключение к БД ОК!';
?>
<?
if(isset($_POST['short_country'])) {$short_country=$_POST['short_country'];}
if(isset($_POST['country'])) {$country=$_POST['country'];}
if(isset($_POST['visa_country'])) {$visa_country=$_POST['visa_country'];}
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">	
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
	<main>
		<?if(isset($short_country)):?>
		<?$area=mysqli_query($link, "INSERT INTO ps_country (short_country, country, visa_country) VALUES ('$short_country', '$country', '$visa_country')");
		if($area == true) {echo 'Название страны внесено <a href="http://cp81961.tmweb.ru/postnikov/country.php">назад</a>';
		} else {echo 'Название страны НЕ внесено <a href="http://cp81961.tmweb.ru/postnikov/country.php">назад</a>';}
		?>
		<? else:?>
			<form action="../postnikov/country.php" method="post">
			<h3>ввод данных по странам</h3>
			<div class="country_form">
				<label for="short_country">Краткое название страны</label>
				<input type="text" name="short_country" id="short_country" class="mini_textarea">
			</div>
			<div class="country_form">	
				<label for="country">полное название страны</label>
				<input type="text" name="country" id="country" class="mini_textarea">
			</div>
			<div class="country_form">	
				<p>необходимость визы</p>
					<input type="radio" name="visa_country" id="yes_visa" value="3" checked>
						<label for="yes_visa">нужна</label>
					<input type="radio" name="visa_country" id="no_visa"  value="1">
						<label for="no_visa">не нужна</label>
					<input type="radio" name="visa_country" id="border_visa"  value="2">
						<label for="border_visa">выдается на границе</label>						
			</div>
			
				<button type="submit" class="btn">отправить</button>
		</form>
		<?endif?>
	</main>
	<footer>
	</footer>
	
</body>
</html>