<?php
require '../fungsi/koneksi.php';

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
    <title>Manajemen Buku</title>
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css?v=<?php echo time(); ?>">
</head>
<body>
<nav>
    <ul>
        <li><a href="dashboard_admin.php">Dashboard</a></li>
        <li><a href="buku.php" class="active">Manajemen Buku</a></li>
        <li><a href="pengguna.php">Manajemen User</a></li>
        <li><a href="peminjaman.php">Manajemen Peminjaman</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container">
    <div class="library">
        <h2>Manajemen Buku</h2>
    </div>
    <div class="add">
        <button class="add-button" id="myBtn">
            Tambah Data
        </button>
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
            <th>Aksi</th>
        </tr>
        <?php foreach ( $buku as $buku_row ): ?>
        <tr>
            <td><?= $buku_row["id_buku"]; ?></td>
            <td><?= $buku_row["judul"]; ?></td>
            <td><?= $buku_row["penerbit"]; ?></td>
            <td><?= $buku_row["tahun_terbit"]; ?></td>
            <td><?= $buku_row["gambar"]; ?></td>
            <td><?= $buku_row["status"]; ?></td>
            <td>
                <a href="../fungsi/edit_buku.php?id_buku=<?= $buku_row["id_buku"] ?>" class="edit">Edit</a> || 
                <a href="../fungsi/delete_buku.php?id_buku=<?= $buku_row["id_buku"] ?>" class="hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
    <!-- Table -->

  </div>
   
</div>

</body>
<div id="myModal" class="modal">

<!-- Modal content -->
    <div class="modal-content">
   
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Menambahkan data buku</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form" action="../fungsi/insert_buku.php" method="POST">
                <input type="text" placeholder="ID Buku" name="id_buku" required>
                <input type="text" placeholder="Judul" name="judul" required>
                <input type="text" placeholder="Penerbit" name="penerbit" required>
                <input type="number" placeholder="Tahun Terbit" name="tahun_terbit" required>
                <input type="text" placeholder="Gambar" name="gambar" required>
                <input type="submit" value="simpan">
            </form>
        </div>
    
    </div>            
</div>
<script src="../scripts/script.js"></script>
</html>