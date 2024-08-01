<?php
require 'vendor/autoload.php'; // Подключаем автозагрузку Composer

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/'
]);

try {
    $response = $client->request('POST', 'posts', [
        'json' => [
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1
        ]
    ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
}

if ($response->getStatusCode() === 201) {
    $data = json_decode($response->getBody(), true);
    print_r($data);
} else {
    echo "Ошибка: " . $response->getStatusCode();
}