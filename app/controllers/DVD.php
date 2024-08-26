<?php
namespace App\Controllers;

use App\Core\Products;
use App\Core\Validator;
use App\Models\Product;
use App\Helpers\ProductFormatter;

class DVD extends Products {
    public function save(): bool {
        return $this->product->save();
    }

    public static function validate(Validator $validator, array $attributes): bool {
        return $validator->validateFloat($attributes['size']);
    }

    public static function display(Product $product): array {
        return [
            'id' => $product->getId(),
            'sku' => $product->getSku(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'formatted_attributes' => ProductFormatter::renderAttributes($product),
        ];
    }

    public function setAttributes(array $attributes): void {
        $this->product->setSku($attributes['sku']);
        $this->product->setName($attributes['name']);
        $this->product->setPrice($attributes['price']);
        $this->product->setSize($attributes['size']);
        $this->product->setProductType('DVD');
    }

    public static function getSpecificAttributes(): array {
        return ['size'];
    }
}