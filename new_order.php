<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 08.08.2017
 * Time: 10:32
 */
session_start();
include ("../postnikov/admin/db.php");
if (isset($_POST['id'])) {$id=$_POST['id'];}
if (isset($_POST['country'])) {$country=$_POST['country'];}
if (isset($_POST['dateend'])) {$dateEnd=$_POST['dateend'];}
if (isset($_POST['datestart'])) {$dateStart=$_POST['datestart'];}
if(isset($_GET['createdate'])) {$createDate=$_GET['createdate'];}
if (isset($_POST['count'])) {$count=$_POST['count'];}
if(isset($_POST['number_people'])) {$number_people=$_POST['number_people'];}
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
    $idOrder1 = mysqli_insert_id($db);
    $sunString=count($country);
    $i=0;
    do {
        $arrayCountry=mysqli_query($db, "INSERT INTO ps_order_country (idclient, idcountry, idorder, num_people, createdate) VALUES ('$id','$country[$i]', '$idOrder1', '$number_people', (NOW()))");
        $i++;
    } while ($i<$sunString);

    $keyCountry=1;
    foreach ($country as $valueCountry) {
        $CountryList->{$keyCountry}=$valueCountry;
        $keyCountry++;
    }
    $jsonCountryList=json_encode($CountryList);

    $recOrder=mysqli_query($db, "INSERT INTO ps_new_order (idclient, countrys, datestart, dateend, createdate) VALUES ('$id','$jsonCountryList','$dateStart','$dateEnd', (NOW()))");
    $idOrder=mysqli_insert_id($db);

   if ($recOrder==true)
   {
    echo '<h4>Ваш заказ принят!</h4>'.'<br>'.'Номер заказа - '.$idOrder.'<br> дата начала тура - '.$dateStart.'<br> дата конца тура - '.$dateEnd.'<br>Выбранные страны: ';$readOrder=mysqli_query ($db, "SELECT 	countrys FROM ps_new_order WHERE id = '$idOrder'") or die(mysql_error());
    $arrayReadOrder=mysqli_fetch_array($readOrder);
    $jsonReadCountryList=$arrayReadOrder['countrys'];
    $listCountry=json_decode($jsonReadCountryList);
    $i=1;
    foreach ($listCountry as $cntry) {
        $getNameCountry=mysqli_query ($db, "SELECT country FROM ps_country WHERE id = '$cntry'") or die(mysql_error());
        $arrayGetNameCountry=$arrayReadOrder=mysqli_fetch_array($getNameCountry);
        $NameCountry=$arrayGetNameCountry['country'];
        $jsonCountry -> {$i} = $NameCountry;
        $i++;
        echo '<br>'.$NameCountry;
   }

       $jsonCountry=json_encode($jsonCountry, JSON_UNESCAPED_UNICODE);
       $getInfoClient=mysqli_query ($db, "SELECT surname, name, patronymic, sex, date	, visa FROM ps_client WHERE id = '$id'") or die(mysql_error());
       $arrayGetInfoClient=mysqli_fetch_array($getInfoClient);

       $family=$arrayGetInfoClient['surname'];
        if ($family==null) {$family='no';};
       $name=$arrayGetInfoClient['name'];
        if ($name==null) {$name='no';};
       $secname=$arrayGetInfoClient['patronymic'];
        if ($secname==null) {$secname='no';};
       $sex=$arrayGetInfoClient['sex'];
        if ($sex=='man'){$sex='men';} else {$sex='women';};
       $birthday=$arrayGetInfoClient['date'];
        if ($birthaday==null){$birthaday='no';};
       $visa=$arrayGetInfoClient['visa'];
         if ($visa==null){$visa='no';} else {$visa='yes';};
       $formatSendingOrderData->{'family'} = $family;
       $formatSendingOrderData->{'name'} = $name;
       $formatSendingOrderData->{'secname'} = $secname;
       $formatSendingOrderData->{'sex'} = $sex;
       $formatSendingOrderData->{'birthdate'} = $birthday;
       $formatSendingOrderData->{'visa'} = $visa;
       $formatSendingOrderData->{'countrys'} = $jsonCountry;
       $formatSendingOrderData->{'begin'} = $dateStart;
       $formatSendingOrderData->{'end'} = $dateEnd;
       $jesonFormatSendingOrderData=json_encode($formatSendingOrderData, JSON_UNESCAPED_UNICODE);

       $importBooking=mysqli_query ($db,"INSERT INTO ps_import_order (infoorder, createdate) VALUES ('$jesonFormatSendingOrderData',(NOW()))");
        if ($importBooking == true) {
            echo '<br>данные заказа отправленны в отель';
        } else {
            echo 'все хреново, отдыхай в огороде!';
        };
       echo '<br><a href="http://cp81961.tmweb.ru/postnikov/new_order.php">назад</a>';





   }?>

<?elseif ($sessName):?>
    <form method='post' action='new_order.php'>
            <input type="hidden" name="id" class="select" id="id_client" value="<?echo $_SESSION['psIdClient'];?>">
            </input>
        <div class="container_form">
            <label for="datestart">начало тура</label>
            <input type="date" name="datestart" class="mini_textarea" id="datestart"  placeholder="10.06.2010">
        </div>
        <div class="container_form">
            <label for="dateend">конец тура</label>
            <input type="date" name="dateend" class="mini_textarea" id="dateend"  placeholder="20.06.2010">
        </div>
        <div class="country_form">
            <p>Колличество человек</p>
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
    <?=$sessName.$id.$country.$dateStart.$dateEnd?>
<?else:?>
    <?="Вы не авторизованы"?>
<?endif?>

</main>
</body>
