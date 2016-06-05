<?php

include_once __DIR__ . '/product.php';

class Cart {
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function getProductsList() {
        $ids = array_keys($_SESSION['cart']);

        if (!empty($ids)) {
            return Product::getByIds($ids);
        }

        return [];
    }

    public function addProduct($id_product, $quantity = 1) {
        if (isset($_SESSION['cart'][$id_product])) {
            $_SESSION['cart'][$id_product] += $quantity;
        } else {
            $_SESSION['cart'][$id_product] = $quantity;
        }
    }

    public function delProduct($id_product) {
        if (isset($_SESSION['cart'][$id_product])) {
            unset($_SESSION['cart'][$id_product]);
        }
    }

    public function changeProductQuantity($id_product, $quantity) {
        $_SESSION['cart'][$id_product] = $quantity;
    }

    public function getProductQuantity($product_id) {
        if (isset($_SESSION['cart'][$product_id])) {
            return $_SESSION['cart'][$product_id];
        }

        return 0;
    }

    public function getProductsCount() {
        $total_quantity = 0;
        foreach ($_SESSION['cart'] as $quantity) {
            $total_quantity += $quantity;
        }

        return $total_quantity;
    }
}