<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

try {

    if (!isset($_SESSION['user'])) {
        throw new Exception("Session login tidak ditemukan.");
    }

    $id = $_SESSION['user']['id'];

    $nama = trim($_POST['name'] ?? '');
    $telepon = trim($_POST['telepon'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if (
        empty($nama) ||
        empty($telepon) ||
        empty($username) ||
        empty($email)
    ) {
        throw new Exception("Semua field wajib diisi.");
    }

    $stmtOld = $conn->prepare("SELECT foto, password FROM user WHERE id = ?");
    $stmtOld->bind_param("i", $id);
    $stmtOld->execute();

    $resultOld = $stmtOld->get_result();

    if ($resultOld->num_rows === 0) {
        throw new Exception("User tidak ditemukan.");
    }

    $oldData = $resultOld->fetch_assoc();

    $fotoPath = $oldData['foto'];
    $hashedPassword = $oldData['password'];

    // Upload foto jika ada
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === 0) {

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/database/data/assets/profile/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $tmpFile = $_FILES['profile_img']['tmp_name'];

        $imageInfo = getimagesize($tmpFile);

        if (!$imageInfo) {
            throw new Exception("File bukan gambar valid.");
        }

        $mime = $imageInfo['mime'];

        switch ($mime) {

            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($tmpFile);
                $ext = 'jpg';
                break;

            case 'image/png':
                $sourceImage = imagecreatefrompng($tmpFile);
                $ext = 'png';
                break;

            case 'image/webp':
                $sourceImage = imagecreatefromwebp($tmpFile);
                $ext = 'webp';
                break;

            default:
                throw new Exception("Format gambar tidak didukung.");
        }

        $width = imagesx($sourceImage);
        $height = imagesy($sourceImage);

        // Ambil sisi terkecil untuk crop kotak
        $squareSize = min($width, $height);

        // Posisi crop tengah
        $srcX = ($width - $squareSize) / 2;
        $srcY = ($height - $squareSize) / 2;

        // Ukuran hasil akhir
        $finalSize = 300;

        $finalImage = imagecreatetruecolor($finalSize, $finalSize);

        // Transparansi PNG/WebP
        imagealphablending($finalImage, false);
        imagesavealpha($finalImage, true);

        // Crop + resize
        imagecopyresampled(
            $finalImage,
            $sourceImage,
            0,
            0,
            $srcX,
            $srcY,
            $finalSize,
            $finalSize,
            $squareSize,
            $squareSize
        );

        $fileName = 'profile_' . time() . '.' . $ext;

        $targetFile = $uploadDir . $fileName;

        // Simpan gambar
        switch ($mime) {

            case 'image/jpeg':
                imagejpeg($finalImage, $targetFile, 90);
                break;

            case 'image/png':
                imagepng($finalImage, $targetFile);
                break;

            case 'image/webp':
                imagewebp($finalImage, $targetFile, 90);
                break;
        }

        imagedestroy($sourceImage);
        imagedestroy($finalImage);

        $fotoPath = '/database/data/assets/profile/' . $fileName;
    }

    if (!empty($password)) {

        if ($password !== $confirm_password) {
            throw new Exception("Konfirmasi password tidak cocok.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    $checkUsername = $conn->prepare("SELECT id FROM user WHERE username = ? AND id != ?");
    $checkUsername->bind_param("si", $username, $id);
    $checkUsername->execute();

    if ($checkUsername->get_result()->num_rows > 0) {
        throw new Exception("Username sudah digunakan.");
    }

    $checkEmail = $conn->prepare("SELECT id FROM user WHERE email = ? AND id != ?");
    $checkEmail->bind_param("si", $email, $id);
    $checkEmail->execute();

    if ($checkEmail->get_result()->num_rows > 0) {
        throw new Exception("Email sudah digunakan.");
    }

    $stmt = $conn->prepare("
        UPDATE user 
        SET 
            nama = ?,
            no_telp = ?,
            username = ?,
            email = ?,
            password = ?,
            foto = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "ssssssi",
        $nama,
        $telepon,
        $username,
        $email,
        $hashedPassword,
        $fotoPath,
        $id
    );

    if (!$stmt->execute()) {
        throw new Exception("Gagal update akun.");
    }

    // Update session
    $_SESSION['user']['nama'] = $nama;
    $_SESSION['user']['telepon'] = $telepon;
    $_SESSION['user']['username'] = $username;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['foto'] = $fotoPath;

    echo json_encode([
        'success' => true,
        'message' => 'Profil berhasil diperbarui.'
    ]);
} catch (Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
