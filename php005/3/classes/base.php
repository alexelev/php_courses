<?php

abstract class Base {
    protected static $items;
    protected static $filename;
    protected static $vars;

    protected $values;
    public $num;

    protected static function loadItems() {
        $file = fopen(__DIR__ . "/../data/" . static::$filename, 'r');

        static::$items = [];
        $num = 1;
        while (!feof($file)) {
            $data = explode(' | ', str_replace("\r\n", '', fgets($file)));
            if (!feof($file)) {
                $object = new static();
                $object->num = $num++;
                foreach (static::$vars as $index => $var) {
                    $object->values[$var] = $data[$index];
                }

                static::$items[] = $object;
            }
        }

        fclose($file);
    }

    public static function getAll() {
        if (empty(static::$items)) {
            static::loadItems();
        }

        return static::$items;
    }

    public static function getItem($num) {
        if (empty(static::$items)) {
            static::loadItems();
        }

        if (isset(static::$items[$num - 1])) {
            return static::$items[$num - 1];
        }

        return null;
    }

    public static function saveAll() {
        $file = fopen(__DIR__ . "/../data/" . static::$filename, 'w');

        foreach (static::$items as $item) {
            $vars = [];
            foreach (static::$vars as $var) {
                $vars[] = $item->values[$var];
            }

            fwrite($file, implode(' | ', $vars) . "\r\n");
        }

        fclose($file);
    }

    public function add() {
        if (empty(static::$items)) {
            static::loadItems();
        }

        if (empty($this->num)) {
            $this->num = count(static::$items) +1;
            static::$items[] = $this;
            static::saveAll();
        }
    }

    public function delete() {
        unset(static::$items[$this->num - 1]);
        static::saveAll();
    }

    public function __get($name) {
        if (in_array($name, static::$vars)) {
            return $this->values[$name];
        }

        return null;
    }

    public function __set($name, $value) {
        if (in_array($name, static::$vars)) {
            $this->values[$name] = $value;
        }
    }
}

