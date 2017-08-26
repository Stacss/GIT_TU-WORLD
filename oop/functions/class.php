<?

class Money {
    protected $nds;
    protected $end_price;

    public function getMoney () {
        return $this->nds." - Сумма НДС закупки товара<br>".$this->end_price." - Конечная цена товара<br>";
    }
    public function getMoneyNds ()
    {
        return $this->nds . " - Сумма НДС закупки товара<br>";
    }
    public function setMoney ($id) {
      $nds=$id*0.18;
      $endPrice=$id*1.2;
      $this->nds=$nds;
      $this->end_price=$endPrice;
    }

}
class Summ extends Money {
    private $sale;
    public function setSale ($sale, $money){
        $sale=$sale/100;
        $id=$money;
        $getEndPrice = new Money();
        $getEndPrice->setMoney($id);
        $end_price = $getEndPrice->end_price;
        $price= $end_price - ($end_price*$sale);
        $this->sale=$price;
    }
    public function getSale (){
        return $this->sale.' - цена с конечной скидкой<br>';
    }
}
 ?>