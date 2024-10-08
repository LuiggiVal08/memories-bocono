<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Token extends Model
{
    protected $table = 'tokens';
    protected $fillable = ['id', 'valor', 'fecha_creacion', 'fecha_expiracion', 'admin_creador_id', 'admin_asignado_id'];
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

    public function adminCreador()
    {
        return $this->belongsTo(User::class, 'admin_creador_id');
    }

    public function adminAsignado()
    {
        return $this->belongsTo(User::class, 'admin_asignado_id');
    }
}
