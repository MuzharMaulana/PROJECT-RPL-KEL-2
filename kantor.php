<?php
session_start();
include 'config.php';

// ID kategori Kantor (misalnya 2)
$kategoriId = 2;

// Ambil catatan dengan kategori Kantor
$query = "SELECT notes.*, categories.nama_kategori FROM notes 
          LEFT JOIN categories ON notes.kategori_id = categories.id
          WHERE notes.kategori_id = " . intval($kategoriId);

$notesResult = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Kantor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Catatan Kantor</h2>
        <div id="savedNotes">
            <?php if ($notesResult->num_rows > 0): ?>
                <div class="row">
                    <?php while ($note = $notesResult->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $note['judul']; ?></h5>
                                    <p class="card-text"><?php echo $note['catatan']; ?></p>
                                    <p><strong>Kategori:</strong> <?php echo $note['nama_kategori']; ?></p>
                                    <p><strong>Tanggal:</strong> <?php echo $note['tanggal']; ?></p>
                                    <a href="edit_note.php?id=<?php echo $note['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="hapus_note.php?id=<?php echo $note['id']; ?>" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Tidak ada catatan Kantor ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
