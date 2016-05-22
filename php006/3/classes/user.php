<?php

include_once 'base.php';

class User extends Base {
    protected static $filename = 'users';
    protected static $vars = ['login', 'password', 'email'];
    protected static $items = [];

    public function login() {
        $_SESSION['user'] = $this->num;
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public static function getCurrentUser() {
        if (isset($_SESSION['user'])) {
            return self::getItem($_SESSION['user']);
        }

        return null;
    }

    public static function getByLoginPassword($login, $password) {
        if ($row = Database::select_one("SELECT * FROM `users` WHERE `login` = '{$login}' AND `password` = '" . md5($password) . "'")) {
            $user = new User();
            $user->num = $row['id'];
            $user->login = $row['login'];
            $user->password = $row['password'];
            $user->email = $row['email'];

            return $user;
        };

        return null;
    }
}