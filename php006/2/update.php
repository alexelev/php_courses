<?php

$connection = mysqli_connect('localhost', 'root', '', 'company');

if (mysqli_query($connection, "UPDATE `users` SET `login` = 'user4 updated' WHERE `id` = 4")) {
    echo 'Пользователь изменен';
} else {
    echo 'Пользователь не изменен';
}
