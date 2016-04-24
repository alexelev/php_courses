<?php 

    include 'inc/functions.php';

    $employees = load_employees();
    $offices = [];
    foreach ($employees as $employee) {
        $offices[] = $employee['post'];
    }
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

        <!-- <table>
            <thead>
                <th colspan="7">Фильтр по списку</th>
            </thead>
            <tbody>
                <tr>
                    <td>№</td>
                    <td>ФИО</td>
                    <td>Дата рождения</td>
                    <td>Телефон</td>
                    <td>Должность</td>
                    <td></td>
                    <td></td>                   
                </tr>
            </tbody>
        </table> -->

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
                <form  method="post">
                <tr>
                    <td></td>
                    <td><input type="text" placeholder="ФИО" name="emp[name]"></td>
                    <td><input type="date" placeholder="Дата рождения" name="emp[date]"></td>
                    <td><input type="text" placeholder="Телефон" name="emp[tel]"></td>
                    <td>
                        <?php if (empty($offices)) { ?>
                        
                        <input type="text" placeholder="Должность" name="emp[office]">
                        
                        <?php } else { ?>
                        
                        <select name="emp[office]" id="">

                            <option value="null">Выберите должность</option>
                            
                            <?php foreach ($offices as $office) { ?>
                                
                                <option value="<?= $office ?>"><?= $office ?></option>

                            <? } ?>


                        </select>

                        <?php } ?>

                    </td>
                    <td colspan="2"><button type="Submit">Фильтровать</button></td>
                </tr>
                </form>


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