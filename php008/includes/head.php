<div id="templatemo_header">
    <div id="site_title"><h1><a href="#">Online Shoes Store</a></h1></div>
    <div id="header_right">
        <p>
            <a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> |
            <?php if ($user = User::getCurrentUser()) {?>
                <span style="color: white; font-weight: bold; text-transform: uppercase; font-size: 14px;"><?= $user->login ?></span> | <a href="logout.php">Выйти</a>
            <?php } else { ?>
                <a href="login.php">Войти<?php } ?></a>
        </p>
        <p>
            <?php $cart = new Cart(); ?>
            Shopping Cart: <strong id="cart_count"><?= $cart->getProductsCount() ?></strong> ( <a href="cart.php">Корзина</a> )
        </p>
    </div>
    <div class="cleaner"></div>
</div>

<div id="templatemo_menubar">
    <div id="top_nav" class="ddsmoothmenu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li style="z-index: 100;"><a href="product.html" class="">Products</a>
                <ul style="top: 40px; visibility: visible; left: 0px; width: 190px; display: none;">
                    <li><a href="#submenu1">Sub menu 1</a></li>
                    <li><a href="#submenu2">Sub menu 2</a></li>
                    <li><a href="#submenu3">Sub menu 3</a></li>
                    <li><a href="#submenu4">Sub menu 4</a></li>
                    <li><a href="#submenu5">Sub menu 5</a></li>
                </ul>
            </li>
            <li style="z-index: 99;"><a href="about.html" class="">About</a>
                <ul style="top: 40px; visibility: visible; left: 0px; width: 190px; display: none;">
                    <li><a href="#submenu1">Sub menu 1</a></li>
                    <li><a href="#submenu2">Sub menu 2</a></li>
                    <li><a href="#submenu3">Sub menu 3</a></li>
                </ul>
            </li>
            <li><a href="faqs.html">FAQs</a></li>
            <li><a href="checkout.html">Checkout</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
        <br style="clear: left">
    </div> <!-- end of ddsmoothmenu -->
    <div id="templatemo_search">
        <form action="#" method="get">
            <input type="text" value=" " name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field">
            <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn">
        </form>
    </div>
</div>