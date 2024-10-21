<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Catatan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- Ikon Font Awesome -->    

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 220px; /* Sesuaikan lebar sidebar */
            background-color: #007bff; /* Warna biru sidebar */
            color: white;
            padding: 20px 15px; /* Sesuaikan padding sidebar */
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
            margin: 25px 0; /* Jarak antar item menu */
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: flex;
            align-items: center;
            font-size: 16px; /* Ukuran font dikurangi */
        }
        .sidebar ul li a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }
        .sidebar ul li a i {
            margin-right: 8px;
            font-size: 20px; /* Ukuran ikon dikurangi */
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: white;
            min-height: 100vh; /* Agar konten memenuhi layar */
        }
        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-group textarea {
            min-height: 150px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="add_note.php"><i class="fas fa-plus"></i> Tambah Catatan</a></li>
            </ul>
        </div>


        <div class="main-content">
            <h2>Tambah Catatan</h2>
            <form action="simpan_catatan.php" method="POST">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Catatan:</label>
                    <input type="text" id="judul" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori:</label>
                    <select id="kategori" name="kategori_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <?php // PHP code for populating categories ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Isi Catatan:</label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
