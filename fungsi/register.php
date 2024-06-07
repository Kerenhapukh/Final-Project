<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $stmt = $db->prepare("SELECT * FROM akun WHERE username = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($db->error));
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $countRow = $result->num_rows;

    if ($countRow == 0) {
        // Insert new user into the database
        $stmt = $db->prepare("INSERT INTO akun (nama_lengkap, username, email, nomor, password, role) VALUES (?, ?, ?, ?, ?, 'user')");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($db->error));
        }
        $stmt->bind_param("sssss", $nama_lengkap, $username, $email, $phoneNumber, $password_hash);
        
        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Registration failed!";
        }
    } else {
        echo "Username already taken!";
    }

    $stmt->close();
    $db->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Responsive Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../styles/register.css"/>
</head>
<body>
    <div class="container">
        <h1 class="form-title">Registration</h1>
        <form action="register.php" method="post">
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="nama_lengkap">Full Name</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Enter Full Name" required/>
                </div>
                <div class="user-input-box">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter Username" required/>
                </div>
                <div class="user-input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" required/>
                </div>
                <div class="user-input-box">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" required/>
                </div>
                <div class="user-input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required/>
                </div>
                <div class="user-input-box">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required/>
                </div>
            </div>
            <div class="form-submit-btn">
                <input type="submit" name="register" value="Register">
            </div>
        </form>
    </div>
</body>
</html>
