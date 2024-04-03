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
$routes->setDefaultController('Home2');
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


// instance routes
$routes->add('instance', 'Instance::index');
$routes->get('instance/new', 'Instance::new');
$routes->post('instance/new', 'Instance::new');
$routes->get('/instance/edit', 'Instance::edit');
/**Notice how get and post have the same URI, but respond differently */

// $routes->get('/', 'Home::index');
$routes->get('workout', 'Workout::index');
$routes->get('login', 'Login::index');
$routes->get('register', 'Register::index');
$routes->get('reset_password', 'Reset_Password::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'About::index');

// Registration Routes
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::register');

// User Activation Routes
$routes->get('/activate/(:any)', 'AuthController::activate/$1');

// Login Routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->match(['get', 'post'], 'login', 'AuthController::login');

// Logout Route
$routes->get('logout', 'AuthController::logout');

// Reset Password Route
// Gathers email
$routes->get('forgotPassword', 'AuthController::forgotPassword');

// Processes forgot password
$routes->get('reset/resetPassword/(:any)', 'AuthController::resetPassword/$1');
$routes->post('reset/resetPasswordProcess/(:any)', 'AuthController::resetPasswordProcess/$1');

// exercise routes
$routes->get('exercises/details/(:num)', 'Exercise::details/$1');

// instance routes
$routes->get('instance/details/(:num)', 'Instance::details/$1');
// workout routes
$routes->get('workout/details/(:num)', 'Workout::details/$1');
$routes->get('workout/start/(:num)', 'Workout::startWorkout/$1');

// myWorkout routes
$routes->get('myWorkout', 'MyWorkout::index');
$routes->get('myWorkout/addWorkout', 'MyWorkout::addWorkout');

//json API routes
$routes->get('api/get-exercises', 'API::getExercises');