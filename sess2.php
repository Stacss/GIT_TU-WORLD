<?
session_start();
include ("../postnikov/admin/db.php");

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
		
	<?
	$nameSses=$_SESSION['post123'];
  echo ($nameSses).' вы пришли на другую страницу этого сайта!';
  echo("<br>");
  
  echo session_id()."<br>";
  
  echo session_name().' = '.session_id();
  session_unset();
   session_destroy();
	echo $_SESSION['post123'];
?>
	</main>
	
</body>
</html>