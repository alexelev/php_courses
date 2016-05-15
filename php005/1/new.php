<?php
    include 'inc/init.php';

    if (!$user) {
        header('Location: login.php');
        exit;
    }

    if ($has_data = !empty($_POST)) {
        $employee = [
            'name' => $_POST['name'],
            'birth' => $_POST['birth'],
            'phone' => $_POST['phone'],
            'post' => $_POST['post'],
        ];
        include 'inc/checkout_employee.php';

        if (empty($errors)) {
            include 'inc/add_employee.php';

            header('Location: index.php');
            exit;
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавление контакта</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
        <?php include 'inc/header.php' ?>

        <h1>Новый сотрудник</h1>

        <form method="post">
            <div class="field">
                <label>ФИО</label>
                <input type="text" name="name" value="<?= $has_data ? $employee['name'] : '' ?>" />
                <?php if (isset($errors['name'])) { ?>
                    <span class="error"><?= $errors['name'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Дата рождения</label>
                <input type="text" name="birth" value="<?= $has_data ? $employee['birth'] : '' ?>" />
                <?php if (isset($errors['birth'])) { ?>
                    <span class="error"><?= $errors['birth'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Телефон</label>
                <input type="text" name="phone" value="<?= $has_data ? $employee['phone'] : '' ?>"/>
                <?php if (isset($errors['phone'])) { ?>
                    <span class="error"><?= $errors['phone'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Должность</label>
                <input type="text" name="post" value="<?= $has_data ? $employee['post'] : '' ?>" />
                <?php if (isset($errors['post'])) { ?>
                    <span class="error"><?= $errors['post'] ?></span>
                <?php } ?>
            </div>

            <div class="actions">
                <button type="submit">Отправить</button>
                <button type="button"><a href="index.php" style="color: black; text-decoration: none; cursor: default;">Отмена</a></button>
            </div>
        </form>
</body>
</html>