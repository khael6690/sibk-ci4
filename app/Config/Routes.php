<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/viewdata', 'Home::viewdata');
$routes->get('/count', 'Home::count');


$routes->group('', ['filter' => 'role:admin'], function ($routes) {
    // route Guru
    $routes->get('guru', 'Guru::index');
    $routes->get('guru/viewdata', 'Guru::viewdata');
    $routes->get('guru/detail', 'Guru::detail');
    $routes->get('guru-create', 'Guru::create');
    $routes->post('guru', 'Guru::save');
    $routes->get('guru-update/(:num)', 'Guru::edit/$1');
    $routes->put('guru', 'Guru::update');
    $routes->delete('guru', 'Guru::delete');

    // route Kelas
    $routes->get('kelas', 'Kelas::index');
    $routes->get('kelas/viewdata', 'Kelas::viewdata');
    $routes->get('kelas-create', 'Kelas::create');
    $routes->post('kelas', 'Kelas::save');
    $routes->get('kelas-update/(:num)', 'Kelas::edit/$1');
    $routes->put('kelas', 'Kelas::update');
    $routes->delete('kelas', 'Kelas::delete');

    // route Jurusan
    $routes->get('jurusan/viewdata', 'Jurusan::viewdata');
    $routes->get('jurusan-create', 'Jurusan::create');
    $routes->post('jurusan', 'Jurusan::save');
    $routes->get('jurusan-update/(:num)', 'Jurusan::edit/$1');
    $routes->put('jurusan', 'Jurusan::update');
    $routes->delete('jurusan', 'Jurusan::delete');

    // route Siswa
    $routes->get('siswa', 'Siswa::index');
    $routes->get('siswa/viewdata', 'Siswa::viewdata');
    $routes->get('siswa/detail', 'Siswa::detail');
    $routes->get('siswa-create', 'Siswa::create');
    $routes->post('siswa', 'Siswa::save');
    $routes->get('siswa-update/(:num)', 'Siswa::edit/$1');
    $routes->put('siswa', 'Siswa::update');
    $routes->delete('siswa', 'Siswa::delete');

    //route Ortu
    $routes->get('ortu', 'Ortu::getData');
    $routes->get('ortu/viewdata', 'Ortu::viewdata');
    $routes->post('ortu', 'Ortu::save');
    $routes->delete('ortu', 'Ortu::delete');

    // route Users
    $routes->get('users', 'Users::index');
    $routes->get('users/viewdata', 'Users::viewdata');
    $routes->get('users/create', 'Users::create');
    $routes->post('users', 'Users::save');
    $routes->delete('users/(:num)', 'Users::delete/$1');
    $routes->post('users/reset/(:num)', 'Users::reset/$1');
    $routes->post('users/active/(:num)', 'Users::active/$1');
});



// route Tata tertib
$routes->get('tata-tertib', 'Tata::index');
$routes->get('tata-tertib/viewdata', 'Tata::viewdata');
$routes->get('tata-tertib/detail', 'Tata::detail');
$routes->get('tata-tertib/create', 'Tata::create');
$routes->post('tata-tertib', 'Tata::save');
$routes->get('tata-tertib/update/(:num)', 'Tata::edit/$1');
$routes->put('tata-tertib', 'Tata::update');
$routes->delete('tata-tertib', 'Tata::delete');

// route Tata ketegori
$routes->get('kategori/viewdata', 'Kategori::viewdata');
$routes->get('kategori/create', 'Kategori::create');
$routes->post('kategori', 'Kategori::save');
$routes->get('kategori/update/(:num)', 'Kategori::edit/$1');
$routes->put('kategori', 'Kategori::update');
$routes->delete('kategori', 'Kategori::delete');

$routes->get('pelanggaran', 'Pelanggaran::index');
$routes->get('pelanggaran/viewdata', 'Pelanggaran::viewdata');
$routes->get('pelanggaran/detail', 'Pelanggaran::detail');
$routes->get('pelanggaran/create', 'Pelanggaran::create');
$routes->get('pelanggaran/getPel', 'Pelanggaran::getPel');
$routes->post('pelanggaran', 'Pelanggaran::save');
$routes->post('pelanggaran/status/(:num)', 'Pelanggaran::status/$1');
$routes->post('pelanggaran/panggilan', 'Pelanggaran::panggil');
$routes->get('pelanggaran/update/(:num)', 'Pelanggaran::edit/$1');
$routes->put('pelanggaran', 'Pelanggaran::update');
$routes->delete('pelanggaran', 'Pelanggaran::delete');

$routes->get('panggilan', 'Panggilan::index');
$routes->get('panggilan/viewdata', 'Panggilan::viewdata');
$routes->delete('panggilan', 'Panggilan::delete');
$routes->post('panggilan/status/(:num)', 'Panggilan::status/$1');

$routes->get('setting', 'Users::setuser');
$routes->get('setting/user', 'Users::getUser');
$routes->put('setting/user/(:num)', 'Users::saveset/$1');
$routes->get('setting/pass', 'Users::getPass');
$routes->put('setting/pass/(:num)', 'Users::savepass/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
