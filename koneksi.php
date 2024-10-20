<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "buku_catatan";

$koneksi = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    //echo "Database tidak terkoneksi: " . $koneksi->connect_error;
} 
?>
