<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Ramsey\Uuid\Uuid;

Capsule::schema()->create('comments', function ($table) {
    $table->uuid('id')->primary(); // Usar UUID
    $table->text('content');
    $table->uuid('user_id'); // Relación con la tabla de usuarios
    $table->uuid('article_id'); // Relación con la tabla de artículos
    $table->uuid('category_id'); // Relación con la tabla de categorías
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    $table->timestamps();
});
