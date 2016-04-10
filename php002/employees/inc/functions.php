<?php

function load_employees($filename = 'employees') {
    $file = fopen("data/{$filename}", 'r');
    $employees = [];
    while (!feof($file)) {
        list($name, $birth, $phone, $post) = explode(' | ', fgets($file));
        if (!feof($file)) {
            $employees[] = [
                'name' => $name,
                'birth' => $birth,
                'phone' => $phone,
                'post' => $post
            ];
        }
    }

    fclose($file);

    return $employees;
}

function save_employees($employees, $filename = 'employees') {
    $file = fopen("data/{$filename}", 'w');

    foreach ($employees as $employee) {
        fwrite($file, "{$employee['name']} | {$employee['birth']} | {$employee['phone']} | {$employee['post']}");
    }

    fclose($file);
}

function add_employee($employee, $filename='employees') {
    $errors = checkout_employee($employee);

    if (empty($errors)) {
        $file = fopen("data/{$filename}", 'a');
        fwrite($file, "{$employee['name']} | {$employee['birth']} | {$employee['phone']} | {$employee['post']}\r\n");
        fclose($file);
        return true;
    }

    return $errors;
}

function delete_employee($index, $filename='employees') {
    $employees = load_employees($filename);

    if (isset($employees[$index])) {
        unset($employees[$index]);
        save_employees($employees, $filename);
        return true;
    }

    return false;
}

function edit_employee($index, $new_employee, $filename='employees') {
    $employees = load_employees($filename);

    if (isset($employees[$index])) {
        $errors = checkout_employee($new_employee);

        if (empty($errors)) {
            $employees[$index] = $new_employee;
            save_employees($employees, $filename);
            return true;
        } else {
            return $errors;
        }
    }

    return false;
}

function checkout_employee($employee) {
    $errors = [];

    if (empty($employee['name'])) {
        $errors['name'] = 'Введите ФИО сотрудника';
    }

    if (empty($employee['birth'])) {
        $errors['birth'] = 'Введите дату рождения';
    } else if (!preg_match('/^\d\d\.\d\d.\d\d\d\d$/', $_POST['employee']['birth'])) {
        $errors['birth'] = 'Некорректная дата рождения';
    }

    if (empty($employee['phone'])) {
        $errors['phone'] = 'Введите телефон сотрудника';
    } else if (!preg_match('/^[+\d ()-]+$/', $_POST['employee']['phone'])) {
        $errors['phone'] = 'Некорректный телефон';
    }

    if (empty($employee['post'])) {
        $errors['post'] = 'Введите должность сотрудника';
    }

    return $errors;
}