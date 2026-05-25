<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

try {
    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    if (empty($usernameInput) || empty($passwordInput)) {
        throw new Exception("Username dan password harus diisi.");
    }
    $checkRes = $conn->query("SELECT COUNT(*) AS total FROM user");
    $totalUsers = $checkRes ? (int)$checkRes->fetch_assoc()['total'] : 0;

    if ($totalUsers === 0) {
        $defaultUser = 'admin';
        $defaultPass = password_hash('admin', PASSWORD_DEFAULT);
        $defaultNama = 'Administrator';
        $defaultDept = 'IT';
        $defaultEmail = 'admin@example.com';
        $defaultPhone = '08123456789';
        $defaultAlamat = 'Jakarta, Indonesia';
        $defaultFoto = 'public/icon/Final.png';
        $defaultStatus = 1;

        $stmtSeed = $conn->prepare("
            INSERT INTO user 
            (username, password, department, nama, email, no_telp, alamat, foto, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        if ($stmtSeed) {
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
    }
    $stmtUser = $conn->prepare("
        SELECT id, username, password, department, nama, email, no_telp, alamat, foto, status 
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
        if (password_verify($passwordInput, $row['password']) || $passwordInput === $row['password']) {
            $_SESSION['user'] = [
                'id' => (int)$row['id'],
                'username' => $row['username'],
                'nama' => $row['nama'],
                'department' => $row['department'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
                'alamat' => $row['alamat'],
                'foto' => !empty($row['foto']) ? $row['foto'] : 'public/icon/Final.png'
            ];

            echo json_encode(["status" => "success"]);
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
