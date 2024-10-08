<?php
require 'src/controllers/Token.php';

use App\Controllers\TokenController;

Flight::group('/tokens', function () {
    Flight::route('POST /admin', function () {
        $controller = new TokenController();
        $result = $controller->generateAdminToken();
        if (isset($result['error']) && $result['error']) {
            Flight::halt($result['status'], json_encode($result));
        }
        Flight::json($result, $result['status']);
    })->addMiddleware(new AuthMiddleware());
});
