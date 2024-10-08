<?php
require 'src/controllers/User.php';

use App\Controllers\UserController;

Flight::group('/users', function () {
    Flight::route('GET /', function () {
        $controller = new UserController();
        $data = $controller->getAll();
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    });

    Flight::route('GET /@id', function ($id) {
        $controller = new UserController();
        $data = $controller->getById($id);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    })->addMiddleware(new AuthMiddleware());
});
