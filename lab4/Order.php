<?php
class Order {}

abstract class ProcessOrder {
    abstract function process(Order $order);
}

class OrderHandler extends ProcessOrder {
    function process(Order $order) {
        echo "OrderHandler: Обработка заказа\n<br>";
    }
}

abstract class OrderDecorator extends ProcessOrder {
    protected $processOrder;

    public function __construct(ProcessOrder $processOrder) {
        $this->processOrder = $processOrder;
    }
}

class ValidateOrder extends OrderDecorator {
    public function process(Order $order) {
        echo "ValidateOrder: Валидация заказа\n<br>";
        $this->processOrder->process($order);
    }
}

class ApplyDiscount extends OrderDecorator {
    public function process(Order $order) {
        echo "ApplyDiscount: Применение скидок\n<br>";
        $this->processOrder->process($order);
    }
}

class LogOrder extends OrderDecorator {
    public function process(Order $order) {
        echo "LogOrder: Логирование заказа\n<br>";
        $this->processOrder->process($order);
    }
}

class SendNotification extends OrderDecorator {
    public function process(Order $order) {
        echo "SendNotification: Отправка уведомления клиенту\n<br>";
        $this->processOrder->process($order);
    }
}

$orderProcessor = new SendNotification(
    new LogOrder(
        new ApplyDiscount(
            new ValidateOrder(
                new OrderHandler()
            )
        )
    )
);

$orderProcessor->process(new Order());


