<?php
require 'includes/auth.php';
wajib_login();
require 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_file = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . '/files/' . $nama_file);
    $stmt = $db->prepare("INSERT INTO aplikasi (nama, versi, kategori, deskripsi, nama_file) VALUES (?,?,?,?,?)");
    $stmt->execute([$_POST['nama'], $_POST['versi'], $_POST['kategori'], $_POST['deskripsi'], $nama_file]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Tambah Aplikasi</title><link rel="stylesheet" href="style.css"></head>
<body>
  <h1>Tambah Aplikasi</h1>
  <form method="post" enctype="multipart/form-data">
    <input name="nama" placeholder="Nama (mis. XAMPP)" required>
    <input name="versi" placeholder="Versi">
    <input name="kategori" placeholder="Kategori (mis. Web Server, Compiler)">
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
    <input type="file" name="file" required>
    <button>Simpan</button>
  </form>
  <p><a href="index.php">Kembali</a></p>
</body>
</html>
