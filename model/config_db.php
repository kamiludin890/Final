<?php

error_reporting(0);
ini_set('display_errors', 0);

if (isset($_POST['submit'])) {

    $host     = $_POST['host'];
    $dbname   = $_POST['name'];
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $port     = !empty($_POST['port'])
        ? $_POST['port']
        : 3306;

    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = new mysqli(
        $host,
        $username,
        $password,
        '',
        $port
    );

    if ($conn->connect_errno) {

        error_log($conn->connect_error);

        switch ($conn->connect_errno) {

            case 1045:

                die('❌ Username atau password database salah.');

            case 2002:

                die('❌ Server database tidak aktif, host atau port salah.');

            default:

                die('⚠️ Koneksi database gagal.');
        }
    }
    $checkDb = $conn->query("
        SELECT SCHEMA_NAME
        FROM INFORMATION_SCHEMA.SCHEMATA
        WHERE SCHEMA_NAME = '$dbname'
    ");

    if ($checkDb->num_rows == 0) {

        $createDb = $conn->query("
            CREATE DATABASE `$dbname`
            CHARACTER SET utf8mb4
            COLLATE utf8mb4_general_ci
        ");

        if (!$createDb) {

            die("❌ Gagal membuat database: " . $conn->error);
        }
    }

    $connDb = new mysqli(
        $host,
        $username,
        $password,
        $dbname,
        $port
    );

    if ($connDb->connect_errno) {

        die("❌ Gagal konek database.");
    }

    $file = $_SERVER['DOCUMENT_ROOT']
        . '/database/config.php';

    $isiFile  = "<?php\n";

    $isiFile .= "\$host = '$host';\n";
    $isiFile .= "\$dbname = '$dbname';\n";
    $isiFile .= "\$username = '$username';\n";
    $isiFile .= "\$password = '$password';\n";
    $isiFile .= "\$port = $port;\n";

    if (!file_put_contents($file, $isiFile)) {

        die("⚠️ Database berhasil dibuat tapi config gagal disimpan.");
    }

    $folder = $_SERVER['DOCUMENT_ROOT'] . '/database/skema';

    $files = glob($folder . '/*.php');

    $files = array_values(array_filter($files, function ($file) {

        return basename($file) !== 'config.php';
    }));

    foreach ($files as $fileSkema) {

        $skema = null;

        include $fileSkema;

        if (!empty($skema)) {

            if (!$connDb->query($skema)) {

                die("❌ Gagal menjalankan skema "
                    . basename($fileSkema)
                    . " : "
                    . $connDb->error);
            }
        }
    }

    echo "✅ Koneksi berhasil, database siap digunakan.";
}
