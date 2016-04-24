<?php
include_once 'base.php';

class Employee extends Base {
    protected static $filename = 'employees';
    protected static $vars = ['fullname', 'birth', 'phone', 'post'];

    public $fullname;
    public $birth;
    public $phone;
    public $post;
}