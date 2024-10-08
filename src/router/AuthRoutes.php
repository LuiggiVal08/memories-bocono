<?php
require 'src/controllers/Auth.php';

use App\Controllers\AuthController;

Flight::route('POST /login', function () {
    $data = Flight::request()->data->getData();
    $controller = new AuthController();
    $result = $controller->login($data);
    if (isset($result['error']) && $result['error']) {
        Flight::halt($result['status'], json_encode($result));
    }
    Flight::json($result, $result['status']);
});

Flight::route('POST /register', function () {
    $data = Flight::request()->data->getData();
    $controller = new AuthController();
    $result = $controller->register($data);
    if (isset($result['error']) && $result['error']) {
        Flight::halt($result['status'], json_encode($result));
    }
    Flight::json($result, $result['status']);
});

Flight::route('POST /logout', function () {
    $controller = new AuthController();
    $result = $controller->logout();
    if (isset($result['error']) && $result['error']) {
        Flight::halt($result['status'], json_encode($result));
    }
    Flight::json($result, $result['status']);
});
