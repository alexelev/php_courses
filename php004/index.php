<?php
    include 'inc/init.php';
?>

<?php
    $errors = checkout_filter();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список контактов</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 20px;
        }

        table thead th {
            padding: 10px;
            vertical-align: middle;
        }

        table thead th .error {
            font-size: 14px;
            color: red;
        }

        table tbody th, table tbody td {
            padding: 10px;
            vertical-align: middle;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div style="margin: 0 auto; text-align: center">
        <?php include 'inc/header.php' ?>

        <h1>Список сотрудников</h1>

        <p style="margin-bottom: 60px;"><a href="new.php" style="float: right; font-size: 18px; margin-right: 5px;">Добавить сотрудника</a></p>

        <form>
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
                <?php foreach (Employee::getAll() as $employee) { ?>
                    <tr>
                        <th><?= $employee->num + 1 ?></th>
                        <td><?= $employee->fullname ?></td>
                        <td><?= $employee->birth ?></td>
                        <td><?= $employee->phone ?></td>
                        <td><?= $employee->post ?></td>
                        <td><a href="edit.php?index=<?= $employee->num ?>">Изменить</a></td>
                        <td><a href="delete.php?index=<?= $employee->num ?>">Удалить</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>