<?php
$connection = mysqli_connect('localhost', 'root', '', 'company');

if (mysqli_query($connection, "DELETE FROM `users` WHERE `id` = 5")) {
    echo 'Пользователь удален';
} else {
    echo 'Пользователь не удален';
}