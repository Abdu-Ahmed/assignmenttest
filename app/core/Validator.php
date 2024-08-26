<?php
namespace App\Core;

class Validator {
    public const VALIDATION_MESSAGE = "Please, provide the data of indicated type";
    public const EMPTY_FIELD_MESSAGE = "Please, submit required data.";
    public const SKU_EXISTS = "SKU already exists!";
    public const PRODUCT_SELECT = "Please select a product!";
    public const PRICE_VALIDATION_MESSAGE = "Please, enter a valid price.";
    
    public function validateString(string $value, int $minLength = 1, int $maxLength = PHP_INT_MAX): bool {
        $trimmedValue = trim($value);
        $length = mb_strlen($trimmedValue);
        return $length >= $minLength && $length <= $maxLength;
    }

    public function validatePrice(string $value): bool {
        $value = trim($value);
        $value = str_replace([',', '$', '€', '£'], '', $value);
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false && preg_match('/^\d+(\.\d{1,2})?$/', $value);
    }
    public function validateNotEmpty(string $value): bool {
        return trim($value) !== '';
    }

    public function validateFloat($value): bool {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }
}