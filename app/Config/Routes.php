<?php

namespace Config;

use Config\Services;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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

$routes->get('/giris', 'AuthController::login');
$routes->post('/giris/kontrol', 'AuthController::doLogin');
$routes->get('/cikis', 'AuthController::logout');

$routes->get('/ajax_demirbas', 'AuthController::DemirbasUserAjax');

$session = \Config\Services::session();

$role = $session->get('role');

if (isset($role) && $role != 'admin') {
    $routes->get('/', 'AuthController::UserDuyuru');

    $routes->get('/anasayfa', 'AuthController::UserDuyuru');
    $routes->post('/anasayfa', 'AuthController::UserDuyuru');

    $routes->get('/mesajlar', 'AuthController::MesajlarUserPage');
    $routes->post('/mesajlar', 'AuthController::MesajlarUserPage');

    $routes->get('/demirbas', 'AuthController::DemirbasUserPage');

    $routes->get('/sifre', 'AuthController::SifreDegistirPage');
    $routes->post('/sifre', 'AuthController::SifreDegistirPage');
} else {
    $routes->get('/', 'AuthController::index');

    $routes->get('/anasayfa', 'AuthController::DemirbasPage');
    $routes->post('/anasayfa', 'AuthController::DemirbasPage');

    $routes->get('/kullanicilar', 'AuthController::addUserpage');
    $routes->post('/kullanicilar', 'AuthController::addUserpage');

    $routes->get('/duyurular', 'AuthController::DuyuruPage');
    $routes->post('/duyurular', 'AuthController::DuyuruPage');

    $routes->get('/mesajlar', 'AuthController::MesajPage');
    $routes->post('/mesajlar', 'AuthController::MesajPage');
}




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