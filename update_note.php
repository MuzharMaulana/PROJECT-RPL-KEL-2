<?php
// Sertakan file konfigurasi untuk koneksi database
include 'config.php';

// Periksa apakah request yang diterima adalah metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form yang dikirim melalui POST
    $id = $_POST['id'];               // ID catatan yang akan diperbarui
    $judul = $_POST['judul'];         // Judul catatan yang diperbarui
    $catatan = $_POST['catatan'];     // Isi catatan yang diperbarui
    $kategori_id = $_POST['kategori_id']; // ID kategori yang diperbarui

    // Query SQL untuk memperbarui catatan berdasarkan ID
    $sql = "UPDATE notes SET judul = ?, catatan = ?, kategori_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql); // Siapkan query menggunakan prepared statement
    $stmt->bind_param('ssii', $judul, $catatan, $kategori_id, $id); // Ikat parameter ke statement (s = string, i = integer)

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika query berhasil, redirect ke halaman dashboard
        header("Location: dashboard.php");
        exit(); // Hentikan eksekusi script setelah redirect
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Gagal memperbarui catatan.";
    }
}
?>
