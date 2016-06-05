<?php

include_once __DIR__ . '/database.php';

abstract class Base {
    protected static $_table;
    protected static $_fields;

    protected $_id;
    protected $_values = [];

    public function __construct($id = 0) {
        if ($id) {
            $row = Database::select_one("SELECT * FROM `" . static::$_table . "` WHERE `id` = {$id} ");
            if ($row) {
                $this->_id = $id;
                foreach (static::$_fields as $field) {
                    $this->_values[$field] = $row[$field];
                }
            } else {
                throw new Exception("В таблице " . static::$_table . " не существует записи с id $id");
            }
        }
    }

    public static function getAll() {
        $objects = [];
        foreach (Database::select("SELECT * FROM `" . static::$_table . "`") as $row) {
            $object = new static();
            $object->_id = $row['id'];
            foreach (static::$_fields as $var) {
                $object->_values[$var] = $row[$var];
            }

            $objects[$row['id']] = $object;
        }

        return $objects;
    }

    public static function getCount() {
        $row = Database::select_one("SELECT COUNT(*) AS `count` FROM `" . static::$_table . "`");

        return $row['count'];
    }

    protected function update() {
        if ($this->_id) {
            $sql = "
                UPDATE `" . static::$_table . "`
                SET
            ";

            foreach ($this->_values as $name => $value) {
                $sql .= "`$name` = '$value', ";
            }

            $sql = rtrim($sql, ', ');

            $sql .= " WHERE `id` = {$this->_id}";

            return Database::query($sql);
        }

        return false;
    }

    protected function insert() {
        $sql = "
          INSERT INTO `" . static::$_table . "`
          (`" . implode('`, `', static::$_fields) . "`)
          VALUES
          ('" . implode("', '", $this->_values) . "')
        ";

        if (!Database::query($sql)) {
            return false;
        }

        return $this->_id = Database::get_insert_id();
    }

    public function save() {
        if ($this->_id) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    public function delete() {
        if ($this->_id) {
            if (Database::query("DELETE FROM `" . static::$_table . "` WHERE `id` = {$this->_id}")) {
                $this->_id = 0;
                return true;
            }

            return false;
        }

        return false;
    }

    public function __get($name) {
        if (in_array($name, static::$_fields)) {
            return $this->_values[$name];
        } else if ($name == 'id') {
            return $this->_id;
        }

        return null;
    }

    public function __set($name, $value) {
        if (in_array($name, static::$_fields)) {
            $this->_values[$name] = $value;
        }
    }
}

