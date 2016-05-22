<?php

class Department extends Base {
    protected static $filename = 'departments';
    protected static $vars = ['name', 'address', 'employees_count'];
    protected static $items;
}