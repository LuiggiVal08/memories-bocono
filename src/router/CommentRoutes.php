<?php
require 'src/controllers/Comment.php';

use App\Controllers\CommentController;

Flight::group('/comments', function () {
    Flight::route('GET /article/@articleId', function ($articleId) {
        $controller = new CommentController();
        $data = $controller->getAllByArticle($articleId);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    });

    Flight::route('GET /@id', function ($id) {
        $controller = new CommentController();
        $data = $controller->getById($id);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json([$data], $data['status']);
    });

    Flight::route('POST /', function () {
        $data = Flight::request()->data->getData();
        $controller = new CommentController();
        $result = $controller->create($data);
        if (isset($result['error']) && $result['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    });

    Flight::route('POST /reply', function () {
        $data = Flight::request()->data->getData();
        $controller = new CommentController();
        $result = $controller->reply($data);
        if (isset($result['error']) && $result['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('DELETE /@id', function ($id) {
        $controller = new CommentController();
        $result = $controller->destroy($id);
        if (isset($result['error']) && $result['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());
});
