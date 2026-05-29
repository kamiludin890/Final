<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

try {
    if (!isset($_SESSION['user'])) {
        throw new Exception("Session tidak ditemukan. Silakan login ulang.");
    }

    if (!$conn) {
        throw new Exception("Koneksi database gagal.");
    }

    $action = $_POST['action'] ?? $_GET['action'] ?? '';
    if ($action === 'list') {
        $search = trim($_POST['search'] ?? '');
        $sql = "SELECT id, username, nama, department, email, no_telp, akses, status FROM user";
        if ($search !== '') {
            $sql .= " WHERE username LIKE ? OR nama LIKE ? OR department LIKE ?";
            $stmt = $conn->prepare($sql);
            $like = "%$search%";
            $stmt->bind_param("sss", $like, $like, $like);
        } else {
            $stmt = $conn->prepare($sql);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $row['akses'] = $row['akses'] ? json_decode($row['akses'], true) : [];
            $users[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $users]);
        exit;
    }
    if ($action === 'get') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        if ($id <= 0) throw new Exception("ID tidak valid.");

        $stmt = $conn->prepare("SELECT id, username, nama, department, email, no_telp, akses, status FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        if (!$row) throw new Exception("User tidak ditemukan.");

        $row['akses'] = $row['akses'] ? json_decode($row['akses'], true) : [];
        echo json_encode(['success' => true, 'data' => $row]);
        exit;
    }
    if ($action === 'create') {
        $username   = trim($_POST['username'] ?? '');
        $nama       = trim($_POST['nama'] ?? '');
        $department = trim($_POST['department'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $no_telp    = trim($_POST['no_telp'] ?? '');
        $password   = trim($_POST['password'] ?? '');
        $status     = (int)($_POST['status'] ?? 1);
        $akses_raw  = $_POST['akses'] ?? [];

        if (empty($username)) throw new Exception("Username wajib diisi.");
        if (empty($nama))     throw new Exception("Nama wajib diisi.");
        if (empty($password)) throw new Exception("Password wajib diisi untuk akun baru.");
        if (strlen($password) < 4) throw new Exception("Password minimal 4 karakter.");

        // Cek username unik
        $chk = $conn->prepare("SELECT id FROM user WHERE username = ?");
        $chk->bind_param("s", $username);
        $chk->execute();
        if ($chk->get_result()->num_rows > 0) throw new Exception("Username sudah digunakan.");

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        $akses_json = json_encode(array_values($akses_raw));
        $foto       = 'public/icon/Final.png';

        $stmt = $conn->prepare("
            INSERT INTO user (username, password, department, nama, email, no_telp, foto, akses, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssssssssi",
            $username, $hashedPass, $department, $nama, $email, $no_telp, $foto, $akses_json, $status
        );

        if (!$stmt->execute()) throw new Exception("Gagal menyimpan akun.");

        echo json_encode(['success' => true, 'message' => 'Akun berhasil dibuat.']);
        exit;
    }
    if ($action === 'update') {
        $id         = (int)($_POST['id'] ?? 0);
        $username   = trim($_POST['username'] ?? '');
        $nama       = trim($_POST['nama'] ?? '');
        $department = trim($_POST['department'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $no_telp    = trim($_POST['no_telp'] ?? '');
        $password   = trim($_POST['password'] ?? '');
        $status     = (int)($_POST['status'] ?? 1);
        $akses_raw  = $_POST['akses'] ?? [];

        if ($id <= 0)         throw new Exception("ID tidak valid.");
        if (empty($username)) throw new Exception("Username wajib diisi.");
        if (empty($nama))     throw new Exception("Nama wajib diisi.");

        // Cek username unik (exclude self)
        $chk = $conn->prepare("SELECT id FROM user WHERE username = ? AND id != ?");
        $chk->bind_param("si", $username, $id);
        $chk->execute();
        if ($chk->get_result()->num_rows > 0) throw new Exception("Username sudah digunakan akun lain.");

        $akses_json = json_encode(array_values($akses_raw));

        if (!empty($password)) {
            if (strlen($password) < 4) throw new Exception("Password minimal 4 karakter.");
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("
                UPDATE user SET username=?, nama=?, department=?, email=?, no_telp=?, password=?, akses=?, status=?
                WHERE id=?
            ");
            $stmt->bind_param("sssssssii", $username, $nama, $department, $email, $no_telp, $hashedPass, $akses_json, $status, $id);
        } else {
            $stmt = $conn->prepare("
                UPDATE user SET username=?, nama=?, department=?, email=?, no_telp=?, akses=?, status=?
                WHERE id=?
            ");
            $stmt->bind_param("ssssssii", $username, $nama, $department, $email, $no_telp, $akses_json, $status, $id);
        }

        if (!$stmt->execute()) throw new Exception("Gagal mengupdate akun.");
        if ((int)$_SESSION['user']['id'] === $id) {
            $_SESSION['user']['akses'] = $akses_raw;
        }

        echo json_encode(['success' => true, 'message' => 'Akun berhasil diperbarui.']);
        exit;
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) throw new Exception("ID tidak valid.");
        if ((int)$_SESSION['user']['id'] === $id) {
            throw new Exception("Tidak bisa menghapus akun yang sedang aktif.");
        }

        $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) throw new Exception("Gagal menghapus akun.");

        echo json_encode(['success' => true, 'message' => 'Akun berhasil dihapus.']);
        exit;
    }

    throw new Exception("Aksi tidak dikenali.");

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
