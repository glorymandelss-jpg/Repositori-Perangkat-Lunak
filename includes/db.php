<?php
// Koneksi ke SQLite (file database dibuat otomatis)
$db = new PDO('sqlite:' . __DIR__ . '/../database/repositori.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS aplikasi (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nama TEXT NOT NULL,
  versi TEXT,
  kategori TEXT,
  deskripsi TEXT,
  nama_file TEXT
)");
