<?php

namespace App\Controllers;

use App\Model\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class RoleController
{
    // Obtener todos los roles
    public function getAll()
    {
        $roles = Role::all();
        return ['data' => $roles, 'error' => null, 'status' => 200];
    }

    // Obtener un rol por ID
    public function getById($id)
    {
        try {
            $role = Role::findOrFail($id);
            return ['data' => $role, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Role not found', 'status' => 404];
        }
    }

    // Crear un nuevo rol
    public function create($data)
    {
        $data['id'] = (string) Str::uuid();
        $role = Role::create($data);
        return ['data' => $role, 'error' => null, 'status' => 201];
    }

    // Actualizar un rol existente
    public function update($id, $data)
    {
        try {
            $role = Role::findOrFail($id);
            $role->update($data);
            return ['data' => $role, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Role not found', 'status' => 404];
        }
    }

    // Eliminar un rol
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return ['data' => null, 'error' => null, 'status' => 200, 'message' => 'Role deleted successfully'];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Role not found', 'status' => 404];
        }
    }
}
