<?php

mysqli_report(MYSQLI_REPORT_OFF);

$configPath = $_SERVER['DOCUMENT_ROOT'] . '/database/config.php';

if (!file_exists($configPath)) {

    $conn = null;
    return;
}


include $configPath;

$conn = @new mysqli(
    $host,
    $username,
    $password,
    $dbname,
    $port
);


if ($conn->connect_errno) {

    $conn = null;
    return;
}
