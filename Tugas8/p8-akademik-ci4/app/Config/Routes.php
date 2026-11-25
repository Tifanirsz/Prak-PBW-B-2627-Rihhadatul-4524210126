<?php

use App\Controllers\MahasiswaController;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/mahasiswa', 'MahasiswaController::index');
$routes->get('/mahasiswa/tambah', 'MahasiswaController::create');
$routes->post('/mahasiswa/simpan', 'MahasiswaController::store');