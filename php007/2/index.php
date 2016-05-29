<?php include 'includes/init.php' ?>

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
                    <?php include 'includes/slider.php'; ?>

                    <h1>Новые товары</h1>

                    <?php foreach (Product::getAll(6) as $product) { ?>
                        <div class="product_box">
                            <h3><?= $product->name ?></h3>
                            <a href="product.php?product=<?= $product->id ?>"><img src="images/product/<?= $product->id ?>.jpg" alt="<?= $product->name ?>"></a>
                            <p><?= $product->get_excerpt() ?></p>
                            <p class="product_price"><?= $product->price ?></p>
                            <a href="cart.php?action=add&product=<?= $product->id ?>" class="addtocart"></a>
                            <a href="product.php?product=<?= $product->id ?>" class="detail"></a>
                        </div>
                    <?php } ?>
                </div>

                <div class="cleaner"></div>
            </div>

            <?php include 'includes/foot.php' ?>
        </div>
    </div>
</body>
</html>