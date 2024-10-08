<?php

use Illuminate\Database\Capsule\Manager as Capsule;
// use Ramsey\Uuid\Uuid;

Capsule::schema()->create('users', function ($table) {
    $table->uuid('id')->primary(); // Usar UUID
    $table->string('name', 50);
    $table->string('lastname', 50);
    $table->string('email', 100)->unique();
    $table->string('username', 50);
    $table->string('password', 255);
    $table->uuid('role_id'); // Relación con la tabla de roles
    $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
    $table->timestamps();
});
