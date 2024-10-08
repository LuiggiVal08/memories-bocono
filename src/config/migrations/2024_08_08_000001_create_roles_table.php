<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Ramsey\Uuid\Uuid;

Capsule::schema()->create('roles', function ($table) {
    $table->uuid('id')->primary();
    $table->string('name', 50);
    $table->timestamps();
});
