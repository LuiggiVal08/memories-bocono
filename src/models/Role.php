<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'id'];

    // Desactiva las claves autoincrementales
    public $incrementing = false;

    // Indica que la clave primaria es de tipo string
    protected $keyType = 'string';

    // Usar UUID en vez de auto-incremental
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            if (empty($model->{$model->getKeyName()})) {
                // $logMessage = $logMessage1 . "Generating UUID...\n";
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
