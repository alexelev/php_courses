<?php include 'inc/functions.php' ?>

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

        table th, table td {
            padding: 10px;
            vertical-align: middle;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div style="width: 1000px; margin: 0 auto; text-align: center">
        <h1>Список сотрудников</h1>

        <p style="margin-bottom: 60px;"><a href="new.php" style="float: right; font-size: 18px; margin-right: 5px;">Добавить сотрудника</a></p>

        <table>
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>Должность</th>
                <th></th>
                <th></th>

            </tr>
            </thead>

            <tbody>
            <?php foreach (load_employees() as $index => $employee) { ?>
                <tr>
                    <th><?= $index + 1 ?></th>
                    <td><?= $employee['name'] ?></td>
                    <td><?= $employee['birth'] ?></td>
                    <td><?= $employee['phone'] ?></td>
                    <td><?= $employee['post'] ?></td>
                    <td><a href="edit.php?index=<?= $index ?>">Изменить</a></td>
                    <td><a href="delete.php?index=<?= $index ?>">Удалить</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>