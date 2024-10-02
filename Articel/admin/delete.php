<?php
$id = $_GET['id'];
include "../db.php";
session_start();
if(!isset($_SESSION['admin']))
{
    echo "<script>alert('Woi Kamu Jangan Nembak ya !!!');document.location.href='../login.php';</script>";
}
$Delete = mysqli_query($conn, "DELETE FROM tbl_content WHERE id = $id");
if ($Delete) {
    echo "<script>alert('Konten Berhasil Dihapus');document.location.href='index.php';</script>";
}
else 
{
    echo "<script>alert('Data Gagal Dihapus');</script>";
}

?>