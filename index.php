<?php

namespace App;

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Error;
use Exception;

use Flight;
use Illuminate\Database\QueryException;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require './src/config/db.php';

require './src/router/index.php';
require './src/view_router.php';
require_once 'src/helpers/index.php';

// Flight::map('error', function (Exception $ex) {
//     global $log;
//     $log->error($ex->getMessage());
//     renderWithLayout('error', ['message' => $ex->getMessage()]);
// });
Flight::map('error', function ($ex) {
    // Verifica si $ex es una instancia de Exception o Error
    if ($ex instanceof Exception || $ex instanceof Error) {
        // Maneja la excepción o el error aquí
        echo json_encode(['error' => $ex->getMessage()]);
    } else {
        // Manejo para otros tipos de errores
        echo json_encode(['error' => 'An unknown error occurred']);
    }
});

Flight::start();
