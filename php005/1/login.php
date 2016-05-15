<?php
    include 'inc/init.php';

    if (!empty($_POST)) {
        include 'inc/proccess_login.php';
        if (empty($errors)) {
            header('Location: index.php');
            exit;
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php include 'inc/header.php' ?>

    <h1>Авторизация</h1>

    <form method="post">
        <?php if (isset($errors['user'])) { ?>
            <span class="error"><?= $errors['user'] ?></span><br/><br/>
        <?php } ?>
        <label>Логин</label>
        <input type="text" name="login" value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>" />
        <?php if (isset($errors['login'])) { ?>
            <span class="error"><?= $errors['login'] ?></span>
        <?php } ?>
        <br/><br/>

        <label>Пароль</label>
        <input type="password" name="password" />
        <?php if (isset($errors['password'])) { ?>
            <span class="error"><?= $errors['password'] ?></span>
        <?php } ?>
        <br/><br/>

        <input type="submit" value="Войти" />
    </form>
</body>
</html>
