<?php
$id = $_GET['id'];
include "../db.php";
$table = mysqli_query($conn, "SELECT * FROM tbl_content WHERE ID = $id");
$alert = '';

session_start();
if(!isset($_SESSION['admin']))
{
    echo "<script>alert('Woi Kamu Jangan Nembak ya !!!');document.location.href='../login.php';</script>";
}

if (isset($_POST['Edit'])) {
    $title = $_POST['judul'];
    $description = $_POST['deskripsi'];
    $current_date = date("Y-m-d");
    $creator = $_POST['author'];

    // Proses upload gambar
    if ($_FILES['image']['name']) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $image = file_get_contents($_FILES['image']['tmp_name']);
        } else {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        File bukan gambar.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            $image = null;
        }
    } else {
        // Jika tidak ada file baru diupload, gunakan gambar yang ada
        $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT images FROM tbl_content WHERE ID = $id"));
        $image = $result['images'];
    }

    $Edit = "UPDATE tbl_content SET title = ?, images = ?, descriptions = ?, date_created = ?, creator = ? WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $Edit);
    mysqli_stmt_bind_param($stmt, "sssssi", $title, $image, $description, $current_date, $creator, $id);
    $Eksekusi = mysqli_stmt_execute($stmt);
    
    if ($Eksekusi) {
        echo '<script>alert("Konten Berhasil Di edit"); window.location.href="index.php";</script>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Konten Gagal Di edit. Error: ' . mysqli_error($conn) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    }
}
$titlecontent = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_content WHERE ID = $id"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Content - <?php echo $titlecontent['title']; ?></title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content-edit-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                if (!empty($alert)) {
                    echo $alert;
                }
                ?>
                <div class="content-edit-form">
                    <?php
                    while ($data = mysqli_fetch_assoc($table)) :
                    ?>
                    <h2 class="text-center mb-4">Edit Content: <?php echo htmlspecialchars($data['title']); ?></h2>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input value="<?php echo htmlspecialchars($data['title']); ?>" name="judul" type="text" class="form-control" id="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" name="image" required class="form-control" id="image">
                            <?php if ($data['images']) : ?>
                                <div class="mt-2">
                                    <p>Gambar Saat Ini:</p>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($data['images']); ?>" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="5" required><?php echo htmlspecialchars($data['descriptions']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input value="<?php echo htmlspecialchars($data['creator']); ?>" name="author" type="text" class="form-control" id="penulis" required>
                        </div>                        
                        <div class="text-center">
                            <button name="Edit" type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                    <?php
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>