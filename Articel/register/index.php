<?php
include "../db.php";
session_start();
if (isset($_POST['Save']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];

    // Check if password and confirm password match
    if ($password !== $confirmPass) {
        echo "<div class='alert alert-danger'>
                Password and confirm password do not match
            </div>";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $SaveAccount = "INSERT INTO account (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $SaveAccount);
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);
    $Save = mysqli_stmt_execute($stmt);

    if ($Save)
    {
        echo "<script>alert('Account Has Been Added'); document.location.href='../login.php'</script>";
    }
    else
    {
        echo "<script>alert('Account Has Not Been Added')</script>";
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container text-center mt-5">
        <fieldset>
            <legend>Register</legend>
            <form action="" method="post">
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
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <center><input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Your Password" required></center>
                                </div>
                                <button name="Save" type="submit" class="btn btn-primary">Register</button><br>
                                <span class="text-muted">Sudah Punya Akun <a href="../login.php">Login ?</a></span>
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