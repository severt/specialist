<?php

require_once __DIR__ . '/vendor/autoload.php'; // Подключаем файл с классом MyCacheItem

use Psr\Cache\MyCacheItem;

// Создаем экземпляр кеш-элемента с ключом "my_cache_key"
$cacheItem = new MyCacheItem('my_cache_key');

// Проверяем, есть ли данные в кеше
if (!$cacheItem->isHit()) {
    // Если данных в кеше нет, выполняем например, получаем данные
    $data = 'Результат операции';

    // Сохраняем данные в кеш-элемент
    $cacheItem->set($data);

    // Устанавливаем срок годности данных
    $cacheItem->expiresAfter(3600); // 1 час

    echo "Данные были сохранены в кеш: " . $cacheItem->get() . PHP_EOL;
} else {
    // Если данные уже есть в кеше, просто извлекаем их
    $data = $cacheItem->get();
    echo "Данные были извлечены из кеша: " . $data . PHP_EOL;
}
