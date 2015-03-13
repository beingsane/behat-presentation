<?php

namespace Application\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

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
    
    /**
     * Try to log a user and redirect them.
     *
     * @param Application $app 
     *
     * @return string
     */
    public static function login(Application $app, Request $request)
    {
        $userInfo = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];
        
        if ($user = LoginController::loadUser($userInfo)) {
            return self::success($app, $user);
        }

        return self::fail($app, $userInfo);
    }
    
    public static function success(Application $app, $userInfo)
    {
        return 'success';
    }
    
    public static function fail(Application $app, $userInfo)
    {
        return $app['twig']->render('fail.twig', [
           'userInfo' => $userInfo, 
        ]);
    }
}
