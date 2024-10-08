<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Ramsey\Uuid\Uuid;

Capsule::schema()->create('tokens', function ($table) {
    $table->uuid('id')->primary(); // Usar UUID
    $table->string('valor', 255);
    // $table->timestamp('fecha_creacion')->default(Capsule::raw('CURRENT_TIMESTAMP'));
    $table->timestamp('date_expiracion');
    $table->uuid('admin_creador_id'); // Relación con la tabla de usuarios
    $table->uuid('admin_asignado_id'); // Relación con la tabla de usuarios
    $table->foreign('admin_creador_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('admin_asignado_id')->references('id')->on('users')->onDelete('cascade');
    $table->timestamps();
});
