<?
$db = mysqli_connect ('localhost','cp81961_grope2','kostroma44','cp81961_grope2');
?>
<?if (!$db) {
	die('Ошибка подключения к БД' . mysql_error());
}
echo 'Подключение к БД ОК!';
?>