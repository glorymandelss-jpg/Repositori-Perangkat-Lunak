<?php
require 'includes/auth.php';
require 'includes/db.php';
$cari = $_GET['cari'] ?? '';
$stmt = $db->prepare("SELECT * FROM aplikasi WHERE nama LIKE ? ORDER BY nama");
$stmt->execute(["%$cari%"]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$admin = !empty($_SESSION['admin']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Repositori Perangkat Lunak</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Repositori Perangkat Lunak</h1>
  <form method="get">
    <input name="cari" placeholder="Cari aplikasi..." value="<?= htmlspecialchars($cari) ?>">
    <button>Cari</button>
  </form>
  <table>
    <tr><th>Nama</th><th>Versi</th><th>Kategori</th><th>Unduh</th><?php if ($admin): ?><th>Aksi</th><?php endif; ?></tr>
    <?php foreach ($data as $a): ?>
    <tr>
      <td><?= htmlspecialchars($a['nama']) ?></td>
      <td><?= htmlspecialchars($a['versi']) ?></td>
      <td><?= htmlspecialchars($a['kategori']) ?></td>
      <td><a href="files/<?= rawurlencode($a['nama_file']) ?>">Unduh</a></td>
      <?php if ($admin): ?>
      <td>
        <a href="edit.php?id=<?= $a['id'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $a['id'] ?>" onclick="return confirm('Hapus aplikasi ini?')">Hapus</a>
      </td>
      <?php endif; ?>
    </tr>
    <?php endforeach; ?>
  </table>
  <p>
    <?php if ($admin): ?>
      <a href="tambah.php">+ Tambah aplikasi</a> | <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Login admin</a>
    <?php endif; ?>
  </p>
</body>
</html>
