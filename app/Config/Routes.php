<?php namespace Config;

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

$routes->get('/', 'Home::index');
$routes->get('workout', 'Workout::index');
$routes->get('login', 'Login::index');
$routes->get('register', 'Register::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'About::index');
$routes->get('myWorkout', 'MyWorkout::index');
$routes->get('exercises/details/(:num)', 'Exercise::details/$1');
$routes->get('workout/details/(:num)', 'Workout::details/$1');
$routes->get('myWorkout/addWorkout', 'MyWorkout::addWorkout');
