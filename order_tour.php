<?
	session_start();
	include ("../postnikov/admin/db.php");
	if (isset($_POST['id'])) {$id=$_POST['id'];}
	if (isset($_POST['country'])) {$country=$_POST['country'];}
	if (isset($_POST['dateend'])) {$dateEnd=$_POST['dateend'];}
	if (isset($_POST['datestart'])) {$dateStart=$_POST['datestart'];}
	
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
		<?
		if ($sessName && $id && $country && $dateStart && $dateEnd):?>
		<?
		$arrayOrder=mysqli_query($db, "INSERT INTO ps_order (idclient, datestart, dateend, createdate) VALUES ('$id','$dateStart','$dateEnd',(NOW()))");
		$idOrder = mysqli_insert_id($db);
		$sunString=count($country);
		$i=0;
		do {
		$arrayCountry=mysqli_query($db, "INSERT INTO ps_order_country (idclient, idcountry, idorder, createdate) VALUES ('$id','$country[$i]', '$idOrder', (NOW()))");
			if ($arrayOrder==true && $arrayCountry==true) {
				echo '<br>данные в таблицы занесены';
			} else {
				echo '<br>данные в таблицы НЕ занесены';
			}
			$i++;
			} while ($i<$sunString);
		echo 'переменная передалась, все ок. ID клиента - '.$id.'<br>'.'ID заказа - '.$idOrder.'<br> дата начала тура - '.$dateStart.'<br> дата конца тура - '.$dateEnd;
		echo '<a href="http://cp81961.tmweb.ru/postnikov/order_tour.php">назад</a>';?>
	
		<?elseif ($sessName):?>
		<?="ВСЕ ОК";?>
		<form method='post' action='order_tour.php'>
			<div class="container_form">
				<label for="id_client">выбирете фио</label>
					<select name="id" class="select" id="id_client">
						
		<?
			$sessName=$_SESSION['pssess'];
				$checkLogin=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$sessName'") or die(mysql_error());
				$arrayCheckLogin=mysqli_fetch_array($checkLogin);
				$idLogin=$arrayCheckLogin['id'];
				$checkName=mysqli_query ($db, "SELECT * FROM ps_client WHERE idlogin = '$idLogin'") or die(mysql_error());
				$arrayCheckName=mysqli_fetch_array($checkName);
				
			
				
			
			do{
			printf ("<option value='%s' selected>%s %s %s</option>", $arrayCheckName['id'],$arrayCheckName['surname'],$arrayCheckName['name'],$arrayCheckName['patronymic']);	
				} while ($arrayCheckName=mysqli_fetch_array($checkName));
			
		?>
				</select>
			</div>
			<div class="container_form">
				<label for="datestart">начало тура</label>
					<input type="date" name="datestart" class="mini_textarea" id="datestart"  placeholder="10.06.2010">
			</div>
			<div class="container_form">
				<label for="dateend">конец тура</label>
					<input type="date" name="dateend" class="mini_textarea" id="dateend"  placeholder="20.06.2010">
			</div>
			<div class="container_form">
			<p>выберете страну</p><br>
		<?
			$arrayCountry=mysqli_query($db, "SELECT * FROM ps_country");
			$stringDataCountry=mysqli_fetch_array($arrayCountry);
			do {
				printf ("<input type='checkbox' name='country[]' value='%s' id='%s' class='checkbox'><label for='%s'> %s </label><br>
				", $stringDataCountry['id'],$stringDataCountry['id'],$stringDataCountry['id'],$stringDataCountry['short_country']);
			} while ($stringDataCountry=mysqli_fetch_array($arrayCountry));
			
		?>
			</div>
			
			<button type='submit' class='btn'>отправить</button>
		</form>
		
		
		
		<?elseif ($id && $country && $dateStart && $dateEnd):?>
		<?
		$arrayOrder=mysqli_query($db, "INSERT INTO ps_order (idclient, datestart, dateend, createdate) VALUES ('$id','$dateStart','$dateEnd',(NOW()))");
		$sunString=count($country);
		$i=0;
		do {
		
		
		
		$arrayCountry=mysqli_query($db, "INSERT INTO ps_order_country (idclient, idcountry, createdate) VALUES ('$id','$country[$i]',(NOW()))");
			if ($arrayOrder==true && $arrayCountry==true) {
				echo '<br>данные в таблицы занесены';
			} else {
				echo '<br>данные в таблицы НЕ занесены';
			}
			$i++;
			} while ($i<$sunString);
		echo 'переменная передалась, все ок. ID клиента - '.$id.'<br> ID страны - '.$country.'<br> дата начала тура - '.$dateStart.'<br> дата конца тура - '.$dateEnd;
		print_r($country);
		echo '<a href="http://cp81961.tmweb.ru/postnikov/order_tour.php">назад</a>';?>
		<?else:?>
		<form method='post' action='order_tour.php'>
			<div class="container_form">
				<label for="id_client">выбирете фио</label>
					<select name="id" class="select" id="id_client">
						<option disabled selected>для выбора нажмите тут</option>
		<?
			$arrayClient=mysqli_query($db, "SELECT * FROM ps_client");
			$stringDataClient=mysqli_fetch_array($arrayClient);
			do {
				printf ("<option value='%s'>%s %s %s</option>", $stringDataClient['id'],$stringDataClient['surname'],$stringDataClient['name'],$stringDataClient['patronymic']);				
			} while ($stringDataClient=mysqli_fetch_array($arrayClient));
		?>
				</select>
			</div>
			<div class="container_form">
				<label for="datestart">начало тура</label>
					<input type="date" name="datestart" class="mini_textarea" id="datestart"  placeholder="10.06.2010">
			</div>
			<div class="container_form">
				<label for="dateend">конец тура</label>
					<input type="date" name="dateend" class="mini_textarea" id="dateend"  placeholder="20.06.2010">
			</div>
			<div class="container_form">
			<p>выберете страну</p><br>
		<?
			$arrayCountry=mysqli_query($db, "SELECT * FROM ps_country");
			$stringDataCountry=mysqli_fetch_array($arrayCountry);
			do {
				printf ("<input type='checkbox' name='country[]' value='%s' id='%s' class='checkbox'><label for='%s'> %s </label><br>
				", $stringDataCountry['id'],$stringDataCountry['id'],$stringDataCountry['id'],$stringDataCountry['short_country']);
			} while ($stringDataCountry=mysqli_fetch_array($arrayCountry));
			
		?>
			</div>
			
			<button type='submit' class='btn'>отправить</button>
		</form>
		<?endif?>
		
	
	</main>
</body>
</html>