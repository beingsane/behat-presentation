<?php

require __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Application\Controller\Product;

$app = new Application();
$loadConfig = function ($dir) use ($app) {
    $files = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
    foreach ($files as $fileInfo) {
        require realpath($fileInfo->getPathname());
    }
};
$loadConfig(__DIR__ . '/../config');

$app['debug'] = true;

$app->get('/', [Product::class, 'add']);

$app->run();

