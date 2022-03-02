<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Admin::index');
// $routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/petugas', 'Admin::petugas', ['filter' => 'role:admin']);
$routes->get('/user/tambahpetugas', 'User::tambahpetugas', ['filter' => 'role:admin']);
$routes->get('/admin/editpetugas/(:num)', 'Admin::editpetugas/$1', ['filter' => 'role:admin']);

$routes->get('/admin/masyarakat', 'Admin::masyarakat', ['filter' => 'role:admin']);
$routes->get('/admin/tambahmasyarakat', 'Admin::tambahmasyarakat', ['filter' => 'role:admin']);

$routes->get('/user/tambahmasyarakat', 'User::tambahmasyarakat', ['filter' => 'role:admin']);
$routes->get('/admin/editmasyarakat/(:num)', 'Admin::editmasyarakat/$1', ['filter' => 'role:admin']);

$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);

$routes->get('/pengaduan', 'Pengaduan::index', ['filter' => 'role:masyarakat']);
$routes->get('/pengaduan/details', 'Pengaduan::details', ['filter' => 'role:masyarakat']);
$routes->get('/pengaduan/detail/(:num)', 'Pengaduan::detail/$1', ['filter' => 'role:masyarakat']);
$routes->get('/pengaduan/delete/(:num)', 'Pengaduan::delete/$1', ['filter' => 'role:masyarakat']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
