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
if(isset($_POST['pic'])) {$pic=$_POST['pic'];}

?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../postnikov/css/style.css">
	<title>редактирование</title>
</head>
<body>
<? include  ("../postnikov/header.php")?>
	<main>
	<?if ($idGet):?>
	<?
		$client=mysqli_query($db, "SELECT * FROM ps_client WHERE id='$idGet'");
		$rezult=mysqli_fetch_array($client);
	?>
		<form action="../postnikov/index.php" enctype="multipart/form-data" method="post">
			<h3>введите ваши данные</h3>
			<div class="container_form">
				<label for="surname">фамилия</label>
				<input type="text" name="surname" id="surname" class="mini_textarea" placeholder="Иванов">
			</div>
			<div class="container_form">	
				<label for="name">имя</label>
				<input type="text" name="name" id="name" class="mini_textarea" placeholder="Иван">
			</div>
			<div class="container_form">	
				<label for="patronymic">отчество</label>
				<input type="text" name="patronymic" id="patronymic" class="mini_textarea" placeholder="Иванович">
			</div>
			<div class="container_form">	
				<p>пол</p>
					<input type="radio" name="sex" id="man" value="man" class="checkbox" checked>
						<label for="man">мужской</label>
					<input type="radio" name="sex" id="woman"  value="woman" class="checkbox">
						<label for="woman">женский</label>
			</div>
			<div class="container_form">	
				<label for="date">дата рождения</label>
					<input type="date" name="date" id="date" class="mini_textarea">
			</div>
			<div class="container_form">	
				<label for="visa">заграничный паспорт</label>
					<input type="checkbox" name="visa" id="visa" value="yes" class="checkbox">
			</div>
			<div class="container_form">	
				<label for="e_mail">e-mail</label>
				<input type="text" name="e_mail" id="e_mail" class="mini_textarea" placeholder="name@mail.ru">
			</div>
			<div class="container_form">	
				<label for="pic">ваше фото</label>
				<input type="file" name="pic" id="pic">
			</div>
			<div class="container_form">	
				<label for="pic">ваше фото</label>
				<input type="file" name="pic" id="pic">
				<img src="<?rezult['pic']?>" alt="" width="100">
			</div>
				<button type="submit" class="btn">отправить</button>
		</form>
	<?elseif ($idPost):?>
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