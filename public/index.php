<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application;

$app->get('/', [Product::class, 'add']);
$app->run();

