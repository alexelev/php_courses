<?php
 include_once __DIR__ . '/base.php';

class Product extends Base {
    protected static $_table = 'products';
    protected static $_fields = ['name', 'price', 'description', 'manufacturer', 'category', 'quantity', 'created'];

    private $_category_name;

    public static function getAll($limit = 0, $from = 0, $full = true) {
        $products = [];

        if ($full) {
            if ($limit) {
                $rows = Database::select("
                    SELECT `p`.*, `c`.`name` AS `category_name` 
                    FROM `products` AS `p`
                    LEFT JOIN `categories` AS `c` ON `p`.`category` = `c`.`id`
                    ORDER BY `created` DESC 
                    LIMIT {$from}, {$limit}
                ");
            } else {
                $rows = Database::select("
                    SELECT `p`.*, `c`.`name` AS `category_name` 
                    FROM `products` AS `p`
                    LEFT JOIN `categories` AS `c` ON `p`.`category` = `c`.`id`
                    ORDER BY `created` DESC 
                ");
            }
        } else {
            if ($limit) {
                $rows = Database::select("SELECT * FROM `products` ORDER BY `created` DESC LIMIT {$from}, {$limit}");
            } else {
                $rows = Database::select("SELECT * FROM `products` ORDER BY `created` DESC");
            }
        }

        foreach($rows as $row) {
            $product = new Product();
            $product->_id = $row['id'];
            $product->_values['name'] = $row['name'];
            $product->_values['price'] = $row['price'];
            $product->_values['description'] = $row['description'];
            $product->_values['manufacturer'] = $row['manufacturer'];
            $product->_values['category'] = $row['category'];
            $product->_values['quantity'] = $row['quantity'];
            $product->_values['created'] = $row['created'];

            if ($full) {
                $product->_category_name = $row['category_name'];
            }

            $products[$row['id']] = $product;
        }

        return $products;
    }

    public static function getByIds($ids, $full = true) {
        if ($full) {
                $rows = Database::select("
                    SELECT `p`.*, `c`.`name` AS `category_name` 
                    FROM `products` AS `p`
                    LEFT JOIN `categories` AS `c` ON `p`.`category` = `c`.`id`
                    WHERE `p`.`id` IN (" . implode(', ', $ids) . ")
                    ORDER BY `created` DESC 
                ");
        } else {
            $rows = Database::select("SELECT * FROM `products` WHERE `id` IN (" . implode(', ', $ids) . ") ORDER BY `created` DESC");
        }

        $products = [];
        foreach($rows as $row) {
            $product = new Product();
            $product->_id = $row['id'];
            $product->_values['name'] = $row['name'];
            $product->_values['price'] = $row['price'];
            $product->_values['description'] = $row['description'];
            $product->_values['manufacturer'] = $row['manufacturer'];
            $product->_values['category'] = $row['category'];
            $product->_values['quantity'] = $row['quantity'];
            $product->_values['created'] = $row['created'];

            if ($full) {
                $product->_category_name = $row['category_name'];
            }

            $products[$row['id']] = $product;
        }

        return $products;
    }

    public function get_excerpt() {
        $limit = 100;
        $description = strip_tags($this->description);
        if (mb_strlen($description) >= $limit) {
            return rtrim(mb_substr($description, 0, 100)) . '...';
        }

        return $description;
    }

    public function __get($name) {
        if ($name == 'category_name') {
            return $this->_category_name;
        }

        return parent::__get($name);
    }
}