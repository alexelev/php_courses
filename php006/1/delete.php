<?php
    include 'classes/employee.php';

    if (isset($_GET['index'])) {
        $employee = Employee::getItem($_GET['index']);
        if ($employee) {
            $employee->delete();
        }
    }

    header('Location: index.php');
    exit;
?>