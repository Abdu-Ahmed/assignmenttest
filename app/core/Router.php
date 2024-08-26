<?php


namespace App\Core;

class Router {
    protected $errorHandlers = [];

    public function addErrorHandler($code, $handler) {
        $this->errorHandlers[$code] = $handler;
    }

    public function dispatch($uri, $method) {
        try {
            $handler = Route::dispatch($uri, $method);
            return $this->prepareHandler($handler);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function prepareHandler($handler) {
        list($controller, $method) = explode('@', $handler);
        return compact('controller', 'method');
    }

    public function handleError($exception) {
        $code = $exception->getCode();
        if (isset($this->errorHandlers[$code])) {
            call_user_func($this->errorHandlers[$code], $exception);
        } else {
            http_response_code($code);
            echo "Error {$code}: " . $exception->getMessage();
        }
    }
}