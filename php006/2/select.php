<?php

$connection = mysqli_connect('localhost', 'root', '', 'company');

$result = mysqli_query($connection, "SELECT * FROM `users`");

//$all_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo '<pre>';
while ($row = mysqli_fetch_assoc($result)) {
    var_dump($row);
}
