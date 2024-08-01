<?php
    namespace Animals;

    require_once __DIR__ . '/vendor/autoload.php';
    use Animals\Cats\Cats;
    $cat = new Cats();

    echo $cat->name('Murzik');