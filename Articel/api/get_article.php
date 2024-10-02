// articel/api/get_articles.php
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000'); // Ganti dengan URL React kamu

// Koneksi ke database
// ...
$conn = mysqli_connect("localhost", "root", "", "db_myarticel");
// Query untuk mengambil semua artikel
$sql = "SELECT * FROM tbl_content";
$result = $conn->query($sql);

$articles = [];
while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}

echo json_encode($articles);
?>