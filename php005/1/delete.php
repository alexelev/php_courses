<?php
    include 'inc/init.php';

    if ($user && isset($_GET['index'])) {

    }

    if (isset($_GET['num'])) {
        include 'inc/load_employees.php';

        unset($employees[$_GET['num'] - 1]);

        include 'inc/save_employees.php';
    }

    header('Location: index.php');
    exit;
?>