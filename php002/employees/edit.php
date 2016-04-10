<?php
include 'inc/functions.php';
$has_data = !empty($_POST);
$has_errors = false;

if ($has_data) {
    $employee = $_POST['employee'];
    $errors = edit_employee($_GET['index'], $employee);
    $has_errors = is_array($errors);

    if (!$has_errors) {
        header('Location: index.php');
        exit;
    }
} else {
    $employee = load_employees();
    /*
    echo '<pre>';
    var_dump($employee); die();
    echo '</pre>';
    */
    if (isset($_GET['index']) && isset($employee[$_GET['index']])) {
        $employee = $employee[$_GET['index']];
    } else {
        $employee = null;
    }

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Редактирование сотрудника</title>

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
        <h1>Редактирование сотрудника</h1>

        <?php if (!$employee) { ?>
            <p style="color: red; font-size: 20px;">Ненайден сотрудник! <a href="index.php">Назад</a></p>
        <?php } else { ?>
            <form method="post">
                <div class="field">
                    <label>ФИО</label>
                    <input type="text" name="employee[name]" value="<?= $employee['name'] ?>" />
                    <?php if ($has_errors && isset($errors['name'])) { ?>
                        <span class="error"><?= $errors['name'] ?></span>
                    <?php } ?>
                </div>

                <div class="field">
                    <label>Дата рождения</label>
                    <input type="text" name="employee[birth]" value="<?= $employee['birth'] ?>" />
                    <?php if ($has_errors && isset($errors['birth'])) { ?>
                        <span class="error"><?= $errors['birth'] ?></span>
                    <?php } ?>
                </div>

                <div class="field">
                    <label>Телефон</label>
                    <input type="text" name="employee[phone]" value="<?= $employee['phone'] ?>"/>
                    <?php if ($has_errors && isset($errors['phone'])) { ?>
                        <span class="error"><?= $errors['phone'] ?></span>
                    <?php } ?>
                </div>

                <div class="field">
                    <label>Должность</label>
                    <input type="text" name="employee[post]" value="<?= $employee['post'] ?>" />
                    <?php if ($has_errors && isset($errors['post'])) { ?>
                        <span class="error"><?= $errors['post'] ?></span>
                    <?php } ?>
                </div>

                <div class="actions">
                    <button type="submit">Отправить</button>
                    <button type="button"><a href="index.php" style="color: black; text-decoration: none; cursor: default;">Отмена</a></button>
                </div>
            </form>
        <?php } ?>
    </div>
</body>
</html>