<?php
    include 'inc/functions.php';

    if (isset($_GET['index'])) {
        delete_employee($_GET['index']);
    }

    header('Location: index.php');
?>