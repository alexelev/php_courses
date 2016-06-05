<?php
    include 'includes/init.php';

    if (empty($_GET['product'])) {
        http_response_code(404);
        include '404.php';
        exit;
    }

    if (!is_numeric($_GET['product'])) {
        http_response_code(404);
        include '404.php';
        exit;
    }

    try {
        $product = new Product($_GET['product']);
    } catch (Exception $e) {
        http_response_code(404);
        include '404.php';
        exit;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <?php include 'includes/meta.php' ?>
    <title>Document</title>
</head>
<body>
<div id="templatemo_body_wrapper">
    <div id="templatemo_wrapper">
        <?php include 'includes/head.php'; ?>

        <div id="templatemo_main">
            <div id="sidebar" class="float_l">
                <?php include 'includes/categories.php'; ?>

                <?php include 'includes/bestsellers.php'; ?>
            </div>

            <div id="content" class="float_r">
                <h1><?= $product->name ?></h1>

                <div class="content_half float_l">
                    <a rel="lightbox[portfolio]" href="images/product/<?= $product->id ?>.jpg">
                        <img src="images/product/<?= $product->id ?>.jpg" alt="<?= $product->name ?>" />
                    </a>
                </div>

                <div class="content_half float_r">
                    <table>
                        <tbody>
                            <tr>
                                <td width="160">Цена:</td>
                                <td><?= $product->price ?> руб.</td>
                            </tr>
                            <tr>
                                <td>Availability:</td>
                                <td><?= ($product->quantity > 0) ? 'Есть в наличии' : 'Нет в наличии' ?></td>
                            </tr>
                            <tr>
                                <td>Производитель:</td>
                                <td><?= $product->manufacturer ?></td>
                            </tr>
                            <tr>
                                <td>Количество</td>
                                <td><input id="quantity" type="text" value="1" style="width: 20px; text-align: right"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="cleaner h20"></div>

                    <script>
                        function add_to_cart() {
                            $(this).attr('href', $(this).attr('href') + '&' + $('#quantity').val());
                            // отправка аякс
                        }
                    </script>
                    <a id="" href="cart.php?action=add&product=<?= $product->id ?>" class="addtocart" onclick="add_to_cart(); return false;"></a>
                </div>

                <div class="cleaner h30"></div>

                <h5>Описание товара</h5>

                <p><?= $product->description ?></p>
            </div>

            <div class="cleaner"></div>
        </div>

        <?php include 'includes/foot.php' ?>
    </div>
</div>
</body>
</html>