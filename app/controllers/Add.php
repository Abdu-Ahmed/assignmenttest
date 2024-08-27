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
            'invalidinput' => Validator::VALIDATION_MESSAGE,
            'invalidsku' => Validator::SKU_EXISTS,
            'emptyfields' => Validator::EMPTY_FIELD_MESSAGE,
            'errorselect' => Validator::PRODUCT_SELECT,
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

        if (!$this->validateEmptyCommonFields($validator, $postData)) {
            $this->redirect("/add-product?emptyfields");
        }
        if (!$this->validateValidCommonFields($validator, $postData)) {
            $this->redirect("/add-product?invalidinput");
        }

        $productType = $postData['productType'];
        $productClass = "\\App\\Controllers\\$productType";
        if (!class_exists($productClass)) {
            $this->redirect("/add-product?errorselect");
        }

        $productInstance = new $productClass($product);

        $specificAttributes = array_intersect_key($postData, array_flip($productClass::getSpecificAttributes()));

        if (!$productClass::validate($validator, $specificAttributes)) {
            $this->redirect("/add-product?invalidinput");
        }

        $productInstance->setAttributes(array_merge($postData, $specificAttributes));

        if ($productInstance->save()) {
            $this->redirect("/");
        } else {
            $this->redirect("/add-product?invalidinput");
        }
    }

    private function validateEmptyCommonFields(Validator $validator, array $postData): bool {
        return $validator->validateNotEmpty($postData['sku']) &&
               $validator->validateNotEmpty($postData['name']) &&
               $validator->validateNotEmpty($postData['price']);
    }
    private function validateValidCommonFields(Validator $validator, array $postData): bool {
        return $validator->validateString($postData['sku']) &&
               $validator->validateString($postData['name']) &&
               $validator->validatePrice($postData['price']);
    }
}
