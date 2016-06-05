<?php

include_once 'base.php';

class User extends Base {
    protected static $_table = 'users';
    protected static $_fields = ['login', 'password', 'email'];

    public function login() {
        $_SESSION['user'] = $this->_id;
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public static function getCurrentUser() {
        if (isset($_SESSION['user'])) {
            return new User($_SESSION['user']);
        };

        return null;
    }

    public static function getByLoginPassword($login, $password) {
        if ($row = Database::select_one("SELECT * FROM `users` WHERE `login` = '{$login}' AND `password` = '" . md5($password) . "'")) {
            $user = new User();
            $user->_id = $row['id'];
            $user->login = $row['login'];
            $user->password = $row['password'];
            $user->email = $row['email'];

            return $user;
        };

        return null;
    }
}