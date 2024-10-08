<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['id', 'nombre'];
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

    public function articles()
    {
        return $this->hasMany(Article::class, 'categoria_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'categoria_id');
    }
}
