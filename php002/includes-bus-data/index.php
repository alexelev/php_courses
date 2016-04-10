<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
    <script src="main.js"></script>
    <script>
        var stationsCount = <?= (empty($_POST['bus']['route']) ? 0 : count($_POST['bus']['route'])) ?>;
        var passengersCount = <?= (empty($_POST['bus']['passengers']) ? 0 : count($_POST['bus']['passengers'])) ?>;
    </script>
</head>
<body  style="text-align: center;">
<h1>Домашнее задание 1 (решение)</h1>

<div style="display: inline-block; text-align: center;">
    <?php include 'form.php' ?>

    <br/><hr/><br/>

    <?php include 'checkout.php' ?>

    <?php
    if (!$has_errors) {
        include 'output.php';
    }
    ?>
</div>
</body>
</html>