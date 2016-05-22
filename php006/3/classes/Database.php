<?php

class Database {
    private static $connection;

    private static function connect() {
        return self::$connection = mysqli_connect('localhost', 'root', '', 'company');
    }

    public static function query($sql) {
        if (!self::$connection && !self::connect()) {
                return false;
        }

        return mysqli_query(self::$connection, $sql);
    }

    public static function select($sql) {
        if ($result = self::query($sql)) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }

    public static function select_one($sql) {
        if ($result = self::query($sql)) {
            return mysqli_fetch_assoc($result);
        }
    }

    public static function get_insert_id() {
        if (!self::$connection) {
            return null;
        }

        return mysqli_insert_id(self::$connection);
    }
}