<?php
session_start(); // Mulai sesi
include 'config.php'; // Sertakan file konfigurasi untuk koneksi database

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika tidak, arahkan ke login
    exit();
}

// Cek apakah ID catatan diberikan
if (isset($_GET['id'])) {
    $note_id = intval($_GET['id']); // Ambil ID catatan dari parameter URL

    // Query untuk menghapus catatan
    $sql = "DELETE FROM notes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $note_id);

    if ($stmt->execute()) {
        // Jika penghapusan berhasil, arahkan kembali ke dashboard
        header("Location: dashboard.php?message=Catatan berhasil dihapus.");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID catatan tidak ditemukan.";
}

$conn->close();
?>