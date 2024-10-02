<?php
// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
include 'db.php';

// Ambil data berdasarkan ID atau parameter lainnya
$id = $_GET['search']; // Misal, mencari data berdasarkan ID

$query = "SELECT * FROM tbl_content  WHERE descriptions LIKE '%$id%'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Data ditemukan, tampilkan data di sini
    while($row = mysqli_fetch_assoc($result)) {
        // Proses data dan tampilkan
        echo "<h1>" . $row['title'] . "</h1>";
        echo "<p>" . $row['descriptions'] . "</p>";
    }
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-else=1.0">
    <title>Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSR-f_qmdxDFJgGUBFFAhkVhwBYKe1_ow-ypA&s" alt="404 Not Found" class="img-fluid mb-4">
                <h1>Halaman Tidak Ditemukan</h1>
                <p>Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
                <a onclick="window.history.back();" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
}
?>