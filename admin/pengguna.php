<?php 
require '../fungsi/koneksi.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE username = '$username'";
$result = mysqli_query($db, $query);

$akun = query("SELECT * FROM akun");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Pengguna</title>
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css?v=<?php echo time(); ?>">
</head>
<body>
<nav>
    <ul>
        <li><a href="dashboard_admin.php">Dashboard</a></li>
        <li><a href="buku.php">Manajemen Buku</a></li>
        <li><a href="pengguna.php">Manajemen User</a></li>
        <li><a href="peminjaman.php">Manajemen Peminjaman</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
    </ul>`
</nav>
<div class="container">
<div class="library">
    <h2>Manajemen Pengguna</h2>
    </div>
<div class="tableFix">
    <table id="table">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Email</th>
            <th>Nomor</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ( $akun as $akun_row ): ?>
        <tr>
            <td><?= $akun_row["nama_lengkap"]; ?></td>
            <td><?= $akun_row["username"]; ?></td>
            <td><?= $akun_row["role"]; ?></td>
            <td><?= $akun_row["email"]; ?></td>
            <td><?= $akun_row["nomor"]; ?></td>
            <td>
                <a href="../fungsi/edit_role.php?username=<?= $akun_row["username"] ?>" class="edit">Edit</a> || 
                <a href="../fungsi/delete_user.php?username=<?= $akun_row["username"] ?>" class="hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>


    </div>


</body>
</html>