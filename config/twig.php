<?php

use Silex\Provider\TwigServiceProvider;

/** @var Silex\Application $app */
$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views',
]);
