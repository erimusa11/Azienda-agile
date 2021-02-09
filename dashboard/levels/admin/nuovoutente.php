<?php
session_start();
include '../../function.php';

$livello = $_SESSION['livello'];
$userId = $_SESSION['userId'];

if (!isset($userId) || ($_SESSION['livello'] != 2)) {
    header("Location: ../../index.php");
}

//valid class
$is_valid = 'is-valid';
//valid feedback
$validFeedback = '<div class="valid-feedback">Good job!</div>';

//invalid class
$is_invalid = 'is-invalid';
$invalidFeedback = '  <div class="invalid-feedback">Oh no! Email is invalid.</div>';


include '../nuovoutente.php';