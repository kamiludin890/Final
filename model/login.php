<?php
session_start();

header('Content-Type: application/json');

try {

    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    if (empty($usernameInput) || empty($passwordInput)) {
        throw new Exception("Username dan password harus diisi.");
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';
    if (!isset($conn) || $conn->connect_error) {
        if ($usernameInput === 'admin' && $passwordInput === 'admin') {

            $_SESSION['user'] = [
                'id' => 0,
                'username' => 'admin',
                'nama' => 'Administrator Offline',
                'department' => 'IT',
                'email' => 'offline@localhost',
                'no_telp' => '-',
                'alamat' => '-',
                'foto' => 'public/icon/Final.png'
            ];

            echo json_encode([
                "status" => "success",
                "mode" => "offline"
            ]);
            exit;
        }

        throw new Exception("Database gagal koneksi.");
    }
    $checkRes = $conn->query("SELECT COUNT(*) AS total FROM user");
    $totalUsers = $checkRes ? (int)$checkRes->fetch_assoc()['total'] : 0;

    if ($totalUsers === 0) {

        $defaultUser = 'admin';
        $defaultPass = password_hash('admin', PASSWORD_DEFAULT);

        $stmtSeed = $conn->prepare("
            INSERT INTO user 
            (username, password, department, nama, email, no_telp, alamat, foto, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $defaultDept = 'IT';
        $defaultNama = 'Administrator';
        $defaultEmail = 'admin@it.com';
        $defaultPhone = '-';
        $defaultAlamat = 'Jakarta, Indonesia';
        $defaultFoto = 'public/icon/Final.png';
        $defaultStatus = 1;

        $stmtSeed->bind_param(
            "ssssssssi",
            $defaultUser,
            $defaultPass,
            $defaultDept,
            $defaultNama,
            $defaultEmail,
            $defaultPhone,
            $defaultAlamat,
            $defaultFoto,
            $defaultStatus
        );

        $stmtSeed->execute();
    }

    $stmtUser = $conn->prepare("
        SELECT id, username, password, department, nama, email, no_telp, alamat, foto, akses, status 
        FROM user 
        WHERE username = ? AND status = 1
        LIMIT 1
    ");

    if (!$stmtUser) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    $stmtUser->bind_param("s", $usernameInput);
    $stmtUser->execute();

    $result = $stmtUser->get_result();

    if ($row = $result->fetch_assoc()) {

        if (
            password_verify($passwordInput, $row['password']) ||
            $passwordInput === $row['password']
        ) {

            $aksesRaw = $row['akses'] ? json_decode($row['akses'], true) : null;

            $_SESSION['user'] = [
                'id' => (int)$row['id'],
                'username' => $row['username'],
                'nama' => $row['nama'],
                'department' => $row['department'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
                'alamat' => $row['alamat'],
                'foto' => !empty($row['foto'])
                    ? $row['foto']
                    : 'public/icon/Final.png',
                'akses' => $aksesRaw  // null = semua akses (backward compatible)
            ];

            echo json_encode([
                "status" => "success",
                "mode" => "online"
            ]);

            exit;
        }
    }

    throw new Exception("Username atau password salah.");
} catch (Exception $e) {

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
