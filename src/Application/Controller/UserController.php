<?php

namespace Application\Controller;

use Silex\Application;

final class UserController
{
    /**
     * Get out of here
     */
    private function __construct()
    {
    }

    /**
     * Form application
     *
     * @param Application $app
     *
     * @return string
     */
    public static function index(Application $app)
    {
        return $app['twig']->render('index.twig');
    }
}
