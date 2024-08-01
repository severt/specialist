<?php
abstract class Component{
    abstract function addComponent(Component $component);
    abstract function deleteComponent(Component $component);
    abstract function calculation();
}
class Sand extends Component{
    function calculation()
    {
        return 3;
    }
    function addComponent(Component $component){ }
    function deleteComponent(Component $component){ }
}
class Clay extends Component{
    function calculation()
    {
        return 5;
    }
    function addComponent(Component $component){ }
    function deleteComponent(Component $component){ }
}
class Cement extends Component{
    function calculation()
    {
        return 15;
    }
    function addComponent(Component $component){ }
    function deleteComponent(Component $component){ }
}
class Foundation extends Component{
    private $components = [];
    function addComponent(Component $component){
        if( in_array( $component, $this->components, true)){
            return;
        }
        $this->components[] = $component;
    }
    function deleteComponent(Component $component){
        $this->components = array_udiff($this->components,[$component],
            function($a, $b){return ($a === $b)? 0 : 1;});
    }
    function calculation()
    {
        $tmp = 0;
        foreach($this->components as $component){
            $tmp += $component->calculation();
        }
        return $tmp * 2 + 1000;
    }
    function pr(){
        echo "<pre>";
        print_r($this->components[0]);
        echo "</pre>";
    }
}
class Brick extends Component{
    private $components = [];
    function addComponent(Component $component){
        if( in_array( $component, $this->components, true)){
            return;
        }
        $this->components[] = $component;
    }
    function deleteComponent(Component $component){
        $this->components = array_udiff($this->components,[$component],
            function($a, $b){return ($a === $b)? 0 : 1;});
    }
    function calculation()
    {
        $tmp = 0;
        foreach($this->components as $component){
            $tmp += $component->calculation();
        }
        return $tmp * 1.5;
    }
    function pr(){
        echo "<pre>";
        print_r($this->calculation());
        echo "</pre>";
    }
}
$foundation = new Foundation();
$foundation->addComponent(new Sand());
$foundation->addComponent(new Cement());
echo "Стоимость фундамента: ",$foundation->calculation(),"<br>";
$brick = new Brick();
$brick->addComponent(new Clay());
echo "Стоимость кирпича: ", $brick->calculation(),"<br>";
$foundation->addComponent($brick);
echo "Стоимость фундамента с кирпичом: ",
$foundation->calculation(),"<br>";

