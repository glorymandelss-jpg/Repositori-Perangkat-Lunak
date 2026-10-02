<?php
require 'includes/auth.php';
wajib_login();
require 'includes/db.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $db->prepare("SELECT nama_file FROM aplikasi WHERE id=?");
$stmt->execute([$id]);
$a = $stmt->fetch(PDO::FETCH_ASSOC);
if ($a) {
    $path = __DIR__ . '/files/' . basename($a['nama_file']);
    if (is_file($path)) unlink($path);
    $db->prepare("DELETE FROM aplikasi WHERE id=?")->execute([$id]);
}
header('Location: index.php');
