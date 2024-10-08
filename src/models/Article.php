<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['id', 'titulo', 'contenido', 'usuario_id', 'categoria_id'];
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'articulo_id');
    }
}
