<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Product;

class Home extends Controller {
    private $product;

    public function __construct(Database $db) {
        parent::__construct($db);
        $this->product = new Product($this->db);
    }

    public function index(): void {
        $products = $this->displayProducts();
        $this->view('home', ['products' => $products, 'page' => 'home']);
    }

    public function displayProducts(): array {
        $products = $this->product->getAll();

        return array_map(function ($product) {
            $controllerClass = "App\\Controllers\\" . $product->getProductType();
            if (class_exists($controllerClass) && method_exists($controllerClass, 'display')) {
                return $controllerClass::display($product);
            }
            return [];
        }, $products);
    }
    public function delete(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productIds = $_POST['product_ids'] ?? [];
            if (!empty($productIds)) {
                $this->product->delete($productIds);
            }
        }
    
        $this->redirect("/home");
    }

}