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
        if (empty(self::$items)) {
            self::loadItems();
        }

        foreach(self::$items as $user) {
            if ($user->values['login'] == $login && $user->values['password'] == $password) {
                return $user;
            }
        }

        return null;
    }
}