<?php
    include 'inc/functions.php';
    $has_data = !empty($_POST);
    $has_errors = false;

    if ($has_data) {
        $employee = $_POST['employee'];
        $errors = add_employee($employee);
        $has_errors = is_array($errors);

        if (!$has_errors) {
            header('Location: index.php');
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавление контакта</title>

    <style>
        form {
            width: 400px;
            margin: 0 auto;
        }

        form .field {
            margin: 10px 0;
            overflow: hidden;
        }

        form .field label {
            font-weight: bold;
            font-size: 18px;
            float: left;
            width: 150px;
            line-height: 27px;
        }

        form .field input {
            box-sizing: border-box;
            font-size: 18px;
            width: 250px;
            float: right;
        }

        form .field .error {
            float: right;
            font-weight: bold;
            color: red;
            margin-top: 10px;
        }

        form .actions {
            margin-top: 20px;
        }

        form .actions button {
            font-size: 18px;
            padding: 5px 10px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div style="width: 1000px; margin: 0 auto; text-align: center">
        <h1>Новый сотрудник</h1>

        <form method="post">
            <div class="field">
                <label>ФИО</label>
                <input type="text" name="employee[name]" value="<?= $has_data ? $employee['name'] : '' ?>" />
                <?php if ($has_errors && isset($errors['name'])) { ?>
                    <span class="error"><?= $errors['name'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Дата рождения</label>
                <input type="text" name="employee[birth]" value="<?= $has_data ? $employee['birth'] : '' ?>" />
                <?php if ($has_errors && isset($errors['birth'])) { ?>
                    <span class="error"><?= $errors['birth'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Телефон</label>
                <input type="text" name="employee[phone]" value="<?= $has_data ? $employee['phone'] : '' ?>"/>
                <?php if ($has_errors && isset($errors['phone'])) { ?>
                    <span class="error"><?= $errors['phone'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Должность</label>
                <input type="text" name="employee[post]" value="<?= $has_data ? $employee['post'] : '' ?>" />
                <?php if ($has_errors && isset($errors['post'])) { ?>
                    <span class="error"><?= $errors['post'] ?></span>
                <?php } ?>
            </div>

            <div class="actions">
                <button type="submit">Отправить</button>
                <button type="button"><a href="index.php" style="color: black; text-decoration: none; cursor: default;">Отмена</a></button>
            </div>
        </form>
    </div>
</body>
</html>