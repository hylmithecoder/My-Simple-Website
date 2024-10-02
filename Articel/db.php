<?php
$conn = mysqli_connect('localhost','root','','db_myarticel');
$_SESSION['admin'] = false;
// session_start();
// $_SESSION['admin'] = true;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else 
{
    echo "<script>console.log('is the database connected now')</script>";
}
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="script.js"></script>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
<script src="../script.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->