<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Ramsey\Uuid\Uuid;

Capsule::schema()->create('categories', function ($table) {
    $table->uuid('id')->primary(); // Usar UUID
    $table->string('name', 50);
    $table->timestamps();
});
