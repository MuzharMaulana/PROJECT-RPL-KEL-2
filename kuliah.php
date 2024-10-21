<?php
session_start(); // Mulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Tampilkan catatan untuk kategori kuliah
include 'config.php'; // Pastikan ini termasuk sebelum query database

// Ambil catatan untuk kategori kuliah
$sql = "SELECT notes.*, categories.nama_kategori 
        FROM notes 
        LEFT JOIN categories ON notes.kategori_id = categories.id 
        WHERE categories.nama_kategori = 'kuliah' 
        ORDER BY tanggal DESC";

$notesResult = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Kuliah</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Catatan Kuliah</h2>
    <div id="savedNotes">
        <?php if ($notesResult && $notesResult->num_rows > 0): ?>
            <?php while ($note = $notesResult->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $note['judul']; ?></h5>
                        <p><strong>Tanggal:</strong> <?php echo $note['tanggal']; ?></p>
                        <div class="d-flex">
                             <a href="edit_note.php?id=<?php echo $note['id']; ?>" class="btn btn-warning mr-2">Edit</a>
                             <a href="hapus_note.php?id=<?php echo $note['id']; ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Tidak ada catatan ditemukan untuk kategori kuliah.
            </div>
        <?php endif; ?>
    </div>
    <a href="dashboard.php" class="btn btn-primary mt-4">Kembali ke Dashboard</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
