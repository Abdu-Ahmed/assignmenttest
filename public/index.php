<?php
define('BASE_URL', 'http://localhost/assignmenttest/public');

require_once 'autoload.php';

use App\Core\App;
use App\Core\Router;
use App\Core\Database;
use App\Core\Route;

// Load the route definitions
require_once '../app/routes/web.php';

// Create an instance of the Router class (which now uses Route::get and Route::post)
$router = new Router();

// Create an instance of the Database class
$db = new Database();

// Initialize the App with the Router and Database instances
$app = new App($router, $db);

// Run the application
$app->run();
