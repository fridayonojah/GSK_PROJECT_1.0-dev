<?php

/**
 * this mainly for rendering templates
 */

class App{

    public static function _404(){
        echo $GLOBALS['twig']->render('gsk_404.html');
    }

    public static function success(){
        echo $GLOBALS['twig']->render('gsk_success.html');
    }

    public static function _500(){
        echo $GLOBALS['twig']->render('gsk_500.html');
    }

    public static function login(){
        echo $GLOBALS['twig']->render('gsk_login.php');
    }

    public function homePage(){
        echo $GLOBALS['twig']->render('home.html');
    }
}