<?
session_start();
include ("../postnikov/admin/db.php");
if(isset($_GET['id'])) {$idGet=$_GET['id'];}
if(isset($_POST['id'])) {$idPost=$_POST['id'];}
if(isset($_POST['surname'])) {$surname=$_POST['surname'];}
if(isset($_POST['name'])) {$name=$_POST['name'];}
if(isset($_POST['patronymic'])) {$patronymic=$_POST['patronymic'];}
if(isset($_POST['sex'])) {$sex=$_POST['sex'];}
if(isset($_POST['date'])) {$date=$_POST['date'];}
if(isset($_POST['visa'])) {$visa=$_POST['visa'];}
if(isset($_POST['e_mail'])) {$e_mail=$_POST['e_mail'];}
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../postnikov/css/style.css">
	<title>редактирование</title>
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
	<?if ($idGet):?>
	<?
  	$client=mysqli_query($db, "SELECT * FROM ps_client WHERE id='$idGet'");
  	$rezult=mysqli_fetch_array($client);
	echo print_r($rezult);
  	?>
		<form action="../postnikov/edit.php" method="post" enctype="multipart/form-data" >
			<h3>введите ваши данные</h3>
			<div class="container_form">
				<label for="surname">фамилия</label>
				<input type="text" name="surname" id="surname" class="mini_textarea" value="<?=$rezult['surname']?>">
			</div>
			<div class="container_form">	
				<label for="name">имя</label>
				<input type="text" name="name" id="name" class="mini_textarea" value="<?=$rezult['name']?>">
			</div>
			<div class="container_form">	
				<label for="patronymic">отчество</label>
				<input type="text" name="patronymic" id="patronymic" class="mini_textarea" value="<?=$rezult['patronymic']?>">
			</div>
			<div class="container_form">	
				<p>пол</p>
					<input type="radio" name="sex" id="man" value="man" value="<?=$rezult['sex']?>">
						<label for="man">мужской</label>
					<input type="radio" name="sex" id="woman"  value="woman" value="<?=$rezult['sex']?>">
						<label for="woman">женский</label>
			</div>
			<div class="container_form">	
				<label for="date">дата рождения</label>
					<input type="date" name="date" id="date" class="mini_textarea" value="<?=$rezult['date']?>">
			</div>
			<div class="container_form">	
				<label for="visa">заграничный паспорт</label>
					<input type="checkbox" name="visa" id="visa" value="yes" class="checkbox" value="<?=$rezult['visa']?>">
					<input type="hidden" name="id" value="<?=$rezult['id']?>">
			</div>
			<div class="container_form">	
				<label for="e_mail">e-mail</label>
				<input type="text" name="e_mail" id="e_mail" class="mini_textarea" value="<?=$rezult['e_mail']?>">
			</div>
			<div class="container_form">	
				<label for="pic">ваше фото</label>
				<input type="file" name="pic" id="pic">
				<img src="<?=$rezult['pic']?>" alt="" width="100">
			</div>
				<button type="submit" class="btn">отправить</button>
		</form>
	 <?elseif ($idPost):?>
	 <?=$idPost?>
	 <?
		if ($_FILES['pic']['error']==0) {
			$error=($_FILES['pic']['error']);
			$type=($_FILES['pic']['type']);
			$track=($_FILES['pic']['tmp_name']);
			$picName=explode ('/',$type);
			$picExtension=$picName[1];
			$client_pic=mysqli_query($db, "SELECT pic FROM ps_client WHERE id='$idPost'");
			$arrayPic=mysqli_fetch_array($client_pic);
		if (isset($arrayPic['pic'])) {
			$pict=$arrayPic['pic'];
			unlink($pict);
			$nameDate=substr($pict, 17, 14);
			$picExtension=substr($pict, 32);			
} else {
	$nameDate=date(YmdHis);
}
			if (
				($picExtension='jpeg' || $picExtension='gif' || $picExtension='png') && (isset($surname)) && ($error==0)
				)
				{
					$endName='../postnikov/pic/'.$nameDate.'.'.$picName[1];
					$saveFile=move_uploaded_file($_FILES['pic']['tmp_name'], $endName);
						if ($saveFile==true) {
							$client = mysqli_query($db, "UPDATE ps_client SET surname='$surname', name='$name', patronymic='$patronymic', sex='$sex',date='$date', visa='$visa', e_mail='$e_mail', pic='$endName' WHERE id='$idPost'");
								if ($client==true) {
									echo 'данные внесены';
								}
								else {
									unlink ($endName);
									echo 'данные НЕ внесены';
								}
						} else {
							echo 'файл не загрузился'.$error.$type.$track;
						}
				} 
				else {
					if (isset($surname)) {
						$client = mysqli_query($db, "INSERT INTO ps_client(surname, name, patronymic, sex, date, visa, e_mail, pic, createdate) VALUES ('$surname','$name','$patronymic','$sex','$date','$visa','$e_mail','$endName',(NOW()))");
								if ($client=true) {
									echo 'данные внесены без картинки';
								}
								else {
									echo 'данные НЕ внесены';
								}	
					}
					else {echo 'ничего не работает';}
				}
				}
	 else {
	 $client=mysqli_query($db, "UPDATE ps_client SET surname='$surname', name='$name', patronymic='$patronymic', sex='$sex',date='$date', visa='$visa', e_mail='$e_mail', WHERE id='$idPost'");//указываем, какому столбцу соответствует какая переменная
		if ($client=true) {
			echo "данные отредактированны<br>"."<a href='../postnikov/edit.php'>назад</a>";
		} else {
			echo "данные НЕ отредактированны";
		}
		}
	?>
	<?else:?>
	<?
  		$client=mysqli_query($db, "SELECT * FROM ps_client");
  		$rezult=mysqli_fetch_array($client);
		do {
  			printf ("<p><a href='../postnikov/edit.php?id=%s'>%s %s %s %s %s %s %s %s</a></p>", $rezult['id'], $rezult['surname'], $rezult['name'], $rezult['patronymic'], $rezult['sex'], $rezult['date'], $rezult['visa'], $result['e_mail'], $result['pic'] );
  		} while ($rezult=mysqli_fetch_array($client));
  	?>
    <?endif?>
	</main>
	
</body>
</html>