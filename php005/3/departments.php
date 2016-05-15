<?php

include 'inc/init.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
        <?php include 'inc/header.php'; ?>

        <?php if (User::getCurrentUser()) { ?>
            <h1>Список отделов</h1>

            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Название отдела</th>
                        <th>Адрес</th>
                        <th>Кол-во сотрудников</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach (Department::getAll() as $department) { ?>
                        <tr>
                            <th><?= $department->num ?></th>
                            <td><?= $department->name ?></td>
                            <td><?= $department->address ?></td>
                            <td><?= $department->employees_count ?></td>
                            <td><a href="edit.php?index=<?= $department->num ?>">Изменить</a></td>
                            <td><a href="delete.php?index=<?= $department->num ?>">Удалить</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h3><a href="login.php">Войдите</a> под своим логином</h3>
        <?php } ?>
    </div>
</body>
</html>
