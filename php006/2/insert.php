<?php

$connection = mysqli_connect('localhost', 'root', '', 'company');

$sql = "
  INSERT INTO `users`
  (`login`, `password`, `email`)
  VALUES
  ('user1', '" . md5('pass1') . "', 'user1@email.com'),
  ('user2', '" . md5('pass2') . "', 'user2@email.com'),
  ('user3', '" . md5('pass3') . "', 'user3@email.com'),
  ('user4', '" . md5('pass4') . "', 'user4@email.com'),
  ('user5', '" . md5('pass5') . "', 'user5@email.com')
";

if (mysqli_query($connection, $sql)) {
    echo 'Пользователи добавлены';
} else {
    echo 'Пользователи не добавлены';
}