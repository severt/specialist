<?php

class Singleton
{
    // Приватное статическое свойство для хранения единственного экземпляра
    private static ?Singleton $instance = null;

    // Приватный конструктор предотвращает создание экземпляров класса извне
    private function __construct()
    {
        // Инициализация
    }

    // Приватный метод __clone запрещает клонирование экземпляра
    private function __clone()
    {
        // Не позволяет клонировать
    }

    // Публичный метод __wakeup запрещает десериализацию экземпляра
    public function __wakeup()
    {
        // Не позволяет десериализовать
        throw new \Exception("Cannot unserialize a singleton.");
    }

    // Публичный статический метод для получения экземпляра класса
    public static function getInstance(): Singleton
    {
        // Проверяем, существует ли уже экземпляр
        if (self::$instance === null) {
            // Если не существует, создаем новый экземпляр
            self::$instance = new self();
        }

        // Возвращаем единственный экземпляр
        return self::$instance;
    }

    // Пример метода класса
    public function doSomething(): void
    {
        echo "Действие!";
    }
}

// Пример использования
$instance = Singleton::getInstance();
$instance->doSomething(); // Выведет "Действие!"
