<?php 
include 'koneksi.php';

$username = $_GET['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];

        $sql = "UPDATE akun SET role = '$role' WHERE username='$username'";

        if (mysqli_query($db, $sql)) {
            header("Location: ../admin/pengguna.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
}

$result = mysqli_query($db, "SELECT * FROM akun WHERE username='$username'");
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
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
        <div></div>
    </div>
    </section>
<div class="edit-form">
    <div class="edit-heading">
        <h1>Edit Role</h1>
    </div>
<form class="edit_book" method="POST" action="">
        <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
        Role: 
        <select name="role">
            <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>User</option>
            <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="../admin/pengguna.php">Kembali</a>
</div>
</main>
</body>
</html>