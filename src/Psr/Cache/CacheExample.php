<?php

namespace Psr\Cache;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\CacheItemPoolInterface;

class CacheExample
{
    private CacheItemPoolInterface $cache;

    public function __construct()
    {
        // Используем файловое кеширование
        $this->cache = new FilesystemAdapter();
    }

    public function getData(string $key): string
    {
        $cacheItem = $this->cache->getItem($key);

        if (!$cacheItem->isHit()) {
            // Если данных в кеше нет, выполняем операцию
            $data = $this->fetchData();
            // Сохраняем результат в кеше на 1 час
            $cacheItem->set($data);
            $cacheItem->expiresAfter(3600);
            $this->cache->save($cacheItem);
        } else {
            // Извлекаем данные из кеша
            $data = $cacheItem->get();
        }

        return $data;
    }

    private function fetchData(): string
    {
        // Здесь выполняется операция, например, обращение к внешнему API
        return 'Expensive data result';
    }
}
