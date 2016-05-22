<?php

class Class1 {
    public $var1;
    public $var2;

    private $variable;

    public function __construct($var) {
        $this->var1 = $var;
        $this->var2 = time();
    }

    public function __get($name) {
        if ($name = 'var3') {
            return $this->variable;
        }

        return 'Переменной не существует';
    }

    public function __set($name, $value) {
        if ($name == 'var3') {
            $this->variable = $value;
        }
    }
}

$object1 = new Class1(15);
$object1->var3 = 100;
echo $object1->var3;

//sleep(2);

//$object2 = new Class1(30);

//echo '<pre>';

//var_dump($object1, $object2);

