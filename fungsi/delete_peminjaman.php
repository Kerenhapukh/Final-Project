<?php
include 'connection.php';

$id = $_GET['id_peminjaman'];

$sql = "DELETE FROM id_peminjaman WHERE id_peminjaman ='$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/peminjaman.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}