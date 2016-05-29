<?php
include 'includes/init.php';

$action = $_GET['action'];

if ($action == 'add' or $action == 'del') {
    $quantity = $_GET['quantity'];
    $product_id = $_GET['product'];
}