<?php
session_start();
include 'db.php';

if (isset($_SESSION['user'])) {
    header("Location: todo.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $username;
            $_SESSION['todos'] = [];
            header("Location: todo.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "User tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h2>ALLO🦅</h2>
        <img src="upload/rio_.png" alt="Foto Profil">
    </div>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="login" value="Login">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </form>
</div>
<div class="rocket-background"></div>
<script>
// Tambahkan bintang
for (let i = 0; i < 100; i++) {
    const star = document.createElement('div');
    star.className = 'star';
    star.style.top = `${Math.random() * 100}%`;
    star.style.left = `${Math.random() * 100}%`;
    star.style.animationDuration = `${Math.random() * 3 + 2}s`;
    document.body.appendChild(star);
}
</script>
<h1 letter-animation="breath">
  <span style="--index: 0;">H</span>
  <span style="--index: 1;">E</span>
  <span style="--index: 2;">L</span>
  <span style="--index: 3;">L</span>
  <span style="--index: 4;">O</span>
</h1>

<section>
  <div>
    <span>Min</span>
    <span>Max</span>
    <input type="range" min="0" max="100" value="50">
  </div>
</section>


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

</body>
</html>

