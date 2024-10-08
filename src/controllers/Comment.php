<?php

namespace App\Controllers;

use App\Model\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class CommentController
{
    // Obtener todos los comentarios de un artículo
    public function getAllByArticle($articleId)
    {
        $comments = Comment::where('articulo_id', $articleId)->get();
        return ['data' => $comments, 'error' => null, 'status' => 200];
    }

    // Obtener un comentario por ID
    public function getById($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            return ['data' => $comment, 'error' => null, 'status' => 200];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Comment not found', 'status' => 404];
        }
    }

    // Crear un nuevo comentario en un artículo
    public function create($data)
    {
        $data['id'] = (string) Str::uuid();
        $comment = Comment::create($data);
        return ['data' => $comment, 'error' => null, 'status' => 201];
    }

    // Responder a un comentario
    public function reply($data)
    {
        $data['id'] = (string) Str::uuid();
        $comment = Comment::create($data); // Incluye `parent_comment_id`
        return ['data' => $comment, 'error' => null, 'status' => 201];
    }

    // Eliminar un comentario
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return ['data' => null, 'error' => null, 'status' => 200, 'message' => 'Comment deleted successfully'];
        } catch (ModelNotFoundException $e) {
            return ['data' => null, 'error' => 'Comment not found', 'status' => 404];
        }
    }
}
