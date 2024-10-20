<?php
include 'config.php';

if (isset($_GET['id'])) {
    // Ambil id dari URL
    $id = $_GET['id'];

    // Ambil catatan dari database berdasarkan id
    $sql = "SELECT * FROM notes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah catatan ditemukan
    if ($result->num_rows == 1) {
        $note = $result->fetch_assoc();
    } else {
        die("Catatan tidak ditemukan.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Edit Catatan</h2>
    
    <form action="update_note.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $note['id']; ?>">

        <!-- Judul Catatan -->
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" value="<?php echo $note['judul']; ?>" required placeholder="Judul" class="form-control">
        </div>

        <!-- Catatan -->
        <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea id="catatan" name="catatan" rows="5" required placeholder="Tulis catatan di sini..." class="form-control"><?php echo $note['catatan']; ?></textarea>
        </div>

        <!-- Kategori -->
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori_id" class="form-control">
                <option value="1" <?php echo $note['kategori_id'] == 1 ? 'selected' : ''; ?>>Kuliah</option>
                <option value="2" <?php echo $note['kategori_id'] == 2 ? 'selected' : ''; ?>>Kantor</option>
                <option value="3" <?php echo $note['kategori_id'] == 3 ? 'selected' : ''; ?>>Pribadi</option>
                <option value="4" <?php echo $note['kategori_id'] == 4 ? 'selected' : ''; ?>>Lainnya</option>
            </select>
        </div>

        <!-- Tombol Simpan Catatan -->
        <button type="submit" class="btn btn-primary btn-block">Simpan Catatan</button>
    </form>
</div>

<!-- Bootstrap JS dan Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
