<?php

include 'includes/init.php';

if (!empty($_POST['sign_in'])) {
    $errors['sign_in'] = [];

    if (empty($_POST['sign_in']['login'])) {
        $errors['sign_in']['login'] = 'Введите логин';
    }

    if (empty($_POST['sign_in']['password'])) {
        $errors['sign_in']['password'] = 'Введите пароль';
    }

    if (empty($errors['sign_in'])) {
        if ($user = User::getByLoginPassword($_POST['sign_in']['login'], $_POST['sign_in']['password'])) {
            $user->login();
            header('Location: index.php');
            exit;
        } else {
            $errors['sign_in'][] = 'Неверный логин или пароль';
        }
    }
}

if (!empty($_POST['sign_up'])) {
    $errors['sign_up'] = [];

    if (empty($_POST['sign_up']['login'])) {
        $errors['sign_up']['login'] = 'Введите логин';
    }

    if (empty($_POST['sign_up']['password'])) {
        $errors['sign_up']['password'] = 'Введите пароль';
    }

    if (empty($_POST['sign_up']['email'])) {
        $errors['sign_up']['email'] = 'Введите E-mail';
    }

    if (empty($errors['sign_up'])) {
        $user = new User();
        $user->login = $_POST['sign_up']['login'];
        $user->password = md5($_POST['sign_up']['password']);
        $user->email = $_POST['sign_up']['email'];
        $user->save();
        $user->login();
        $mail_content = "
            Вы успешно зарегистрировались на сайте localhost shop
            Данные авторизации:
            Логин - {$_POST['sign_up']['login']}
            Пароль - {$_POST['sign_up']['password']}
        ";
        mail($_POST['sign_up']['email'], 'Регистрация (localhost shop)', $mail_content);
        header('Location: index.php');
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php include 'includes/meta.php' ?>
    <title>Document</title>
</head>
<body>
    <div id="templatemo_body_wrapper">
        <div id="templatemo_wrapper">
            <?php include 'includes/head.php'; ?>

            <div id="templatemo_main">
                <form method="post" id="sign_in" class="float_l sign">
                    <h3>Форма авторизации</h3>

                    <?php if (isset($errors['sign_in'][0])) { ?>
                        <span class="error"><?= $errors['sign_in'][0] ?></span>
                    <?php } ?>

                    <?php if (isset($errors['sign_in']['login'])) { ?>
                        <span class="error"><?= $errors['sign_in']['login'] ?></span>
                    <?php } ?>
                    <input type="text" name="sign_in[login]" placeholder="Ваш логин">

                    <?php if (isset($errors['sign_in']['password'])) { ?>
                        <span class="error"><?= $errors['sign_in']['password'] ?></span>
                    <?php } ?>
                    <input type="password" name="sign_in[password]" placeholder="Ваш пароль">

                    <button type="submit">Войти</button>
                </form>

                <form method="post" id="sign_up" class="float_r sign sign_line">
                    <h3>Форма регистрации</h3>

                    <?php if (isset($errors['sign_up']['login'])) { ?>
                        <span class="error"><?= $errors['sign_up']['login'] ?></span>
                    <?php } ?>
                    <input type="text" name="sign_up[login]" placeholder="Введите новый логин">

                    <?php if (isset($errors['sign_up']['password'])) { ?>
                        <span class="error"><?= $errors['sign_up']['password'] ?></span>
                    <?php } ?>
                    <input type="password" name="sign_up[password]" placeholder="Введите новый пароль">

                    <?php if (isset($errors['sign_up']['email'])) { ?>
                        <span class="error"><?= $errors['sign_up']['email'] ?></span>
                    <?php } ?>
                    <input type="text" name="sign_up[email]" placeholder="Введите Ваш E-mail">

                    <button type="submit">Регистрация</button>
                </form>

                <div class="cleaner"></div>
            </div>

            <?php include 'includes/foot.php' ?>
        </div>
</div>
</body>
</html>