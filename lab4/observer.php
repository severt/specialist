<?php
interface Observable {
    function attach(Observer $observer ) ;
    function detach(Observer $observer );
    function notify();
}
class Author implements Observable{
    private $observers=[];
    public $name = "";
    function __construct($name){
        $this->name = $name;
        $this->observers = [];
    }
    function attach (Observer $observer ) {
        $this->observers[] = $observer;
    }
    function detach (Observer $observer ) {
        $this->observers = array_filter($this->observers,function ( $а )
        use ( $observer ) {
            return ( ! ( $а === $observer ) ) ;
        }) ;
    }
    function write($text){
        echo $this->name," написал: $text<br>";
        $this->notify();
    }
    function notify(){
        foreach($this->observers as $obs)
            $obs->update($this);
    }
}
interface Observer{
    function update( Observable $observable );
}
class Critic implements Observer{
    public $name = "";
    function __construct($name){
        $this->name = $name;
    }
    function update( Observable $observable ){
        echo "Критик ",$this->name," написал: наконец-то
<b>{$observable->name}</b> что-то написал..<br>";
    }
}
class User implements Observer{
    public $name = "";
    function __construct($name){
        $this->name = $name;
    }
    function update( Observable $observable ){
        echo "Читатель ",$this->name," написал: <b>{$observable->name}</b>
- великий поэт!<br>";
    }
}
class Historian implements Observer{
    public $name = "";
    function __construct($name){
        $this->name = $name;
    }
    function update( Observable $observable ){
        echo "Историк ",$this->name," написал: очередное прозведение от
<b>{$observable->name}</b> - ",date("d-m-Y H:i:s"),"<br>";
    }
}
$author = new Author("А.С. Пушкин");
$critic = new Critic("В. Пупкин");
$user = new User("Г. Сумкин");
$user2 = new User("А. Рогова");
$historian = new Historian("Д.И Иванов");
$author->attach($critic);
$author->attach($user);
$author->attach($user2);
$author->attach($historian);
$author->write("Когда для смертного умолкнет шумный день..");
$author->detach($critic);
$author->write("Воспоминание");
