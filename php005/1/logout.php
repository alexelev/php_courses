<?php
include 'inc/init.php';

$_SESSION['current_user'] = null;

header('Location: login.php');
