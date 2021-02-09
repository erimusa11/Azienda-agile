<?php

session_start();
include '../../function.php';

$livello = $_SESSION['livello'];
$userId = $_SESSION['userId'];

if (!isset($userId) || ($_SESSION['livello'] != 2)) {
    header("Location: ../../index.php");
}
logout();