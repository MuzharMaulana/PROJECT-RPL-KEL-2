<?php
$servername = "localhost";
$username = "root";  // Biasanya "root" untuk local server
$password = "";      // Kosongkan jika tidak ada password (misal di XAMPP)
$dbname = "catatan_db";  // Nama database yang sudah kita buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
