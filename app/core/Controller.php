<?php
namespace App\Core;

use App\Core\Database;

class Controller {
    protected $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    protected function model(string $model) {
        $modelClass = 'App\\Models\\' . $model;
        if (class_exists($modelClass)) {
            return new $modelClass($this->db);
        }
        throw new \RuntimeException("Model '$modelClass' not found.", 500);
    }

    protected function view(string $view, array $data = []): void {
        $viewFile = __DIR__ . "/../views/{$view}.php";
        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;
        } else {
            throw new \RuntimeException("View file '$viewFile' not found.", 500);
        }
    }

    protected function handlePostRequest(string $modelMethod, array $requestData): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $product = $this->model('Product');
            if (method_exists($product, $modelMethod)) {
                call_user_func_array([$product, $modelMethod], $requestData);
            } else {
                throw new \RuntimeException("Method '$modelMethod' not found in product model.", 500);
            }
        }
    }

    protected function redirect(string $path): void {
        header("Location: " . BASE_URL . $path);
        exit;
    }
}