<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $kategori_id = $_POST['kategori_id'];
    $catatan = $_POST['catatan'];

    // Menyimpan catatan ke database
    $sql = "INSERT INTO notes (judul, kategori_id, catatan, tanggal) VALUES ('$judul', $kategori_id, '$catatan', NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirect ke dashboard setelah berhasil
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
