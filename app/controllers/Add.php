<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Validator;
use App\Models\Product;

class Add extends Controller {
    public function index(): void {
        $message = $this->getErrorMessage();
        $this->view('Add', ['message' => $message, 'page' => 'add']);
    }

    private function getErrorMessage(): ?string {
        $errors = [
            'error' => Validator::VALIDATION_MESSAGE,
            'invalidsku' => Validator::SKU_EXISTS,
            'emptyfields' => Validator::EMPTY_FIELD_MESSAGE,
            'errorselect' => Validator::PRODUCT_SELECT,
            'invalidprice' => Validator::PRICE_VALIDATION_MESSAGE,
        ];

        foreach ($errors as $key => $value) {
            if (isset($_GET[$key])) {
                return $value;
            }
        }

        return null;
    }

    public function save(): void {
        $validator = new Validator();
        $postData = array_map('htmlspecialchars', $_POST ?? []);

        $product = new Product($this->db);
        if (!$product->isSkuUnique($postData['sku'])) {
            $this->redirect("/add-product?invalidsku");
        }

        if (!$this->validateCommonFields($validator, $postData)) {
            $this->redirect("/add-product?emptyfields");
        }
        if (!$validator->validatePrice($postData['price'])) {
            $this->redirect("/add-product?invalidprice");
        }

        $productType = $postData['productType'];
        $productClass = "\\App\\Controllers\\$productType";
        if (!class_exists($productClass)) {
            $this->redirect("/add-product?errorselect");
        }

        $productInstance = new $productClass($product);

        $specificAttributes = array_intersect_key($postData, array_flip($productClass::getSpecificAttributes()));

        if (!$productClass::validate($validator, $specificAttributes)) {
            $this->redirect("/add-product?error");
        }

        $productInstance->setAttributes(array_merge($postData, $specificAttributes));

        if ($productInstance->save()) {
            $this->redirect("/home");
        } else {
            $this->redirect("/add-product?error");
        }
    }

    private function validateCommonFields(Validator $validator, array $postData): bool {
        return $validator->validateNotEmpty($postData['sku']) &&
               $validator->validateNotEmpty($postData['name']) &&
               $validator->validateNotEmpty($postData['price']);
    }
}