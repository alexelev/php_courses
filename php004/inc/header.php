<header>
    <nav>
        <a href="index.php">Список сотрудников</a>
        <a href="users.php">Список пользователей</a>
        
        <?php if (User::getCurrentUser()) { ?>
            <a href="logout.php">Выйти</a>
        <?php } else { ?>
            <a href="login.php">Войти</a>
        <?php } ?>
    </nav>
</header>