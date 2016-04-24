<?php

include_once 'base.php';

class User extends Base {
    protected static $filename = 'users';
    protected static $vars = ['login', 'password', 'email'];

    public $login;
    public $password;
    public $email;

    public function login() {
        $_SESSION['user'] = $this;
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public static function getCurrentUser() {
        if (!empty($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return null;
    }

    public static function getByLoginPassword($login, $password) {
        if (empty(self::$items)) {
            self::loadItems();
        }

        foreach(self::$items as $user) {
            if ($user->login == $login && $user->password == $password) {
                return $user;
            }
        }

        return null;
    }
}