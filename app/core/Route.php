<?php

namespace App\Core;

class Route {
    protected static $routes = [];

    public static function get($uri, $action) {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action) {
        self::$routes['POST'][$uri] = $action;
    }

    public static function dispatch($uri, $method) {
        if (isset(self::$routes[$method][$uri])) {
            return self::$routes[$method][$uri];
        }

        throw new \Exception("Route not found", 404);
    }

    public static function getRoutes() {
        return self::$routes;
    }
}