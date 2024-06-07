<?php
include 'koneksi.php';

$id_buku = $_GET['id_buku'];

$sql = "DELETE FROM buku WHERE id_buku='$id_buku'";

if (mysqli_query($db, $sql)) {
    header("Location: ../admin/buku.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}