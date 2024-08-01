<?php
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

//При помощи инструментов Reflection получите информацию о классе Some
$refclass = new ReflectionClass("Some");
echo "<pre>";
//deprecated php8
//Reflection::export($refclass);
echo $refclass->getName() . "<br />";


//Получите информацию о методах класс Some
$methods = $refclass->getMethods(); //get_class_methods("ReflectionClass");
echo "<pre>";
foreach($methods as $method){
    echo "$method: ",$method->getName(),"<br>";
}
echo "</pre>";

//Получите сведения о модификаторах доступа и другой информации
$methods = $refclass->getMethods();
$props = [
    "isUserDefined",
    "isInternal",
    "isPublic",
    "isAbstract",
    "isProtected",
    "isPublic",
    "isPrivate",
    "isStatic",
    "isFinal",
    "isConstructor",
];
echo "<pre>";
//print_r($methods);
foreach($methods as $method){
    echo "<hr>Метод: ",$method->getName(),"<br>";
    foreach($props as $prop){
        echo "$prop: ",$method->$prop(),"<br>";
    }
}
echo "</pre>";

//Получите информацию о параметрах метода someFunc
$method = $refclass->getMethod("someFunc");
$parameters = $method->getParameters();
$props = [
    "allowsNull",
    "getDefaultValue",
    "getName",
    "getPosition",
    "isArray",
    "isCallable",
];
echo "<pre>";
//print_r($methods);
foreach($parameters as $parameter){
    echo "<hr>Аргумент: ",$parameter->getName(),"<br>";
    foreach($props as $prop){
        echo "$prop: ",$parameter->$prop(),"<br>";
    }
}
echo "</pre>";
