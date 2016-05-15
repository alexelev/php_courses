<header>
    <?php if ($current_user) { ?>
        <span>Вы вошли как <?= $current_user['login'] ?></span> <br/>
        <a href="index.php">Сотрудники</a>
        <a href="new.php">Добавить</a>
        <a href="logout.php">Выйти</a>
    <?php } else { ?>
        <a href="login.php">Войти</a>
    <?php } ?>
</header>