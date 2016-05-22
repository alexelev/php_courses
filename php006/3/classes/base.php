<?php

include 'Database.php';

abstract class Base {
    protected static $filename;
    protected static $vars;

    protected $values;

    public $num;

    public static function getAll() {
        $objects = [];
        foreach (Database::select("SELECT * FROM `" . static::$filename . "`") as $row) {
            $object = new static();
            $object->num = $row['id'];
            foreach (static::$vars as $var) {
                $object->values[$var] = $row[$var];
            }

            $objects[] = $object;
        }

        return $objects;
    }

    public static function getItem($num) {
        if ($row = Database::select_one("SELECT * FROM `" . static::$filename . "` WHERE `id` = {$num}")) {
            $object = new static();
            $object->num = $row['id'];
            foreach (static::$vars as $var) {
                $object->values[$var] = $row[$var];
            }

            return $object;
        }

        return null;
    }

    public function add() {
        $sql = "
          INSERT INTO `" . static::$filename . "` 
          (`" . implode('`, `', static::$vars) . "`)
          VALUES
          ('" . implode("', '", static::$values) . "')
        ";

        if (!Database::query($sql)) {
            return false;
        }

        $this->num = Database::get_insert_id();

        return true;
    }

    public function delete() {
        if ($this->num) {
            return Database::query("DELETE FROM `" . static::$filename . "` WHERE `id` = {$this->num}");
        }

        return false;
    }

    public function update() {
        if ($this->num) {
            $sql = "
                UPDATE `" . static::$filename . "`
                SET
            ";

            foreach ($this->values as $name => $value) {
                $sql .= "`$name` = '$value', ";
            }

            $sql = rtrim($sql, ', ');

            $sql .= " WHERE `id` = {$this->num}";

            return Database::query($sql);
        }

        return false;
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

