<?php 
include 'koneksi.php';

$id_buku = $_GET['id_buku'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_id_buku = $_POST['new_id_buku'];
    $judul = $_POST['judul'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $gambar = $_POST['gambar'];
    $status = $_POST['status'];

    // Check if the new id_buku already exists
    $check_sql = "SELECT * FROM buku WHERE id_buku = '$new_id_buku' AND id_buku != '$id_buku'";
    $check_result = mysqli_query($db, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $err = "ID Buku telah tersedia, Gunakan yang lain!";
    } else {
        $sql = "UPDATE buku SET id_buku = '$new_id_buku', judul = '$judul', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit', gambar = '$gambar', status = '$status' WHERE id_buku = '$id_buku'";

        if (mysqli_query($db, $sql)) {
            header("Location: ../admin/buku.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    }
}

$result = mysqli_query($db, "SELECT * FROM buku WHERE id_buku = '$id_buku'");
$book = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../styles/edit.css?v=<?php echo time(); ?>">
</head>
<body>
<main>
<section class="wrapper">
    <div class="box">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</section>

<div class="edit-form">
<div class="edit-heading">
<h1>Edit Buku</h1>
</div>
<form class="edit_book" method="POST" action="">
        <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
        ID Buku: <input type="text" name="new_id_buku" value="<?php echo $book['id_buku']; ?>" required><br>
        Judul: <input type="text" name="judul" value="<?php echo $book['judul']; ?>" required><br>
        Penerbit: <input type="text" name="penerbit" value="<?php echo $book['penerbit']; ?>" required><br>
        Tahun Terbit: <input type="number" name="tahun_terbit" value="<?php echo $book['tahun_terbit']; ?>" required><br>
        Gambar: <input type="text" name="gambar" value="<?php echo $book['gambar']; ?>" required><br>
        Status: 
        <select name="status">
            <option value="tersedia" <?php if($book['status'] == 'tersedia') echo 'selected'; ?>>Tersedia</option>
            <option value="dipinjam" <?php if($book['status'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
        </select><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="../admin/buku.php">Kembali</a>
</div>
</main>
</body>
</html>