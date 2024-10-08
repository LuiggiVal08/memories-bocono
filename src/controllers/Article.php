<?php

namespace App\Controllers;

use App\Model\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ArticleController
{
    // Obtener todos los artículos
    public function getAll()
    {
        $articles = Article::with(['user', 'categories', 'comments'])->get();
        return ['data' => $articles, 'error' => null, 'status' => 200];
    }

    // Obtener un artículo por ID
    public function getById($id)
    {
        try {
            $article = Article::with(['user', 'categories', 'comments'])->findOrFail($id);
            return ['data' => $article, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Article not found', 'status' => 404];
        }
    }

    // Crear un nuevo artículo
    public function create($data)
    {
        $data['id'] = (string) Str::uuid();
        $article = Article::create($data);
        return ['data' => $article, 'error' => null, 'status' => 201];
    }

    // Actualizar un artículo existente
    public function update($id, $data)
    {
        try {
            $article = Article::findOrFail($id);
            $article->update($data);
            return ['data' => $article, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Article not found', 'status' => 404];
        }
    }

    // Eliminar un artículo
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return ['data' => null, 'error' => null, 'status' => 200, 'message' => 'Article deleted successfully'];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Article not found', 'status' => 404];
        }
    }
}
