<?php
// Define las rutas para la aplicación web
Flight::route('/', function () {
    renderWithLayout('index', ['title' => 'Inicio']);
});

Flight::route('/auth/', function () {
    if (isset($_SESSION['user'])) {
        Flight::redirect('/');
    }
    renderWithLayout('auth', ['title' => 'Ingresar']);
});
Flight::route('/profile/', function () {
    if (!isset($_SESSION['user'])) {
        Flight::redirect('/auth');
    }
    renderWithLayout('profile', ['title' => 'Ingresar']);
});


Flight::route('/help', function () {
    renderWithLayout('help');
});

Flight::route('/about', function () {
    renderWithLayout('about');
});

// 404 Not Found
Flight::route('*', function () {
    renderWithLayout('404');
});
