<?php

function load_employees_filtered($filename = 'employees') {
    $filtered = $employees = load_employees($filename);
    $errors = checkout_filter();

    if (empty($errors)) {
        foreach ($employees as $index => $employee) {
            if (!empty($_GET['num']) && $index != $_GET['num'] - 1) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($_GET['name']) && strpos($employee['name'], $_GET['name']) === false) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($_GET['birth']) && $employee['birth'] != $_GET['birth']) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($_GET['phone']) && $employee['phone'] != $_GET['phone']) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($_GET['post']) && strpos($employee['post'], $_GET['post']) === false) {
                unset($filtered[$index]);
                continue;
            }
        }
    }

    return $filtered;
}

function checkout_employee($employee) {
    $errors = [];

    if (empty($employee['name'])) {
        $errors['name'] = 'Введите ФИО сотрудника';
    }

    if (empty($employee['birth'])) {
        $errors['birth'] = 'Введите дату рождения';
    } else if (!preg_match('/^\d\d\.\d\d.\d\d\d\d$/', $employee['birth'])) {
        $errors['birth'] = 'Некорректная дата рождения';
    }

    if (empty($employee['phone'])) {
        $errors['phone'] = 'Введите телефон сотрудника';
    } else if (!preg_match('/^[+\d ()-]+$/', $employee['phone'])) {
        $errors['phone'] = 'Некорректный телефон';
    }

    if (empty($employee['post'])) {
        $errors['post'] = 'Введите должность сотрудника';
    }

    return $errors;
}

function checkout_filter() {
    $errors = [];

    if (!empty($_GET['num']) && !is_numeric($_GET['num'])) {
        $errors['num'] = 'Здесь должно быть число';
    }

    if (!empty($_GET['birth']) && !preg_match('/^\d\d\.\d\d.\d\d\d\d$/', $_GET['birth'])) {
        $errors['birth'] = 'Некорректная дата';
    }

    if (!empty($_GET['phone']) && !preg_match('/^[+\d ()-]+$/', $_GET['phone'])) {
        $errors['phone'] = 'Некорректный телефон';
    }

    return $errors;
}