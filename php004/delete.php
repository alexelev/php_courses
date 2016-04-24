<?php
    include 'classes/employee.php';
    include 'inc/functions.php';

    if (isset($_GET['index'])) {
        $employee = Employee::getEmployee($_GET['index']);
        if ($employee) {
            $employee->delete();
        }
    }

    header('Location: index.php');
    exit;
?>