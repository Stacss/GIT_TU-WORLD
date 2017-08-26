<?
session_start();
include ("../postnikov/admin/db.php");
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
    class Animal
    {
        public $dog;
        public $cat;
        public $ageDog;
        public $ageCat;

        public function allanimals (){
          echo $this->ageDog+$this->ageCat;
        }
    }

    $word = new Animal;
    $word->dog = 'Шарик';
    $word->cat = 'Муся';
    $word->ageCat = 10;
    $word->ageDog = 5;

    //Вызовем наш метод:
    echo $word->dog.'<br>';
    echo $word->cat.'<br>';
    echo $word->allanimals();

    class ClientData
    {
        public $id;
        public $idlogin;
        public $surname;
        public $name;
        public $patronymic;
        public $sex;
        public $date;
        public $visa;
        public $e_mail;
        public $tel;
        public $idwhomade;
        public $rightsite;

        public function getId()
        {
            return $this->id.'<br>'
                .$this->idlogin.'<br>'
                .$this->surname.'<br>'
                .$this->name.'<br>'
                .$this->patronymic.'<br>'
                .$this->sex.'<br>'
                .$this->date.'<br>'
                .$this->visa.'<br>'
                .$this->e_mail.'<br>'
                .$this->tel.'<br>'
                .$this->idwhomade.'<br>'
                .$this->rightsite.'<br>';
        }
        public function setId($id)
        {
            echo 'это переданная ID >>>'.$id;
            $db = mysqli_connect ('localhost','cp81968_grope2','kostroma44','cp81968_grope2');
            if ($db==true) {echo "connect";} else {echo 'noconnect';};
            $readTable = mysqli_query ($db, "SELECT * FROM ps_client WHERE id = '$id'");
            $a = mysqli_query ($db, "SELECT surname FROM ps_client WHERE id = '$id'");
            $ra=mysqli_fetch_array($a);
            echo $ra['$surname'].'<<<<<';
            if ($readTable==true) {echo 'ok';} else {echo 'no!!!';};
            $arrayReadTable=mysqli_fetch_array($readTable);
            $this->id = $arrayReadTable['id'];
            $this->idlogin = $arrayReadTable['idlogin'];
            $this->surname = $arrayReadTable['surname'];
            $this->name = $arrayReadTable['name'];
            $this->patronymic = $arrayReadTable['patronymic'];
            $this->sex = $arrayReadTable['sex'];
            $this->date = $arrayReadTable['date'];
            $this->visa = $arrayReadTable['visa'];
            $this->e_mail = $arrayReadTable['e_mail'];
            $this->tel = $arrayReadTable['tel'];
            $this->idwhomade = $arrayReadTable['idwhomade'];
            $this->rightsite = $arrayReadTable['rightsite'];

        }
    }
    $testId= new ClientData;
    $testId->setId(48);
    echo $testId->getId();
    print_r ($testId->getId());

?>
<? $db = mysqli_connect ('localhost','cp81968_grope2','kostroma44','cp81968_grope2');
    if ($db==true) {echo "connect";} else {echo 'noconnect';};?>
</main>
<footer>
</footer>

</body>
</html>