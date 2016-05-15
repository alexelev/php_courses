<?php

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