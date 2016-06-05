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
            <?php include 'includes/head.php' ?>

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

                    <script>
                        $(function() {
                            $('a.addtocart').click(add_to_cart);
                        });

                        function add_to_cart(event) {
                            event.preventDefault();

                            $.ajax({
                                url: $(this).attr('href'),
                                success: function(response) {
                                    if (response == 'OK') {
                                        alert('товар добавлен в корзину');
                                        $('#cart_count').text(parseInt($('#cart_count').text()) + 1);
                                    } else {
                                        alert('товар не добавлен в корзину')
                                    }


                                },
                                error: function() {
                                    console.log('Ошибка добавления товара в корзину');
                                }
                            })
                        }
                    </script>
                </div>

                <div class="cleaner"></div>
            </div>

            <?php include 'includes/foot.php' ?>
        </div>
    </div>
</body>
</html>