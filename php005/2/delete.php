<?php
    include 'inc/functions.php';
    init();

    if (!$current_user) {
        header('Location: login.php');
        exit;
    }
    if (isset($_GET['num'])) {
        delete_employee($_GET['num']);
    }

    header('Location: index.php');
    exit;
?>