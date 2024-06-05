<?php 
include 'fungsi/koneksi.php'; 

// Mengambil data login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Cek data login
    $cek = mysqli_query($db, "SELECT * FROM akun WHERE username='$username' AND password='$password'");
    $countRow = mysqli_num_rows($cek);

    if ($countRow > 0) {
        // Mengambil role user
        $takeRole = mysqli_fetch_array($cek);
        $role = $takeRole['role'];

        $data = mysqli_fetch_assoc($cek);
        $datRole = $data['role'];
        $datEmail = $data['email'];
        $datnomor = $data['nomor']; 
        
        $_SESSION['login'] = true;
        $_SESSION['nomor'] = $datnomor;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $datRole;
        $_SESSION['email'] = $datEmail;

        // Jika role sebagai admin, maka akan diarahkan ke halaman admin
        if ($role == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header("Location: dashboard_admin.php");
        } else {
        // Jika role sebagai user, maka akan diarahkan ke halaman user
            header("Location: dashboard_user.php");
        }

    } else {
        if ($countRow == 0) {
            $err = "Username atau Password Salah!";
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">  
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST">
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password</a>
            </div>

            <button type="submit" name="login" class="btn">login</button>

            <div class="register-link">
                <p>Don't have an account? <a
                href="#">Register</a></p>  
            </div>
        </form>
    </div>
</body>
</html>