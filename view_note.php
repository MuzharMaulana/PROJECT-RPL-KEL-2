<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Ambil ID catatan dari URL
$noteId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil detail catatan dari database
$query = "SELECT notes.*, categories.nama_kategori FROM notes 
          LEFT JOIN categories ON notes.kategori_id = categories.id 
          WHERE notes.id = $noteId";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $note = $result->fetch_assoc();
} else {
    echo "Catatan tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Catatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang Bootstrap */
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .note-content {
            padding: 20px;
            background-color: #f8f9fa;
            border-left: 5px solid #007bff;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        .note-content h3 {
            color: #007bff;
        }
        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Judul catatan -->
        <h2 class="border-bottom pb-2"><?php echo $note['judul']; ?></h2>
        
        <!-- Kategori catatan -->
        <p><strong>Kategori:</strong> <?php echo $note['nama_kategori']; ?></p>
        
        <!-- Tanggal catatan -->
        <p><strong>Tanggal:</strong> <?php echo $note['tanggal']; ?></p>

        <!-- Konten catatan -->
        <div class="note-content mt-4">
            <h3>Isi Catatan</h3>
            <p><?php echo nl2br($note['catatan']); ?></p>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <a href="dashboard.php" class="btn btn-primary btn-back">Kembali ke Dashboard</a>
    </div>

    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

