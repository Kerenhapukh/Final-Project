<?php 
include '../fungsi/koneksi.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
   <link rel="stylesheet" type="text/css" href="../styles/kontak.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <h1>Perpustakaan</h1>
        <nav>
            <ul>
        <li><a href="dashboard_user.php">Dashboard</a></li>
        <li><a href="koleksi.php">Koleksi</a></li>
        <li><a href="peminjaman.php">Peminjaman</a></li>
        <li><a href="index.html" class="active" >Kontak</a></li>
        <li><a href="../fungsi/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="about-section">
            <div class="about-content">
                <h2>Tentang Kami</h2>
                <p>Prodi Informatika UNSRAT</p>
                <div class="team-members">
                    <div class="member">
                        <img src="../img/keren.jpg" alt="Keren Waworuntu">
                        <h4>Kerenhapukh Waworuntu</h4>
                        <p>NIM: 220211061065</p>
                        <p>Email: kerenhapukwaworuntu026@student.unsrat.ac.id</p>
                    </div>
                    <div class="member">
                    <img src="../img/sam.jpg" alt="Samuel Raranta">
                        <h4>Samuel Raranta</h4>
                        <p>NIM: 220211060116</p>
                        <p>Email: samuelraranta026@student.unsrat.ac.id</p>
                    </div>
                    <div class="member">
                    <img src="../img/anggi.jpg" alt="Anggi Sumarno">
                        <h4>Anggraini Sumarno</h4>
                        <p>NIM: 220211060145</p>
                        <p>Email: anggrainisumarno026@student.unsrat.ac.id</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-section">
            <div class="contact-content">
                <h2>Hubungi Kami</h2>
                <form action="">
                    <input type="text" placeholder="Nama" required>
                    <input type="email" placeholder="Alamat Email" required>
                    <input type="tel" placeholder="Telepon" autocomplete="off">
                    <textarea rows="5" placeholder="Pesan" required></textarea>
                    <button type="submit">Kirim</button>
                </form>
            </div>
        </div>
    </div>


    <footer>
        <p>&copy; 2024 Perpustakaan paling ketceh😎.</p>
    </footer>
</body>
</html>
