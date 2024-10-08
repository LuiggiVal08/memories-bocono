<?php

namespace App\Controllers;

use App\Model\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class CategoryController
{
    // Obtener todas las categorías
    public function getAll()
    {
        $categories = Category::all();
        return ['data' => $categories, 'error' => null, 'status' => 200];
    }

    // Obtener una categoría por ID
    public function getById($id)
    {
        try {
            $category = Category::findOrFail($id);
            return ['data' => $category, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Category not found', 'status' => 404];
        }
    }

    // Crear una nueva categoría
    public function create($data)
    {
        $data['id'] = (string) Str::uuid();
        $category = Category::create($data);
        return ['data' => $category, 'error' => null, 'status' => 201];
    }

    // Actualizar una categoría existente
    public function update($id, $data)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($data);
            return ['data' => $category, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Category not found', 'status' => 404];
        }
    }

    // Eliminar una categoría
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return ['data' => null, 'error' => null, 'status' => 200, 'message' => 'Category deleted successfully'];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Category not found', 'status' => 404];
        }
    }
}
