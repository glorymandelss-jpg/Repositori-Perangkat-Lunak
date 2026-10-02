<?php
require 'includes/auth.php';
wajib_login();
require 'includes/db.php';
$id = (int)($_GET['id'] ?? 0);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("UPDATE aplikasi SET nama=?, versi=?, kategori=?, deskripsi=? WHERE id=?");
    $stmt->execute([$_POST['nama'], $_POST['versi'], $_POST['kategori'], $_POST['deskripsi'], $id]);
    header('Location: index.php');
    exit;
}
$stmt = $db->prepare("SELECT * FROM aplikasi WHERE id=?");
$stmt->execute([$id]);
$a = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$a) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Edit Aplikasi</title><link rel="stylesheet" href="style.css"></head>
<body>
  <h1>Edit Aplikasi</h1>
  <form method="post">
    <input name="nama" value="<?= htmlspecialchars($a['nama']) ?>" required>
    <input name="versi" value="<?= htmlspecialchars($a['versi']) ?>">
    <input name="kategori" value="<?= htmlspecialchars($a['kategori']) ?>">
    <textarea name="deskripsi"><?= htmlspecialchars($a['deskripsi']) ?></textarea>
    <button>Simpan perubahan</button>
  </form>
  <p><a href="index.php">Kembali</a></p>
</body>
</html>
