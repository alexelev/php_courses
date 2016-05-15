<?php
    include 'inc/functions.php';
    init();
?>

<?php
    $errors = checkout_filter();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список контактов</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div style="margin: 0 auto; text-align: center">
        <?php include 'inc/header.php'; ?>

        <?php if ($current_user) { ?>
            <h1>Список сотрудников</h1>

            <form style="width: auto;">
                <table>
                    <thead>
                    <tr>
                        <th>
                            № <br/>
                            <input type="text" name="num" value="<?= isset($_GET['num']) ? $_GET['num'] : '' ?>"/> <br/>
                            <span class="error"><?= isset($errors['num']) ? $errors['num'] : '&nbsp;' ?></span>
                        </th>

                        <th>
                            ФИО <br/>
                            <input type="text" name="name" value="<?= isset($_GET['name']) ? $_GET['name'] : '' ?>"/> <br/>
                            <span class="error"><?= isset($errors['name']) ? $errors['name'] : '&nbsp;' ?></span>
                        </th>

                        <th>
                            Дата рождения <br/>
                            <input type="text" name="birth" value="<?= isset($_GET['birth']) ? $_GET['birth'] : '' ?>"/> <br/>
                            <span class="error"><?= isset($errors['birth']) ? $errors['birth'] : '&nbsp;' ?></span>
                        </th>

                        <th>
                            Телефон <br/>
                            <input type="text" name="phone" value="<?= isset($_GET['phone']) ? $_GET['phone'] : '' ?>"/> <br/>
                            <span class="error"><?= isset($errors['phone']) ? $errors['phone'] : '&nbsp;' ?></span>
                        </th>

                        <th>
                            Должность <br/>
                            <input type="text" name="post" value="<?= isset($_GET['post']) ? $_GET['post'] : '' ?>"/> <br/>
                            <span class="error"><?= isset($errors['post']) ? $errors['post'] : '&nbsp;' ?></span>
                        </th>
                        <th colspan="2">
                            <button type="submit">Применить</button>
                            <button type="button"><a href="index.php" style="color: inherit; text-decoration: none; cursor: default;">Сбросить</a></button>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php foreach (load_employees(empty($errors) ? $_GET : []) as $employee) { ?>
                            <tr>
                                <th><?= $employee['num'] ?></th>
                                <td><?= $employee['name'] ?></td>
                                <td><?= $employee['birth'] ?></td>
                                <td><?= $employee['phone'] ?></td>
                                <td><?= $employee['post'] ?></td>
                                <td><a href="edit.php?num=<?= $employee['num'] ?>">Изменить</a></td>
                                <td><a href="delete.php?num=<?= $employee['num'] ?>">Удалить</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        <?php } else { ?>
            <h3><a href="login.php">Войдите</a> под своим логином</h3>
        <?php } ?>
    </div>
</body>
</html>