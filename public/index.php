<?php

require __DIR__ . '/../vendor/autoload.php';

use Application\Controller\Product;

$app = new Silex\Application;

$app['debug'] = true;

$app->get('/', [Product::class, 'add']);
$app->run();

