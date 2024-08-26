<?php 
namespace App\Core;

use App\Models\Product;

abstract class Products {
    protected $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    // Getter methods
    public function getId() { return $this->product->getId(); }
    public function getSku() { return $this->product->getSku(); }
    public function getName() { return $this->product->getName(); }
    public function getPrice() { return $this->product->getPrice(); }
    public function getSize() { return $this->product->getSize(); }
    public function getWeight() { return $this->product->getWeight(); }
    public function getHeight() { return $this->product->getHeight(); }
    public function getWidth() { return $this->product->getWidth(); }
    public function getLength() { return $this->product->getLength(); }
    public function getProductType() { return $this->product->getProductType(); }

    // Setter methods
    public function setId($id) { $this->product->setId($id); }
    public function setSku($sku) { $this->product->setSku($sku); }
    public function setName($name) { $this->product->setName($name); }
    public function setPrice($price) { $this->product->setPrice($price); }
    public function setSize($size) { $this->product->setSize($size); }
    public function setWeight($weight) { $this->product->setWeight($weight); }
    public function setHeight($height) { $this->product->setHeight($height); }
    public function setWidth($width) { $this->product->setWidth($width); }
    public function setLength($length) { $this->product->setLength($length); }
    public function setProductType($product_type) { $this->product->setProductType($product_type); }

    abstract public function save(): bool;
    abstract public static function validate(Validator $validator, array $attributes): bool;
    abstract public static function display(Product $product): array;
    abstract public function setAttributes(array $attributes): void;
    abstract public static function getSpecificAttributes(): array;

    protected function setCommonAttributes(array $attributes): void {
        $this->setSku($attributes['sku']);
        $this->setName($attributes['name']);
        $this->setPrice($attributes['price']);
        $this->setProductType((new \ReflectionClass($this))->getShortName());
    }
}