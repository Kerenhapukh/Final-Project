
<?php
include 'koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $gambar = $_POST['gambar'];

    $sql = "INSERT INTO buku (id_buku, judul, penerbit, tahun_terbit, gambar) VALUES ('$id_buku','$judul', '$penerbit', '$tahun_terbit', '$gambar')";
    
    if (mysqli_query($db, $sql)) {
        header("Location: ../admin/buku.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}
