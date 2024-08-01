<?php
/**
 * Просто класс
 */
class Some {
    public static $counter = 1;
    public $test = "test";
    public function __construct(){
        echo "я конструктор<br>";
    }
    public function someFunc(Array $arr = [], $d = 45){
        return "test$d";
    }
}
