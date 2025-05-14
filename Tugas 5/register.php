<?php
session_start();
include 'db.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert->bind_param("ss", $username, $password);
        if ($insert->execute()) {
            $success = "Pendaftaran berhasil. Silakan login.";
        } else {
            $error = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h2> Daftar Yuk </h2>
           <img src="upload/rio_.png" alt="Foto Profil">
        </div>
        <form method="post">
            <input type="text" name="username" placeholder="Username baru" required>
            <input type="password" name="password" placeholder="Password baru" required>
            <input type="submit" name="register" value="Daftar">
            <?php
            if (isset($error))
                echo "<p class='error'>$error</p>";
            if (isset($success))
                echo "<p class='success'>$success</p>";
            ?>
        </form>
        <p><a href="index.php">Sudah punya akun? Login di sini</a></p>
    </div>
</body>
<script>
    // Tambahkan bintang ke body
    for (let i = 0; i < 100; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.top = `${Math.random() * 100}%`;
        star.style.left = `${Math.random() * 100}%`;
        star.style.animationDuration = `${Math.random() * 3 + 2}s`;
        document.body.appendChild(star);
    }
</script>

</html>