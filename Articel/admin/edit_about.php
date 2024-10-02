<?php
include "../db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Kamu Tidak Akan pernah bisa bypass 🥶');document.location.href='../login.php'</script>";
    exit;
}

$About = $_GET['about'];

$query = mysqli_query($conn, "SELECT * FROM tbl_about WHERE Title = '$About'");
$data = mysqli_fetch_assoc($query);
if (isset($_POST['Edit'])) {
    $paragrafofAbout = $_POST['paragraph'];
    $Edit = "UPDATE tbl_about SET About = '$paragrafofAbout' WHERE Title = '$About'";
    $Eksekusi = mysqli_query($conn, $Edit);
    if ($Eksekusi)
    {
        echo "<script>alert('About Berhasil Diedit');document.location.href='../about.php'</script>";
    }
    else
    {
        echo "<script>alert('About Gagal Diedit');document.location.href='edit_about.php?about=$About'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About</title>
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php           
                ?>
                <div class="content-edit-form">
                    <h2 class="text-center mb-4">Edit Content About</h2>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="paragraph" class="form-control" id="deskripsi" rows="5" required><?php echo $data['About']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <center><input type="submit" name="Edit" value="Edit" class="btn btn-primary"></center>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>