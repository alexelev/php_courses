<?php

$errors = [];

if (empty($_POST['login'])) {
    $errors['login'] = 'Введите логин';
}

if (empty($_POST['password'])) {
    $errors['password'] = 'Введите пароль';
}

if (empty($errors)) {
    include 'load_users.php';

    foreach ($users as $user) {
        if ($user['login'] == $_POST['login'] and $user['password'] == $_POST['password']) {
            $_SESSION['current_user'] = $user;
        }
    }

    if (empty($_SESSION['current_user'])) {
        $errors['user'] = 'Неверный логин или пароль';
    }
}