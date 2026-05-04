<?php

error_reporting(0);
ini_set('display_errors', 0);
if (isset($_POST['submit'])) {

    $host     = $_POST['host'];
    $dbname   = $_POST['name'];
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $port     = !empty($_POST['port']) ? $_POST['port'] : 3306;

    mysqli_report(MYSQLI_REPORT_OFF);

    $conn = new mysqli($host, $username, $password, $dbname, $port);

    if ($conn->connect_errno) {

        error_log($conn->connect_error);

        switch ($conn->connect_errno) {
            case 1045:
                $msg = '❌ Username atau password database salah.';
                break;
            case 1049:
                $msg = '❌ Database tidak ditemukan.';
                break;
            case 2002:
                $msg = '❌ Server database tidak aktif, host salah atau port salah.';
                break;
            default:
                $msg = '⚠️ Koneksi database gagal, periksa konfigurasi Anda.';
        }

        die($msg);
    } else {

        $file = $_SERVER['DOCUMENT_ROOT'] . '/database/config.php';

        $isiFile  = "<?php\n";
        $isiFile .= "\$host = '$host';\n";
        $isiFile .= "\$dbname = '$dbname';\n";
        $isiFile .= "\$username = '$username';\n";
        $isiFile .= "\$password = '$password';\n";
        $isiFile .= "\$port = $port;\n\n";

        if (file_put_contents($file, $isiFile)) {
            echo "✅ Koneksi berhasil & konfigurasi disimpan";
        } else {
            echo "⚠️ Koneksi berhasil, tapi gagal menulis file";
        }
    }
}