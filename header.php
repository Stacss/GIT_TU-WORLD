<?
session_start();
include ("../postnikov/admin/db.php");
?>
<header>
        <div class="logo"><a href="http://cp81961.tmweb.ru/postnikov/index.php"><img src="/postnikov/pic/9115898_orig.gif" width="100" alt="logo"></a></div>
		<h1>tu-world</h1>
		<h2>туристическое агенство</h2>
        <div class="cabinet">
            <?
            $sessName=$_SESSION['pssess'];
            $checkLogin=mysqli_query ($db, "SELECT id FROM ps_intake WHERE login = '$sessName'") or die(mysql_error());
            $arrayCheckLogin=mysqli_fetch_array($checkLogin);
            $idLogin=$arrayCheckLogin['id'];
            $checkName=mysqli_query ($db, "SELECT * FROM ps_client WHERE idlogin = '$idLogin'") or die(mysql_error());
            $arrayCheckName=mysqli_fetch_array($checkName);
            $userName=$arrayCheckName['name'];
            $right=$arrayCheckName['rightsite'];
            $idClient=$arrayCheckName['id'];
            $_SESSION['psIdClient']=$idClient;
            $sessId=$_SESSION['psIdClient'];?>
            <?if ($exit):?>
                <?
                session_unset();
                session_destroy();
                ?>
                <h5>вы вышли из аккаунта</h5>
                <a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизуйтесь</a>
                <a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрируйтесь</a>

            <?elseif ($sessName):?>
                <h5><?=$userName?>, ваш логин <?=$sessName?></h5>
                <a href="http://cp81961.tmweb.ru/postnikov/my_orders.php">мои заказы</a>
                <a href="#">мои данные</a>
                <form action="../postnikov/index.php" method="post">
                    <button type="submit" value="exit" name="exit">выйти</button>
                </form>

            <?else:?>
                <h5>Здравствуйте, Гость!</h5>
                <a href="http://cp81961.tmweb.ru/postnikov/authorization.php">Авторизоваться</a>
                <a href="http://cp81961.tmweb.ru/postnikov/intake.php">Зарегистрироваться</a>
            <?endif?>

        </div>
        <div class="container_nav">
			<nav>
				<ul class="cf">
                    <?if ($right==1):?>
                        <li><a href="http://cp81961.tmweb.ru/postnikov/index.php">главная</a></li>
                        <li><a href="http://cp81961.tmweb.ru/postnikov/new_order.php">заявка тура</a></li>
                        <li><a href="http://cp81961.tmweb.ru/postnikov/my_orders.php">Просмотр заявок</a></li>
                        <li><a href="#">редактирование личнных данных</a></li>
                    <?elseif ($right==2):?>
                        <li><a href="#">просмотр заявок</a></li>
                        <li><a href="#">согласование заказа</a></li>
                        <li><a href="#">рассылка почты</a></li>
                        <li><a href="#">редактирование клиента</a>
                            <ul>
                                <li><a href="#">редактирование</a></li>
                                <li><a href="#">удаленик</a></li>
                            </ul>
                        </li>
                        <li><a href="#">отправка заказа</a></li>
                        <li><a href="#">операции стран</a>
                            <ul>
                                <li><a href="#">ввод страны</a></li>
                                <li><a href="#">редактирование</a></li>

                            </ul>
                        </li>
                    <?else:?>
                        <li><a href="http://cp81961.tmweb.ru/postnikov/index.php">главная</a></li>
                        <li><a href="http://cp81961.tmweb.ru/postnikov/intake.php">регистрация</a></li>
                        <li><a href="http://cp81961.tmweb.ru/postnikov/authorization.php">вход для клиентов</a></li>

                        <!-- <li><a href="http://cp81961.tmweb.ru/postnikov/index.php">главная</a></li>
                        <li><a class="dropdown" href="#">администрирование</a>
                            <ul>
                                <li><a href="http://cp81961.tmweb.ru/postnikov/country.php">ввод стран</a></li>
                                <li><a href="http://cp81961.tmweb.ru/postnikov/edit.php">редактирование клиента</a></li>
                                <li><a href="http://cp81961.tmweb.ru/postnikov/delete_client.php">удаление клиента</a></li>
                                <li><a href="http://cp81961.tmweb.ru/postnikov/mail.php">рассылка почты</a></li>
                                <li><a href="http://cp81961.tmweb.ru/postnikov/view_orders_customer.php">просмотр заказов клиентов</a></li>

                            </ul>
                        </li>
                        <li><a class="dropdown" href="#">клиентам</a>
                            <ul>
                                <li><a href="http://cp81961.tmweb.ru/postnikov/intake.php">регистрация</a></li>
                                <li><a href="http://cp81961.tmweb.ru/postnikov/new_order.php">заказ тура</a></li>
                            </ul>
                        <li><a href="#">контакты</a></li>
                        <li><a href="http://cp81961.tmweb.ru/postnikov/authorization.php">вход для клиентов</a></li>
                         -->

                    <?endif?>
				</ul>
				
			</nav>
		</div>
	</header>
