<?php
include 'config.php'; // Mengimpor file konfigurasi untuk menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Mengecek apakah permintaan HTTP adalah POST
    $judul = $_POST['judul']; // Mengambil nilai judul dari input form
    $kategori_id = $_POST['kategori_id']; // Mengambil nilai kategori_id dari input form
    $catatan = $_POST['catatan']; // Mengambil nilai catatan dari input form

    // Menyimpan catatan ke database
    $sql = "INSERT INTO notes (judul, kategori_id, catatan, tanggal) VALUES ('$judul', $kategori_id, '$catatan', NOW())";
    // Membuat query SQL untuk menyimpan catatan baru ke dalam tabel notes

    if ($conn->query($sql) === TRUE) { // Mengeksekusi query dan memeriksa apakah berhasil
        header("Location: dashboard.php"); // Redirect ke halaman dashboard jika berhasil
        exit; // Menghentikan eksekusi script setelah redirect
    } else {
        // Jika ada kesalahan saat eksekusi query, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }
}

$conn->close(); // Menutup koneksi database
?>
