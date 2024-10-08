<?php

// namespace App\Middlewares;

class AuthMiddleware
{
    public function __invoke($route)
    {
        session_start();

        // Verificar si el usuario está autenticado a través de la sesión
        if (!isset($_SESSION['user'])) {
            Flight::halt(401, json_encode(['error' => 'Unauthorized: No session active']));
        }

        // Verificar si el usuario tiene permisos de administrador
        $user = $_SESSION['user'];
        if ($user['role'] !== 'admin') {
            Flight::halt(403, json_encode(['error' => 'Forbidden: Insufficient permissions']));
        }

        // Continuar con la ejecución de la ruta
        return true;
    }
}
