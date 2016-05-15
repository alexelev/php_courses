<?php

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

