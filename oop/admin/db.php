
<?//задает параметры подключения к бд
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