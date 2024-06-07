<?php 
include '../fungsi/koneksi.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$buku = query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css?v=<?php echo time(); ?>">
</head>
<body>
<nav>
    <ul>
        <li><a href="dashboard.php" class="active" >Dashboard</a></li>
        <li><a href="buku.php">Manajemen Buku</a></li>
        <li><a href="pengguna.php">Manajemen User</a></li>
        <li><a href="peminjaman.php">Manajemen Peminjaman</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container">
        
        <div class="buku-container">
        <?php foreach ( $buku as $row_buku): ?>
        <div class="responsive">
            <div class="gallery">
                    <img src="../img/<?= $row_buku["gambar"]; ?>">
                <div class="desc"><?= $row_buku["judul"]; ?></div>
                <div class="desc"><?= $row_buku["penerbit"]; ?></div>
                <div class="desc"><?= $row_buku["tahun_terbit"]; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
        </div>
</body>
</html>