<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $catatan = $_POST['catatan'];
    $kategori_id = $_POST['kategori_id'];

    // Query untuk memperbarui catatan
    $sql = "UPDATE notes SET judul = ?, catatan = ?, kategori_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssii', $judul, $catatan, $kategori_id, $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, kembali ke halaman index
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Gagal memperbarui catatan.";
    }
}
?>
