<?php
session_start();

if (!isset($_SESSION['user'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/view/login.php';
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/view/template/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/view/home.php';
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/footer.php';
