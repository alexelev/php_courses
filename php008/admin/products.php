<?php

include 'init.php';

switch($_GET['action']) {
    case 'new' :
        if (!empty($_POST)) {
            $errors = [];

            /* ... проверка ошибок ввода ... */

            if (!empty($_FILES['image'])) {
                if ($_FILES['image']['error'] && $_FILES['image']['size'] == 0) {
                    $errors['image'] = 'Ошибка загрузки файла';
                }
            }

            if (empty($errors)) {
                $product = new Product();
                /* .. заполнение товара .. */
                $product->name = 'название товара';
                $product->category = '1';
                $product->manufacturer = 'ghjbpdjlbntkm';
                $product->price = '10';
                $product->quantity = '10';
                $product->created = date('Y-m-d H:i:s');
                $product->save();

                $info = getimagesize($_FILES['image']['tmp_name']);
                $real_size = [$info[0], $info[1]];
                $need_size = [100, 100];
                $source_image = imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name']));
                $dest_image = imagecreate($need_size[0], $need_size[1]);

                if (($real_size[0]/$real_size[1]) > ($need_size[0]/$need_size[1])) {
                    imagecopyresampled($dest_image, $source_image, 0, 0, ($real_size[0] - $real_size[1]) / 2, 0, $need_size[0], $need_size[1], $real_size[1], $real_size[1]);
                } else {
                    imagecopyresampled($dest_image, $source_image, 0, 0, 0, ($real_size[1] - $real_size[0]) / 2, $need_size[0], $need_size[1], $real_size[0], $real_size[0]);
                }

                imagejpeg($dest_image, __DIR__ . '/../images/product/' . $product->id . '.jpg');
                header('Location: products.php');
            }
        }
        show('product-create');
        exit;
    case 'edit' :
        exit;
    case 'del' :
        exit;
    default :
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        show('products-list', ['page' => $page, 'per_page' => 2]);
        exit;
}