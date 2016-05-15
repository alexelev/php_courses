<header>
    <?php if ($user = User::getCurrentUser()) { ?>
        <span>Вы вошли как <?= $user->login ?></span> <br/>
        <a href="index.php">Сотрудники</a>
        <a href="new.php">Добавить сотрудника</a>
        <a href="departments.php">Отделы</a>
        <a href="new-department.php">Добавить отдел</a>
        <a href="logout.php">Выйти</a>
    <?php } else { ?>
        <a href="login.php">Войти</a>
    <?php } ?>
</header>