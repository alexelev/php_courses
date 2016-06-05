<?php
include 'includes/init.php';

$action = $_GET['action'];

if ($action == 'add' || $action == 'quantity') {
    $quantity = isset($_GET['quantity']) && is_numeric($_GET['quantity']) ? $_GET['quantity'] : 1;
    $product_id = $_GET['product'];
}

$cart = new Cart();

switch ($action) {
    case 'add' :
        $cart->addProduct($product_id, $quantity);
        echo 'OK';
        exit;
    case 'del' :
        $cart->delProduct($product_id);
        echo 'OK';
        exit;
    case 'quantity' :
        $cart->changeProductQuantity($product_id, $quantity);
        echo 'OK';
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
            <?php include 'includes/head.php' ?>

            <div id="templatemo_main">
                <div id="sidebar" class="float_l">
                    <?php include 'includes/categories.php'; ?>

                    <?php include 'includes/bestsellers.php'; ?>
                </div>

                <div id="content" class="float_r">
                    <h1>Ваша корзина</h1>

                    <?php if ($cart->getProductsCount() > 0) { ?>
                        <table width="680px" cellspacing="0" cellpadding="5">
                            <tbody>
                            <tr bgcolor="#ddd">
                                <th width="220" align="left">Картинка </th>
                                <th width="180" align="left">Описание </th>
                                <th width="100" align="center">Количество </th>
                                <th width="60" align="right">Цена </th>
                                <th width="60" align="right">Сумма </th>
                                <th width="90"> </th>
                            </tr>

                            <?php $total_price = 0; ?>
                            <?php foreach ($cart->getProductsList() as $product) {?>
                                <tr>
                                    <td><img src="images/product/<?= $product->id ?>.jpg" alt="<?= $product->name ?>"></td>
                                    <td>
                                        <a href="product.php?product=<?= $product->id ?>"><?= $product->name ?></a>
                                        <a href="catalog.php?category=<?= $product->category ?>"><?= $product->category_name ?></a>
                                    </td>
                                    <td align="center"><input type="text" value="<?= $cart->getProductQuantity($product->id) ?>" style="width: 20px; text-align: right"> </td>
                                    <td align="right"><?= $product->price ?></td>
                                    <td align="right"><?= $product->price * $cart->getProductQuantity($product->id) ?></td>
                                    <td align="center">
                                        <a href="cart.php?product=<?= $product->d ?>&quantity=0">
                                            <img src="images/remove_x.gif" alt="remove">
                                            <br>Remove
                                        </a>
                                    </td>

                                    <?php $total_price += $product->price * $cart->getProductQuantity($product->id); ?>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="3" align="right" height="30px"></td>
                                <td align="right" style="background:#ddd; font-weight:bold"> Total </td>
                                <td align="right" style="background:#ddd; font-weight:bold"><?= $total_price ?></td>
                                <td style="background:#ddd; font-weight:bold"> </td>
                            </tr>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>В вашей корзине нет товаров. <a href="index.php">Вернуться к покупкам</a></p>
                    <?php }?>
                </div>

                <div class="cleaner"></div>
            </div>

            <?php include 'includes/foot.php' ?>
        </div>
    </div>
</body>
</html>