<?php
abstract class Estate {
    protected $address = "";
    protected $price = "";
    protected $strategy;
    function __construct ( $address, $price, Payment $strategy){
        $this->address = $address;
        $this->price = $price;
        $this->strategy = $strategy;
    }
    function valuation(){
        return $this->strategy->valuation($this->price);
    }
}
class Flat extends Estate{
}
class Home extends Estate{
}
abstract class Payment {
    abstract function valuation($price);
}
class CashPayment extends Payment{
    function valuation($price){
        return $price;
    }
}
class MortgagePayment extends Payment {
    private $firstPayment;
    private $p;
    private $n;
    function __construct($firstPayment, $p, $n){
        $this->firstPayment = $firstPayment;
        $this->p = $p / 1200;
        $this->n = $n * 12;
    }
    function valuation($price){
        return ceil($this->n * ($price - $this->firstPayment)* $this->p/ (1
                - pow(1 + $this->p, -$this->n)));
    }
}
class InstallmentPayment extends Payment {
    function __construct($p){
        $this->p = $p;
    }
    function valuation($price){
        return ceil($price * (1 + $this->p/100));
    }
}
$strategies = array(
    new CashPayment(),
    new MortgagePayment(100000, 12, 10),
    new InstallmentPayment(1)
);
foreach($strategies as $strategy){
    $flat2room = new Flat("Люберцы", 5e6, $strategy);
    echo $flat2room->valuation(),"<br>";
}