<?php 
require '../fungsi/koneksi.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = $_POST['id_buku'];
    $tgl_peminjaman = date('Y-m-d');
    $tgl_pengembalian = date('Y-m-d', strtotime($tgl_peminjaman . ' + 14 days'));

    // Ambil judul buku
    $query = "SELECT judul FROM buku WHERE id_buku = '$id_buku'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $judul = $row['judul'];

    // Insert data peminjaman ke tabel peminjaman
    $query = "INSERT INTO peminjaman (tgl_peminjaman, tgl_pengembalian, username, id_buku, judul) 
              VALUES ('$tgl_peminjaman', '$tgl_pengembalian', '$username', '$id_buku', '$judul')";
    mysqli_query($db, $query);

    // Update status buku menjadi 'dipinjam'
    $query = "UPDATE buku SET status = 'dipinjam' WHERE id_buku = '$id_buku'";
    mysqli_query($db, $query);

    header("Location: peminjaman.php");
    exit;
}
    $query_peminjaman = "SELECT * FROM peminjaman WHERE username = '$username'";
    $result_peminjaman = mysqli_query($db, $query_peminjaman);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="../styles/peminjaman.css?v=<?php echo time(); ?>">
</head>
<body>
    <h1>Perpustakaan</h1>
</header>
<nav>
    <ul>
        <li><a href="dashboard_user.php">Dashboard</a></li>
        <li><a href="koleksi.php">Koleksi</a></li>
        <li><a href="peminjaman.php" class="active" >Peminjaman</a></li>
        <li><a href="kontak.php">Kontak</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
    </ul>
</nav>
<div class="container">
    <div class="library">
    <h2>Selamat Datang di Perpustakaan</h2>
    <p>Menyediakan berbagai koleksi buku terbaru dan terbaik</p> 
    </div>
    <h2>Daftar Peminjaman</h2>
    <form class="borrow" action="peminjaman.php" method="POST">
                    <label for="id_buku">Pilih Buku:</label>
                    <select name="id_buku" id="id_buku" required>
                        <?php
                        $query = "SELECT id_buku, judul FROM buku WHERE status = 'tersedia'";
                        $result = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['id_buku']}'>{$row['judul']}</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" value="Pinjam Buku">
    </form>
            <!-- Table -->
            <table id="table">
                <tr>
                    <th>Nama Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Pengguna</th>
                </tr>
                
                <?php 
                foreach ( $result_peminjaman as $pinjam_row ): 
                ?>
                
                <tr>
                    <td><?= $pinjam_row["judul"]; ?></td>
                    <td><?= $pinjam_row["tgl_peminjaman"]; ?></td>
                    <td><?= $pinjam_row["tgl_pengembalian"]; ?></td>
                    <td><?= $pinjam_row["username"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            </div>

</body>
</html>