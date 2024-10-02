<?php

Flight::group('/api', function () {
    // Ruta al directorio donde se encuentran los controladores
    $directory = __DIR__;

    // Escanea el directorio y obtiene todos los archivos PHP
    foreach (scandir($directory) as $file) {
        // Verifica que sea un archivo PHP y no sea un directorio
        if (is_file($directory . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            require_once $directory . '/' . $file;
        }
    }
});
