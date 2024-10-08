<?php
require 'src/controllers/Category.php';

use App\Controllers\CategoryController;

Flight::group('/categories', function () {
    Flight::route('GET /', function () {
        $controller = new CategoryController();
        $data = $controller->getAll();
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    });

    Flight::route('GET /@id', function ($id) {
        $controller = new CategoryController();
        $data = $controller->getById($id);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    });

    Flight::route('POST /', function () {
        $data = Flight::request()->data->getData();
        $controller = new CategoryController();
        $result = $controller->create($data);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('PUT /@id', function ($id) {
        $data = Flight::request()->data->getData();
        $controller = new CategoryController();
        $result = $controller->update($id, $data);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('DELETE /@id', function ($id) {
        $controller = new CategoryController();
        $result = $controller->destroy($id);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());
});
