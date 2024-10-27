<?php
session_start();
include 'config.php';

// ID kategori Kuliah (misalnya 1)
$kategoriId = 1;

// Ambil catatan dengan kategori Kuliah
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
    <title>Catatan Kuliah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- Ikon Font Awesome -->

    <style>
        .sidebar {
            width: 250px;
            background-color: #0000ff;
            color: white;
            padding: 20px;
            height: 100vh;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 25px 0;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        .sidebar ul li a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }
        .sidebar ul li a i {
            margin-right: 8px;
            font-size: 20px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: white;
            min-height: 100vh;
        }
        .card {
            border-radius: 10px; /* Membuat card berbentuk persegi */
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li><a href="add_note.php"><i class="fas fa-plus"></i>Tambah Catatan</a></li>

            <!-- Dropdown untuk Kategori -->
            <li>
                <a href="#kategoriSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-list"></i> Kategori
                </a>
                <ul class="collapse list-unstyled" id="kategoriSubmenu">
                    <li><a href="kantor.php"><i class="fas fa-briefcase"></i> Kantor</a></li>
                    <li><a href="pribadi.php"><i class="fas fa-user"></i> Pribadi</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container mt-5">
            <h2>Catatan Kuliah</h2>
            <div id="savedNotes">
                <?php if ($notesResult && $notesResult->num_rows > 0): ?>
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
                    <div class="alert alert-warning" role="alert">
                        Tidak ada catatan ditemukan untuk kategori kuliah.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
