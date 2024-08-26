<?php

namespace App\Helpers;

use App\Models\Product;

class ProductFormatter {

    protected static array $attributeRenderers = [
        'DVD' => 'renderDVDAttributes',
        'Book' => 'renderBookAttributes',
        'Furniture' => 'renderFurnitureAttributes',
    ];

    public static function renderAttributes(Product $product): string {
        $productType = $product->getProductType();
        $renderMethod = self::$attributeRenderers[$productType];

        return self::$renderMethod($product);
    }

    protected static function renderDVDAttributes(Product $product): string {
        return 'Size: ' . htmlspecialchars($product->getSize()) . ' MB';
    }

    protected static function renderBookAttributes(Product $product): string {
        return 'Weight: ' . htmlspecialchars($product->getWeight()) . ' KG';
    }

    protected static function renderFurnitureAttributes(Product $product): string {
        return 'Dimensions: ' . htmlspecialchars($product->getHeight()) . ' x ' 
            . htmlspecialchars($product->getWidth()) . ' x ' 
            . htmlspecialchars($product->getLength());
    }
}