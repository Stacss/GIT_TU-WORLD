<?
	session_start();
	include ("../postnikov/admin/db.php");
	if (isset($_POST['id'])) {$id=$_POST['id'];}
	if (isset($_POST['country'])) {$country=$_POST['country'];}
	if (isset($_POST['dateend'])) {$dateEnd=$_POST['dateend'];}
	if (isset($_POST['datestart'])) {$dateStart=$_POST['datestart'];}
	if(isset($_GET['createdate'])) {$createDate=$_GET['createdate'];}
	
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
		<?if ($createDate):?>
		<?
		$searchCountry=mysqli_query ($db, "SELECT * FROM ps_order_country WHERE createdate = '$createDate'")/* or die(mysql_error())*/;
		$arraySearchCountry=mysqli_fetch_array($searchCountry);
		$searchDate=mysqli_query ($db, "SELECT * FROM ps_order WHERE createdate = '$createDate'")/* or die(mysql_error())*/;
		$arraySearchDate=mysqli_fetch_array($searchDate);
		
		do{
			printf("Дата начала тура %s<br>Дата конца тура %s<br>", $arraySearchDate['datestart'], $arraySearchDate['dateend']);
		} while ($arraySearchDate=mysqli_fetch_array($searchDate));
		
		
		echo "Выбранная страна(ы):<br>";
		
		
		do {
			$id_country=$arraySearchCountry['idcountry'];
			$nameCountry=mysqli_query ($db, "SELECT country FROM ps_country WHERE id = '$id_country'")/* or die(mysql_error())*/;
			$countryresult=mysqli_fetch_array($nameCountry);
			do {
			printf("%s.<br>", $countryresult['country']);
			} while ($countryresult=mysqli_fetch_array($nameCountry));
			
			//printf("%s.<br>", $arraySearchCountry['idcountry']);
		} while ($arraySearchCountry=mysqli_fetch_array($searchCountry));
		?>
		
		
		<?elseif ($_SESSION['pssess']):?>
		<?
		
		$countPage=5;
		
		if ($_GET["page"]) {
			$page = $_GET["page"];
		} else {
			$page = 1;
		}
		$idLogin=$_SESSION['pssessid'];
		$getIdClient=mysqli_query($db, "SELECT id FROM ps_client WHERE idlogin = '$idLogin'");
		$arrayIdClient=mysqli_fetch_array ($getIdClient);
		$idClient=$arrayIdClient['id'];
		echo 'id client = '.$idClient.'<br>';		
		$allOrders = mysqli_query($db, "SELECT * FROM ps_order WHERE idclient = '$idClient'");
		$numberAllOrders = mysqli_num_rows($allOrders);
		$numPages = $numberAllOrders/$countPage;
		$allPages = ceil($numPages);
		$numberRow = $countPage * ($page - 1);
		$pickRows = mysqli_query($db,"SELECT * FROM ps_order LIMIT $numberRow, $countPage");
		$arrayPickRows = mysqli_fetch_array($pickRows);
		
	    
	    
		do {
			printf("Ваш заказ <a href='../postnikov/my_orders.php?createdate=%s'>от %s</a></p>", $arrayPickRows['createdate'], $arrayPickRows['createdate']);
			
		}
		while ($arrayPickRows = mysqli_fetch_array($pickRows));
		  
		if (isset($_GET["page"]) && ($_GET["page"]!=1)) {
			echo "<a href='http://cp81961.tmweb.ru/postnikov/my_orders.php'>Первая</a>";
		}
		if (empty($_GET["page"])) {
			$i = 2;
			echo "1";
		} else {
			$i = 1;
		}
		if (isset($_GET["page"]) && ($_GET["page"] != 1) && ($_GET["page"] != 2)) {
			$pageGet=$_GET["page"];
			$backPage=$pageGet-1;
			echo "<a href='http://cp81961.tmweb.ru/postnikov/my_orders.php?page=$backPage'> предыдущая </a>";
		}
		  
		do {
			if ($i == $_GET["page"]) {
				echo $i;
			} else {
				echo "<a href='http://cp81961.tmweb.ru/postnikov/my_orders.php?page=$i'> $i </a>";
			}
			$i++;
		} while ($i <= $allPages);
		if (isset($_GET["page"]) && ($_GET["page"] != $allPages) && ($_GET["page"] != ($allPages - 1))) {
			$nextPage=$pageGet+1;
			echo "<a href='http://cp81961.tmweb.ru/postnikov/my_orders.php?page=$nextPage'> Следующая </a>";
		}
		if (isset($_GET["page"]) && ($_GET["page"]!=$allPages)) {
			echo "<a href='http://cp81961.tmweb.ru/postnikov/my_orders.php?page=$allPages'> Последняя </a>";
		}
		/*$sessName=$_SESSION['pssess'];
		$order=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$sessName'") or die(mysql_error());
		$arrayOrder=mysqli_fetch_array($order);
		$idLogin=$arrayOrder['id'];
		
		$idClient=mysqli_query ($db, "SELECT id FROM ps_client WHERE idlogin = '$idLogin'") or die(mysql_error());
		$arrayIdClient=mysqli_fetch_array($idClient);
		$idClient1=$arrayIdClient['id'];
		
			$ordersCountry=mysqli_query ($db, "SELECT * FROM ps_order_country WHERE idclient = '$idClient1'") or die(mysql_error());
			$arrayOrdersCountry=mysqli_fetch_array($ordersCountry);
			$orderTime=$arrayOrdersCountry['createdate'];
			
			$orderClient=mysqli_query ($db, "SELECT * FROM ps_order WHERE idclient = '$idClient1'") or die(mysql_error());
			$arrayOrderClient=mysqli_fetch_array($orderClient);
			$orderTimeCountry=$arrayOrderClient['createdate'];
			if (isset($orderTimeCountry)) {
			do {
				printf("Ваш заказ <a href='../postnikov/my_orders.php?createdate=%s'>от %s</a></p>", $arrayOrderClient['createdate'], $arrayOrderClient['createdate']);
			} while ($arrayOrderClient=mysqli_fetch_array($orderClient));
			} else {
				echo "У Вас еще нет заявок на тур.";
			} 
			
			
		
		
		echo $userName."Ваши заявки".$idClient;
		*/
		
		
		
		?>
		
		
		<?else:?>
		<?echo "вы не авторизованы!";?>
		<?endif?>
		
	
	</main>
</body>
</html>