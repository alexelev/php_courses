<?php

include_once __DIR__ . '/../classes/category.php';
include_once __DIR__ . '/../classes/product.php';

function show($view, $params = [], $use_layout = true) {
    if (!file_exists(__DIR__ . '/views/' . $view . '.php')) {
        throw new Exception("The view file $view not found.");
    }

    extract($params);

    if ($use_layout) {
        $view = __DIR__ . '/views/' . $view . '.php';
        include __DIR__ . '/views/layout.php';
    } else {
        include __DIR__ . '/views/' . $view . '.php';
    }
}