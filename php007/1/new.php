<?php
    include 'inc/init.php';

    $has_data = !empty($_POST);
    $has_errors = false;

    if ($has_data) {
        $errors = [];
        if (empty($_POST['employee']['name'])) {
            $errors['name'] = 'Введите ФИО сотрудника';
        }

        if (empty($_POST['employee']['birth'])) {
            $errors['birth'] = 'Введите дату рождения';
        } else if (!preg_match('/^\d\d\.\d\d.\d\d\d\d$/', $_POST['employee']['birth'])) {
            $errors['birth'] = 'Некорректная дата рождения';
        }

        if (empty($_POST['employee']['phone'])) {
            $errors['phone'] = 'Введите телефон сотрудника';
        } else if (!preg_match('/^[+\d ()-]+$/', $_POST['employee']['phone'])) {
            $errors['phone'] = 'Некорректный телефон';
        }

        if (empty($_POST['employee']['post'])) {
            $errors['post'] = 'Введите должность сотрудника';
        }

        if (empty($_POST['employee']['department'])) {
            $errors['department'] = 'Выберите отдел';
        }

        $has_errors = !empty($errors);

        if (!$has_errors) {
            $employee = new Employee();
            $employee->fullname = $_POST['employee']['name'];
            $employee->birth = implode('-', array_reverse(explode('.', $_POST['employee']['birth'])));
            $employee->phone = $_POST['employee']['phone'];
            $employee->post = $_POST['employee']['post'];
            $employee->department = $_POST['employee']['department'];
            $employee->add();
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

        form .field select {
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
                <input type="text" name="employee[name]" value="<?= $has_data ? $_POST['employee']['name'] : '' ?>" />
                <?php if ($has_errors && isset($errors['name'])) { ?>
                    <span class="error"><?= $errors['name'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Дата рождения</label>
                <input type="text" name="employee[birth]" value="<?= $has_data ? $_POST['employee']['birth'] : '' ?>" />
                <?php if ($has_errors && isset($errors['birth'])) { ?>
                    <span class="error"><?= $errors['birth'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Телефон</label>
                <input type="text" name="employee[phone]" value="<?= $has_data ? $_POST['employee']['phone'] : '' ?>"/>
                <?php if ($has_errors && isset($errors['phone'])) { ?>
                    <span class="error"><?= $errors['phone'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Должность</label>
                <input type="text" name="employee[post]" value="<?= $has_data ? $_POST['employee']['post'] : '' ?>" />
                <?php if ($has_errors && isset($errors['post'])) { ?>
                    <span class="error"><?= $errors['post'] ?></span>
                <?php } ?>
            </div>

            <div class="field">
                <label>Отдел</label>
                <select name="employee[department]">
                    <option value="">Выберите отдел</option>

                    <?php foreach(Department::getAll() as $department) { ?>
                        <?php if ($_POST['employee']['department'] == $department->num) { ?>
                            <option value="<?= $department->num ?>" selected><?= "{$department->name} ({$department->address})" ?></option>
                        <?php } else { ?>
                            <option value="<?= $department->num ?>"><?= "{$department->name} ({$department->address})" ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>

                <?php if ($has_errors && isset($errors['department'])) { ?>
                    <span class="error"><?= $errors['department'] ?></span>
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