<?php
function init() {
    global $current_user;

    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    session_start();

    $current_user = (isset($_SESSION['current_user']) ? $_SESSION['current_user'] : null);
}

function load_file($filename, $fields) {
    $file = fopen(__DIR__ . "/../data/$filename", 'r');

    $lines = [];
    $num = 1;
    while (!feof($file)) {
        $line1 = explode(' | ', fgets($file));

        if (!feof($file)) {
            $line2 = [];
            $line2['num'] = $num++;
            foreach ($line1 as $index => $value) {
                $line2[$fields[$index]] = $value;
            }

            $lines[] = $line2;
        }
    }

    fclose($file);

    return $lines;
}

function load_employees($filter = []) {
    $employees = load_file('employees', ['name', 'birth', 'phone', 'post']);

    if (!empty($filter)) {
        $filtered = $employees;

        foreach ($employees as $index => $employee) {
            if (!empty($filter['num']) && $employee['num'] != $filter['num']) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($filter['name']) && strpos($employee['name'], $filter['name']) === false) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($filter['birth']) && $employee['birth'] != $filter['birth']) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($filter['phone']) && $employee['phone'] != $filter['phone']) {
                unset($filtered[$index]);
                continue;
            }

            if (!empty($filter['post']) && strpos($employee['post'], $filter['post']) === false) {
                unset($filtered[$index]);
                continue;
            }
        }

        $employees = $filtered;
    }

    return $employees;
}

function load_users() {
    return load_file('users', ['login', 'password', 'email']);
}

function save_file($filename, $lines) {
    $file = fopen(__DIR__ . "/../data/$filename", 'w');

    foreach ($lines as $line) {
        unset($line['num']);
        fwrite($file, implode(' | ', $line) . "\r\n");
    }

    fclose($file);
}

function save_employees($employees) {
    save_file('employees', $employees);
}

function add_line($filename, $line) {
    $file = fopen(__DIR__ . "/../data/$filename", 'a+');
    fwrite($file, implode(' | ', $line) . "\r\n");
    fclose($file);
}

function add_employee($employee) {
    $errors = checkout_employee($employee);

    if (empty($errors)) {
        add_line('employees', $employee);
        return true;
    }

    return $errors;
}

function delete_employee($num) {
    $employees = load_employees();

    if (isset($employees[$num - 1])) {
        unset($employees[$num - 1]);
        save_employees($employees);
        return true;
    }

    return false;
}

function edit_employee($num, $employee) {
    $employees = load_employees();

    if (isset($employees[$num - 1])) {
        $errors = checkout_employee($employee);

        if (empty($errors)) {
            $employees[$num - 1] = $employee;
            save_employees($employees);
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

function checkout_login($login, $password) {
    $errors = [];

    if (empty($_POST['login'])) {
        $errors['login'] = 'Введите логин';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Введите пароль';
    }

    return $errors;
}

function login($login, $password) {
    global $current_user;

    $errors = checkout_login($login, $password);

    if (empty($errors)) {
        $users = load_users();

        foreach ($users as $user) {
            if ($user['login'] == $_POST['login'] and $user['password'] == $_POST['password']) {
                $current_user = $_SESSION['current_user'] = $user;
                break;
            }
        }

        if (empty($current_user)) {
            $errors['user'] = 'Неверный логин или пароль';
        }
    }

    return $errors;
}

function logout() {
    global $current_user;

    $current_user = $_SESSION['current_user'] = null;
}
