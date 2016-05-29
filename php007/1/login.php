<?php

include 'inc/init.php';

if (!empty($_POST)) {
    $errors = [];
    if (empty($_POST['login'])) {
        $errors['login'] = 'Введите логин';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Введите пароль';
    }

    if (empty($errors)) {
        if ($user = User::getByLoginPassword($_POST['login'], $_POST['password'])) {
            $user->login();
            header('Location: index.php');
            exit;
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <div style="text-align:center;">
        <?php include 'inc/header.php'; ?>

        <form method="post" style="padding-top: 30px;">
            <label>Логин</label>
            <input type="text" name="login">
            <br/>
            <br/>

            <label>Пароль</label>
            <input type="password" name="password">
            <br/>
            <br/>

            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
