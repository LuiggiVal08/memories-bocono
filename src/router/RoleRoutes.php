<?php
require 'src/controllers/Role.php';

use App\Controllers\RoleController;

Flight::group('/roles', function () {
    Flight::route('GET /', function () {
        $controller = new RoleController();
        $data = $controller->getAll();
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    });

    Flight::route('GET /@id', function ($id) {
        $controller = new RoleController();
        $data = $controller->getById($id);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('POST /', function () {
        $data = Flight::request()->data->getData();
        $controller = new RoleController();
        $role = $controller->create($data);
        if (isset($role['error']) && $role['error']) {
            Flight::halt($role['status'], json_encode($role));
        }
        Flight::json($role, $role['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('PUT /@id', function ($id) {
        $data = Flight::request()->data->getData();
        $controller = new RoleController();
        $updatedRole = $controller->update($id, $data);
        if (isset($updatedRole['error']) && $updatedRole['error']) {
            Flight::halt($updatedRole['status'], json_encode($updatedRole));
        }
        Flight::json($updatedRole, $updatedRole['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('DELETE /@id', function ($id) {
        $controller = new RoleController();
        $result = $controller->destroy($id);
        if (isset($result['error']) && $result['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());
});
