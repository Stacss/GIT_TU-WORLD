<?
include ("../postnikov/oop/admin/db.php");
if(isset($_GET['view_countries'])) {$view=$_GET['view_countries'];}
if(isset($_GET['surname'])) {$getSurname=$_GET['surname'];}

$host = 'localhost';
$db   = 'cp81961_grope2';
$user = 'cp81961_grope2';
$pass = 'kostroma44';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";// задается тип БД, с которым будем работать (mysql), хост, имя базы данных и чарсет
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../oop/css/style.css">
    <title>TU-WORLD</title>
</head>
<body>
<? include ("../oop/header.php") ;?>
    <main>
        <?if ($view):?>
        <?

            $readBd = $pdo->query('SELECT short_country FROM ps_country');
            while ($read = $readBd->fetch())
            {
                echo $read['short_country'] . "<br>";
            };
        ?>
            <?elseif ($getSurname): ?>
            <?
            $readBd = $pdo->query('SELECT * FROM ps_client');
            $i=0;

            while ($read = $readBd->fetch())
            {
                $i++;
                echo $i.' '. $read['surname'] . " ".$read['name']."<br>";
            };
            ?>
        <?else:?>
        <a href="http://cp81961.tmweb.ru/postnikov/oop/view_countries.php?view_countries=1">Просмотреть список стран!</a><br>
        <a href="http://cp81961.tmweb.ru/postnikov/oop/view_countries.php?surname=1">Просмотреть список Клиентов!</a>

        <?endif?>
<?

?>

    </main>
    <footer>
    </footer>

    </body>
</html>
