<?php

include_once __DIR__ . '/base.php';

class Category extends Base {
    protected static $_table = 'categories';
    protected static $_fields = ['name'];
}