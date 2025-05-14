<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

if (isset($_POST['add']) && trim($_POST['task']) != '') {
    $_SESSION['todos'][] = ['text' => htmlspecialchars(trim($_POST['task'])), 'done' => false];
}

if (isset($_GET['done'])) {
    $i = (int)$_GET['done'];
    if (isset($_SESSION['todos'][$i])) {
        $_SESSION['todos'][$i]['done'] = true;
    }
}

if (isset($_GET['delete'])) {
    $i = (int)$_GET['delete'];
    if (isset($_SESSION['todos'][$i])) {
        array_splice($_SESSION['todos'], $i, 1);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Selamat datang, <?= $_SESSION['user'] ?></h2>
     <img src="upload/rio_.png" alt="Foto Profil">
    </div>

    <form method="post">
        <input type="text" name="task" placeholder="Teks to do" required>
        <input type="submit" name="add" value="Tambah">
    </form>

    <ul>
        <?php foreach ($_SESSION['todos'] as $i => $todo): ?>
            <li>
                <span class="<?= $todo['done'] ? 'done' : '' ?>"><?= $todo['text'] ?></span>
                <?php if (!$todo['done']): ?>
                    <a href="?done=<?= $i ?>">Selesai</a>
                <?php endif; ?>
                <a href="?delete=<?= $i ?>">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="logout.php" class="logout">Logout</a>
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