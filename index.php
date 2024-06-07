<?php 
include 'fungsi/koneksi.php'; 
session_start();

if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: user/dashboard.php");
    }
}

// Mengambil data login
$messages = "";
// Mengambil data login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek data login
    $cek = mysqli_query($db, "SELECT * FROM akun WHERE username='$username'");
    if ($cek && mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_assoc($cek);

        if (password_verify($password, $data['password'])) {
            // Mengambil role user
            $datUser_id = $data['user_id'];
            $datRole = $data['role'];
            $datEmail = $data['email'];
            
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $datRole;
            $_SESSION['email'] = $datEmail;

            // Jika role sebagai admin, maka akan diarahkan ke halaman admin
            if ($datRole == 'admin') {
                header("Location: admin/dashboard_admin.php");
            } else {
                // Jika role sebagai user, maka akan diarahkan ke halaman user
                header("Location: user/dashboard_user.php");
            }
        } else {
            $messages .= "<div class='alert-danger'>Username atau Password Salah!</div>";
        }
    } else {
        $messages .= "<div class='alert-danger'>Username atau Password Salah!</div>";
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
                href="fungsi/register.php">Register</a></p>  
            </div>
        </form>
    </div>
</body>
</html>