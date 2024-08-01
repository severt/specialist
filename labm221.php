<?php

require 'vendor/autoload.php'; // Подключаем автозагрузку Composer

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/'
]);

try {
    $response = $client->request('GET', 'posts/1');
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
}

if ($response->getStatusCode() === 200) {
    $data = json_decode($response->getBody(), true);
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
} else {
    echo "Ошибка: " . $response->getStatusCode();
}
