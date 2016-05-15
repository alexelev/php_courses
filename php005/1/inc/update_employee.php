<?php

$filter = [];
include 'load_employees.php';

if (isset($employees[$employee['num'] - 1])) {
    $employees[$employee['num'] - 1] = $employee;
}

$lines = $employees;
$filename = 'employees';
include 'save_file.php';