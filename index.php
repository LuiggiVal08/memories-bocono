<?php

namespace App;

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
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
Flight::map('error', function (Exception $ex) {
    global $log;
    $log->error($ex->getMessage());
    // Puedes personalizar el manejo de errores aquí
    if ($ex instanceof QueryException) {
        Flight::json(['error' => 'Error en la base de datos: ' . $ex->getMessage()], 500);
    } else {
        // Manejar cualquier otro tipo de excepción
        Flight::json(['error' => $ex->getMessage()], 500);
    }
});
Flight::start();
