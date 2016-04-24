<?php

class Base {
    protected static $items;
    protected static $filename;
    protected static $vars;

    public $num;

    protected static function loadItems() {
        $file = fopen(__DIR__ . "/../data/" . static::$filename, 'r');

        static::$items = [];
        $num = 0;
        while (!feof($file)) {
            $data = explode(' | ', str_replace("\r\n", '', fgets($file)));
            if (!feof($file)) {
                $object = new static();
                $object->num = $num++;
                foreach (static::$vars as $index => $var) {
                    $object->$var = $data[$index];
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

        if (isset(static::$items[$num])) {
            return static::$items[$num];
        }

        return null;
    }

    public static function saveAll() {
        $file = fopen(__DIR__ . "/../data/" . static::$filename, 'w');

        foreach (static::$items as $item) {
            $vars = [];
            foreach (static::$vars as $var) {
                $vars[] = $item->$var;
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
            $this->num = count(static::$items);
            static::$items[] = $this;
            static::saveAll();
        }
    }

    public function delete() {
        unset(static::$items[$this->num]);
        static::saveAll();
    }
}

