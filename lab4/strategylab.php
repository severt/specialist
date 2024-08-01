<?php
// Абстрактный продукт
abstract class Product {
    public $title;
    public $price;

    public function __construct($title, $price) {
        $this->title = $title;
        $this->price = $price;
    }

    abstract public function get(Render $renderer): string;
}

// Абстрактный класс рендеринга
abstract class Render {
    abstract public function get(Product $product): string;
}

// Конкретные реализации рендеринга
class XMLRender extends Render {
    public function get(Product $product): string {
        $xml = "<?xml version='1.0' encoding='UTF-8'?><br/><product>";
        foreach ($product as $key => $value) {
            $xml .= "<$key>$value</$key>";
        }
        $xml .= "</product>";
        return $xml;
    }
}

class JSONRender extends Render {
    public function get(Product $product): string {
        return json_encode($product);
    }
}

class HTMLRender extends Render {
    public function get(Product $product): string {
        $html = "<div class='product'>";
        foreach ($product as $key => $value) {
            $html .= "<div class='$key'>$value</div>";
        }
        $html .= "</div>";
        return $html;
    }
}

// Конкретный продукт
class PhoneProduct extends Product {
    public function __construct($title, $price, $model) {
        parent::__construct($title, $price);
        $this->model = $model;
    }

    public function get(Render $renderer): string {
        return $renderer->get($this);
    }
}

// Использование
$phone = new PhoneProduct('iPhone 14', 999.99, 'Pro Max');

$xmlRenderer = new XMLRender();
$xmlOutput = $phone->get($xmlRenderer);
echo $xmlOutput."<br />";

$jsonRenderer = new JSONRender();
$jsonOutput = $phone->get($jsonRenderer);
echo $jsonOutput."<br />";

$htmlRenderer = new HTMLRender();
$htmlOutput = $phone->get($htmlRenderer);
echo $htmlOutput."<br />";
