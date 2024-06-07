<?php 
include '../fungsi/koneksi.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE username = '$username'";
$result = mysqli_query($db, $query);

$peminjaman = query("SELECT * FROM peminjaman");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Peminjaman</title>
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css?v=<?php echo time(); ?>">
</head>
<body>
<nav>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="Buku.php">Manajemen Buku</a></li>
        <li><a href="pengguna.php">Manajemen User</a></li>
        <li><a href="peminjaman.php" class="active">Manajemen Peminjaman</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container">
<div class="library">
    <h2>Manajemen Peminjaman</h2>
    </div>
        
<div class="tableFix">
    <table id="table">
        <tr>
            <th>ID buku</th>
            <th>Nama Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Pengguna</th>
            <th>Aksi</th>
        </tr> 
        <?php foreach ( $peminjaman as $pinjam_row ): ?>    
        <tr>
            <td><?= $pinjam_row["id_buku"]; ?></td>
            <td><?= $pinjam_row["judul"]; ?></td>
            <td><?= $pinjam_row["tgl_peminjaman"]; ?></td>
            <td><?= $pinjam_row["tgl_pengembalian"]; ?></td>
            <td><?= $pinjam_row["username"]; ?></td>
            <td>
                <a href="../function/delete_borrowing.php?borrowings_id=<?= $pinjam_row["id_peminjaman"] ?>" class="hapus">Hapus</a>
            </td>
        </tr>
         <?php endforeach; ?>
    </table>
    </div>
        </div>
</body>
</html>