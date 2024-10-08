<?php
require 'src/controllers/Article.php';

use App\Controllers\ArticleController;

Flight::group('/articles', function () {
    Flight::route('GET /', function () {
        $controller = new ArticleController();
        $data = $controller->getAll();
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    });

    Flight::route('GET /@id', function ($id) {
        $controller = new ArticleController();
        $data = $controller->getById($id);
        if (isset($data['error']) && $data['error']) {
            Flight::halt($data['status'], json_encode($data));
        }
        Flight::json($data, $data['status']);
    });

    Flight::route('POST /', function () {
        $data = Flight::request()->data->getData();
        $controller = new ArticleController();
        $result = $controller->create($data);
        if (isset($result['error']) && $result['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('PUT /@id', function ($id) {
        $data = Flight::request()->data->getData();
        $controller = new ArticleController();
        $updatedArticle = $controller->update($id, $data);
        if (isset($updatedArticle['error']) && $updatedArticle['error']) {
            Flight::halt($updatedArticle['status'], json_encode($updatedArticle));
        }
        Flight::json($updatedArticle, $updatedArticle['status']);
    })->addMiddleware(new AuthMiddleware());

    Flight::route('DELETE /@id', function ($id) {
        $controller = new ArticleController();
        $result = $controller->destroy($id);
        if (isset($result['error']) && $result['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());
});
