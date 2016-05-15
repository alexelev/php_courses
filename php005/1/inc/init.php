<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);
session_start();

$user = isset($_SESSION['current_user']) ? $_SESSION['current_user'] : null;