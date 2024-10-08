<?php

namespace App\Controllers;

use App\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class UserController
{
    // Obtener todos los usuarios
    public function getAll()
    {
        $users = User::all();
        return ['data' => $users, 'error' => null, 'status' => 200];
    }

    // Obtener un usuario por ID
    public function getById($id)
    {
        try {
            $user = User::findOrFail($id);
            return ['data' => $user, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'User not found', 'status' => 404];
        }
    }

    // Crear un nuevo usuario
    public function create($data)
    {
        $data['id'] = (string) Str::uuid();
        $user = User::create($data);
        return ['data' => $user, 'error' => null, 'status' => 201];
    }

    // Actualizar un usuario existente
    public function update($id, $data)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            return ['data' => $user, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'User not found', 'status' => 404];
        }
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->role->name === 'admin') {
                return ['data' => null, 'error' => 'Cannot delete administrators', 'status' => 403];
            }
            $user->delete();
            return ['data' => null, 'error' => null, 'status' => 200, 'message' => 'User deleted successfully'];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'User not found', 'status' => 404];
        }
    }
}
