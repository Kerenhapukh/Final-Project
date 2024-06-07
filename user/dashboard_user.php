<?php 
include '../fungsi/koneksi.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$buku = query("SELECT * FROM buku limit 0, 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css?v=<?php echo time(); ?>">
</head>
<body>
    <h1>Perpustakaan</h1>
</header>
<nav>
    <ul>
        <li><a href="dashboard.php" class="active" >Dashboard</a></li>
        <li><a href="koleksi.php">Koleksi</a></li>
        <li><a href="peminjaman.php">Peminjaman</a></li>
        <li><a href="kontak.php">Kontak</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container">
    <div class="library">
    <h2>Selamat Datang di Perpustakaan</h2>
    <p>Menyediakan berbagai koleksi buku terbaru dan terbaik</p> 
    </div>
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
        <a class="see-more" href="koleksi.php">Lihat Semua</a>
        </div>
    </div>

</body>
</html>