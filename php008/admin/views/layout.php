<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $page_title ?></title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Панель управления</a>
                <a href="products.php" class="navbar-brand">Товары</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <?php include $view; ?>
    </div>
</body>
</html>