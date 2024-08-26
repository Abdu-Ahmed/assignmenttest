<?php

namespace App\Core;

class App {
    protected $router;
    protected $db;

    public function __construct(Router $router, Database $db) {
        $this->router = $router;
        $this->db = $db;
        $this->setupErrorHandlers();
    }

    private function setupErrorHandlers() {
        $this->router->addErrorHandler(404, function($e) {
            require_once "../app/views/errors/404.php";
        });

        $this->router->addErrorHandler(500, function($e) {
            require_once "../app/views/errors/500.php";
        });
    }

    public function run() {
        try {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $method = $_SERVER['REQUEST_METHOD'];

            $route = $this->router->dispatch($uri, $method);

            $controllerName = 'App\\Controllers\\' . $route['controller'];
            $method = $route['method'];

            if (!class_exists($controllerName)) {
                throw new \Exception("Controller not found", 404);
            }

            $controller = new $controllerName($this->db);

            if (!method_exists($controller, $method)) {
                throw new \Exception("Method not found", 404);
            }

            call_user_func([$controller, $method]);

        } catch (\Exception $e) {
            $this->router->handleError($e);
        }
    }
}