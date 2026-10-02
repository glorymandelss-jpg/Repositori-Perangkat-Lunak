<?php
require 'includes/auth.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['user'] === ADMIN_USER && $_POST['pass'] === ADMIN_PASS) {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    }
    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login Admin</title><link rel="stylesheet" href="style.css"></head>
<body>
  <h1>Login Admin</h1>
  <?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>
  <form method="post">
    <input name="user" placeholder="Username" required>
    <input name="pass" type="password" placeholder="Password" required>
    <button>Masuk</button>
  </form>
  <p><a href="index.php">Kembali</a></p>
</body>
</html>
