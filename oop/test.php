<?
session_start();
if (isset($_POST['money'])) {$money=$_POST['money'];}
if (isset($_POST['moneynds'])) {$moneyNds=$_POST['moneynds'];}
if (isset($_POST['sale'])) {$sale=$_POST['sale'];}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../oop/css/style.css">
    <title>TU-WORLD</title>
</head></head>
<body>

<? include ("header.php") ;
    $uuu = include ("functions/class.php") ;

?>

<main>
<?if ($money):?>
<?
    $_SESSION['money']=$money;
$ggg=new Money();
$ggg->setMoney($money);
echo 'Введена сумма '.$money.'<br>';
echo $ggg->getMoney();
?>
    <div class="container_form">
        <form action="test.php" method="post">
            <label for="sale" class="">Введите скидку в %:</label>
            <input type="text" name="sale" id="sale" class="mini_textarea">
            <button type="submit" class="btn">Рассчитать</button>
        </form>
    </div>
    <a href="test.php">назад</a>
    <?elseif ($moneyNds):?>
    <?
    $ggg=new Money();
    $ggg->setMoney($moneyNds);
    echo 'Введена сумма '.$moneyNds.'<br>';
    echo $ggg->getMoneyNds();
    ?>
    <a href="test.php">назад</a>
    <?elseif ($sale):?>
    <?
    $money=$_SESSION['money'];
    $ggg=new Summ();
    $ggg->setSale($sale, $money);
    echo $ggg->getSale();?>
    <a href="test.php">в начало</a>
    <?else:?>
    <div class="container_form">
        <form action="test.php" method="post">
            <label for="money" class="">Введите цену товара для установления конечной цены и НДС закупки товара:</label>
            <input type="text" name="money" id="money" class="mini_textarea">
            <button type="submit" class="btn">Рассчитать</button>
        </form>
    </div>
    <div class="container_form">
        <form action="test.php" method="post">
            <label for="moneynds" class="">Введите начальную цену товара чтобы узнать НДС:</label>
            <input type="text" name="moneynds" id="moneynds" class="mini_textarea">
            <button type="submit" class="btn">Рассчитать</button>
        </form>
    </div>
<?endif?>
</main>
</body>
</html>
