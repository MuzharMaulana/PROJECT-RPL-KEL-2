<?php
session_start(); // Mulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Jika sudah login, tampilkan dashboard
?>

<?php
include 'config.php';

// Ambil semua kategori dari database untuk dropdown
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

<<<<<<< HEAD
// Cek apakah ada kategori atau judul yang dicari
$selectedCategory = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : '';
$searchTitle = isset($_GET['judul']) ? $_GET['judul'] : '';

// Query dasar untuk mengambil catatan
$query = "SELECT notes.*, categories.nama_kategori FROM notes 
          LEFT JOIN categories ON notes.kategori_id = categories.id";

// Tambahkan filter kategori jika ada yang dipilih
if ($selectedCategory) {
    $query .= " WHERE notes.kategori_id = " . intval($selectedCategory);
}

// Tambahkan filter judul jika ada pencarian judul
if (!empty($searchTitle)) {
    // Jika kategori juga dipilih, tambahkan kondisi dengan AND
    if ($selectedCategory) {
        $query .= " AND notes.judul LIKE '%" . $conn->real_escape_string($searchTitle) . "%'";
    } else {
        $query .= " WHERE notes.judul LIKE '%" . $conn->real_escape_string($searchTitle) . "%'";
    }
}

=======
// Ambil nilai pencarian dari form jika ada
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil catatan, tambahkan filter judul jika ada
$query = "SELECT notes.*, categories.nama_kategori 
          FROM notes 
          LEFT JOIN categories ON notes.kategori_id = categories.id 
          WHERE 1=1";

if ($searchKeyword) {
    // Tambahkan kondisi untuk pencariann berdasarkan judul
    $query .= " AND notes.judul LIKE '%" . $conn->real_escape_string($searchKeyword) . "%'";
}

$query .= " ORDER BY tanggal DESC";
>>>>>>> 00eb7a7394084679b16ad8fec62c92ed9165032d
$notesResult = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Catatan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sidebar.css">
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
<<<<<<< HEAD
            padding: 16px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card h3 {
            margin: 0;
        }

        .card .card-footer {
            margin-top: 10px;
        }

        .button {
            padding: 5px 10px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 3px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
=======
            display: block;
            transition: background-color 0.3s;
        }
        .sidebar ul li a:hover {
            background-color: #4d4957;
        }
        .content {
            margin-left: 250px; /* Space for the sidebar */
            padding: 30px;
        }
        .card-category {
            border: 1px solid #007bff;
            border-radius: 10px;
            transition: transform 0.2s;
            margin: 10px 0;
        }
        .card-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        .btn-custom {
            border-radius: 25px;
        }
        .note-card {
            margin-top: 20px;
>>>>>>> 00eb7a7394084679b16ad8fec62c92ed9165032d
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="add_note.php">Tambah Catatan</a></li>
                <li><a href="login.php">Keluar</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Dashboard Catatan</h2>
            <!-- Form Pencarian -->
            <form method="GET" action="dashboard.php">
                <div class="form-group">
                    <label for="kategori">Pilih Kategori:</label>
                    <select id="kategori" name="kategori_id" class="form-control">
                        <option value="">Semua Kategori</option>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $selectedCategory) ? 'selected' : ''; ?>>
                                <?php echo $row['nama_kategori']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="judul">Cari Judul Catatan:</label>
                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul catatan" value="<?php echo htmlspecialchars($searchTitle); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <h4 class="mt-4">Catatan Tersimpan:</h4>
            <div id="savedNotes">
                <?php if ($notesResult->num_rows > 0): ?>
                    <div class="notes-container">
                        <?php while ($note = $notesResult->fetch_assoc()): ?>
                            <div class="card">
                                <!-- Tampilkan hanya judul, kategori, dan tanggal -->
                                <h3><a href="view_note.php?id=<?php echo $note['id']; ?>"><?php echo $note['judul']; ?></a></h3>
                                <p><strong>Kategori:</strong> <?php echo $note['nama_kategori']; ?></p>
                                <p><strong>Tanggal:</strong> <?php echo $note['tanggal']; ?></p>
                                <div class="card-footer">
                                    <a href="edit_note.php?id=<?php echo $note['id']; ?>" class="button">Edit</a>
                                    <a href="hapus_note.php?id=<?php echo $note['id']; ?>" class="button" style="background-color: red;">Hapus</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p>Tidak ada catatan ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</body>
</html>
=======

    <!-- Main Content -->
    <div class="content float-right" style="width: calc(100% - 250px);">
        <h2 class="mt-4">Selamat Datang di Dashboard Catatan</h2>
        <p class="lead">Kelola catatanmu dengan mudah!</p>

        <!-- Form Pencarian -->
        <form method="GET" action="dashboard.php" class="search-box">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari catatan berdasarkan judul..." value="<?php echo htmlspecialchars($searchKeyword); ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-category">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kuliah</h5>
                        <p class="card-text">Lihat semua catatan kuliah Anda.</p>
                        <a href="kuliah.php" class="btn btn-primary btn-custom">Lihat Kategori</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-category">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kantor</h5>
                        <p class="card-text">Lihat semua catatan kantor Anda.</p>
                        <a href="kantor.php" class="btn btn-primary btn-custom">Lihat Kategori</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-category">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pribadi</h5>
                        <p class="card-text">Lihat semua catatan pribadi Anda.</p>
                        <a href="pribadi.php" class="btn btn-primary btn-custom">Lihat Kategori</a>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-4">Catatan Terakhir:</h4>
        <div id="savedNotes">
            <?php if ($notesResult && $notesResult->num_rows > 0): ?>
                <?php while ($note = $notesResult->fetch_assoc()): ?>
                    <div class="card note-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="view_note.php?id=<?php echo $note['id']; ?>"><?php echo $note['judul']; ?></a>
                            </h5>
                            <p><strong>Kategori:</strong> <?php echo $note['nama_kategori']; ?></p>
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
                    Tidak ada catatan ditemukan.
                </div>
            <?php endif; ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
>>>>>>> 00eb7a7394084679b16ad8fec62c92ed9165032d
