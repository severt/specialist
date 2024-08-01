<?php

//Интерфейс Наблюдателя
interface Observer {
    public function update(string $event, $data): void;
}

//Интерфейс Субъекта
interface Subject {
    public function attach(Observer $observer): void;
    public function detach(Observer $observer): void;
    public function notify(string $event, $data): void;
}

//Реализация Субъекта
class ConcreteSubject implements Subject {
    private $observers = [];

    public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    public function notify(string $event, $data): void {
        foreach ($this->observers as $observer) {
            $observer->update($event, $data);
        }
    }

    public function someBusinessLogic(): void {
        // бизнес-логика, которая изменяет состояние
        $data = "данные";

        // Уведомление наблюдателей об изменении
        $this->notify("stateChanged", $data);
    }
}

//Реализация Наблюдателей
class ConcreteObserverA implements Observer {
    public function update(string $event, $data): void {
        echo "ConcreteObserverA: Получено событие '$event' с данными: $data<br />";
    }
}

class ConcreteObserverB implements Observer {
    public function update(string $event, $data): void {
        echo "ConcreteObserverB: Получено событие '$event' с данными: $data<br />";
    }
}

//Использование
$subject = new ConcreteSubject();

$observerA = new ConcreteObserverA();
$observerB = new ConcreteObserverB();

$subject->attach($observerA);
$subject->attach($observerB);

$subject->someBusinessLogic();

$subject->detach($observerA);

$subject->someBusinessLogic();
