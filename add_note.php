<?php
include 'config.php';

// Ambil semua kategori dari database untuk dropdown
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Catatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 15px;
            height: 100vh;
        }
        .sidebar h2 {
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 10px 0;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: block;
            background-color: #444;
            border-radius: 5px;
        }
        .sidebar ul li a:hover {
            background-color: #555;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            padding: 10px 15px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="add_note.php">Tambah Catatan</a></li>
                <!-- Tambahkan link lain sesuai kebutuhan -->
            </ul>
        </div>
        <div class="main-content">
            <h2>Tambah Catatan</h2>
            <form action="simpan_catatan.php" method="POST">
                <div class="form-group">
                    <label for="judul">Judul Catatan:</label>
                    <input type="text" id="judul" name="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select id="kategori" name="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_kategori']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan">Isi Catatan:</label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
