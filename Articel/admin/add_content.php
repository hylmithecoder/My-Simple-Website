<?php
include "../db.php";
session_start();
if(!isset($_SESSION['admin']))
{
    echo "<script>alert('Woi Kamu Jangan Nembak ya !!!');document.location.href='../login.php';</script>";
}
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $descriptions = mysqli_real_escape_string($conn, $_POST['descriptions']);
    $creator = mysqli_real_escape_string($conn, $_POST['author']);
    $current_date = date("Y-m-d");

    $upload_success = false;
    $image_data = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowed_types)) {
            $image_data = file_get_contents($_FILES['image']['tmp_name']);
            $upload_success = true;
        } else {
            $error_message = "Hanya file JPG, PNG & GIF yang diizinkan.";
        }
    }

    if ($upload_success || !isset($_FILES['image'])) {
        $query = "INSERT INTO tbl_content (title, images, descriptions, date_created, creator) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $title, $image_data, $descriptions, $current_date, $creator );
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href='index.php';</script>";
            exit;
        } else {
            $error_message = "Data Gagal Ditambahkan: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konten</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Tambah Konten</h2>
                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Judul konten Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="descriptions" placeholder="Deskripsi konten Anda" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="author" placeholder="Nama Anda" name="author" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>