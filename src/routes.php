<?php
$router = new AltoRouter();

$routes = [
    ['GET', '/',  'App#homePage'],
    ['GET', '/home/register',  'User#userRegisterPage'],
    ['POST', '/action/register', 'User#registerUser'],

    ['GET', '/root', 'User#rootDashboard'],
    ['GET', '/login', 'App#login'],
    ['POST', '/auth/login', 'Auth#login_user'],
    ['GET', '/user-edit/[i:user_id]', 'User#editUserPage'],
    ['POST', '/action/edit-user', 'User#editUser'],
    ['POST', '/action/delete-user', 'User#deleteUser'],
    ['GET', '/user/all', 'AuthUser#allUser'],
    ['GET', '/user/create', 'AuthUser#createUser'],
    ['POST', '/action/create-user', 'AuthUser#create_user'],
    ['POST', '/action/search', 'User#searchUser'],

    ['GET', '/logout', 'Auth#logout'],
];

$router->addRoutes($routes);

$match = $router->match();  

if ($match === false) {
    // Render the 404 view when route not found
    App::_404();
} else {
    list($controller, $action) = explode('#', $match['target']);
    if (is_callable([$controller, $action])) {
        $controller = new $controller;
        call_user_func_array([$controller, $action], [$match['params']]);
    } else {
        // here your routes are wrong.
        // Throw an exception in debug, send a  500 error in production
        app_log_error('Fail to call object on page request ' . $controller . '->' . $action);
        exit('No object found');
        
    }
}
