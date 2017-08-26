<?
session_start();
include ("../postnikov/admin/db.php");
if(isset($_POST['surname'])) {$surname=$_POST['surname']; if ($surname=='') {unset($surname);}}
if(isset($_POST['name'])) {$name=$_POST['name']; if ($name=='') {unset($name);}}
if(isset($_POST['patronymic'])) {$patronymic=$_POST['patronymic']; if ($patronymic=='') {unset($patronymic);}}
if(isset($_POST['sex'])) {$sex=$_POST['sex']; if ($sex=='') {unset($sex);}}
if(isset($_POST['date'])) {$date=$_POST['date']; if ($date=='') {unset($date);}}
if(isset($_POST['visa'])) {$visa=$_POST['visa']; if ($visa=='') {unset($visa);}}
if(isset($_POST['tel'])) {$tel=$_POST['tel']; if ($tel=='') {unset($tel);}}
if(isset($_POST['rightsite'])) {$rightsite=$_POST['rightsite']; if ($rightsite=='') {unset($rightsite);}}
if(isset($_POST['e_mail'])) {$e_mail=$_POST['e_mail']; if ($e_mail=='') {unset($e_mail);}}
if(isset($_POST['login'])) {$login=$_POST['login']; if ($login=='') {unset($login);}}
if(isset($_POST['password'])) {$password=$_POST['password']; if ($password=='') {unset($password);}}
if(isset($_POST['personal_data'])) {$personalData=$_POST['personal_data']; if ($personalData=='') {unset($personalData);}}


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../postnikov/css/style.css">
    <title>TU-WORLD-регистрация</title>
</head>
<body>
<? include  ("../postnikov/header.php")?>
<main>
    <?if ($surname && $login && $password && $e_mail && $personalData):?>
        <?
        $login=htmlspecialchars($login);
        $login=trim($login);
        $login=stripslashes($login);
        $password=htmlspecialchars($password);
        $password=trim($password);
        $password=stripslashes($password);
        $password=strrev($password);
        $password = md5($password);
        $checkLogin=mysqli_query ($db, "SELECT login FROM ps_intake WHERE login = '$login'");
        $arrayCheckLogin=mysqli_fetch_array($checkLogin);
        if ($login==$arrayCheckLogin['login']) {
            $newLogin=$login."1";
            exit ("Данный логин уже существует! <br>Попробуйте логин $newLogin.<br><a href='http://cp81961.tmweb.ru/postnikov/intake.php'>назад</a>");
        } else {
            $checkLoginRec=mysqli_query ($db, "INSERT INTO ps_intake(login, password) VALUES ('$login','$password')");
            $getIdLogin=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$login'");
            $arrayGetIdLogin=mysqli_fetch_array($getIdLogin);
            $recIdLogin=$arrayGetIdLogin['id'];
            if ($checkLoginRec=true) {
                echo "запись логина и пароля прошла успешно! Ваш логин:".$login;
                $error=($_FILES['pic']['error']);
                $type=($_FILES['pic']['type']);
                $track=($_FILES['pic']['tmp_name']);
                $picName=explode ('/',$type);
                $picExtension=$picName[1];
                if (
                    ($picExtension='jpeg' || $picExtension='gif' || $picExtension='png') && (isset($surname)) && ($error==0)
                )
                {
                    $nameDate=date(YmdHis);
                    $endName='../postnikov/pic/'.$nameDate.'.'.$picName[1];
                    $saveFile=move_uploaded_file($_FILES['pic']['tmp_name'], $endName);
                    if ($saveFile==true) {
                        $client = mysqli_query($db, "INSERT INTO ps_client(idlogin, surname, name, patronymic, sex, date, visa, e_mail, pic, tel, rightsite, createdate) VALUES ('$recIdLogin','$surname','$name','$patronymic','$sex','$date','$visa','$e_mail','$endName','$tel','$rightsite',(NOW()))");
                        if ($client=true) {
                            echo 'данные внесены';
                        }
                        else {
                            unlink ($endName);
                            echo 'данные НЕ внесены';
                        }
                    } else {
                        echo 'файл не загрузился';
                    }
                }
                else {
                    if (isset($surname)) {
                        $client = mysqli_query($db, "INSERT INTO ps_client(idlogin, surname, name, patronymic, sex, date, visa, e_mail, pic, tel, rightsite, createdate) VALUES ('$recIdLogin','$surname','$name','$patronymic','$sex','$date','$visa','$e_mail','$endName','$tel','$rightsite',(NOW()))");
                    }
                    else {echo 'ничего не работает';}
                }

            }
        }



        ?>
    <?else:?>
        <form action="../postnikov/intake.php" enctype="multipart/form-data" method="post">
            <h3>регистрация нового пользователя</h3>
            <h4>Внимание, поля отмеченные * обязательны для заполнения</h4>
            <div class="container_form">
                <label for="login">логин *</label>
                <input type="text" name="login" id="login" class="mini_textarea" placeholder="login">
                <input type="hidden" value="1" name="rightsite" id="rightsite">
            </div>
            <div class="container_form">
                <label for="password">пароль *</label>
                <input type="password" name="password" id="password" class="mini_textarea" placeholder="*******">
            </div>
            <div class="container_form">
                <label for="e_mail">e-mail *</label>
                <input type="text" name="e_mail" id="e_mail" class="mini_textarea" placeholder="name@mail.ru">
            </div>
            <div class="container_form">
                <label for="surname">фамилия *</label>
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
                <label for="tel">телефон</label>
                <input type="text" name="tel" id="tel" class="mini_textarea" placeholder="89101234567">
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
                <input type="date" name="date" id="date" class="mini_textarea" placeholder="20.06.2010">
            </div>
            <div class="container_form">
                <label for="visa">заграничный паспорт</label>
                <input type="checkbox" name="visa" id="visa" value="yes" class="checkbox">
            </div>
            <div class="container_form">
                <label for="personal_data">разрешение на обработку персональных данных *</label>
                <input type="checkbox" name="personal_data" id="personal_data" value="1" class="checkbox">
            </div>

            <div class="container_form">
                <label for="pic">ваше фото</label>
                <input type="file" name="pic" id="pic">
            </div>
            <button type="submit" class="btn">отправить</button>
        </form>
    <?endif?>
</main>
<footer>
</footer>

</body>
</html>