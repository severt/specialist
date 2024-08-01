<?php
/**
Патерн Flyweight: Рендеринг символов для текстового редактора
**/

class Character {
    private static $characters = [];

    private string $char;

    private function __construct(string $char) {
    $this->char = $char;
    }

    public static function getCharacter(string $char) {
    if (!isset(self::$characters[$char])) {
    self::$characters[$char] = new self($char);
    }
    return self::$characters[$char];
    }

    public function render(int $fontSize, string $font) {
    // рендеринг символа с учетом внешних состояний
    echo "<span style='font-size: $fontSize; font-family: $font;'>$this->char</span>";
    }
}

// Использование
$a1 = Character::getCharacter('A');
$a2 = Character::getCharacter('A');

// Оба $a1 и $a2 будут ссылаться на один и тот же объект
var_dump($a1 === $a2); // выведет true
echo "<br />";
$a1->render(16, 'Arial');
$a2->render(24, 'Times New Roman');