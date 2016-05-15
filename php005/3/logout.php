<?php

include 'inc/init.php';

if ($user = User::getCurrentUser()) {
    $user->logout();
    header('Location: index.php');
}