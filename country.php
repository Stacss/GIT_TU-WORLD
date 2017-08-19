<?
session_start();
setcookie ("worktime", "Work Time", time()+10);
$link = mysqli_connect ('localhost','cp81961_grope2','kostroma44','cp81961_grope2');
if(isset($_POST['short_country'])) {$short_country=$_POST['short_country'];}
if(isset($_POST['country'])) {$country=$_POST['country'];}
if(isset($_POST['visa_country'])) {$visa_country=$_POST['visa_country'];}
if(isset($_POST['number_people'])) {$number_people=$_POST['number_people'];}

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
<? include  ("../postnikov/header.php")?>
	<main>
		<?if(isset($short_country)):?>
		<?$area=mysqli_query($link, "INSERT INTO ps_country (short_country, country, visa_country, max_people) VALUES ('$short_country', '$country', '$visa_country', '$number_people')");
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
            <div class="country_form">
				<p>максимальное колличество туристов</p>
					<input type="radio" name="number_people" id="number1" value="1" checked>
						<label for="number1"> - 1  </label>
					<input type="radio" name="number_people" id="number2"  value="2">
						<label for="number2"> - 2  </label>
					<input type="radio" name="number_people" id="number3"  value="3">
						<label for="number3"> - 3  </label>
                    <input type="radio" name="number_people" id="number4"  value="4">
						<label for="number3"> - 4  </label>
                    <input type="radio" name="number_people" id="number5"  value="5">
						<label for="number3"> - 5  </label>

			</div>
			
				<button type="submit" class="btn">отправить</button>
		</form>
		<?endif?>
	</main>
	<footer>
	</footer>
	
</body>
</html>