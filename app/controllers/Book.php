<?php
namespace App\Controllers;

use App\Core\Products;
use App\Core\Validator;
use App\Models\Product;
use App\Helpers\ProductFormatter;
class Book extends Products {
    public function save(): bool {
        return $this->product->save();
    }

    public static function validate(Validator $validator, array $attributes): bool {
        return $validator->validateFloat($attributes['weight']);
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
        $this->setCommonAttributes($attributes);
        $this->setWeight($attributes['weight']);
    }
    
    public static function getSpecificAttributes(): array {
        return ['weight'];
    }
}