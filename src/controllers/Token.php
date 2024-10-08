<?php

namespace App\Controllers;

use App\Model\Token;
use Illuminate\Support\Str;

class TokenController
{
    // Generar un nuevo token de administrador
    public function generateAdminToken()
    {
        session_start();

        if ($_SESSION['user']['role'] !== 'admin') {
            return ['data' => null, 'error' => 'Unauthorized', 'status' => 403];
        }

        $token = bin2hex(random_bytes(16));
        $data['id'] = (string) Str::uuid();
        Token::create(['token' => $token, 'user_id' => $_SESSION['user']['id']]);

        return ['data' => $token, 'error' => null, 'status' => 201];
    }

    // Validar token de administrador
    public function validateAdminToken($token)
    {
        $tokenRecord = Token::where('token', $token)->first();

        return $tokenRecord ?
            ['data' => true, 'error' => null, 'status' => 200] :
            ['data' => false, 'error' => 'Invalid token', 'status' => 404];
    }
}
