<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['id', 'contenido', 'usuario_id', 'articulo_id', 'categoria_id'];
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            // if (! $model->getKey()) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
            // }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'articulo_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }
}
