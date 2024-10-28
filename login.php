<?php
session_start(); // Mulai sesi
// Sertakan file konfigurasi
include 'config.php';

$message = ""; // Variabel untuk menyimpan pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data pengguna dari database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Simpan id pengguna dalam sesi
        header("Location: dashboard.php"); // Arahkan ke dashboard
        exit();
    } else {
        $message = "Username atau password salah"; // Simpan pesan kesalahan
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* CSS untuk halaman login */
        body {
            font-family: 'Arial', sans-serif;
            background: url('notebook.jpg')no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan sedikit transparansi */
            background-image: radial-gradient(circle, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
            background-size: 15px 15px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 20px;
            color: #666;
        }

        p a {
            color: #007bff;
            text-decoration: none;
            transition: text-decoration 0.3s;
        }

        p a:hover {
            text-decoration: underline;
        }

        .alert-message {
            color: white;
            margin-top: 10px;
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php if ($message): ?>
        <div class="alert-message"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Buat akun disini</a></p>
    </div>
</body>
</html>
