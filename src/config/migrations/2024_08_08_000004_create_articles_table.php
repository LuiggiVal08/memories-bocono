<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Ramsey\Uuid\Uuid;

Capsule::schema()->create('articles', function ($table) {
    $table->uuid('id')->primary(); // Usar UUID
    $table->string('title', 255);
    $table->text('content');
    $table->uuid('user_id'); // Relación con la tabla de usuarios
    $table->uuid('category_id'); // Relación con la tabla de categorías
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    $table->timestamps();
});
