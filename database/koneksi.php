<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/config.php';

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}