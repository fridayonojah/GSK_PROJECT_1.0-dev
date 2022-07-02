<?php
/**
 * Load the app settings
 */

declare( strict_types = 1 );

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;

error_reporting(E_ALL);

// Load enviroment variables
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

/**
 * Display beautiful errors on a test server.
 * 
 * And prevent errors from showing when live.
 */
$whoops = new \Whoops\Run;
if (getenv('ENV') !== 'live') {
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->prependHandler(function($e) {
        echo 'Error occured in the server, Not to worry our Engineers are on it...';
    });
}
$whoops->register();

require 'db.php';
require 'function.php';
require 'controllers/AuthController.php';
require 'controllers/App.php';
require 'controllers/requestController.php';
require 'controllers/userController.php';
require 'controllers/Register.Controller.php';
require 'model/model.php';
require 'template.php';
require 'routes.php';