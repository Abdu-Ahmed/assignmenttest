<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Product {
    private $db;
    private $id;
    private $sku;
    private $name;
    private $price;
    private $size;
    private $weight;
    private $height;
    private $width;
    private $length;
    private $product_type;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Getter methods
    public function getId() { return $this->id; }
    public function getSku() { return $this->sku; }
    public function getName() { return $this->name; }
    public function getPrice() { return $this->price; }
    public function getSize() { return $this->size; }
    public function getWeight() { return $this->weight; }
    public function getHeight() { return $this->height; }
    public function getWidth() { return $this->width; }
    public function getLength() { return $this->length; }
    public function getProductType() { return $this->product_type; }

    // Setter methods
    public function setId($id) { $this->id = $id; }
    public function setSku($sku) { $this->sku = $sku; }
    public function setName($name) { $this->name = $name; }
    public function setPrice($price) { $this->price = $price; }
    public function setSize($size) { $this->size = $size; }
    public function setWeight($weight) { $this->weight = $weight; }
    public function setHeight($height) { $this->height = $height; }
    public function setWidth($width) { $this->width = $width; }
    public function setLength($length) { $this->length = $length; }
    public function setProductType($product_type) { $this->product_type = $product_type; }

    public function save(): bool {
        $sql = 'INSERT INTO products (sku, name, price, size, weight, height, width, length, product_type) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        
        return $this->executeStatement($sql, [
            $this->getSku(),
            $this->getName(),
            $this->getPrice(),
            $this->getSize(),
            $this->getWeight(),
            $this->getHeight(),
            $this->getWidth(),
            $this->getLength(),
            $this->getProductType()
        ]);
    }

    public function getAll(): array {
        $sql = 'SELECT * FROM products ORDER BY id ASC';
        $stmt = $this->db->getConnection()->query($sql);
        
        $products = [];
        while ($productData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new self($this->db);
            $product->setId($productData['id']);
            $product->setSku($productData['sku']);
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            $product->setSize($productData['size']);
            $product->setWeight($productData['weight']);
            $product->setHeight($productData['height']);
            $product->setWidth($productData['width']);
            $product->setLength($productData['length']);
            $product->setProductType($productData['product_type']);
            $products[] = $product;
        }
        
        return $products;
    }

    public function isSkuUnique(string $sku): bool {
        $sql = 'SELECT COUNT(*) FROM products WHERE sku = ?';
        
        return $this->fetchColumn($sql, [$sku]) === 0;
    }

    public function delete(array $ids): bool {
        $placeholders = implode(', ', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM products WHERE id IN ($placeholders)";
        
        return $this->executeStatement($sql, $ids);
    }

    private function executeStatement(string $sql, array $params): bool {
        $stmt = $this->db->getConnection()->prepare($sql);
        return $stmt->execute($params);
    }

    private function fetchColumn(string $sql, array $params) {
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
}