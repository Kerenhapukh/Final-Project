<?php
include 'koneksi.php';

$username = $_GET['username'];

$sql = "DELETE FROM akun WHERE username='$username'";

if (mysqli_query($db, $sql)) {
    header("Location: ../admin/pengguna.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}