<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 15.08.2017
 * Time: 22:03
 */
session_start();
include ("../postnikov/admin/db.php");
$sessName=$_SESSION['pssess'];
if (isset($_POST['idclient'])) {$idClient=$_POST['idclient'];}
if (isset($_GET['order'])) {$order=$_GET['order'];}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../postnikov/css/style.css">
    <title>TU-WORLD</title>
</head>
<body>
    <? include  ("../postnikov/header.php")?>
<main>
    <?if ($idClient):?>
        <?

        $scanOrderClient=mysqli_query($db, "SELECT * FROM ps_order WHERE idclient = '$idClient'");
        $arrayScanOrderClient=mysqli_fetch_array($scanOrderClient);
        if (isset($arrayScanOrderClient['id'])) {
            do {
            printf(" <a href='../postnikov/view_orders_customer.php?order=%s'>Ваш заказ № %s от %s</a></p>", $arrayScanOrderClient['id'], $arrayScanOrderClient['id'], $arrayScanOrderClient['createdate']);
            } while ($arrayScanOrderClient=mysqli_fetch_array($scanOrderClient));
        } else {echo $arrayCheckName['name'].' пока не сделал(а) заказов';};

        ?>
    <?elseif ($order) :?>
        <?
        
        ?>
    <?else:?>
    <form action="../postnikov/view_orders_customer.php" method="post">
        <div class="container_form">
            <label for="id_client">выбирете фио</label>
            <select name="idclient" class="select" id="id_client">

                <?
                $checkName=mysqli_query ($db, "SELECT * FROM ps_client") or die();
                $arrayCheckName=mysqli_fetch_array($checkName);
                do{
                    printf ("<option value='%s'>%s %s %s</option>", $arrayCheckName['id'],$arrayCheckName['surname'],$arrayCheckName['name'],$arrayCheckName['patronymic']);
                } while ($arrayCheckName=mysqli_fetch_array($checkName));
                ?>
            </select>
            <button type='submit' class='btn'>просмотр заказа</button>
        </div>
    </form>


    <?endif?>
</main>

</body>
</html>
