<?
session_start();
include ("../postnikov/admin/db.php");
if (isset($_POST['id'])) {$id=$_POST['id'];}
?>
<!doctype html>
<html lang="кг">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../postnikov/css/style.css">
	<title>удаление клиента</title>
</head>
<body>
<? include  ("../postnikov/header.php")?>
	<main>
	<?if ($id):?>		
	<?
		$elements=count($id);
		$i=0;
		print_r($id);
		do{
		$client=mysqli_query($db, "DELETE FROM ps_client WHERE id='$id[$i]'");
		if ($client==true) {
		echo 'удалено: '.$elements.' клиентов справа'.$i.'слева<br>'.print_r($client);
		} else {
			echo "не удалено";
		}
		$i++;
		} while ($i<$elements);
	?>

  	<?else:?>
	<form action="../postnikov/delete_client.php" method="post" enctype="multipart/form-data">
  	<?
  		$client=mysqli_query($db, "SELECT * FROM ps_client");
  		$rezult=mysqli_fetch_array($client);
  		do {
  			printf ("<input type='checkbox' name='id[]' value='%s'> %s %s %s %s %s %s <br>
			", $rezult['id'], $rezult['surname'], $rezult['name'], $rezult['patronymic'], $rezult['sex'], $rezult['date'], $rezult['visa']);
  		} while ($rezult=mysqli_fetch_array($client));
  	?>
	
		<button type="submit" class="btn">Удалить</button>
	</form>
    <?endif?>
	</main>
	
</body>
</html>