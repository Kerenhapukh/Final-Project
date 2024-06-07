<?php 
include '../fungsi/koneksi.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}
$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE username = '$username'";
$result = mysqli_query($db, $query);

$buku = query("SELECT * FROM buku");
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
        <li><a href="dashboard_user.php">Dashboard</a></li>
        <li><a href="buku.php" class="active" >Koleksi</a></li>
        <li><a href="peminjaman.php">Peminjaman</a></li>
        <li><a href="kontak.php">Kontak</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container">
<div class="main-body">
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Selamat Datang di Website Perpus</span>
      </div>
      <div class="tableFix">
    <table id="table">
        <tr>
            <th>ID buku</th>
            <th>Nama Buku</th>
            <th>Penulis</th>
            <th>Tahun Perilisan</th>
            <th>Genre</th>
            <th>Status</th>
        </tr>
        <?php foreach ( $buku as $book_row ): ?>
        <tr>
            <td><?= $book_row["id_buku"]; ?></td>
            <td><?= $book_row["judul"]; ?></td>
            <td><?= $book_row["penerbit"]; ?></td>
            <td><?= $book_row["tahun_terbit"]; ?></td>
            <td><?= $book_row["gambar"]; ?></td>
            <td><?= $book_row["status"]; ?></td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
  </div>


</body>
</html>