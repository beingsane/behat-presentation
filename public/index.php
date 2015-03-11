<?php

require __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Application\Controller\UserController;

$app = new Application();
$loadConfig = function ($dir) use ($app) {
    $files = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
    foreach ($files as $fileInfo) {
        require realpath($fileInfo->getPathname());
    }
};
$loadConfig(__DIR__ . '/../config');

$app['debug'] = true;

/**
 * @TODO: Create routes and actions following the schema bellow:
 *
 *   METHOD  |    ROUTER    |   DESCRIPTION
 * ----------+--------------+-----------------------------
 *    POST   -> /save       |   Create a new user
 */
$app->get('/',  [UserController::class, 'index']);
$app->post('/', [UserController::class, 'login']);

$app->run();

