<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT 
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * -------------------------------------------------------
 * Router Setup
 * -------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * -------------------------------------------------------------------------------------------------
 * Route Definitions
 * -------------------------------------------------------------------------------------------------
 */
// We get a performance increase by specifying the default 
// route since we don't have to scan directories.


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');

//for dynamic routing.... :any means any value, and $1 represents each of the variables from the first parameter of the add function
$routes->add('workouts/(:any)(:any)', 'Workouts::workout/$1/$2');
$routes->add('progress', function () {
    return '<h2> This is your progress.  </h2>';
});

$routes->group('admin', function ($routes) {
    $routes->add('user', 'Admin\Users::index');
    $routes->add('users', 'Admin\Users::getAllUsers');
    $routes->add('workouts/(:any)(:any)', 'Workouts::workout/$1/$2');

    // instance routes
    $routes->add('instance', 'Admin\Instance::index');
    $routes->get('instance/new', 'Admin\Instance::createNew');
    $routes->post('instance/new', 'Admin\Instance::saveInstance');
    /**Notice how get and post have the same URI, but respond differently */

});
$routes->get('/', 'Home::index');
$routes->get('workout', 'Workout::index');
$routes->get('login', 'Login::index');
$routes->get('register', 'Register::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'About::index');
