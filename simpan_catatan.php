<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $kategori_id = $_POST['kategori_id'];
    $catatan = $_POST['catatan'];

    $sql = "INSERT INTO notes (judul, kategori_id, catatan) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sis', $judul, $kategori_id, $catatan);

    if ($stmt->execute()) {
        header('Location: dashboard.php'); // Redirect setelah berhasil
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>
