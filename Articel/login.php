<?php
include "db.php";
session_start();

if (isset($_POST['Login'])) {
    $USERNAME = mysqli_real_escape_string($conn, $_POST['username']);
    $PASSWORD = $_POST['password'];

    $query = "SELECT * FROM account WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $USERNAME);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // Gunakan password_verify untuk membandingkan password
        if (password_verify($PASSWORD, $row['password'])) {
            $_SESSION['user'] = $row['username'];
            $_SESSION['admin'] = true;
            // Jangan simpan password di session
            echo "<script>alert('Selamat datang " . htmlspecialchars($row['username']) . "');document.location.href='admin/index.php?user=" . urlencode($row['username']) . "';</script>";
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    input[type=text], input[type=password] {
        width: 50%;
    }
    button:hover {
        box-shadow: 0 0 10px rgba(0, 0, 255, 0.7);
    }
</style>
<body>
<div class="container text-center mt-5">
    <fieldset>
        <legend>Login</legend>        
        <form method="post">
        <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <center><input type="text" class="form-control" placeholder="Your Username" id="username" name="username" required></center>                                
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <center><input type="password" class="form-control" placeholder="Your Password" id="password" name="password" required></center>                                
                            </div>
                            <button name="Login" type="submit" class="btn btn-primary">Login</button><br>
                            <span class="text-muted">Belum Punya Akun <a href="register">Daftar ?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    </fieldset>
</div>
</body>
</html>